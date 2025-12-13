<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeBanner extends Model
{
     protected $table = 'home_banner';

    protected $fillable = [
        'title',
        'banner',
        'affiliate_product_id'
    ];

    public function product()
    {
        return $this->belongsTo(AffiliateProduct::class, 'affiliate_product_id');
    }
}
