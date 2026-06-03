<?php

/**
 * Vercel Serverless Bootstrap File
 */

// Force Laravel to generate secure HTTPS links for all CSS and Images
$_SERVER['HTTPS'] = 'on';

// 1. Force all caches and compiled views into the /tmp directory
$tmpPaths = [
    'APP_CONFIG_CACHE'   => '/tmp/config.php',
    'APP_EVENTS_CACHE'   => '/tmp/events.php',
    'APP_PACKAGES_CACHE' => '/tmp/packages.php',
    'APP_ROUTES_CACHE'   => '/tmp/routes.php',
    'APP_SERVICES_CACHE' => '/tmp/services.php',
    'VIEW_COMPILED_PATH' => '/tmp/views',
];

foreach ($tmpPaths as $key => $value) {
    $_ENV[$key] = $value;
    $_SERVER[$key] = $value;
    putenv("{$key}={$value}");
}

// 2. Build the required internal folder structure on the fly
$directories = [
    '/tmp/views',
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs',
];

foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
}

// 3. Require the Composer Autoloader
require __DIR__ . '/../vendor/autoload.php';

// 4. Initialize Laravel and force it to use the new /tmp storage
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->useStoragePath('/tmp/storage');

// 5. Handle the incoming Request
if (method_exists($app, 'handleRequest')) {
    $app->handleRequest(Illuminate\Http\Request::capture());
} else {
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    $response = $kernel->handle(
        $request = Illuminate\Http\Request::capture()
    );
    $response->send();
    $kernel->terminate($request, $response);
}
