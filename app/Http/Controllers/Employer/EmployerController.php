<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use App\Models\Application;

class EmployerController extends Controller
{
    public function dashboard()
    {
        $jobsPosted = JobListing::where('user_id', auth()->id())->count();
        $totalApplicants = Application::whereHas('job', function($q) {
            $q->where('user_id', auth()->id());
        })->count();
        $pendingReviews = Application::whereHas('job', function($q) {
            $q->where('user_id', auth()->id());
        })->where('status', 'pending')->count();

        return view('employer.dashboard', compact('jobsPosted', 'totalApplicants', 'pendingReviews'));
    }
}