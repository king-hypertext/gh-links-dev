<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedCandidate extends Model
{
    use HasFactory;
    protected $fillable = [
        'candidate_id',
        'employer_id',
    ];
    public function employer()
    {
        return $this->belongsTo(Employer::class, 'employer_id', 'id');
    }
    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id', 'id');
    }
}
