<?php

require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $product = \App\Models\Product::first();
    
    if ($product) {
        echo "Product ID: " . $product->id . "\n";
        echo "Product Name: " . $product->name . "\n";
        echo "Product Status: '" . $product->status . "'\n";
        echo "Product Price: " . $product->price . "\n";
        echo "Is Active: " . ($product->status === 'active' ? 'YES' : 'NO') . "\n";
        
        // Test the active scope
        $activeProducts = \App\Models\Product::active()->get();
        echo "Active products count: " . $activeProducts->count() . "\n";
        
        // Test all products
        $allProducts = \App\Models\Product::all();
        echo "All products count: " . $allProducts->count() . "\n";
        
    } else {
        echo "No products found in database.\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
