<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $table = 'wallets';
    protected $fillable = [
        'user_id',
        'uuid',
        'collection',
        'balance',
        'hold_balance',
        'total_withdraw',
        'refer_balance',
        'status',
    ];
}
