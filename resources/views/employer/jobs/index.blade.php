<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Jobs - JobBridge</title>
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
        .btn-post { background: #00897b; color: #fff; border-radius: 8px; padding: 8px 18px; font-weight: 600; font-size: 0.88rem; border: none; text-decoration: none; }
        .btn-post:hover { background: #00695c; color: #fff; }

        .content-card { background: #fff; border-radius: 12px; padding: 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); }

        .table thead th { background: #f8f9fa; color: #555; font-size: 0.85rem; font-weight: 600; border: none; padding: 12px 15px; }
        .table tbody td { padding: 14px 15px; border-bottom: 1px solid #f0f0f0; vertical-align: middle; font-size: 0.9rem; color: #333; }
        .table tbody tr:hover { background: #f8f9fa; }
        .table tbody tr:last-child td { border-bottom: none; }

        .badge-active { background: #e0f2f1; color: #00695c; border-radius: 20px; padding: 4px 12px; font-size: 0.78rem; font-weight: 600; }
        .badge-closed { background: #f5f5f5; color: #757575; border-radius: 20px; padding: 4px 12px; font-size: 0.78rem; font-weight: 600; }

        .btn-edit { background: #fff3e0; color: #e65100; border: none; border-radius: 6px; padding: 6px 12px; font-size: 0.82rem; font-weight: 600; text-decoration: none; }
        .btn-edit:hover { background: #e65100; color: #fff; }
        .btn-delete { background: #ffebee; color: #c62828; border: none; border-radius: 6px; padding: 6px 12px; font-size: 0.82rem; font-weight: 600; }
        .btn-delete:hover { background: #c62828; color: #fff; }
        .page-link { color: #00897b; }
        .page-item.active .page-link { background: #00897b; border-color: #00897b; color: #fff; }
        .page-link:hover { background: #e0f2f1; color: #00695c; }
        .btn-applicants { background: #e0f2f1; color: #00695c; border: none; border-radius: 6px; padding: 6px 12px; font-size: 0.82rem; font-weight: 600; text-decoration: none; }
        .btn-applicants:hover { background: #00897b; color: #fff; }

        .alert-success { border-radius: 8px; border: none; background: #e0f2f1; color: #00695c; }
        .alert-info { border-radius: 8px; border: none; background: #e3f2fd; color: #1565c0; }
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
        <h5>My Job Listings</h5>
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('employer.jobs.create') }}" class="btn-post">
                <i class="bi bi-plus-circle-fill"></i> Post New Job
            </a>
            <div class="user-avatar" style="overflow:hidden;">
    @if(auth()->user()->profile_photo)
        <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
             alt="Profile" style="width:100%;height:100%;object-fit:cover;">
    @else
        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
    @endif
</div>
            <div>
                <div style="font-weight:600;font-size:0.9rem;">{{ auth()->user()->name }}</div>
                <div style="color:#888;font-size:0.8rem;">Employer</div>
            </div>
        </div>
    </div>

    <div class="content-card">
        @if(session('success'))
            <div class="alert alert-success mb-4">{{ session('success') }}</div>
        @endif

        @if($jobs->isEmpty())
            <div class="alert alert-info">No jobs posted yet. <a href="{{ route('employer.jobs.create') }}" style="color:#1565c0;font-weight:600;">Post your first job!</a></div>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Job Title</th>
                        <th>Category</th>
                        <th>Location</th>
                        <th>Job Type</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobs as $index => $job)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><div style="font-weight:600;">{{ $job->title }}</div></td>
                        <td>{{ $job->category->name }}</td>
                        <td>{{ $job->location }}</td>
                        <td>{{ ucfirst($job->job_type) }}</td>
                        <td>{{ $job->deadline }}</td>
                        <td>
                            @if($job->status == 'active')
                                <span class="badge-active">Active</span>
                            @else
                                <span class="badge-closed">Closed</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1 flex-wrap">
                                <a href="{{ route('employer.applications', $job->id) }}" class="btn-applicants">Applicants</a>
                                <a href="{{ route('employer.jobs.edit', $job->id) }}" class="btn-edit">Edit</a>
                                <form action="{{ route('employer.jobs.destroy', $job->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirm('Delete this job?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if($jobs->hasPages())
            <div class="d-flex justify-content-end mt-4">
                <ul class="pagination pagination-sm mb-0">
                    @for($i = 1; $i <= $jobs->lastPage(); $i++)
                        <li class="page-item {{ $jobs->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $jobs->appends(request()->except('page'))->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                </ul>
            </div>
            @endif
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>