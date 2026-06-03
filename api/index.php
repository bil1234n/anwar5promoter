<?php
// Force Vercel to display errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// THE NUCLEAR OPTION: Force Vercel to delete the broken cache files!
$cacheFiles = [
    __DIR__ . '/../bootstrap/cache/config.php',
    __DIR__ . '/../bootstrap/cache/events.php',
    __DIR__ . '/../bootstrap/cache/packages.php',
    __DIR__ . '/../bootstrap/cache/routes.php',
    __DIR__ . '/../bootstrap/cache/services.php',
];

foreach ($cacheFiles as $file) {
    if (file_exists($file)) {
        @unlink($file); // Delete the broken file before Laravel boots
    }
}

// Now boot Laravel normally
$publicIndex = __DIR__ . '/../public/index.php';

if (!file_exists($publicIndex)) {
    die("<h1>Fatal Error: public/index.php is missing!</h1>");
}

try {
    require $publicIndex;
} catch (\Throwable $e) {
    echo "<h1>Laravel crashed!</h1>";
    echo "<b>Error Message:</b> " . $e->getMessage() . "<br><br>";
    echo "<b>File:</b> " . $e->getFile() . " on line " . $e->getLine() . "<br><br>";
    echo "<b>Stack Trace:</b><br>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}
