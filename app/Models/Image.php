<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'employer_id',
        'banner',
        'logo',
    ];
    public function employer()
    {
        return $this->belongsTo(Employer::class, 'employer_id', 'id');
    }
}
