<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    protected $fillable = [
        'wallet_id',
        'user_id',
        'amount',
        'type',
        'status',
        'description',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

        public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

}
