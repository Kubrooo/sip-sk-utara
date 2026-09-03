<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Keputusan - {{ $submission->sk_number ?? $submission->tracking_code }}</title>
    <style>
        @page {
            margin: 2cm 2.5cm 2cm 2.5cm;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            color: #000;
        }
        .header {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 8px;
            margin-bottom: 20px;
        }
        .header h3 {
            font-size: 14pt;
            font-weight: bold;
            margin: 0;
            text-transform: uppercase;
        }
        .header h2 {
            font-size: 16pt;
            font-weight: bold;
            margin: 2px 0;
            text-transform: uppercase;
        }
        .header p {
            font-size: 10pt;
            margin: 0;
            font-style: italic;
        }
        .title-box {
            text-align: center;
            margin-bottom: 25px;
        }
        .title-box h4 {
            font-size: 13pt;
            font-weight: bold;
            margin: 0;
            text-transform: uppercase;
            text-decoration: underline;
        }
        .title-box p {
            margin: 3px 0 0 0;
            font-size: 11pt;
        }
        .content {
            text-align: justify;
            margin-bottom: 30px;
        }
        .tte-section {
            width: 100%;
            margin-top: 40px;
            page-break-inside: avoid;
        }
        .tte-table {
            width: 100%;
            border-collapse: collapse;
        }
        .tte-table td {
            vertical-align: top;
        }
        .tte-box {
            border: 1px solid #1e293b;
            padding: 8px 12px;
            background-color: #f8fafc;
            border-radius: 4px;
            font-size: 9pt;
            line-height: 1.3;
        }
        .tte-badge {
            font-weight: bold;
            color: #065f46;
            text-transform: uppercase;
            font-size: 8.5pt;
        }
        .hash-code {
            font-family: monospace;
            font-size: 7.5pt;
            color: #475569;
            word-break: break-all;
        }
    </style>
</head>
<body>

    <!-- Kop Surat -->
    <div class="header">
        <h3>Pemerintah Kota Pekalongan</h3>
        <h2>Kecamatan Pekalongan Utara</h2>
        <p>Jalan Panjang Wetan No. 12 Pekalongan, Jawa Tengah | Telp: (0285) 421098</p>
    </div>

    <!-- Judul & Nomor SK -->
    <div class="title-box">
        <h4>KPUTUSAN CAMAT PEKALONGAN UTARA</h4>
        <p>NOMOR: {{ $submission->sk_number ?? '...../...../PKL-UTARA/' . date('Y') }}</p>
        <p style="margin-top: 10px; font-weight: bold; text-transform: uppercase;">
            TENTANG<br>
            {{ $submission->template->title }}
        </p>
    </div>

    <!-- Isi Dokumen (Dinamic Parsed Blade HTML) -->
    <div class="content">
        {!! $contentHtml !!}
    </div>

    <!-- Kolom Tanda Tangan Elektronik (TTE) -->
    <div class="tte-section">
        <table class="tte-table">
            <tr>
                <td style="width: 50%;"></td>
                <td style="width: 50%; text-align: center;">
                    <p style="margin-bottom: 5px;">Ditetapkan di Pekalongan</p>
                    <p style="margin-bottom: 10px;">Pada tanggal: {{ $submission->approved_at ? $submission->approved_at->translatedFormat('d F Y') : date('d F Y') }}</p>
                    <p style="font-weight: bold; text-transform: uppercase; margin-bottom: 10px;">
                        CAMAT PEKALONGAN UTARA
                    </p>

                    @if($submission->status === App\Enums\SubmissionStatus::APPROVED)
                        <div class="tte-box">
                            <div style="margin-bottom: 5px;">
                                <img src="{{ $qrCodeBase64 }}" alt="QR Code TTE" style="width: 100px; height: 100px;">
                            </div>
                            <div class="tte-badge">✓ DITANDATANGANI SECARA ELEKTRONIK</div>
                            <div style="margin-top: 3px; font-weight: bold;">
                                {{ $submission->approver->name ?? 'Camat Pekalongan Utara' }}
                            </div>
                            <div style="font-size: 8pt; color: #64748b;">NIP: {{ $submission->approver->nip ?? '-' }}</div>
                            <div style="margin-top: 5px;" class="hash-code">
                                SHA-256 Hash:<br>
                                {{ substr($submission->tte_hash, 0, 32) }}...
                            </div>
                        </div>
                    @else
                        <div style="height: 90px; border: 1px dashed #cbd5e1; display: flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 9pt; padding: 20px;">
                            (Draf Belum Disahkan / TTE Pending)
                        </div>
                    @endif
                </td>
            </tr>
        </table>
    </div>

</body>
</html>
