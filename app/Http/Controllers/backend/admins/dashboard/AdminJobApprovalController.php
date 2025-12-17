<?php

namespace App\Http\Controllers\backend\admins\dashboard;

use App\Models\JobPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminJobApprovalController extends Controller
{
    /**
     * Pending jobs list
     */
    public function index()
    {
        $jobs = JobPost::with([
            'recruiter',
            'category',
            'role',
            'type',
            'location',
            'experience',
            'salary'
        ])
            ->where('status', 'pending')
            ->latest()
            ->paginate(20);
        // dd($jobs);

        return view('backend.admins.pages.jobs.index', compact('jobs'));
    }

    /**
     * View job details
     */
    public function show(JobPost $job)
    {
        $job->load([
            'recruiter',
            'category',
            'role',
            'type',
            'location',
            'experience',
            'salary',
        ]);

        // dd($job);
        return view('backend.admins.pages.jobs.show', compact('job'));
    }

    /**
     * Approve job
     */
    public function approve(JobPost $job)
    {
        if ($job->status !== 'pending') {
            return back()->with('error', 'Only pending jobs can be approved.');
        }

        $job->update([
            'status' => 'approved',
            'is_active' => true,
            'approved_at' => now(),
            'approved_by' => auth('admin')->id(),
        ]);

        return redirect()
            ->route('admins.jobs.index')
            ->with('success', 'Job approved successfully.');
    }

    /**
     * Reject job
     */
    public function reject(Request $request, JobPost $job)
    {
        $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        $job->update([
            'status' => 'rejected',
            'is_active' => false,
            'approved_at' => null,
            'approved_by' => auth('admin')->id(),
        ]);

        // (Future) store rejection reason table / notification

        return redirect()
            ->route('admins.jobs.index')
            ->with('success', 'Job rejected successfully.');
    }
}
