<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = $request->user(); // Get the authenticated user
        // dd($user);

        $request->validate([
            'name' => 'nullable|string',
            'qualification' => 'nullable|string',
            'address' => 'nullable|string',
            'pincode' => 'nullable|digits:6',
            'dob' => 'nullable|date',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'referred_by' => 'nullable|string|max:255|exists:users,referral_code',
        ]);


        // Upload profile image (if exists)
        if ($request->hasFile('profile_image')) {

            // Delete old image if exists
            if ($user->profile_image && file_exists(public_path($user->profile_image))) {
                unlink(public_path($user->profile_image));
            }

            // Upload new image
            $imageName = time() . '.' . $request->profile_image->extension();
            $request->profile_image->move(public_path('uploads/profile_images'), $imageName);

            // Save path
            $user->profile_image = 'uploads/profile_images/' . $imageName;
        }

        // Update other fields
        $user->name = $request->name ?? $user->name;
        // $user->phone = $request->phone ?? $user->phone;
        $user->qualification = $request->qualification ?? $user->qualification;
        $user->address = $request->address ?? $user->address;
        $user->pincode = $request->pincode ?? $user->pincode;
        $user->dob = $request->dob ?? $user->dob;

        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Profile updated successfully',
            'user' => $user

        ], 200);
    }
}
