<?php

namespace App\Http\Controllers\backend\admins\dashboard;

use Illuminate\Http\Request;
use App\Models\Configuration;
use App\Http\Controllers\Controller;

class AdminSettingController extends Controller
{
    public function index()
    {
        $settings = Configuration::all()->pluck('value', 'key');
        return view('backend.admins.pages.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $keys = [
            'playstore_app_link',
            'website_link',
            'terms_link',
            'privacy_link',
            'telegram_link',
            'facebook_link',
            'instagram_link',
            'youtube_link',
            'support_email',
            'referral_bonus',
            'min_withdraw',
        ];

        foreach ($keys as $key) {
            if ($request->has($key)) {
                Configuration::where('key', $key)->update([
                    'value' => $request->input($key)
                ]);
            }
        }

        // Company Logo Upload
        if ($request->hasFile('company_logo')) {

            $file = $request->file('company_logo');
            $name = time() . '.' . $file->extension();
            $file->move(public_path('uploads/logo'), $name);

            Configuration::where('key', 'company_logo')->update([
                'value' => 'uploads/logo/' . $name
            ]);
        }

        // Referral Banner Upload
        if ($request->hasFile('refer_banner')) {

            $file = $request->file('refer_banner');
            $name = 'refer_' . time() . '.' . $file->extension();
            $file->move(public_path('uploads/referral'), $name);

            Configuration::where('key', 'refer_banner')->update([
                'value' => 'uploads/referral/' . $name
            ]);
        }


        return back()->with('success', 'Settings updated successfully');
    }
}
