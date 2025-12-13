<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WithdrawRequest extends Model
{
    protected $table = 'withdraw_requests';

    protected $fillable = [
        'user_id',
        'wallet_id',
        'payment_method_id',
        'amount',
        'status',
        'rejection_reason',
        'processed_at',
        'processed_by'
    ];

    public function paymentMethod()
    {
        return $this->belongsTo(UserPaymentMethod::class, 'payment_method_id');
    }

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id',   // FK in withdraw_requests
            'uuid'       // users.uuid
        );
    }

    public function wallet()
    {
        return $this->belongsTo(
            Wallet::class,
            'wallet_id',
            'id'
        );
    }
}
