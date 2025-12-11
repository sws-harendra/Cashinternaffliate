<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTrainingVideo extends Model
{
    protected $table = 'products_training_video';
    protected $fillable = ['affiliate_product_id', 'video_title', 'video_url'];

    public function product()
    {
        return $this->belongsTo(AffiliateProduct::class);
    }
}
