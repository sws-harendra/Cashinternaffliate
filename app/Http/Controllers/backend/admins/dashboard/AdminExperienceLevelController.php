<?php

namespace App\Http\Controllers\backend\admins\dashboard;

use Illuminate\Http\Request;
use App\Models\ExperienceLevel;
use App\Http\Controllers\Controller;

class AdminExperienceLevelController extends Controller
{
    /**
     * Display a listing of experience levels.
     */
    public function index()
    {
        $levels = ExperienceLevel::latest()->paginate(20);

        return view(
            'backend.admins.pages.experience_levels.index',
            compact('levels')
        );
    }

    /**
     * Show the form for creating a new experience level.
     */
    public function create()
    {
        return view('backend.admins.pages.experience_levels.create');
    }

    /**
     * Store a newly created experience level.
     */
    public function store(Request $request)
    {
        $request->validate([
            'label'     => 'required|string|max:100|unique:experience_levels,label',
            'is_active' => 'required|boolean',
        ]);

        ExperienceLevel::create([
            'label'     => $request->label,
            'is_active' => $request->is_active,
        ]);

        return redirect()
            ->route('admins.experience-levels.index')
            ->with('success', 'Experience level created successfully.');
    }

    /**
     * Show the form for editing the specified experience level.
     */
    public function edit(ExperienceLevel $experienceLevel)
    {
        return view(
            'backend.admins.experience_levels.edit',
            compact('experienceLevel')
        );
    }

    /**
     * Update the specified experience level.
     */
    public function update(Request $request, ExperienceLevel $experienceLevel)
    {
        $request->validate([
            'label'     => 'required|string|max:100|unique:experience_levels,label,' . $experienceLevel->id,
            'is_active' => 'required|boolean',
        ]);

        $experienceLevel->update([
            'label'     => $request->label,
            'is_active' => $request->is_active,
        ]);

        return redirect()
            ->route('admins.experience-levels.index')
            ->with('success', 'Experience level updated successfully.');
    }

    /**
     * Remove the specified experience level.
     */
    public function destroy(ExperienceLevel $experienceLevel)
    {
        $experienceLevel->delete();

        return redirect()
            ->route('admins.experience-levels.index')
            ->with('success', 'Experience level deleted successfully.');
    }
}
