<?php

namespace App\Http\Controllers\backend\admins\dashboard;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TrainingCategory;
use App\Models\TrainingSubCategory;
use App\Http\Controllers\Controller;

class AdminTrainingSubCategoryController extends Controller
{
    public function index()
    {
        $subcategories = TrainingSubCategory::with('category')->paginate(20);

        return view('backend.admins.pages.training_subcategory.index', compact('subcategories'));
    }

    public function create()
    {
        $categories = TrainingCategory::all();
        return view('backend.admins.pages.training_subcategory.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'banner' => 'nullable|image'
        ]);

        // Auto slug
        $slug = Str::slug($request->name);
        if (TrainingSubCategory::where('slug', $slug)->exists()) {
            $slug = $slug . '-' . rand(1000, 9999);
        }

        // Banner upload
        $bannerName = null;
        if ($request->hasFile('banner')) {
            $bannerName = time() . '-' . uniqid() . '.' . $request->banner->extension();
            $request->banner->move(public_path('uploads/training-subcategory'), $bannerName);
        }

        TrainingSubCategory::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'banner' => $bannerName,
            'status' => $request->status ?? 1,
        ]);

        return back()->with('success', 'Training Sub Category Created!');
    }

    public function edit($id)
    {
        $subcategory = TrainingSubCategory::findOrFail($id);
        $categories = TrainingCategory::all();

        return view('backend.admins.pages.training_subcategory.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $subcategory = TrainingSubCategory::findOrFail($id);

        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'banner' => 'nullable|image'
        ]);

        $slug = Str::slug($request->name);
        if ($slug != $subcategory->slug) {
            if (TrainingSubCategory::where('slug', $slug)->exists()) {
                $slug = $slug . '-' . rand(1000, 9999);
            }
        }

        $bannerName = $subcategory->banner;
        if ($request->hasFile('banner')) {
            if ($bannerName && file_exists(public_path('uploads/training-subcategory/' . $bannerName))) {
                unlink(public_path('uploads/training-subcategory/' . $bannerName));
            }

            $bannerName = time() . '-' . uniqid() . '.' . $request->banner->extension();
            $request->banner->move(public_path('uploads/training-subcategory'), $bannerName);
        }

        $subcategory->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'banner' => $bannerName,
            'status' => $request->status ?? 1,
        ]);

        return redirect()
            ->route('admins.training-subcategory.index')
            ->with('success', 'Sub Category Updated!');
    }

    public function delete($id)
    {
        $subcategory = TrainingSubCategory::findOrFail($id);

        if ($subcategory->banner && file_exists(public_path('uploads/training-subcategory/' . $subcategory->banner))) {
            unlink(public_path('uploads/training-subcategory/' . $subcategory->banner));
        }

        $subcategory->delete();

        return back()->with('success', 'Sub Category Deleted!');
    }
}
