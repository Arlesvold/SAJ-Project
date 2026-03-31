<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\StreamedResponse;

class WasteCalculatorHistoryController extends Controller
{
    private const HISTORY_FILE = 'waste-calculator/history.json';

    public function index(): JsonResponse
    {
        try {
            $history = $this->readHistory();

            return response()->json([
                'success' => true,
                'message' => 'Riwayat berhasil diambil.',
                'data' => $history,
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal mengambil riwayat kalkulator sampah.', [
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil riwayat.',
            ], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'namaKelas' => ['required', 'string', 'max:100'],
                'jumlahHari' => ['required', 'numeric', 'gt:0'],
                'organik' => ['required', 'numeric', 'gte:0'],
                'anorganik' => ['required', 'numeric', 'gte:0'],
                'plastik' => ['required', 'numeric', 'gte:0'],
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak valid.',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $validated = $validator->validated();
            $total = (float) $validated['organik'] + (float) $validated['anorganik'] + (float) $validated['plastik'];

            if ($total <= 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Total sampah harus lebih dari 0.',
                ], 422);
            }

            $rataRata = $total / (float) $validated['jumlahHari'];

            $item = [
                'id' => (string) now()->format('Uu') . bin2hex(random_bytes(3)),
                'waktu' => now()->toIso8601String(),
                'data' => [
                    'namaKelas' => trim((string) $validated['namaKelas']),
                    'jumlahHari' => (float) $validated['jumlahHari'],
                    'organik' => (float) $validated['organik'],
                    'anorganik' => (float) $validated['anorganik'],
                    'plastik' => (float) $validated['plastik'],
                ],
                'hasil' => [
                    'total' => $total,
                    'prediksi30Hari' => $rataRata * 30,
                ],
            ];

            $history = $this->readHistory();
            array_unshift($history, $item);
            $history = array_slice($history, 0, 1000);
            $this->writeHistory($history);

            return response()->json([
                'success' => true,
                'message' => 'Riwayat berhasil disimpan.',
                'data' => $item,
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Gagal menyimpan riwayat kalkulator sampah.', [
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan riwayat.',
            ], 500);
        }
    }

    public function destroy(string $id): JsonResponse
    {
        try {
            $history = $this->readHistory();
            $filtered = array_values(array_filter($history, fn($item) => (string) ($item['id'] ?? '') !== $id));

            $this->writeHistory($filtered);

            return response()->json([
                'success' => true,
                'message' => 'Data riwayat berhasil dihapus.',
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal menghapus riwayat kalkulator sampah.', [
                'id' => $id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data.',
            ], 500);
        }
    }

    public function bulkDelete(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'ids' => ['required', 'array', 'min:1'],
                'ids.*' => ['required', 'string'],
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data pilihan tidak valid.',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $ids = array_map('strval', $validator->validated()['ids']);
            $lookup = array_flip($ids);

            $history = $this->readHistory();
            $filtered = array_values(array_filter(
                $history,
                fn($item) => !isset($lookup[(string) ($item['id'] ?? '')])
            ));

            $this->writeHistory($filtered);

            return response()->json([
                'success' => true,
                'message' => 'Data terpilih berhasil dihapus.',
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal bulk delete riwayat kalkulator sampah.', [
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data terpilih.',
            ], 500);
        }
    }

    public function exportCsv(): StreamedResponse|JsonResponse
    {
        try {
            $history = $this->readHistory();

            return response()->streamDownload(function () use ($history): void {
                $handle = fopen('php://output', 'w');
                fputcsv($handle, [
                    'Waktu',
                    'Kelas',
                    'Jumlah Hari',
                    'Organik (kg)',
                    'Anorganik (kg)',
                    'Plastik (kg)',
                    'Total (kg)',
                    'Prediksi 30 Hari (kg)',
                ]);

                foreach ($history as $item) {
                    fputcsv($handle, [
                        $item['waktu'] ?? '',
                        $item['data']['namaKelas'] ?? '',
                        $item['data']['jumlahHari'] ?? '',
                        $item['data']['organik'] ?? '',
                        $item['data']['anorganik'] ?? '',
                        $item['data']['plastik'] ?? '',
                        $item['hasil']['total'] ?? '',
                        $item['hasil']['prediksi30Hari'] ?? '',
                    ]);
                }

                fclose($handle);
            }, 'riwayat-kalkulator-sampah.csv', [
                'Content-Type' => 'text/csv; charset=UTF-8',
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal export CSV riwayat kalkulator sampah.', [
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat export CSV.',
            ], 500);
        }
    }

    private function readHistory(): array
    {
        if (!Storage::exists(self::HISTORY_FILE)) {
            return [];
        }

        $content = Storage::get(self::HISTORY_FILE);
        if ($content === '') {
            return [];
        }

        $decoded = json_decode($content, true);

        return is_array($decoded) ? $decoded : [];
    }

    private function writeHistory(array $history): void
    {
        Storage::put(self::HISTORY_FILE, json_encode($history, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}
