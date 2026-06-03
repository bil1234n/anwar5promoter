<?php
// Force Vercel/PHP to display all errors on the screen
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$publicIndex = __DIR__ . '/../public/index.php';

// Check if Vercel accidentally deleted the files
if (!file_exists($publicIndex)) {
    die("<h1>Fatal Error: public/index.php is missing!</h1>");
}

try {
    // Forward to Laravel's normal entry point
    require $publicIndex;
} catch (\Throwable $e) {
    // If Laravel crashes, print exactly why it crashed!
    echo "<h1>Laravel crashed!</h1>";
    echo "<b>Error Message:</b> " . $e->getMessage() . "<br><br>";
    echo "<b>File:</b> " . $e->getFile() . " on line " . $e->getLine() . "<br><br>";
    echo "<b>Stack Trace:</b><br>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}
