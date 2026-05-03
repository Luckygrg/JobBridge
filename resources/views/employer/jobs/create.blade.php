<!DOCTYPE html>
<html>
<head>
    <title>Post Job - JobBridge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-primary px-4">
    <span class="navbar-brand fw-bold">JobBridge 🌉</span>
    <a href="{{ route('employer.jobs.index') }}" class="text-white">← Back to Jobs</a>
</nav>

<div class="container mt-4">
    <div class="card p-4" style="max-width: 700px; margin: auto;">
        <h3 class="mb-4">Post a New Job</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('employer.jobs.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Job Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Category</label>
                <select name="category_id" class="form-select" required>
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Description</label>
                <textarea name="description" class="form-control" rows="5" required>{{ old('description') }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Location</label>
                    <input type="text" name="location" class="form-control" value="{{ old('location') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Salary (optional)</label>
                    <input type="text" name="salary" class="form-control" value="{{ old('salary') }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Job Type</label>
                    <select name="job_type" class="form-select" required>
                        <option value="">-- Select Type --</option>
                        <option value="full-time">Full Time</option>
                        <option value="part-time">Part Time</option>
                        <option value="remote">Remote</option>
                        <option value="internship">Internship</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Deadline</label>
                    <input type="date" name="deadline" class="form-control" value="{{ old('deadline') }}" required>
                </div>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary py-2">Post Job</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>