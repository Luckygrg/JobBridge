<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use App\Models\Category;
use Illuminate\Http\Request;

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

        return view('jobs.index', compact('jobs', 'categories'));
    }

    public function show(JobListing $job)
    {
        return view('jobs.show', compact('job'));
    }
}