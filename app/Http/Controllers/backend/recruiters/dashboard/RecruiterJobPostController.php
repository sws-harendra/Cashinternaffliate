<?php

namespace App\Http\Controllers\backend\recruiters\dashboard;

use App\Models\JobPost;
use App\Models\JobRole;
use App\Models\JobType;
use App\Models\JobCategory;
use App\Models\JobLocation;
use App\Models\SalaryRange;
use Illuminate\Http\Request;
use App\Models\ExperienceLevel;
use App\Http\Controllers\Controller;

class RecruiterJobPostController extends Controller
{
    public function index()
    {
        $jobs = JobPost::with('category', 'role', 'type', 'location', 'experience', 'salary')->where('recruiter_id', auth('recruiter')->id())
            ->latest()
            ->paginate(20);

        return view('backend.recruiters.pages.jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('backend.recruiters.pages.jobs.create', [
            'categories' => JobCategory::where('is_active', 1)->get(),
            'roles' => JobRole::where('is_active', 1)->get(),
            'types' => JobType::get(),
            'locations' => JobLocation::where('is_active', 1)->get(),
            'experiences' => ExperienceLevel::get(),
            'salaries' => SalaryRange::where('is_active', 1)->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'job_category_id' => 'required',
            'job_role_id' => 'required',
            'job_type_id' => 'required',
            'job_location_id' => 'required',
            'experience_level_id' => 'required',
            'salary_range_id' => 'nullable',
            'title' => 'required|max:255',
            'description' => 'required',
            'responsibilities' => 'nullable',
            'skills' => 'nullable',
        ]);

        JobPost::create([
            'recruiter_id' => auth('recruiter')->id(),
            'job_category_id' => $request->job_category_id,
            'job_role_id' => $request->job_role_id,
            'job_type_id' => $request->job_type_id,
            'job_location_id' => $request->job_location_id,
            'experience_level_id' => $request->experience_level_id,
            'salary_range_id' => $request->salary_range_id,
            'title' => $request->title,
            'description' => $request->description,
            'responsibilities' => $request->responsibilities,
            'skills' => $request->skills,
            'status' => 'pending', // IMPORTANT
        ]);

        return redirect()
            ->route('recruiters.jobs.index')
            ->with('success', 'Job submitted for admin approval.');
    }

    public function edit(JobPost $job)
    {
        if ($job->recruiter_id !== auth('recruiter')->id()) {
            abort(403);
        }

        return view('backend.recruiters.pages.jobs.edit', [
            'job' => $job,
            'categories' => JobCategory::where('is_active', 1)->get(),
            'roles' => JobRole::where('is_active', 1)->get(),
            'types' => JobType::get(),
            'locations' => JobLocation::where('is_active', 1)->get(),
            'experiences' => ExperienceLevel::get(),
            'salaries' => SalaryRange::where('is_active', 1)->get(),
        ]);
    }

    public function update(Request $request, JobPost $job)
    {
        // 🔒 Security: own job only
        if ($job->recruiter_id !== auth('recruiter')->id()) {
            abort(403, 'Unauthorized access.');
        }

        // ❌ Approved job cannot be edited
        if ($job->status === 'approved') {
            return redirect()
                ->route('recruiter.jobs.index')
                ->with('error', 'Approved job cannot be edited.');
        }

        // ✅ Validation
        $request->validate([
            'job_category_id' => 'required|exists:job_categories,id',
            'job_role_id' => 'required|exists:job_roles,id',
            'job_type_id' => 'required|exists:job_types,id',
            'job_location_id' => 'required|exists:job_locations,id',
            'experience_level_id' => 'required|exists:experience_levels,id',
            'salary_range_id' => 'nullable|exists:salary_ranges,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'responsibilities' => 'nullable|string',
            'skills' => 'nullable|string',
        ]);

        // 📝 Update job
        $job->update([
            'job_category_id' => $request->job_category_id,
            'job_role_id' => $request->job_role_id,
            'job_type_id' => $request->job_type_id,
            'job_location_id' => $request->job_location_id,
            'experience_level_id' => $request->experience_level_id,
            'salary_range_id' => $request->salary_range_id,
            'title' => $request->title,
            'description' => $request->description,
            'responsibilities' => $request->responsibilities,
            'skills' => $request->skills,

            // 🔁 Reset approval
            'status' => 'pending',
            'approved_at' => null,
            'approved_by' => null,
        ]);

        return redirect()
            ->route('recruiters.jobs.index')
            ->with('success', 'Job updated successfully and sent for admin approval.');
    }


}
