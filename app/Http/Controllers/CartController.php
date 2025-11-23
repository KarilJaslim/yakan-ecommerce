<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Add product to cart
     */
    public function add(Request $request, Product $product)
    {
        $userId = Auth::id();

        // Check if item already in cart
        $cartItem = Cart::where('user_id', $userId)
                        ->where('product_id', $product->id)
                        ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity ?? 1;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id'    => $userId,
                'product_id' => $product->id,
                'quantity'   => $request->quantity ?? 1,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    /**
     * Show the cart
     */
    public function index()
    {
        $cartItems = Cart::with('product')
                        ->where('user_id', Auth::id())
                        ->get();

        return view('cart.index', compact('cartItems'));
    }

    /**
     * Remove item from cart
     */
    public function remove($id)
    {
        $cartItem = Cart::where('id', $id)
                        ->where('user_id', Auth::id())
                        ->first();

        if ($cartItem) {
            $cartItem->delete();
        }

        return redirect()->back()->with('success', 'Item removed from cart');
    }

    /**
     * Update cart quantity
     */
    public function update(Request $request, $id)
    {
        $cartItem = Cart::where('id', $id)
                        ->where('user_id', Auth::id())
                        ->first();

        if ($cartItem) {
            $cartItem->quantity = $request->quantity;
            $cartItem->save();
        }

        return redirect()->back()->with('success', 'Cart updated');
    }

    /**
     * Show checkout page (Mode of Payment)
     */
    public function checkout()
    {
        $cartItems = Cart::with('product')
                        ->where('user_id', Auth::id())
                        ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        return view('cart.checkout', compact('cartItems', 'total'));
    }

    /**
     * Checkout Processing (Place Order)
     */
    public function processCheckout(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:online,bank_transfer'
        ]);

        $userId = Auth::id();
        $cartItems = Cart::with('product')->where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        $totalAmount = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        // Create main order (tracking number & history auto-handled in Order model)
        $order = Order::create([
            'user_id'        => $userId,
            'total_amount'   => $totalAmount,
            'payment_method' => $request->payment_method,
            'status'         => 'pending',
            'payment_status' => 'pending',
        ]);

        // Add order items
        foreach ($cartItems as $item) {
            $order->orderItems()->create([
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $item->product->price,
            ]);
        }

        // Clear cart
        Cart::where('user_id', $userId)->delete();

        // Redirect based on payment method
        if ($request->payment_method === 'online') {
            return redirect()->route('payment.online', $order->id)
                             ->with('success', 'Order placed! Complete payment online.');
        }

        return redirect()->route('payment.bank', $order->id)
                         ->with('success', 'Order placed! Complete bank payment.');
    }

    /**
     * Show Online Payment Page
     */
    public function showOnlinePayment($orderId)
    {
        $order = Order::with('orderItems.product', 'user')->findOrFail($orderId);

        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this order.');
        }

        return view('cart.payment-online', compact('order'));
    }

    /**
     * Show Bank Transfer Payment Page
     */
    public function showBankPayment($orderId)
    {
        $order = Order::with('orderItems.product', 'user')->findOrFail($orderId);

        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this order.');
        }

        return view('cart.payment-bank', compact('order'));
    }

    /**
     * Submit Bank Payment (Upload Receipt)
     */
    public function submitBankPayment(Request $request, $orderId)
    {
        $request->validate([
            'receipt' => 'required|image|max:5000', // 5MB max
        ]);

        $order = Order::findOrFail($orderId);

        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized payment submission.');
        }

        // Upload image
        $path = $request->file('receipt')->store('bank_receipts', 'public');

        $order->payment_status = 'pending_verification';
        $order->bank_receipt = $path;
        $order->save();

        return redirect()->route('orders.show', $orderId)
                         ->with('success', 'Bank payment submitted! Please wait for verification.');
    }
}
