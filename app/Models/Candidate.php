<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;

class Candidate extends Authenticatable
{
    use HasFactory, Notifiable, HasRelationships;

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'phone_number',
        'email',
        'password',
        'accept_terms'
        // 'job_id', // foreign key for Job model
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
            'accept_terms' => 'boolean'
        ];
    }
}
