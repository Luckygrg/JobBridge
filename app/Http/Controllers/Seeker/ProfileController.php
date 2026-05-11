<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('seeker.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:1000',
            'skills' => 'nullable|string|max:500',
            'linkedin' => 'nullable|url',
            'portfolio' => 'nullable|url',
            'resume' => 'nullable|file|mimes:pdf|max:2048',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'bio' => $request->bio,
            'skills' => $request->skills,
            'linkedin' => $request->linkedin,
            'portfolio' => $request->portfolio,
        ];

        if ($request->hasFile('resume')) {
            $data['resume'] = $request->file('resume')->store('seeker-resumes', 'public');
        }

        if ($request->hasFile('profile_photo')) {
            $data['profile_photo'] = $request->file('profile_photo')->store('profile-photos', 'public');
        }

        $user->update($data);

        return back()->with('success', 'Profile updated successfully!');
    }
}