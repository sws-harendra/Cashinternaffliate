<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecruiterProfile extends Model
{
     protected $fillable = [
        'recruiter_id',
        'logo',
        'company_description',
        'industry',
        'company_size',
        'address',
        'website',
        'hr_name',
        'hr_contact'
    ];
}
