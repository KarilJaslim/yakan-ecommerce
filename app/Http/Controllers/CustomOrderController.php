<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomOrder;

/**
 * Controller for managing user custom orders
 */
class CustomOrderController extends Controller
{
    /**
     * Show all custom orders for the logged-in user
     *
     * @return \Illuminate\View\View
     */
    public function userIndex()
    {
        $orders = CustomOrder::where('user_id', auth()->id())
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('custom_orders.index', compact('orders'));
    }

    /**
     * Show the form to create a new custom order
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('custom_orders.create');
    }

    /**
     * Store a new custom order
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'specifications' => 'nullable|string',
            'design_upload' => 'nullable|file|mimes:jpg,png,pdf',
            'quantity' => 'required|integer|min:1',
        ]);

        $order = new CustomOrder([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'specifications' => $request->specifications,
            'quantity' => $request->quantity,
            'status' => 'pending',
            'payment_status' => 'unpaid',
        ]);

        if ($request->hasFile('design_upload')) {
            $order->design_upload = $request->file('design_upload')->store('designs', 'public');
        }

        $order->save();

        return redirect()->route('custom_orders.index')->with('success', 'Custom order submitted!');
    }

    /**
     * Show a single custom order for the logged-in user
     *
     * Uses route model binding
     *
     * @param \App\Models\CustomOrder $order
     * @return \Illuminate\View\View
     */
    public function show(CustomOrder $order)
    {
        // Ensure the user owns this order
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        return view('custom_orders.show', compact('order'));
    }
}
