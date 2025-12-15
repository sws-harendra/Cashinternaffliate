<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\AffiliateProduct;
use App\Models\AffiliateCategory;
use App\Http\Controllers\Controller;

class AffiliateController extends Controller
{
    public function categoryProducts(Request $request, $categoryId)
    {
        $subcategoryId = $request->query('subcategory_id', 'ALL');

        // Category
        $category = AffiliateCategory::findOrFail($categoryId);

        // Subcategories (for filter tabs)
        $subcategories = $category->subcategories()
            ->where('status', 'active')
            ->select('id', 'name')
            ->get();

        // Products query
        $productsQuery = AffiliateProduct::with([
            'subcategory:id,name',
            'benefits',
            'earningLevels:id,affiliate_product_id,level_name,level_description,amount,level_order'
        ])
            ->where('category_id', $categoryId)
            ->where('status', 'active');

        if ($subcategoryId !== 'ALL') {
            $productsQuery->where('subcategory_id', $subcategoryId);
        }

        $products = $productsQuery->get()->map(function ($product) {
            return [
                'id' => $product->id,
                'title' => $product->title,
                'slug' => $product->slug,
                'product_image' => $product->product_image,
                'earnings_label' => 'Earn up to ₹' . $product->earningLevels->sum('amount'),

                // SUBCATEGORY INFO
                'subcategory' => [
                    'id' => $product->subcategory->id ?? null,
                    'name' => $product->subcategory->name ?? null,
                ],

                // BENEFITS
                'benefits' => $product->benefits->map(function ($benefit) {
                    return [
                        'id' => $benefit->id,
                        'title' => $benefit->benefit_title,
                    
                    ];
                }),

                // ALL LEVELS
                'earning_levels' => $product->earningLevels->map(function ($level) {
                    return [
                        'id' => $level->id,
                        'order' => $level->level_order,
                        'name' => $level->level_name,
                        'description' => $level->level_description,
                        'amount' => $level->amount,
                    ];
                }),
            ];
        });


        return response()->json([
            'success' => true,
            'data' => [
                'category' => [
                    'id' => $category->id,
                    'name' => $category->name,
                    'description' => $category->description,
                    'banner' => $category->banner
                ],

                // FILTER TABS
                'filters' => collect([
                    ['id' => 'ALL', 'name' => 'All']
                ])->merge($subcategories)->values(),

                // PRODUCTS
                'products' => $products
            ]
        ]);

    }

}