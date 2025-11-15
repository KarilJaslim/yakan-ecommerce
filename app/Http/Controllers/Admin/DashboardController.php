<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // Show admin dashboard
    public function index()
    {
        // Total orders
        $totalOrders = Order::count();

        // Orders by status
        $ordersByStatus = Order::select('status', DB::raw('count(*) as total'))
                               ->groupBy('status')
                               ->pluck('total','status');

        // Top-selling products using withSum
        $topProducts = Product::withSum('orderItems', 'quantity')
                              ->orderByDesc('order_items_sum_quantity')
                              ->take(5)
                              ->get();

        // Get recent orders for the table
        $orders = Order::with('items.product', 'user')
                       ->orderByDesc('created_at')
                       ->take(10) // adjust or remove take() to show all orders
                       ->get();

        return view('admin.orders.dashboard', compact('totalOrders', 'ordersByStatus', 'topProducts', 'orders'));
    }

    // Live dashboard metrics (AJAX endpoint)
    public function metrics()
    {
        // Total orders
        $totalOrders = Order::count();

        // Orders by status
        $ordersByStatus = Order::select('status', DB::raw('count(*) as total'))
                               ->groupBy('status')
                               ->pluck('total','status');

        // Top-selling products
        $topProducts = Product::withSum('orderItems', 'quantity')
                              ->orderByDesc('order_items_sum_quantity')
                              ->take(5)
                              ->get();

        // Recent orders for AJAX
        $orders = Order::with('items.product', 'user')
                       ->orderByDesc('created_at')
                       ->take(10)
                       ->get();

        return response()->json([
            'totalOrders' => $totalOrders,
            'ordersByStatus' => $ordersByStatus,
            'topProducts' => $topProducts,
            'orders' => $orders
        ]);
    }
}
