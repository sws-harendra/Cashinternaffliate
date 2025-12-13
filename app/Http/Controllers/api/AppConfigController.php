<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\Configuration;
use App\Http\Controllers\Controller;

class AppConfigController extends Controller
{
    public function index()
    {
        // Key → Value pair me convert
        $settings = Configuration::pluck('value', 'key');

        return response()->json([
            'success' => true,
            'data' => [
                'playstore_app_link' => $settings['playstore_app_link'] ?? '',
                'website_link'       => $settings['website_link'] ?? '',
                'terms_link'         => $settings['terms_link'] ?? '',
                'privacy_link'       => $settings['privacy_link'] ?? '',

                'telegram_link'      => $settings['telegram_link'] ?? '',
                'facebook_link'      => $settings['facebook_link'] ?? '',
                'instagram_link'     => $settings['instagram_link'] ?? '',
                'youtube_link'       => $settings['youtube_link'] ?? '',

                'support_email'      => $settings['support_email'] ?? '',

                'referral_bonus'     => (float) ($settings['referral_bonus'] ?? 0),
                'min_withdraw'       => (float) ($settings['min_withdraw'] ?? 0),

                'company_logo' => !empty($settings['company_logo'])
                    ? asset($settings['company_logo'])
                    : null,

                'refer_banner' => !empty($settings['refer_banner'])
                    ? asset($settings['refer_banner'])
                    : null,
            ]
        ]);
    }
}
