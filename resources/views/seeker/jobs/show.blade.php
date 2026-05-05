@if($applied)
    <div class="alert alert-info">✅ You have already applied for this job!</div>
@else
    <h5>Apply for this Job</h5>
    <form method="POST" action="{{ route('seeker.jobs.apply', $job->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-semibold">Cover Letter</label>
            <textarea name="cover_letter" class="form-control" rows="5"
                      placeholder="Write why you are suitable for this job..." required></textarea>
            @error('cover_letter')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold">Resume (PDF only)</label>
            <input type="file" name="resume" class="form-control" accept=".pdf" required>
            @error('resume')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Apply Now</button>
    </form>
@endif