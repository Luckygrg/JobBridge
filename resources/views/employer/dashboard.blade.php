@extends('layouts.employer')

@section('title', 'Employer Dashboard - JobBridge')
@section('page-title', 'Dashboard Overview')

@section('content')

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card teal d-flex justify-content-between align-items-center">
            <div>
                <p class="label">Jobs Posted</p>
                <p class="value">{{ $jobsPosted }}</p>
            </div>
            <div class="icon-box"><i class="bi bi-briefcase-fill"></i></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card blue d-flex justify-content-between align-items-center">
            <div>
                <p class="label">Total Applicants</p>
                <p class="value">{{ $totalApplicants }}</p>
            </div>
            <div class="icon-box"><i class="bi bi-people-fill"></i></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card orange d-flex justify-content-between align-items-center">
            <div>
                <p class="label">Pending Reviews</p>
                <p class="value">{{ $pendingReviews }}</p>
            </div>
            <div class="icon-box"><i class="bi bi-hourglass-split"></i></div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-4">
        <div class="chart-card">
            <h6>Application Status</h6>
            <canvas id="applicationChart" height="220"></canvas>
        </div>
    </div>
    <div class="col-md-5">
        <div class="chart-card">
            <h6>Jobs Overview</h6>
            <canvas id="jobsChart" height="220"></canvas>
        </div>
    </div>
    <div class="col-md-3">
        <div class="chart-card">
            <h6>Quick Links</h6>
            <a href="{{ route('employer.jobs.create') }}" class="quick-link-btn teal">
                <i class="bi bi-plus-circle-fill"></i> Post a Job
            </a>
            <a href="{{ route('employer.jobs.index') }}" class="quick-link-btn blue">
                <i class="bi bi-briefcase-fill"></i> View My Jobs
            </a>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const applicationChart = new Chart(document.getElementById('applicationChart'), {
    type: 'doughnut',
    data: {
        labels: ['Pending', 'Accepted', 'Rejected'],
        datasets: [{
            data: [{{ $pendingReviews }}, {{ $accepted }}, {{ $rejected }}],
            backgroundColor: ['#f57c00', '#00897b', '#c62828'],
            borderWidth: 0,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { position: 'bottom' } },
        cutout: '65%'
    }
});

const jobsChart = new Chart(document.getElementById('jobsChart'), {
    type: 'bar',
    data: {
        labels: ['Jobs Posted', 'Total Applicants', 'Pending'],
        datasets: [{
            label: 'Count',
            data: [{{ $jobsPosted }}, {{ $totalApplicants }}, {{ $pendingReviews }}],
            backgroundColor: ['#00897b', '#1976d2', '#f57c00'],
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