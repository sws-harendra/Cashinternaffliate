<?php

namespace App\Http\Controllers\backend\admins\dashboard;

use App\Models\JobType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminJobTypeController extends Controller
{
    /**
     * Display a listing of job types.
     */
    public function index()
    {
        $types = JobType::latest()->paginate(20);

        return view(
            'backend.admins.pages.job_types.index',
            compact('types')
        );
    }

    /**
     * Show the form for creating a new job type.
     */
    public function create()
    {
        return view('backend.admins.pages.job_types.create');
    }

    /**
     * Store a newly created job type.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:job_types,name',
         
        ]);

        JobType::create([
            'name' => $request->name,
         
        ]);

        return redirect()
            ->route('admins.job-types.index')
            ->with('success', 'Job type created successfully.');
    }

    /**
     * Show the form for editing the specified job type.
     */
    public function edit(JobType $jobType)
    {
        return view(
            'backend.admins.pages.job_types.edit',
            compact('jobType')
        );
    }

    /**
     * Update the specified job type.
     */
    public function update(Request $request, JobType $jobType)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:job_types,name,' . $jobType->id,
        
        ]);

        $jobType->update([
            'name' => $request->name,
      
        ]);

        return redirect()
            ->route('admins.job-types.index')
            ->with('success', 'Job type updated successfully.');
    }

    /**
     * Remove the specified job type.
     */
    public function destroy(JobType $jobType)
    {
        $jobType->delete();

        return redirect()
            ->route('admins.job-types.index')
            ->with('success', 'Job type deleted successfully.');
    }
}
