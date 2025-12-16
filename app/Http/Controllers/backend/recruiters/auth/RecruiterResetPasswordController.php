<?php

namespace App\Http\Controllers\backend\recruiters\auth;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class RecruiterResetPasswordController extends Controller
{
     public function showResetForm(Request $request, $token)
    {
        return view('backend.recruiters.auth.reset-password', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:recruiters,email',
            'password' => 'required|confirmed|min:6',
        ]);

        $status = Password::broker('recruiters')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($recruiter, $password) {
                $recruiter->password = Hash::make($password);
                $recruiter->setRememberToken(Str::random(60));
                $recruiter->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('recruiters.show.login')->with('success', 'Password reset successful.')
            : back()->with('error', __($status));
    }
}
