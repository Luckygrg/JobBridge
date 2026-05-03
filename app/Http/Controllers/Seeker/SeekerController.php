<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;

class SeekerController extends Controller
{
    public function dashboard()
    {
        return view('seeker.dashboard');
    }
}