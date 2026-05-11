<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'JobBridge Admin')</title>
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

        .stat-card { background: #fff; border-radius: 12px; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); border-left: 4px solid; height: 100%; }
        .stat-card.teal { border-color: #00897b; }
        .stat-card.blue { border-color: #1976d2; }
        .stat-card.orange { border-color: #f57c00; }
        .stat-card.green { border-color: #388e3c; }
        .stat-card.purple { border-color: #7b1fa2; }
        .stat-card .label { color: #888; font-size: 0.85rem; font-weight: 500; margin-bottom: 8px; }
        .stat-card .value { font-size: 2rem; font-weight: 700; color: #1a1a2e; margin-bottom: 0; }
        .stat-card .icon-box { width: 45px; height: 45px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; }
        .stat-card.teal .icon-box { background: #e0f2f1; color: #00897b; }
        .stat-card.blue .icon-box { background: #e3f2fd; color: #1976d2; }
        .stat-card.orange .icon-box { background: #fff3e0; color: #f57c00; }
        .stat-card.green .icon-box { background: #e8f5e9; color: #388e3c; }
        .stat-card.purple .icon-box { background: #f3e5f5; color: #7b1fa2; }

        .chart-card { background: #fff; border-radius: 12px; padding: 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); }
        .chart-card h6 { font-weight: 700; color: #1a1a2e; margin-bottom: 20px; font-size: 1rem; }

        .content-card { background: #fff; border-radius: 12px; padding: 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); }

        .table thead th { background: #f8f9fa; color: #555; font-size: 0.85rem; font-weight: 600; border: none; padding: 12px 15px; }
        .table tbody td { padding: 14px 15px; border-bottom: 1px solid #f0f0f0; vertical-align: middle; font-size: 0.9rem; color: #333; }
        .table tbody tr:hover { background: #f8f9fa; }
        .table tbody tr:last-child td { border-bottom: none; }

        .badge-employer { background: #e0f2f1; color: #00695c; border-radius: 20px; padding: 4px 12px; font-size: 0.78rem; font-weight: 600; }
        .badge-seeker { background: #e3f2fd; color: #1565c0; border-radius: 20px; padding: 4px 12px; font-size: 0.78rem; font-weight: 600; }
        .badge-active { background: #e0f2f1; color: #00695c; border-radius: 20px; padding: 4px 12px; font-size: 0.78rem; font-weight: 600; }
        .badge-closed { background: #f5f5f5; color: #757575; border-radius: 20px; padding: 4px 12px; font-size: 0.78rem; font-weight: 600; }

        .btn-delete { background: #ffebee; color: #c62828; border: none; border-radius: 6px; padding: 6px 14px; font-size: 0.82rem; font-weight: 600; }
        .btn-delete:hover { background: #c62828; color: #fff; }

        .stats-row { display: flex; gap: 15px; margin-bottom: 20px; }
        .mini-stat { background: #f8f9fa; border-radius: 10px; padding: 12px 20px; flex: 1; text-align: center; }
        .mini-stat .num { font-size: 1.5rem; font-weight: 700; color: #00897b; }
        .mini-stat .lbl { font-size: 0.8rem; color: #888; }

        .alert-success { border-radius: 8px; border: none; background: #e0f2f1; color: #00695c; }

        .pagination .page-link { color: #00897b; border-color: #e0e0e0; }
        .pagination .page-item.active .page-link { background: #00897b; border-color: #00897b; color: #fff; }
        .pagination .page-link:hover { background: #e0f2f1; color: #00695c; }

        .quick-link-btn { display: flex; align-items: center; gap: 10px; padding: 12px 16px; border-radius: 10px; text-decoration: none; font-weight: 600; font-size: 0.9rem; margin-bottom: 10px; transition: all 0.3s; }
        .quick-link-btn.teal { background: #e0f2f1; color: #00695c; }
        .quick-link-btn.teal:hover { background: #00897b; color: #fff; }
        .quick-link-btn.blue { background: #e3f2fd; color: #1565c0; }
        .quick-link-btn.blue:hover { background: #1976d2; color: #fff; }

        @yield('styles')
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-brand">
        <span>JobBridge</span>
        <p>Admin Panel</p>
    </div>
    <div class="sidebar-menu">
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-fill"></i> Dashboard
        </a>
        <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">
            <i class="bi bi-people-fill"></i> Manage Users
        </a>
        <a href="{{ route('admin.jobs') }}" class="{{ request()->routeIs('admin.jobs') ? 'active' : '' }}">
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
        <h5>@yield('page-title')</h5>
        <div class="d-flex align-items-center gap-2">
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div>
                <div style="font-weight:600;font-size:0.9rem;">{{ auth()->user()->name }}</div>
                <div style="color:#888;font-size:0.8rem;">Administrator</div>
            </div>
        </div>
    </div>

    @yield('content')

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>