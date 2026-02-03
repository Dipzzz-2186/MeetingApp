<?php

class User {
    public static function findByEmail(PDO $pdo, string $email): ?array {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();
        return $user ?: null;
    }

    public static function findById(PDO $pdo, int $id): ?array {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $user = $stmt->fetch();
        return $user ?: null;
    }

    public static function createAdmin(PDO $pdo, array $data): int {
        $stmt = $pdo->prepare('INSERT INTO users (name, email, password_hash, role, plan_type, trial_end, paid_until, created_at)
            VALUES (:name, :email, :password_hash, :role, :plan_type, :trial_end, :paid_until, :created_at)');
        $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':password_hash' => $data['password_hash'],
            ':role' => 'admin',
            ':plan_type' => $data['plan_type'],
            ':trial_end' => $data['trial_end'],
            ':paid_until' => $data['paid_until'],
            ':created_at' => $data['created_at'],
        ]);
        return (int)$pdo->lastInsertId();
    }

    public static function setOwnerAdmin(PDO $pdo, int $userId, int $ownerAdminId): void {
        $stmt = $pdo->prepare('UPDATE users SET owner_admin_id = :owner_admin_id WHERE id = :id');
        $stmt->execute([':owner_admin_id' => $ownerAdminId, ':id' => $userId]);
    }

    public static function createUser(PDO $pdo, array $data): void {
        $stmt = $pdo->prepare('INSERT INTO users (owner_admin_id, name, email, password_hash, role, created_at)
            VALUES (:owner_admin_id, :name, :email, :password_hash, :role, :created_at)');
        $stmt->execute([
            ':owner_admin_id' => $data['owner_admin_id'],
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':password_hash' => $data['password_hash'],
            ':role' => 'user',
            ':created_at' => $data['created_at'],
        ]);
    }

    public static function usersByOwner(PDO $pdo, int $ownerAdminId): array {
        $stmt = $pdo->prepare("SELECT id, name, email, role FROM users WHERE owner_admin_id = :owner_admin_id AND role = 'user' ORDER BY id DESC");
        $stmt->execute([':owner_admin_id' => $ownerAdminId]);
        return $stmt->fetchAll();
    }

    public static function updatePlanPaidUntil(PDO $pdo, int $userId, string $paidUntil): void {
        $stmt = $pdo->prepare('UPDATE users SET plan_type = "permanent", paid_until = :paid_until WHERE id = :id');
        $stmt->execute([':paid_until' => $paidUntil, ':id' => $userId]);
    }

    public static function updatePlanTrialReset(PDO $pdo, int $userId, string $trialEnd): void {
        $stmt = $pdo->prepare('UPDATE users SET plan_type = "trial", trial_end = :trial_end, paid_until = NULL WHERE id = :id');
        $stmt->execute([':trial_end' => $trialEnd, ':id' => $userId]);
    }
}
