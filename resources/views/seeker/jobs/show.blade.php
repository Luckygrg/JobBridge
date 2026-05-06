<!DOCTYPE html>
<html>
<head>
    <title>{{ $job->title }} - JobBridge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-success px-4">
    <span class="navbar-brand fw-bold">JobBridge 🌉</span>
    <div class="d-flex align-items-center gap-3">
        <a href="{{ route('seeker.jobs') }}" class="text-white">← Back to Jobs</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
        </form>
    </div>
</nav>

<div class="container mt-4">
    <div class="card p-4" style="max-width: 750px; margin: auto;">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <h3>{{ $job->title }}</h3>
        <p class="text-muted">🏢 {{ $job->employer->name }}</p>

        <div class="mb-3">
            <span class="badge bg-primary">{{ ucfirst($job->job_type) }}</span>
            <span class="badge bg-secondary">{{ $job->category->name }}</span>
            @if($job->salary)
                <span class="badge bg-success">💰 {{ $job->salary }}</span>
            @endif
        </div>

        <p>📍 <strong>Location:</strong> {{ $job->location }}</p>
        <p>⏰ <strong>Deadline:</strong> {{ $job->deadline }}</p>

        <hr>
        <h5>Job Description</h5>
        <p>{{ $job->description }}</p>
        <hr>

        @if($applied)
            <div class="alert alert-info">✅ You have already applied for this job!</div>
        @else
            <h5>Apply for this Job</h5>
            <form method="POST" action="{{ route('seeker.jobs.apply', $job->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold">Cover Letter</label>
                    <textarea name="cover_letter" class="form-control" rows="5"
                              placeholder="Write why you are suitable for this job..." required></textarea>
                    @error('cover_letter')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Resume (PDF only)</label>
                    <input type="file" name="resume" class="form-control" accept=".pdf" required>
                    @error('resume')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">Apply Now</button>
            </form>
        @endif

    </div>
</div>

</body>
</html>