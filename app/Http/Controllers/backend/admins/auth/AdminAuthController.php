<?php

namespace App\Http\Controllers\backend\admins\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('backend.admins.auth.login');
    }

   public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
        return redirect()->route('admins.dashboard')->with('success', 'Login successful');
    }

    return back()->with('error', 'Invalid email or password');
}


    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admins.login');
    }
}
