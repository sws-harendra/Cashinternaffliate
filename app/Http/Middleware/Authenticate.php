<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        if ($request->is('api/*')) {
            abort(response()->json([
                'status' => false,
                'message' => 'Unauthorized. Token missing or invalid.'
            ], 401));
        }
        
        if (!$request->expectsJson()) {
            if ($request->is('admins/*')) {
                return route('admins.login');   // admin login route
            } 
            if ($request->is('recruiters/*')) {
                return route('recruiters.show.login');   // recruiter login route
            }
            return route('login'); // default user login
        }
    }
}
