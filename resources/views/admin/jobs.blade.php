@extends('layouts.admin')

@section('title', 'Manage Jobs - JobBridge')
@section('page-title', 'Manage Jobs')

@section('content')

<div class="content-card">

    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    <div class="stats-row mb-4">
        <div class="mini-stat">
            <div class="num">{{ $jobs->total() }}</div>
            <div class="lbl">Total Jobs</div>
        </div>
        <div class="mini-stat">
            <div class="num">{{ $jobs->where('status', 'active')->count() }}</div>
            <div class="lbl">Active</div>
        </div>
        <div class="mini-stat">
            <div class="num">{{ $jobs->where('status', 'closed')->count() }}</div>
            <div class="lbl">Closed</div>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Job Title</th>
                <th>Employer</th>
                <th>Category</th>
                <th>Location</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $index => $job)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    <div style="font-weight:600;">{{ $job->title }}</div>
                    <div style="font-size:0.8rem;color:#888;">{{ ucfirst($job->job_type) }}</div>
                </td>
                <td>
                    <div class="d-flex align-items-center gap-2">
                        <div style="width:34px;height:34px;background:#e0f2f1;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;color:#00897b;font-size:0.85rem;">
                            {{ strtoupper(substr($job->employer->name, 0, 1)) }}
                        </div>
                        {{ $job->employer->name }}
                    </div>
                </td>
                <td>{{ $job->category->name }}</td>
                <td>{{ $job->location }}</td>
                <td>
                    @if($job->status == 'active')
                        <span class="badge-active">Active</span>
                    @else
                        <span class="badge-closed">Closed</span>
                    @endif
                </td>
                <td>
                    <form action="{{ route('admin.jobs.delete', $job->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete"
                                onclick="return confirm('Delete this job?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-4">
        {{ $jobs->withQueryString()->links() }}
    </div>
</div>

@endsection