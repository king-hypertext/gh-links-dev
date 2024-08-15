<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyPhoneNumber extends Model
{
    use HasFactory;
    protected $table = 'employer_phone_numbers';
    protected $fillable = [
        'number',
        'employer_id'
    ];
    public function employer()
    {
        return $this->belongsTo(Employer::class, 'employer_id', 'id');
    }
}
