<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Recruiter extends Authenticatable
{
    use Notifiable;

    protected $table = 'recruiters';

    protected $fillable = [
        'recruiter_type',
        'name',
        'company_name',
        'email',
        'mobile',
        'password',
        'status',
        'is_email_verified',
        'is_mobile_verified',

    ];

    protected $hidden = [
        'password',
    ];
}
