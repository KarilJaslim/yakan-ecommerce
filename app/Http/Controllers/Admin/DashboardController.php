<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();

        $ordersByStatus = Order::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $topProducts = Product::withSum('orderItems', 'quantity')
            ->orderByDesc('order_items_sum_quantity')
            ->take(5)
            ->get();

        $orders = Order::with('items.product', 'user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.dashboard', [
            'totalOrders' => $totalOrders,
            'ordersByStatus' => $ordersByStatus,
            'topProducts' => $topProducts,
            'orders' => $orders,
            'pendingOrders' => $ordersByStatus['pending'] ?? 0,
            'completedOrders' => $ordersByStatus['completed'] ?? 0,
        ]);
    }

    public function metrics()
    {
        $totalOrders = Order::count();
        $ordersByStatus = Order::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $topProducts = Product::withSum('orderItems', 'quantity')
            ->orderByDesc('order_items_sum_quantity')
            ->take(5)
            ->get();

        return response()->json([
            'totalOrders' => $totalOrders,
            'ordersByStatus' => $ordersByStatus,
            'topProducts' => $topProducts,
        ]);
    }
}
