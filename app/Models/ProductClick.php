<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductClick extends Model
{
    protected $fillable = [
        'lead_id',
        'affiliate_product_id',
        'user_id',
        'click_id',
        'sub_aff_id',
        'ip',
        'user_agent',
        'referrer',
        'status',
        'is_converted',
        'clicked_at',
        'converted_at',
    ];

    public function product()
    {
        return $this->belongsTo(AffiliateProduct::class, 'affiliate_product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'uuid');
    }


    public function isExpired()
    {
        if (!$this->product || !$this->product->expiry_days || !$this->clicked_at) {
            return false;
        }

        $expiry = \Carbon\Carbon::parse($this->clicked_at)->addDays($this->product->expiry_days);

        return now()->greaterThan($expiry);
    }

    public function expiryDate()
    {
        if (!$this->clicked_at) {
            return null;
        }

        return \Carbon\Carbon::parse($this->clicked_at)->addDays($this->product->expiry_days);
    }


    protected $casts = [
        'clicked_at' => 'datetime',
    ];


}
