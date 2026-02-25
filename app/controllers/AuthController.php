<?php

class AuthController {
    private static function registerPaymentMethodLabel(string $method): string {
        $map = [
            'bank_va' => 'Virtual Account',
            'qris' => 'QRIS',
            'ewallet' => 'E-Wallet',
            'card' => 'Kartu Kredit/Debit',
        ];

        return $map[$method] ?? 'Virtual Account';
    }

    private static function setPendingRegisterPayment(array $payload): void {
        $_SESSION['register_payment_pending'] = $payload;
    }

    private static function getPendingRegisterPayment(): ?array {
        $pending = $_SESSION['register_payment_pending'] ?? null;
        return is_array($pending) ? $pending : null;
    }

    private static function clearPendingRegisterPayment(): void {
        unset($_SESSION['register_payment_pending']);
    }

    public static function login(): void {
        if (current_user()) {
            switch (current_user()['role']) {
                case 'superadmin':
                    $target = '/dashboard_superadmin';
                    break;
                case 'admin':
                    $target = '/dashboard_admin';
                    break;
                default:
                    $target = '/dashboard_user';
            }
            header('Location: ' . $target);
            exit;
        }

        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            global $pdo;
            $user = User::findByEmail($pdo, $email);

            if ($user && password_verify($password, $user['password_hash'])) {
                login_user($user);

                switch ($user['role']) {
                    case 'superadmin':
                        $target = '/dashboard_superadmin';
                        break;
                    case 'admin':
                        $target = '/dashboard_admin';
                        break;
                    default:
                        $target = '/dashboard_user';
                }

                header('Location: ' . $target);
                exit;
            }
            $error = 'Email atau password salah.';
        }

        render_view('auth/login', ['error' => $error], 'Login', 'auth');
    }

    public static function register(): void {
        $success = null;
        $error = $_SESSION['register_error'] ?? null;
        unset($_SESSION['register_error']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $plan_type = $_POST['plan_type'] ?? 'trial';
            if (!in_array($plan_type, ['trial', 'permanent'], true)) {
                $plan_type = 'trial';
            }
            $go_gateway = ($_POST['go_gateway'] ?? '0') === '1';
            $terms = ($_POST['terms'] ?? '0') === '1';

            if ($name === '' || $email === '' || $password === '') {
                $error = 'Semua field wajib diisi.';
            } elseif (!$terms) {
                $error = 'Anda harus menyetujui Syarat & Ketentuan.';
            } elseif ($plan_type === 'permanent' && !$go_gateway) {
                $error = 'Untuk paket berbayar, klik tombol "Lanjut ke Checkout (aktif 30 hari)".';
            } elseif ($plan_type === 'permanent') {
                self::setPendingRegisterPayment([
                    'name' => $name,
                    'email' => $email,
                    'password_hash' => password_hash($password, PASSWORD_DEFAULT),
                    'amount' => 95000,
                    'days' => 30,
                    'payment_method' => 'bank_va',
                    'created_at' => time(),
                ]);
                header('Location: /register/checkout');
                exit;
            } else {
                $trial_end = null;
                $paid_until = null;
                $trial_end = date('Y-m-d H:i:s', strtotime('+10 days'));

                try {
                    global $pdo;
                    $admin_id = User::createAdmin($pdo, [
                        'name' => $name,
                        'email' => $email,
                        'password_hash' => password_hash($password, PASSWORD_DEFAULT),
                        'plan_type' => $plan_type,
                        'trial_end' => $trial_end,
                        'paid_until' => $paid_until,
                        'created_at' => now_iso(),
                    ]);
                    User::setOwnerAdmin($pdo, $admin_id, $admin_id);
                    header('Location: /login');
                    exit;
                } catch (PDOException $e) {
                    $error = 'Gagal register. Pastikan email belum terpakai.';
                }
            }
        }

        render_view('auth/register', ['success' => $success, 'error' => $error], 'Register Admin', 'auth');
    }

    public static function registerCheckout(): void {
        $pending = self::getPendingRegisterPayment();
        if (!$pending) {
            $_SESSION['register_error'] = 'Data checkout register tidak ditemukan.';
            header('Location: /register');
            exit;
        }

        if ((int)($pending['created_at'] ?? 0) < (time() - 3600)) {
            self::clearPendingRegisterPayment();
            $_SESSION['register_error'] = 'Sesi checkout sudah kadaluarsa. Silakan ulangi register.';
            header('Location: /register');
            exit;
        }

        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $method = trim($_POST['payment_method'] ?? '');
            $allowedMethods = ['bank_va', 'qris', 'ewallet', 'card'];
            if (!in_array($method, $allowedMethods, true)) {
                $error = 'Metode pembayaran tidak valid.';
            } else {
                $pending['payment_method'] = $method;
                self::setPendingRegisterPayment($pending);
                header('Location: /register/pay');
                exit;
            }
        }

        render_view('auth/register_checkout', [
            'pending' => $pending,
            'error' => $error,
            'method_label' => self::registerPaymentMethodLabel((string)($pending['payment_method'] ?? 'bank_va')),
        ], 'Checkout Register', 'auth');
    }

    public static function registerPay(): void {
        $pending = self::getPendingRegisterPayment();
        if (!$pending) {
            $_SESSION['register_error'] = 'Data pembayaran register tidak ditemukan.';
            header('Location: /register');
            exit;
        }

        if ((int)($pending['created_at'] ?? 0) < (time() - 3600)) {
            self::clearPendingRegisterPayment();
            $_SESSION['register_error'] = 'Sesi pembayaran sudah kadaluarsa. Silakan ulangi register.';
            header('Location: /register');
            exit;
        }

        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';
            if ($action === 'cancel') {
                self::clearPendingRegisterPayment();
                $_SESSION['register_error'] = 'Pembayaran dibatalkan. Silakan pilih paket kembali.';
                header('Location: /register');
                exit;
            }

            if ($action === 'confirm') {
                try {
                    global $pdo;
                    $paid_until = date('Y-m-d H:i:s', strtotime('+30 days'));
                    $admin_id = User::createAdmin($pdo, [
                        'name' => (string)$pending['name'],
                        'email' => (string)$pending['email'],
                        'password_hash' => (string)$pending['password_hash'],
                        'plan_type' => 'permanent',
                        'trial_end' => null,
                        'paid_until' => $paid_until,
                        'created_at' => now_iso(),
                    ]);
                    User::setOwnerAdmin($pdo, $admin_id, $admin_id);
                    self::clearPendingRegisterPayment();
                    header('Location: /login');
                    exit;
                } catch (PDOException $e) {
                    $error = 'Gagal menyelesaikan pembayaran. Email mungkin sudah dipakai.';
                }
            }
        }

        render_view('auth/register_pay', [
            'error' => $error,
            'pending' => $pending,
            'method_label' => self::registerPaymentMethodLabel((string)($pending['payment_method'] ?? 'bank_va')),
        ], 'Payment Register', 'auth');
    }

    public static function logout(): void {
        session_destroy();
        header('Location: /login');
        exit;
    }
}
