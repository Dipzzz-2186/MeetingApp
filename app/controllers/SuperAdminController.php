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

    public static function adminDetail(): void {
        require_superadmin();
        global $pdo;

        $adminId = (int)($_GET['id'] ?? 0);
        if ($adminId <= 0) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid admin id']);
            exit;
        }

        // admin info
        $admin = $pdo->prepare("SELECT id, name, email, plan_type FROM users WHERE id=:id AND role='admin'");
        $admin->execute([':id' => $adminId]);
        $admin = $admin->fetch(PDO::FETCH_ASSOC);

        // users under admin
        $users = $pdo->prepare("
            SELECT id, name, email
            FROM users
            WHERE owner_admin_id=:id AND role='user'
            ORDER BY name
        ");
        $users->execute([':id' => $adminId]);

        // rooms under admin
        $rooms = $pdo->prepare("
            SELECT id, name, capacity
            FROM rooms
            WHERE owner_admin_id=:id
            ORDER BY name
        ");
        $rooms->execute([':id' => $adminId]);

        // Count total bookings from this admin
        $bookingsCount = $pdo->prepare("
            SELECT COUNT(*) 
            FROM bookings 
            WHERE admin_id=:id
        ");
        $bookingsCount->execute([':id' => $adminId]);
        $totalBookings = (int)$bookingsCount->fetchColumn();

        header('Content-Type: application/json');
        echo json_encode([
            'admin' => $admin,
            'users' => $users->fetchAll(),
            'rooms' => $rooms->fetchAll(),
            'bookings' => $totalBookings,
        ]);
    }

    public static function users(): void {
        require_superadmin();
        global $pdo;

        // Get users with booking info for today
        $users = $pdo->query("
            SELECT 
                u.*,
                a.name AS admin_name,
                COUNT(DISTINCT CASE 
                    WHEN DATE(b.start_time) = CURDATE() 
                    THEN b.id 
                END) as has_bookings
            FROM users u
            LEFT JOIN users a ON a.id = u.owner_admin_id
            LEFT JOIN bookings b ON b.user_id = u.id
            WHERE u.role='user'
            GROUP BY u.id, u.name, u.email, u.created_at, u.owner_admin_id, a.name
            ORDER BY a.name, u.name
        ")->fetchAll();

        render_view('super/users', compact('users'), 'List Users');
    }

    public static function userDetail(): void {
        require_superadmin();
        global $pdo;

        $userId = (int)($_GET['id'] ?? 0);
        if ($userId <= 0) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid user id']);
            exit;
        }

        // user + admin info
        $stmt = $pdo->prepare("
            SELECT u.id, u.name, u.email, a.name AS admin_name
            FROM users u
            LEFT JOIN users a ON a.id = u.owner_admin_id
            WHERE u.id = :id AND u.role = 'user'
        ");
        $stmt->execute([':id' => $userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            http_response_code(404);
            echo json_encode(['error' => 'User not found']);
            exit;
        }

        // bookings / rooms user
        $rooms = $pdo->prepare("
            SELECT r.name AS room_name, b.start_time, b.end_time
            FROM bookings b
            JOIN rooms r ON r.id = b.room_id
            WHERE b.user_id = :uid
            ORDER BY b.start_time DESC
        ");
        $rooms->execute([':uid' => $userId]);
        
        $roomsData = $rooms->fetchAll();
        
        // Count total bookings
        $totalBookings = count($roomsData);

        header('Content-Type: application/json');
        echo json_encode([
            'user' => [
                'id'    => $user['id'],
                'name'  => $user['name'],
                'email' => $user['email'],
            ],
            'admin_name' => $user['admin_name'],
            'rooms' => $roomsData,
            'total_bookings' => $totalBookings,
        ]);
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
