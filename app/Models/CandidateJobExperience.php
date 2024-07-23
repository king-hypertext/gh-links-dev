<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateJobExperience extends Model
{
    use HasFactory;
    protected $table = 'job_experience';
    protected $fillable =[
        'candidate_profile_id',
        'is_current',
        'started_at',
        'ended_at',
        'position',
        'job_description',
        'company_name',
        'location',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_profile_id', 'id');
    }
}
