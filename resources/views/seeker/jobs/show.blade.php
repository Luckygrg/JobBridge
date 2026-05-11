<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Details - JobBridge</title>
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

        .job-card { background: #fff; border-radius: 14px; padding: 35px; box-shadow: 0 2px 15px rgba(0,0,0,0.08); }
        .job-title { font-size: 1.6rem; font-weight: 700; color: #1a1a2e; margin-bottom: 5px; }
        .company-name { color: #555; font-size: 1rem; margin-bottom: 15px; }
        .badge-type { background: #e0f2f1; color: #00695c; border-radius: 20px; padding: 5px 14px; font-size: 0.82rem; font-weight: 600; }
        .badge-category { background: #e3f2fd; color: #1565c0; border-radius: 20px; padding: 5px 14px; font-size: 0.82rem; font-weight: 600; }
        .badge-salary { background: #e8f5e9; color: #2e7d32; border-radius: 20px; padding: 5px 14px; font-size: 0.82rem; font-weight: 600; }
        .info-item { display: flex; align-items: center; gap: 8px; color: #555; font-size: 0.9rem; margin-bottom: 8px; }
        .info-item strong { color: #333; }
        .section-title { font-size: 1rem; font-weight: 700; color: #1a1a2e; margin-bottom: 12px; padding-bottom: 8px; border-bottom: 2px solid #e0f2f1; }
        .description { color: #444; line-height: 1.8; font-size: 0.95rem; }

        .apply-section { background: #f8f9fa; border-radius: 12px; padding: 25px; margin-top: 25px; }
        .apply-section h5 { font-weight: 700; color: #1a1a2e; margin-bottom: 20px; }

        .form-control { border: 1.5px solid #e0e0e0; border-radius: 8px; padding: 11px 15px; font-size: 0.9rem; }
        .form-control:focus { border-color: #00897b; box-shadow: 0 0 0 3px rgba(0,137,123,0.1); }
        .form-label { font-weight: 600; color: #444; font-size: 0.88rem; margin-bottom: 6px; }
        .btn-submit { background: #00897b; color: #fff; border: none; border-radius: 8px; padding: 12px 30px; font-size: 0.95rem; font-weight: 600; }
        .btn-submit:hover { background: #00695c; color: #fff; }

        .already-applied { background: #e0f2f1; border-radius: 10px; padding: 20px; text-align: center; }
        .already-applied p { color: #00695c; font-weight: 600; margin: 0; }

        .alert-success { border-radius: 8px; border: none; background: #e0f2f1; color: #00695c; }
        .alert-danger { border-radius: 8px; border: none; background: #ffebee; color: #c62828; }

        .btn-back { color: #00897b; text-decoration: none; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 5px; margin-bottom: 20px; }
        .btn-back:hover { color: #00695c; }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-brand">
        <span>JobBridge</span>
    </div>
    <div class="sidebar-menu">
        <a href="{{ route('seeker.dashboard') }}">
            <i class="bi bi-grid-fill"></i> Dashboard
        </a>
        <a href="{{ route('seeker.jobs') }}" class="active">
            <i class="bi bi-briefcase-fill"></i> Browse Jobs
        </a>
        <a href="{{ route('seeker.applications') }}">
            <i class="bi bi-file-earmark-text-fill"></i> My Applications
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

<!-- Main Content -->
<div class="main-content">

    <!-- Topbar -->
    <div class="topbar">
        <h5>Job Details</h5>
        <div class="d-flex align-items-center gap-2">
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div>
                <div style="font-weight:600;font-size:0.9rem;">{{ auth()->user()->name }}</div>
                <div style="color:#888;font-size:0.8rem;">Job Seeker</div>
            </div>
        </div>
    </div>

    <!-- Back Link -->
    <a href="{{ route('seeker.jobs') }}" class="btn-back">
        <i class="bi bi-arrow-left"></i> Back to Jobs
    </a>

    <!-- Job Detail Card -->
    <div class="job-card">

        @if(session('success'))
            <div class="alert alert-success mb-4">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger mb-4">{{ session('error') }}</div>
        @endif

        <!-- Job Header -->
        <h1 class="job-title">{{ $job->title }}</h1>
        <p class="company-name">{{ $job->employer->name }}</p>

        <div class="d-flex gap-2 flex-wrap mb-4">
            <span class="badge-type">{{ ucfirst($job->job_type) }}</span>
            <span class="badge-category">{{ $job->category->name }}</span>
            @if($job->salary)
                <span class="badge-salary">{{ $job->salary }}</span>
            @endif
        </div>

        <!-- Job Info -->
        <div class="mb-4">
            <div class="info-item">
                <i class="bi bi-geo-alt-fill" style="color:#00897b;"></i>
                <strong>Location:</strong> {{ $job->location }}
            </div>
            <div class="info-item">
                <i class="bi bi-calendar-x-fill" style="color:#c62828;"></i>
                <strong>Deadline:</strong>
                <span style="color:#c62828;">{{ $job->deadline }}</span>
            </div>
        </div>

        <hr style="border-color:#f0f0f0;margin-bottom:25px;">

        <!-- Description -->
        <p class="section-title">Job Description</p>
        <p class="description">{{ $job->description }}</p>

        <!-- Apply Section -->
        <div class="apply-section">
            @if($applied)
                <div class="already-applied">
                    <i class="bi bi-check-circle-fill" style="color:#00897b;font-size:1.5rem;margin-bottom:8px;display:block;"></i>
                    <p>You have already applied for this job!</p>
                </div>
            @else
                <h5>Apply for this Job</h5>
                <form method="POST" action="{{ route('seeker.jobs.apply', $job->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Cover Letter</label>
                        <textarea name="cover_letter" class="form-control" rows="5"
                                  placeholder="Write why you are suitable for this job..." required></textarea>
                        @error('cover_letter')
                            <div class="text-danger mt-1" style="font-size:0.85rem;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Resume (PDF only)</label>
                        <input type="file" name="resume" class="form-control" accept=".pdf" required>
                        @error('resume')
                            <div class="text-danger mt-1" style="font-size:0.85rem;">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn-submit">Apply Now</button>
                </form>
            @endif
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>