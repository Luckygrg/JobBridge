<!DOCTYPE html>
<html>
<head>
    <title>Seeker Dashboard - JobBridge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-success px-4">
    <span class="navbar-brand fw-bold">JobBridge </span>
    <div class="d-flex align-items-center gap-3">
        <a href="{{ route('seeker.jobs') }}" class="text-white">Browse Jobs</a>
        <a href="{{ route('seeker.applications') }}" class="text-white">My Applications</a>
        <span class="text-white">{{ auth()->user()->name }}</span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
        </form>
    </div>
</nav>

<div class="container mt-5">
    <h2>Welcome, {{ auth()->user()->name }}! </h2>
    <p class="text-muted">You are logged in as <strong>Job Seeker</strong></p>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Jobs Applied</h5>
                    <h2>{{ $jobsApplied }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Pending</h5>
                    <h2>{{ $pending }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Accepted</h5>
                    <h2>{{ $accepted }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('seeker.jobs') }}" class="btn btn-success me-2">Browse Jobs</a>
        <a href="{{ route('seeker.applications') }}" class="btn btn-outline-success">My Applications</a>
    </div>
</div>

</body>
</html>