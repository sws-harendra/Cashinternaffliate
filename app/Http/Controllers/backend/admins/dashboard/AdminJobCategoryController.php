<?php

namespace App\Http\Controllers\backend\admins\dashboard;

use App\Models\JobCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminJobCategoryController extends Controller
{
     public function index()
    {
        $categories = JobCategory::latest()->paginate(20);
        return view('backend.admins.pages.job_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('backend.admins.pages.job_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:job_categories,name'
        ]);

        JobCategory::create([
            'name' => $request->name,
            'is_active' => true
        ]);

        return redirect()->route('admins.job-categories.index')
            ->with('success', 'Job category created');
    }

    public function edit(JobCategory $jobCategory)
    {
        return view('backend.admins.pages.job_categories.edit', compact('jobCategory'));
    }

    public function update(Request $request, JobCategory $jobCategory)
    {
        $request->validate([
            'name' => 'required|unique:job_categories,name,' . $jobCategory->id
        ]);

        $jobCategory->update($request->only('name', 'is_active'));

        return redirect()->route('admins.job-categories.index')
            ->with('success', 'Category updated');
    }

    public function destroy(JobCategory $jobCategory)
    {
        $jobCategory->delete();

        return back()->with('success', 'Category deleted');
    }
}
