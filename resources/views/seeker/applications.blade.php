<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Applications - JobBridge</title>
    <link rel="icon" type="image/png" href="{{ asset('images/JobBridge_Logo_BG.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f5f7fb; }

        .navbar { background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 15px 0 !important; position: sticky; top: 0; z-index: 100; }
        .navbar-brand { font-size: 1.4rem; font-weight: 700; color: #00897b !important; }
        .nav-link { color: #333 !important; font-weight: 500; font-size: 0.95rem; }
        .nav-link:hover { color: #00897b !important; }
        .nav-link.active { color: #00897b !important; font-weight: 600; }
        .btn-logout { border: 1.5px solid #00897b; color: #00897b; border-radius: 20px; padding: 6px 18px; font-weight: 600; font-size: 0.88rem; }
        .btn-logout:hover { background: #00897b; color: #fff; }

        .main-content { padding: 30px 0; }

        .page-header { background: linear-gradient(135deg, #00897b, #00695c); border-radius: 14px; padding: 25px 30px; color: #fff; margin-bottom: 25px; }
        .page-header h4 { font-weight: 700; margin-bottom: 4px; }
        .page-header p { opacity: 0.85; margin: 0; font-size: 0.95rem; }

        .content-card { background: #fff; border-radius: 12px; padding: 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); }

        .table thead th { background: #f8f9fa; color: #555; font-size: 0.85rem; font-weight: 600; border: none; padding: 12px 15px; }
        .table tbody td { padding: 14px 15px; border-bottom: 1px solid #f0f0f0; vertical-align: middle; font-size: 0.9rem; color: #333; }
        .table tbody tr:hover { background: #f8f9fa; }
        .table tbody tr:last-child td { border-bottom: none; }

        .badge-pending { background: #fff3e0; color: #e65100; border-radius: 20px; padding: 4px 12px; font-size: 0.78rem; font-weight: 600; }
        .badge-accepted { background: #e8f5e9; color: #2e7d32; border-radius: 20px; padding: 4px 12px; font-size: 0.78rem; font-weight: 600; }
        .badge-rejected { background: #ffebee; color: #c62828; border-radius: 20px; padding: 4px 12px; font-size: 0.78rem; font-weight: 600; }

        .alert-success { border-radius: 8px; border: none; background: #e0f2f1; color: #00695c; font-size: 0.9rem; }

        .no-apps { text-align: center; padding: 50px; }
        .no-apps p { color: #888; font-size: 1rem; margin-bottom: 15px; }
        .btn-browse { background: #00897b; color: #fff; border: none; border-radius: 8px; padding: 10px 25px; font-weight: 600; text-decoration: none; display: inline-block; }
        .btn-browse:hover { background: #00695c; color: #fff; }

        .stats-row { display: flex; gap: 15px; margin-bottom: 20px; }
        .mini-stat { background: #f8f9fa; border-radius: 10px; padding: 12px 20px; flex: 1; text-align: center; }
        .mini-stat .num { font-size: 1.5rem; font-weight: 700; color: #00897b; }
        .mini-stat .lbl { font-size: 0.8rem; color: #888; }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="/">JobBridge</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto ms-4">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('seeker.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('seeker.jobs') }}">Browse Jobs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('seeker.applications') }}">My Applications</a>
                </li>
            </ul>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-logout">Logout</button>
            </form>
        </div>
    </div>
</nav>

<!-- Main -->
<div class="main-content">
    <div class="container">

        <!-- Page Header -->
        <div class="page-header">
            <h4>My Applications</h4>
            <p>Track all your job applications and their current status.</p>
        </div>

        <div class="content-card">

            @if(session('success'))
                <div class="alert alert-success mb-4">{{ session('success') }}</div>
            @endif

            @if($applications->isEmpty())
                <div class="no-apps">
                    <p>You have not applied for any jobs yet.</p>
                    <a href="{{ route('seeker.jobs') }}" class="btn-browse">Browse Jobs</a>
                </div>
            @else
                <!-- Mini Stats -->
                <div class="stats-row mb-4">
                    <div class="mini-stat">
                        <div class="num">{{ $applications->count() }}</div>
                        <div class="lbl">Total Applied</div>
                    </div>
                    <div class="mini-stat">
                        <div class="num">{{ $applications->where('status', 'pending')->count() }}</div>
                        <div class="lbl">Pending</div>
                    </div>
                    <div class="mini-stat">
                        <div class="num">{{ $applications->where('status', 'accepted')->count() }}</div>
                        <div class="lbl">Accepted</div>
                    </div>
                    <div class="mini-stat">
                        <div class="num">{{ $applications->where('status', 'rejected')->count() }}</div>
                        <div class="lbl">Rejected</div>
                    </div>
                </div>

                <table class="table">
                    <thead>
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
                            <td>
                                <div style="font-weight:600;">{{ $application->job->title }}</div>
                                <div style="font-size:0.8rem;color:#888;">{{ $application->job->job_type }}</div>
                            </td>
                            <td>{{ $application->job->employer->name }}</td>
                            <td>{{ $application->job->location }}</td>
                            <td>{{ $application->created_at->format('Y-m-d') }}</td>
                            <td>
                                @if($application->status == 'pending')
                                    <span class="badge-pending">Pending</span>
                                @elseif($application->status == 'accepted')
                                    <span class="badge-accepted">Accepted</span>
                                @else
                                    <span class="badge-rejected">Rejected</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>