<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\JobListing;

class ApplicationController extends Controller
{
    public function index($jobId)
    {
        $job = JobListing::where('id', $jobId)
                         ->where('user_id', auth()->id())
                         ->firstOrFail();

        $applications = Application::where('job_id', $jobId)
                                   ->with('seeker')
                                   ->latest()
                                   ->get();

        return view('employer.applications.index', compact('job', 'applications'));
    }

    public function update(Application $application, $status)
    {
        $application->update(['status' => $status]);
        return back()->with('success', 'Application ' . $status . ' successfully!');
    }
}