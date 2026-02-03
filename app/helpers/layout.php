<?php
require_once __DIR__ . '/auth.php';

function render_header(string $title, string $body_class = ''): void {
    $user = current_user();
    $body_class_attr = $body_class !== '' ? ' class="' . htmlspecialchars($body_class) . '"' : '';
    $main_class = 'container' . ($body_class !== '' ? ' container-' . $body_class : '');
    echo '<!doctype html><html lang="id"><head><meta charset="utf-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
    echo '<title>' . htmlspecialchars($title) . '</title>';
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
    echo '<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700&family=Space+Grotesk:wght@400;500;600&display=swap" rel="stylesheet">';
    echo '<link rel="stylesheet" href="assets/style.css">';
    echo '</head><body' . $body_class_attr . '>'; 
    echo '<div class="bg-orb orb-a"></div><div class="bg-orb orb-b"></div>';
    echo '<header class="topbar">';
    echo '<div class="brand">MeetFlow</div>';
    if ($user) {
        echo '<nav class="nav">';
        echo '<a href="index">Home</a>';
        echo '<a href="dashboard_' . ($user['role'] === 'admin' ? 'admin' : 'user') . '">Dashboard</a>';
        if ($user['role'] === 'admin') {
            echo '<a href="users">Add User</a>';
            echo '<a href="rooms">Add Room</a>';
            echo '<a href="bookings">Scheduling</a>';
        } else {
            echo '<a href="booking_user">Booking</a>';
        }
        echo '<a href="logout" class="ghost">Logout</a>';
        echo '</nav>';
    } else {
        echo '<nav class="nav">';
        echo '<a href="index">Home</a>';
        echo '</nav>';
    }
    echo '</header><main class="' . $main_class . '">';
}

function render_footer(): void {
    echo '</main><script src="assets/app.js"></script></body></html>';
}
