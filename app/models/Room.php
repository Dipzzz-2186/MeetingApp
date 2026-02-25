<?php

class Room {
    private const INTERNAL_SUFFIX_PREFIX = '__adm_';

    public static function encodeNameForOwner(string $name, int $ownerAdminId): string {
        $clean = self::decodeStoredName(trim($name));
        return $clean . self::INTERNAL_SUFFIX_PREFIX . $ownerAdminId;
    }

    public static function decodeStoredName(?string $storedName): string {
        $value = trim((string)$storedName);
        if ($value === '') {
            return '';
        }
        return preg_replace('/' . preg_quote(self::INTERNAL_SUFFIX_PREFIX, '/') . '\d+$/', '', $value) ?? $value;
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
