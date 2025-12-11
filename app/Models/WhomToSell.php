<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhomToSell extends Model
{
    protected $table = 'whom_to_sell';
     protected $fillable = ['affiliate_product_id', 'target_audience'];

    public function product()
    {
        return $this->belongsTo(AffiliateProduct::class);
    }
}
