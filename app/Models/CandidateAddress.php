<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateAddress extends Model
{
    use HasFactory;
    // protected $fillable =[
    //     ''
    // ];
    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_profile_id', 'id');
    }
}
