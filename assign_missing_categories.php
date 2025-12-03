<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

$defaultCategory = Category::where('slug', 'apparel')->first();
if (!$defaultCategory) {
    echo "No default category (apparel) found. Aborting.\n";
    exit(1);
}

$missing = Product::whereNull('category_id')->get();
if ($missing->isEmpty()) {
    echo "No products with missing categories found.\n";
    exit(0);
}

echo "Assigning category '{$defaultCategory->name}' (ID: {$defaultCategory->id}) to " . $missing->count() . " products...\n";

foreach ($missing as $p) {
    $p->category_id = $defaultCategory->id;
    $p->save();
    echo "Updated Product ID {$p->id} ({$p->name}) -> category_id={$defaultCategory->id}\n";
}

echo "Done.\n";
