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

        if (!$recruiter) {
            return redirect()->route('recruiters.show.login');
        }

        $verification = $recruiter->verification;

        // ❌ Document not uploaded OR not approved
        if (!$verification || $verification->status !== 'approved') {
            return redirect()
                ->route('recruiters.dashboard')
                ->with(
                    'error',
                    'Please complete document verification to post jobs.'
                );
        }
        return $next($request);
    }
}
