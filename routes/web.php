<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperAdmin\SuperAdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Redirector;

/**
 * welcom page
 */
Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware('role:superadmin,admin,customer')
    ->name('dashboard');


/**
 * profile
 */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// /**
//  * superadmin all route
//  */
Route::middleware('auth', 'role:superadmin')->group(function () {
    Route::get('/superadmin/dashboard', [SuperAdminController::class, 'dashboard'])->name('superadmin.dashboard');
});


// /**
//  * admin all route
//  */
Route::middleware('auth', 'role:admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});


/**
 * customer all route
 */
Route::middleware('auth', 'role:customer,admin,superadmin')->group(function () {
    Route::get('/home', [AdminController::class, 'dashboard'])->name('home');
});

require __DIR__ . '/auth.php';
