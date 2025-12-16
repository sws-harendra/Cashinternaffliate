<?php

namespace App\Http\Controllers\backend\recruiters\auth;

use App\Models\Recruiter;
use App\Services\OtpService;
use Illuminate\Http\Request;
use App\Models\OtpVerification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RecruiterAuthController extends Controller
{

    protected $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }
    public function showRegister()
    {
        return view('backend.recruiters.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'mobile' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        // 🔍 Check existing recruiter
        $existing = Recruiter::where('email', $request->email)
            ->orWhere('mobile', $request->mobile)
            ->first();

        // ✅ Case 1: Already verified → block
        if ($existing && ($existing->is_email_verified || $existing->is_mobile_verified)) {
            return back()->with('error', 'Account already exists. Please login.');
        }

        // 🔁 Case 2: Exists but NOT verified → resend OTP
        if ($existing && !$existing->is_email_verified && !$existing->is_mobile_verified) {

            // delete old otps
            OtpVerification::where('mobile', $existing->email)->delete();
            OtpVerification::where('mobile', $existing->mobile)->delete();

            // generate new otp
            $emailOtp = rand(100000, 999999);
            $mobileOtp = rand(100000, 999999);

            OtpVerification::create([
                'mobile' => $existing->email,
                'otp' => $emailOtp,
                'expires_at' => now()->addMinutes(10)
            ]);

            OtpVerification::create([
                'mobile' => $existing->mobile,
                'otp' => $mobileOtp,
                'expires_at' => now()->addMinutes(10)
            ]);

            // $this->otpService->sendOtp($existing->email, $emailOtp);
            // $this->otpService->sendOtp($existing->mobile, $mobileOtp);

            session(['recruiter_id' => $existing->id]);

            return redirect()->route('recruiters.otp.form')
                ->with('success', 'OTP resent. Please verify your account.');
        }

        // ✅ Case 3: Fresh registration
        $recruiter = Recruiter::create([
            'recruiter_type' => $request->recruiter_type,
            'name' => $request->name,
            'company_name' => $request->company_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => bcrypt($request->password),
            'status' => 'pending',
        ]);

        // generate otp
        $emailOtp = rand(100000, 999999);
        $mobileOtp = rand(100000, 999999);

        OtpVerification::create([
            'mobile' => $recruiter->email,
            'otp' => $emailOtp,
            'expires_at' => now()->addMinutes(10)
        ]);

        OtpVerification::create([
            'mobile' => $recruiter->mobile,
            'otp' => $mobileOtp,
            'expires_at' => now()->addMinutes(10)
        ]);

        // $this->otpService->sendOtp($recruiter->email, $emailOtp);
        // $this->otpService->sendOtp($recruiter->mobile, $mobileOtp);
        session(['recruiter_id' => $recruiter->id]);

        return redirect()->route('recruiters.otp.form')
            ->with('success', 'OTP sent successfully');
    }



    public function showLogin()
    {
        return view('backend.recruiters.auth.login');
    }

    public function login(Request $request)
    {
        if (Auth::guard('recruiter')->attempt($request->only('email', 'password'))) {

            $user = auth('recruiter')->user();

            if (!$user->is_email_verified || !$user->is_mobile_verified) {
                Auth::guard('recruiter')->logout();
                return back()->with('error', 'Please verify email and mobile first');
            }

            if (!$user->is_active) {
                Auth::guard('recruiter')->logout();
                return back()->with('error', 'Your account has been deactivated by admin.');
            }


            return redirect()->route('recruiters.dashboard');
        }

        return back()->with('error', 'Invalid credentials');
    }



    public function logout()
    {
        Auth::guard('recruiter')->logout();
        return redirect()->route('recruiters.show.login');
    }
}
