<?php

namespace App\Enums;

enum SubmissionStatus: string
{
    case DRAFT_KELURAHAN = 'draft_kelurahan';
    case REVIEW_KECAMATAN = 'review_kecamatan';
    case REVIEW_HUKUM = 'review_hukum';
    case READY_FOR_APPROVAL = 'ready_for_approval';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::DRAFT_KELURAHAN => 'Draf Kelurahan',
            self::REVIEW_KECAMATAN => 'Verifikasi Kecamatan',
            self::REVIEW_HUKUM => 'Penomoran Bagian Hukum',
            self::READY_FOR_APPROVAL => 'Siap Disetujui Camat',
            self::APPROVED => 'Disetujui & TTE (Approved)',
            self::REJECTED => 'Ditolak / Perlu Revisi',
        };
    }

    public function badgeClass(): string
    {
        return match ($this) {
            self::DRAFT_KELURAHAN => 'bg-gray-100 text-gray-800 border-gray-300',
            self::REVIEW_KECAMATAN => 'bg-yellow-100 text-yellow-800 border-yellow-300',
            self::REVIEW_HUKUM => 'bg-blue-100 text-blue-800 border-blue-300',
            self::READY_FOR_APPROVAL => 'bg-purple-100 text-purple-800 border-purple-300',
            self::APPROVED => 'bg-emerald-100 text-emerald-800 border-emerald-300',
            self::REJECTED => 'bg-rose-100 text-rose-800 border-rose-300',
        };
    }
}
