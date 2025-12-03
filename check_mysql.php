<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    $dbName = DB::select('SELECT DATABASE() AS db');
    $dbName = $dbName[0]->db ?? '(none)';
    echo "Connected to MySQL database: {$dbName}\n\n";

    echo "Listing first 25 tables...\n";
    $tables = DB::select('SHOW TABLES');
    $count = 0;
    foreach ($tables as $row) {
        $table = array_values((array)$row)[0] ?? '';
        echo "- {$table}\n";
        $count++;
        if ($count >= 25) break;
    }
    if ($count === 0) {
        echo "(No tables found in this database)\n";
    }
} catch (Throwable $e) {
    echo "MySQL check failed: " . $e->getMessage() . "\n";
    echo $e->getFile() . ':' . $e->getLine() . "\n";
}
