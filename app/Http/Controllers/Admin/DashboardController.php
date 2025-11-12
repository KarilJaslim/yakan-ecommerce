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

                              return view('admin.orders.dashboard', compact('totalOrders', 'ordersByStatus', 'topProducts'));
    }
}
