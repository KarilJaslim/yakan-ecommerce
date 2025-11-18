<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// ---------------------------
// User Controllers
// ---------------------------
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CustomOrderController;

// ---------------------------
// Admin Controllers
// ---------------------------
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CustomOrderController as AdminCustomOrderController;
use App\Http\Middleware\IsAdmin;

// ---------------------------
// Public Routes
// ---------------------------
Route::get('/', fn() => view('welcome'))->name('home');

// ---------------------------
// Include Breeze / Auth Routes
// ---------------------------
require __DIR__.'/auth.php';

// ---------------------------
// Optional Custom Auth Routes
// ---------------------------
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// ---------------------------
// Authenticated User Routes
// ---------------------------
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    // Profile
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Products
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products.index');
        Route::get('/{product}', [ProductController::class, 'show'])->name('products.show');
    });

    // Cart
    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::get('/add/{product}', [CartController::class, 'add'])->name('cart.add');
        Route::get('/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
        Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    });

    // Custom Orders - User
    Route::prefix('custom-orders')->group(function () {
        Route::get('/', [CustomOrderController::class, 'userIndex'])->name('custom_orders.index');
        Route::get('/create', [CustomOrderController::class, 'create'])->name('custom_orders.create');
        Route::post('/', [CustomOrderController::class, 'store'])->name('custom_orders.store');
        Route::get('/{order}', [CustomOrderController::class, 'show'])->name('custom_orders.show');
    });
});

// ---------------------------
// Admin Routes
// ---------------------------

// Redirect /admin to /admin/dashboard
Route::get('/admin', function() {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', IsAdmin::class]);

Route::prefix('admin')->middleware(['auth', IsAdmin::class])->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/metrics', [DashboardController::class, 'metrics'])->name('dashboard.metrics');

    // Products CRUD
    Route::resource('products', AdminProductController::class);

    // Orders Management
    Route::prefix('orders')->group(function () {
        Route::get('/', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::put('/{order}/quick-update-status', [AdminOrderController::class, 'quickUpdateStatus'])->name('orders.quickUpdateStatus');
        Route::post('/{order}/refund', [AdminOrderController::class, 'refund'])->name('orders.refund');
    });

    // Custom Orders - Admin
    Route::prefix('custom-orders')->group(function () {
        Route::get('/', [AdminCustomOrderController::class, 'index'])->name('custom_orders.index');
        Route::get('/{order}', [AdminCustomOrderController::class, 'show'])->name('custom_orders.show');
        Route::post('/{order}/status', [AdminCustomOrderController::class, 'updateStatus'])->name('custom_orders.update_status');
    });

    // Optional Admin Logout
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
