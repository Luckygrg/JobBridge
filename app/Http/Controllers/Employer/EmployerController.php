<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\JobListing;

class EmployerController extends Controller
{
    public function dashboard()
    {
        $jobsPosted = JobListing::where('user_id', auth()->id())->count();
        
        return view('employer.dashboard', compact('jobsPosted'));
    }
}