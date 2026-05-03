<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;

class EmployerController extends Controller
{
    public function dashboard()
    {
        return view('employer.dashboard');
    }
}