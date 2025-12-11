<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OtpService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.2factor.api_key');
    }

    /**
     * Send OTP using 2Factor API
     */
    public function sendOtp($phone, $otp)
    {
        $url = "https://2factor.in/API/V1/{$this->apiKey}/SMS/{$phone}/{$otp}/OTP";

        $response = Http::get($url);

        if ($response->successful()) {
            return true;
        }

        return false;
    }
}
