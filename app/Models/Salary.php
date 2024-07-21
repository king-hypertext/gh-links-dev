<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;
    protected $fillable = [
        'min_salary',
        'max_salary',
        'currency',
        'type'
    ];
    public function job()
    {
        return $this->belongsTo(Job::class, 'salary_id', 'id');
    }
}
