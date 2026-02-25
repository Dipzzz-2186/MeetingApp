<?php

class AdminController {
    private static function createBillingToken(array $user, int $amount, int $days): string {
        try {
            $token = bin2hex(random_bytes(16));
        } catch (Exception $e) {
            $token = md5(uniqid((string)$user['id'], true));
        }

        if (!isset($_SESSION['billing_pending']) || !is_array($_SESSION['billing_pending'])) {
            $_SESSION['billing_pending'] = [];
        }

        $_SESSION['billing_pending'][$token] = [
            'admin_id' => (int)$user['id'],
            'amount' => $amount,
            'days' => $days,
            'created_at' => time(),
        ];

        return $token;
    }

    private static function getBillingPayment(string $token, int $adminId): ?array {
        if ($token === '') {
            return null;
        }

        $payment = $_SESSION['billing_pending'][$token] ?? null;
        if (!is_array($payment)) {
            return null;
        }

        if ((int)($payment['admin_id'] ?? 0) !== $adminId) {
            return null;
        }

        $createdAt = (int)($payment['created_at'] ?? 0);
        if ($createdAt <= 0 || $createdAt < (time() - 3600)) {
            unset($_SESSION['billing_pending'][$token]);
            return null;
        }

        return $payment;
    }

    private static function clearBillingPayment(string $token): void {
        if ($token !== '' && isset($_SESSION['billing_pending'][$token])) {
            unset($_SESSION['billing_pending'][$token]);
        }
    }

    private static function extendAdminPaidPlan(PDO $pdo, int $adminId, int $days): string {
        $admin = User::findById($pdo, $adminId);
        if (!$admin) {
            throw new RuntimeException('Admin tidak ditemukan.');
        }

        $now = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
        if (!empty($admin['paid_until'])) {
            $base = new DateTime($admin['paid_until'], new DateTimeZone('Asia/Jakarta'));
            if ($base < $now) {
                $base = $now;
            }
        } else {
            $base = $now;
        }

        $base->modify('+' . $days . ' days');
        $paidUntil = $base->format('Y-m-d H:i:s');
        User::updatePlanPaidUntil($pdo, $adminId, $paidUntil);

        return $paidUntil;
    }

    public static function billingCheckout(): void {
        require_admin();
        global $pdo;
        refresh_user($pdo);
        $user = current_user();

        $amount = 95000;
        $days = 30;
        $error = $_SESSION['billing_error'] ?? null;
        unset($_SESSION['billing_error']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $method = trim($_POST['payment_method'] ?? '');
            $allowedMethods = ['bank_va', 'qris', 'ewallet', 'card'];
            if (!in_array($method, $allowedMethods, true)) {
                $error = 'Metode pembayaran tidak valid.';
            } else {
                $token = self::createBillingToken($user, $amount, $days);
                $_SESSION['billing_payment_method'][$token] = $method;
                header('Location: /billing/pay?token=' . urlencode($token));
                exit;
            }
        }

        $planStatus = admin_plan_status($user);
        render_view('admin/billing_checkout', [
            'amount' => $amount,
            'days' => $days,
            'error' => $error,
            'plan_status' => $planStatus,
        ], 'Checkout Langganan');
    }

    public static function billingPay(): void {
        require_admin();
        global $pdo;
        refresh_user($pdo);
        $user = current_user();

        $token = trim($_GET['token'] ?? ($_POST['token'] ?? ''));
        $payment = self::getBillingPayment($token, (int)$user['id']);
        if (!$payment) {
            $_SESSION['billing_error'] = 'Sesi pembayaran tidak ditemukan atau sudah kadaluarsa.';
            header('Location: /billing/checkout');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';
            if ($action === 'confirm') {
                $paidUntil = self::extendAdminPaidPlan($pdo, (int)$user['id'], (int)$payment['days']);
                self::clearBillingPayment($token);
                unset($_SESSION['billing_payment_method'][$token]);
                $_SESSION['billing_notice'] = 'Pembayaran berhasil. Langganan aktif sampai ' . date('d M Y H:i', strtotime($paidUntil)) . '.';
                header('Location: /dashboard_admin');
                exit;
            }

            if ($action === 'cancel') {
                self::clearBillingPayment($token);
                unset($_SESSION['billing_payment_method'][$token]);
                $_SESSION['billing_error'] = 'Pembayaran dibatalkan.';
                header('Location: /dashboard_admin');
                exit;
            }
        }

        $method = $_SESSION['billing_payment_method'][$token] ?? 'bank_va';
        $methodLabelMap = [
            'bank_va' => 'Virtual Account',
            'qris' => 'QRIS',
            'ewallet' => 'E-Wallet',
            'card' => 'Kartu Kredit/Debit',
        ];
        $methodLabel = $methodLabelMap[$method] ?? 'Virtual Account';

        render_view('admin/billing_pay', [
            'token' => $token,
            'payment' => $payment,
            'method_label' => $methodLabel,
        ], 'Payment Gateway');
    }

