<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'kelurahan_name',
        'nip',
        'phone',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function submissions()
    {
        return $this->hasMany(SkSubmission::class, 'kelurahan_id');
    }

    public function approvedSubmissions()
    {
        return $this->hasMany(SkSubmission::class, 'approved_by');
    }

    public function logs()
    {
        return $this->hasMany(SkLog::class, 'user_id');
    }
}
