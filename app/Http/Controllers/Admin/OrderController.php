<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderController extends Controller
{
    // Show all orders
    public function index()
    {
        // Get all orders with related user and product items
        $orders = Order::with('user', 'items.product')
                        ->orderBy('created_at', 'desc')
                        ->get();

        // Get top 5 products by quantity sold
        $topProducts = Product::withSum('orderItems', 'quantity')
                        ->orderByDesc('order_items_sum_quantity')
                        ->take(5)
                        ->get();

        return view('admin.orders.index', compact('orders', 'topProducts'));
    }

    // Show order details
    public function show(Order $order)
    {
        $order->load('user', 'items.product');
        return view('admin.orders.show', compact('order'));
    }

    // Update order status
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Order status updated!');
    }
}
