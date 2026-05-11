@extends('layouts.seeker')

@section('title', 'Browse Jobs - JobBridge')
@section('page-title', 'Browse Jobs')

@section('styles')
<style>
    .job-card { background: #fff; border-radius: 12px; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); border: 1.5px solid #f0f0f0; height: 100%; transition: all 0.3s; }
    .job-card:hover { border-color: #00897b; box-shadow: 0 6px 20px rgba(0,137,123,0.12); transform: translateY(-2px); }
    .job-card h6 { font-weight: 700; color: #1a1a2e; font-size: 1rem; margin-bottom: 6px; }
    .job-card .company { color: #555; font-size: 0.88rem; margin-bottom: 4px; }
    .job-card .location { color: #888; font-size: 0.85rem; margin-bottom: 12px; }
    .badge-type { background: #e0f2f1; color: #00695c; border-radius: 20px; padding: 4px 12px; font-size: 0.78rem; font-weight: 600; }
    .badge-category { background: #e3f2fd; color: #1565c0; border-radius: 20px; padding: 4px 12px; font-size: 0.78rem; font-weight: 600; }
    .salary { color: #388e3c; font-size: 0.85rem; font-weight: 600; }
    .deadline { color: #c62828; font-size: 0.82rem; }
    .btn-apply { background: #00897b; color: #fff; border: none; border-radius: 8px; padding: 8px 18px; font-size: 0.88rem; font-weight: 600; text-decoration: none; display: inline-block; }
    .btn-apply:hover { background: #00695c; color: #fff; }
    .search-card { background: #fff; border-radius: 12px; padding: 20px 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); margin-bottom: 25px; }
</style>
@endsection

@section('content')

@if(session('error'))
    <div class="alert alert-danger mb-3" style="border-radius:8px;border:none;background:#ffebee;color:#c62828;">
        {{ session('error') }}
    </div>
@endif

<div class="search-card">
    <form method="GET" action="{{ route('seeker.jobs') }}">
        <div class="row g-2 align-items-end">
            <div class="col-md-4">
                <label class="form-label fw-semibold" style="font-size:0.85rem;">Search</label>
                <input type="text" name="search" class="form-control"
                       placeholder="Job title or location..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold" style="font-size:0.85rem;">Category</label>
                <select name="category_id" class="form-select">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold" style="font-size:0.85rem;">Job Type</label>
                <select name="job_type" class="form-select">
                    <option value="">All Types</option>
                    <option value="full-time" {{ request('job_type') == 'full-time' ? 'selected' : '' }}>Full Time</option>
                    <option value="part-time" {{ request('job_type') == 'part-time' ? 'selected' : '' }}>Part Time</option>
                    <option value="remote" {{ request('job_type') == 'remote' ? 'selected' : '' }}>Remote</option>
                    <option value="internship" {{ request('job_type') == 'internship' ? 'selected' : '' }}>Internship</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn-submit w-100">Search</button>
            </div>
        </div>
    </form>
</div>

@if($jobs->isEmpty())
    <div class="content-card text-center py-5">
        <p style="color:#888;font-size:1rem;">No jobs found matching your criteria.</p>
        <a href="{{ route('seeker.jobs') }}" class="btn-apply mt-3">View All Jobs</a>
    </div>
@else
    <div class="row g-3 mb-4">
        @foreach($jobs as $job)
        <div class="col-md-4">
            <div class="job-card">
                <h6>{{ $job->title }}</h6>
                <p class="company">{{ $job->employer->name }}</p>
                <p class="location">{{ $job->location }}</p>
                <div class="d-flex gap-2 mb-3 flex-wrap">
                    <span class="badge-type">{{ ucfirst($job->job_type) }}</span>
                    <span class="badge-category">{{ $job->category->name }}</span>
                </div>
                <p class="salary mb-2">{{ $job->salary_display }}</p>
                <p class="deadline mb-3">Deadline: {{ $job->deadline }}</p>
                <a href="{{ route('seeker.jobs.show', $job->id) }}" class="btn-apply">View & Apply</a>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $jobs->withQueryString()->links() }}
    </div>
@endif

@endsection