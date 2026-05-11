@extends('layouts.employer')

@section('title', 'Post a Job - JobBridge')
@section('page-title', 'Post a New Job')

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

        <p class="section-title mt-2">Salary Information</p>

        <div class="mb-3">
            <label class="form-label">Salary Type</label>
            <select name="salary_type" class="form-select" required onchange="toggleSalary(this.value)">
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
    if (salaryType) toggleSalary(salaryType);
}
</script>
@endsection