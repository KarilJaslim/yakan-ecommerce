<?php
// Delete the specific problematic view file
$viewFile = __DIR__ . '/storage/framework/views/b79a2cf5edc7cf49ae35927299fe20f8.php';
if (file_exists($viewFile)) {
    unlink($viewFile);
    echo "Deleted problematic view file: b79a2cf5edc7cf49ae35927299fe20f8.php\n";
} else {
    echo "View file not found.\n";
}

// Also clear all view files
$viewsDir = __DIR__ . '/storage/framework/views';
if (is_dir($viewsDir)) {
    $files = glob($viewsDir . '/*.php');
    $deleted = 0;
    foreach ($files as $file) {
        if (basename($file) !== '.gitignore') {
            unlink($file);
            $deleted++;
        }
    }
    echo "Deleted $deleted compiled view files.\n";
}
echo "Done.\n";
?>
