<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomOrder;

class CustomOrderController extends Controller
{
    /**
     * List all custom orders (admin)
     */
    public function index(Request $request)
    {
        $query = CustomOrder::with('user');

        // Optional filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->orderByDesc('created_at')->paginate(10);

        return view('admin.custom_orders.index', compact('orders'));
    }

    /**
     * Show a single custom order
     */
    public function show(CustomOrder $order)
    {
        $order->load('user');
        return view('admin.custom_orders.show', compact('order'));
    }

    /**
     * Update status of a custom order
     */
    public function updateStatus(Request $request, CustomOrder $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Custom order status updated!');
    }
}
