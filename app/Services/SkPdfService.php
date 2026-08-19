<?php

namespace App\Services;

use App\Models\SkSubmission;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class SkPdfService
{
    /**
     * Generate SHA-256 Security Hash for TTE Verification
     */
    public function generateHash(SkSubmission $submission): string
    {
        $payload = implode('|', [
            $submission->id,
            $submission->tracking_code,
            $submission->sk_number ?? 'NOSK',
            $submission->created_at?->timestamp ?? time(),
            config('app.key'),
        ]);

        return hash('sha256', $payload);
    }

    /**
     * Generate Base64 QR Code image string for PDF embedding
     */
    public function generateQrCodeBase64(string $url): string
    {
        $svg = QrCode::format('svg')->size(120)->margin(1)->generate($url);
        return 'data:image/svg+xml;base64,' . base64_encode($svg);
    }

    /**
     * Parse HTML Template replacing dynamic field placeholders {{field_name}}
     */
    public function parseTemplateContent(string $htmlTemplate, array $fieldValues): string
    {
        $parsed = $htmlTemplate;
        foreach ($fieldValues as $key => $value) {
            $valStr = is_array($value) ? implode(', ', $value) : (string) $value;
            $parsed = str_replace('{{' . $key . '}}', e($valStr), $parsed);
            $parsed = str_replace('{{ ' . $key . ' }}', e($valStr), $parsed);
        }
        return $parsed;
    }

    /**
     * Generate DomPDF object for a submission
     */
    public function generatePdf(SkSubmission $submission)
    {
        $template = $submission->template;
        $fieldValues = $submission->field_values ?? [];
        $contentHtml = $this->parseTemplateContent($template->html_template, $fieldValues);

        $verifyUrl = route('public.verify', ['hash' => $submission->tte_hash ?? 'PREVIEW']);
        $qrCodeBase64 = $this->generateQrCodeBase64($verifyUrl);

        $pdf = Pdf::loadView('pdf.sk-document', [
            'submission' => $submission,
            'contentHtml' => $contentHtml,
            'qrCodeBase64' => $qrCodeBase64,
            'verifyUrl' => $verifyUrl,
        ]);

        $pdf->setPaper('A4', 'portrait');

        return $pdf;
    }

    /**
     * Save PDF file to storage and return public relative path
     */
    public function storePdfToStorage(SkSubmission $submission): string
    {
        $pdf = $this->generatePdf($submission);
        $filename = 'sk_documents/' . $submission->tracking_code . '_' . time() . '.pdf';

        Storage::disk('public')->put($filename, $pdf->output());

        return $filename;
    }
}
