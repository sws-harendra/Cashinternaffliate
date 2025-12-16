<?php

namespace App\Http\Controllers\backend\recruiters\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\RecruiterVerification;

class RecruiterVerificationController extends Controller
{
    public function index()
    {
        $verification = auth('recruiter')->user()->verification;
        return view('backend.recruiters.pages.verification', compact('verification'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'document_type' => 'required',
            'document_file' => 'required|file|mimes:pdf,jpg,png|max:2048',
        ]);

        //  public/uploads/recruiter_docs path
        $uploadPath = public_path('uploads/recruiter_docs');

        // create directory if not exists
        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }

        // delete old document if exists (optional but recommended)
        $oldVerification = RecruiterVerification::where(
            'recruiter_id',
            auth('recruiter')->id()
        )->first();

        if ($oldVerification && File::exists(public_path($oldVerification->document_file))) {
            File::delete(public_path($oldVerification->document_file));
        }

        // upload new file
        $file = $request->file('document_file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move($uploadPath, $fileName);

        // save relative path in DB
        $relativePath = 'uploads/recruiter_docs/' . $fileName;

        RecruiterVerification::updateOrCreate(
            ['recruiter_id' => auth('recruiter')->id()],
            [
                'document_type' => $request->document_type,
                'document_file' => $relativePath,
                'status' => 'pending',
                'admin_remark' => null,
                'verified_at' => null,
            ]
        );

        return back()->with(
            'success',
            'Document uploaded successfully. Awaiting admin verification.'
        );
    }

}
