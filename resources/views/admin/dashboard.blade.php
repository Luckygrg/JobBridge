<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - JobBridge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark px-4">
    <span class="navbar-brand fw-bold">JobBridge Admin</span>
    <div class="d-flex align-items-center gap-3">
        <a href="{{ route('admin.users') }}" class="text-white">Users</a>
        <a href="{{ route('admin.jobs') }}" class="text-white">Jobs</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
        </form>
    </div>
</nav>

<div class="container mt-5">
    <h2>Welcome, Admin {{ auth()->user()->name }}! </h2>
    <p class="text-muted">You have full control of JobBridge</p>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-white bg-dark mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <h2>{{ $totalUsers }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Jobs</h5>
                    <h2>{{ $totalJobs }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Applications</h5>
                    <h2>{{ $totalApplications }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Employers</h5>
                    <h2>{{ $totalEmployers }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Seekers</h5>
                    <h2>{{ $totalSeekers }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card p-3">
                <h5 class="mb-3">Users Overview</h5>
                <canvas id="usersChart"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-3">
                <h5 class="mb-3">System Overview</h5>
                <canvas id="systemChart"></canvas>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('admin.users') }}" class="btn btn-dark me-2">Manage Users</a>
        <a href="{{ route('admin.jobs') }}" class="btn btn-outline-dark">Manage Jobs</a>
    </div>
</div>

<script>
const usersChart = new Chart(document.getElementById('usersChart'), {
    type: 'doughnut',
    data: {
        labels: ['Employers', 'Seekers'],
        datasets: [{
            data: [{{ $totalEmployers }}, {{ $totalSeekers }}],
            backgroundColor: ['#0d6efd', '#198754'],
        }]
    },
    options: { responsive: true }
});

const systemChart = new Chart(document.getElementById('systemChart'), {
    type: 'bar',
    data: {
        labels: ['Total Users', 'Total Jobs', 'Total Applications', 'Employers', 'Seekers'],
        datasets: [{
            label: 'Count',
            data: [{{ $totalUsers }}, {{ $totalJobs }}, {{ $totalApplications }}, {{ $totalEmployers }}, {{ $totalSeekers }}],
            backgroundColor: ['#212529', '#0d6efd', '#198754', '#ffc107', '#0dcaf0'],
        }]
    },
    options: { responsive: true }
});
</script>

</body>
</html>