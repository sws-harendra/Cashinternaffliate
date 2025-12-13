<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AffiliateCategory extends Model
{
    protected $table = 'affiliate_categories';

     protected $fillable = [
        'name',
        'slug',
        'description',
        'banner',
        'status',
    ];

     public function subcategories()
    {
        return $this->hasMany(AffiliateSubcategory::class, 'category_id');
    }
}
