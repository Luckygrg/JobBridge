<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Job - JobBridge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f5f7fb; }

        .sidebar { width: 250px; min-height: 100vh; background: #00897b; position: fixed; left: 0; top: 0; z-index: 100; }
        .sidebar-brand { padding: 22px 20px; border-bottom: 1px solid rgba(255,255,255,0.15); }
        .sidebar-brand span { color: #fff; font-weight: 700; font-size: 1.1rem; }
        .sidebar-menu { padding: 15px 0; }
        .sidebar-menu a { display: flex; align-items: center; gap: 12px; padding: 12px 20px; color: rgba(255,255,255,0.8); text-decoration: none; font-size: 0.95rem; font-weight: 500; transition: all 0.3s; }
        .sidebar-menu a:hover { background: rgba(255,255,255,0.15); color: #fff; }
        .sidebar-menu a.active { background: rgba(255,255,255,0.2); color: #fff; border-right: 3px solid #fff; }
        .sidebar-menu a i { font-size: 1.1rem; width: 20px; text-align: center; }
        .sidebar-footer { position: absolute; bottom: 0; width: 100%; padding: 15px 0; border-top: 1px solid rgba(255,255,255,0.15); }
        .sidebar-footer form button { display: flex; align-items: center; gap: 12px; padding: 12px 20px; color: rgba(255,255,255,0.8); background: none; border: none; font-size: 0.95rem; font-weight: 500; width: 100%; cursor: pointer; transition: all 0.3s; }
        .sidebar-footer form button:hover { background: rgba(255,255,255,0.15); color: #fff; }
        .sidebar-footer form button i { font-size: 1.1rem; width: 20px; text-align: center; }

        .main-content { margin-left: 250px; padding: 30px; }

        .topbar { background: #fff; border-radius: 12px; padding: 15px 25px; margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px rgba(0,0,0,0.06); }
        .topbar h5 { margin: 0; font-weight: 700; color: #1a1a2e; }
        .user-avatar { width: 38px; height: 38px; background: #00897b; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 0.9rem; }

        .content-card { background: #fff; border-radius: 12px; padding: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); max-width: 800px; }

        .form-control { border: 1.5px solid #e0e0e0; border-radius: 8px; padding: 11px 15px; font-size: 0.9rem; }
        .form-control:focus { border-color: #00897b; box-shadow: 0 0 0 3px rgba(0,137,123,0.1); }
        .form-select { border: 1.5px solid #e0e0e0; border-radius: 8px; padding: 11px 15px; font-size: 0.9rem; }
        .form-select:focus { border-color: #00897b; box-shadow: 0 0 0 3px rgba(0,137,123,0.1); }
        .form-label { font-weight: 600; color: #444; font-size: 0.88rem; margin-bottom: 6px; }
        .btn-submit { background: #00897b; color: #fff; border: none; border-radius: 8px; padding: 12px 30px; font-size: 0.95rem; font-weight: 600; }
        .btn-submit:hover { background: #00695c; color: #fff; }
        .section-title { font-size: 1rem; font-weight: 700; color: #1a1a2e; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #e0f2f1; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-brand">
        <span>JobBridge</span>
    </div>
    <div class="sidebar-menu">
        <a href="{{ route('employer.dashboard') }}">
            <i class="bi bi-grid-fill"></i> Dashboard
        </a>
        <a href="{{ route('employer.jobs.index') }}" class="active">
            <i class="bi bi-briefcase-fill"></i> My Jobs
        </a>
        <a href="{{ route('employer.jobs.create') }}">
            <i class="bi bi-plus-circle-fill"></i> Post a Job
        </a>
    </div>
    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">
                <i class="bi bi-box-arrow-left"></i> Logout
            </button>
        </form>
    </div>
</div>

<div class="main-content">

    <div class="topbar">
        <h5>Edit Job</h5>
        <div class="d-flex align-items-center gap-2">
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div>
                <div style="font-weight:600;font-size:0.9rem;">{{ auth()->user()->name }}</div>
                <div style="color:#888;font-size:0.8rem;">Employer</div>
            </div>
        </div>
    </div>

    <div class="content-card">
        <form method="POST" action="{{ route('employer.jobs.update', $job->id) }}">
            @csrf
            @method('PUT')

            <p class="section-title">Job Information</p>

            <div class="mb-3">
                <label class="form-label">Job Title</label>
                <input type="text" name="title" class="form-control" value="{{ $job->title }}" required>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-select" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $job->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Job Type</label>
                    <select name="job_type" class="form-select" required>
                        <option value="full-time" {{ $job->job_type == 'full-time' ? 'selected' : '' }}>Full Time</option>
                        <option value="part-time" {{ $job->job_type == 'part-time' ? 'selected' : '' }}>Part Time</option>
                        <option value="remote" {{ $job->job_type == 'remote' ? 'selected' : '' }}>Remote</option>
                        <option value="internship" {{ $job->job_type == 'internship' ? 'selected' : '' }}>Internship</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Job Description</label>
                <textarea name="description" class="form-control" rows="5" required>{{ $job->description }}</textarea>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-control" value="{{ $job->location }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Salary (optional)</label>
                    <input type="text" name="salary" class="form-control" value="{{ $job->salary }}">
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Application Deadline</label>
                <input type="date" name="deadline" class="form-control" value="{{ $job->deadline }}" required>
            </div>

            <button type="submit" class="btn-submit">Update Job</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>