<?php

namespace App\Http\Controllers\backend\recruiters\auth;

use App\Models\Recruiter;
use Illuminate\Http\Request;
use App\Models\OtpVerification;
use App\Http\Controllers\Controller;

class RecruiterOtpController extends Controller
{
    public function show()
    {
        return view('backend.recruiters.auth.verify-otp');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'email_otp' => 'required',
            'mobile_otp' => 'required',
        ]);

        $emailOtp = OtpVerification::where('otp', $request->email_otp)
            ->where('is_verified', false)
            ->first();

        $mobileOtp = OtpVerification::where('otp', $request->mobile_otp)
            ->where('is_verified', false)
            ->first();

        if (!$emailOtp || !$mobileOtp) {
            return back()->with('error', 'Invalid OTP');
        }

        if ($emailOtp->isExpired() || $mobileOtp->isExpired()) {
            return back()->with('error', 'OTP expired');
        }

        // mark verified
        $emailOtp->update(['is_verified' => true]);
        $mobileOtp->update(['is_verified' => true]);

        $recruiter = Recruiter::where('email', $emailOtp->mobile)
            ->where('mobile', $mobileOtp->mobile)
            ->first();

        $recruiter->update([
            'is_email_verified' => true,
            'is_mobile_verified' => true,
        ]);

        return redirect()->route('recruiters.show.login')
            ->with('success', 'OTP verified successfully');
    }

    /**
     * Resend OTP to email & mobile
     */
    public function resend()
    {
        // 🔐 Last registered recruiter (or store recruiter_id in session)
        $recruiterId = session('recruiter_id');

        if (!$recruiterId) {
            return redirect()->route('recruiters.show.login')
                ->with('error', 'Session expired. Please login again.');
        }

        $recruiter = Recruiter::find($recruiterId);

        if (!$recruiter) {
            return redirect()->route('recruiters.show.login')
                ->with('error', 'Recruiter not found.');
        }

        // ❌ Already verified
        if ($recruiter->is_email_verified && $recruiter->is_mobile_verified) {
            return redirect()->route('recruiters.show.login')
                ->with('success', 'Account already verified.');
        }

        // 🔁 Delete old OTPs
        OtpVerification::where('mobile', $recruiter->email)->delete();
        OtpVerification::where('mobile', $recruiter->mobile)->delete();

        // 🔐 Generate new OTPs
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

        // 📧 Send email OTP
        // Mail::to($recruiter->email)->send(new RecruiterEmailOtpMail($emailOtp));

        // 📱 Send SMS OTP (future)
        // Sms::send($recruiter->mobile, "Your OTP is $mobileOtp");

        return back()->with('success', 'OTP resent successfully.');
    }
}
