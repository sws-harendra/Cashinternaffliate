<?php

namespace App\Http\Controllers\backend\admins\dashboard;

use Illuminate\Http\Request;
use App\Models\TrainingCategory;
use App\Http\Controllers\Controller;

class AdminTrainingCategoryController extends Controller
{
     public function index()
    {
        $categories = TrainingCategory::orderBy('id', 'DESC')->paginate(20);
        return view('backend.admins.pages.training_category.index', compact('categories'));
    }

    public function create()
    {
        return view('backend.admins.pages.training_category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        TrainingCategory::create([
            'name' => $request->name
        ]);

        return redirect()->route('admins.training-category.index')
                         ->with('success', 'Category created successfully!');
    }

    public function edit($id)
    {
        $category = TrainingCategory::findOrFail($id);
        return view('backend.admins.pages.training_category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $category = TrainingCategory::findOrFail($id);

        $category->update([
            'name' => $request->name
        ]);

        return redirect()->route('admins.training-category.index')
                         ->with('success', 'Category updated successfully!');
    }

    public function delete($id)
    {
        TrainingCategory::findOrFail($id)->delete();

        return back()->with('success', 'Category deleted successfully!');
    }
}
