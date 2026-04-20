<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Throwable;

final class ContactController extends Controller
{
    /**
     * Handle contact form submission and send WhatsApp message via Fonnte.
     */
    public function submit(Request $request): RedirectResponse
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'full_name' => ['required', 'string', 'max:120'],
                    'email' => ['required', 'email', 'max:150'],
                    'whatsapp' => ['required', 'string', 'max:20', 'regex:/^(\+62|08)[0-9]{8,13}$/'],
                    'preferred_channel' => ['required', 'string', 'max:50'],
                    'message_html' => ['required', 'string', 'min:10'],
                    'message_text' => ['required', 'string', 'min:10'],
                    'consent' => ['accepted'],
                ],
                [
                    'whatsapp.regex' => 'Nomor WhatsApp harus diawali +62 atau 08.',
                    'consent.accepted' => 'Anda harus menyetujui penggunaan data untuk tindak lanjut.',
                ]
            );

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $validated = $validator->validated();
            $validated['message_html'] = $this->sanitizeMessageHtml($validated['message_html']);
            $validated['message_text'] = $this->htmlToPlainText($validated['message_html']);

            if (mb_strlen($validated['message_text']) < 10) {
                return back()
                    ->withErrors(['message_html' => 'Pesan minimal 10 karakter setelah format diproses.'])
                    ->withInput();
            }

            $targetWhatsapp = $this->normalizeWhatsapp($validated['whatsapp']);
            $message = $this->buildWhatsappMessage($validated);

            ['token' => $fonnteToken, 'endpoint' => $fonnteEndpoint] = $this->resolveFonnteConfig();

            if ($fonnteToken === '') {
                Log::warning('Fonnte token is missing. Please configure FONNTE_TOKEN in environment variables.');

                return back()->withInput()->with('error', 'Integrasi WhatsApp belum dikonfigurasi. Silakan hubungi admin.');
            }

            $response = Http::asForm()
                ->timeout(20)
                ->withHeaders([
                    'Authorization' => $fonnteToken,
                ])
                ->post($fonnteEndpoint, [
                    'target' => $targetWhatsapp,
                    'message' => $message,
                ]);

            $isSent = $response->successful() && (bool) data_get($response->json(), 'status', false);

            if (! $isSent) {
                throw new \RuntimeException('Fonnte request failed: ' . substr($response->body(), 0, 500));
            }

            $isEmailSent = $this->sendConfirmationEmail($validated, $targetWhatsapp);

            $this->persistContactMessage([
                'full_name' => $validated['full_name'],
                'email' => $validated['email'],
                'whatsapp_original' => $validated['whatsapp'],
                'whatsapp_normalized' => $targetWhatsapp,
                'preferred_channel' => $validated['preferred_channel'],
                'message_html' => $validated['message_html'],
                'message_text' => $validated['message_text'],
                'submitted_at' => now()->toIso8601String(),
                'email_sent' => $isEmailSent,
                'fonnte_response' => $response->json(),
            ]);

            if (! $isEmailSent) {
                return back()->withInput()->with('error', 'Pesan WhatsApp berhasil dikirim, tetapi email konfirmasi belum terkirim. Silakan periksa konfigurasi SMTP.');
            }

            return back()->with('success', 'Pesan berhasil dikirim ke WhatsApp dan email Anda.');
        } catch (Throwable $e) {
            report($e);

            return back()
                ->withInput()
                ->with('error', 'Maaf, pesan belum berhasil dikirim. Silakan coba kembali beberapa saat lagi.');
        }
    }

    /**
     * Resolve Fonnte config safely across local/cloud env naming and cache differences.
     *
     * @return array{token: string, endpoint: string}
     */
    private function resolveFonnteConfig(): array
    {
        $tokenCandidates = [
            (string) config('services.fonnte.token', ''),
            (string) env('FONNTE_TOKEN', ''),
            (string) env('FONTE_TOKEN', ''),
            (string) env('FOONTE_TOKEN', ''),
        ];

        $endpointCandidates = [
            (string) config('services.fonnte.endpoint', ''),
            (string) env('FONNTE_ENDPOINT', ''),
            (string) env('FONTE_ENDPOINT', ''),
            (string) env('FOONTE_ENDPOINT', ''),
        ];

        $token = '';
        foreach ($tokenCandidates as $candidate) {
            $normalized = $this->sanitizeConfigValue($candidate);
            if ($normalized !== '') {
                $token = $normalized;
                break;
            }
        }

        $endpoint = 'https://api.fonnte.com/send';
        foreach ($endpointCandidates as $candidate) {
            $normalized = $this->sanitizeConfigValue($candidate);
            if ($normalized !== '') {
                $endpoint = $normalized;
                break;
            }
        }

        return [
            'token' => $token,
            'endpoint' => $endpoint,
        ];
    }

    /**
     * Remove accidental quotes/spaces from environment-backed values.
     */
    private function sanitizeConfigValue(string $value): string
    {
        return trim($value, " \t\n\r\0\x0B\"'");
    }

    /**
     * Normalize +62/08 format into 62xxxxxxxxxx format for API target.
     */
    private function normalizeWhatsapp(string $phone): string
    {
        $cleanPhone = preg_replace('/[^0-9+]/', '', $phone) ?? '';

        if (str_starts_with($cleanPhone, '+62')) {
            return '62' . substr($cleanPhone, 3);
        }

        if (str_starts_with($cleanPhone, '08')) {
            return '62' . substr($cleanPhone, 1);
        }

        if (str_starts_with($cleanPhone, '62')) {
            return $cleanPhone;
        }

        return $cleanPhone;
    }

    /**
     * Build WhatsApp message payload sent to user number.
     */
    private function buildWhatsappMessage(array $data): string
    {
        $formattedMessage = $this->convertHtmlToWhatsappFormat((string) ($data['message_html'] ?? ''));
        if ($formattedMessage === '') {
            $formattedMessage = (string) ($data['message_text'] ?? '');
        }

        return implode("\n", [
            'Halo ' . $data['full_name'] . ',',
            '',
            'Terima kasih sudah menghubungi Go Green School.',
            'Pesan Anda sudah kami terima dengan detail berikut:',
            '- Nama: ' . $data['full_name'],
            '- Email: ' . $data['email'],
            '- Kanal Balasan: ' . $data['preferred_channel'],
            '',
            'Isi Pesan:',
            $formattedMessage,
            '',
            'Tim kami akan menindaklanjuti maksimal 1x24 jam kerja.',
            'Salam hijau,',
            'Go Green School',
        ]);
    }

    /**
     * Send modern HTML confirmation email to the submitted recipient email.
     */
    private function sendConfirmationEmail(array $data, string $normalizedWhatsapp): bool
    {
        try {
            $logoUrl = $this->getLogoUrl();

            Mail::send('emails.contact-confirmation', [
                'fullName' => $data['full_name'],
                'email' => $data['email'],
                'whatsapp' => $normalizedWhatsapp,
                'preferredChannel' => $data['preferred_channel'],
                'messageHtml' => $data['message_html'],
                'messageText' => $data['message_text'],
                'submittedAt' => now()->locale('id')->translatedFormat('d F Y, H:i') . ' WIB',
                'logoUrl' => $logoUrl,
            ], function ($message) use ($data): void {
                $message
                    ->to($data['email'], $data['full_name'])
                    ->subject('Konfirmasi Pesan Anda - Go Green School');
            });

            return true;
        } catch (Throwable $e) {
            report($e);

            return false;
        }
    }

    /**
     * Get logo as data URI so it can be shown inline in email clients.
     */
    private function getLogoUrl(): string
    {
        $appUrl = rtrim((string) config('app.url', ''), '/');

        if ($appUrl !== '') {
            return $appUrl . '/images/logo.png';
        }

        return asset('images/logo.png');
    }

    /**
     * Sanitize Trix HTML output to keep safe formatting for email rendering.
     */
    private function sanitizeMessageHtml(string $html): string
    {
        try {
            $rawHtml = trim($html);
            if ($rawHtml === '') {
                return '';
            }

            libxml_use_internal_errors(true);

            $dom = new \DOMDocument('1.0', 'UTF-8');
            $dom->loadHTML('<?xml encoding="utf-8" ?>' . $rawHtml, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

            $allowedTags = ['p', 'div', 'br', 'strong', 'b', 'em', 'i', 'u', 's', 'strike', 'del', 'ul', 'ol', 'li', 'blockquote', 'a', 'code', 'pre'];
            $allowedAttributes = [
                'a' => ['href'],
            ];

            $nodes = iterator_to_array($dom->getElementsByTagName('*'));
            foreach ($nodes as $node) {
                $tag = strtolower($node->nodeName);

                if (! in_array($tag, $allowedTags, true)) {
                    $this->unwrapDomNode($node);
                    continue;
                }

                if ($node->hasAttributes()) {
                    $attributes = iterator_to_array($node->attributes);
                    foreach ($attributes as $attribute) {
                        $attributeName = strtolower($attribute->nodeName);
                        $tagAttributes = $allowedAttributes[$tag] ?? [];

                        if (! in_array($attributeName, $tagAttributes, true)) {
                            $node->removeAttribute($attributeName);
                        }
                    }
                }

                if ($tag === 'a') {
                    $href = trim((string) $node->getAttribute('href'));
                    if ($href === '' || ! preg_match('/^https?:\/\//i', $href)) {
                        $node->removeAttribute('href');
                    }
                }
            }

            $sanitized = trim((string) $dom->saveHTML());
            libxml_clear_errors();

            return $sanitized;
        } catch (Throwable $e) {
            report($e);

            return trim(strip_tags($html, '<p><div><br><strong><b><em><i><u><s><strike><del><ul><ol><li><blockquote><a><code><pre>'));
        }
    }

    /**
     * Convert sanitized HTML into plain text for storage and minimal length checks.
     */
    private function htmlToPlainText(string $html): string
    {
        try {
            $text = preg_replace('/<\s*br\s*\/?\s*>/i', "\n", $html) ?? $html;
            $text = preg_replace('/<\s*\/?(div|p|li|blockquote)\b[^>]*>/i', "\n", $text) ?? $text;
            $text = html_entity_decode(strip_tags($text), ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $text = preg_replace("/\r\n?|\n/", "\n", $text) ?? $text;
            $text = preg_replace('/[ \t]+\n/', "\n", $text) ?? $text;
            $text = preg_replace('/\n{3,}/', "\n\n", $text) ?? $text;

            return trim($text);
        } catch (Throwable $e) {
            report($e);

            return trim(strip_tags($html));
        }
    }

    /**
     * Convert rich HTML into WhatsApp-compatible text formatting.
     */
    private function convertHtmlToWhatsappFormat(string $html): string
    {
        try {
            if (trim($html) === '') {
                return '';
            }

            $normalized = str_replace(["\r\n", "\r"], "\n", $html);

            $normalized = preg_replace_callback(
                '/<\s*a\b[^>]*href=["\']([^"\']+)["\'][^>]*>(.*?)<\s*\/a\s*>/is',
                function (array $matches): string {
                    $label = trim($this->htmlToPlainText($matches[2]));
                    $url = trim($matches[1]);

                    if ($label === '' || $label === $url) {
                        return $url;
                    }

                    return $label . ' (' . $url . ')';
                },
                $normalized
            ) ?? $normalized;

            $normalized = preg_replace_callback('/<\s*(strong|b)\b[^>]*>(.*?)<\s*\/\1\s*>/is', function (array $matches): string {
                return '*' . trim($this->htmlToPlainText($matches[2])) . '*';
            }, $normalized) ?? $normalized;

            $normalized = preg_replace_callback('/<\s*(em|i)\b[^>]*>(.*?)<\s*\/\1\s*>/is', function (array $matches): string {
                return '_' . trim($this->htmlToPlainText($matches[2])) . '_';
            }, $normalized) ?? $normalized;

            $normalized = preg_replace_callback('/<\s*(s|strike|del)\b[^>]*>(.*?)<\s*\/\1\s*>/is', function (array $matches): string {
                return '~' . trim($this->htmlToPlainText($matches[2])) . '~';
            }, $normalized) ?? $normalized;

            $normalized = preg_replace_callback('/<\s*li\b[^>]*>(.*?)<\s*\/li\s*>/is', function (array $matches): string {
                return "\n- " . trim($this->htmlToPlainText($matches[1]));
            }, $normalized) ?? $normalized;

            $normalized = preg_replace('/<\s*br\s*\/?\s*>/i', "\n", $normalized) ?? $normalized;
            $normalized = preg_replace('/<\s*\/?(div|p|ul|ol|blockquote|pre)\b[^>]*>/i', "\n", $normalized) ?? $normalized;

            $plain = html_entity_decode(strip_tags($normalized), ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $plain = preg_replace('/[ \t]+\n/', "\n", $plain) ?? $plain;
            $plain = preg_replace('/\n{3,}/', "\n\n", $plain) ?? $plain;

            return trim($plain);
        } catch (Throwable $e) {
            report($e);

            return trim($this->htmlToPlainText($html));
        }
    }

    /**
     * Remove node while keeping its children inside parent container.
     */
    private function unwrapDomNode(\DOMNode $node): void
    {
        $parent = $node->parentNode;
        if (! $parent) {
            return;
        }

        while ($node->firstChild) {
            $parent->insertBefore($node->firstChild, $node);
        }

        $parent->removeChild($node);
    }

    /**
     * Persist contact submissions into storage/app/contact/messages.json.
     */
    private function persistContactMessage(array $messageData): void
    {
        try {
            $storageRoot = storage_path('app');
            if (! is_writable($storageRoot)) {
                throw new \RuntimeException('Storage path is not writable: ' . $storageRoot);
            }

            $directory = 'contact';
            $filePath = $directory . '/messages.json';

            if (! Storage::exists($directory)) {
                Storage::makeDirectory($directory);
            }

            $allMessages = [];
            if (Storage::exists($filePath)) {
                $decoded = json_decode((string) Storage::get($filePath), true);
                if (is_array($decoded)) {
                    $allMessages = $decoded;
                }
            }

            $allMessages[] = $messageData;

            Storage::put(
                $filePath,
                json_encode($allMessages, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
            );
        } catch (Throwable $e) {
            report($e);
        }
    }
}
