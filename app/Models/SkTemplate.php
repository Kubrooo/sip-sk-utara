<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkTemplate extends Model
{
    use HasFactory;

    protected $table = 'sk_templates';

    protected $fillable = [
        'code',
        'title',
        'html_template',
        'dynamic_fields',
        'is_active',
    ];

    protected $casts = [
        'dynamic_fields' => 'array',
        'is_active' => 'boolean',
    ];

    public function submissions()
    {
        return $this->hasMany(SkSubmission::class, 'template_id');
    }
}
