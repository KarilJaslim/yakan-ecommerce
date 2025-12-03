<?php
// Simple script to clear Laravel cache
require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Clear view cache
$views = __DIR__ . '/storage/framework/views';
if (is_dir($views)) {
    $files = glob($views . '/*.php');
    foreach ($files as $file) {
        if (basename($file) !== '.gitignore') {
            unlink($file);
            echo "Deleted: " . basename($file) . "\n";
        }
    }
    echo "View cache cleared successfully!\n";
} else {
    echo "Views directory not found.\n";
}

// Clear application cache
\Illuminate\Support\Facades\Artisan::call('cache:clear');
echo "Application cache cleared!\n";

\Illuminate\Support\Facades\Artisan::call('config:clear');
echo "Configuration cache cleared!\n";

\Illuminate\Support\Facades\Artisan::call('route:clear');
echo "Route cache cleared!\n";

echo "All caches cleared!\n";
?>
