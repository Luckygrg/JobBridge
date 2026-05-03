<!DOCTYPE html>
<html>
<head>
    <title>Employer Dashboard - JobBridge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-primary px-4">
    <span class="navbar-brand fw-bold">JobBridge 🌉</span>
    <div class="d-flex align-items-center gap-3">
        <a href="{{ route('employer.jobs.index') }}" class="text-white">My Jobs</a>
        <a href="{{ route('employer.jobs.create') }}" class="btn btn-light btn-sm">+ Post Job</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
        </form>
    </div>
</nav>

<div class="container mt-5">
    <h2>Welcome, {{ auth()->user()->name }}! 👋</h2>
    <p class="text-muted">You are logged in as <strong>Employer</strong></p>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Jobs Posted</h5>
                    <h2>{{ $jobsPosted }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Applicants</h5>
                    <h2>0</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Pending Reviews</h5>
                    <h2>0</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('employer.jobs.create') }}" class="btn btn-primary me-2">+ Post a Job</a>
        <a href="{{ route('employer.jobs.index') }}" class="btn btn-outline-primary">View My Jobs</a>
    </div>
</div>

</body>
</html>