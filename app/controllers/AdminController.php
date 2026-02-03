<?php

class AdminController {
    public static function dashboard(): void {
        require_admin();
        global $pdo;
        refresh_user($pdo);
        $user = current_user();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';
            if ($action === 'mark_paid') {
                $paid_until = date('Y-m-d H:i:s', strtotime('+30 days'));
                User::updatePlanPaidUntil($pdo, (int)$user['id'], $paid_until);
            }
            if ($action === 'extend_paid') {
                $date = normalize_datetime($_POST['paid_until'] ?? '');
                if ($date !== '') {
                    User::updatePlanPaidUntil($pdo, (int)$user['id'], $date);
                }
            }
            if ($action === 'reset_trial') {
                $trial_end = date('Y-m-d H:i:s', strtotime('+10 days'));
                User::updatePlanTrialReset($pdo, (int)$user['id'], $trial_end);
            }
            refresh_user($pdo);
            $user = current_user();
        }

        $plan_message = admin_plan_message($user);
        $blocked = admin_plan_blocked($user);
        $recent = Booking::recentByAdmin($pdo, (int)$user['id']);

        render_view('admin/dashboard', [
            'plan_message' => $plan_message,
            'blocked' => $blocked,
            'recent' => $recent,
        ], 'Dashboard Admin');
    }

    public static function users(): void {
        require_admin();
        global $pdo;
        refresh_user($pdo);
        $user = current_user();

        if (admin_plan_blocked($user)) {
            header('Location: /dashboard_admin');
            exit;
        }

        $notice = null;
        $error = null;
        
        // Tangani form submission dengan POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($name === '' || $email === '' || $password === '') {
                $_SESSION['error'] = 'Semua field wajib diisi.';
            } else {
                try {
                    User::createUser($pdo, [
                        'owner_admin_id' => $user['id'],
                        'name' => $name,
                        'email' => $email,
                        'password_hash' => password_hash($password, PASSWORD_DEFAULT),
                        'created_at' => now_iso(),
                    ]);
                    $_SESSION['notice'] = 'User berhasil ditambahkan.';
                } catch (PDOException $e) {
                    $_SESSION['error'] = 'Email sudah digunakan.';
                }
            }
            
            // Redirect ke halaman yang sama dengan metode GET
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit;
        }
        
        // Ambil pesan dari session (jika ada) setelah redirect
        if (isset($_SESSION['notice'])) {
            $notice = $_SESSION['notice'];
            unset($_SESSION['notice']);
        }
        
        if (isset($_SESSION['error'])) {
            $error = $_SESSION['error'];
            unset($_SESSION['error']);
        }

        $users = User::usersByOwner($pdo, (int)$user['id']);

        render_view('admin/users', [
            'notice' => $notice,
            'error' => $error,
            'users' => $users,
        ], 'Add User');
    }

    public static function rooms(): void {
        require_admin();
        global $pdo;
        refresh_user($pdo);
        $user = current_user();

        if (admin_plan_blocked($user)) {
            header('Location: /dashboard_admin');
            exit;
        }

        $notice = null;
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $capacity = (int)($_POST['capacity'] ?? 0);

            if ($name === '' || $capacity <= 0) {
                $error = 'Nama room dan kapasitas wajib diisi.';
            } else {
                try {
                    Room::create($pdo, [
                        'owner_admin_id' => $user['id'],
                        'name' => $name,
                        'capacity' => $capacity,
                        'created_at' => now_iso(),
                    ]);
                    $notice = 'Room berhasil ditambahkan.';
                } catch (PDOException $e) {
                    $error = 'Nama room sudah digunakan.';
                }
            }
        }

        $rooms = Room::allByOwner($pdo, (int)$user['id']);

        render_view('admin/rooms', [
            'notice' => $notice,
            'error' => $error,
            'rooms' => $rooms,
        ], 'Add Room');
    }

    public static function bookings(): void {
        require_admin();
        global $pdo;
        refresh_user($pdo);
        $user = current_user();

        if (admin_plan_blocked($user)) {
            header('Location: /dashboard_admin');
            exit;
        }

        $notice = null;
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = (int)($_POST['user_id'] ?? 0);
            $room_id = (int)($_POST['room_id'] ?? 0);
            $start = normalize_datetime($_POST['start_time'] ?? '');
            $end = normalize_datetime($_POST['end_time'] ?? '');
            $purpose = trim($_POST['purpose'] ?? '');

            if ($user_id <= 0 || $room_id <= 0 || $start === '' || $end === '') {
                $error = 'Semua field wajib diisi.';
            } elseif (strtotime($end) <= strtotime($start)) {
                $error = 'Waktu selesai harus lebih besar dari waktu mulai.';
            } elseif (!is_room_available($pdo, $room_id, $start, $end)) {
                $error = 'Room sudah terbooking pada waktu tersebut.';
            } else {
                Booking::create($pdo, [
                    'admin_id' => $user['id'],
                    'user_id' => $user_id,
                    'room_id' => $room_id,
                    'start_time' => $start,
                    'end_time' => $end,
                    'purpose' => $purpose,
                    'created_at' => now_iso(),
                ]);
                $notice = 'Booking berhasil dibuat.';
            }
        }

        $stmt = $pdo->prepare("SELECT id, name FROM users WHERE role = 'user' AND owner_admin_id = :owner_admin_id ORDER BY name ASC");
        $stmt->execute([':owner_admin_id' => $user['id']]);
        $users = $stmt->fetchAll();
        $rooms = Room::availableByOwner($pdo, (int)$user['id']);

        if ($user['role'] === 'superadmin') {
            $bookings = Booking::all($pdo);
        } else {
            $bookings = Booking::byAdmin($pdo, (int)$user['id']);
        }

        render_view('admin/bookings', [
            'notice' => $notice,
            'error' => $error,
            'users' => $users,
            'rooms' => $rooms,
            'bookings' => $bookings,
        ], 'Scheduling');
    }
}
