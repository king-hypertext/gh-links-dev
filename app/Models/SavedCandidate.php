<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedCandidate extends Model
{
    use HasFactory;
    protected $fillable = [
        'candidate_profile_id',
        'employer_profile_id',
    ];
    public function profile()
    {
        return $this->belongsTo(EmployerProfile::class, 'employer_profile_id', 'id');
    }
    public function candidate()
    {
        return $this->belongsTo(CandidateProfile::class, 'candidate_profile_id', 'id');
    }
}
