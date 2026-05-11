<!DOCTYPE html>
<html>
<head>    <title>Applicants - JobBridge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-primary px-4">
    <span class="navbar-brand fw-bold">JobBridge </span>
    <div class="d-flex align-items-center gap-3">
        <a href="{{ route('employer.jobs.index') }}" class="text-white">← Back to Jobs</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
        </form>
    </div>
</nav>

<div class="container mt-4">
    <h3 class="mb-1">Applicants for: <strong>{{ $job->title }}</strong></h3>
    <p class="text-muted mb-4">Total: {{ $applications->count() }} applicants</p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($applications->isEmpty())
        <div class="alert alert-info">No applicants yet for this job!</div>
    @else
        <table class="table table-bordered bg-white">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Name</th>
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
                    <td>{{ $application->seeker->name }}</td>
                    <td>{{ $application->seeker->email }}</td>
                    <td>{{ Str::limit($application->cover_letter, 50) }}</td>
                    <td>
                        @if($application->resume)
                            <a href="{{ asset('storage/' . $application->resume) }}"
                               target="_blank" class="btn btn-sm btn-outline-primary">
                               View Resume
                            </a>
                        @else
                            <span class="text-muted">No resume</span>
                        @endif
                    </td>
                    <td>{{ $application->created_at->format('Y-m-d') }}</td>
                    <td>
                        @if($application->status == 'pending')
                            <span class="badge bg-warning">Pending</span>
                        @elseif($application->status == 'accepted')
                            <span class="badge bg-success">Accepted</span>
                        @else
                            <span class="badge bg-danger">Rejected</span>
                        @endif
                    </td>
                    <td>
                        @if($application->status == 'pending')
                            <form action="{{ route('employer.applications.update', [$application->id, 'accepted']) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success btn-sm">Accept</button>
                            </form>
                            <form action="{{ route('employer.applications.update', [$application->id, 'rejected']) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        @else
                            <span class="text-muted">Done</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

</body>
</html>