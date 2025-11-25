<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Controllers
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomOrderController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\WelcomeController;

// Auth Controllers
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

// Admin Controllers
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\AdminCustomOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Welcome / Landing Page
|--------------------------------------------------------------------------
*/
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::post('/contact', [WelcomeController::class, 'submitContact'])->name('contact.submit');

/*
|--------------------------------------------------------------------------
| Default Login Redirect
|--------------------------------------------------------------------------
*/
Route::get('/login', function () {
    return redirect()->route('login.user.form');
})->name('login');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    // User Login
    Route::get('/login-user', fn() => view('auth.user-login'))->name('login.user.form');
    Route::post('/login-user', [AuthenticatedSessionController::class, 'storeUser'])->name('login.user.submit');

    // Admin Login
    Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login.form');
    Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');

    // User Registration
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');

    /*
    |--------------------------------------------------------------------------
    | Password Reset Routes
    |--------------------------------------------------------------------------
    */
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('password.request');

    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');

    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
        ->name('password.reset');

    Route::post('password/reset', [ResetPasswordController::class, 'reset'])
        ->name('password.update');
});

// Logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->middleware('auth:admin')->name('admin.logout');

/*
|--------------------------------------------------------------------------
| OAuth Routes
|--------------------------------------------------------------------------
*/
Route::get('/auth/google', [SocialAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');

Route::get('/auth/facebook', [SocialAuthController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('/auth/facebook/callback', [SocialAuthController::class, 'handleFacebookCallback'])->name('auth.facebook.callback');

/*
|--------------------------------------------------------------------------
| Dashboard Redirect
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->get('/dashboard', function () {
    $user = Auth::user();
    if ($user && $user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return view('dashboard', compact('user'));
})->name('dashboard');

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Profile
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Cart & Checkout
    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::post('/add/{product}', [CartController::class, 'add'])->name('cart.add');
        Route::post('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
        Route::delete('/remove/{cartItem}', [CartController::class, 'remove'])->name('cart.destroy');
        Route::patch('/update/{id}', [CartController::class, 'update'])->name('cart.update');
        Route::post('/clear', [CartController::class, 'clear'])->name('cart.clear');

        Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
        Route::post('/checkout/process', [CartController::class, 'processCheckout'])->name('cart.checkout.process');
    });

    // Payments
    Route::prefix('payment')->group(function () {
        Route::get('/online/{order}', [CartController::class, 'showOnlinePayment'])->name('payment.online');
        Route::get('/bank/{order}', [CartController::class, 'showBankPayment'])->name('payment.bank');
        Route::post('/process/{order}', [CartController::class, 'processPayment'])->name('payment.process');
        Route::get('/success/{order}', [CartController::class, 'paymentSuccess'])->name('payment.success');
        Route::get('/failed/{order}', [CartController::class, 'paymentFailed'])->name('payment.failed');
    });

    // Orders
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/{order}', [OrderController::class, 'show'])->name('orders.show');
        Route::post('/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
        Route::get('/{order}/invoice', [OrderController::class, 'downloadInvoice'])->name('orders.invoice');
    });

    // Custom Orders
    Route::prefix('custom-orders')->group(function () {
        Route::get('/', [CustomOrderController::class, 'userIndex'])->name('custom_orders.index');
        Route::get('/create', [CustomOrderController::class, 'create'])->name('custom_orders.create');
        Route::post('/store', [CustomOrderController::class, 'store'])->name('custom_orders.store');
        Route::get('/{order}', [CustomOrderController::class, 'show'])->name('custom_orders.show');
        Route::post('/{order}/cancel', [CustomOrderController::class, 'cancel'])->name('custom_orders.cancel');
    });

    // Tracking
    Route::prefix('track')->group(function () {
        Route::get('/', [TrackingController::class, 'index'])->name('track.index');
        Route::post('/search', [TrackingController::class, 'track'])->name('track.search');
        Route::get('/{trackingNumber}', [TrackingController::class, 'show'])->name('track.show');
    });
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // **Metrics API for Axios charts**
    Route::get('/dashboard/metrics', [DashboardController::class, 'metrics'])->name('dashboard.metrics');

    // Product Management
    Route::resource('products', AdminProductController::class);
    Route::post('/products/{product}/toggle-status', [AdminProductController::class, 'toggleStatus'])->name('products.toggleStatus');
    Route::post('/products/bulk-delete', [AdminProductController::class, 'bulkDelete'])->name('products.bulkDelete');

    // Orders
    Route::prefix('orders')->group(function () {
        Route::get('/', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::post('/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.update_status');
        Route::post('/{order}/cancel', [AdminOrderController::class, 'cancel'])->name('orders.cancel');
        Route::get('/{order}/invoice', [AdminOrderController::class, 'generateInvoice'])->name('orders.invoice');
        Route::post('/bulk-update', [AdminOrderController::class, 'bulkUpdate'])->name('orders.bulkUpdate');

        // Quick update status route
        Route::post('/{order}/quick-update-status', [AdminOrderController::class, 'quickUpdateStatus'])->name('orders.quickUpdateStatus');
    });

    // Custom Orders
    Route::prefix('custom-orders')->group(function () {
        Route::get('/', [AdminCustomOrderController::class, 'index'])->name('custom_orders.index');
        Route::get('/{order}', [AdminCustomOrderController::class, 'show'])->name('custom_orders.show');
        Route::post('/{order}/status', [AdminCustomOrderController::class, 'updateStatus'])->name('custom_orders.update_status');
        Route::post('/{order}/approve', [AdminCustomOrderController::class, 'approve'])->name('custom_orders.approve');
        Route::post('/{order}/reject', [AdminCustomOrderController::class, 'reject'])->name('custom_orders.reject');
        Route::post('/{order}/set-price', [AdminCustomOrderController::class, 'setPrice'])->name('custom_orders.setPrice');
    });
});

/*
|--------------------------------------------------------------------------
| Public Shop Routes
|--------------------------------------------------------------------------
*/
Route::get('/products', [ProductController::class, 'shopIndex'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/category/{category}', [ProductController::class, 'byCategory'])->name('products.category');

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
Route::prefix('api')->group(function () {
    Route::get('/track/{trackingNumber}', function ($trackingNumber) {
        return response()->json([
            'tracking_number' => $trackingNumber,
            'status' => 'Out for Delivery',
            'history' => [
                ['status' => 'Order Placed', 'date' => now()->subDays(3)->format('Y-m-d h:i A')],
                ['status' => 'Packed', 'date' => now()->subDays(2)->format('Y-m-d h:i A')],
                ['status' => 'Shipped', 'date' => now()->subDays(1)->format('Y-m-d h:i A')],
                ['status' => 'Out for Delivery', 'date' => now()->format('Y-m-d h:i A')],
            ]
        ]);
    })->name('api.track');
});

// Fallback 404
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
