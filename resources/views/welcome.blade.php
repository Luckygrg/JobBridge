<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobBridge - Find Your Dream Job</title>    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; color: #333; }

        .navbar { background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 15px 0; }
        .navbar-brand { font-size: 1.5rem; font-weight: 700; color: #00897b !important; }
        .nav-link { color: #333 !important; font-weight: 500; }
        .nav-link:hover { color: #00897b !important; }
        .btn-login { border: 2px solid #00897b; color: #00897b; border-radius: 25px; padding: 6px 22px; font-weight: 600; }
        .btn-login:hover { background: #00897b; color: #fff; }
        .btn-register { background: #00897b; color: #fff; border-radius: 25px; padding: 6px 22px; font-weight: 600; border: 2px solid #00897b; }
        .btn-register:hover { background: #00695c; color: #fff; }

        .dropdown-toggle { background: #fff !important; border: none !important; color: #333 !important; font-weight: 500; }
        .dropdown-toggle:hover { color: #00897b !important; }
        .dropdown-item:hover { color: #00897b; background: #e0f2f1; }

        .hero { background: linear-gradient(135deg, #e0f2f1 0%, #b2dfdb 100%); padding: 80px 0; }
        .hero h1 { font-size: 2.5rem; font-weight: 700; color: #1a1a2e; line-height: 1.3; }
        .hero h1 span { color: #00897b; }
        .hero p { color: #555; font-size: 1.1rem; }
        .search-box { background: #fff; border-radius: 50px; padding: 8px 8px 8px 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); display: flex; align-items: center; max-width: 580px; }
        .search-box input { border: none; outline: none; flex: 1; font-size: 1rem; color: #333; background: transparent; }
        .search-box .btn-search { background: #00897b; color: #fff; border: none; border-radius: 50px; padding: 10px 28px; font-weight: 600; }
        .search-box .btn-search:hover { background: #00695c; }
        .category-tags .tag { background: #fff; color: #00897b; border: 1px solid #00897b; border-radius: 20px; padding: 5px 15px; font-size: 0.85rem; cursor: pointer; display: inline-block; margin: 4px; }
        .category-tags .tag:hover { background: #00897b; color: #fff; }

        .stats { background: #fff; padding: 30px 0; border-bottom: 1px solid #eee; }
        .stat-item h3 { color: #00897b; font-weight: 700; font-size: 1.8rem; margin-bottom: 4px; }
        .stat-item p { color: #666; font-size: 0.9rem; margin: 0; }

        .section-title { font-size: 1.5rem; font-weight: 700; color: #1a1a2e; border-left: 4px solid #00897b; padding-left: 12px; }
        .job-card { background: #fff; border: 1px solid #e0e0e0; border-radius: 12px; padding: 20px; transition: all 0.3s; height: 100%; }
        .job-card:hover { box-shadow: 0 8px 25px rgba(0,137,123,0.15); transform: translateY(-3px); border-color: #00897b; }
        .job-card h6 { color: #1a1a2e; font-weight: 600; font-size: 1rem; }
        .job-card .company { color: #666; font-size: 0.9rem; }
        .job-card .location { color: #888; font-size: 0.85rem; }
        .badge-type { background: #e0f2f1; color: #00695c; border-radius: 20px; padding: 4px 12px; font-size: 0.78rem; font-weight: 600; }
        .deadline { color: #e74c3c; font-size: 0.85rem; margin: 0; }

        .how-it-works { background: #f8f9fa; padding: 60px 0; }
        .step-card { text-align: center; padding: 30px 20px; }
        .step-number { width: 40px; height: 40px; background: #00897b; color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1rem; font-weight: 700; margin: 0 auto 15px; }

        .cta-section { background: #004d40; padding: 60px 0; color: #fff; text-align: center; }
        .cta-section h2 { font-size: 2rem; font-weight: 700; }
        .btn-cta { background: #fff; color: #00897b; border-radius: 25px; padding: 12px 35px; font-weight: 700; font-size: 1rem; border: none; }
        .btn-cta:hover { background: #e0f2f1; color: #00695c; }

        footer { background: #00695c; color: #fff; padding: 50px 0 20px; }
        footer h6 { color: #fff; font-weight: 600; margin-bottom: 15px; font-size: 1rem; }
        footer a { color: #b2dfdb; text-decoration: none; display: block; margin-bottom: 8px; font-size: 0.9rem; }
        footer a:hover { color: #fff; }
        footer p { color: #b2dfdb; }
        .footer-brand { font-size: 1.3rem; font-weight: 700; color: #fff; margin-bottom: 10px; }
        .footer-bottom { border-top: 1px solid #00897b; margin-top: 30px; padding-top: 20px; text-align: center; font-size: 0.85rem; color: #b2dfdb; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="/">JobBridge</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto ms-4">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('jobs.index') }}">Browse Jobs</a>
            </ul>
            <div class="d-flex gap-3 align-items-center">

                <!-- For Jobseekers Dropdown -->
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        For Jobseekers
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                        <li><a class="dropdown-item" href="{{ route('register') }}">Create Account</a></li>
                    </ul>
                </div>

                <!-- Divider -->
                <div style="width:1px; height:30px; background:#ddd;"></div>

                <!-- For Employers Dropdown -->
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        For Employers
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                        <li><a class="dropdown-item" href="{{ route('register') }}">Register</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</nav>

<!-- Hero -->
<section class="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="mb-3">
                    Find Your <span>Dream Job</span><br>
                    Bridge Your Career Today!
                </h1>
                <p class="mb-4">Search and apply for the best jobs. Connect employers with the right talent across Nepal!</p>
                <div class="search-box mb-4">
                    <input type="text" placeholder="Search by Job Title, Company or Location...">
                    <button class="btn-search">Search Job</button>
                </div>
                <div class="category-tags">
                    <span class="tag">IT & Software</span>
                    <span class="tag">Marketing</span>
                    <span class="tag">Finance</span>
                    <span class="tag">Engineering</span>
                    <span class="tag">Healthcare</span>
                    <span class="tag">Education</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats -->
<section class="stats">
    <div class="container">
        <div class="row text-center g-4">
            <div class="col-6 col-md-3 stat-item">
                <h3>500+</h3>
                <p>Jobs Available</p>
            </div>
            <div class="col-6 col-md-3 stat-item">
                <h3>200+</h3>
                <p>Companies</p>
            </div>
            <div class="col-6 col-md-3 stat-item">
                <h3>1000+</h3>
                <p>Job Seekers</p>
            </div>
            <div class="col-6 col-md-3 stat-item">
                <h3>100+</h3>
                <p>Successful Hires</p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Jobs -->
<section class="py-5">
    <div class="container">
        <h2 class="section-title mb-4">Featured Jobs</h2>
        <div class="row g-3">
            <div class="col-md-4">
                <div class="job-card">
                    <h6>Laravel Developer</h6>
                    <p class="company mb-1">TechCorp Nepal</p>
                    <p class="location mb-2">Kathmandu, Nepal</p>
                    <div class="mb-2">
                        <span class="badge-type">Full Time</span>
                        <span class="badge-type ms-1">IT & Software</span>
                    </div>
                    <p class="deadline">Deadline: 2026-08-31</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="job-card">
                    <h6>Marketing Manager</h6>
                    <p class="company mb-1">Digital Nepal Pvt. Ltd.</p>
                    <p class="location mb-2">Pokhara, Nepal</p>
                    <div class="mb-2">
                        <span class="badge-type">Full Time</span>
                        <span class="badge-type ms-1">Marketing</span>
                    </div>
                    <p class="deadline">Deadline: 2026-07-15</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="job-card">
                    <h6>Finance Officer</h6>
                    <p class="company mb-1">Nepal Bank Ltd.</p>
                    <p class="location mb-2">Lalitpur, Nepal</p>
                    <div class="mb-2">
                        <span class="badge-type">Full Time</span>
                        <span class="badge-type ms-1">Finance</span>
                    </div>
                    <p class="deadline">Deadline: 2026-06-30</p>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('register') }}" class="btn btn-register px-4 py-2">View All Jobs</a>
        </div>
    </div>
</section>

<!-- How it works -->
<section class="how-it-works">
    <div class="container">
        <h2 class="section-title mb-5">How It Works</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <h5 class="fw-bold mb-2">Create Account</h5>
                    <p class="text-muted">Register as Job Seeker or Employer in just a few clicks!</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="step-card">
                    <div class="step-number">2</div>
                    <h5 class="fw-bold mb-2">Search Jobs</h5>
                    <p class="text-muted">Browse hundreds of jobs by category, location or job type!</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="step-card">
                    <div class="step-number">3</div>
                    <h5 class="fw-bold mb-2">Apply & Get Hired</h5>
                    <p class="text-muted">Apply with your resume and cover letter and get hired fast!</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="container">
        <h2 class="mb-3">Ready to Find Your Dream Job?</h2>
        <p class="mb-4 opacity-75">Join thousands of job seekers and employers on JobBridge today!</p>
        <div class="d-flex gap-3 justify-content-center">
            <a href="{{ route('register') }}" class="btn btn-cta">Get Started</a>
            <a href="{{ route('login') }}" class="btn btn-outline-light rounded-pill px-4">Login</a>
        </div>
    </div>
</section>

<!-- Footer -->
<footer>
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="footer-brand">JobBridge</div>
                <p>Connecting job seekers and employers across Nepal. Find your dream job today!</p>
            </div>
            <div class="col-md-2">
                <h6>For Job Seekers</h6>
                <a href="{{ route('register') }}">Search Jobs</a>
                <a href="{{ route('register') }}">Create Account</a>
                <a href="{{ route('login') }}">Login</a>
            </div>
            <div class="col-md-2">
                <h6>For Employers</h6>
                <a href="{{ route('register') }}">Post a Job</a>
                <a href="{{ route('register') }}">Register</a>
                <a href="{{ route('login') }}">Login</a>
            </div>
            <div class="col-md-4">
                <h6>Contact Us</h6>
                <p>Kathmandu, Nepal</p>
                <p>info@jobbridge.com</p>
                <p>+977 1 234567</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2026 JobBridge. All Rights Reserved.</p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>