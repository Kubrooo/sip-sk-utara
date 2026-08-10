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
}
