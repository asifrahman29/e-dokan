<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Import\InvoiceController as ImportSupplyInvoice;
use App\Http\Controllers\Import\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Social\SocialAuthController;
use App\Http\Controllers\SuperAdmin\SuperAdminController;
use App\Http\Controllers\User\UserController;
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
Route::prefix('admin')->group(function () {
    Route::resource('product', ProductController::class,)->names('products');
    Route::prefix('import')->group(function () {
        Route::resource('suppliers', SupplierController::class)->names('suppliers');
        Route::get('product/{id?}/{name?}/{invoice?}', [ImportSupplyInvoice::class, 'create'])->name('ImportsupplyInvoiceCreate');
        Route::post('product', [ImportSupplyInvoice::class, 'store'])->name('import.invoice.store');
        Route::resource('invoice', ImportSupplyInvoice::class)->names('supplyInvoice');
    });
    
    Route::get('user/customers', [UserController::class, 'indexCustomers'])->name('user.indexCustomers');
    Route::get('user/supar-admin', [UserController::class, 'indexSuparAdmin'])->name('user.indexSuparAdmin');
    Route::get('user/admin', [UserController::class, 'indexAdmin'])->name('user.indexAdmin');
    
    Route::resource('user', UserController::class)->names('user');
    
})->middleware('auth', 'role:admin');


/**
 * customer all route
 */
Route::middleware('auth', 'role:customer,admin,superadmin')->group(function () {
    Route::get('/home', [UserController::class, 'home'])->name('home');
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
});

/**
 * frontend product by category, subcategory, brand, search, single product, cart, wishlist, checkout
 */
Route::get('/{category}', [ProductController::class, 'category'])->name('product.category');
Route::get('/{category}/{subcategory}', [ProductController::class, 'subcategory'])->name('product.subcategory');
Route::get('/search', [ProductController::class, 'search'])->name('product.search');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');
Route::get('/cart', [ProductController::class, 'cart'])->name('product.cart');
Route::get('/wishlist', [ProductController::class, 'wishlist'])->name('product.wishlist');
Route::get('/checkout', [ProductController::class, 'checkout'])->name('product.checkout');

 /**
  * auth 
  */
require __DIR__ . '/auth.php';
