<?php
require_once __DIR__ . '/db.php';

session_start();

function current_user(): ?array {
    return $_SESSION['user'] ?? null;
}

function login_user(array $user): void {
    $_SESSION['user'] = [
        'id' => $user['id'],
        'owner_admin_id' => $user['owner_admin_id'] ?? null,
        'name' => $user['name'],
        'email' => $user['email'],
        'role' => $user['role'],
        'plan_type' => $user['plan_type'],
        'trial_end' => $user['trial_end'],
        'paid_until' => $user['paid_until'],
    ];
}

function refresh_user(PDO $pdo): void {
    if (!isset($_SESSION['user']['id'])) {
        return;
    }
    $stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id');
    $stmt->execute([':id' => $_SESSION['user']['id']]);
    $user = $stmt->fetch();
    if ($user) {
        login_user($user);
    }
}

function require_login(): void {
    if (!current_user()) {
        header('Location: /login');
        exit;
    }
}

function require_admin(): void {
    require_login();
    if (current_user()['role'] !== 'admin') {
        header('Location: /dashboard_user');
        exit;
    }
}

function admin_plan_blocked(array $user): bool {
    if ($user['role'] !== 'admin') {
        return false;
    }
    if ($user['plan_type'] === 'permanent') {
        if (!$user['paid_until']) {
            return true;
        }
        return strtotime($user['paid_until']) < time();
    }
    if ($user['plan_type'] === 'trial') {
        if (!$user['trial_end']) {
            return true;
        }
        return strtotime($user['trial_end']) < time();
    }
    return true;
}

function admin_plan_message(array $user): ?string {
    if ($user['role'] !== 'admin') {
        return null;
    }
    if ($user['plan_type'] === 'trial') {
        return 'Trial berakhir pada ' . date('d M Y H:i', strtotime($user['trial_end']));
    }
    if ($user['plan_type'] === 'permanent') {
        return 'Pembayaran aktif sampai ' . date('d M Y H:i', strtotime($user['paid_until']));
    }
    return null;
}
