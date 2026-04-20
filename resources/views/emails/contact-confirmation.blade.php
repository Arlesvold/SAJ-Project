<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pesan - Go Green School</title>
</head>

<body style="margin:0; padding:0; background:#f2f7f3; font-family:'Segoe UI',Arial,sans-serif; color:#1f2a24;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#f2f7f3; padding:24px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0"
                    style="max-width:680px; background:#ffffff; border-radius:16px; overflow:hidden; border:1px solid #e1ece3;">
                    <tr>
                        <td
                            style="padding:28px 28px 18px; background:linear-gradient(135deg,#1b5e20,#2e7d32); color:#ffffff;">
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td style="vertical-align:middle; width:70px;">
                                        @if (!empty($logoUrl))
                                            <img src="{{ $logoUrl }}" alt="Logo Go Green School" width="58"
                                                height="58"
                                                style="display:block; width:58px; height:58px; border-radius:50%; background:#ffffff; padding:6px; object-fit:contain;">
                                        @else
                                            <div
                                                style="width:58px; height:58px; border-radius:50%; background:#ffffff; color:#2e7d32; font-size:30px; line-height:58px; text-align:center;">
                                                🌿</div>
                                        @endif
                                    </td>
                                    <td style="vertical-align:middle;">
                                        <div
                                            style="font-size:12px; letter-spacing:1px; font-weight:700; text-transform:uppercase; opacity:.9;">
                                            Go Green School
                                        </div>
                                        <div style="font-size:22px; font-weight:800; line-height:1.25; margin-top:4px;">
                                            Konfirmasi Pesan Anda
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:26px 28px 8px;">
                            <p style="margin:0 0 12px; font-size:16px; line-height:1.6;">
                                Halo <strong>{{ $fullName }}</strong>, terima kasih sudah menghubungi tim Go Green
                                School.
                                Pesan Anda sudah kami terima dan sedang kami tindak lanjuti.
                            </p>
                            <p style="margin:0 0 18px; font-size:15px; line-height:1.6; color:#425148;">
                                Berikut ringkasan data pengiriman Anda:
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:0 28px 8px;">
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0"
                                style="border-collapse:separate; border-spacing:0 10px;">
                                <tr>
                                    <td
                                        style="width:38%; padding:12px 14px; border-radius:10px; background:#f6fbf7; color:#4c5b53; font-size:13px; font-weight:600;">
                                        Nama Lengkap
                                    </td>
                                    <td
                                        style="padding:12px 14px; border-radius:10px; background:#f6fbf7; color:#1f2a24; font-size:14px;">
                                        {{ $fullName }}
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        style="width:38%; padding:12px 14px; border-radius:10px; background:#f6fbf7; color:#4c5b53; font-size:13px; font-weight:600;">
                                        Email
                                    </td>
                                    <td
                                        style="padding:12px 14px; border-radius:10px; background:#f6fbf7; color:#1f2a24; font-size:14px;">
                                        {{ $email }}
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        style="width:38%; padding:12px 14px; border-radius:10px; background:#f6fbf7; color:#4c5b53; font-size:13px; font-weight:600;">
                                        WhatsApp
                                    </td>
                                    <td
                                        style="padding:12px 14px; border-radius:10px; background:#f6fbf7; color:#1f2a24; font-size:14px;">
                                        {{ $whatsapp }}
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        style="width:38%; padding:12px 14px; border-radius:10px; background:#f6fbf7; color:#4c5b53; font-size:13px; font-weight:600;">
                                        Kanal Balasan
                                    </td>
                                    <td
                                        style="padding:12px 14px; border-radius:10px; background:#f6fbf7; color:#1f2a24; font-size:14px;">
                                        {{ $preferredChannel }}
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        style="width:38%; padding:12px 14px; border-radius:10px; background:#f6fbf7; color:#4c5b53; font-size:13px; font-weight:600;">
                                        Waktu Kirim
                                    </td>
                                    <td
                                        style="padding:12px 14px; border-radius:10px; background:#f6fbf7; color:#1f2a24; font-size:14px;">
                                        {{ $submittedAt }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:10px 28px 24px;">
                            <div
                                style="border-radius:12px; border:1px solid #d8e9db; background:#f8fdf9; padding:16px 18px;">
                                <div style="font-size:13px; font-weight:700; color:#2b6d38; margin-bottom:8px;">
                                    Isi Pesan Anda
                                </div>
                                @if (!empty($messageHtml))
                                    <div style="font-size:14px; line-height:1.7; color:#2e3c34;">
                                        {!! $messageHtml !!}
                                    </div>
                                @else
                                    <div style="font-size:14px; line-height:1.7; color:#2e3c34; white-space:pre-wrap;">
                                        {!! nl2br(e($messageText)) !!}
                                    </div>
                                @endif
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:0 28px 28px;">
                            <div
                                style="border-radius:12px; background:linear-gradient(135deg,#e8f5e9,#d9efe6); padding:14px 16px; color:#1f5030; font-size:13px; line-height:1.6;">
                                Tim kami akan menindaklanjuti maksimal <strong>1x24 jam kerja</strong>.
                                Jika Anda membutuhkan respon lebih cepat, balas email ini atau hubungi kanal WhatsApp
                                resmi kami.
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td
                            style="padding:16px 24px; background:#f0f6f2; border-top:1px solid #e0ebe3; text-align:center;">
                            <div style="font-size:12px; color:#5f6f66; line-height:1.6;">
                                Go Green School • Sekolah Hijau untuk Masa Depan
                            </div>
                            <div style="font-size:11px; color:#7a8881; margin-top:4px;">
                                Email ini dikirim otomatis oleh sistem kontak Go Green School.
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
