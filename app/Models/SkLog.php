<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkLog extends Model
{
    use HasFactory;

    protected $table = 'sk_logs';

    protected $fillable = [
        'submission_id',
        'user_id',
        'action',
        'notes',
    ];

    public function submission()
    {
        return $this->belongsTo(SkSubmission::class, 'submission_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
