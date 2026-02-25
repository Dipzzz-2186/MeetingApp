<?php

class Booking {
    private static function decodeRoomNames(array $rows): array {
        foreach ($rows as &$row) {
            if (isset($row['room_name'])) {
                $row['room_name'] = Room::decodeStoredName($row['room_name']);
            }
        }
        unset($row);
        return $rows;
    }

    public static function create(PDO $pdo, array $data): void {
        $stmt = $pdo->prepare('INSERT INTO bookings (admin_id, user_id, room_id, start_time, end_time, purpose, created_at)
            VALUES (:admin_id, :user_id, :room_id, :start_time, :end_time, :purpose, :created_at)');
        $stmt->execute([
            ':admin_id' => $data['admin_id'],
            ':user_id' => $data['user_id'],
            ':room_id' => $data['room_id'],
            ':start_time' => $data['start_time'],
            ':end_time' => $data['end_time'],
            ':purpose' => $data['purpose'],
            ':created_at' => $data['created_at'],
        ]);
    }

    public static function byAdmin(PDO $pdo, int $adminId): array {
        $stmt = $pdo->prepare('SELECT bookings.*, rooms.name AS room_name, users.name AS user_name
            FROM bookings
            JOIN rooms ON rooms.id = bookings.room_id
            JOIN users ON users.id = bookings.user_id
            WHERE bookings.admin_id = :admin_id
            ORDER BY start_time DESC');
        $stmt->execute([':admin_id' => $adminId]);
        return self::decodeRoomNames($stmt->fetchAll());
    }

    public static function recentByAdmin(PDO $pdo, int $adminId, int $limit = 5): array {
        $stmt = $pdo->prepare('SELECT bookings.*, rooms.name AS room_name, users.name AS user_name
            FROM bookings
            JOIN rooms ON rooms.id = bookings.room_id
            JOIN users ON users.id = bookings.user_id
            WHERE bookings.admin_id = :admin_id
            ORDER BY start_time DESC
            LIMIT ' . (int)$limit);
        $stmt->execute([':admin_id' => $adminId]);
        return self::decodeRoomNames($stmt->fetchAll());
    }

    public static function byUser(PDO $pdo, int $userId, int $adminId): array {
        $stmt = $pdo->prepare('SELECT bookings.*, rooms.name AS room_name
            FROM bookings
            JOIN rooms ON rooms.id = bookings.room_id
            WHERE bookings.user_id = :uid AND bookings.admin_id = :admin_id
            ORDER BY start_time DESC');
        $stmt->execute([':uid' => $userId, ':admin_id' => $adminId]);
        return self::decodeRoomNames($stmt->fetchAll());
    }
    
    public static function getAllByAdmin(PDO $pdo, int $adminId): array
    {
        $stmt = $pdo->prepare("
            SELECT 
                b.id,
                b.start_time,
                b.end_time,
                u.name AS booked_by,
                r.name AS room_name
            FROM bookings b
            JOIN users u ON u.id = b.user_id
            JOIN rooms r ON r.id = b.room_id
            WHERE b.admin_id = :admin_id
            ORDER BY b.start_time ASC
        ");
        $stmt->execute([
            ':admin_id' => $adminId
        ]);
        return self::decodeRoomNames($stmt->fetchAll());
    }
    
    public static function all(PDO $pdo): array {
        $rows = $pdo->query("
            SELECT b.*, r.name AS room_name, u.name AS user_name
            FROM bookings b
            JOIN rooms r ON r.id = b.room_id
            JOIN users u ON u.id = b.user_id
            ORDER BY b.start_time DESC
        ")->fetchAll();
        return self::decodeRoomNames($rows);
    }
}
