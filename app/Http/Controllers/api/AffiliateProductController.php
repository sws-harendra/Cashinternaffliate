<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AffiliateProduct;
use App\Http\Controllers\Controller;

class AffiliateProductController extends Controller
{
    public function productDetails($slug)
    {
        $product = AffiliateProduct::with([
            'category:id,name',
            'subcategory:id,name',
            'earningLevels',
            'benefits',
            'howItWorks',
            'whomToSell',
            'trainingVideos',
            'faqs',
            'termsCondition'
        ])
            ->where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => [
                'product' => [
                    'id' => $product->id,
                    'title' => $product->title,
                    'sub_title' => $product->sub_title,
                    'description' => $product->description,
                    'product_image' => $product->product_image,
                    'banner' => $product->banner,
                    'expiry_days' => $product->expiry_days,
                    'status' => $product->status,
                    'earning_upto' => $product->earningLevels->sum('amount'),
                ],

                'category' => [
                    'name' => $product->category->name ?? null,
                ],
                'subcategory' => [
                    'name' => $product->subcategory->name ?? null,
                ],
                'earning_levels' => $product->earningLevels->map(function ($level) {
                    return [
                        'order' => $level->level_order,
                        'name' => $level->level_name,
                        'description' => $level->level_description,
                        'amount' => $level->amount,
                    ];
                }),

           
                'benefits' => $product->benefits->pluck('benefit_title'),
                'how_it_works' => $product->howItWorks->pluck('step_title'),

    
                'whom_to_sell' => $product->whomToSell->pluck('target_audience'),
                'training_videos' => $product->trainingVideos->map(function ($video) {
                    return [
                        'title' => $video->video_title,
                        'url' => $video->video_url,
                    ];
                }),
                'faqs' => $product->faqs->map(function ($faq) {
                    return [
                        'question' => $faq->question,
                        'answer' => $faq->answer,
                    ];
                }),
                'terms_conditions' => $product->termsCondition->pluck('terms'),
            ]
        ]);
    }


    
}
