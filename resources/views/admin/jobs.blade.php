<!DOCTYPE html>
<html>
<head>
    <title>Jobs - JobBridge Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark px-4">
    <span class="navbar-brand fw-bold">JobBridge  Admin</span>
    <div class="d-flex align-items-center gap-3">
        <a href="{{ route('admin.dashboard') }}" class="text-white">Dashboard</a>
        <a href="{{ route('admin.users') }}" class="text-white">Users</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
        </form>
    </div>
</nav>

<div class="container mt-4">
    <h3 class="mb-3">All Job Listings</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered bg-white">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Title</th>
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
                <td>{{ $job->title }}</td>
                <td>{{ $job->employer->name }}</td>
                <td>{{ $job->category->name }}</td>
                <td>{{ $job->location }}</td>
                <td>
                    <span class="badge {{ $job->status == 'active' ? 'bg-success' : 'bg-secondary' }}">
                        {{ ucfirst($job->status) }}
                    </span>
                </td>
                <td>
                    <form action="{{ route('admin.jobs.delete', $job->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Delete this job?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>