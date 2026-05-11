@extends('layouts.employer')

@section('title', 'Applicants - JobBridge')
@section('page-title', 'Applicants for: {{ $job->title }}')

@section('styles')
<style>
    .btn-accept { background: #e8f5e9; color: #2e7d32; border: none; border-radius: 6px; padding: 6px 12px; font-size: 0.82rem; font-weight: 600; }
    .btn-accept:hover { background: #2e7d32; color: #fff; }
    .btn-reject { background: #ffebee; color: #c62828; border: none; border-radius: 6px; padding: 6px 12px; font-size: 0.82rem; font-weight: 600; }
    .btn-reject:hover { background: #c62828; color: #fff; }
    .btn-resume { background: #e0f2f1; color: #00695c; border-radius: 6px; padding: 6px 12px; font-size: 0.82rem; font-weight: 600; text-decoration: none; }
    .btn-resume:hover { background: #00897b; color: #fff; }
</style>
@endsection

@section('content')

@if(session('success'))
    <div class="alert alert-success mb-4">{{ session('success') }}</div>
@endif

<div class="content-card">
    @if($applications->isEmpty())
        <div class="text-center py-5">
            <p style="color:#888;">No applicants yet for this job!</p>
        </div>
    @else
        <div class="stats-row mb-4">
            <div class="mini-stat">
                <div class="num">{{ $applications->count() }}</div>
                <div class="lbl">Total</div>
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
                    <th>Applicant</th>
                    <th>Email</th>
                    <th>Cover Letter</th>
                    <th>Resume</th>
                    <th>Applied On</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($applications as $index => $application)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div style="width:34px;height:34px;background:#e0f2f1;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;color:#00897b;font-size:0.85rem;overflow:hidden;">
                                @if($application->seeker->profile_photo)
                                    <img src="{{ asset('storage/' . $application->seeker->profile_photo) }}"
                                         style="width:100%;height:100%;object-fit:cover;">
                                @else
                                    {{ strtoupper(substr($application->seeker->name, 0, 1)) }}
                                @endif
                            </div>
                            {{ $application->seeker->name }}
                        </div>
                    </td>
                    <td>{{ $application->seeker->email }}</td>
                    <td style="max-width:150px;">{{ Str::limit($application->cover_letter, 50) }}</td>
                    <td>
                        @if($application->resume)
                            <a href="{{ asset('storage/' . $application->resume) }}"
                               target="_blank" class="btn-resume">View Resume</a>
                        @else
                            <span style="color:#aaa;font-size:0.85rem;">No resume</span>
                        @endif
                    </td>
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
                    <td>
                        @if($application->status == 'pending')
                            <div class="d-flex gap-1">
                                <form action="{{ route('employer.applications.update', [$application->id, 'accepted']) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn-accept">Accept</button>
                                </form>
                                <form action="{{ route('employer.applications.update', [$application->id, 'rejected']) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn-reject">Reject</button>
                                </form>
                            </div>
                        @else
                            <span style="color:#aaa;font-size:0.85rem;">Done</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection