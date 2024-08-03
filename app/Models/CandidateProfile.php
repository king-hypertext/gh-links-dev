<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateProfile extends Model
{
    use HasFactory;
    protected $table = 'candidate_profile';
    protected $fillable = [
        'candidate_id',
        'gender',
        'profile_picture',
        'first_name',
        'last_name',
        'website_url',
        'marital_status',
        'nationality',
        'current_salary',
        'location',
        'date_of_birth',
        'experience',
        'biography',
        'job_role'
    ];
    // public function isEmailVerified(): bool
    // {
    //     if ($this->candidate->email_verified_at !== null) {
    //         return true;
    //     }
    //     return false;
    // }
    public function isProfileCompleted(): bool
    {
        if ($this->whereNotnull($this->first_name,  $this->last_name, $this->experience, $this->profile_picture, $this->resume())) {
            return true;
        }
        return false;
    }
    public function resume()
    {
        return $this->hasOne(CandidateResume::class,  'candidate_profile_id', 'id');
    }
    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id', 'id');
    }
    // public function address()
    // {
    //     return $this->hasOne(CandidateAddress::class, 'candidate_profile_id', 'id');
    // }
    public function education()
    {
        return $this->hasOne(CandidateEducationDetail::class, 'candidate_profile_id', 'id');
    }
    public function job_applications()
    {
        return $this->hasMany(JobApplication::class, 'candidate_profile_id', 'id');
    }
    public function job_experience()
    {
        return $this->hasOne(CandidateJobExperience::class, 'candidate_profile_id', 'id');
    }
    public function saved_jobs()
    {
        return $this->hasMany(SavedJob::class, 'candidate_profile_id', 'id');
    }
    public function isCandidateSaved(): bool
    {
        // dd(auth('employer')->user()->profile->saved_candidates()->where('candidate_profile_id', $this->id)->exists());
        return auth('employer')->check() && auth('employer')->user()->profile->saved_candidates()->where('candidate_profile_id', $this->id)->exists();
    }
}
