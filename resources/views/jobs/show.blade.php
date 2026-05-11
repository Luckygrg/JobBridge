<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $job->title }} - JobBridge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f5f7fb; }

        .navbar { background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 15px 0; position: sticky; top: 0; z-index: 100; }
        .navbar-brand { font-size: 1.4rem; font-weight: 700; color: #00897b !important; }
        .nav-link { color: #333 !important; font-weight: 500; }
        .nav-link:hover { color: #00897b !important; }
        .btn-login { border: 1.5px solid #00897b; color: #00897b; border-radius: 20px; padding: 6px 18px; font-weight: 600; font-size: 0.88rem; }
        .btn-login:hover { background: #00897b; color: #fff; }
        .btn-register { background: #00897b; color: #fff; border-radius: 20px; padding: 6px 18px; font-weight: 600; font-size: 0.88rem; border: none; }
        .btn-register:hover { background: #00695c; color: #fff; }

        .main-content { padding: 40px 0; }

        .job-card { background: #fff; border-radius: 14px; padding: 35px; box-shadow: 0 2px 15px rgba(0,0,0,0.08); max-width: 800px; margin: auto; }
        .job-title { font-size: 1.6rem; font-weight: 700; color: #1a1a2e; margin-bottom: 5px; }
        .company-name { color: #555; font-size: 1rem; margin-bottom: 15px; }
        .badge-type { background: #e0f2f1; color: #00695c; border-radius: 20px; padding: 5px 14px; font-size: 0.82rem; font-weight: 600; }
        .badge-category { background: #e3f2fd; color: #1565c0; border-radius: 20px; padding: 5px 14px; font-size: 0.82rem; font-weight: 600; }
        .badge-salary { background: #e8f5e9; color: #2e7d32; border-radius: 20px; padding: 5px 14px; font-size: 0.82rem; font-weight: 600; }
        .info-row { display: flex; gap: 8px; align-items: center; color: #555; font-size: 0.9rem; margin-bottom: 8px; }
        .info-row strong { color: #333; }
        .section-title { font-size: 1rem; font-weight: 700; color: #1a1a2e; margin-bottom: 12px; padding-bottom: 8px; border-bottom: 2px solid #e0f2f1; }
        .description { color: #444; line-height: 1.8; font-size: 0.95rem; }
        .btn-apply { background: #00897b; color: #fff; border: none; border-radius: 8px; padding: 13px 35px; font-size: 1rem; font-weight: 600; text-decoration: none; display: inline-block; }
        .btn-apply:hover { background: #00695c; color: #fff; }
        .btn-back { color: #00897b; text-decoration: none; font-weight: 600; font-size: 0.9rem; }
        .btn-back:hover { color: #00695c; }
        .login-notice { background: #e0f2f1; border-radius: 10px; padding: 20px; text-align: center; }
        .login-notice p { color: #00695c; margin-bottom: 12px; font-weight: 500; }

        footer { background: #00695c; color: #fff; padding: 30px 0; margin-top: 50px; }
        footer p { margin: 0; opacity: 0.85; font-size: 0.9rem; }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="/">JobBridge</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto ms-4">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('jobs.index') }}">Browse Jobs</a>
                </li>
            </ul>
            <div class="d-flex gap-2">
                <a href="{{ route('login') }}" class="btn btn-login">Login</a>
                <a href="{{ route('login') }}?register=seeker" class="btn btn-register">Register</a>
            </div>
        </div>
    </div>
</nav>

<!-- Main -->
<div class="main-content">
    <div class="container">

        <div class="mb-4">
            <a href="{{ route('jobs.index') }}" class="btn-back">← Back to Jobs</a>
        </div>

        <div class="job-card">

            <!-- Job Header -->
            <h1 class="job-title">{{ $job->title }}</h1>
            <p class="company-name">{{ $job->employer->name }}</p>

            <div class="d-flex gap-2 flex-wrap mb-4">
                <span class="badge-type">{{ ucfirst($job->job_type) }}</span>
                <span class="badge-category">{{ $job->category->name }}</span>
                @if($job->salary_display)
                    <span class="badge-salary">{{ $job->salary_display }}</span>
                @endif
            </div>

            <!-- Job Info -->
            <div class="mb-4">
                <div class="info-row">
                    <strong>Location:</strong> {{ $job->location }}
                </div>
                <div class="info-row">
                    <strong>Deadline:</strong>
                    <span style="color:#c62828;">{{ $job->deadline }}</span>
                </div>
            </div>

            <hr style="border-color:#f0f0f0;margin-bottom:25px;">

            <!-- Job Description -->
            <p class="section-title">Job Description</p>
            <p class="description">{{ $job->description }}</p>

            <hr style="border-color:#f0f0f0;margin:25px 0;">

            <!-- Apply Section -->
            @auth
                @if(auth()->user()->isSeeker())
                    <a href="{{ route('seeker.jobs.show', $job->id) }}" class="btn-apply">Apply Now</a>
                @endif
            @else
                <div class="login-notice">
                    <p>You need to login or create an account to apply for this job!</p>
                    <div class="d-flex gap-2 justify-content-center">
                        <a href="{{ route('login') }}" class="btn-apply" style="background:#1976d2;">Login to Apply</a>
                        <a href="{{ route('login') }}?register=seeker" class="btn-apply">Create Account</a>
                    </div>
                </div>
            @endauth

        </div>
    </div>
</div>

<!-- Footer -->
<footer>
    <div class="container text-center">
        <p>© 2026 JobBridge. All Rights Reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>