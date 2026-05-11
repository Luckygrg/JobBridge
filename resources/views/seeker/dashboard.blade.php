@extends('layouts.seeker')

@section('title', 'Dashboard - JobBridge')
@section('page-title', 'Dashboard Overview')

@section('content')

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
        <div class="chart-card">
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

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
@endsection