<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TermsCondition extends Model
{
    protected $table = 'terms_condition';
    protected $fillable = ['affiliate_product_id', 'terms'];

    public function product()
    {
        return $this->belongsTo(AffiliateProduct::class);
    }
}
