<?php

class UserController {
    public static function dashboard(): void {
        require_login();
        global $pdo;
        refresh_user($pdo);
        $user = current_user();

        $my_bookings = Booking::byUser($pdo, (int)$user['id'], (int)$user['owner_admin_id']);
        $rooms = Room::availableByOwner($pdo, (int)$user['owner_admin_id']);

        render_view('user/dashboard', [
            'user' => $user,
            'my_bookings' => $my_bookings,
            'rooms' => $rooms,
        ], 'Dashboard User');
    }

    public static function booking(): void {
        require_login();
        global $pdo;
        refresh_user($pdo);
        $user = current_user();

        $notice = null;
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $room_id = (int)($_POST['room_id'] ?? 0);
            $start = normalize_datetime($_POST['start_time'] ?? '');
            $end = normalize_datetime($_POST['end_time'] ?? '');
            $purpose = trim($_POST['purpose'] ?? '');

            if ($room_id <= 0 || $start === '' || $end === '') {
                $error = 'Semua field wajib diisi.';
            } elseif (strtotime($end) <= strtotime($start)) {
                $error = 'Waktu selesai harus lebih besar dari waktu mulai.';
            } elseif (!is_room_available($pdo, $room_id, $start, $end)) {
                $error = 'Room sudah terbooking pada waktu tersebut.';
            } else {
                Booking::create($pdo, [
                    'admin_id' => $user['owner_admin_id'],
                    'user_id' => $user['id'],
                    'room_id' => $room_id,
                    'start_time' => $start,
                    'end_time' => $end,
                    'purpose' => $purpose,
                    'created_at' => now_iso(),
                ]);
                $notice = 'Booking berhasil dibuat.';
            }
        }

        $rooms = Room::availableByOwner($pdo, (int)$user['owner_admin_id']);

        render_view('user/booking', [
            'notice' => $notice,
            'error' => $error,
            'rooms' => $rooms,
        ], 'Booking User');
    }
}
