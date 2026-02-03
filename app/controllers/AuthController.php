<?php

class AuthController {
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
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $plan_type = $_POST['plan_type'] ?? 'trial';
            $pay_now = ($_POST['pay_now'] ?? '0') === '1';

            if ($name === '' || $email === '' || $password === '') {
                $error = 'Semua field wajib diisi.';
            } else {
                $trial_end = null;
                $paid_until = null;
                if ($plan_type === 'trial') {
                    $trial_end = date('Y-m-d H:i:s', strtotime('+10 days'));
                } else {
                    if ($pay_now) {
                        $paid_until = date('Y-m-d H:i:s', strtotime('+30 days'));
                    }
                }

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

    public static function logout(): void {
        session_destroy();
        header('Location: /login');
        exit;
    }
}
