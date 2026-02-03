<?php
require_once __DIR__ . '/auth.php';

function render_header(string $title, string $body_class = ''): void {
    global $pdo;
    if ($pdo && current_user()) {
        refresh_user($pdo);
    }
    $user = current_user();
    $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $path = rtrim($path, '/');
    if ($path === '') {
        $path = '/';
    }
    $is_active = function (string $target) use ($path): bool {
        $target = rtrim($target, '/');
        if ($target === '') {
            $target = '/';
        }
        return $path === $target;
    };
    
    // Cek apakah ini halaman login
    $is_login_page = strpos($path, '/login') !== false || strpos($path, '/auth') !== false;
    $is_auth = strpos(' ' . $body_class . ' ', ' auth ') !== false;

    $body_classes = [];
    if ($body_class !== '') {
        $body_classes[] = $body_class;
    }
    if ($user || (!$is_auth && !$is_login_page)) {
        $body_classes[] = 'has-tabbar';
    }
    $body_class_attr = $body_classes ? ' class="' . htmlspecialchars(implode(' ', $body_classes)) . '"' : '';
    $body_data_attr = '';
    if ($user && $user['role'] === 'admin' && admin_plan_blocked($user)) {
        $plan_message = admin_plan_message($user) ?? 'Akses terkunci karena masa trial/pembayaran habis.';
        $body_data_attr = ' data-plan-blocked="1" data-plan-message="' . htmlspecialchars($plan_message) . '"';
    }
    $main_class = 'container' . ($body_class !== '' ? ' container-' . $body_class : '');
    
    echo '<!doctype html><html lang="id"><head><meta charset="utf-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
    echo '<title>' . htmlspecialchars($title) . '</title>';
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
    echo '<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700&family=Space+Grotesk:wght@400;500;600&display=swap" rel="stylesheet">';
    echo '<link rel="stylesheet" href="/assets/style.css">';
    echo '</head><body' . $body_class_attr . $body_data_attr . '>'; 
    echo '<div class="bg-orb orb-a"></div><div class="bg-orb orb-b"></div>';
    echo '<header class="topbar">';
    
    // Hanya tampilkan brand jika bukan halaman login
    if (!$is_login_page && !$is_auth) {
        echo '<a class="brand" href="/"><span class="brand-mark" aria-hidden="true">';
        echo '<img src="/assets/Ogol.png" alt="" width="34" height="34">';
        echo '</span><span class="brand-text">RuangMeet</span></a>';
    } else {
        // Untuk halaman login, kita beri brand kosong dengan tinggi yang sama
        echo '<div class="brand-placeholder"></div>';
    }
    
    if (!$is_auth && !$is_login_page) {
        if ($user) {
            echo '<nav class="nav nav-desktop">';

            echo '<a href="/"'
                . ($is_active('/') ? ' class="active"' : '')
                . '>Home</a>';

            $dashPath = '/dashboard_' . ($user['role'] === 'admin' ? 'admin' : 'user');

            echo '<a href="' . $dashPath . '"'
                . ($is_active($dashPath) ? ' class="active"' : '')
                . '>Dashboard</a>';
            if ($user['role'] === 'admin') {
                echo '<a href="/users">Add User</a>';
                echo '<a href="/rooms">Add Room</a>';
                echo '<a href="/bookings">Scheduling</a>';
            } else {
                echo '<a href="/booking_user"' . ($is_active('/booking_user') ? ' class="active"' : '') . '>Booking</a>';
                echo '<a href="/user/schedules"' . ($is_active('/user/schedules') ? ' class="active"' : '') . '>Schedule</a>';
            }

            echo '<a href="/logout" class="ghost">Logout</a>';
            echo '</nav>';
        }
    }
    echo '</header>';

    if (!$is_auth && !$is_login_page) {
        echo '<div class="mobile-brand">';
        echo '<a class="brand-pill" href="/"><img src="/assets/Ogol.png" alt="" width="26" height="26"><span>RuangMeet</span></a>';
        echo '</div>';
    }

    if ($user) {
        if ($user['role'] === 'superadmin') {
            $dash_path = '/dashboard_superadmin';
        } elseif ($user['role'] === 'admin') {
            $dash_path = '/dashboard_admin';
        } else {
            $dash_path = '/dashboard_user';
        }
        $icon_home = '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 10.5 12 4l8 6.5V20a1 1 0 0 1-1 1h-5v-6H10v6H5a1 1 0 0 1-1-1z" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>';
        $icon_dash = '<svg viewBox="0 0 24 24" aria-hidden="true"><rect x="4" y="4" width="7" height="7" rx="1.5" fill="none" stroke="currentColor" stroke-width="1.6"/><rect x="13" y="4" width="7" height="7" rx="1.5" fill="none" stroke="currentColor" stroke-width="1.6"/><rect x="4" y="13" width="7" height="7" rx="1.5" fill="none" stroke="currentColor" stroke-width="1.6"/><rect x="13" y="13" width="7" height="7" rx="1.5" fill="none" stroke="currentColor" stroke-width="1.6"/></svg>';
        $icon_users = '<svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="8" cy="9" r="3" fill="none" stroke="currentColor" stroke-width="1.6"/><circle cx="16" cy="8" r="2.5" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M3.5 19a5 5 0 0 1 9 0" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><path d="M13.5 19a4 4 0 0 1 7 0" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>';
        $icon_room = '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 20V6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v14" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="M7 20v-6h10v6" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><circle cx="15.5" cy="11" r="0.8" fill="currentColor"/></svg>';
        $icon_book = '<svg viewBox="0 0 24 24" aria-hidden="true"><rect x="4" y="6" width="16" height="12" rx="2" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M8 4v4M16 4v4M4 10h16" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>';
        $icon_schedule = '<svg viewBox="0 0 24 24" aria-hidden="true">
        <rect x="3" y="4" width="18" height="17" rx="2" fill="none" stroke="currentColor" stroke-width="1.6"/>
        <path d="M8 2v4M16 2v4M3 9h18" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
        <path d="M7 13h4M7 17h8" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
        </svg>';
        $icon_article = '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6 4h9a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M8 8h7M8 12h7M8 16h5" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>';
        $icon_logout = '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M15 7v-2a1 1 0 0 0-1-1H6a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-2" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M10 12h9M16 8l3.5 4L16 16" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>';

        echo '<nav class="tabbar" aria-label="Primary">';
        echo '<span class="tab-indicator" aria-hidden="true"></span>';
        echo '<a class="tab brand-tab" href="/"><span class="brand-pill"><img src="/assets/Ogol.png" alt="" width="26" height="26"><span>RuangMeet</span></span></a>';
        echo '<a class="tab' . ($is_active('/') ? ' active' : '') . '" data-indicator="1" href="/">' . $icon_home . '<span>Home</span></a>';
        echo '<a class="tab' . ($is_active($dash_path) ? ' active' : '') . '" href="' . $dash_path . '">' . $icon_dash . '<span>Dashboard</span></a>';
        
        if ($user['role'] === 'superadmin') {

            echo '<a class="tab' . ($is_active('/super/admins') ? ' active' : '') . '" href="/super/admins">'
                . $icon_users . '<span>Admins</span></a>';

            echo '<a class="tab' . ($is_active('/super/users') ? ' active' : '') . '" href="/super/users">'
                . $icon_users . '<span>Users</span></a>';

            echo '<a class="tab' . ($is_active('/super/bookings') ? ' active' : '') . '" href="/super/bookings">'
                . $icon_book . '<span>Bookings</span></a>';
            echo '<a class="tab' . ($is_active('/super/articles') ? ' active' : '') . '" href="/super/articles">'
                . $icon_article . '<span>Articles</span></a>';

        } else if ($user['role'] === 'admin') {
            echo '<a class="tab' . ($is_active('/users') ? ' active' : '') . '" href="/users">' . $icon_users . '<span>Users</span></a>';
            echo '<a class="tab' . ($is_active('/rooms') ? ' active' : '') . '" href="/rooms">' . $icon_room . '<span>Rooms</span></a>';
            echo '<a class="tab' . ($is_active('/bookings') ? ' active' : '') . '" href="/bookings">' . $icon_book . '<span>Schedule</span></a>';
            echo '<a class="tab' . ($is_active('/articles') ? ' active' : '') . '" href="/articles">' . $icon_article . '<span>Articles</span></a>';
        } else {
            echo '<a class="tab' . ($is_active('/booking_user') ? ' active' : '') . '" href="/booking_user">'
                . $icon_book . '<span>Booking</span></a>';

            echo '<a class="tab' . ($is_active('/user/schedules') ? ' active' : '') . '" href="/user/schedules">'
                . $icon_schedule . '<span>Schedule</span></a>';
            echo '<a class="tab' . ($is_active('/articles') ? ' active' : '') . '" href="/articles">' . $icon_article . '<span>Articles</span></a>';
        }

        echo '<a class="tab" href="/logout">' . $icon_logout . '<span>Logout</span></a>';
        echo '</nav>';
    } elseif (!$is_auth && !$is_login_page) {
        $icon_home = '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 10.5 12 4l8 6.5V20a1 1 0 0 1-1 1h-5v-6H10v6H5a1 1 0 0 1-1-1z" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>';
        $icon_article = '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6 4h9a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M8 8h7M8 12h7M8 16h5" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>';
        echo '<nav class="tabbar" aria-label="Primary">';
        echo '<a class="tab brand-tab" href="/"><span class="brand-pill"><img src="/assets/Ogol.png" alt="" width="26" height="26"><span>RuangMeet</span></span></a>';
        echo '<a class="tab tab-primary' . ($is_active('/') ? ' active' : '') . '" data-indicator="1" href="/">' . $icon_home . '<span>Home</span></a>';
        echo '<a class="tab' . ($is_active('/articles') ? ' active' : '') . '" href="/articles">' . $icon_article . '<span>Articles</span></a>';
        echo '</nav>';
    }

    echo '<main class="' . $main_class . '">';
}

function render_footer(): void {
    $user = current_user();
    if ($user && $user['role'] === 'admin' && admin_plan_blocked($user)) {
        $plan_message = admin_plan_message($user) ?? 'Akses terkunci karena masa trial/pembayaran habis.';
        echo '<div class="modal" data-plan-blocked-modal>';
        echo '<div class="modal-content">';
        echo '<div class="modal-head"><div>';
        echo '<p class="admin-kicker">Langganan</p>';
        echo '<h2>Akses Terkunci</h2>';
        echo '</div>';
        echo '<button class="modal-close" type="button" data-close-plan-blocked>&times;</button>';
        echo '</div>';
        echo '<p class="muted" style="margin-top:10px;">' . htmlspecialchars($plan_message) . '</p>';
        echo '<p class="muted">Silakan lakukan pembayaran untuk membuka semua fitur.</p>';
        echo '<div class="modal-actions">';
        echo '<button class="secondary" type="button" data-close-plan-blocked>Tutup</button>';
        echo '</div>';
        echo '</div></div>';
    }

    echo '</main><script src="/assets/app.js"></script></body></html>';
}
