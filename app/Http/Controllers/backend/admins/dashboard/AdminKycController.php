<?php

namespace App\Http\Controllers\backend\admins\dashboard;

use Illuminate\Http\Request;
use App\Models\UserKycDetail;
use App\Http\Controllers\Controller;

class AdminKycController extends Controller
{
     public function index()
    {
        $kycs = UserKycDetail::with('user')
            ->orderBy('id', 'DESC')
            ->paginate(20);

        return view('backend.admins.pages.kyc.index', compact('kycs'));
    }

    public function show($id)
    {
        $kyc = UserKycDetail::with('user')->findOrFail($id);
        return view('backend.admins.pages.kyc.show', compact('kyc'));
    }

    public function approve($id)
    {
        $kyc = UserKycDetail::findOrFail($id);

        $kyc->update([
            'kyc_status' => 'approved',
            'rejection_reason' => null
        ]);

        return back()->with('success', 'KYC Approved');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required'
        ]);

        $kyc = UserKycDetail::findOrFail($id);

        $kyc->update([
            'kyc_status' => 'rejected',
            'rejection_reason' => $request->rejection_reason
        ]);

        return back()->with('success', 'KYC Rejected');
    }
}
