<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    protected $fillable = [
        'education_level',
        'institution_name',
        'graduation_date',
    ];
    protected $table = 'education';
    public function job()
    {
        return $this->belongsTo(Job::class, 'education_id', 'id');
    }
}
