<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seeker Dashboard - JobBridge</title>    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        /* Main */
        .main-content { margin-left: 250px; padding: 30px; }

        /* Topbar */
        .topbar { background: #fff; border-radius: 12px; padding: 15px 25px; margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px rgba(0,0,0,0.06); }
        .topbar h5 { margin: 0; font-weight: 700; color: #1a1a2e; }
        .user-avatar { width: 38px; height: 38px; background: #00897b; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 0.9rem; }

        /* Stat Cards */
        .stat-card { background: #fff; border-radius: 12px; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); border-left: 4px solid; height: 100%; }
        .stat-card.teal { border-color: #00897b; }
        .stat-card.blue { border-color: #1976d2; }
        .stat-card.green { border-color: #388e3c; }
        .stat-card.red { border-color: #c62828; }
        .stat-card .label { color: #888; font-size: 0.85rem; font-weight: 500; margin-bottom: 8px; }
        .stat-card .value { font-size: 2rem; font-weight: 700; color: #1a1a2e; margin-bottom: 0; }
        .stat-card .icon-box { width: 45px; height: 45px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; }
        .stat-card.teal .icon-box { background: #e0f2f1; color: #00897b; }
        .stat-card.blue .icon-box { background: #e3f2fd; color: #1976d2; }
        .stat-card.green .icon-box { background: #e8f5e9; color: #388e3c; }
        .stat-card.red .icon-box { background: #ffebee; color: #c62828; }

        /* Chart & Quick Links Cards */
        .chart-card { background: #fff; border-radius: 12px; padding: 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); }
        .chart-card h6 { font-weight: 700; color: #1a1a2e; margin-bottom: 20px; font-size: 1rem; }
        .quick-links h6 { font-weight: 700; color: #1a1a2e; margin-bottom: 15px; }
        .quick-link-btn { display: flex; align-items: center; gap: 10px; padding: 12px 16px; border-radius: 10px; text-decoration: none; font-weight: 600; font-size: 0.9rem; margin-bottom: 10px; transition: all 0.3s; }
        .quick-link-btn.teal { background: #e0f2f1; color: #00695c; }
        .quick-link-btn.teal:hover { background: #00897b; color: #fff; }
        .quick-link-btn.blue { background: #e3f2fd; color: #1565c0; }
        .quick-link-btn.blue:hover { background: #1976d2; color: #fff; }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-brand">
        <span>JobBridge</span>
    </div>
    <div class="sidebar-menu">
        <a href="{{ route('seeker.dashboard') }}" class="active">
            <i class="bi bi-grid-fill"></i> Dashboard
        </a>
        <a href="{{ route('seeker.jobs') }}">
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
        <h5>Dashboard Overview</h5>
        <div class="d-flex align-items-center gap-2">
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div>
                <div style="font-weight:600;font-size:0.9rem;">{{ auth()->user()->name }}</div>
                <div style="color:#888;font-size:0.8rem;">Job Seeker</div>
            </div>
        </div>
    </div>

    <!-- Stat Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="stat-card teal d-flex justify-content-between align-items-center">
                <div>
                    <p class="label">Jobs Applied</p>
                    <p class="value">{{ $jobsApplied }}</p>
                </div>
                <div class="icon-box"><i class="bi bi-send-fill"></i></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card blue d-flex justify-content-between align-items-center">
                <div>
                    <p class="label">Pending</p>
                    <p class="value">{{ $pending }}</p>
                </div>
                <div class="icon-box"><i class="bi bi-hourglass-split"></i></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card green d-flex justify-content-between align-items-center">
                <div>
                    <p class="label">Accepted</p>
                    <p class="value">{{ $accepted }}</p>
                </div>
                <div class="icon-box"><i class="bi bi-check-circle-fill"></i></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card red d-flex justify-content-between align-items-center">
                <div>
                    <p class="label">Rejected</p>
                    <p class="value">{{ $rejected }}</p>
                </div>
                <div class="icon-box"><i class="bi bi-x-circle-fill"></i></div>
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
            <div class="chart-card quick-links">
                <h6>Quick Links</h6>
                <a href="{{ route('seeker.jobs') }}" class="quick-link-btn teal">
                    <i class="bi bi-briefcase-fill"></i> Browse Jobs
                </a>
                <a href="{{ route('seeker.applications') }}" class="quick-link-btn blue">
                    <i class="bi bi-file-earmark-text-fill"></i> My Applications
                </a>
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