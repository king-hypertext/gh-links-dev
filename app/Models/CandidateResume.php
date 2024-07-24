<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateResume extends Model
{
    use HasFactory;
    protected $table = 'candidate_resume';
    protected $fillable =[
        'candidate_profile_id',
        'name',
        'file'
    ];
    public function profile(){
        return $this->belongsTo(CandidateProfile::class, 'candidate_profile_id', 'id');
    }
}
