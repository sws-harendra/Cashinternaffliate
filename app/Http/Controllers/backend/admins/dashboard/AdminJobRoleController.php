<?php

namespace App\Http\Controllers\backend\admins\dashboard;

use App\Models\JobRole;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminJobRoleController extends Controller
{
    public function index()
    {
        $roles = JobRole::with('category')->paginate(20);
        return view('backend.admins.pages.job_roles.index', compact('roles'));
    }

    public function create()
    {
        $categories = JobCategory::where('is_active', 1)->get();
        return view('backend.admins.pages.job_roles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'job_category_id' => 'required'
        ]);

        JobRole::create($request->all());

        return redirect()->route('admins.job-roles.index')
            ->with('success', 'Job role created');
    }

    /**
     * Show the form for editing the specified job role.
     */
    public function edit(JobRole $jobRole)
    {
        $categories = JobCategory::where('is_active', 1)
            ->orderBy('name')
            ->get();

        return view(
            'backend.admins.pages.job_roles.edit',
            compact('jobRole', 'categories')
        );
    }

    /**
     * Update the specified job role.
     */
    public function update(Request $request, JobRole $jobRole)
    {
        $request->validate([
            'job_category_id' => 'required|exists:job_categories,id',
            'name' => 'required|string|max:255|unique:job_roles,name,' . $jobRole->id,
            'is_active' => 'required|boolean',
        ]);

        $jobRole->update([
            'job_category_id' => $request->job_category_id,
            'name' => $request->name,
            'is_active' => $request->is_active,
        ]);

        return redirect()
            ->route('admins.job-roles.index')
            ->with('success', 'Job role updated successfully.');
    }

    /**
     * Remove the specified job role.
     */
    public function destroy(JobRole $jobRole)
    {
        $jobRole->delete();

        return redirect()
            ->route('admins.job-roles.index')
            ->with('success', 'Job role deleted successfully.');
    }

}
