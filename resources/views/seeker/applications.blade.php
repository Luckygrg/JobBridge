<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/JobBridge_Logo_BG.png') }}">
    <title>My Applications - JobBridge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-success px-4">
    <span class="navbar-brand fw-bold">JobBridge 🌉</span>
    <div class="d-flex align-items-center gap-3">
        <a href="{{ route('seeker.dashboard') }}" class="text-white">Dashboard</a>
        <a href="{{ route('seeker.jobs') }}" class="text-white">Browse Jobs</a>
        <a href="{{ route('seeker.applications') }}" class="text-white">My Applications</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
        </form>
    </div>
</nav>

<div class="container mt-4">
    <h3 class="mb-3">My Applications</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($applications->isEmpty())
        <div class="alert alert-info">You haven't applied for any jobs yet.
            <a href="{{ route('seeker.jobs') }}">Browse Jobs</a>
        </div>
    @else
        <table class="table table-bordered bg-white">
            <thead class="table-success">
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
                    <td>{{ $application->job->title }}</td>
                    <td>{{ $application->job->employer->name }}</td>
                    <td>{{ $application->job->location }}</td>
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
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

</body>
</html>