@extends('layouts.seeker')

@section('title', 'My Applications - JobBridge')
@section('page-title', 'My Applications')

@section('content')

@if(session('success'))
    <div class="alert alert-success mb-4">{{ session('success') }}</div>
@endif

<div class="content-card">
    @if($applications->isEmpty())
        <div class="text-center py-5">
            <p style="color:#888;font-size:1rem;">You have not applied for any jobs yet.</p>
            <a href="{{ route('seeker.jobs') }}"
               style="background:#00897b;color:#fff;border-radius:8px;padding:10px 25px;font-weight:600;text-decoration:none;display:inline-block;margin-top:10px;">
               Browse Jobs
            </a>
        </div>
    @else
        <div class="stats-row mb-4">
            <div class="mini-stat">
                <div class="num">{{ $applications->total() }}</div>
                <div class="lbl">Total Applied</div>
            </div>
            <div class="mini-stat">
                <div class="num">{{ $applications->where('status', 'pending')->count() }}</div>
                <div class="lbl">Pending</div>
            </div>
            <div class="mini-stat">
                <div class="num">{{ $applications->where('status', 'accepted')->count() }}</div>
                <div class="lbl">Accepted</div>
            </div>
            <div class="mini-stat">
                <div class="num">{{ $applications->where('status', 'rejected')->count() }}</div>
                <div class="lbl">Rejected</div>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Job Title</th>
                    <th>Company</th>
                    <th>Location</th>
                    <th>Applied On</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($applications as $index => $application)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <div style="font-weight:600;">{{ $application->job->title }}</div>
                        <div style="font-size:0.8rem;color:#888;">{{ ucfirst($application->job->job_type) }}</div>
                    </td>
                    <td>{{ $application->job->employer->name }}</td>
                    <td>{{ $application->job->location }}</td>
                    <td>{{ $application->created_at->format('Y-m-d') }}</td>
                    <td>
                        @if($application->status == 'pending')
                            <span class="badge-pending">Pending</span>
                        @elseif($application->status == 'accepted')
                            <span class="badge-accepted">Accepted</span>
                        @else
                            <span class="badge-rejected">Rejected</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-4">
            {{ $applications->withQueryString()->links() }}
        </div>
    @endif
</div>

@endsection