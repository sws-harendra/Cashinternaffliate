<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductEarningLevel extends Model
{
    protected $table = 'products_earning_levels';
    protected $fillable = ['affiliate_product_id', 'level_name', 'level_description', 'level_order', 'amount'];

    public function product()
    {
        return $this->belongsTo(AffiliateProduct::class, 'affiliate_product_id');
    }
}
