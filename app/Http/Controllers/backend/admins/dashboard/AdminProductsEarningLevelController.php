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
        $levels = ProductEarningLevel::where('affiliate_product_id', $productId)->get();

        return view('backend.admins.pages.earning_levels.index', compact('product', 'levels'));
    }

    public function store(Request $request, $productId)
    {
        $request->validate([
            'level_name' => 'required',
            'level_description' => 'required',
            'amount' => 'required|numeric'
        ]);

        ProductEarningLevel::create([
            'affiliate_product_id' => $productId,
            'level_name' => $request->level_name,
            'level_description' => $request->level_description,
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
            'amount' => 'required|numeric'
        ]);

        $level = ProductEarningLevel::findOrFail($levelId);

        $level->update([
            'level_name' => $request->level_name,
            'level_description' => $request->level_description,
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
