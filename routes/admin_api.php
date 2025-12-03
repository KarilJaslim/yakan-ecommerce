<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CustomOrderController as AdminCustomOrderController;

/*
|--------------------------------------------------------------------------
| Admin API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin API routes for your application.
| These routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "admin" middleware group.
|
*/

Route::middleware(['auth:admin', 'throttle:api'])->prefix('v1/admin')->group(function () {
    
    // Custom Orders Management
    Route::prefix('/custom-orders')->group(function () {
        Route::get('/', [AdminCustomOrderController::class, 'index']);
        Route::get('/pending', [AdminCustomOrderController::class, 'getPendingOrders']);
        Route::get('/{id}', [AdminCustomOrderController::class, 'show']);
        Route::post('/{id}/quote-price', [AdminCustomOrderController::class, 'quotePrice']);
        Route::post('/{id}/reject', [AdminCustomOrderController::class, 'rejectOrder']);
        Route::post('/{id}/notify-user', [AdminCustomOrderController::class, 'notifyUser']);
        Route::post('/{id}/mark-processing', [AdminCustomOrderController::class, 'markAsProcessing']);
        Route::post('/{id}/mark-completed', [AdminCustomOrderController::class, 'markAsCompleted']);
        Route::get('/statistics', [AdminCustomOrderController::class, 'getStatistics']);
    });
    
});
