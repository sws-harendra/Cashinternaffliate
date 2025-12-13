<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AffiliateSubCategory extends Model
{

    protected $table = 'affiliate_sub_categories';
    protected $fillable = [
        'name',
        'slug',
        'description',
        'banner',
        'category_id',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(AffiliateCategory::class, 'category_id');
    }

    public function products()
    {
        return $this->hasMany(AffiliateProduct::class, 'subcategory_id');
    }
}
