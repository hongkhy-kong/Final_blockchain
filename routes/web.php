<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController; // <-- Make sure this import is added

// Example test route
Route::get('/index', function () {
    return view('index');
});

// Example test route
Route::get('/test', function () {
    return 'Web routes are working!';
});

// Admin login routes
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin routes protected by auth middleware
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Employer routes
    Route::get('/create-employer', [AdminController::class, 'createEmployer'])->name('admin.createEmployer');
    Route::post('/store-employer', [AdminController::class, 'storeEmployer'])->name('admin.storeEmployer');
    Route::get('admin/employers/{id}/edit', [AdminController::class, 'editEmployer'])->name('admin.editEmployer');
    Route::put('admin/employers/{id}', [AdminController::class, 'updateEmployer'])->name('admin.updateEmployer');
    Route::delete('admin/employers/{id}', [AdminController::class, 'deleteEmployer'])->name('admin.deleteEmployer');

    // Employee routes
    Route::get('/create-employee', [AdminController::class, 'createEmployee'])->name('admin.createEmployee');
    Route::post('/store-employee', [AdminController::class, 'storeEmployee'])->name('admin.storeEmployee');
    Route::get('admin/employees/{id}/edit', [AdminController::class, 'editEmployee'])->name('admin.editEmployee');
    Route::put('admin/employees/{id}', [AdminController::class, 'updateEmployee'])->name('admin.updateEmployee');
    Route::delete('admin/employees/{id}', [AdminController::class, 'deleteEmployee'])->name('admin.deleteEmployee');

});
