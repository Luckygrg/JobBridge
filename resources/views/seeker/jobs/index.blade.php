<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/JobBridge_Logo_BG.png') }}">
    <title>Browse Jobs - JobBridge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-success px-4">
    <span class="navbar-brand fw-bold">JobBridge 🌉</span>
    <div class="d-flex align-items-center gap-3">
        <a href="{{ route('seeker.dashboard') }}" class="text-white">Dashboard</a>
        <a href="{{ route('seeker.jobs') }}" class="text-white">Browse Jobs</a>
        <a href="{{ route('seeker.applications') }}" class="text-white">My Applications</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
        </form>
    </div>
</nav>

<div class="container mt-4">
    <h3 class="mb-3">Browse Jobs</h3>

    <!-- Search & Filter -->
    <form method="GET" action="{{ route('seeker.jobs') }}" class="row g-2 mb-4">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control"
                   placeholder="Search by title or location..." value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
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
            <select name="job_type" class="form-select">
                <option value="">All Job Types</option>
                <option value="full-time" {{ request('job_type') == 'full-time' ? 'selected' : '' }}>Full Time</option>
                <option value="part-time" {{ request('job_type') == 'part-time' ? 'selected' : '' }}>Part Time</option>
                <option value="remote" {{ request('job_type') == 'remote' ? 'selected' : '' }}>Remote</option>
                <option value="internship" {{ request('job_type') == 'internship' ? 'selected' : '' }}>Internship</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-success w-100">Search</button>
        </div>
    </form>

    @if($jobs->isEmpty())
        <div class="alert alert-info">No jobs found!</div>
    @else
        <div class="row">
            @foreach($jobs as $job)
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $job->title }}</h5>
                        <p class="text-muted mb-1">📍 {{ $job->location }}</p>
                        <p class="text-muted mb-1">🏢 {{ $job->employer->name }}</p>
                        <p class="text-muted mb-2">📂 {{ $job->category->name }}</p>
                        <span class="badge bg-primary">{{ ucfirst($job->job_type) }}</span>
                        @if($job->salary)
                            <span class="badge bg-success">💰 {{ $job->salary }}</span>
                        @endif
                        <p class="mt-2 text-danger">⏰ Deadline: {{ $job->deadline }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('seeker.jobs.show', $job->id) }}" class="btn btn-success btn-sm">View & Apply</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>

</body>
</html>