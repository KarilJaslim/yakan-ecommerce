<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Show all active products to users
    public function shopIndex()
    {
        $products = Product::where('is_active', true)->paginate(12);
        return view('shop.index', compact('products'));
    }

    // Show single product details
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
