<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\JobListing;
use App\Models\Application;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalJobs = JobListing::count();
        $totalApplications = Application::count();
        $totalEmployers = User::where('role', 'employer')->count();
        $totalSeekers = User::where('role', 'seeker')->count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalJobs',
            'totalApplications',
            'totalEmployers',
            'totalSeekers'
        ));
    }

    public function users()
    {
        $users = User::where('role', '!=', 'admin')->latest()->paginate(9);
        return view('admin.users', compact('users'));
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted successfully!');
    }

    public function jobs()
    {
        $jobs = JobListing::with('employer', 'category')->latest()->paginate(9);
        return view('admin.jobs', compact('jobs'));
    }

    public function deleteJob(JobListing $job)
    {
        $job->delete();
        return back()->with('success', 'Job deleted successfully!');
    }
}