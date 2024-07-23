<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateEducationDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'candidate_profile_id',
        'institution_name',
        'institution_location',
        'level',
        'started_at',
        'eneded_at',
    ];
    public function candidate()
    {
        return $this->belongsTo(CandidateProfile::class, 'candidate_id', 'id');
    }
}
