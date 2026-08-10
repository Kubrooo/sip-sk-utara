<?php

namespace App\Models;

use App\Enums\SubmissionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkSubmission extends Model
{
    use HasFactory;

    protected $table = 'sk_submissions';

    protected $fillable = [
        'tracking_code',
        'template_id',
        'kelurahan_id',
        'field_values',
        'sk_number',
        'status',
        'revision_notes',
        'tte_hash',
        'approved_by',
        'approved_at',
        'final_pdf_path',
    ];

    protected $casts = [
        'field_values' => 'array',
        'status' => SubmissionStatus::class,
        'approved_at' => 'datetime',
    ];

    public function template()
    {
        return $this->belongsTo(SkTemplate::class, 'template_id');
    }

    public function kelurahan()
    {
        return $this->belongsTo(User::class, 'kelurahan_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function logs()
    {
        return $this->hasMany(SkLog::class, 'submission_id')->latest();
    }
}
