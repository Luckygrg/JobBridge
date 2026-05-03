<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Employer\EmployerController;
use App\Http\Controllers\Employer\JobController;
use App\Http\Controllers\Seeker\SeekerController;

// Home
Route::get('/', function () {
    return view('welcome');
});

// Redirect /dashboard to role based dashboard
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'employer') {
        return redirect()->route('employer.dashboard');
    } elseif (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('seeker.dashboard');
    }
})->middleware(['auth'])->name('dashboard');

// Auth Routes (Breeze)
require __DIR__.'/auth.php';

// Employer Routes
Route::middleware(['auth', 'employer'])->prefix('employer')->name('employer.')->group(function () {
    Route::get('/dashboard', [EmployerController::class, 'dashboard'])->name('dashboard');
    Route::resource('jobs', JobController::class);
});

// Seeker Routes
Route::middleware(['auth', 'seeker'])->prefix('seeker')->name('seeker.')->group(function () {
    Route::get('/dashboard', [SeekerController::class, 'dashboard'])->name('dashboard');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
});