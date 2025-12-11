<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    protected $fillable = ['affiliate_product_id', 'benefit_title'];

    public function product()
    {
        return $this->belongsTo(AffiliateProduct::class);
    }
}
