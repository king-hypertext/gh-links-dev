<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'employer_profile_id',
        'banner_image',
        'logo_image',
    ];
    protected $table = 'employer_images';
    public function employerProfile()
    {
        return $this->belongsTo(EmployerProfile::class, 'employer_profile_id', 'id');
    }
}
