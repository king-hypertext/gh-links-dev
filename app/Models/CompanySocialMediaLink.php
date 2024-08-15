<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySocialMediaLink extends Model
{
    use HasFactory;
    protected $table = 'employer_social_media_links';
    protected $fillable = [
        'employer_id',
        'fb',
        'x',
        'linkedin',
        'instagram',
        'whatsapp',
    ];
    public function employer()
    {
        return $this->belongsTo(Employer::class, 'employer_id', 'id');
    }
}
