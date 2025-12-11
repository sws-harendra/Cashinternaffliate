<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'faq';
    protected $fillable = ['affiliate_product_id', 'question', 'answer'];

    public function product()
    {
        return $this->belongsTo(AffiliateProduct::class);
    }
}
