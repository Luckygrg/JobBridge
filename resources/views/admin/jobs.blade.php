<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Jobs - JobBridge Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f5f7fb; }

        .sidebar { width: 250px; min-height: 100vh; background: #00897b; position: fixed; left: 0; top: 0; z-index: 100; }
        .sidebar-brand { padding: 22px 20px; border-bottom: 1px solid rgba(255,255,255,0.15); }
        .sidebar-brand span { color: #fff; font-weight: 700; font-size: 1.1rem; }
        .sidebar-brand p { color: rgba(255,255,255,0.7); font-size: 0.8rem; margin: 0; }
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

        .content-card { background: #fff; border-radius: 12px; padding: 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); }

        .stats-row { display: flex; gap: 15px; margin-bottom: 20px; }
        .mini-stat { background: #f8f9fa; border-radius: 10px; padding: 12px 20px; flex: 1; text-align: center; }
        .mini-stat .num { font-size: 1.5rem; font-weight: 700; color: #00897b; }
        .mini-stat .lbl { font-size: 0.8rem; color: #888; }

        .table thead th { background: #f8f9fa; color: #555; font-size: 0.85rem; font-weight: 600; border: none; padding: 12px 15px; }
        .table tbody td { padding: 14px 15px; border-bottom: 1px solid #f0f0f0; vertical-align: middle; font-size: 0.9rem; color: #333; }
        .table tbody tr:hover { background: #f8f9fa; }
        .table tbody tr:last-child td { border-bottom: none; }

        .badge-active { background: #e0f2f1; color: #00695c; border-radius: 20px; padding: 4px 12px; font-size: 0.78rem; font-weight: 600; }
        .badge-closed { background: #f5f5f5; color: #757575; border-radius: 20px; padding: 4px 12px; font-size: 0.78rem; font-weight: 600; }

        .btn-delete { background: #ffebee; color: #c62828; border: none; border-radius: 6px; padding: 6px 14px; font-size: 0.82rem; font-weight: 600; }
        .btn-delete:hover { background: #c62828; color: #fff; }

        .alert-success { border-radius: 8px; border: none; background: #e0f2f1; color: #00695c; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-brand">
        <span>JobBridge</span>
        <p>Admin Panel</p>
    </div>
    <div class="sidebar-menu">
        <a href="{{ route('admin.dashboard') }}">
            <i class="bi bi-grid-fill"></i> Dashboard
        </a>
        <a href="{{ route('admin.users') }}">
            <i class="bi bi-people-fill"></i> Manage Users
        </a>
        <a href="{{ route('admin.jobs') }}" class="active">
            <i class="bi bi-briefcase-fill"></i> Manage Jobs
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
        <h5>Manage Jobs</h5>
        <div class="d-flex align-items-center gap-2">
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
                <div style="color:#888;font-size:0.8rem;">Administrator</div>
            </div>
        </div>
    </div>

    <div class="content-card">

        @if(session('success'))
            <div class="alert alert-success mb-4">{{ session('success') }}</div>
        @endif

        <div class="stats-row mb-4">
            <div class="mini-stat">
                <div class="num">{{ $jobs->count() }}</div>
                <div class="lbl">Total Jobs</div>
            </div>
            <div class="mini-stat">
                <div class="num">{{ $jobs->where('status', 'active')->count() }}</div>
                <div class="lbl">Active</div>
            </div>
            <div class="mini-stat">
                <div class="num">{{ $jobs->where('status', 'closed')->count() }}</div>
                <div class="lbl">Closed</div>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Job Title</th>
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
                    <td>
                        <div style="font-weight:600;">{{ $job->title }}</div>
                        <div style="font-size:0.8rem;color:#888;">{{ ucfirst($job->job_type) }}</div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div style="width:34px;height:34px;background:#e0f2f1;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;color:#00897b;font-size:0.85rem;">
                                {{ strtoupper(substr($job->employer->name, 0, 1)) }}
                            </div>
                            {{ $job->employer->name }}
                        </div>
                    </td>
                    <td>{{ $job->category->name }}</td>
                    <td>{{ $job->location }}</td>
                    <td>
                        @if($job->status == 'active')
                            <span class="badge-active">Active</span>
                        @else
                            <span class="badge-closed">Closed</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('admin.jobs.delete', $job->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" onclick="return confirm('Delete this job?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>