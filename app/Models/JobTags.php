<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobTags extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'tags_id',
    ];
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id', 'id');
    }
    public function tag()
    {
        return $this->belongsTo(Tags::class, 'tag_id', 'id');
    }
}
