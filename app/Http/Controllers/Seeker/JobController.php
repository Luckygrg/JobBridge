public function apply(Request $request, JobListing $job)
{
    $already = Application::where('job_id', $job->id)
                           ->where('user_id', auth()->id())
                           ->exists();

    if ($already) {
        return back()->with('error', 'You have already applied for this job!');
    }

    $request->validate([
        'cover_letter' => 'required|string',
        'resume' => 'required|file|mimes:pdf|max:2048',
    ]);

    $resumePath = $request->file('resume')->store('resumes', 'public');

    Application::create([
        'job_id' => $job->id,
        'user_id' => auth()->id(),
        'cover_letter' => $request->cover_letter,
        'resume' => $resumePath,
        'status' => 'pending',
    ]);

    return redirect()->route('seeker.applications')->with('success', 'Applied successfully!');
}