<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessVerification extends Model
{
    use HasFactory;
    protected $fillable = [
        'employer_id',
        'reg_certificate_number',
        'reg_certificate',
        'tin_number',
        'tin',
        'ssnit_number',
        'ssnit'
    ];
    public function employer()
    {
        return $this->belongsTo(Employer::class, 'employer_id', 'id');
    }
}
