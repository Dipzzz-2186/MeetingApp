<?php
require_once __DIR__ . '/../app/helpers/db.php';
require_once __DIR__ . '/../app/helpers/auth.php';
require_once __DIR__ . '/../app/helpers/layout.php';
require_once __DIR__ . '/../app/helpers/view.php';
require_once __DIR__ . '/../app/models/User.php';
require_once __DIR__ . '/../app/models/Room.php';
require_once __DIR__ . '/../app/models/Booking.php';
require_once __DIR__ . '/../app/controllers/HomeController.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/AdminController.php';
require_once __DIR__ . '/../app/controllers/UserController.php';
require_once __DIR__ . '/../app/controllers/SuperAdminController.php';

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = rtrim($path, '/');
if ($path === '') {
    $path = '/';
}

$routes = [
    '/' => ['HomeController', 'index'],
    '/login' => ['AuthController', 'login'],
    '/register' => ['AuthController', 'register'],
    '/logout' => ['AuthController', 'logout'],
    '/dashboard_admin' => ['AdminController', 'dashboard'],
    '/dashboard_user' => ['UserController', 'dashboard'],
    '/users' => ['AdminController', 'users'],
    '/rooms' => ['AdminController', 'rooms'],
    '/bookings' => ['AdminController', 'bookings'],
    '/booking_user' => ['UserController', 'booking'],
    '/user/schedules' => ['UserController', 'schedules'],
    '/dashboard_superadmin' => ['SuperAdminController', 'dashboard'],
    '/super/admins'        => ['SuperAdminController', 'admins'],
    '/super/users'         => ['SuperAdminController', 'users'],
    '/super/bookings'      => ['SuperAdminController', 'bookings'],
];

if (!isset($routes[$path])) {
    http_response_code(404);
    render_view('shared/404', [], 'Not Found');
    exit;
}   

[$controller, $method] = $routes[$path];
$controller::$method();
