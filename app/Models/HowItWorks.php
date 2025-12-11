<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HowItWorks extends Model
{
    protected $fillable = ['affiliate_product_id', 'step_title'];

    public function product()
    {
        return $this->belongsTo(AffiliateProduct::class);
    }
}
