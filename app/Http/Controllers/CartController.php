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
            // Increase quantity
            $cartItem->quantity += $request->quantity ?? 1;
            $cartItem->save();
        } else {
            // Create new cart row
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

        // Calculate total
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('cart.checkout', compact('cartItems', 'total'));
    }

    /**
     * Checkout Processing (Place Order)
     */
    public function processCheckout(Request $request)
    {
        $userId = Auth::id();
        $paymentMethod = $request->payment_method;

        $cartItems = Cart::with('product')->where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        // Calculate total
        $totalAmount = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        // Create main order
        $order = Order::create([
            'user_id'        => $userId,
            'total_amount'   => $totalAmount,
            'payment_method' => $paymentMethod,
            'status'         => 'pending',
        ]);

        // Add order items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $item->product->price,
            ]);
        }

        // Clear cart
        Cart::where('user_id', $userId)->delete();

        // Redirect to user order details
        return redirect()->route('orders.show', $order->id)
                         ->with('success', 'Order placed successfully.');
    }
}
