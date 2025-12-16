<?php

namespace App\Http\Controllers\backend\recruiters\auth;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class RecruiterForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('backend.recruiters.auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:recruiters,email',
        ]);

        $status = Password::broker('recruiters')
            ->sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', __($status))
            : back()->with('error', __($status));
    }

}
