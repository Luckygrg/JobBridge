<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use App\Models\Category;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = JobListing::where('user_id', auth()->id())->latest()->paginate(9);
        return view('employer.jobs.index', compact('jobs'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('employer.jobs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'location' => 'required',
            'salary_type' => 'required|in:negotiable,fixed,range',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0',
            'salary_currency' => 'required|string',
            'job_type' => 'required|in:full-time,part-time,remote,internship',
            'category_id' => 'required|exists:categories,id',
            'deadline' => 'required|date|after:today',
        ]);

        JobListing::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'salary_min' => $request->salary_min,
            'salary_max' => $request->salary_max,
            'salary_currency' => $request->salary_currency ?? 'NPR',
            'salary_type' => $request->salary_type,
            'job_type' => $request->job_type,
            'category_id' => $request->category_id,
            'deadline' => $request->deadline,
            'status' => 'active',
        ]);

        return redirect()->route('employer.jobs.index')->with('success', 'Job posted successfully!');
    }

    public function edit(JobListing $job)
    {
        if ($job->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action!');
        }

        $categories = Category::all();
        return view('employer.jobs.edit', compact('job', 'categories'));
    }

    public function update(Request $request, JobListing $job)
    {
        if ($job->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action!');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'location' => 'required',
            'salary_type' => 'required|in:negotiable,fixed,range',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0',
            'salary_currency' => 'required|string',
            'job_type' => 'required|in:full-time,part-time,remote,internship',
            'category_id' => 'required|exists:categories,id',
            'deadline' => 'required|date|after_or_equal:today',
        ]);

        $job->update([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'salary_min' => $request->salary_min,
            'salary_max' => $request->salary_max,
            'salary_currency' => $request->salary_currency ?? 'NPR',
            'salary_type' => $request->salary_type,
            'job_type' => $request->job_type,
            'category_id' => $request->category_id,
            'deadline' => $request->deadline,
        ]);

        return redirect()->route('employer.jobs.index')->with('success', 'Job updated successfully!');
    }

    public function destroy(JobListing $job)
    {
        if ($job->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action!');
        }

        $job->delete();
        return redirect()->route('employer.jobs.index')->with('success', 'Job deleted successfully!');
    }
}