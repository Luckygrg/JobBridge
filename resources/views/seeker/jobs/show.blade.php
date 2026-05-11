@extends('layouts.seeker')

@section('title', 'Job Details - JobBridge')
@section('page-title', 'Job Details')

@section('styles')
<style>
    .job-card { background: #fff; border-radius: 14px; padding: 35px; box-shadow: 0 2px 15px rgba(0,0,0,0.08); }
    .job-title { font-size: 1.6rem; font-weight: 700; color: #1a1a2e; margin-bottom: 5px; }
    .company-name { color: #555; font-size: 1rem; margin-bottom: 15px; }
    .badge-type { background: #e0f2f1; color: #00695c; border-radius: 20px; padding: 5px 14px; font-size: 0.82rem; font-weight: 600; }
    .badge-category { background: #e3f2fd; color: #1565c0; border-radius: 20px; padding: 5px 14px; font-size: 0.82rem; font-weight: 600; }
    .badge-salary { background: #e8f5e9; color: #2e7d32; border-radius: 20px; padding: 5px 14px; font-size: 0.82rem; font-weight: 600; }
    .info-item { display: flex; align-items: center; gap: 8px; color: #555; font-size: 0.9rem; margin-bottom: 8px; }
    .description { color: #444; line-height: 1.8; font-size: 0.95rem; }
    .apply-section { background: #f8f9fa; border-radius: 12px; padding: 25px; margin-top: 25px; }
    .apply-section h5 { font-weight: 700; color: #1a1a2e; margin-bottom: 20px; }
    .already-applied { background: #e0f2f1; border-radius: 10px; padding: 20px; text-align: center; }
    .already-applied p { color: #00695c; font-weight: 600; margin: 0; }
    .btn-back { color: #00897b; text-decoration: none; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 5px; margin-bottom: 20px; }
    .btn-back:hover { color: #00695c; }
</style>
@endsection

@section('content')

<a href="{{ route('seeker.jobs') }}" class="btn-back">
    <i class="bi bi-arrow-left"></i> Back to Jobs
</a>

<div class="job-card">

    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger mb-4" style="background:#ffebee;color:#c62828;border:none;">{{ session('error') }}</div>
    @endif

    <h1 class="job-title">{{ $job->title }}</h1>
    <p class="company-name">{{ $job->employer->name }}</p>

    <div class="d-flex gap-2 flex-wrap mb-4">
        <span class="badge-type">{{ ucfirst($job->job_type) }}</span>
        <span class="badge-category">{{ $job->category->name }}</span>
        <span class="badge-salary">{{ $job->salary_display }}</span>
    </div>

    <div class="mb-4">
        <div class="info-item">
            <i class="bi bi-geo-alt-fill" style="color:#00897b;"></i>
            <strong>Location:</strong> {{ $job->location }}
        </div>
        <div class="info-item">
            <i class="bi bi-calendar-x-fill" style="color:#c62828;"></i>
            <strong>Deadline:</strong>
            <span style="color:#c62828;">{{ $job->deadline }}</span>
        </div>
    </div>

    <hr style="border-color:#f0f0f0;margin-bottom:25px;">

    <p class="section-title">Job Description</p>
    <p class="description">{{ $job->description }}</p>

    <div class="apply-section">
        @if($applied)
            <div class="already-applied">
                <i class="bi bi-check-circle-fill" style="color:#00897b;font-size:1.5rem;margin-bottom:8px;display:block;"></i>
                <p>You have already applied for this job!</p>
            </div>
        @else
            <h5>Apply for this Job</h5>
            <form method="POST" action="{{ route('seeker.jobs.apply', $job->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Cover Letter</label>
                    <textarea name="cover_letter" class="form-control" rows="5"
                              placeholder="Write why you are suitable for this job..." required></textarea>
                    @error('cover_letter')
                        <div class="text-danger mt-1" style="font-size:0.85rem;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="form-label">Resume (PDF only)</label>
                    <input type="file" name="resume" class="form-control" accept=".pdf" required>
                    @error('resume')
                        <div class="text-danger mt-1" style="font-size:0.85rem;">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn-submit">Apply Now</button>
            </form>
        @endif
    </div>
</div>

@endsection