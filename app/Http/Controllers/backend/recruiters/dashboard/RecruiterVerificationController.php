<?php

namespace App\Http\Controllers\backend\recruiters\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RecruiterVerification;

class RecruiterVerificationController extends Controller
{
     public function index()
    {
        return view('recruiter.verification.index');
    }

    public function store(Request $request)
    {
        RecruiterVerification::create([
            'recruiter_id' => auth('recruiter')->id(),
            'document_type' => $request->document_type,
            'document_file' => $request->file('document')->store('recruiter_docs'),
        ]);

        return redirect()->route('recruiter.dashboard')
            ->with('success','Verification submitted');
    }
}
