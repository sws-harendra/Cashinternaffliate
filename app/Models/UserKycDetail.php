<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserKycDetail extends Model
{
    protected $table = 'user_kyc_details';

    protected $fillable = [
        'user_id',
        'pan_number',
        'aadhar_number',
        'pan_image',
        'aadhar_front_image',
        'aadhar_back_image',
        'address',
        'kyc_status',
        'rejection_reason',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
