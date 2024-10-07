<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/**
 * welcom page
 */
Route::get('/', function () {
    return view('welcome');
});

/**
 * logical dashboard
 */
Route::get('/dashboard', function () {
    switch (Auth::user()->role) {
        case 'admin':
            return redirect()->intended(route('admin.dashboard'));
        case 'superadmin':
            return redirect()->intended(route('superadmin.dashboard'));
        case 'customer':
            return redirect()->intended(route('customer.dashboard'));
        default:
            return redirect()->route('home');
    }
})->middleware(['auth', 'verified'])->name('dashboard');


/**
 * profile
 */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**
 * superadmin all route
 */
Route::middleware('auth', 'superadmin')->group(function () {
    //
    // Route::get('/superadmin/dashboard', [SuperAdminController::class, 'dashboard'])->name('superadmin.dashboard');

});

/**
 * admin all route
 */
Route::middleware('auth', 'role:admin')->group(function () {
    //
    // Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

});

/**
 * customer all route
 */
Route::middleware('auth', 'customer')->group(function () {
    //
    // Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');

});

Route::get('/test', function () {
    return view('admin.dashboard');
});

require __DIR__ . '/auth.php';
