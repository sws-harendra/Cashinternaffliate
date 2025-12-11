<?php

namespace App\Http\Controllers\backend\admins\dashboard;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\AffiliateCategory;
use App\Http\Controllers\Controller;

class AdminAffiliateCategoryController extends Controller
{
    public function index()
    {
        $categories = AffiliateCategory::latest()->paginate(20);
        return view('backend.admins.pages.affiliate_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('backend.admins.pages.affiliate_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:affiliate_categories',
            'description' => 'nullable',
            'banner' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
        ]);

        $bannerName = null;

        if ($request->hasFile('banner')) {

            $file = $request->file('banner');

            // generate filename
            $bannerName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // MOVE TO PUBLIC/uploads/affiliate-categories
            $file->move(public_path('uploads/affiliate-categories'), $bannerName);
        }

        AffiliateCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
            'description' => $request->description,
            'banner' => $bannerName,
            'status' => $request->status ?? 'active',
        ]);

        return redirect()->route('admins.affiliate-categories.index')
            ->with('success', 'Category created successfully.');
    }



    public function edit($id)
    {
        $category = AffiliateCategory::findOrFail($id);
        return view('backend.admins.pages.affiliate_categories.edit', compact('category'));
    }


    public function update(Request $request, AffiliateCategory $affiliateCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',

            'description' => 'nullable',
            'banner' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
        ]);

        $bannerName = $affiliateCategory->banner;

        if ($request->hasFile('banner')) {

            // delete old file
            if ($bannerName && file_exists(public_path('uploads/affiliate-categories/' . $bannerName))) {
                unlink(public_path('uploads/affiliate-categories/' . $bannerName));
            }

            // upload new file
            $file = $request->file('banner');
            $bannerName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // MOVE TO PUBLIC
            $file->move(public_path('uploads/affiliate-categories'), $bannerName);
        }

        $affiliateCategory->update([
            'name' => $request->name,
            'description' => $request->description,
            'banner' => $bannerName,
            'status' => $request->status ?? 'active',
        ]);

        return redirect()->route('admins.affiliate-categories.index')
            ->with('success', 'Category updated successfully.');
    }


    public function destroy($id)
    {
        $affiliateCategory = AffiliateCategory::findOrFail($id);

        if (
            $affiliateCategory->banner &&
            file_exists(public_path('uploads/affiliate-categories/' . $affiliateCategory->banner))
        ) {
            unlink(public_path('uploads/affiliate-categories/' . $affiliateCategory->banner));
        }

        $affiliateCategory->delete();

        return redirect()->route('admins.affiliate-categories.index')
            ->with('success', 'Category deleted successfully.');
    }


}
