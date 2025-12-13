<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPaymentMethod extends Model
{
    protected $table = 'user_payment_methods';
    protected $fillable = [
        'user_id',
        'type',
        'holder_name',
        'upi_id',
        'bank_name',
        'account_number',
        'ifsc_code',
        'branch',
        'verification_status',
        'rejection_reason',
        'verified_at',
        'verified_by',
        'is_default',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id', 'uuid' );
    }

}
