<!DOCTYPE html>
<html>
<head>
    <title>Edit Job - JobBridge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-primary px-4">
    <span class="navbar-brand fw-bold">JobBridge 🌉</span>
    <a href="{{ route('employer.jobs.index') }}" class="text-white">← Back to Jobs</a>
</nav>

<div class="container mt-4">
    <div class="card p-4" style="max-width: 700px; margin: auto;">
        <h3 class="mb-4">Edit Job</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('employer.jobs.update', $job->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-semibold">Job Title</label>
                <input type="text" name="title" class="form-control" value="{{ $job->title }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Category</label>
                <select name="category_id" class="form-select" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $job->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Description</label>
                <textarea name="description" class="form-control" rows="5" required>{{ $job->description }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Location</label>
                    <input type="text" name="location" class="form-control" value="{{ $job->location }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Salary (optional)</label>
                    <input type="text" name="salary" class="form-control" value="{{ $job->salary }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Job Type</label>
                    <select name="job_type" class="form-select" required>
                        <option value="full-time" {{ $job->job_type == 'full-time' ? 'selected' : '' }}>Full Time</option>
                        <option value="part-time" {{ $job->job_type == 'part-time' ? 'selected' : '' }}>Part Time</option>
                        <option value="remote" {{ $job->job_type == 'remote' ? 'selected' : '' }}>Remote</option>
                        <option value="internship" {{ $job->job_type == 'internship' ? 'selected' : '' }}>Internship</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Deadline</label>
                    <input type="date" name="deadline" class="form-control" value="{{ $job->deadline }}" required>
                </div>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-warning py-2">Update Job</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>