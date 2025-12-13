<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\UserKycDetail;
use App\Http\Controllers\Controller;

class UserKycController extends Controller
{
    public function store(Request $request)
    {
        $user = $request->user();

        // dd($user, $request->all());
        $request->validate([
            'pan_number' => 'required',
            'aadhar_number' => 'required',
            'pan_image' => 'required|image',
            'aadhar_front_image' => 'required|image',
            'aadhar_back_image' => 'required|image',
            'address' => 'required',
        ]);

        // dd($request->all());
        $uploadPath = public_path('uploads/kyc');

        $panImg = time() . '_pan.' . $request->pan_image->extension();
        $request->pan_image->move($uploadPath, $panImg);

        $aadharFront = time() . '_af.' . $request->aadhar_front_image->extension();
        $request->aadhar_front_image->move($uploadPath, $aadharFront);

        $aadharBack = time() . '_ab.' . $request->aadhar_back_image->extension();
        $request->aadhar_back_image->move($uploadPath, $aadharBack);

        UserKycDetail::updateOrCreate(
            ['user_id' => $user->id],
            [
                'pan_number' => $request->pan_number,
                'aadhar_number' => $request->aadhar_number,
                'pan_image' => 'uploads/kyc/' . $panImg,
                'aadhar_front_image' => 'uploads/kyc/' . $aadharFront,
                'aadhar_back_image' => 'uploads/kyc/' . $aadharBack,
                'address' => $request->address,
                'kyc_status' => 'pending',
                'rejection_reason' => null,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'KYC submitted successfully'
        ]);
    }

    public function show(Request $request)
    {
        return UserKycDetail::where('user_id', $request->user()->id)->first();
    }

}
