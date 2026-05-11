<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $featuredJobs = JobListing::where('status', 'active')
                        ->with('category', 'employer')
                        ->latest()
                        ->take(3)
                        ->get();

        return view('welcome', compact('featuredJobs'));
    }
}