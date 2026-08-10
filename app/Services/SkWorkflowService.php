<?php

namespace App\Services;

use App\Enums\SubmissionStatus;
use App\Models\SkLog;
use App\Models\SkSubmission;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SkWorkflowService
{
    /**
     * Generate Kode Tracking Unik untuk Draf SK Baru (Format: SK-YYYYMM-XXXX)
     */
    public function generateTrackingCode(): string
    {
        $prefix = 'SK-' . date('Ym') . '-';
        $latest = SkSubmission::where('tracking_code', 'LIKE', $prefix . '%')
            ->orderBy('id', 'desc')
            ->first();

        if (!$latest) {
            return $prefix . '0001';
        }

        $number = (int) substr($latest->tracking_code, -4);
        return $prefix . str_pad($number + 1, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Tahap 1: Inisiasi / Pengajuan draf oleh Admin Kelurahan
     */
    public function submitToKecamatan(SkSubmission $submission, User $user): SkSubmission
    {
        return DB::transaction(function () use ($submission, $user) {
            $submission->update([
                'status' => SubmissionStatus::REVIEW_KECAMATAN,
            ]);

            SkLog::create([
                'submission_id' => $submission->id,
                'user_id' => $user->id,
                'action' => 'SUBMITTED',
                'notes' => 'Draf SK berhasil diajukan ke Kecamatan.',
            ]);

            return $submission;
        });
    }

    /**
     * Tahap 2: Verifikasi Kecamatan -> Meneruskan ke Bagian Hukum
     */
    public function forwardToHukum(SkSubmission $submission, User $user): SkSubmission
    {
        return DB::transaction(function () use ($submission, $user) {
            $submission->update([
                'status' => SubmissionStatus::REVIEW_HUKUM,
            ]);

            SkLog::create([
                'submission_id' => $submission->id,
                'user_id' => $user->id,
                'action' => 'FORWARDED',
                'notes' => 'Draf SK telah diverifikasi teknis dan diteruskan ke Bagian Hukum.',
            ]);

            return $submission;
        });
    }

    /**
     * Tahap 3: Bagian Hukum (Setda) -> Terbitkan Nomor SK Resmi
     */
    public function assignSkNumber(SkSubmission $submission, User $user, string $skNumber): SkSubmission
    {
        return DB::transaction(function () use ($submission, $user, $skNumber) {
            $submission->update([
                'sk_number' => $skNumber,
                'status' => SubmissionStatus::READY_FOR_APPROVAL,
            ]);

            SkLog::create([
                'submission_id' => $submission->id,
                'user_id' => $user->id,
                'action' => 'NUMBERED',
                'notes' => 'Bagian Hukum menerbitkan Nomor SK Resmi: ' . $skNumber,
            ]);

            return $submission;
        });
    }

    /**
     * Tahap 4: Pengesahan Camat (TTE QR Code & Approved)
     */
    public function approveByCamat(SkSubmission $submission, User $user, string $tteHash, string $finalPdfPath): SkSubmission
    {
        return DB::transaction(function () use ($submission, $user, $tteHash, $finalPdfPath) {
            $submission->update([
                'status' => SubmissionStatus::APPROVED,
                'tte_hash' => $tteHash,
                'approved_by' => $user->id,
                'approved_at' => now(),
                'final_pdf_path' => $finalPdfPath,
            ]);

            SkLog::create([
                'submission_id' => $submission->id,
                'user_id' => $user->id,
                'action' => 'APPROVED',
                'notes' => 'Pengesahan Camat selesai dengan pembubuhan TTE QR Code.',
            ]);

            return $submission;
        });
    }

    /**
     * Kembalikan Draf untuk Revisi (oleh Kecamatan atau Hukum)
     */
    public function returnForRevision(SkSubmission $submission, User $user, string $notes): SkSubmission
    {
        return DB::transaction(function () use ($submission, $user, $notes) {
            $submission->update([
                'status' => SubmissionStatus::DRAFT_KELURAHAN,
                'revision_notes' => $notes,
            ]);

            SkLog::create([
                'submission_id' => $submission->id,
                'user_id' => $user->id,
                'action' => 'REVISED',
                'notes' => 'Draf dikembalikan ke Kelurahan dengan catatan revisi: ' . $notes,
            ]);

            return $submission;
        });
    }

    /**
     * Penolakan Draf SK
     */
    public function reject(SkSubmission $submission, User $user, string $notes): SkSubmission
    {
        return DB::transaction(function () use ($submission, $user, $notes) {
            $submission->update([
                'status' => SubmissionStatus::REJECTED,
                'revision_notes' => $notes,
            ]);

            SkLog::create([
                'submission_id' => $submission->id,
                'user_id' => $user->id,
                'action' => 'REJECTED',
                'notes' => 'Permohonan SK ditolak: ' . $notes,
            ]);

            return $submission;
        });
    }
}
