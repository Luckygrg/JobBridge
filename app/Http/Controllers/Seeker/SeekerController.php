<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use App\Models\Application;

class SeekerController extends Controller
{
    public function dashboard()
    {
        $jobsApplied = Application::where('user_id', auth()->id())->count();
        $pending = Application::where('user_id', auth()->id())->where('status', 'pending')->count();
        $accepted = Application::where('user_id', auth()->id())->where('status', 'accepted')->count();

        return view('seeker.dashboard', compact('jobsApplied', 'pending', 'accepted'));
    }
}