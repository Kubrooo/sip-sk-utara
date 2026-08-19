<?php

namespace App\Http\Controllers;

use App\Enums\SubmissionStatus;
use App\Models\SkSubmission;
use App\Services\SkPdfService;
use App\Services\SkWorkflowService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkVerificationController extends Controller
{
    protected SkWorkflowService $workflowService;
    protected SkPdfService $pdfService;

    public function __construct(SkWorkflowService $workflowService, SkPdfService $pdfService)
    {
        $this->workflowService = $workflowService;
        $this->pdfService = $pdfService;
    }

    /**
     * Tahap 2: Daftar Verifikasi Teknis Admin Kecamatan
     */
    public function kecamatanIndex()
    {
        $submissions = SkSubmission::with(['template', 'kelurahan'])
            ->where('status', SubmissionStatus::REVIEW_KECAMATAN)
            ->latest()
            ->paginate(10);

        return view('verification.kecamatan-index', compact('submissions'));
    }

    /**
     * Admin Kecamatan Meneruskan ke Setda Bagian Hukum
     */
    public function forwardToHukum(SkSubmission $submission)
    {
        if ($submission->status !== SubmissionStatus::REVIEW_KECAMATAN) {
            return back()->with('error', 'Status permohonan tidak sesuai untuk diteruskan.');
        }

        $this->workflowService->forwardToHukum($submission, Auth::user());

        return redirect()->route('verification.kecamatan')->with('success', 'Permohonan SK berhasil diverifikasi teknis dan diteruskan ke Bagian Hukum Setda.');
    }

    /**
     * Tahap 3: Daftar Penomoran Resmi Bagian Hukum (Setda)
     */
    public function hukumIndex()
    {
        $submissions = SkSubmission::with(['template', 'kelurahan'])
            ->where('status', SubmissionStatus::REVIEW_HUKUM)
            ->latest()
            ->paginate(10);

        return view('verification.hukum-index', compact('submissions'));
    }

    /**
     * Bagian Hukum Menerbitkan Nomor SK Resmi
     */
    public function assignNumber(Request $request, SkSubmission $submission)
    {
        if ($submission->status !== SubmissionStatus::REVIEW_HUKUM) {
            return back()->with('error', 'Status permohonan tidak sesuai untuk penerbitan nomor.');
        }

        $request->validate([
            'sk_number' => ['required', 'string', 'max:100'],
        ]);

        $this->workflowService->assignSkNumber($submission, Auth::user(), $request->sk_number);

        return redirect()->route('verification.hukum')->with('success', 'Nomor SK Resmi (' . $request->sk_number . ') berhasil diterbitkan. Draf diteruskan ke Camat.');
    }

    /**
     * Tahap 4: Daftar Pengesahan & TTE Camat
     */
    public function camatIndex()
    {
        $submissions = SkSubmission::with(['template', 'kelurahan'])
            ->where('status', SubmissionStatus::READY_FOR_APPROVAL)
            ->latest()
            ->paginate(10);

        return view('verification.camat-index', compact('submissions'));
    }

    /**
     * Camat Pengesahan & Pembubuhan TTE QR Code
     */
    public function approveCamat(SkSubmission $submission)
    {
        if ($submission->status !== SubmissionStatus::READY_FOR_APPROVAL) {
            return back()->with('error', 'Status permohonan tidak sesuai untuk pengesahan Camat.');
        }

        // Generate SHA-256 Hash and store final PDF
        $tteHash = $this->pdfService->generateHash($submission);
        $submission->tte_hash = $tteHash;
        $submission->approved_by = Auth::id();
        $submission->approved_at = now();

        $pdfPath = $this->pdfService->storePdfToStorage($submission);

        $this->workflowService->approveByCamat($submission, Auth::user(), $tteHash, $pdfPath);

        return redirect()->route('verification.camat')->with('success', 'Dokumen SK berhasil disahkan dan dibubuhi TTE QR Code.');
    }

    /**
     * Kembalikan Draf ke Kelurahan untuk Revisi
     */
    public function returnRevision(Request $request, SkSubmission $submission)
    {
        $request->validate([
            'notes' => ['required', 'string', 'max:1000'],
        ]);

        $this->workflowService->returnForRevision($submission, Auth::user(), $request->notes);

        return back()->with('success', 'Draf SK berhasil dikembalikan ke Kelurahan dengan catatan revisi.');
    }
}
