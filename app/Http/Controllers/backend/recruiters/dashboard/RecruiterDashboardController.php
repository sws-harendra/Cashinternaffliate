<?php

namespace App\Http\Controllers\backend\recruiters\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecruiterDashboardController extends Controller
{
     public function index()
    {
        return view('backend.recruiters.pages.dashboard');
    }
}
