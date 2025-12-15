<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RecruiterCanPostJob
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       $recruiter = auth('recruiter')->user();

        // Safety check
        if (!$recruiter) {
            return redirect()->route('recruiters.login');
        }

        //Admin not approved
        if ($recruiter->status !== 'approved') {
            return redirect()
                ->route('recruiters.dashboard')
                ->with('error', 'Admin verification pending. You cannot post jobs yet.');
        }

        return $next($request);
    }
}
