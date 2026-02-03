<?php
// Router for PHP built-in server to support extension-less routes.
// Usage: php -S localhost:8000 -t public router.php

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = urldecode($path);

// Serve existing files (assets, images, etc.)
$file = __DIR__ . $path;
if ($path !== '/' && is_file($file)) {
    return false;
}

// Map extension-less paths to .php files.
if ($path !== '/' && is_file(__DIR__ . $path . '.php')) {
    require __DIR__ . $path . '.php';
    return true;
}

// Default route.
require __DIR__ . '/index.php';
