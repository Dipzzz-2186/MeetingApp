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
        
        // Handle POST requests
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle user creation
            if (isset($_POST['action']) && $_POST['action'] === 'create') {
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
            }
            
            // Handle user update
            elseif (isset($_POST['action']) && $_POST['action'] === 'update') {
                $id = (int)($_POST['id'] ?? 0);
                $name = trim($_POST['name'] ?? '');
                $email = trim($_POST['email'] ?? '');
                $role = trim($_POST['role'] ?? 'user');
                
                if ($id <= 0 || $name === '' || $email === '') {
                    $_SESSION['error'] = 'Data tidak valid.';
                } else {
                    try {
                        // Cek apakah user milik admin ini
                        $stmt = $pdo->prepare("SELECT id FROM users WHERE id = :id AND owner_admin_id = :owner_admin_id");
                        $stmt->execute([':id' => $id, ':owner_admin_id' => $user['id']]);
                        
                        if ($stmt->fetch()) {
                            // Update user
                            $stmt = $pdo->prepare("UPDATE users SET name = :name, email = :email, role = :role WHERE id = :id");
                            $stmt->execute([
                                ':name' => $name,
                                ':email' => $email,
                                ':role' => $role,
                                ':id' => $id
                            ]);
                            
                            // Update password jika diberikan
                            if (!empty($_POST['password'])) {
                                $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
                                $stmt = $pdo->prepare("UPDATE users SET password_hash = :password_hash WHERE id = :id");
                                $stmt->execute([':password_hash' => $password_hash, ':id' => $id]);
                            }
                            
                            $_SESSION['notice'] = 'User berhasil diperbarui.';
                        } else {
                            $_SESSION['error'] = 'User tidak ditemukan.';
                        }
                    } catch (PDOException $e) {
                        $_SESSION['error'] = 'Email sudah digunakan.';
                    }
                }
            }
            
            // Handle user deletion
            elseif (isset($_POST['action']) && $_POST['action'] === 'delete') {
                $id = (int)($_POST['id'] ?? 0);
                
                if ($id > 0) {
                    try {
                        // Cek apakah user milik admin ini
                        $stmt = $pdo->prepare("SELECT id FROM users WHERE id = :id AND owner_admin_id = :owner_admin_id");
                        $stmt->execute([':id' => $id, ':owner_admin_id' => $user['id']]);
                        
                        if ($stmt->fetch()) {
                            // Hapus user (soft delete atau hard delete sesuai kebutuhan)
                            $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
                            $stmt->execute([':id' => $id]);
                            
                            $_SESSION['notice'] = 'User berhasil dihapus.';
                        } else {
                            $_SESSION['error'] = 'User tidak ditemukan.';
                        }
                    } catch (PDOException $e) {
                        $_SESSION['error'] = 'Gagal menghapus user.';
                    }
                }
            }
            
            // Redirect untuk menghindari form resubmission
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit;
        }
        
        // Handle GET requests for AJAX data
        if (isset($_GET['ajax']) && $_GET['ajax'] === 'get_user') {
            $id = (int)($_GET['id'] ?? 0);
            
            if ($id > 0) {
                $stmt = $pdo->prepare("SELECT id, name, email, role FROM users WHERE id = :id AND owner_admin_id = :owner_admin_id");
                $stmt->execute([':id' => $id, ':owner_admin_id' => $user['id']]);
                $userData = $stmt->fetch();
                
                if ($userData) {
                    header('Content-Type: application/json');
                    echo json_encode($userData);
                    exit;
                }
            }
            
            header('Content-Type: application/json');
            echo json_encode(['error' => 'User tidak ditemukan']);
            exit;
        }
        
        // Ambil pesan dari session
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
        
        // Tangani form submission dengan POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle room creation
            if (!isset($_POST['action']) || $_POST['action'] === 'create') {
                $name = trim($_POST['name'] ?? '');
                $capacity = (int)($_POST['capacity'] ?? 0);

                if ($name === '' || $capacity <= 0) {
                    $_SESSION['error'] = 'Nama room dan kapasitas wajib diisi.';
                } elseif ($capacity > 100) {
                    $_SESSION['error'] = 'Kapasitas maksimal 100 orang.';
                } else {
                    try {
                        Room::create($pdo, [
                            'owner_admin_id' => $user['id'],
                            'name' => $name,
                            'capacity' => $capacity,
                            'created_at' => now_iso(),
                        ]);
                        $_SESSION['notice'] = 'Room berhasil ditambahkan.';
                    } catch (PDOException $e) {
                        $_SESSION['error'] = 'Nama room sudah digunakan.';
                    }
                }
            }
            
            // Handle room update
            elseif ($_POST['action'] === 'update') {
                $id = (int)($_POST['id'] ?? 0);
                $name = trim($_POST['name'] ?? '');
                $capacity = (int)($_POST['capacity'] ?? 0);
                
                if ($id <= 0 || $name === '' || $capacity <= 0) {
                    $_SESSION['error'] = 'Data tidak valid.';
                } elseif ($capacity > 100) {
                    $_SESSION['error'] = 'Kapasitas maksimal 100 orang.';
                } else {
                    try {
                        // Cek apakah room milik admin ini
                        $stmt = $pdo->prepare("SELECT id FROM rooms WHERE id = :id AND owner_admin_id = :owner_admin_id");
                        $stmt->execute([':id' => $id, ':owner_admin_id' => $user['id']]);
                        
                        if ($stmt->fetch()) {
                            // Update room
                            $stmt = $pdo->prepare("UPDATE rooms SET name = :name, capacity = :capacity WHERE id = :id");
                            $stmt->execute([
                                ':name' => $name,
                                ':capacity' => $capacity,
                                ':id' => $id
                            ]);
                            
                            $_SESSION['notice'] = 'Room berhasil diperbarui.';
                        } else {
                            $_SESSION['error'] = 'Room tidak ditemukan.';
                        }
                    } catch (PDOException $e) {
                        $_SESSION['error'] = 'Nama room sudah digunakan.';
                    }
                }
            }
            
            // Handle room deletion
            elseif ($_POST['action'] === 'delete') {
                $id = (int)($_POST['id'] ?? 0);
                
                if ($id > 0) {
                    try {
                        // Cek apakah room milik admin ini
                        $stmt = $pdo->prepare("SELECT id FROM rooms WHERE id = :id AND owner_admin_id = :owner_admin_id");
                        $stmt->execute([':id' => $id, ':owner_admin_id' => $user['id']]);
                        
                        if ($stmt->fetch()) {
                            // Cek apakah ada booking aktif untuk room ini
                            $stmt = $pdo->prepare("SELECT COUNT(*) as booking_count FROM bookings WHERE room_id = :room_id AND end_time > NOW()");
                            $stmt->execute([':room_id' => $id]);
                            $result = $stmt->fetch();
                            
                            if ($result['booking_count'] > 0) {
                                $_SESSION['error'] = 'Tidak dapat menghapus room karena masih ada booking aktif.';
                            } else {
                                // Hapus room
                                $stmt = $pdo->prepare("DELETE FROM rooms WHERE id = :id");
                                $stmt->execute([':id' => $id]);
                                
                                $_SESSION['notice'] = 'Room berhasil dihapus.';
                            }
                        } else {
                            $_SESSION['error'] = 'Room tidak ditemukan.';
                        }
                    } catch (PDOException $e) {
                        $_SESSION['error'] = 'Gagal menghapus room.';
                    }
                }
            }
            
            // Redirect untuk menghindari form resubmission
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit;
        }
        
        // Handle GET requests for AJAX data
        if (isset($_GET['ajax']) && $_GET['ajax'] === 'get_room') {
            $id = (int)($_GET['id'] ?? 0);
            
            if ($id > 0) {
                $stmt = $pdo->prepare("SELECT id, name, capacity FROM rooms WHERE id = :id AND owner_admin_id = :owner_admin_id");
                $stmt->execute([':id' => $id, ':owner_admin_id' => $user['id']]);
                $roomData = $stmt->fetch();
                
                if ($roomData) {
                    header('Content-Type: application/json');
                    echo json_encode($roomData);
                    exit;
                }
            }
            
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Room tidak ditemukan']);
            exit;
        }
        
        // Ambil pesan dari session
        if (isset($_SESSION['notice'])) {
            $notice = $_SESSION['notice'];
            unset($_SESSION['notice']);
        }
        
        if (isset($_SESSION['error'])) {
            $error = $_SESSION['error'];
            unset($_SESSION['error']);
        }

        // Konfigurasi pagination
        $itemsPerPage = 5;
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($currentPage < 1) $currentPage = 1;
        
        // Hitung offset
        $offset = ($currentPage - 1) * $itemsPerPage;
        
        // Query dengan LIMIT untuk pagination
        $stmt = $pdo->prepare("
            SELECT id, name, capacity, created_at 
            FROM rooms 
            WHERE owner_admin_id = :owner_admin_id 
            ORDER BY created_at DESC
            LIMIT :limit OFFSET :offset
        ");
        $stmt->bindValue(':owner_admin_id', $user['id'], PDO::PARAM_INT);
        $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $rooms = $stmt->fetchAll();
        
        // Hitung total rooms untuk pagination
        $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM rooms WHERE owner_admin_id = :owner_admin_id");
        $stmt->execute([':owner_admin_id' => $user['id']]);
        $totalResult = $stmt->fetch();
        $totalRooms = $totalResult['total'];
        $totalPages = ceil($totalRooms / $itemsPerPage);
        
        // Validasi page number
        if ($currentPage > $totalPages && $totalPages > 0) {
            $currentPage = $totalPages;
        }

        render_view('admin/rooms', [
            'notice' => $notice,
            'error' => $error,
            'rooms' => $rooms,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'totalRooms' => $totalRooms,
        ], 'Kelola Ruangan');
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
        
        // AMBIL WAKTU SEKARANG DENGAN TIMEZONE YANG SESUAI
        date_default_timezone_set('Asia/Jakarta'); // Sesuaikan dengan timezone Anda
        
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

        // TAMBAHKAN LOGIKA UPDATE STATUS OTOMATIS DI CONTROLLER
        // Update status booking yang sudah lewat
        $now = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
        
        foreach ($bookings as &$booking) {
            try {
                $start = new DateTime($booking['start_time'], new DateTimeZone('Asia/Jakarta'));
                $end = new DateTime($booking['end_time'], new DateTimeZone('Asia/Jakarta'));
                
                // Tambahkan margin 1 menit untuk menghindari perbedaan waktu kecil
                if ($now > $end) {
                    // Status sudah selesai
                    $booking['status_override'] = 'completed';
                } elseif ($now >= $start && $now <= $end) {
                    // Sedang berlangsung
                    $booking['status_override'] = 'ongoing';
                } else {
                    // Akan datang
                    $booking['status_override'] = 'upcoming';
                }
            } catch (Exception $e) {
                $booking['status_override'] = 'upcoming';
            }
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