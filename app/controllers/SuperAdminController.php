<?php

class SuperAdminController
{
    public static function dashboard(): void {
        require_superadmin();
        global $pdo;

        $stats = [
            'admins'   => $pdo->query("SELECT COUNT(*) FROM users WHERE role='admin'")->fetchColumn(),
            'users'    => $pdo->query("SELECT COUNT(*) FROM users WHERE role='user'")->fetchColumn(),
            'rooms'    => $pdo->query("SELECT COUNT(*) FROM rooms")->fetchColumn(),
            'bookings' => $pdo->query("SELECT COUNT(*) FROM bookings")->fetchColumn(),
        ];

        render_view('super/dashboard', compact('stats'), 'Super Admin Dashboard');
    }

    public static function admins(): void {
        require_superadmin();
        global $pdo;

        $admins = $pdo->query("
            SELECT a.*, COUNT(u.id) total_users
            FROM users a
            LEFT JOIN users u ON u.owner_admin_id = a.id
            WHERE a.role='admin'
            GROUP BY a.id
        ")->fetchAll();

        render_view('super/admins', compact('admins'), 'List Admin');
    }

    public static function users(): void {
        require_superadmin();
        global $pdo;

        $users = $pdo->query("
            SELECT u.*, a.name AS admin_name
            FROM users u
            LEFT JOIN users a ON a.id = u.owner_admin_id
            WHERE u.role='user'
            ORDER BY a.name, u.name
        ")->fetchAll();

        render_view('super/users', compact('users'), 'List Users');
    }

    public static function bookings(): void {
        require_superadmin();
        global $pdo;

        $bookings = $pdo->query("
            SELECT b.*, r.name room_name, u.name user_name, a.name admin_name
            FROM bookings b
            JOIN rooms r ON r.id=b.room_id
            JOIN users u ON u.id=b.user_id
            JOIN users a ON a.id=b.admin_id
            ORDER BY b.start_time DESC
        ")->fetchAll();

        render_view('super/bookings', compact('bookings'), 'All Bookings');
    }
}
