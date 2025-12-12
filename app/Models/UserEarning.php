<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEarning extends Model
{
    protected $table = 'user_earnings';
    protected $fillable = [
        'user_id',
        'affiliate_product_id',
        'click_id',
        'earning_level_id',
        'amount',
        'status',
    ];
}
