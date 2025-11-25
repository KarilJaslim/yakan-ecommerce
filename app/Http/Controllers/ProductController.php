<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of all active products for the shop.
     *
     * @return \Illuminate\View\View
     */
    public function shopIndex()
    {
        // Fetch all products that are active, 12 per page
        $products = Product::where('is_active', true)->paginate(12);

        // Return the shop view with the products
        return view('shop.index', compact('products'));
    }

    /**
     * Display the details of a single product.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\View\View
     */
    public function show(Product $product)
    {
        // Return the product details view
        return view('products.show', compact('product'));
    }
}
