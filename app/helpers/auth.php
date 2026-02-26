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
        'owner_admin_name' => $user['owner_admin_name'] ?? null,
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

    $stmt = $pdo->prepare("
        SELECT 
            u.*,
            admin.name AS owner_admin_name
        FROM users u
        LEFT JOIN users admin ON admin.id = u.owner_admin_id
        WHERE u.id = :id
        LIMIT 1
    ");
    $stmt->execute([
        ':id' => $_SESSION['user']['id']
    ]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        login_user($user);
    }
}

function user_owner_admin_block_reason(PDO $pdo, array $user): ?string {
    if (($user['role'] ?? '') !== 'user') {
        return null;
    }

    $ownerAdminId = (int)($user['owner_admin_id'] ?? 0);
    if ($ownerAdminId <= 0) {
        return 'Akses ditolak. Akun Anda tidak terhubung ke admin aktif.';
    }

    $stmt = $pdo->prepare("
        SELECT id, name, role, plan_type, trial_end, paid_until
        FROM users
        WHERE id = :id
        LIMIT 1
    ");
    $stmt->execute([':id' => $ownerAdminId]);
    $ownerAdmin = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$ownerAdmin || ($ownerAdmin['role'] ?? '') !== 'admin') {
        return 'Akses ditolak. Admin pemilik akun tidak ditemukan.';
    }

    if (admin_plan_blocked($ownerAdmin)) {
        $ownerName = trim((string)($ownerAdmin['name'] ?? 'admin'));
        return 'Akses ditolak. Masa aktif admin ' . $ownerName . ' sudah habis.';
    }

    return null;
}

function user_owner_admin_plan_end_epoch(PDO $pdo, array $user): ?int {
    if (($user['role'] ?? '') !== 'user') {
        return null;
    }

    $ownerAdminId = (int)($user['owner_admin_id'] ?? 0);
    if ($ownerAdminId <= 0) {
        return null;
    }

    $stmt = $pdo->prepare("
        SELECT id, role, plan_type, trial_end, paid_until
        FROM users
        WHERE id = :id
        LIMIT 1
    ");
    $stmt->execute([':id' => $ownerAdminId]);
    $ownerAdmin = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$ownerAdmin || ($ownerAdmin['role'] ?? '') !== 'admin') {
        return null;
    }

    return admin_plan_end_epoch($ownerAdmin);
}


function require_login(): void {
    global $pdo;
    if ($pdo && current_user()) {
        refresh_user($pdo);
    }
    $user = current_user();
    if (!$user) {
        header('Location: /login');
        exit;
    }
    if ($pdo && ($user['role'] ?? '') === 'user') {
        $blockedReason = user_owner_admin_block_reason($pdo, $user);
        if ($blockedReason !== null) {
            unset($_SESSION['user']);
            $_SESSION['auth_error'] = $blockedReason;
            header('Location: /login');
            exit;
        }
    }
}

function require_admin(): void {
    require_login();
    if (current_user()['role'] !== 'admin') {
        header('Location: /dashboard_user');
        exit;
    }
}

function require_superadmin(): void {
    require_login();
    if (current_user()['role'] !== 'superadmin') {
        http_response_code(403);
        exit('Forbidden');
    }
}

function admin_plan_blocked(array $user): bool {
    if (($user['role'] ?? '') !== 'admin') {
        return false;
    }
    $endEpoch = admin_plan_end_epoch($user);
    if ($endEpoch === null) {
        return true;
    }
    return $endEpoch <= time();
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

function admin_plan_end_epoch(array $user): ?int {
    if (($user['role'] ?? '') !== 'admin') {
        return null;
    }

    $tz = new DateTimeZone('Asia/Jakarta');
    if (($user['plan_type'] ?? '') === 'trial') {
        if (empty($user['trial_end'])) {
            return null;
        }
        try {
            return (new DateTime((string)$user['trial_end'], $tz))->getTimestamp();
        } catch (Exception $e) {
            return null;
        }
    }

    if (($user['plan_type'] ?? '') === 'permanent') {
        if (empty($user['paid_until'])) {
            return null;
        }
        try {
            return (new DateTime((string)$user['paid_until'], $tz))->getTimestamp();
        } catch (Exception $e) {
            return null;
        }
    }

    return null;
}
