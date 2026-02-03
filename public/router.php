<?php
// Router for PHP built-in server.
// Usage: php -S localhost:8000 -t public public/router.php

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = urldecode($path);

// Serve existing files (assets, images, etc.).
$file = __DIR__ . $path;
if ($path !== '/' && is_file($file)) {
    return false;
}

// Route everything else through the front controller.
require __DIR__ . '/index.php';
