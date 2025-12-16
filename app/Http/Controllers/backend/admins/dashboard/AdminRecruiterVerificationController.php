<?php

namespace App\Http\Controllers\backend\admins\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RecruiterVerification;

class AdminRecruiterVerificationController extends Controller
{
    /**
     * List all recruiter verifications
     */
    public function index()
    {
        $verifications = RecruiterVerification::with('recruiter')
            ->latest()
            ->paginate(20);

        return view(
            'backend.admins.pages.recruiter_verifications.index',
            compact('verifications')
        );
    }

    /**
     * Show single verification
     */
    public function show($id)
    {
        $verification = RecruiterVerification::with('recruiter')
            ->findOrFail($id);

        return view(
            'backend.admins.pages.recruiter_verifications.show',
            compact('verification')
        );
    }

    /**
     * Approve recruiter verification
     */
    public function approve($id)
    {
        $verification = RecruiterVerification::findOrFail($id);

        $verification->update([
            'status' => 'approved',
            'admin_remark' => null,
            'verified_at' => now(),
        ]);

        return redirect()
            ->route('admins.recruiter.verifications')
            ->with('success', 'Recruiter verified successfully.');
    }

    /**
     * Reject recruiter verification
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'admin_remark' => 'required|string|max:255',
        ]);

        $verification = RecruiterVerification::findOrFail($id);

        $verification->update([
            'status' => 'rejected',
            'admin_remark' => $request->admin_remark,
            'verified_at' => null,
        ]);

        return redirect()
            ->route('admins.recruiter.verifications')
            ->with('success', 'Recruiter verification rejected.');
    }
}
