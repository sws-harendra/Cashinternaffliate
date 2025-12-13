<?php

namespace App\Http\Controllers\backend\admins\dashboard;

use App\Models\HomeBanner;
use Illuminate\Http\Request;
use App\Models\AffiliateProduct;
use App\Http\Controllers\Controller;

class AdminHomeBannerController extends Controller
{
    public function index()
    {
        $banners = HomeBanner::with('product')->orderBy('id', 'DESC')->paginate(20);
        return view('backend.admins.pages.home_banner.index', compact('banners'));
    }

    public function create()
    {
        $products = AffiliateProduct::where('status', 'active')->get();
        return view('backend.admins.pages.home_banner.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'affiliate_product_id' => 'required',
            'banner' => 'required|image'
        ]);

        $fileName = time().'.'.$request->banner->extension();
        $request->banner->move(public_path('uploads/home-banners'), $fileName);

        HomeBanner::create([
            'title' => $request->title,
            'affiliate_product_id' => $request->affiliate_product_id,
            'banner' => $fileName
        ]);

        return redirect()->route('admins.home-banner.index')
            ->with('success', 'Home Banner Added Successfully');
    }

    public function edit($id)
    {
        $banner = HomeBanner::findOrFail($id);
        $products = AffiliateProduct::where('status', 'active')->get();

        return view('backend.admins.pages.home_banner.edit', compact('banner', 'products'));
    }

    public function update(Request $request, $id)
    {
        $banner = HomeBanner::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'affiliate_product_id' => 'required',
            'banner' => 'nullable|image'
        ]);

        $fileName = $banner->banner;

        if ($request->hasFile('banner')) {
            if (file_exists(public_path('uploads/home-banners/'.$fileName))) {
                unlink(public_path('uploads/home-banners/'.$fileName));
            }

            $fileName = time().'.'.$request->banner->extension();
            $request->banner->move(public_path('uploads/home-banners'), $fileName);
        }

        $banner->update([
            'title' => $request->title,
            'affiliate_product_id' => $request->affiliate_product_id,
            'banner' => $fileName
        ]);

        return redirect()->route('admins.home-banner.index')
            ->with('success', 'Home Banner Updated Successfully');
    }

    public function delete($id)
    {
        $banner = HomeBanner::findOrFail($id);

        if (file_exists(public_path('uploads/home-banners/'.$banner->banner))) {
            unlink(public_path('uploads/home-banners/'.$banner->banner));
        }

        $banner->delete();

        return back()->with('success', 'Home Banner Deleted');
    }
}
