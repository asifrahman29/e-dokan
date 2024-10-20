<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Import\InvoiceController as ImportSupplyInvoice;
use App\Http\Controllers\Import\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Social\SocialAuthController;
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
/** Dashboard */
Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware('role:superadmin,admin,customer')
    ->name('dashboard');

/** Social login */
Route::prefix('auth')->group(function () {
    Route::get('{provider}/redirect', [SocialAuthController::class, 'redirectToProvider'])
         ->name('social.redirect');
    Route::get('{provider}/callback', [SocialAuthController::class, 'handleProviderCallback'])
         ->name('social.callback');
});

/** Admin */

/** profile */
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
    Route::resource('product', ProductController::class,)->names('products');
    Route::prefix('import')->group(function () {
        Route::resource('suppliers', SupplierController::class)->names('suppliers');
        Route::get('product/{id?}/{name?}/{invoice?}', [ImportSupplyInvoice::class, 'create'])->name('ImportsupplyInvoiceCreate');
        Route::post('product', [ImportSupplyInvoice::class, 'store'])->name('import.invoice.store');
        Route::resource('invoice', ImportSupplyInvoice::class)->names('supplyInvoice');
    });
});


/**
 * customer all route
 */
Route::middleware('auth', 'role:customer,admin,superadmin')->group(function () {
    Route::get('/home', [AdminController::class, 'dashboard'])->name('home');
});

require __DIR__ . '/auth.php';
