<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    protected $table = 'employers';
    protected $fillable = [
        'user_id',
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
    public function businessVerification()
    {
        return $this->hasOne(BusinessVerification::class, 'employer_id', 'id');
    }
    public function isBusinessVerified(): bool
    {
        return !is_null($this->businessVerification);
    }
    public function profileCompletion(): string
    {
        return '0%';
    }
    public function isProfileCompleted(): bool
    {
        return false;
    }
    public function user()
    {
        return $this->belongsTo(User::class,  'user_id', 'id');
    }
    public function image()
    {
        return $this->hasOne(Image::class, 'employer_id', 'id');
    }
    public function phoneNumbers()
    {
        return $this->hasMany(CompanyPhoneNumber::class, 'employer_id', 'id');
    }
    public function socialMediaAccounts()
    {
        return $this->hasMany(CompanySocialMediaLink::class, 'employer_id', 'id');
    }
    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }
    public function industry()
    {
        return $this->belongsTo(Industry::class, 'industry_id', 'id');
    }
    // works to be done here
    // public function jobApplications()
    // {
    //     return $this->hasMany(CandidateApplication::class,'job_id', $this->jobs->contains('id'));
    // }
    public function activeJobs()
    {
        return $this->hasMany(Job::class, 'employer_id', 'id')->where('status', 1);
    }
    public function jobs()
    {
        return $this->hasMany(Job::class, 'employer_id', 'id');
    }
    public function savedCandidates()
    {
        return $this->hasMany(SavedCandidate::class, 'employer_id', 'id');
    }
}
