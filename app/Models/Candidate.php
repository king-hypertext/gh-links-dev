<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;

class Candidate extends Authenticatable
{
    use HasFactory, Notifiable, HasRelationships;
    public function __construct()
    {
        return $this->isEmailVerified();
    }
    protected $fillable = [
        // 'first_name',
        // 'last_name',
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
    public function isEmailVerified(): bool
    {
        if ($this->email_verified_at !== null) {
            return true;
        }
        return false;
    }
    public function profile()
    {
        return $this->hasOne(CandidateProfile::class, 'candidate_id', 'id');
    }
}
