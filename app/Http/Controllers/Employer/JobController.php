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
        $jobs = JobListing::where('user_id', auth()->id())->latest()->get();
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
            'salary' => 'nullable',
            'job_type' => 'required|in:full-time,part-time,remote,internship',
            'category_id' => 'required|exists:categories,id',
            'deadline' => 'required|date|after:today',
        ]);

        JobListing::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'salary' => $request->salary,
            'job_type' => $request->job_type,
            'category_id' => $request->category_id,
            'deadline' => $request->deadline,
            'status' => 'active',
        ]);

        return redirect()->route('employer.jobs.index')->with('success', 'Job posted successfully!');
    }

    public function edit(JobListing $job)
    {
        $categories = Category::all();
        return view('employer.jobs.edit', compact('job', 'categories'));
    }

    public function update(Request $request, JobListing $job)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'location' => 'required',
            'salary' => 'nullable',
            'job_type' => 'required|in:full-time,part-time,remote,internship',
            'category_id' => 'required|exists:categories,id',
            'deadline' => 'required|date|after_or_equal:today',
        ]);

        $job->update($request->all());

        return redirect()->route('employer.jobs.index')->with('success', 'Job updated successfully!');
    }

    public function destroy(JobListing $job)
    {
        $job->delete();
        return redirect()->route('employer.jobs.index')->with('success', 'Job deleted successfully!');
    }
}