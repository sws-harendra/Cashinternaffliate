<?php

namespace App\Http\Controllers\backend\admins\dashboard;

use App\Models\Recruiter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminRecruiterController extends Controller
{
    /**
     * Recruiter list
     */
    public function index()
    {
        $recruiters = Recruiter::with(['profile', 'verification'])
            ->latest()
            ->paginate(20);

        return view(
            'backend.admins.pages.recruiters.index',
            compact('recruiters')
        );
    }

    /**
     * Recruiter full details
     */
    public function show($id)
    {
        $recruiter = Recruiter::with(['profile', 'verification'])
            ->findOrFail($id);

        return view(
            'backend.admins.pages.recruiters.show',
            compact('recruiter')
        );
    }

    /**
     * Activate / Deactivate recruiter
     */
    public function toggleStatus($id)
    {
        $recruiter = Recruiter::findOrFail($id);

        $recruiter->update([
            'is_active' => !$recruiter->is_active
        ]);

        return back()->with(
            'success',
            'Recruiter status updated successfully.'
        );
    }
}
