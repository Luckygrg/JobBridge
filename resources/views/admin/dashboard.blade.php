@extends('layouts.admin')

@section('title', 'Admin Dashboard - JobBridge')
@section('page-title', 'Dashboard Overview')

@section('content')

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card teal d-flex justify-content-between align-items-center">
            <div>
                <p class="label">Total Users</p>
                <p class="value">{{ $totalUsers }}</p>
            </div>
            <div class="icon-box"><i class="bi bi-people-fill"></i></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card blue d-flex justify-content-between align-items-center">
            <div>
                <p class="label">Total Jobs</p>
                <p class="value">{{ $totalJobs }}</p>
            </div>
            <div class="icon-box"><i class="bi bi-briefcase-fill"></i></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card orange d-flex justify-content-between align-items-center">
            <div>
                <p class="label">Total Applications</p>
                <p class="value">{{ $totalApplications }}</p>
            </div>
            <div class="icon-box"><i class="bi bi-file-earmark-text-fill"></i></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card green d-flex justify-content-between align-items-center">
            <div>
                <p class="label">Total Employers</p>
                <p class="value">{{ $totalEmployers }}</p>
            </div>
            <div class="icon-box"><i class="bi bi-building"></i></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card purple d-flex justify-content-between align-items-center">
            <div>
                <p class="label">Total Seekers</p>
                <p class="value">{{ $totalSeekers }}</p>
            </div>
            <div class="icon-box"><i class="bi bi-person-fill"></i></div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-4">
        <div class="chart-card">
            <h6>Users Overview</h6>
            <canvas id="usersChart" height="220"></canvas>
        </div>
    </div>
    <div class="col-md-5">
        <div class="chart-card">
            <h6>System Overview</h6>
            <canvas id="systemChart" height="220"></canvas>
        </div>
    </div>
    <div class="col-md-3">
        <div class="chart-card">
            <h6>Quick Actions</h6>
            <a href="{{ route('admin.users') }}" class="quick-link-btn teal">
                <i class="bi bi-people-fill"></i> Manage Users
            </a>
            <a href="{{ route('admin.jobs') }}" class="quick-link-btn blue">
                <i class="bi bi-briefcase-fill"></i> Manage Jobs
            </a>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        labels: ['Users', 'Jobs', 'Applications', 'Employers', 'Seekers'],
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
@endsection