<?php

namespace App\Http\Controllers\api;

use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserActivityController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'activity_type' => 'required|string',
            'screen'        => 'nullable|string',
            'device_type'   => 'nullable|string',
            'device_id'     => 'nullable|string',
            'app_version'   => 'nullable|string',
        ]);

        UserActivity::create([
            'user_id'       => $request->user()->uuid,
            'activity_type' => $request->activity_type,
            'screen'        => $request->screen,
            'device_type'   => $request->device_type,
            'device_id'     => $request->device_id,
            'app_version'   => $request->app_version,
            'ip'            => $request->ip(),
            'user_agent'    => $request->userAgent(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Activity logged'
        ]);
    }
}
