<?php

namespace App\Http\Controllers\backend\recruiters\dashboard;

use Illuminate\Http\Request;
use App\Models\RecruiterProfile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class RecruiterProfileController extends Controller
{
    public function edit()
    {
        $profile = auth('recruiter')->user()->profile;
        // dd($profile);
        return view('backend.recruiters.pages.profile', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'company_description' => 'required',
            'industry' => 'required',
            'company_size' => 'required',
            'address' => 'required',
            'hr_name' => 'required',
            'hr_contact' => 'required',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'website' => 'nullable|url',
        ]);

        $data = $request->except(['_token', 'logo']);

        // TO HANDLE LOGO UPLOAD (PUBLIC)
        if ($request->hasFile('logo')) {

            $uploadPath = public_path('uploads/recruiter_logos');

            // create dir if not exists
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            // delete old logo
            $oldLogo = auth('recruiter')->user()->profile?->logo;
            if ($oldLogo && File::exists(public_path($oldLogo))) {
                File::delete(public_path($oldLogo));
            }

            $file = $request->file('logo');
            $fileName = time() . '_' . $file->getClientOriginalName();

            $file->move($uploadPath, $fileName);

            // save relative path in DB
            $data['logo'] = 'uploads/recruiter_logos/' . $fileName;
        }

        RecruiterProfile::updateOrCreate(
            ['recruiter_id' => auth('recruiter')->id()],
            $data
        );

        auth('recruiter')->user()->update([
            'profile_completed' => true
        ]);

        return back()->with('success', 'Profile updated successfully');
    }
}
