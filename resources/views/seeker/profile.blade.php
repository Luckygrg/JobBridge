<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - JobBridge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f5f7fb; }

        .sidebar { width: 250px; min-height: 100vh; background: #00897b; position: fixed; left: 0; top: 0; z-index: 100; }
        .sidebar-brand { padding: 22px 20px; border-bottom: 1px solid rgba(255,255,255,0.15); }
        .sidebar-brand span { color: #fff; font-weight: 700; font-size: 1.1rem; }
        .sidebar-menu { padding: 15px 0; }
        .sidebar-menu a { display: flex; align-items: center; gap: 12px; padding: 12px 20px; color: rgba(255,255,255,0.8); text-decoration: none; font-size: 0.95rem; font-weight: 500; transition: all 0.3s; }
        .sidebar-menu a:hover { background: rgba(255,255,255,0.15); color: #fff; }
        .sidebar-menu a.active { background: rgba(255,255,255,0.2); color: #fff; border-right: 3px solid #fff; }
        .sidebar-menu a i { font-size: 1.1rem; width: 20px; text-align: center; }
        .sidebar-footer { position: absolute; bottom: 0; width: 100%; padding: 15px 0; border-top: 1px solid rgba(255,255,255,0.15); }
        .sidebar-footer form button { display: flex; align-items: center; gap: 12px; padding: 12px 20px; color: rgba(255,255,255,0.8); background: none; border: none; font-size: 0.95rem; font-weight: 500; width: 100%; cursor: pointer; transition: all 0.3s; }
        .sidebar-footer form button:hover { background: rgba(255,255,255,0.15); color: #fff; }
        .sidebar-footer form button i { font-size: 1.1rem; width: 20px; text-align: center; }

        .main-content { margin-left: 250px; padding: 30px; }

        .topbar { background: #fff; border-radius: 12px; padding: 15px 25px; margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px rgba(0,0,0,0.06); }
        .topbar h5 { margin: 0; font-weight: 700; color: #1a1a2e; }
        .user-avatar { width: 38px; height: 38px; background: #00897b; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 0.9rem; }

        .content-card { background: #fff; border-radius: 12px; padding: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); max-width: 800px; }

        .profile-avatar { width: 100px; height: 100px; background: #e0f2f1; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; font-weight: 700; color: #00897b; margin-bottom: 15px; overflow: hidden; }
        .profile-avatar img { width: 100%; height: 100%; object-fit: cover; }

        .form-control { border: 1.5px solid #e0e0e0; border-radius: 8px; padding: 11px 15px; font-size: 0.9rem; }
        .form-control:focus { border-color: #00897b; box-shadow: 0 0 0 3px rgba(0,137,123,0.1); }
        .form-label { font-weight: 600; color: #444; font-size: 0.88rem; margin-bottom: 6px; }
        .btn-submit { background: #00897b; color: #fff; border: none; border-radius: 8px; padding: 12px 30px; font-size: 0.95rem; font-weight: 600; }
        .btn-submit:hover { background: #00695c; color: #fff; }
        .section-title { font-size: 1rem; font-weight: 700; color: #1a1a2e; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #e0f2f1; }
        .alert-success { border-radius: 8px; border: none; background: #e0f2f1; color: #00695c; }
        .alert-danger { border-radius: 8px; font-size: 0.88rem; }
        .resume-link { color: #00897b; font-weight: 600; text-decoration: none; font-size: 0.88rem; }
        .resume-link:hover { text-decoration: underline; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-brand">
        <span>JobBridge</span>
    </div>
    <div class="sidebar-menu">
        <a href="{{ route('seeker.dashboard') }}">
            <i class="bi bi-grid-fill"></i> Dashboard
        </a>
        <a href="{{ route('seeker.jobs') }}">
            <i class="bi bi-briefcase-fill"></i> Browse Jobs
        </a>
        <a href="{{ route('seeker.applications') }}">
            <i class="bi bi-file-earmark-text-fill"></i> My Applications
        </a>
        <a href="{{ route('seeker.profile') }}" class="active">
            <i class="bi bi-person-fill"></i> My Profile
        </a>
    </div>
    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">
                <i class="bi bi-box-arrow-left"></i> Logout
            </button>
        </form>
    </div>
</div>

<div class="main-content">

    <div class="topbar">
        <h5>My Profile</h5>
        <div class="d-flex align-items-center gap-2">
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div>
                <div style="font-weight:600;font-size:0.9rem;">{{ auth()->user()->name }}</div>
                <div style="color:#888;font-size:0.8rem;">Job Seeker</div>
            </div>
        </div>
    </div>

    <div class="content-card">

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

        <!-- Profile Photo -->
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

            <!-- Basic Info -->
            <p class="section-title">Basic Information</p>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control"
                           value="{{ $user->name }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Phone Number</label>
                    <input type="text" name="phone" class="form-control"
                           placeholder="e.g. +977 9812345678"
                           value="{{ $user->phone }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" class="form-control"
                       value="{{ $user->email }}" disabled>
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
                       placeholder="e.g. Laravel, PHP, MySQL, JavaScript"
                       value="{{ $user->skills }}">
                <small class="text-muted">Separate skills with commas</small>
            </div>

            <!-- Links -->
            <p class="section-title mt-4">Links</p>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">LinkedIn Profile</label>
                    <input type="url" name="linkedin" class="form-control"
                           placeholder="https://linkedin.com/in/yourname"
                           value="{{ $user->linkedin }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Portfolio / Website</label>
                    <input type="url" name="portfolio" class="form-control"
                           placeholder="https://yourportfolio.com"
                           value="{{ $user->portfolio }}">
                </div>
            </div>

            <!-- Documents -->
            <p class="section-title mt-4">Documents</p>

            <div class="mb-3">
                <label class="form-label">Profile Resume (PDF)</label>
                @if($user->resume)
                    <div class="mb-2">
                        <a href="{{ asset('storage/' . $user->resume) }}"
                           target="_blank" class="resume-link">
                           <i class="bi bi-file-earmark-pdf-fill"></i> View Current Resume
                        </a>
                    </div>
                @endif
                <input type="file" name="resume" class="form-control" accept=".pdf">
                <small class="text-muted">Upload PDF only. Max 2MB.</small>
            </div>

            <div class="mb-4">
                <label class="form-label">Profile Photo</label>
                <input type="file" name="profile_photo" class="form-control"
                       accept=".jpg,.jpeg,.png">
                <small class="text-muted">JPG or PNG only. Max 2MB.</small>
            </div>

            <button type="submit" class="btn-submit">Save Profile</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>