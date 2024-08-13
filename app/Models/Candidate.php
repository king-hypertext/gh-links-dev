<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'gender',
        'dp',
        'first_name',
        'last_name',
        'website_url',
        'marital_status',
        'location',
        'date_of_birth',
        'experience',
        'profession',
    ];

    public const CANDIDATE = 1;
    public function isProfileCompleted(): bool
    {
        return !is_null($this->user) && !is_null($this->education);
    }
    public function profileCompletion(): string
    {
        if (!is_null($this->user) && !is_null($this->education) && !is_null($this->biography) && !is_null($this->resume) && !is_null($this->email_verified_at)) {
            return "100%";
        }
        if (!is_null($this->user) && !is_null($this->education) && !is_null($this->biography) && !is_null($this->resume)) {
            return "95%";
        }
        if (!is_null($this->user) && !is_null($this->education) && !is_null($this->biography)) {
            return "80%";
        }
        if (!is_null($this->user) && !is_null($this->education)) {
            return "70%";
        }
        if (!is_null($this->user)) {
            return "50%";
        }
        return "0%";
    }
    public function education()
    {
        return $this->hasOne(CandidateEducationDetail::class, 'candidate_id', 'id');
    }
    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class, 'candidate_id', 'id');
    }
    public function resume()
    {
        return $this->hasOne(CandidateResume::class,  'candidate_id', 'id');
    }
    public function savedJobs()
    {
        return $this->hasMany(SavedJob::class, 'candidate_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,  'user_id', 'id');
    }
    public function isCandidateSaved(): bool
    {
        // dd(auth('employer')->user()->profile->saved_candidates()->where('candidate_profile_id', $this->id)->exists());
        return auth('employer')->check() && auth('employer')->user()->employer->savedCandidates()->where('candidate_id', $this->id)->exists();
    }
}
