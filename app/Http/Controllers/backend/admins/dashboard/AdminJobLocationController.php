<?php

namespace App\Http\Controllers\backend\admins\dashboard;

use App\Models\JobLocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminJobLocationController extends Controller
{
    /**
     * Display a listing of locations.
     */
    public function index()
    {
        $locations = JobLocation::latest()->paginate(20);

        return view(
            'backend.admins.pages.job_locations.index',
            compact('locations')
        );
    }

    /**
     * Show the form for creating a new location.
     */
    public function create()
    {
        return view('backend.admins.pages.job_locations.create');
    }

    /**
     * Store a newly created location.
     */
    public function store(Request $request)
    {
        $request->validate([
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'country' => 'nullable|string|max:100',
            'is_active' => 'required|boolean',
        ]);

        JobLocation::create([
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country ?? 'India',
            'is_active' => $request->is_active,
        ]);

        return redirect()
            ->route('admins.job-locations.index')
            ->with('success', 'Job location added successfully.');
    }

    /**
     * Show the form for editing the specified location.
     */
    public function edit(JobLocation $jobLocation)
    {
        return view(
            'backend.admins.pages.job_locations.edit',
            compact('jobLocation')
        );
    }

    /**
     * Update the specified location.
     */
    public function update(Request $request, JobLocation $jobLocation)
    {
        $request->validate([
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'country' => 'nullable|string|max:100',
            'is_active' => 'required|boolean',
        ]);

        $jobLocation->update([
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country ?? 'India',
            'is_active' => $request->is_active,
        ]);

        return redirect()
            ->route('admins.job-locations.index')
            ->with('success', 'Job location updated successfully.');
    }

    /**
     * Remove the specified location.
     */
    public function destroy(JobLocation $jobLocation)
    {
        $jobLocation->delete();

        return redirect()
            ->route('admins.job-locations.index')
            ->with('success', 'Job location deleted successfully.');
    }
}
