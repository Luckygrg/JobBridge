<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Employer\EmployerController;
use App\Http\Controllers\Seeker\SeekerController;

// Home
Route::get('/', function () {
    return view('welcome');
});

// Auth Routes (Breeze)
require __DIR__.'/auth.php';

// Employer Routes
Route::middleware(['auth', 'employer'])->prefix('employer')->name('employer.')->group(function () {
    Route::get('/dashboard', [EmployerController::class, 'dashboard'])->name('dashboard');
});

// Seeker Routes
Route::middleware(['auth', 'seeker'])->prefix('seeker')->name('seeker.')->group(function () {
    Route::get('/dashboard', [SeekerController::class, 'dashboard'])->name('dashboard');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
});