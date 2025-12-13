<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\AdvertiserCard;
use App\Http\Controllers\Controller;

class AdvertiserCardController extends Controller
{
     public function show(Request $request)
    {
        $card = AdvertiserCard::where('user_id', $request->user()->id)->first();

        return response()->json([
            'success' => true,
            'data' => $card
        ]);
    }

    /**
     * Create / Update advertiser card
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'            => 'required|string',
            'email'           => 'required|email',
            'city'            => 'required|string',
            'state'           => 'required|string',
            'work_experience' => 'required|string',
            'phone'           => 'required|string',
            'alternate_phone' => 'nullable|string',
            'occupation'      => 'required|string',
            'qualification'   => 'nullable|string',
            'profile_image'   => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $user = $request->user();

        $data = $request->except('profile_image');

        // Image upload
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $name = time() . '_' . uniqid() . '.' . $file->extension();
            $file->move(public_path('uploads/advertiser'), $name);
            $data['profile_image'] = 'uploads/advertiser/' . $name;
        }

        $card = AdvertiserCard::updateOrCreate(
            ['user_id' => $user->id],
            $data + ['user_id' => $user->id]
        );

        return response()->json([
            'success' => true,
            'message' => 'Advertiser card saved successfully',
            'data' => $card
        ]);
    }
}