    public static function dashboard(): void {
        require_admin();
        global $pdo;
        refresh_user($pdo);
        $user = current_user();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $action = $_POST['action'] ?? '';

                if ($action === 'mark_paid') {
                    self::extendAdminPaidPlan($pdo, (int)$user['id'], 30);
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

                // 🔥 INI KUNCI
                header('Location: /dashboard_admin');
                exit;
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
        $billing_notice = $_SESSION['billing_notice'] ?? null;
        $billing_error = $_SESSION['billing_error'] ?? null;
        unset($_SESSION['billing_notice'], $_SESSION['billing_error']);
        
        // SET TIMEZONE SAMA SEPERTI DI METHOD BOOKINGS
        date_default_timezone_set('Asia/Jakarta');
        
        // Inisialisasi array stats
        $stats = [
            'total_users' => 0,
            'total_rooms' => 0,
            'monthly_bookings' => 0,
            'active_meetings' => 0,
            'last_month_bookings' => 0,
            'total_capacity' => 0,
            'last_month_users' => 0
        ];
        
        // 1. Total Users (hitung user yang dimiliki oleh admin ini)
        try {
            $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM users WHERE owner_admin_id = :owner_admin_id AND role = 'user'");
            $stmt->execute([':owner_admin_id' => $user['id']]);
            $result = $stmt->fetch();
            $stats['total_users'] = $result['total'] ?? 0;
        } catch (PDOException $e) {
            error_log('Error getting total users: ' . $e->getMessage());
        }
        
        // 2. Total Rooms (hitung room yang dimiliki oleh admin ini)
        try {
            $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM rooms WHERE owner_admin_id = :owner_admin_id");
            $stmt->execute([':owner_admin_id' => $user['id']]);
            $result = $stmt->fetch();
            $stats['total_rooms'] = $result['total'] ?? 0;
        } catch (PDOException $e) {
            error_log('Error getting total rooms: ' . $e->getMessage());
        }
        
        // 3. Total Bookings bulan ini
        try {
            $firstDayOfMonth = date('Y-m-01 00:00:00');
            $lastDayOfMonth = date('Y-m-t 23:59:59');
            
            $stmt = $pdo->prepare("
                SELECT COUNT(*) as total 
                FROM bookings 
                WHERE admin_id = :admin_id 
                AND created_at BETWEEN :first_day AND :last_day
            ");
            $stmt->execute([
                ':admin_id' => $user['id'],
                ':first_day' => $firstDayOfMonth,
                ':last_day' => $lastDayOfMonth
            ]);
            $result = $stmt->fetch();
            $stats['monthly_bookings'] = $result['total'] ?? 0;
        } catch (PDOException $e) {
            error_log('Error getting monthly bookings: ' . $e->getMessage());
        }
        
        // 4. Active Meetings (booking yang sedang berlangsung sekarang) - SAMA SEPERTI DI METHOD BOOKINGS
        try {
            $now = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
            $nowStr = $now->format('Y-m-d H:i:s');
            
            $stmt = $pdo->prepare("
                SELECT COUNT(*) as total 
                FROM bookings 
                WHERE admin_id = :admin_id 
                AND start_time <= :now 
                AND end_time >= :now
            ");
            $stmt->execute([
                ':admin_id' => $user['id'],
                ':now' => $nowStr
            ]);
            $result = $stmt->fetch();
            $stats['active_meetings'] = $result['total'] ?? 0;
        } catch (PDOException $e) {
            error_log('Error getting active meetings: ' . $e->getMessage());
        }
        
        // 5. Total Bookings bulan lalu (untuk perbandingan)
        try {
            $firstDayLastMonth = date('Y-m-01 00:00:00', strtotime('-1 month'));
            $lastDayLastMonth = date('Y-m-t 23:59:59', strtotime('-1 month'));
            
            $stmt = $pdo->prepare("
                SELECT COUNT(*) as total 
                FROM bookings 
                WHERE admin_id = :admin_id 
                AND created_at BETWEEN :first_day AND :last_day
            ");
            $stmt->execute([
                ':admin_id' => $user['id'],
                ':first_day' => $firstDayLastMonth,
                ':last_day' => $lastDayLastMonth
            ]);
            $result = $stmt->fetch();
            $stats['last_month_bookings'] = $result['total'] ?? 0;
        } catch (PDOException $e) {
            error_log('Error getting last month bookings: ' . $e->getMessage());
        }
        
        // 6. Total kapasitas semua ruangan
        try {
            $stmt = $pdo->prepare("SELECT SUM(capacity) as total_capacity FROM rooms WHERE owner_admin_id = :owner_admin_id");
            $stmt->execute([':owner_admin_id' => $user['id']]);
            $result = $stmt->fetch();
            $stats['total_capacity'] = $result['total_capacity'] ?? 0;
        } catch (PDOException $e) {
            error_log('Error getting total capacity: ' . $e->getMessage());
        }
        
        // 7. User growth (perbandingan dengan bulan lalu)
        try {
            $firstDayLastMonth = date('Y-m-01 00:00:00', strtotime('-1 month'));
            $lastDayLastMonth = date('Y-m-t 23:59:59', strtotime('-1 month'));
            
            $stmt = $pdo->prepare("
                SELECT COUNT(*) as total 
                FROM users 
                WHERE owner_admin_id = :owner_admin_id 
                AND role = 'user'
                AND created_at <= :last_day_last_month
            ");
            $stmt->execute([
                ':owner_admin_id' => $user['id'],
                ':last_day_last_month' => $lastDayLastMonth
            ]);
            $result = $stmt->fetch();
            $stats['last_month_users'] = $result['total'] ?? 0;
        } catch (PDOException $e) {
            error_log('Error getting last month users: ' . $e->getMessage());
        }
        
        // 8. Ambil 5 recent bookings saja untuk admin
        try {
            $stmt = $pdo->prepare("
                SELECT 
                    b.id,
                    b.start_time,
                    b.end_time,
                    b.purpose,
                    u.name as user_name,
                    r.name as room_name
                FROM bookings b
                JOIN users u ON b.user_id = u.id
                JOIN rooms r ON b.room_id = r.id
                WHERE b.admin_id = :admin_id 
                ORDER BY b.start_time DESC
                LIMIT 5  -- HANYA 5 DATA SAJA
            ");
            $stmt->execute([':admin_id' => $user['id']]);
            $recent = $stmt->fetchAll();
            foreach ($recent as &$item) {
                $item['room_name'] = Room::decodeStoredName($item['room_name'] ?? '');
            }
            unset($item);
            
            // Tambahkan status override seperti di method bookings
            $now = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
            foreach ($recent as &$booking) {
                try {
                    $start = new DateTime($booking['start_time'], new DateTimeZone('Asia/Jakarta'));
                    $end = new DateTime($booking['end_time'], new DateTimeZone('Asia/Jakarta'));
                    
                    if ($now > $end) {
                        $booking['status_override'] = 'completed';
                    } elseif ($now >= $start && $now <= $end) {
                        $booking['status_override'] = 'ongoing';
                    } else {
                        $booking['status_override'] = 'upcoming';
                    }
                } catch (Exception $e) {
                    $booking['status_override'] = 'upcoming';
                }
            }
            
        } catch (PDOException $e) {
            error_log('Error getting recent bookings: ' . $e->getMessage());
            $recent = [];
        }

        // Debug log
        error_log('Dashboard Stats: ' . print_r($stats, true));
        error_log('Active Meetings Count: ' . $stats['active_meetings']);
        error_log('Recent Bookings Count: ' . count($recent));

        $plan_status = admin_plan_status($user);
        render_view('admin/dashboard', [
            'plan_message' => $plan_message,
            'blocked' => $blocked,
            'recent' => $recent,
            'stats' => $stats,
            'plan_status' => $plan_status,
            'billing_notice' => $billing_notice,
            'billing_error' => $billing_error,
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
                            'name'           => $name,
                            'email'          => $email,
                            'password_hash'  => password_hash($password, PASSWORD_DEFAULT),
                            'role'           => 'user', // 🔒 KUNCI
                            'created_at'     => now_iso(),
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
                
                if ($id <= 0 || $name === '' || $email === '') {
                    $_SESSION['error'] = 'Data tidak valid.';
                } else {
                    try {
                        // Cek apakah user milik admin ini
                        $stmt = $pdo->prepare("SELECT id FROM users WHERE id = :id AND owner_admin_id = :owner_admin_id");
                        $stmt->execute([':id' => $id, ':owner_admin_id' => $user['id']]);
                        
                        if ($stmt->fetch()) {
                            // Update user
                            $stmt = $pdo->prepare("
                                UPDATE users 
                                SET name = :name, email = :email
                                WHERE id = :id
                            ");
                            $stmt->execute([
                                ':name' => $name,
                                ':email' => $email,
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

    private static function parseRoomWallpaperPaths($value): array {
        if ($value === null) {
            return [];
        }
        $raw = trim((string)$value);
        if ($raw === '') {
            return [];
        }

        $decoded = json_decode($raw, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            $normalized = array_map(static function($item) {
                return trim((string)$item);
            }, $decoded);
            return array_values(array_filter($normalized, static function($item) {
                return $item !== '';
            }));
        }

        if (strpos($raw, "\n") !== false) {
            return array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $raw))));
        }

        return [$raw];
    }

    private static function storeRoomWallpapers(array $fileInput): array {
        if (empty($fileInput) || !isset($fileInput['error'])) {
            return ['paths' => [], 'error' => null];
        }

        $flatten = static function($value): array {
            if (!is_array($value)) {
                return [$value];
            }
            $result = [];
            $stack = [$value];
            while (!empty($stack)) {
                $current = array_pop($stack);
                foreach ($current as $item) {
                    if (is_array($item)) {
                        $stack[] = $item;
                    } else {
                        $result[] = $item;
                    }
                }
            }
            return $result;
        };

        $errors = $flatten($fileInput['error']);
        $tmpNames = $flatten($fileInput['tmp_name'] ?? []);
        $sizes = $flatten($fileInput['size'] ?? []);

        $allNoFile = true;
        foreach ($errors as $err) {
            if ((int)$err !== UPLOAD_ERR_NO_FILE) {
                $allNoFile = false;
                break;
            }
        }
        if ($allNoFile) {
            return ['paths' => [], 'error' => null];
        }

        $maxSize = 5 * 1024 * 1024; // 5MB per file
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $allowed = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/webp' => 'webp',
        ];

        $publicDir = dirname(__DIR__, 2) . '/public';
        $uploadDir = $publicDir . '/uploads/rooms';
        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0755, true) && !is_dir($uploadDir)) {
                return ['paths' => [], 'error' => 'Gagal membuat folder upload.'];
            }
        }

        $savedPaths = [];
        foreach ($errors as $index => $err) {
            $err = (int)$err;
            if ($err === UPLOAD_ERR_NO_FILE) {
                continue;
            }
            if ($err !== UPLOAD_ERR_OK) {
                return ['paths' => [], 'error' => 'Upload wallpaper gagal.'];
            }

            $tmp = (string)($tmpNames[$index] ?? '');
            $size = (int)($sizes[$index] ?? 0);
            if ($tmp === '' || !is_uploaded_file($tmp)) {
                return ['paths' => [], 'error' => 'File upload tidak valid.'];
            }
            if ($size > $maxSize) {
                return ['paths' => [], 'error' => 'Ukuran wallpaper maksimal 5MB per file.'];
            }

            $mime = $finfo->file($tmp);
            if (!isset($allowed[$mime])) {
                return ['paths' => [], 'error' => 'Format wallpaper harus JPG, PNG, atau WEBP.'];
            }

            try {
                $rand = bin2hex(random_bytes(8));
            } catch (Exception $e) {
                $rand = uniqid();
            }
            $filename = 'room_' . date('Ymd_His') . '_' . $index . '_' . $rand . '.' . $allowed[$mime];
            $targetPath = $uploadDir . '/' . $filename;

            if (!move_uploaded_file($tmp, $targetPath)) {
                return ['paths' => [], 'error' => 'Gagal menyimpan file wallpaper.'];
            }

            $savedPaths[] = '/uploads/rooms/' . $filename;
        }

        return ['paths' => $savedPaths, 'error' => null];
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
                $name = Room::decodeStoredName(trim($_POST['name'] ?? ''));
                $storedName = Room::encodeNameForOwner($name, (int)$user['id']);
                $capacity = (int)($_POST['capacity'] ?? 0);

                if ($name === '' || $capacity <= 0) {
                    $_SESSION['error'] = 'Nama room dan kapasitas wajib diisi.';
                } elseif ($capacity > 100) {
                    $_SESSION['error'] = 'Kapasitas maksimal 100 orang.';
                } else {
                    try {
                        $stmt = $pdo->prepare("
                            SELECT id
                            FROM rooms
                            WHERE owner_admin_id = :owner_admin_id
                            AND (name = :name_plain OR name = :name_stored)
                            LIMIT 1
                        ");
                        $stmt->execute([
                            ':owner_admin_id' => $user['id'],
                            ':name_plain' => $name,
                            ':name_stored' => $storedName,
                        ]);
                        if ($stmt->fetch()) {
                            $_SESSION['error'] = 'Nama room sudah digunakan di akun admin ini.';
                            header('Location: ' . $_SERVER['REQUEST_URI']);
                            exit;
                        }

                        $uploadInput = $_FILES['wallpaper_files'] ?? ($_FILES['wallpaper_file'] ?? []);
                        $upload = self::storeRoomWallpapers($uploadInput);
                        if ($upload['error']) {
                            $_SESSION['error'] = $upload['error'];
                            header('Location: ' . $_SERVER['REQUEST_URI']);
                            exit;
                        }
                        $wallpaperValue = !empty($upload['paths']) ? implode("\n", $upload['paths']) : null;
                        Room::create($pdo, [
                            'owner_admin_id' => $user['id'],
                            'name' => $storedName,
                            'capacity' => $capacity,
                            'wallpaper_url' => $wallpaperValue,
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
                $name = Room::decodeStoredName(trim($_POST['name'] ?? ''));
                $storedName = Room::encodeNameForOwner($name, (int)$user['id']);
                $capacity = (int)($_POST['capacity'] ?? 0);

                if ($id <= 0 || $name === '' || $capacity <= 0) {
                    $_SESSION['error'] = 'Data tidak valid.';
                } elseif ($capacity > 100) {
                    $_SESSION['error'] = 'Kapasitas maksimal 100 orang.';
                } else {
                    try {
                        // Cek apakah room milik admin ini
                        $stmt = $pdo->prepare("SELECT id, wallpaper_url FROM rooms WHERE id = :id AND owner_admin_id = :owner_admin_id");
                        $stmt->execute([':id' => $id, ':owner_admin_id' => $user['id']]);
                        
                        $roomRow = $stmt->fetch();
                        if ($roomRow) {
                            $existingWallpapers = self::parseRoomWallpaperPaths($roomRow['wallpaper_url'] ?? null);
                            $uploadInput = $_FILES['wallpaper_files'] ?? ($_FILES['wallpaper_file'] ?? []);
                            $upload = self::storeRoomWallpapers($uploadInput);
                            if ($upload['error']) {
                                $_SESSION['error'] = $upload['error'];
                                header('Location: ' . $_SERVER['REQUEST_URI']);
                                exit;
                            }
                            $finalWallpapers = !empty($upload['paths']) ? $upload['paths'] : $existingWallpapers;
                            $finalWallpaper = !empty($finalWallpapers) ? implode("\n", $finalWallpapers) : null;

                            if (!empty($upload['paths']) && !empty($existingWallpapers)) {
                                $publicDir = dirname(__DIR__, 2) . '/public';
                                foreach ($existingWallpapers as $existingWallpaper) {
                                    $oldPath = $publicDir . $existingWallpaper;
                                    if (is_file($oldPath)) {
                                        @unlink($oldPath);
                                    }
                                }
                            }

                            $stmt = $pdo->prepare("
                                SELECT id
                                FROM rooms
                                WHERE owner_admin_id = :owner_admin_id
                                AND (name = :name_plain OR name = :name_stored)
                                AND id <> :id
                                LIMIT 1
                            ");
                            $stmt->execute([
                                ':owner_admin_id' => $user['id'],
                                ':name_plain' => $name,
                                ':name_stored' => $storedName,
                                ':id' => $id,
                            ]);
                            if ($stmt->fetch()) {
                                $_SESSION['error'] = 'Nama room sudah digunakan di akun admin ini.';
                                header('Location: ' . $_SERVER['REQUEST_URI']);
                                exit;
                            }

                            // Update room
                            $stmt = $pdo->prepare("UPDATE rooms SET name = :name, capacity = :capacity, wallpaper_url = :wallpaper_url WHERE id = :id");
                            $stmt->execute([
                                ':name' => $storedName,
                                ':capacity' => $capacity,
                                ':wallpaper_url' => $finalWallpaper,
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
                $stmt = $pdo->prepare("SELECT id, name, capacity, wallpaper_url FROM rooms WHERE id = :id AND owner_admin_id = :owner_admin_id");
                $stmt->execute([':id' => $id, ':owner_admin_id' => $user['id']]);
                $roomData = $stmt->fetch();
                
                if ($roomData) {
                    $roomData['name'] = Room::decodeStoredName($roomData['name'] ?? '');
                    $wallpaperPaths = self::parseRoomWallpaperPaths($roomData['wallpaper_url'] ?? null);
                    $roomData['wallpaper_urls'] = $wallpaperPaths;
                    $roomData['wallpaper_url'] = $wallpaperPaths[0] ?? '';
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
            SELECT id, name, capacity, wallpaper_url, created_at 
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
        foreach ($rooms as &$roomRow) {
            $roomRow['name'] = Room::decodeStoredName($roomRow['name'] ?? '');
        }
        unset($roomRow);
        
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
        
        // Set timezone
        date_default_timezone_set('Asia/Jakarta');
        
        // Handle AJAX requests for getting booking data
        if (isset($_GET['ajax']) && $_GET['ajax'] === 'get_booking') {
            $booking_id = (int)($_GET['booking_id'] ?? 0);
            
            if ($booking_id > 0) {
                $stmt = $pdo->prepare("
                    SELECT 
                        b.*,
                        u.name as user_name,
                        u.email as user_email,
                        r.name as room_name,
                        r.capacity as room_capacity
                    FROM bookings b
                    JOIN users u ON b.user_id = u.id
                    JOIN rooms r ON b.room_id = r.id
                    WHERE b.id = :id AND b.admin_id = :admin_id
                ");
                $stmt->execute([':id' => $booking_id, ':admin_id' => $user['id']]);
                $bookingData = $stmt->fetch();
                
                if ($bookingData) {
                    $bookingData['room_name'] = Room::decodeStoredName($bookingData['room_name'] ?? '');
                    // Format tanggal untuk form
                    $start = new DateTime($bookingData['start_time']);
                    $end = new DateTime($bookingData['end_time']);
                    $bookingData['start_time_formatted'] = $start->format('Y-m-d\TH:i');
                    $bookingData['end_time_formatted'] = $end->format('Y-m-d\TH:i');
                    
                    header('Content-Type: application/json');
                    echo json_encode($bookingData);
                    exit;
                }
            }
            
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Booking tidak ditemukan']);
            exit;
        }

        if (isset($_GET['ajax']) && $_GET['ajax'] === 'live_bookings') {
            $bookings = Booking::byAdmin($pdo, (int)$user['id']);
            $now = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
            $rows = [];
            $counts = [
                'upcoming' => 0,
                'ongoing' => 0,
                'completed' => 0,
                'total' => 0,
            ];

            foreach ($bookings as $row) {
                try {
                    $start = new DateTime($row['start_time'], new DateTimeZone('Asia/Jakarta'));
                    $end = new DateTime($row['end_time'], new DateTimeZone('Asia/Jakarta'));
                } catch (Exception $e) {
                    $start = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
                    $end = (clone $start)->modify('+1 hour');
                }

                if ($now > $end) {
                    $status = 'completed';
                } elseif ($now >= $start && $now <= $end) {
                    $status = 'ongoing';
                } else {
                    $status = 'upcoming';
                }

                $duration = $start->diff($end);
                $hours = $duration->h + ($duration->days * 24);
                $minutes = $duration->i;
                $durationText = '';
                if ($hours > 0) {
                    $durationText .= $hours . ' jam ';
                }
                if ($minutes > 0) {
                    $durationText .= $minutes . ' menit';
                }
                if ($hours === 0 && $minutes === 0) {
                    $durationText = '< 1 menit';
                }

                $statusText = $status === 'upcoming' ? 'Akan Datang' : ($status === 'ongoing' ? 'Berlangsung' : 'Selesai');
                $statusIcon = $status === 'upcoming' ? 'fa-clock' : ($status === 'ongoing' ? 'fa-play-circle' : 'fa-check-circle');

                $rows[] = [
                    'id' => (int)$row['id'],
                    'user_name' => $row['user_name'],
                    'user_initial' => strtoupper(substr($row['user_name'], 0, 1)),
                    'room_id' => (int)$row['room_id'],
                    'room_name' => $row['room_name'],
                    'start_date' => $start->format('d/m/Y'),
                    'start_time' => $start->format('H:i'),
                    'end_time' => $end->format('H:i'),
                    'date_iso' => $start->format('Y-m-d'),
                    'status' => $status,
                    'status_class' => 'status-' . $status,
                    'status_text' => $statusText,
                    'status_icon' => $statusIcon,
                    'duration_text' => $durationText,
                ];

                $counts['total']++;
                if (isset($counts[$status])) {
                    $counts[$status]++;
                }
            }

            header('Content-Type: application/json');
            echo json_encode([
                'bookings' => $rows,
                'counts' => $counts,
            ]);
            exit;
        }

        if (isset($_GET['ajax']) && $_GET['ajax'] === 'room_schedule') {
            $room_id = (int)($_GET['room_id'] ?? 0);

            $stmt = $pdo->prepare("
                SELECT start_time, end_time 
                FROM bookings 
                WHERE room_id = :room_id
            ");
            $stmt->execute([':room_id' => $room_id]);

            header('Content-Type: application/json');
            echo json_encode($stmt->fetchAll());
            exit;
        }
        
        // Handle POST requests
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';
            $isAjax = isset($_POST['ajax']) && $_POST['ajax'] === 'true';
            $validateMonitorCreator = static function (string $email, string $password) use ($pdo, $user): array {
                $email = trim($email);
                $password = (string)$password;

                if ($email === '' || $password === '') {
                    return [
                        'ok' => false,
                        'error' => 'Email dan password wajib diisi.',
                    ];
                }

                $stmt = $pdo->prepare("
                    SELECT id, name, password_hash
                    FROM users
                    WHERE email = :email
                    AND role = 'user'
                    AND owner_admin_id = :owner_admin_id
                    LIMIT 1
                ");
                $stmt->execute([
                    ':email' => $email,
                    ':owner_admin_id' => $user['id'],
                ]);
                $matchedUser = $stmt->fetch();

                if (!$matchedUser || !password_verify($password, (string)$matchedUser['password_hash'])) {
                    return [
                        'ok' => false,
                        'error' => 'Email atau password tidak valid.',
                    ];
                }

                return [
                    'ok' => true,
                    'user_id' => (int)$matchedUser['id'],
                    'user_name' => (string)$matchedUser['name'],
                    'email' => $email,
                ];
            };
            
            if ($action === 'verify_password') {
                $password = $_POST['password'] ?? '';

                if ($password === '') {
                    $error = 'Password wajib diisi.';
                } else {
                    $stmt = $pdo->prepare("SELECT password_hash FROM users WHERE id = :id LIMIT 1");
                    $stmt->execute([':id' => $user['id']]);
                    $hash = $stmt->fetchColumn();

                    if ($hash && password_verify($password, $hash)) {
                        $notice = 'OK';
                    } else {
                        $error = 'Password salah.';
                    }
                }

                if ($isAjax) {
                    header('Content-Type: application/json');
                    echo json_encode([
                        'success' => !$error,
                        'notice' => $notice,
                        'error' => $error
                    ]);
                    exit;
                }
            }
            elseif ($action === 'verify_monitor_creator') {
                $verification = $validateMonitorCreator(
                    $_POST['email'] ?? '',
                    $_POST['password'] ?? ''
                );

                if ($verification['ok']) {
                    $notice = 'OK';
                } else {
                    $error = $verification['error'];
                }

                if ($isAjax) {
                    header('Content-Type: application/json');
                    echo json_encode([
                        'success' => !$error,
                        'notice' => $notice,
                        'error' => $error,
                        'user_id' => $verification['user_id'] ?? null,
                        'user_name' => $verification['user_name'] ?? null,
                        'email' => $verification['email'] ?? null,
                    ]);
                    exit;
                }
            }
            elseif ($action === 'create') {
                $user_id = (int)($_POST['user_id'] ?? 0);
                $room_id = (int)($_POST['room_id'] ?? 0);
                $start = normalize_datetime($_POST['start_time'] ?? '');
                $end = normalize_datetime($_POST['end_time'] ?? '');
                $purpose = trim($_POST['purpose'] ?? '');
                $isMonitorCreate = isset($_POST['monitor_mode']) && $_POST['monitor_mode'] === '1';

                if ($isMonitorCreate) {
                    $verification = $validateMonitorCreator(
                        $_POST['monitor_email'] ?? '',
                        $_POST['monitor_password'] ?? ''
                    );

                    if (!$verification['ok']) {
                        $error = $verification['error'];
                    } else {
                        // Paksa user booking sesuai user yang sudah diverifikasi.
                        $user_id = (int)$verification['user_id'];
                    }
                }

                if ($user_id <= 0 || $room_id <= 0 || $start === '' || $end === '') {
                    $error = 'Semua field wajib diisi.';
                } elseif (!$error) {
                    $stmt = $pdo->prepare("
                        SELECT id
                        FROM users
                        WHERE id = :id
                        AND role = 'user'
                        AND owner_admin_id = :owner_admin_id
                        LIMIT 1
                    ");
                    $stmt->execute([
                        ':id' => $user_id,
                        ':owner_admin_id' => $user['id'],
                    ]);
                    if (!$stmt->fetch()) {
                        $error = 'User tidak valid untuk admin yang sedang login.';
                    }
                }

                if (!$error) {
                    $stmt = $pdo->prepare("
                        SELECT id
                        FROM rooms
                        WHERE id = :id
                        AND owner_admin_id = :owner_admin_id
                        LIMIT 1
                    ");
                    $stmt->execute([
                        ':id' => $room_id,
                        ':owner_admin_id' => $user['id'],
                    ]);
                    if (!$stmt->fetch()) {
                        $error = 'Room tidak valid untuk admin yang sedang login.';
                    }
                }

                if (!$error && strtotime($end) <= strtotime($start)) {
                    $error = 'Waktu selesai harus lebih besar dari waktu mulai.';
                } elseif (!$error && !is_room_available($pdo, $room_id, $start, $end)) {
                    $error = 'Room sudah terbooking pada waktu tersebut.';
                } elseif (!$error) {
                    try {
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
                    } catch (Exception $e) {
                        $error = 'Gagal membuat booking: ' . $e->getMessage();
                    }
                }
            } 
            elseif ($action === 'edit') {
                // EDIT BOOKING - TANPA PENGE CEKAN KETERSEDIAAN ROOM
                $booking_id = (int)($_POST['booking_id'] ?? 0);
                $user_id = (int)($_POST['edit_user_id'] ?? 0);
                $room_id = (int)($_POST['edit_room_id'] ?? 0);
                $start = normalize_datetime($_POST['edit_start_time'] ?? '');
                $end = normalize_datetime($_POST['edit_end_time'] ?? '');
                $purpose = trim($_POST['edit_purpose'] ?? '');

                if ($booking_id <= 0) {
                    $error = 'ID booking tidak valid.';
                } elseif ($user_id <= 0 || $room_id <= 0 || $start === '' || $end === '') {
                    $error = 'Semua field wajib diisi.';
                } elseif (strtotime($end) <= strtotime($start)) {
                    $error = 'Waktu selesai harus lebih besar dari waktu mulai.';
                } else {
                    try {
                        // Cek apakah booking milik admin ini
                        $stmt = $pdo->prepare("SELECT id FROM bookings WHERE id = :id AND admin_id = :admin_id");
                        $stmt->execute([':id' => $booking_id, ':admin_id' => $user['id']]);
                        
                        if ($stmt->fetch()) {
                            // UPDATE tanpa kolom updated_at (karena tidak ada di tabel)
                            $stmt = $pdo->prepare("
                                UPDATE bookings 
                                SET user_id = :user_id, 
                                    room_id = :room_id, 
                                    start_time = :start_time, 
                                    end_time = :end_time, 
                                    purpose = :purpose
                                WHERE id = :id
                            ");
                            $stmt->execute([
                                ':user_id' => $user_id,
                                ':room_id' => $room_id,
                                ':start_time' => $start,
                                ':end_time' => $end,
                                ':purpose' => $purpose,
                                ':id' => $booking_id
                            ]);
                            
                            $notice = 'Booking berhasil diperbarui.';
                        } else {
                            $error = 'Booking tidak ditemukan atau tidak memiliki akses.';
                        }
                    } catch (Exception $e) {
                        $error = 'Gagal memperbarui booking: ' . $e->getMessage();
                    }
                }
            }
            elseif ($action === 'delete') {
                $booking_id = (int)($_POST['booking_id'] ?? 0);
                
                if ($booking_id > 0) {
                    try {
                        // Cek apakah booking milik admin ini
                        $stmt = $pdo->prepare("SELECT id FROM bookings WHERE id = :id AND admin_id = :admin_id");
                        $stmt->execute([':id' => $booking_id, ':admin_id' => $user['id']]);
                        
                        if ($stmt->fetch()) {
                            // Hapus booking
                            $stmt = $pdo->prepare("DELETE FROM bookings WHERE id = :id");
                            $stmt->execute([':id' => $booking_id]);
                            $notice = 'Booking berhasil dihapus.';
                        } else {
                            $error = 'Booking tidak ditemukan atau tidak memiliki akses.';
                        }
                    } catch (Exception $e) {
                        $error = 'Gagal menghapus booking: ' . $e->getMessage();
                    }
                }
            }
            
            // Jika AJAX request, kembalikan JSON response
            if ($isAjax) {
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => !$error,
                    'notice' => $notice,
                    'error' => $error
                ]);
                exit;
            }
            
            // Simpan ke session untuk ditampilkan setelah redirect
            if ($notice) {
                $_SESSION['notice'] = $notice;
            }
            if ($error) {
                $_SESSION['error'] = $error;
            }
            
            header('Location: ' . $_SERVER['REQUEST_URI']);
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

        // Get users and rooms for dropdowns
        $stmt = $pdo->prepare("SELECT id, name FROM users WHERE role = 'user' AND owner_admin_id = :owner_admin_id ORDER BY name ASC");
        $stmt->execute([':owner_admin_id' => $user['id']]);
        $users = $stmt->fetchAll();
        
        $rooms = Room::availableByOwner($pdo, (int)$user['id']);

        // Get all bookings for this admin
        if ($user['role'] === 'superadmin') {
            $bookings = Booking::all($pdo);
        } else {
            $bookings = Booking::byAdmin($pdo, (int)$user['id']);
        }

        // Calculate status for each booking
        $now = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
        
        foreach ($bookings as &$booking) {
            try {
                $start = new DateTime($booking['start_time'], new DateTimeZone('Asia/Jakarta'));
                $end = new DateTime($booking['end_time'], new DateTimeZone('Asia/Jakarta'));
                
                if ($now > $end) {
                    $booking['status_override'] = 'completed';
                } elseif ($now >= $start && $now <= $end) {
                    $booking['status_override'] = 'ongoing';
                } else {
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
