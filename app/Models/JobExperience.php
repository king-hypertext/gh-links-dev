<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobExperience extends Model
{
    use HasFactory;
    protected $fillable = [
        'candidate_profile_id',
        'is_current',
        'position',
        'company',
        'company_location',
        'job_description',
        'position',
        'started_at',
        'ended_at',
    ];
    protected $table = 'job_experience';
    public function candidate()
    {
        return $this->belongsTo(CandidateProfile::class, 'candidate_profile_id', 'id');
    }
}
