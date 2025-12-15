<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AffiliateProduct;
use App\Http\Controllers\Controller;

class RecommendedProductController extends Controller
{
     public function index()
    {
        $products = AffiliateProduct::with([
                'category:id,name',
                'subcategory:id,name',
                'earningLevels:id,affiliate_product_id,level_name,level_description,amount,level_order'
            ])
            ->where('status', 'active')
            ->where('is_recommended', true)
            ->orderByDesc('id')
            ->get();

        $data = $products->map(function ($p) {

            return [
                'id' => $p->id,
                'title' => $p->title,
                'sub_title' => $p->sub_title,
                'image' => $p->product_image
                    ? asset('uploads/affiliate-products/' . $p->product_image)
                    : null,

                'category' => $p->category->name ?? null,
                'subcategory' => $p->subcategory->name ?? null,

                'earnings' => (float) $p->earnings,
                'expiry_days' => $p->expiry_days,

                'earning_levels' => $p->earningLevels->map(function ($level) {
                    return [
                        'order' => $level->level_order,
                        'name' => $level->level_name,
                        'description' => $level->level_description,
                        'amount' => (float) $level->amount,
                    ];
                }),

                'is_top_product' => (bool) $p->is_top_product,
                'is_recommended' => true,
            ];
        });

        return response()->json([
            'success' => true,
            'count' => $data->count(),
            'data' => $data
        ]);
    }
}
