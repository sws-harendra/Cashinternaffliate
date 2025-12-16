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
        'is_active',

    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'is_email_verified' => 'boolean',
        'is_mobile_verified' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function profile()
    {
        return $this->hasOne(RecruiterProfile::class);
    }

    public function verification()
    {
        return $this->hasOne(RecruiterVerification::class);
    }
}
