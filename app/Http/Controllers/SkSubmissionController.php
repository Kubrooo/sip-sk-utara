<?php

namespace App\Http\Controllers;

use App\Enums\SubmissionStatus;
use App\Models\SkSubmission;
use App\Models\SkTemplate;
use App\Services\SkPdfService;
use App\Services\SkWorkflowService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkSubmissionController extends Controller
{
    protected SkWorkflowService $workflowService;
    protected SkPdfService $pdfService;

    public function __construct(SkWorkflowService $workflowService, SkPdfService $pdfService)
    {
        $this->workflowService = $workflowService;
        $this->pdfService = $pdfService;
    }

    /**
     * Display listing of SK submissions.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = SkSubmission::with(['template', 'kelurahan', 'approver'])->latest();

        // Admin Kelurahan only sees their own submissions
        if ($user->hasRole('admin_kelurahan')) {
            $query->where('kelurahan_id', $user->id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $submissions = $query->paginate(10);
        $templates = SkTemplate::where('is_active', true)->get();

        return view('submissions.index', compact('submissions', 'templates'));
    }

    /**
     * Show form for creating a new SK submission.
     */
    public function create(Request $request)
    {
        $templateId = $request->query('template_id');
        $selectedTemplate = $templateId ? SkTemplate::findOrFail($templateId) : SkTemplate::where('is_active', true)->first();
        $templates = SkTemplate::where('is_active', true)->get();

        if (!$selectedTemplate) {
            return redirect()->route('templates.index')->with('error', 'Belum ada Template SK aktif. Silakan buat template terlebih dahulu.');
        }

        return view('submissions.create', compact('selectedTemplate', 'templates'));
    }

    /**
     * Store newly created SK submission in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'template_id' => ['required', 'exists:sk_templates,id'],
            'field_values' => ['required', 'array'],
        ]);

        $template = SkTemplate::findOrFail($request->template_id);
        $trackingCode = $this->workflowService->generateTrackingCode();

        $submission = SkSubmission::create([
            'tracking_code' => $trackingCode,
            'template_id' => $template->id,
            'kelurahan_id' => Auth::id(),
            'field_values' => $request->field_values,
            'status' => SubmissionStatus::DRAFT_KELURAHAN,
        ]);

        return redirect()->route('submissions.show', $submission)->with('success', 'Draf Permohonan SK berhasil dibuat dengan Kode Tracking: ' . $trackingCode);
    }

    /**
     * Display the specified SK submission detail & audit trail logs.
     */
    public function show(SkSubmission $submission)
    {
        $submission->load(['template', 'kelurahan', 'approver', 'logs.user']);
        return view('submissions.show', compact('submission'));
    }

    /**
     * Show form for editing an existing submission draft.
     */
    public function edit(SkSubmission $submission)
    {
        if (!in_array($submission->status, [SubmissionStatus::DRAFT_KELURAHAN, SubmissionStatus::REJECTED])) {
            return back()->with('error', 'Permohonan ini sedang dalam proses verifikasi dan tidak dapat diubah.');
        }

        $template = $submission->template;
        return view('submissions.edit', compact('submission', 'template'));
    }

    /**
     * Update the specified submission draft in storage.
     */
    public function update(Request $request, SkSubmission $submission)
    {
        if (!in_array($submission->status, [SubmissionStatus::DRAFT_KELURAHAN, SubmissionStatus::REJECTED])) {
            return back()->with('error', 'Permohonan ini sedang dalam proses verifikasi dan tidak dapat diubah.');
        }

        $request->validate([
            'field_values' => ['required', 'array'],
        ]);

        $submission->update([
            'field_values' => $request->field_values,
        ]);

        return redirect()->route('submissions.show', $submission)->with('success', 'Draf SK berhasil diperbarui.');
    }

    /**
     * Ajukan Draf SK dari Kelurahan ke Kecamatan (Status: REVIEW_KECAMATAN)
     */
    public function submitToKecamatan(SkSubmission $submission)
    {
        if ($submission->status !== SubmissionStatus::DRAFT_KELURAHAN) {
            return back()->with('error', 'Hanya Draf Kelurahan yang dapat diajukan.');
        }

        $this->workflowService->submitToKecamatan($submission, Auth::user());

        return redirect()->route('submissions.show', $submission)->with('success', 'Draf SK berhasil diajukan ke Kecamatan untuk verifikasi teknis.');
    }

    /**
     * Download / Stream PDF SK Document
     */
    public function downloadPdf(SkSubmission $submission)
    {
        $pdf = $this->pdfService->generatePdf($submission);
        $filename = 'SK_' . ($submission->sk_number ? str_replace('/', '_', $submission->sk_number) : $submission->tracking_code) . '.pdf';

        return $pdf->stream($filename);
    }
}
