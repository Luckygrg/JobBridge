<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - JobBridge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f8f9fa; }

        .navbar { background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 15px 0; }
        .navbar-brand { font-size: 1.5rem; font-weight: 700; color: #00897b !important; }
        .nav-link { color: #333 !important; font-weight: 500; }
        .nav-link:hover { color: #00897b !important; }
        .dropdown-toggle { background: #fff !important; border: none !important; color: #333 !important; font-weight: 500; }
        .dropdown-toggle:hover { color: #00897b !important; }
        .dropdown-item:hover { color: #00897b; background: #e0f2f1; }
        .dropdown-item { cursor: pointer; }

        .main-wrapper { min-height: calc(100vh - 70px); display: flex; align-items: center; justify-content: center; padding: 40px 0; }
        .auth-card { background: #fff; border-radius: 16px; box-shadow: 0 4px 30px rgba(0,0,0,0.08); overflow: hidden; max-width: 900px; width: 100%; display: flex; }

        .left-panel { background: linear-gradient(135deg, #e0f2f1 0%, #b2dfdb 100%); flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 50px 30px; text-align: center; }
        .left-panel h2 { color: #00897b; font-weight: 700; font-size: 1.8rem; margin-bottom: 10px; }
        .left-panel p { color: #555; font-size: 0.95rem; }

        .right-panel { flex: 1; padding: 50px 40px; overflow-y: auto; max-height: 100vh; }
        .right-panel h3 { color: #1a1a2e; font-weight: 700; font-size: 1.5rem; margin-bottom: 5px; }
        .right-panel h3 span { color: #00897b; }
        .right-panel .subtitle { color: #666; font-size: 0.9rem; margin-bottom: 25px; }

        .tab-toggle { display: flex; gap: 12px; margin-bottom: 25px; }
        .tab-btn { flex: 1; padding: 12px; border: 1.5px solid #ddd; border-radius: 8px; background: #fff; font-weight: 600; color: #666; cursor: pointer; text-align: center; transition: all 0.3s; display: flex; align-items: center; gap: 8px; }
        .tab-btn .radio { width: 18px; height: 18px; border-radius: 50%; border: 2px solid #ddd; display: inline-block; flex-shrink: 0; }
        .tab-btn.active { border-color: #00897b; background: #e0f2f1; color: #00897b; }
        .tab-btn.active .radio { border-color: #00897b; background: #00897b; }

        .form-control { border: 1.5px solid #e0e0e0; border-radius: 8px; padding: 12px 15px; font-size: 0.95rem; }
        .form-control:focus { border-color: #00897b; box-shadow: 0 0 0 3px rgba(0,137,123,0.1); }
        .form-label { font-weight: 600; color: #444; font-size: 0.88rem; margin-bottom: 6px; }
        .btn-submit { background: #00897b; color: #fff; border: none; border-radius: 8px; padding: 13px; font-size: 1rem; font-weight: 600; width: 100%; }
        .btn-submit:hover { background: #00695c; color: #fff; }
        .forgot-link { color: #00897b; font-size: 0.85rem; text-decoration: none; }
        .forgot-link:hover { text-decoration: underline; }
        .bottom-link { color: #00897b; font-weight: 600; text-decoration: none; cursor: pointer; }
        .bottom-link:hover { text-decoration: underline; }
        .alert-danger { border-radius: 8px; font-size: 0.88rem; }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="/">JobBridge</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto ms-4">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
            </ul>
            <div class="d-flex gap-3 align-items-center">
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        For Jobseekers
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" onclick="showSeekerLogin(); return false;">Login</a></li>
                        <li><a class="dropdown-item" onclick="showSeekerRegister(); return false;">Create Account</a></li>
                    </ul>
                </div>
                <div style="width:1px;height:30px;background:#ddd;"></div>
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        For Employers
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" onclick="showEmployerLogin(); return false;">Login</a></li>
                        <li><a class="dropdown-item" onclick="setEmployerRegister(); return false;">Register</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Main -->
<div class="main-wrapper">
    <div class="container">
        <div class="auth-card mx-auto">

            <!-- Left Panel -->
            <div class="left-panel d-none d-md-flex">
                <h2 id="leftTitle">Welcome to JobBridge!</h2>
                <p id="leftSubtitle">Find your dream job or hire the right talent. Your career journey starts here!</p>
            </div>

            <!-- Right Panel -->
            <div class="right-panel">
                <h3>Hello, <span id="panelTitle">Jobseeker!</span></h3>
                <p class="subtitle" id="panelSubtitle">Welcome to JobBridge. Login or create your account below.</p>

                <!-- Tab Toggle -->
                <div class="tab-toggle">
                    <div class="tab-btn active" id="loginTab" onclick="onLoginTabClick()">
                        <span class="radio"></span> Login
                    </div>
                    <div class="tab-btn" id="registerTab" onclick="onRegisterTabClick()">
                        <span class="radio"></span> Register
                    </div>
                </div>

                <!-- Login Form -->
                <div id="loginForm">
                    @if ($errors->any())
                        <div class="alert alert-danger mb-3">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control"
                                   placeholder="Enter your email" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control"
                                   placeholder="Enter your password" required>
                        </div>
                        <div class="mb-4 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label text-muted" style="font-size:0.88rem;" for="remember">Remember me</label>
                            </div>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="forgot-link">Forgot Password?</a>
                            @endif
                        </div>
                        <button type="submit" class="btn-submit mb-3">Login</button>
                        <p class="text-center text-muted" style="font-size:0.9rem;">
                            New to JobBridge?
                            <a onclick="onRegisterTabClick()" class="bottom-link">Create Account</a>
                        </p>
                    </form>
                </div>

                <!-- Seeker Register Form -->
                <div id="seekerRegisterForm" style="display:none;">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <input type="hidden" name="role" value="seeker">
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control"
                                   placeholder="Enter your full name" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control"
                                   placeholder="Enter your email" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control"
                                   placeholder="Create a password" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                   placeholder="Confirm your password" required>
                        </div>
                        <button type="submit" class="btn-submit mb-3">Create Account</button>
                        <p class="text-center text-muted" style="font-size:0.9rem;">
                            Already have an account?
                            <a onclick="onLoginTabClick()" class="bottom-link">Login here</a>
                        </p>
                    </form>
                </div>

                <!-- Employer Register Form -->
                <div id="employerRegisterForm" style="display:none;">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <input type="hidden" name="role" value="employer">
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control"
                                   placeholder="Enter your full name" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Company Name</label>
                            <input type="text" name="company_name" class="form-control"
                                   placeholder="Enter your company name" value="{{ old('company_name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Work Email</label>
                            <input type="email" name="email" class="form-control"
                                   placeholder="Enter your work email" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="company_phone" class="form-control"
                                   placeholder="Enter your phone number" value="{{ old('company_phone') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control"
                                   placeholder="Create a password" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                   placeholder="Confirm your password" required>
                        </div>
                        <button type="submit" class="btn-submit mb-3">Create Employer Account</button>
                        <p class="text-center text-muted" style="font-size:0.9rem;">
                            Already have an account?
                            <a onclick="onLoginTabClick()" class="bottom-link">Login here</a>
                        </p>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
var currentRole = 'seeker';

function setTabActive(tab) {
    document.getElementById('loginTab').classList.toggle('active', tab === 'login');
    document.getElementById('registerTab').classList.toggle('active', tab === 'register');
}

function hideAllForms() {
    document.getElementById('loginForm').style.display = 'none';
    document.getElementById('seekerRegisterForm').style.display = 'none';
    document.getElementById('employerRegisterForm').style.display = 'none';
}

function onLoginTabClick() {
    hideAllForms();
    setTabActive('login');
    document.getElementById('loginForm').style.display = 'block';
}

function onRegisterTabClick() {
    hideAllForms();
    setTabActive('register');
    if (currentRole === 'employer') {
        document.getElementById('employerRegisterForm').style.display = 'block';
    } else {
        document.getElementById('seekerRegisterForm').style.display = 'block';
    }
}

function setSeekerContext() {
    currentRole = 'seeker';
    document.getElementById('panelTitle').textContent = 'Jobseeker!';
    document.getElementById('panelSubtitle').textContent = 'Welcome to JobBridge. Login or create your account below.';
    document.getElementById('leftTitle').textContent = 'Welcome to JobBridge!';
    document.getElementById('leftSubtitle').textContent = 'Find your dream job or hire the right talent. Your career journey starts here!';
}

function setEmployerContext() {
    currentRole = 'employer';
    document.getElementById('panelTitle').textContent = 'Employer!';
    document.getElementById('panelSubtitle').textContent = 'Welcome to JobBridge. Create your employer account below.';
    document.getElementById('leftTitle').textContent = 'Welcome, Employer!';
    document.getElementById('leftSubtitle').textContent = 'Post jobs and find the right talent for your company!';
}

function showSeekerLogin() {
    setSeekerContext();
    hideAllForms();
    setTabActive('login');
    document.getElementById('loginForm').style.display = 'block';
}

function showSeekerRegister() {
    setSeekerContext();
    hideAllForms();
    setTabActive('register');
    document.getElementById('seekerRegisterForm').style.display = 'block';
}

function showEmployerLogin() {
    setEmployerContext();
    hideAllForms();
    setTabActive('login');
    document.getElementById('loginForm').style.display = 'block';
}

function setEmployerRegister() {
    setEmployerContext();
    hideAllForms();
    setTabActive('register');
    document.getElementById('employerRegisterForm').style.display = 'block';
}

window.onload = function() {
    if (window.location.search.includes('type=employer')) {
        showEmployerLogin();
    }
    if (window.location.search.includes('register=employer')) {
        setEmployerRegister();
    }
    if (window.location.search.includes('register=seeker')) {
        showSeekerRegister();
    }
}
</script>
</body>
</html>