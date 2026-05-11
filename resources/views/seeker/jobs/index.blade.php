<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Jobs - JobBridge</title>    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f5f7fb; }

        /* Sidebar */
        .sidebar { width: 250px; min-height: 100vh; background: #00897b; position: fixed; left: 0; top: 0; z-index: 100; }
        .sidebar-brand { padding: 22px 20px; border-bottom: 1px solid rgba(255,255,255,0.15); display: flex; align-items: center; gap: 10px; }
        .sidebar-brand img { height: 38px; width: auto; }
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

        .search-card { background: #fff; border-radius: 12px; padding: 20px 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); margin-bottom: 25px; }
        .form-control { border: 1.5px solid #e0e0e0; border-radius: 8px; padding: 10px 15px; font-size: 0.9rem; }
        .form-control:focus { border-color: #00897b; box-shadow: 0 0 0 3px rgba(0,137,123,0.1); }
        .form-select { border: 1.5px solid #e0e0e0; border-radius: 8px; padding: 10px 15px; font-size: 0.9rem; }
        .form-select:focus { border-color: #00897b; box-shadow: 0 0 0 3px rgba(0,137,123,0.1); }
        .btn-search { background: #00897b; color: #fff; border: none; border-radius: 8px; padding: 10px 25px; font-weight: 600; }
        .btn-search:hover { background: #00695c; color: #fff; }

        .job-card { background: #fff; border-radius: 12px; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); border: 1.5px solid #f0f0f0; height: 100%; transition: all 0.3s; }
        .job-card:hover { border-color: #00897b; box-shadow: 0 6px 20px rgba(0,137,123,0.12); transform: translateY(-2px); }
        .job-card h6 { font-weight: 700; color: #1a1a2e; font-size: 1rem; margin-bottom: 6px; }
        .job-card .company { color: #555; font-size: 0.88rem; margin-bottom: 4px; }
        .job-card .location { color: #888; font-size: 0.85rem; margin-bottom: 12px; }
        .badge-type { background: #e0f2f1; color: #00695c; border-radius: 20px; padding: 4px 12px; font-size: 0.78rem; font-weight: 600; }
        .badge-category { background: #e3f2fd; color: #1565c0; border-radius: 20px; padding: 4px 12px; font-size: 0.78rem; font-weight: 600; }
        .salary { color: #388e3c; font-size: 0.85rem; font-weight: 600; }
        .deadline { color: #c62828; font-size: 0.82rem; }
        .btn-apply { background: #00897b; color: #fff; border: none; border-radius: 8px; padding: 8px 18px; font-size: 0.88rem; font-weight: 600; text-decoration: none; display: inline-block; }
        .btn-apply:hover { background: #00695c; color: #fff; }

        .no-jobs { background: #fff; border-radius: 12px; padding: 50px; text-align: center; box-shadow: 0 2px 10px rgba(0,0,0,0.06); }
        .no-jobs p { color: #888; font-size: 1rem; }
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
        <h5>Browse Jobs</h5>
        <div class="d-flex align-items-center gap-2">
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div>
                <div style="font-weight:600;font-size:0.9rem;">{{ auth()->user()->name }}</div>
                <div style="color:#888;font-size:0.8rem;">Job Seeker</div>
            </div>
        </div>
    </div>

        <!-- Search & Filter -->
        <div class="search-card">
            <form method="GET" action="{{ route('seeker.jobs') }}">
                <div class="row g-2 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold" style="font-size:0.85rem;">Search</label>
                        <input type="text" name="search" class="form-control" placeholder="Job title or location..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold" style="font-size:0.85rem;">Category</label>
                        <select name="category_id" class="form-select">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold" style="font-size:0.85rem;">Job Type</label>
                        <select name="job_type" class="form-select">
                            <option value="">All Types</option>
                            <option value="full-time" {{ request('job_type') == 'full-time' ? 'selected' : '' }}>Full Time</option>
                            <option value="part-time" {{ request('job_type') == 'part-time' ? 'selected' : '' }}>Part Time</option>
                            <option value="remote" {{ request('job_type') == 'remote' ? 'selected' : '' }}>Remote</option>
                            <option value="internship" {{ request('job_type') == 'internship' ? 'selected' : '' }}>Internship</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn-search w-100">Search</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Jobs Grid -->
        @if($jobs->isEmpty())
            <div class="no-jobs">
                <p>No jobs found matching your criteria.</p>
                <a href="{{ route('seeker.jobs') }}" class="btn-apply mt-3">View All Jobs</a>
            </div>
        @else
            <div class="row g-3">
                @foreach($jobs as $job)
                <div class="col-md-4">
                    <div class="job-card">
                        <h6>{{ $job->title }}</h6>
                        <p class="company">{{ $job->employer->name }}</p>
                        <p class="location">{{ $job->location }}</p>
                        <div class="d-flex gap-2 mb-3 flex-wrap">
                            <span class="badge-type">{{ ucfirst($job->job_type) }}</span>
                            <span class="badge-category">{{ $job->category->name }}</span>
                        </div>
                        @if($job->salary_display)
                            <p class="salary mb-2">{{ $job->salary_display }}</p>
                        @endif
                        <p class="deadline mb-3">Deadline: {{ $job->deadline }}</p>
                        <a href="{{ route('seeker.jobs.show', $job->id) }}" class="btn-apply">View & Apply</a>
                    </div>
                </div>
                @endforeach
            </div>
        @endif

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>