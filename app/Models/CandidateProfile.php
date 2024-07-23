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
    ];
    public function isProfileCompleted(): bool
    {
        if ($this->whereNotnull($this->first_name, $this->last_name, $this->profile_picture, $this->profile(), $this->resume(), $this->education())) {
            return false;
        }
        return true;
    }
    // public function profile()
    // {
    //     return $this->hasOne(CandidateProfile::class, 'candidate_profile_id', 'id');
    // }
    public function resume()
    {
        return $this->belongsTo(CandidateResume::class, 'id', 'candidate_profile_id');
    }
    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_profile_id', 'id');
    }
    // public function address()
    // {
    //     return $this->hasOne(CandidateAddress::class, 'candidate_profile_id', 'id');
    // }
    public function education()
    {
        return $this->belongsTo(CandidateEducationDetail::class, 'candidate_profile_id', 'id');
    }
    public function job_applications()
    {
        return $this->hasMany(JobApplication::class, 'candidate_profile_id', 'id');
    }
    public function job_experience()
    {
        return $this->hasOne(JobExperience::class, 'candidate_profile_id', 'id');
    }
}
