<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedJob extends Model
{
    use HasFactory;
    protected $table = 'saved_jobs';
    protected $fillable = [
        'candidate_profile_id',
        'job_id',
    ];
    public function profile()
    {
        return $this->belongsTo(CandidateProfile::class, 'candidate_profile_id', 'id');
    }
    public function job(){
        return $this->belongsTo(Job::class, 'job_id', 'id');
    }
}
