<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Jobs - JobBridge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f5f7fb; }

        .navbar { background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 15px 0; position: sticky; top: 0; z-index: 100; }
        .navbar-brand { font-size: 1.4rem; font-weight: 700; color: #00897b !important; }
        .nav-link { color: #333 !important; font-weight: 500; font-size: 0.95rem; }
        .nav-link:hover { color: #00897b !important; }
        .nav-link.active { color: #00897b !important; font-weight: 600; border-bottom: 2px solid #00897b; }
        .btn-login { border: 1.5px solid #00897b; color: #00897b; border-radius: 20px; padding: 6px 18px; font-weight: 600; font-size: 0.88rem; }
        .btn-login:hover { background: #00897b; color: #fff; }
        .btn-register { background: #00897b; color: #fff; border-radius: 20px; padding: 6px 18px; font-weight: 600; font-size: 0.88rem; border: none; }
        .btn-register:hover { background: #00695c; color: #fff; }

        .page-header { background: linear-gradient(135deg, #00897b, #00695c); padding: 50px 0; color: #fff; margin-bottom: 30px; }
        .page-header h2 { font-weight: 700; margin-bottom: 8px; }
        .page-header p { opacity: 0.85; font-size: 1rem; }

        .search-card { background: #fff; border-radius: 12px; padding: 20px 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); margin-bottom: 25px; }
        .form-control { border: 1.5px solid #e0e0e0; border-radius: 8px; padding: 10px 15px; font-size: 0.9rem; }
        .form-control:focus { border-color: #00897b; box-shadow: 0 0 0 3px rgba(0,137,123,0.1); }
        .form-select { border: 1.5px solid #e0e0e0; border-radius: 8px; padding: 10px 15px; font-size: 0.9rem; }
        .form-select:focus { border-color: #00897b; box-shadow: 0 0 0 3px rgba(0,137,123,0.1); }
        .btn-search { background: #00897b; color: #fff; border: none; border-radius: 8px; padding: 10px 25px; font-weight: 600; width: 100%; }
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

        .results-info { color: #666; font-size: 0.9rem; margin-bottom: 15px; }

        .pagination .page-link { color: #00897b; border-color: #e0e0e0; }
        .pagination .page-item.active .page-link { background: #00897b; border-color: #00897b; color: #fff; }
        .pagination .page-link:hover { background: #e0f2f1; color: #00695c; }

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

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h2>Browse Jobs</h2>
        <p>Find the perfect job that matches your skills and interests.</p>
    </div>
</div>

<!-- Main Content -->
<div class="container pb-5">

    <!-- Search & Filter -->
    <div class="search-card">
        <form method="GET" action="{{ route('jobs.index') }}">
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
                    <button type="submit" class="btn-search">Search</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Results Info -->
    <p class="results-info">Showing {{ $jobs->firstItem() ?? 0 }} - {{ $jobs->lastItem() ?? 0 }} of {{ $jobs->total() }} jobs</p>

    <!-- Jobs Grid -->
    @if($jobs->isEmpty())
        <div class="text-center py-5">
            <p style="color:#888;font-size:1rem;">No jobs found matching your criteria.</p>
            <a href="{{ route('jobs.index') }}" class="btn-apply mt-3">View All Jobs</a>
        </div>
    @else
        <div class="row g-3 mb-4">
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
                    @if($job->salary)
                        <p class="salary mb-2">{{ $job->salary }}</p>
                    @endif
                    <p class="deadline mb-3">Deadline: {{ $job->deadline }}</p>
                    <a href="{{ route('jobs.show', $job->id) }}" class="btn-apply">View Details</a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $jobs->withQueryString()->links() }}
        </div>
    @endif

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