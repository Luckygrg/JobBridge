<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/JobBridge_Logo_BG.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - JobBridge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f5f7fb; }

        /* Sidebar */
        .sidebar { width: 250px; min-height: 100vh; background: #00897b; position: fixed; left: 0; top: 0; z-index: 100; }
        .sidebar-brand { padding: 25px 20px; border-bottom: 1px solid rgba(255,255,255,0.15); }
        .sidebar-brand h4 { color: #fff; font-weight: 700; margin: 0; font-size: 1.3rem; }
        .sidebar-brand p { color: rgba(255,255,255,0.7); font-size: 0.8rem; margin: 0; }
        .sidebar-menu { padding: 15px 0; }
        .sidebar-menu a { display: flex; align-items: center; gap: 12px; padding: 12px 20px; color: rgba(255,255,255,0.8); text-decoration: none; font-size: 0.95rem; font-weight: 500; transition: all 0.3s; }
        .sidebar-menu a:hover { background: rgba(255,255,255,0.15); color: #fff; }
        .sidebar-menu a.active { background: rgba(255,255,255,0.2); color: #fff; border-right: 3px solid #fff; }
        .sidebar-menu .icon { width: 20px; text-align: center; font-size: 1rem; }

        /* Main Content */
        .main-content { margin-left: 250px; padding: 30px; }

        /* Top bar */
        .topbar { background: #fff; border-radius: 12px; padding: 15px 25px; margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px rgba(0,0,0,0.06); }
        .topbar h5 { margin: 0; font-weight: 700; color: #1a1a2e; }
        .topbar .admin-info { display: flex; align-items: center; gap: 10px; }
        .admin-avatar { width: 38px; height: 38px; background: #00897b; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 0.9rem; }

        /* Stat Cards */
        .stat-card { background: #fff; border-radius: 12px; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); border-left: 4px solid; height: 100%; }
        .stat-card.teal { border-color: #00897b; }
        .stat-card.blue { border-color: #1976d2; }
        .stat-card.orange { border-color: #f57c00; }
        .stat-card.green { border-color: #388e3c; }
        .stat-card.purple { border-color: #7b1fa2; }
        .stat-card .label { color: #888; font-size: 0.85rem; font-weight: 500; margin-bottom: 8px; }
        .stat-card .value { font-size: 2rem; font-weight: 700; color: #1a1a2e; margin-bottom: 0; }
        .stat-card .icon-box { width: 45px; height: 45px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; }
        .stat-card.teal .icon-box { background: #e0f2f1; }
        .stat-card.blue .icon-box { background: #e3f2fd; }
        .stat-card.orange .icon-box { background: #fff3e0; }
        .stat-card.green .icon-box { background: #e8f5e9; }
        .stat-card.purple .icon-box { background: #f3e5f5; }

        /* Chart Cards */
        .chart-card { background: #fff; border-radius: 12px; padding: 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); }
        .chart-card h6 { font-weight: 700; color: #1a1a2e; margin-bottom: 20px; font-size: 1rem; }

        /* Buttons */
        .btn-logout { background: rgba(255,255,255,0.15); color: #fff; border: 1px solid rgba(255,255,255,0.3); border-radius: 8px; padding: 8px 16px; font-size: 0.85rem; text-decoration: none; }
        .btn-logout:hover { background: rgba(255,255,255,0.25); color: #fff; }
        .btn-manage { background: #00897b; color: #fff; border: none; border-radius: 8px; padding: 8px 16px; font-size: 0.85rem; text-decoration: none; }
        .btn-manage:hover { background: #00695c; color: #fff; }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-brand">
        <h4>JobBridge</h4>
        <p>Admin Panel</p>
    </div>
    <div class="sidebar-menu">
        <a href="{{ route('admin.dashboard') }}" class="active">
            Dashboard
        </a>
        <a href="{{ route('admin.users') }}">
            Manage Users
        </a>
        <a href="{{ route('admin.jobs') }}">
            Manage Jobs
        </a>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
        </form>
    </div>
</div>

<!-- Main Content -->
<div class="main-content">

    <!-- Topbar -->
    <div class="topbar">
        <h5>Dashboard Overview</h5>
        <div class="admin-info">
            <div class="admin-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div>
                <div style="font-weight:600;font-size:0.9rem;">{{ auth()->user()->name }}</div>
                <div style="color:#888;font-size:0.8rem;">Administrator</div>
            </div>
        </div>
    </div>

    <!-- Stat Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="stat-card teal">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="label">Total Users</p>
                        <p class="value">{{ $totalUsers }}</p>
                    </div>
                    <div class="icon-box teal">U</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card blue">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="label">Total Jobs</p>
                        <p class="value">{{ $totalJobs }}</p>
                    </div>
                    <div class="icon-box blue">J</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card orange">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="label">Total Applications</p>
                        <p class="value">{{ $totalApplications }}</p>
                    </div>
                    <div class="icon-box orange">A</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card green">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="label">Total Employers</p>
                        <p class="value">{{ $totalEmployers }}</p>
                    </div>
                    <div class="icon-box green">E</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card purple">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="label">Total Seekers</p>
                        <p class="value">{{ $totalSeekers }}</p>
                    </div>
                    <div class="icon-box purple">S</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row g-3 mb-4">
        <div class="col-md-5">
            <div class="chart-card">
                <h6>Users Overview</h6>
                <canvas id="usersChart" height="220"></canvas>
            </div>
        </div>
        <div class="col-md-7">
            <div class="chart-card">
                <h6>System Overview</h6>
                <canvas id="systemChart" height="220"></canvas>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row g-3">
        <div class="col-md-6">
            <div class="chart-card">
                <h6>Quick Actions</h6>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="{{ route('admin.users') }}" class="btn-manage">Manage Users</a>
                    <a href="{{ route('admin.jobs') }}" class="btn-manage">Manage Jobs</a>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
const usersChart = new Chart(document.getElementById('usersChart'), {
    type: 'doughnut',
    data: {
        labels: ['Employers', 'Seekers'],
        datasets: [{
            data: [{{ $totalEmployers }}, {{ $totalSeekers }}],
            backgroundColor: ['#00897b', '#1976d2'],
            borderWidth: 0,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { position: 'bottom' } },
        cutout: '65%'
    }
});

const systemChart = new Chart(document.getElementById('systemChart'), {
    type: 'bar',
    data: {
        labels: ['Total Users', 'Total Jobs', 'Applications', 'Employers', 'Seekers'],
        datasets: [{
            label: 'Count',
            data: [{{ $totalUsers }}, {{ $totalJobs }}, {{ $totalApplications }}, {{ $totalEmployers }}, {{ $totalSeekers }}],
            backgroundColor: ['#00897b', '#1976d2', '#f57c00', '#388e3c', '#7b1fa2'],
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