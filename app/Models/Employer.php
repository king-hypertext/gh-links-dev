<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employer extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'phone_number',
        'email',
        'about',
        'accept_terms',
        'password',
        // 'job_id', // foreign key for Job model
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function profile()
    {
        return $this->hasOne(EmployerProfile::class, 'employer_id', 'id');
    }
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'accept_terms' => 'boolean'
        ];
    }
}
