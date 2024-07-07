<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployerProfile extends Model
{
    use HasFactory;
    protected $fillable=[
        'employer_id',
        'company_name',
        'company_logo',
        'company_banner',
        'company_description',

        'company_type_id',
        'company_industry_id',
        'company_size',
        'company_website',
        'company_founding_year',
        'company_vision',

        'company_location',
        'company_email',
        // 'company_phone',
        // 'company_employees',
        // 'company_social_media',
    ];
    // a table to be created for phone numbers and social media accounts
}
