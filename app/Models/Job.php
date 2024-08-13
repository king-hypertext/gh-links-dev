<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job extends Model
{
    use HasFactory;
    protected $table = 'gh_jobs';
    protected $fillable = [
        'title',
        'type',
        'employer_id',
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
        'requirements',
        'status'
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
    public function tags()
    {
        // return $this->hasMany(JobTags::class, 'job_id', 'id');
        return $this->belongsToMany(Tags::class);
    }
    public function employer()
    {
        return $this->belongsTo(EmployerProfile::class, 'employer_id', 'id');
    }
    public function education()
    {
        return $this->hasOne(Education::class, 'id', 'education_id');
    }
    public function salary()
    {
        return $this->hasOne(Salary::class, 'id', 'salary_id');
    }
    public function entry()
    {
        return $this->belongsTo(JobExperience::class, 'entry_id', 'id');
    }

    public function isSavedByUser(string $job_id = null): bool
    {
        return auth('candidate')->check() && auth('candidate')->user()->candidate?->savedJobs()->where('job_id', $this->id)->exists();
    }
    public function isAppliedByUser(): bool
    {
        return auth('candidate')->check() && auth('candidate')->user()->candidate?->jobApplications()->where('job_id', $this->id)->exists();
    }
    public function applications()
    {
        return $this->hasMany(JobApplication::class, 'job_id', 'id');
    }
}
