<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/JobBridge_Logo_BG.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - JobBridge Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f5f7fb; }

        .sidebar { width: 250px; min-height: 100vh; background: #00897b; position: fixed; left: 0; top: 0; z-index: 100; }
        .sidebar-brand { padding: 25px 20px; border-bottom: 1px solid rgba(255,255,255,0.15); }
        .sidebar-brand h4 { color: #fff; font-weight: 700; margin: 0; font-size: 1.3rem; }
        .sidebar-brand p { color: rgba(255,255,255,0.7); font-size: 0.8rem; margin: 0; }
        .sidebar-menu { padding: 15px 0; }
        .sidebar-menu a { display: flex; align-items: center; gap: 12px; padding: 12px 20px; color: rgba(255,255,255,0.8); text-decoration: none; font-size: 0.95rem; font-weight: 500; transition: all 0.3s; }
        .sidebar-menu a:hover { background: rgba(255,255,255,0.15); color: #fff; }
        .sidebar-menu a.active { background: rgba(255,255,255,0.2); color: #fff; border-right: 3px solid #fff; }
        .sidebar-menu .icon { width: 20px; text-align: center; }

        .main-content { margin-left: 250px; padding: 30px; }

        .topbar { background: #fff; border-radius: 12px; padding: 15px 25px; margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px rgba(0,0,0,0.06); }
        .topbar h5 { margin: 0; font-weight: 700; color: #1a1a2e; }
        .admin-avatar { width: 38px; height: 38px; background: #00897b; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 0.9rem; }

        .content-card { background: #fff; border-radius: 12px; padding: 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); }

        .table thead th { background: #f8f9fa; color: #555; font-size: 0.85rem; font-weight: 600; border: none; padding: 12px 15px; }
        .table tbody td { padding: 14px 15px; border-bottom: 1px solid #f0f0f0; vertical-align: middle; font-size: 0.9rem; color: #333; }
        .table tbody tr:hover { background: #f8f9fa; }
        .table tbody tr:last-child td { border-bottom: none; }

        .badge-employer { background: #e0f2f1; color: #00695c; border-radius: 20px; padding: 4px 12px; font-size: 0.78rem; font-weight: 600; }
        .badge-seeker { background: #e3f2fd; color: #1565c0; border-radius: 20px; padding: 4px 12px; font-size: 0.78rem; font-weight: 600; }

        .btn-delete { background: #ffebee; color: #c62828; border: none; border-radius: 6px; padding: 6px 14px; font-size: 0.82rem; font-weight: 600; }
        .btn-delete:hover { background: #c62828; color: #fff; }

        .alert-success { border-radius: 8px; border: none; background: #e0f2f1; color: #00695c; font-size: 0.9rem; }

        .stats-row { display: flex; gap: 15px; margin-bottom: 20px; }
        .mini-stat { background: #f8f9fa; border-radius: 10px; padding: 12px 20px; flex: 1; text-align: center; }
        .mini-stat .num { font-size: 1.5rem; font-weight: 700; color: #00897b; }
        .mini-stat .lbl { font-size: 0.8rem; color: #888; }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-brand">
        <h4>JobBridge</h4>
        <p>Admin Panel</p>
    </div>
    <div class="sidebar-menu">
        <a href="{{ route('admin.dashboard') }}">
            <span class="icon">&#9632;</span> Dashboard
        </a>
        <a href="{{ route('admin.users') }}" class="active">
            <span class="icon">&#9632;</span> Manage Users
        </a>
        <a href="{{ route('admin.jobs') }}">
            <span class="icon">&#9632;</span> Manage Jobs
        </a>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <span class="icon">&#9632;</span> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
        </form>
    </div>
</div>

<!-- Main Content -->
<div class="main-content">

    <!-- Topbar -->
    <div class="topbar">
        <h5>Manage Users</h5>
        <div class="d-flex align-items-center gap-2">
            <div class="admin-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div>
                <div style="font-weight:600;font-size:0.9rem;">{{ auth()->user()->name }}</div>
                <div style="color:#888;font-size:0.8rem;">Administrator</div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="content-card">

        @if(session('success'))
            <div class="alert alert-success mb-4">{{ session('success') }}</div>
        @endif

        <!-- Mini Stats -->
        <div class="stats-row mb-4">
            <div class="mini-stat">
                <div class="num">{{ $users->count() }}</div>
                <div class="lbl">Total Users</div>
            </div>
            <div class="mini-stat">
                <div class="num">{{ $users->where('role', 'employer')->count() }}</div>
                <div class="lbl">Employers</div>
            </div>
            <div class="mini-stat">
                <div class="num">{{ $users->where('role', 'seeker')->count() }}</div>
                <div class="lbl">Seekers</div>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Joined</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div style="width:34px;height:34px;background:#e0f2f1;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;color:#00897b;font-size:0.85rem;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            {{ $user->name }}
                        </div>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->role == 'employer')
                            <span class="badge-employer">Employer</span>
                        @else
                            <span class="badge-seeker">Seeker</span>
                        @endif
                    </td>
                    <td>{{ $user->created_at->format('Y-m-d') }}</td>
                    <td>
                        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" onclick="return confirm('Delete this user?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</body>
</html>