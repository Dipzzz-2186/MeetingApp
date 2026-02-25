<?php

class Room {
    public static function encodeNameForOwner(string $name, int $ownerAdminId): string {
        // Nama room disimpan apa adanya; owner dipisahkan lewat kolom owner_admin_id.
        return self::decodeStoredName(trim($name));
    }

    public static function decodeStoredName(?string $storedName): string {
        $value = trim((string)$storedName);
        if ($value === '') {
            return '';
        }
        // Kompatibilitas data lama yang terlanjur pakai suffix internal (_adm_ / __adm_).
        return preg_replace('/(?:__adm_|_adm_)\d+$/', '', $value) ?? $value;
    }

    public static function create(PDO $pdo, array $data): void {
        $stmt = $pdo->prepare('INSERT INTO rooms (owner_admin_id, name, capacity, wallpaper_url, created_at)
            VALUES (:owner_admin_id, :name, :capacity, :wallpaper_url, :created_at)');
        $stmt->execute([
            ':owner_admin_id' => $data['owner_admin_id'],
            ':name' => $data['name'],
            ':capacity' => $data['capacity'],
            ':wallpaper_url' => $data['wallpaper_url'] ?? null,
            ':created_at' => $data['created_at'],
        ]);
    }

    public static function allByOwner(PDO $pdo, int $ownerAdminId): array {
        $stmt = $pdo->prepare('SELECT * FROM rooms WHERE owner_admin_id = :owner_admin_id ORDER BY id DESC');
        $stmt->execute([':owner_admin_id' => $ownerAdminId]);
        $rows = $stmt->fetchAll();
        foreach ($rows as &$row) {
            $row['name'] = self::decodeStoredName($row['name'] ?? '');
        }
        unset($row);
        return $rows;
    }

    public static function availableByOwner(PDO $pdo, int $ownerAdminId): array {
        $stmt = $pdo->prepare('SELECT * FROM rooms WHERE owner_admin_id = :owner_admin_id ORDER BY name ASC');
        $stmt->execute([':owner_admin_id' => $ownerAdminId]);
        $rows = $stmt->fetchAll();
        foreach ($rows as &$row) {
            $row['name'] = self::decodeStoredName($row['name'] ?? '');
        }
        unset($row);
        return $rows;
    }
}
