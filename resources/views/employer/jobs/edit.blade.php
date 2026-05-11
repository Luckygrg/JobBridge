@extends('layouts.employer')

@section('title', 'Edit Job - JobBridge')
@section('page-title', 'Edit Job')

@section('content')

<div class="content-card" style="max-width:800px;">

    @if ($errors->any())
        <div class="alert alert-danger mb-4">
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
                        <option value="{{ $category->id }}"
                            {{ $job->category_id == $category->id ? 'selected' : '' }}>
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
                <label class="form-label">Application Deadline</label>
                <input type="date" name="deadline" class="form-control"
                       value="{{ \Carbon\Carbon::parse($job->deadline)->format('Y-m-d') }}"
                       min="{{ \Carbon\Carbon::today()->format('Y-m-d') }}" required>
            </div>
        </div>

        <p class="section-title mt-2">Salary Information</p>

        <div class="mb-3">
            <label class="form-label">Salary Type</label>
            <select name="salary_type" class="form-select" required onchange="toggleSalary(this.value)">
                <option value="negotiable" {{ $job->salary_type == 'negotiable' ? 'selected' : '' }}>Negotiable</option>
                <option value="fixed" {{ $job->salary_type == 'fixed' ? 'selected' : '' }}>Fixed</option>
                <option value="range" {{ $job->salary_type == 'range' ? 'selected' : '' }}>Range</option>
            </select>
        </div>

        <div id="salaryFields">
            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label">Currency</label>
                    <select name="salary_currency" class="form-select">
                        <option value="NPR" {{ $job->salary_currency == 'NPR' ? 'selected' : '' }}>NPR</option>
                        <option value="USD" {{ $job->salary_currency == 'USD' ? 'selected' : '' }}>USD</option>
                        <option value="INR" {{ $job->salary_currency == 'INR' ? 'selected' : '' }}>INR</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label" id="minLabel">Min Salary</label>
                    <input type="number" name="salary_min" class="form-control"
                           placeholder="e.g. 30000" min="0" value="{{ $job->salary_min }}">
                </div>
                <div class="col-md-4" id="maxSalaryField">
                    <label class="form-label">Max Salary</label>
                    <input type="number" name="salary_max" class="form-control"
                           placeholder="e.g. 60000" min="0" value="{{ $job->salary_max }}">
                </div>
            </div>
        </div>

        <div class="mb-4"></div>
        <button type="submit" class="btn-submit">Update Job</button>
    </form>
</div>

@endsection

@section('scripts')
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
window.onload = function() {
    const salaryType = document.querySelector('[name="salary_type"]').value;
    toggleSalary(salaryType);
}
</script>
@endsection