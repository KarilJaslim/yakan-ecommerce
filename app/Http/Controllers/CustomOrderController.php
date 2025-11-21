<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomOrder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CustomOrderController extends Controller
{
    /**
     * List custom orders for the logged-in user
     */
    public function userIndex()
    {
        $orders = CustomOrder::with('product')
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('custom_orders.index', compact('orders'));
    }

    /**
     * Show form to create a new custom order
     */
    public function create()
    {
        $categories = Category::with('products')->get(); // get categories with products
        return view('custom_orders.create', compact('categories'));
    }

    /**
     * Store a new custom order
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'specifications' => 'nullable|string|max:1000',
            'design_upload' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'quantity' => 'required|integer|min:1',
        ]);

        $order = new CustomOrder();
        $order->user_id = Auth::id();
        $order->product_id = $request->product_id;
        $order->specifications = $request->specifications;
        $order->quantity = $request->quantity;
        $order->status = 'pending';
        $order->payment_status = 'unpaid';

        if ($request->hasFile('design_upload')) {
            $order->design_upload = $request->file('design_upload')->store('custom_designs', 'public');
        }

        $order->save();

        return redirect()->route('custom_orders.index')->with('success', 'Custom order created successfully!');
    }

    /**
     * Show a single custom order
     */
    public function show(CustomOrder $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $order->load('product');
        return view('custom_orders.show', compact('order'));
    }
}
