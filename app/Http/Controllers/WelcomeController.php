<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;

class WelcomeController extends Controller
{
    public function index()
    {
        // Latest 8 products
        $latestProducts = Product::orderBy('created_at', 'desc')->limit(8)->get();

        // Total users
        $totalUsers = User::count();

        // Total orders
        $totalOrders = Order::count();

        // Total sales amount (fixed: use total_amount)
        $totalSalesAmount = Order::sum('total_amount');

        return view('welcome', compact(
            'latestProducts',
            'totalUsers',
            'totalOrders',
            'totalSalesAmount'
        ));
    }

    public function submitContact(Request $request)
    {
        // Handle contact form submission here...
    }

    public function addToCart(Product $product)
    {
        // Handle add to cart...
    }

    public function toggleWishlist(Product $product)
    {
        // Handle wishlist toggle...
    }
}
