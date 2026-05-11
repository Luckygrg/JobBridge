<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Employer\EmployerController;
use App\Http\Controllers\Employer\JobController;
use App\Http\Controllers\Seeker\SeekerController;

// Home
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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

// Public Job Routes
Route::get('/jobs', [App\Http\Controllers\JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{job}', [App\Http\Controllers\JobController::class, 'show'])->name('jobs.show');

// Auth Routes (Breeze)
require __DIR__.'/auth.php';

use App\Http\Controllers\Employer\ApplicationController;

// Employer Routes
Route::middleware(['auth', 'employer'])->prefix('employer')->name('employer.')->group(function () {
    Route::get('/dashboard', [EmployerController::class, 'dashboard'])->name('dashboard');
    Route::resource('jobs', JobController::class);
    Route::get('/jobs/{jobId}/applications', [ApplicationController::class, 'index'])->name('applications');
    Route::put('/applications/{application}/{status}', [ApplicationController::class, 'update'])->name('applications.update');
});

// Seeker Routes
Route::middleware(['auth', 'seeker'])->prefix('seeker')->name('seeker.')->group(function () {
    Route::get('/dashboard', [SeekerController::class, 'dashboard'])->name('dashboard');
    Route::get('/jobs', [App\Http\Controllers\Seeker\JobController::class, 'index'])->name('jobs');
    Route::get('/jobs/{job}', [App\Http\Controllers\Seeker\JobController::class, 'show'])->name('jobs.show');
    Route::post('/jobs/{job}/apply', [App\Http\Controllers\Seeker\JobController::class, 'apply'])->name('jobs.apply');
    Route::get('/applications', [App\Http\Controllers\Seeker\JobController::class, 'applications'])->name('applications');
    Route::get('/profile', [App\Http\Controllers\Seeker\ProfileController::class, 'edit'])->name('profile');
    Route::put('/profile', [App\Http\Controllers\Seeker\ProfileController::class, 'update'])->name('profile.update');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');
    Route::get('/jobs', [AdminController::class, 'jobs'])->name('jobs');
    Route::delete('/jobs/{job}', [AdminController::class, 'deleteJob'])->name('jobs.delete');
});