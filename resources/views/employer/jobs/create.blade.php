<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post a Job - JobBridge</title>
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
        .alert-danger { border-radius: 8px; font-size: 0.88rem; }
        .section-title { font-size: 1rem; font-weight: 700; color: #1a1a2e; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #e0f2f1; }
        .salary-info { background: #e0f2f1; border-radius: 8px; padding: 10px 15px; font-size: 0.85rem; color: #00695c; margin-top: 8px; }
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
        <a href="{{ route('employer.jobs.index') }}">
            <i class="bi bi-briefcase-fill"></i> My Jobs
        </a>
        <a href="{{ route('employer.jobs.create') }}" class="active">
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
        <h5>Post a New Job</h5>
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
                <div style="color:#888;font-size:0.8rem;">Employer</div>
            </div>
        </div>
    </div>

    <div class="content-card">
        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('employer.jobs.store') }}">
            @csrf

            <p class="section-title">Job Information</p>

            <div class="mb-3">
                <label class="form-label">Job Title</label>
                <input type="text" name="title" class="form-control"
                       placeholder="e.g. Laravel Developer" value="{{ old('title') }}" required>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Job Type</label>
                    <select name="job_type" class="form-select" required>
                        <option value="">Select Type</option>
                        <option value="full-time" {{ old('job_type') == 'full-time' ? 'selected' : '' }}>Full Time</option>
                        <option value="part-time" {{ old('job_type') == 'part-time' ? 'selected' : '' }}>Part Time</option>
                        <option value="remote" {{ old('job_type') == 'remote' ? 'selected' : '' }}>Remote</option>
                        <option value="internship" {{ old('job_type') == 'internship' ? 'selected' : '' }}>Internship</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Job Description</label>
                <textarea name="description" class="form-control" rows="5"
                          placeholder="Describe the job responsibilities and requirements..."
                          required>{{ old('description') }}</textarea>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-control"
                           placeholder="e.g. Kathmandu, Nepal" value="{{ old('location') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Application Deadline</label>
                    <input type="date" name="deadline" class="form-control"
                           value="{{ old('deadline') }}"
                           min="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}" required>
                </div>
            </div>

            <!-- Salary Section -->
            <p class="section-title mt-2">Salary Information</p>

            <div class="mb-3">
                <label class="form-label">Salary Type</label>
                <select name="salary_type" class="form-select" required
                        onchange="toggleSalary(this.value)">
                    <option value="negotiable" {{ old('salary_type') == 'negotiable' ? 'selected' : '' }}>Negotiable</option>
                    <option value="fixed" {{ old('salary_type') == 'fixed' ? 'selected' : '' }}>Fixed</option>
                    <option value="range" {{ old('salary_type') == 'range' ? 'selected' : '' }}>Range</option>
                </select>
            </div>

            <div id="salaryFields" style="display:none;">
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Currency</label>
                        <select name="salary_currency" class="form-select">
                            <option value="NPR" {{ old('salary_currency') == 'NPR' ? 'selected' : '' }}>NPR</option>
                            <option value="USD" {{ old('salary_currency') == 'USD' ? 'selected' : '' }}>USD</option>
                            <option value="INR" {{ old('salary_currency') == 'INR' ? 'selected' : '' }}>INR</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" id="minLabel">Min Salary</label>
                        <input type="number" name="salary_min" class="form-control"
                               placeholder="e.g. 30000" min="0" value="{{ old('salary_min') }}">
                    </div>
                    <div class="col-md-4" id="maxSalaryField">
                        <label class="form-label">Max Salary</label>
                        <input type="number" name="salary_max" class="form-control"
                               placeholder="e.g. 60000" min="0" value="{{ old('salary_max') }}">
                    </div>
                </div>
            </div>

            <div class="mb-4"></div>

            <button type="submit" class="btn-submit">Post Job</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function toggleSalary(type) {
    const fields = document.getElementById('salaryFields');
    const maxField = document.getElementById('maxSalaryField');
    const minLabel = document.getElementById('minLabel');

    if (type === 'negotiable') {
        fields.style.display = 'none';
    } else if (type === 'fixed') {
        fields.style.display = 'block';
        maxField.style.display = 'none';
        minLabel.textContent = 'Salary Amount';
    } else {
        fields.style.display = 'block';
        maxField.style.display = 'block';
        minLabel.textContent = 'Min Salary';
    }
}

// On page load show salary fields if old value exists
window.onload = function() {
    const salaryType = document.querySelector('[name="salary_type"]').value;
    if (salaryType) toggleSalary(salaryType);
}
</script>
</body>
</html>