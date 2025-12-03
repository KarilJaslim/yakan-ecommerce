<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Products in database:\n";
echo "Count: " . App\Models\Product::count() . "\n\n";

$products = App\Models\Product::take(5)->get();
foreach ($products as $product) {
    echo "ID: {$product->id}\n";
    echo "Name: {$product->name}\n";
    echo "Price: {$product->price}\n";
    echo "Status: {$product->status}\n";
    echo "Category ID: {$product->category_id}\n";
    echo "Description: " . substr($product->description ?? 'None', 0, 50) . "...\n";
    echo "---\n";
}
?>
