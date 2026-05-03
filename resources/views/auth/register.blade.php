<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - JobBridge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f0f4ff; }
        .card { border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); }
        .btn-primary { background-color: #4f46e5; border: none; }
        .btn-primary:hover { background-color: #4338ca; }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card p-5" style="width: 500px;">

        <h2 class="text-center fw-bold mb-1" style="color: #4f46e5;">JobBridge</h2>
        <p class="text-center text-muted mb-4">Create your account</p>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Full Name</label>
                <input type="text" name="name" id="name" class="form-control"
                       value="{{ old('name') }}" required autofocus>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email Address</label>
                <input type="email" name="email" id="email" class="form-control"
                       value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label fw-semibold">Register As</label>
                <select name="role" id="role" class="form-select" required>
                    <option value="">-- Select Role --</option>
                    <option value="seeker" {{ old('role') == 'seeker' ? 'selected' : '' }}>Job Seeker</option>
                    <option value="employer" {{ old('role') == 'employer' ? 'selected' : '' }}>Employer</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="form-label fw-semibold">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                       class="form-control" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary py-2">Create Account</button>
            </div>

            <p class="text-center mt-3 text-muted">
                Already have an account?
                <a href="{{ route('login') }}" style="color: #4f46e5;">Login here</a>
            </p>

        </form>
    </div>
</div>

</body>
</html>