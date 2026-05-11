<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\JobListing;
use Illuminate\Http\Request;

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

    public function update(Request $request, $applicationId, $status)
    {
        if (!in_array($status, ['accepted', 'rejected'])) {
            return back()->with('error', 'Invalid status!');
        }

        $application = Application::findOrFail($applicationId);

        $application->update(['status' => $status]);

        return back()->with('success', 'Application ' . $status . ' successfully!');
    }
}