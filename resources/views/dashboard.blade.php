<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seeker Dashboard - JobBridge</title>
    <link rel="icon" type="image/png" href="{{ asset('images/JobBridge_Logo_BG.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f5f7fb; }

       .navbar { background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 15px 0 !important; position: sticky; top: 0; z-index: 100; }
        .navbar-brand { font-size: 1.4rem; font-weight: 700; color: #00897b !important; }
        .nav-link { color: #333 !important; font-weight: 500; font-size: 0.95rem; }
        .nav-link:hover { color: #00897b !important; }
        .nav-link.active { color: #00897b !important; font-weight: 600; }
        .btn-logout { border: 1.5px solid #00897b; color: #00897b; border-radius: 20px; padding: 6px 18px; font-weight: 600; font-size: 0.88rem; }
        .btn-logout:hover { background: #00897b; color: #fff; }

        .main-content { padding: 30px 0; }

        .welcome-bar { background: linear-gradient(135deg, #00897b, #00695c); border-radius: 14px; padding: 25px 30px; color: #fff; margin-bottom: 25px; }
        .welcome-bar h4 { font-weight: 700; margin-bottom: 4px; }
        .welcome-bar p { opacity: 0.85; margin: 0; font-size: 0.95rem; }
        .user-avatar { width: 55px; height: 55px; background: rgba(255,255,255,0.25); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 700; color: #fff; }

        .stat-card { background: #fff; border-radius: 12px; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); border-left: 4px solid; height: 100%; }
        .stat-card.teal { border-color: #00897b; }
        .stat-card.blue { border-color: #1976d2; }
        .stat-card.green { border-color: #388e3c; }
        .stat-card.red { border-color: #c62828; }
        .stat-card .label { color: #888; font-size: 0.85rem; font-weight: 500; margin-bottom: 8px; }
        .stat-card .value { font-size: 2rem; font-weight: 700; color: #1a1a2e; margin-bottom: 0; }

        .chart-card { background: #fff; border-radius: 12px; padding: 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); }
        .chart-card h6 { font-weight: 700; color: #1a1a2e; margin-bottom: 20px; font-size: 1rem; }

        .quick-links { background: #fff; border-radius: 12px; padding: 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); }
        .quick-links h6 { font-weight: 700; color: #1a1a2e; margin-bottom: 15px; }
        .quick-link-btn { display: block; padding: 12px 18px; border-radius: 10px; text-decoration: none; font-weight: 600; font-size: 0.9rem; margin-bottom: 10px; transition: all 0.3s; }
        .quick-link-btn.teal { background: #e0f2f1; color: #00695c; }
        .quick-link-btn.teal:hover { background: #00897b; color: #fff; }
        .quick-link-btn.blue { background: #e3f2fd; color: #1565c0; }
        .quick-link-btn.blue:hover { background: #1976d2; color: #fff; }
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
                    <a class="nav-link active" href="{{ route('seeker.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('seeker.jobs') }}">Browse Jobs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('seeker.applications') }}">My Applications</a>
                </li>
            </ul>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-logout">Logout</button>
            </form>
        </div>
    </div>
</nav>

<!-- Main -->
<div class="main-content">
    <div class="container">

        <!-- Welcome Bar -->
        <div class="welcome-bar d-flex justify-content-between align-items-center">
            <div>
                <h4>Welcome back, {{ auth()->user()->name }}!</h4>
                <p>Find your dream job and track your applications here.</p>
            </div>
            <div class="user-avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
        </div>

        <!-- Stat Cards -->
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="stat-card teal">
                    <p class="label">Jobs Applied</p>
                    <p class="value">{{ $jobsApplied }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card blue">
                    <p class="label">Pending</p>
                    <p class="value">{{ $pending }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card green">
                    <p class="label">Accepted</p>
                    <p class="value">{{ $accepted }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card red">
                    <p class="label">Rejected</p>
                    <p class="value">{{ $rejected }}</p>
                </div>
            </div>
        </div>

        <!-- Charts & Quick Links -->
        <div class="row g-3">
            <div class="col-md-4">
                <div class="chart-card">
                    <h6>Application Status</h6>
                    <canvas id="statusChart" height="220"></canvas>
                </div>
            </div>
            <div class="col-md-5">
                <div class="chart-card">
                    <h6>Applications Overview</h6>
                    <canvas id="overviewChart" height="220"></canvas>
                </div>
            </div>
            <div class="col-md-3">
                <div class="quick-links">
                    <h6>Quick Links</h6>
                    <a href="{{ route('seeker.jobs') }}" class="quick-link-btn teal">Browse Jobs</a>
                    <a href="{{ route('seeker.applications') }}" class="quick-link-btn blue">My Applications</a>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
const statusChart = new Chart(document.getElementById('statusChart'), {
    type: 'doughnut',
    data: {
        labels: ['Pending', 'Accepted', 'Rejected'],
        datasets: [{
            data: [{{ $pending }}, {{ $accepted }}, {{ $rejected }}],
            backgroundColor: ['#1976d2', '#388e3c', '#c62828'],
            borderWidth: 0,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { position: 'bottom' } },
        cutout: '65%'
    }
});

const overviewChart = new Chart(document.getElementById('overviewChart'), {
    type: 'bar',
    data: {
        labels: ['Applied', 'Pending', 'Accepted', 'Rejected'],
        datasets: [{
            label: 'Count',
            data: [{{ $jobsApplied }}, {{ $pending }}, {{ $accepted }}, {{ $rejected }}],
            backgroundColor: ['#00897b', '#1976d2', '#388e3c', '#c62828'],
            borderRadius: 8,
            borderWidth: 0,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: '#f0f0f0' } },
            x: { grid: { display: false } }
        }
    }
});
</script>

</body>
</html>