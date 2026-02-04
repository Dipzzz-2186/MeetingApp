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

        // =====================
        // AJAX GET BOOKING (DETAIL / EDIT)
        // =====================
        if (isset($_GET['ajax']) && $_GET['ajax'] === 'get_booking') {
            $booking_id = (int)($_GET['booking_id'] ?? 0);

            if ($booking_id > 0) {
                $stmt = $pdo->prepare("
                    SELECT 
                        b.*,
                        r.name AS room_name,
                        r.capacity AS room_capacity
                    FROM bookings b
                    JOIN rooms r ON b.room_id = r.id
                    WHERE b.id = :id
                    AND b.user_id = :user_id
                    AND b.admin_id = :admin_id
                ");
                $stmt->execute([
                    ':id' => $booking_id,
                    ':user_id' => $user['id'],
                    ':admin_id' => $user['owner_admin_id'],
                ]);

                $booking = $stmt->fetch();

                if ($booking) {
                    $booking['start_time_formatted'] =
                        (new DateTime($booking['start_time']))->format('Y-m-d\TH:i');
                    $booking['end_time_formatted'] =
                        (new DateTime($booking['end_time']))->format('Y-m-d\TH:i');

                    // USER TIDAK PERLU user_name DARI DB
                    $booking['user_name'] = $user['name'];
                    $booking['user_email'] = $user['email'];

                    header('Content-Type: application/json');
                    echo json_encode($booking);
                    exit;
                }
            }

            header('Content-Type: application/json');
            echo json_encode(['error' => 'Booking tidak ditemukan']);
            exit;
        }


        $error = null;

        // =====================
        // POST (CREATE / EDIT / DELETE)
        // =====================
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';

            $isAjax = isset($_POST['ajax']) ||
                (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest');

            $notice = null;
            $error  = null;

            // =====================
            // CREATE
            // =====================
            if ($action === 'create') {
                $room_id = (int)($_POST['room_id'] ?? 0);
                $start   = normalize_datetime($_POST['start_time'] ?? '');
                $end     = normalize_datetime($_POST['end_time'] ?? '');
                $purpose = trim($_POST['purpose'] ?? '');

                if ($room_id <= 0 || !$start || !$end) {
                    $error = 'Semua field wajib diisi.';
                } elseif (strtotime($end) <= strtotime($start)) {
                    $error = 'Waktu tidak valid.';
                } elseif (!is_room_available($pdo, $room_id, $start, $end)) {
                    $error = 'Room sudah terbooking.';
                } else {
                    Booking::create($pdo, [
                        'admin_id'   => $user['owner_admin_id'],
                        'user_id'    => $user['id'],
                        'room_id'    => $room_id,
                        'start_time' => $start,
                        'end_time'   => $end,
                        'purpose'    => $purpose,
                        'created_at' => now_iso(),
                    ]);
                    $notice = 'Booking berhasil dibuat.';
                }
            }

            // =====================
            // EDIT
            // =====================
            elseif ($action === 'edit') {
                $booking_id = (int)($_POST['booking_id'] ?? 0);
                $room_id    = (int)($_POST['edit_room_id'] ?? 0);
                $start      = normalize_datetime($_POST['edit_start_time'] ?? '');
                $end        = normalize_datetime($_POST['edit_end_time'] ?? '');
                $purpose    = trim($_POST['edit_purpose'] ?? '');

                if ($booking_id <= 0 || $room_id <= 0 || !$start || !$end) {
                    $error = 'Data tidak lengkap.';
                } elseif (strtotime($end) <= strtotime($start)) {
                    $error = 'Waktu tidak valid.';
                } else {
                    $stmt = $pdo->prepare("
                        UPDATE bookings
                        SET room_id = :room_id,
                            start_time = :start_time,
                            end_time = :end_time,
                            purpose = :purpose
                        WHERE id = :id
                        AND user_id = :user_id
                        AND admin_id = :admin_id
                    ");
                    $stmt->execute([
                        ':room_id'   => $room_id,
                        ':start_time' => $start,
                        ':end_time'  => $end,
                        ':purpose'   => $purpose,
                        ':id'        => $booking_id,
                        ':user_id'   => $user['id'],
                        ':admin_id'  => $user['owner_admin_id'],
                    ]);
                    $notice = 'Booking berhasil diperbarui.';
                }
            }

            // =====================
            // DELETE
            // =====================
            elseif ($action === 'delete') {
                $booking_id = (int)($_POST['booking_id'] ?? 0);

                if ($booking_id <= 0) {
                    $error = 'Booking tidak valid.';
                } else {
                    $stmt = $pdo->prepare("
                        DELETE FROM bookings
                        WHERE id = :id
                        AND user_id = :user_id
                        AND admin_id = :admin_id
                    ");
                    $stmt->execute([
                        ':id' => $booking_id,
                        ':user_id' => $user['id'],
                        ':admin_id' => $user['owner_admin_id'],
                    ]);
                    $notice = 'Booking berhasil dihapus.';
                }
            }

            // =====================
            // RESPONSE
            // =====================
            if ($isAjax) {
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => $error === null,
                    'notice'  => $notice,
                    'error'   => $error
                ]);
                exit;
            }

            $_SESSION['notice'] = $notice;
            $_SESSION['error']  = $error;
            header('Location: /booking_user');
            exit;
        }

        // =====================
        // GET (AFTER REDIRECT)
        // =====================
        $notice = $_SESSION['notice'] ?? null;
        unset($_SESSION['notice']);

        $bookings = Booking::byUser(
            $pdo,
            (int)$user['id'],
            (int)$user['owner_admin_id']
        );

        $rooms = Room::availableByOwner(
            $pdo,
            (int)$user['owner_admin_id']
        );

        render_view('user/booking', [
            'user'     => $user,
            'notice'   => $notice,
            'error'    => $error,
            'rooms'    => $rooms,
            'bookings' => $bookings,
        ], 'Booking User');
    }
}
