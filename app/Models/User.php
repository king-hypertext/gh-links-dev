<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\Contracts\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRelationships;
    // , HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'accept_terms',
        'phone_number',
        'user_type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'accept_terms' => 'boolean',
            'user_type'=> 'integer',
        ];
    }
    public function isEmailVerified(): bool
    {
        if (!$this->email_verified_at) {
            return false;
        }
        return true;
    }
    public function employer()
    {
        return $this->hasOne(Employer::class, 'user_id', 'id');
    }
    public function candidate()
    {
        return $this->hasOne(Candidate::class, 'user_id', 'id');
    }
}
