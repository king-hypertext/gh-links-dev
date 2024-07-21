<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobExperience extends Model
{
    use HasFactory;
    protected $fillable = [
        'job_title',
        'company_name',
        'start_date',
        'end_date',
    ];
    protected $table = 'job_experience';
    public function job()
    {
        return $this->belongsTo(Job::class, 'entry_id', 'id');
    }
}
