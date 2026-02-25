<?php
// Router for PHP built-in server.
// Usage: php -S localhost:8000 -t public public/index.php
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = urldecode($path);

// Serve existing files (assets, images, etc.).
$file = __DIR__ . $path;
if ($path !== '/' && is_file($file)) {
    return false;
}

// Serve files from /public when running with project root as docroot.
$publicFile = __DIR__ . '/public' . $path;
if ($path !== '/' && is_file($publicFile)) {
    $mime = mime_content_type($publicFile) ?: 'application/octet-stream';
    header('Content-Type: ' . $mime);
    readfile($publicFile);
    exit;
}

require_once __DIR__ . '/app/helpers/db.php';
require_once __DIR__ . '/app/helpers/auth.php';
require_once __DIR__ . '/app/helpers/layout.php';
require_once __DIR__ . '/app/helpers/view.php';
require_once __DIR__ . '/app/helpers/plan.php';
require_once __DIR__ . '/app/models/User.php';
require_once __DIR__ . '/app/models/Room.php';
require_once __DIR__ . '/app/models/Booking.php';
require_once __DIR__ . '/app/controllers/HomeController.php';
require_once __DIR__ . '/app/controllers/AuthController.php';
require_once __DIR__ . '/app/controllers/AdminController.php';
require_once __DIR__ . '/app/controllers/UserController.php';
require_once __DIR__ . '/app/controllers/SuperAdminController.php';

if (current_user()) {
    refresh_user($pdo);
}

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = rtrim($path, '/');
if ($path === '') {
    $path = '/';
}

$routes = [
    '/' => ['HomeController', 'index'],
    '/login' => ['AuthController', 'login'],
    '/register' => ['AuthController', 'register'],
    '/register/pay' => ['AuthController', 'registerPay'],
    '/logout' => ['AuthController', 'logout'],
    '/dashboard_admin' => ['AdminController', 'dashboard'],
    '/billing/checkout' => ['AdminController', 'billingCheckout'],
    '/billing/pay' => ['AdminController', 'billingPay'],
    '/dashboard_user' => ['UserController', 'dashboard'],
    '/users' => ['AdminController', 'users'],
    '/rooms' => ['AdminController', 'rooms'],
    '/bookings' => ['AdminController', 'bookings'],
    '/booking_user' => ['UserController', 'booking'],
    '/dashboard_superadmin' => ['SuperAdminController', 'dashboard'],
    '/super/admins'        => ['SuperAdminController', 'admins'],
    '/super/admin-detail' => ['SuperAdminController', 'adminDetail'],
    '/super/users'         => ['SuperAdminController', 'users'],
    '/super/user-detail' => ['SuperAdminController', 'userDetail'],
    '/super/bookings'      => ['SuperAdminController', 'bookings'],
];

if (!isset($routes[$path])) {
    http_response_code(404);
    render_view('shared/404', [], 'Not Found');
    exit;
}   

[$controller, $method] = $routes[$path];
$controller::$method();
