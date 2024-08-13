<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateEducationDetail extends Model
{
    use HasFactory;
    protected $table = 'candidate_education_detail';
    protected $fillable = [
        'candidate_id',
        'institution_name',
        'institution_location',
        'started_at',
        'ended_at',
    ];
    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id', 'id');
    }
}
