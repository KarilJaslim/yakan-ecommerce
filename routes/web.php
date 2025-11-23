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
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TrackingController;

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

Route::post('/quick-add-to-cart/{product}', [WelcomeController::class, 'addToCart'])
    ->middleware('auth')
    ->name('quick.add.cart');

Route::post('/toggle-wishlist/{product}', [WelcomeController::class, 'toggleWishlist'])
    ->middleware('auth')
    ->name('toggle.wishlist');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', fn() => view('auth.user-login'))->name('login');
Route::post('/login/user', [AuthenticatedSessionController::class, 'storeUser'])->name('login.user');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');

Route::get('/admin/login', fn() => view('auth.admin-login'))->name('admin.login.form');
Route::post('/admin/login', [AuthenticatedSessionController::class, 'storeAdmin'])->name('admin.login.submit');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

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

    // Cart
    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::post('/add/{product}', [CartController::class, 'add'])->name('cart.add');
        Route::post('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
        Route::patch('/update/{id}', [CartController::class, 'update'])->name('cart.update');
        Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
        Route::post('/checkout/process', [CartController::class, 'processCheckout'])->name('cart.checkout.process');
    });

    Route::get('/payment/online/{order}', [CartController::class, 'showOnlinePayment'])->name('payment.online');
    Route::get('/payment/bank/{order}', [CartController::class, 'showBankPayment'])->name('payment.bank');

    // User Orders
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('orders.index'); // User sees their own orders
        Route::get('/{order}', [OrderController::class, 'show'])->name('orders.show');
    });

    // Custom Orders
    Route::prefix('custom-orders')->group(function () {
        Route::get('/', [CustomOrderController::class, 'userIndex'])->name('custom_orders.index');
        Route::get('/create', [CustomOrderController::class, 'create'])->name('custom_orders.create');
        Route::post('/store', [CustomOrderController::class, 'store'])->name('custom_orders.store');
        Route::get('/{order}', [CustomOrderController::class, 'show'])->name('custom_orders.show');
    });

    // Tracking Routes
    Route::get('/track-order', [TrackingController::class, 'index'])->name('track.index');
    Route::post('/track-order', [TrackingController::class, 'track'])->name('track.search');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');

    // Admin Orders
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.update_status');
    Route::post('/orders/{order}/quick-update-status', [AdminOrderController::class, 'quickUpdateStatus'])->name('orders.quickUpdateStatus');

    // Admin Custom Orders
    Route::get('/custom-orders', [AdminCustomOrderController::class, 'index'])->name('custom_orders.index');
    Route::get('/custom-orders/{order}', [AdminCustomOrderController::class, 'show'])->name('custom_orders.show');
    Route::post('/custom-orders/{order}/status', [AdminCustomOrderController::class, 'updateStatus'])->name('custom_orders.update_status');

    // Admin Products
    Route::resource('products', AdminProductController::class);
});

/*
|--------------------------------------------------------------------------
| Public Shop Routes
|--------------------------------------------------------------------------
*/
Route::get('/shop', [ProductController::class, 'shopIndex'])->name('shop.index');
Route::get('/shop/{product}', [ProductController::class, 'show'])->name('shop.show');
Route::get('/products', [ProductController::class, 'shopIndex'])->name('products.index');

/*
|--------------------------------------------------------------------------
| Fake Tracking API Route (API)
|--------------------------------------------------------------------------
*/
Route::get('/api/track/{trackingNumber}', function ($trackingNumber) {
    return response()->json([
        'tracking_number' => $trackingNumber,
        'status' => 'Out for Delivery',
        'history' => [
            ['status' => 'Order Placed', 'date' => '2025-01-12 10:00 AM'],
            ['status' => 'Packed', 'date' => '2025-01-12 1:30 PM'],
            ['status' => 'Shipped', 'date' => '2025-01-13 9:20 AM'],
            ['status' => 'Out for Delivery', 'date' => '2025-01-14 8:00 AM'],
        ]
    ]);
});
