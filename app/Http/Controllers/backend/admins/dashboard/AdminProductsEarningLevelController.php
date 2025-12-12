<?php

namespace App\Http\Controllers\backend\admins\dashboard;

use Illuminate\Http\Request;
use App\Models\AffiliateProduct;
use App\Models\ProductEarningLevel;
use App\Http\Controllers\Controller;

class AdminProductsEarningLevelController extends Controller
{
    public function index($productId)
    {
        $product = AffiliateProduct::findOrFail($productId);
        $levels = ProductEarningLevel::where('affiliate_product_id', $productId)->orderBy('level_order', 'ASC')->get();

        return view('backend.admins.pages.earning_levels.index', compact('product', 'levels'));
    }

    public function store(Request $request, $productId)
    {
        $request->validate([
            'level_name' => 'required',
            'level_description' => 'required',
            'amount' => 'required|numeric',
            'level_order' => 'required|integer|min:1'
        ]);

        // Check duplicate level_order for same product
        $exists = ProductEarningLevel::where('affiliate_product_id', $productId)
            ->where('level_order', $request->level_order)
            ->exists();

        if ($exists) {
            return back()->with('error', 'This Level Order is already used for this product.');
        }

        ProductEarningLevel::create([
            'affiliate_product_id' => $productId,
            'level_name' => $request->level_name,
            'level_description' => $request->level_description,
            'level_order' => $request->level_order,
            'amount' => $request->amount
        ]);

        return back()->with('success', 'Earning Level Added Successfully!');
    }



    public function edit($levelId)
    {
        $level = ProductEarningLevel::findOrFail($levelId);
        return view('backend.admins.pages.earning_levels.edit', compact('level'));
    }

    public function update(Request $request, $levelId)
    {
        $request->validate([
            'level_name' => 'required',
            'level_description' => 'required',
            'amount' => 'required|numeric',
            'level_order' => 'required|integer|min:1'
        ]);

        $level = ProductEarningLevel::findOrFail($levelId);


        // Prevent duplicate order for same product
        $exists = ProductEarningLevel::where('affiliate_product_id', $level->affiliate_product_id)
            ->where('level_order', $request->level_order)
            ->where('id', '!=', $level->id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'This Level Order is already assigned to another level for this product.');
        }

        $level->update([
            'level_name' => $request->level_name,
            'level_description' => $request->level_description,
            'level_order' => $request->level_order,
            'amount' => $request->amount
        ]);

        return redirect()
            ->route('admins.earning-levels.index', $level->affiliate_product_id)
            ->with('success', 'Earning Level Updated Successfully!');
    }



    public function delete($levelId)
    {
        $level = ProductEarningLevel::findOrFail($levelId);
        $productId = $level->affiliate_product_id;
        $level->delete();

        return back()->with('success', 'Level Deleted Successfully!');
    }
}
