<?php
require_once __DIR__ . '/../config/db.php';

$dsn = "mysql:host={$DB_HOST};dbname={$DB_NAME};charset=utf8mb4";
$pdo = new PDO($dsn, $DB_USER, $DB_PASS, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);

function now_iso(): string {
    return date('Y-m-d H:i:s');
}

function normalize_datetime(string $value): string {
    // Convert "YYYY-MM-DDTHH:MM" to "YYYY-MM-DD HH:MM:SS"
    $value = trim($value);
    if (strpos($value, 'T') !== false) {
        $value = str_replace('T', ' ', $value);
    }
    if (strlen($value) === 16) {
        $value .= ':00';
    }
    return $value;
}

function is_room_available(PDO $pdo, int $roomId, string $start, string $end): bool {
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM bookings
        WHERE room_id = :room_id
          AND NOT (end_time <= :start_time OR start_time >= :end_time)');
    $stmt->execute([
        ':room_id' => $roomId,
        ':start_time' => $start,
        ':end_time' => $end,
    ]);
    return (int)$stmt->fetchColumn() === 0;
}
