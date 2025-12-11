<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AffiliateProduct extends Model
{
    protected $fillable = [
        'product_image',
        'title',
        'sub_title',
        'slug',
        'affiliate_link',
        'description',
        'banner',
        'earnings',
        'is_top_product',
        'top_product_title',
        'is_recommended',
        'status',
        'category_id',
        'subcategory_id',
    ];

    public function category()
    {
        return $this->belongsTo(AffiliateCategory::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(AffiliateSubCategory::class, 'subcategory_id');
    }

    public function benefits()
    {
        return $this->hasMany(Benefit::class);
    }

    public function howItWorks()
    {
        return $this->hasMany(HowItWorks::class);
    }

    public function whomToSell()
    {
        return $this->hasMany(WhomToSell::class);
    }

    public function terms()
    {
        return $this->hasOne(TermsCondition::class);
    }

    public function termsCondition()
    {
        return $this->hasMany(TermsCondition::class, 'affiliate_product_id');
    }


    public function faqs()
    {
        return $this->hasMany(Faq::class);
    }

    public function trainingVideos()
    {
        return $this->hasMany(ProductTrainingVideo::class, 'affiliate_product_id');
    }


}
