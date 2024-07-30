<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $table = 'gh_jobs';
    protected $fillable = [
        'title',
        'type',
        'company_id',
        'min_salary',
        'max_salary',
        'description',
        'city_id',
        'benefits',
        'entry_id',
        'open_vacancies',
        'min_experience',
        'education_id',
        'salary_id',
        'requirements'
    ];
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
    public function company()
    {
        return $this->belongsTo(EmployerProfile::class, 'company_id', 'id');
    }
    public function education()
    {
        return $this->hasOne(Education::class, 'id', 'education_id');
    }
    public function salary()
    {
        return $this->hasOne(Salary::class, 'id', 'salary_id');
    }
    public function job_experience()
    {
        return $this->belongsTo(JobExperience::class, 'entry_id', 'id');
    }
    // public function company(){
    //     return $this->belongsTo(Company::class);
    // }
    // public function candidateApplications(){
    //     return $this->hasMany(CandidateApplication::class);
    // }
    // public function companyProfile(){
    //     return $this->belongsTo(CompanyProfile::class);
    // }
    public function candidate()
    {
        return $this->belongsTo(CandidateProfile::class,  'candidate_profile_id', 'id');
    }
    public function isSavedByUser(string $job_id = null): bool
    {
        $id = auth('candidate')->id();
        // return auth('candidate')->check() &&
        //     auth('candidate')->user()->profile->saved_jobs()->contains('candidate_profile_id', $id);
        return auth('candidate')->check() && auth('candidate')->user()->profile->saved_jobs()->where('job_id', $this->id)->exists();
        // ->where('candidate_profile_id', $id)->exists();
    }
    // public function is_saved(): bool
    // {
    //     if (auth('candidate')->check() && auth('candidate')->user()->profile->is_job_saved()) {
    //         return true;
    //     }
    //     return false;
    // }
    // public function 
}
