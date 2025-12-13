<?php

namespace App\Http\Controllers\api;

use App\Models\HomeBanner;
use Illuminate\Http\Request;
use App\Models\AffiliateProduct;
use App\Models\AffiliateCategory;
use App\Http\Controllers\Controller;

class UserHomeController extends Controller
{
    public function homebanner()
    {
        $homebanner = HomeBanner::get();
        return response()->json($homebanner);
    }

    public function affiliatesCategory()
    {
        $categories = AffiliateCategory::with('subcategories.products')->get();

        $data = $categories->map(function ($category) {

            $totalEarning = 0;

            foreach ($category->subcategories as $sub) {
                $totalEarning += $sub->products->sum('earnings');
            }

            return [
                'id' => $category->id,
                'category' => $category,
                'total_earning' => $totalEarning,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }


    public function topProducts()
    {
        $products = AffiliateProduct::where('status', 'active')->where('is_top_product', 1)->get();
        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }


}
