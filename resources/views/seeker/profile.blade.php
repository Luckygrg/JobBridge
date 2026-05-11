@extends('layouts.seeker')

@section('title', 'My Profile - JobBridge')
@section('page-title', 'My Profile')

@section('styles')
<style>
    .profile-avatar { width: 100px; height: 100px; background: #e0f2f1; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; font-weight: 700; color: #00897b; margin-bottom: 15px; overflow: hidden; }
    .profile-avatar img { width: 100%; height: 100%; object-fit: cover; }
    .resume-link { color: #00897b; font-weight: 600; text-decoration: none; font-size: 0.88rem; }
    .resume-link:hover { text-decoration: underline; }
</style>
@endsection

@section('content')

<div class="content-card" style="max-width:800px;">

    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="text-center mb-4">
        <div class="profile-avatar mx-auto">
            @if($user->profile_photo)
                <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile Photo">
            @else
                {{ strtoupper(substr($user->name, 0, 1)) }}
            @endif
        </div>
    </div>

    <form method="POST" action="{{ route('seeker.profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <p class="section-title">Basic Information</p>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone" class="form-control"
                       placeholder="e.g. +977 9812345678" value="{{ $user->phone }}">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input type="email" class="form-control" value="{{ $user->email }}" disabled>
            <small class="text-muted">Email cannot be changed</small>
        </div>

        <div class="mb-3">
            <label class="form-label">Bio / About Me</label>
            <textarea name="bio" class="form-control" rows="4"
                      placeholder="Tell employers about yourself...">{{ $user->bio }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Skills</label>
            <input type="text" name="skills" class="form-control"
                   placeholder="e.g. Laravel, PHP, MySQL, JavaScript" value="{{ $user->skills }}">
            <small class="text-muted">Separate skills with commas</small>
        </div>

        <p class="section-title mt-4">Links</p>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label">LinkedIn Profile</label>
                <input type="url" name="linkedin" class="form-control"
                       placeholder="https://linkedin.com/in/yourname" value="{{ $user->linkedin }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Portfolio / Website</label>
                <input type="url" name="portfolio" class="form-control"
                       placeholder="https://yourportfolio.com" value="{{ $user->portfolio }}">
            </div>
        </div>

        <p class="section-title mt-4">Documents</p>

        <div class="mb-3">
            <label class="form-label">Profile Resume (PDF)</label>
            @if($user->resume)
                <div class="mb-2">
                    <a href="{{ asset('storage/' . $user->resume) }}" target="_blank" class="resume-link">
                        <i class="bi bi-file-earmark-pdf-fill"></i> View Current Resume
                    </a>
                </div>
            @endif
            <input type="file" name="resume" class="form-control" accept=".pdf">
            <small class="text-muted">Upload PDF only. Max 2MB.</small>
        </div>

        <div class="mb-4">
            <label class="form-label">Profile Photo</label>
            <input type="file" name="profile_photo" class="form-control" accept=".jpg,.jpeg,.png">
            <small class="text-muted">JPG or PNG only. Max 2MB.</small>
        </div>

        <button type="submit" class="btn-submit">Save Profile</button>
    </form>
</div>

@endsection