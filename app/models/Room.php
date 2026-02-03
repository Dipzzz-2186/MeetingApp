<?php

class Room {
    public static function create(PDO $pdo, array $data): void {
        $stmt = $pdo->prepare('INSERT INTO rooms (owner_admin_id, name, capacity, created_at)
            VALUES (:owner_admin_id, :name, :capacity, :created_at)');
        $stmt->execute([
            ':owner_admin_id' => $data['owner_admin_id'],
            ':name' => $data['name'],
            ':capacity' => $data['capacity'],
            ':created_at' => $data['created_at'],
        ]);
    }

    public static function allByOwner(PDO $pdo, int $ownerAdminId): array {
        $stmt = $pdo->prepare('SELECT * FROM rooms WHERE owner_admin_id = :owner_admin_id ORDER BY id DESC');
        $stmt->execute([':owner_admin_id' => $ownerAdminId]);
        return $stmt->fetchAll();
    }

    public static function availableByOwner(PDO $pdo, int $ownerAdminId): array {
        $stmt = $pdo->prepare('SELECT * FROM rooms WHERE owner_admin_id = :owner_admin_id ORDER BY name ASC');
        $stmt->execute([':owner_admin_id' => $ownerAdminId]);
        return $stmt->fetchAll();
    }
}
