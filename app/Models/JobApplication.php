<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;
    protected $table = 'job_applications';
    protected $fillable = [
        'job_id',
        'candidate_profile_id',
        'applied_at',
        'status'
    ];
    public function job()
    {
        return $this->belongsTo(Job::class,  'job_id', 'id')->where('status', '=', 1);
    }
    public function candidate()
    {
        return $this->belongsTo(CandidateProfile::class, 'candidate_profile_id', 'id');
    }
}
