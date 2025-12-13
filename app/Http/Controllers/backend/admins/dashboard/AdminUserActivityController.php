<?php

namespace App\Http\Controllers\backend\admins\dashboard;

use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminUserActivityController extends Controller
{
    public function index()
    {
        $activities = UserActivity::with('user')
            ->orderBy('id', 'DESC')
            ->paginate(20);

        return view(
            'backend.admins.pages.user_activity.index',
            compact('activities')
        );
    }
}
