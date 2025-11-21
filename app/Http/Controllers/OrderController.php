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
        $orders = Order::with('items.product', 'user')->get();
        return view('admin.orders.index', compact('orders')); // Pass orders to Blade
    }

    /**
     * Update order status (Admin)
     */
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Validate input
        $request->validate([
            'status' => 'required|in:pending,completed,cancelled',
            'payment_status' => 'nullable|in:pending,completed,failed'
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

        return response()->json(['message' => 'Order placed successfully', 'order_id' => $order->id]);
    }

    /**
     * Show a specific order (Admin/User)
     */
    public function show($id)
    {
        $order = Order::with('items.product', 'user')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }
}
