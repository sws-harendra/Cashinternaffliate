<?php

namespace App\Http\Controllers\backend\admins\dashboard;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\AffiliateCategory;
use App\Http\Controllers\Controller;
use App\Models\AffiliateSubCategory;

class AdminAffiliateSubCategoryController extends Controller
{
     public function index()
    {
        $subcategories = AffiliateSubCategory::with('category')->latest()->paginate(20);
        return view('backend.admins.pages.affiliate_sub_categories.index', compact('subcategories'));
    }

    public function create()
    {
        $categories = AffiliateCategory::where('status', 'active')->get();
        return view('backend.admins.pages.affiliate_sub_categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'slug'        => 'required|unique:affiliate_sub_categories',
            'category_id' => 'required|exists:affiliate_categories,id',
            'banner'      => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
        ]);

        $bannerName = null;

        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $bannerName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/affiliate-subcategories'), $bannerName);
        }

        AffiliateSubCategory::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->slug),
            'description' => $request->description,
            'banner'      => $bannerName,
            'category_id' => $request->category_id,
            'status'      => $request->status ?? 'active',
        ]);

        return redirect()->route('admins.affiliate-subcategories.index')
            ->with('success', 'Sub Category Created Successfully!');
    }

    public function edit($id)
    {
        $subcategory = AffiliateSubCategory::findOrFail($id);
        $categories = AffiliateCategory::where('status', 'active')->get();

        return view('backend.admins.pages.affiliate_sub_categories.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $subcategory = AffiliateSubCategory::findOrFail($id);

        $request->validate([
            'name'        => 'required',
            'slug'        => 'required|unique:affiliate_sub_categories,slug,' . $id,
            'category_id' => 'required|exists:affiliate_categories,id',
            'banner'      => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
        ]);

        $bannerName = $subcategory->banner;

        if ($request->hasFile('banner')) {
            if ($bannerName && file_exists(public_path('uploads/affiliate-subcategories/' . $bannerName))) {
                unlink(public_path('uploads/affiliate-subcategories/' . $bannerName));
            }

            $file = $request->file('banner');
            $bannerName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/affiliate-subcategories'), $bannerName);
        }

        $subcategory->update([
            'name'        => $request->name,
            'slug'        => Str::slug($request->slug),
            'description' => $request->description,
            'banner'      => $bannerName,
            'category_id' => $request->category_id,
            'status'      => $request->status,
        ]);

        return redirect()->route('admins.affiliate-subcategories.index')
            ->with('success', 'Sub Category Updated Successfully!');
    }

    public function delete($id)
    {
        $subcategory = AffiliateSubCategory::findOrFail($id);

        if ($subcategory->banner && file_exists(public_path('uploads/affiliate-subcategories/' . $subcategory->banner))) {
            unlink(public_path('uploads/affiliate-subcategories/' . $subcategory->banner));
        }

        $subcategory->delete();

        return redirect()->route('admins.affiliate-subcategories.index')
            ->with('success', 'Sub Category Deleted Successfully!');
    }
}
