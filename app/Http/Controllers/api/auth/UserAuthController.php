<?php

namespace App\Http\Controllers\api\auth;

use App\Models\User;
use Illuminate\Support\Str;
use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserAuthController extends Controller
{

    protected $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }
    public function sendOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|digits:10'
        ]);

        $otp = rand(100000, 999999);
        $expiresAt = now()->addMinutes(5);

        // $this->otpService->sendOtp($request->phone, $otp);
        
        DB::table('otp_verifications')->updateOrInsert(
            ['mobile' => $request->phone],
            [
                'otp' => $otp,
                'is_verified' => false,
                'expires_at' => $expiresAt,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        return response()->json([
            'status' => true,
            'message' => 'OTP sent successfully',
            'otp' => $otp // remove this in production
        ]);
    }


    public function verifyOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|digits:10',
            'otp' => 'required|digits:6'
        ]);

        $record = DB::table('otp_verifications')
            ->where('mobile', $request->phone)
            ->where('otp', $request->otp)
            ->first();

        if (!$record) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid OTP'
            ], 422);
        }

        if ($record->expires_at && now()->greaterThan($record->expires_at)) {
            return response()->json([
                'status' => false,
                'message' => 'OTP expired'
            ], 422);
        }

        // User exist? else create
        $user = User::firstOrCreate(
            ['phone' => $request->phone],
            [
                'uuid' => substr(str_replace(['+', '/', '='], '', base64_encode(random_bytes(4))), 0, 5),
                'name' => 'Guest',
                'referral_code' => strtoupper(Str::random(8)),
                'referred_by' => $request->referred_by ?? null,
                'email' => null, // now nullable
                
                
            ]
        );

        // Mark OTP as verified
        DB::table('otp_verifications')
            ->where('mobile', $request->phone)
            ->update([
                'is_verified' => true,
                'updated_at' => now(),
            ]);

        // Sanctum Token
        $token = $user->createToken('mobile-login')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'OTP verified successfully',
            'token' => $token,
            'user' => $user
        ]);
    }


    public function profile(Request $request)
    {
        return response()->json([
            'status' => true,
            'user' => $request->user()
        ]);
    }

    // 4️⃣ LOGOUT
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Logout successful'
        ]);
    }
}
