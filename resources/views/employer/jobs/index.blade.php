@extends('layouts.employer')

@section('title', 'My Jobs - JobBridge')
@section('page-title', 'My Job Listings')

@section('styles')
<style>
    .btn-edit { background: #fff3e0; color: #e65100; border: none; border-radius: 6px; padding: 6px 12px; font-size: 0.82rem; font-weight: 600; text-decoration: none; }
    .btn-edit:hover { background: #e65100; color: #fff; }
    .btn-delete { background: #ffebee; color: #c62828; border: none; border-radius: 6px; padding: 6px 12px; font-size: 0.82rem; font-weight: 600; }
    .btn-delete:hover { background: #c62828; color: #fff; }
    .btn-applicants { background: #e0f2f1; color: #00695c; border: none; border-radius: 6px; padding: 6px 12px; font-size: 0.82rem; font-weight: 600; text-decoration: none; }
    .btn-applicants:hover { background: #00897b; color: #fff; }
    .btn-post-new { background: #fff; color: #00897b; border-radius: 8px; padding: 10px 20px; font-weight: 600; text-decoration: none; border: 2px solid #fff; }
    .btn-post-new:hover { background: #e0f2f1; color: #00695c; }
</style>
@endsection

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4"
     style="background:linear-gradient(135deg,#00897b,#00695c);border-radius:14px;padding:20px 25px;">
    <div>
        <h5 style="color:#fff;font-weight:700;margin:0;">My Job Listings</h5>
        <p style="color:rgba(255,255,255,0.8);margin:0;font-size:0.9rem;">Manage all your posted jobs</p>
    </div>
    <a href="{{ route('employer.jobs.create') }}" class="btn-post-new">+ Post New Job</a>
</div>

<div class="content-card">
    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    @if($jobs->isEmpty())
        <div class="text-center py-5">
            <p style="color:#888;">No jobs posted yet.</p>
            <a href="{{ route('employer.jobs.create') }}"
               style="background:#00897b;color:#fff;border-radius:8px;padding:10px 20px;font-weight:600;text-decoration:none;">
               Post Your First Job
            </a>
        </div>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Job Title</th>
                    <th>Category</th>
                    <th>Location</th>
                    <th>Job Type</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jobs as $index => $job)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><div style="font-weight:600;">{{ $job->title }}</div></td>
                    <td>{{ $job->category->name }}</td>
                    <td>{{ $job->location }}</td>
                    <td>{{ ucfirst($job->job_type) }}</td>
                    <td>{{ $job->deadline }}</td>
                    <td>
                        @if($job->status == 'active')
                            <span class="badge-active">Active</span>
                        @else
                            <span class="badge-closed">Closed</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-1 flex-wrap">
                            <a href="{{ route('employer.applications', $job->id) }}" class="btn-applicants">Applicants</a>
                            <a href="{{ route('employer.jobs.edit', $job->id) }}" class="btn-edit">Edit</a>
                            <form action="{{ route('employer.jobs.destroy', $job->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete"
                                        onclick="return confirm('Delete this job?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-4">
            {{ $jobs->withQueryString()->links() }}
        </div>
    @endif
</div>

@endsection