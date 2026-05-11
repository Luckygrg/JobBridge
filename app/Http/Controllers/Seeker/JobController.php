<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use App\Models\Application;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $query = JobListing::where('status', 'active')->with('category', 'employer');

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->job_type) {
            $query->where('job_type', $request->job_type);
        }

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%');
            });
        }

        $jobs = $query->latest()->paginate(6);
        $categories = Category::all();

        return view('seeker.jobs.index', compact('jobs', 'categories'));
    }

    public function show(JobListing $job)
    {
        if ($job->status !== 'active') {
            return redirect()->route('seeker.jobs')->with('error', 'This job is no longer available!');
        }

        if (Carbon::parse($job->deadline)->isPast()) {
            return redirect()->route('seeker.jobs')->with('error', 'This job has expired!');
        }

        $applied = Application::where('job_id', $job->id)
                               ->where('user_id', auth()->id())
                               ->exists();

        return view('seeker.jobs.show', compact('job', 'applied'));
    }

    public function apply(Request $request, JobListing $job)
    {
        if ($job->status !== 'active') {
            return back()->with('error', 'This job is no longer accepting applications!');
        }

        if (Carbon::parse($job->deadline)->isPast()) {
            return back()->with('error', 'The application deadline for this job has passed!');
        }

        $already = Application::where('job_id', $job->id)
                               ->where('user_id', auth()->id())
                               ->exists();

        if ($already) {
            return back()->with('error', 'You have already applied for this job!');
        }

        $request->validate([
            'cover_letter' => 'required|string',
            'resume' => 'required|file|mimes:pdf|max:2048',
        ]);

        $resumePath = $request->file('resume')->store('resumes', 'public');

        Application::create([
            'job_id' => $job->id,
            'user_id' => auth()->id(),
            'cover_letter' => $request->cover_letter,
            'resume' => $resumePath,
            'status' => 'pending',
        ]);

        return redirect()->route('seeker.applications')->with('success', 'Applied successfully!');
    }

    public function applications()
    {
        $applications = Application::where('user_id', auth()->id())
                                   ->with('job')
                                   ->latest()
                                   ->get();
        return view('seeker.applications', compact('applications'));
    }
}