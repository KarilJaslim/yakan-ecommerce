<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import DB facade
use App\Models\Order;
use App\Models\Product;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard page.
     */
    public function index()
    {
        // Total orders
        $totalOrders = Order::count();

        // Orders grouped by status
        $ordersByStatus = Order::select('status', DB::raw('count(*) as total'))
                                ->groupBy('status')
                                ->pluck('total', 'status')
                                ->toArray();

        // Top 5 products based on quantity sold
        $topProducts = Product::withSum('orderItems', 'quantity') // Make sure Product model has orderItems() relation
                              ->orderByDesc('order_items_sum_quantity')
                              ->limit(5)
                              ->get(['id', 'name']);

        // Latest orders with related user and order items
        $orders = Order::with(['user', 'orderItems.product']) // Make sure Order model has orderItems() relation
                       ->orderBy('created_at', 'desc')
                       ->get();

        // Pending and completed orders for dashboard cards
        $pendingOrders = $ordersByStatus['pending'] ?? 0;
        $completedOrders = $ordersByStatus['completed'] ?? 0;

        return view('admin.dashboard', compact(
            'totalOrders',
            'pendingOrders',
            'completedOrders',
            'orders',
            'topProducts',
            'ordersByStatus'
        ));
    }

    /**
     * Return metrics JSON for dashboard charts (Axios API).
     */
    public function metrics()
    {
        $totalOrders = Order::count();

        $ordersByStatus = Order::select('status', DB::raw('count(*) as total'))
                                ->groupBy('status')
                                ->pluck('total', 'status')
                                ->toArray();

        $topProducts = Product::withSum('orderItems', 'quantity')
                              ->orderByDesc('order_items_sum_quantity')
                              ->limit(5)
                              ->get(['id', 'name', 'order_items_sum_quantity']);

        return response()->json([
            'totalOrders' => $totalOrders,
            'ordersByStatus' => $ordersByStatus,
            'topProducts' => $topProducts,
        ]);
    }
}
