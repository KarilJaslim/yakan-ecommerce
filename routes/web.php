<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Controllers
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomOrderController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\OrderController; // <-- Added

// Admin Controllers
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\AdminCustomOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;

/*
|--------------------------------------------------------------------------
| Welcome / Landing Page Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::post('/contact', [WelcomeController::class, 'submitContact'])->name('contact.submit');

// Quick Add to Cart
Route::post('/quick-add-to-cart/{product}', [WelcomeController::class, 'addToCart'])
    ->middleware('auth')
    ->name('quick.add.cart');

// Wishlist Toggle
Route::post('/toggle-wishlist/{product}', [WelcomeController::class, 'toggleWishlist'])
    ->middleware('auth')
    ->name('toggle.wishlist');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
// User Login Page
Route::get('/login', function () {
    return view('auth.user-login');
})->name('login');

// User Login Submit
Route::post('/login/user', [AuthenticatedSessionController::class, 'storeUser'])
    ->name('login.user');

// User Register Page
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');

// User Register Submit
Route::post('/register', [RegisteredUserController::class, 'store'])
    ->name('register.store');

// Admin Login Page
Route::get('/admin/login', function () {
    return view('auth.admin-login');
})->name('admin.login.form');

// Admin Login Submit
Route::post('/admin/login', [AuthenticatedSessionController::class, 'storeAdmin'])
    ->name('admin.login.submit');

// Logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| User Dashboard
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->get('/dashboard', function () {
    return Auth::user()->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : view('dashboard');
})->name('dashboard');

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cart Routes
    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::post('/add/{product}', [CartController::class, 'add'])->name('cart.add');
        Route::post('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
        Route::patch('/update/{id}', [CartController::class, 'update'])->name('cart.update');

        // Checkout pages
        Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
        Route::post('/checkout/process', [CartController::class, 'processCheckout'])->name('cart.checkout.process');
    });

    // User Orders Route (needed for redirect after checkout)
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    // Custom Orders (User)
    Route::prefix('custom-orders')->group(function () {
        Route::get('/', [CustomOrderController::class, 'userIndex'])->name('custom_orders.index');
        Route::get('/create', [CustomOrderController::class, 'create'])->name('custom_orders.create');
        Route::post('/store', [CustomOrderController::class, 'store'])->name('custom_orders.store');
        Route::get('/{order}', [CustomOrderController::class, 'show'])->name('custom_orders.show');
    });
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'is_admin'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {

        // Admin Dashboard
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // Admin Orders
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::post('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.update_status');

        // Admin Custom Orders
        Route::prefix('custom-orders')->group(function () {
            Route::get('/', [AdminCustomOrderController::class, 'index'])->name('custom_orders.index');
            Route::get('/{order}', [AdminCustomOrderController::class, 'show'])->name('custom_orders.show');
            Route::post('/{order}/status', [AdminCustomOrderController::class, 'updateStatus'])->name('custom_orders.update_status');
        });

        // Admin Product CRUD
        Route::resource('products', AdminProductController::class);
    });

/*
|--------------------------------------------------------------------------
| Public Shop Routes (User POV)
|--------------------------------------------------------------------------
*/
// Shop Index
Route::get('/shop', [ProductController::class, 'shopIndex'])->name('shop.index');

// Product Details
Route::get('/shop/{product}', [ProductController::class, 'show'])->name('shop.show');

// Alias for older blades
Route::get('/products', [ProductController::class, 'shopIndex'])->name('products.index');
