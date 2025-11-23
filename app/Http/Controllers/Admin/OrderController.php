<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    // Show all orders
    public function index(Request $request)
    {
        $query = Order::with('user', 'orderItems.product')->orderByDesc('created_at');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('user')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->user . '%');
            });
        }

        $orders = $query->get();

        if ($request->ajax()) {
            return view('admin.orders.partials.orders-rows', compact('orders'))->render();
        }

        return view('admin.orders.index', compact('orders'));
    }

    // Show single order
    public function show(Order $order)
    {
        $order->load('user', 'orderItems.product');
        return view('admin.orders.show', compact('order'));
    }

    // Update order status
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully!');
    }

    // Quick update order status
    public function quickUpdateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated!');
    }

    // Refund order
    public function refund(Request $request, Order $order)
    {
        if ($order->status !== 'completed') {
            return redirect()->back()->with('error', 'Only completed orders can be refunded.');
        }

        $order->status = 'refunded';
        $order->payment_status = 'refunded';
        $order->save();

        foreach ($order->orderItems as $item) {
            $product = $item->product;
            $product->stock += $item->quantity;
            $product->save();
        }

        return redirect()->back()->with('success', 'Order refunded successfully.');
    }

    // Optional: Place order (depends on your cart logic)
    public function placeOrder(Request $request)
    {
        // Implement your order placing logic here
    }
}