<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployerProfile extends Model
{
    use HasFactory;
    protected $table = 'employer_profiles';
    protected $fillable = [
        'employer_id',
        'company_name',
        'company_description',

        'organization_id',
        'industry_id',
        'company_size',
        'company_website',
        'company_founding_year',
        'company_vision',

        'company_location',
        'company_email',
    ];
    // a table has been created for phone numbers, images and social media accounts
    public function employer()
    {
        return $this->belongsTo(Employer::class, 'employer_id', 'id');
    }
    public function image()
    {
        return $this->hasOne(CompanyImage::class, 'employer_profile_id', 'id');
    }
    public function phoneNumbers()
    {
        return $this->hasMany(CompanyPhoneNumber::class, 'employer_profile_id', 'id');
    }
    public function socialMediaAccounts()
    {
        return $this->hasMany(CompanySocialMediaLink::class, 'employer_profile_id', 'id');
    }
    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }
    public function industry()
    {
        return $this->belongsTo(Industry::class, 'industry_id', 'id');
    }
}
