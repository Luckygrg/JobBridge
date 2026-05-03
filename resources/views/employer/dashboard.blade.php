<!DOCTYPE html>
<html>
<head>
    <title>Employer Dashboard - JobBridge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-primary px-4">
    <span class="navbar-brand fw-bold">JobBridge 🌉</span>
    <div class="d-flex align-items-center">
        <span class="text-white me-3">{{ auth()->user()->name }}</span>
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
                    <h2>0</h2>
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
</div>

</body>
</html>