<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;

class OrderController extends Controller
{
    /**
     * Show all orders (Admin)
     */
    public function index()
    {
        // Eager load related order items and user
        $orders = Order::with('orderItems.product', 'user')->get();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Update order status (Admin)
     */
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Validate input
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
            'payment_status' => 'nullable|in:pending,paid,refunded,failed'
        ]);

        $order->status = $request->status;

        if ($request->filled('payment_status')) {
            $order->payment_status = $request->payment_status;
        }

        $order->save();

        return response()->json(['message' => 'Order updated successfully']);
    }

    /**
     * Place order (User)
     */
    public function placeOrder(Request $request)
    {
        $user = auth()->user() ?? User::first();

        if (!$user) {
            return response()->json(['error' => 'No user found'], 400);
        }

        // Validate required fields
        $request->validate([
            'total_amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|exists:products,id',
            'items.*.qty' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        // Create the order
        $order = Order::create([
            'user_id' => $user->id,
            'total_amount' => $request->total_amount,
            'payment_method' => $request->payment_method,
            'payment_status' => 'pending',
            'status' => 'pending',
            'shipping_address' => $request->shipping_address ?? null,
        ]);

        // Add order items
        foreach ($request->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['qty'],
                'price' => $item['price'],
            ]);
        }

        return response()->json([
            'message' => 'Order placed successfully',
            'order_id' => $order->id
        ]);
    }

    /**
     * Show a specific order (User view)
     */
    public function show($id)
    {
        $order = Order::with('orderItems.product', 'user')->findOrFail($id);

        // Ensure the order belongs to the authenticated user unless admin
        if (auth()->user()->role !== 'admin' && $order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access to this order.');
        }

        return view('orders.show', compact('order'));
    }
}
