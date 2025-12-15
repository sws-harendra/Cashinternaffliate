<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferralEarning extends Model
{
    protected $table = 'referral_earnings';

    protected $fillable = ['referrer_user_id', 'total_earned'];
}
