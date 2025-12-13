<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvertiserCard extends Model
{
    protected $table = 'advertiser_card';

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'city',
        'state',
        'work_experience',
        'phone',
        'alternate_phone',
        'occupation',
        'qualification',
        'profile_image',
    ];
}
