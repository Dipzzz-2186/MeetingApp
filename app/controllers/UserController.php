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

                    // User data
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
        $notice = null;

        // =====================
        // POST (CREATE / EDIT / DELETE)
        // =====================
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';

            $isAjax = isset($_POST['ajax']) ||
                (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest');

            // =====================
            // CREATE
            // =====================
            if ($action === 'create') {
                $room_id = (int)($_POST['room_id'] ?? 0);
                $start   = $_POST['start_time'] ?? '';
                $end     = $_POST['end_time'] ?? '';
                $purpose = trim($_POST['purpose'] ?? '');
                
                // Debug logging
                error_log("=== CREATE BOOKING ===");
                error_log("Room ID: $room_id");
                error_log("Start: $start");
                error_log("End: $end");
                error_log("Purpose: $purpose");
                error_log("User ID: " . $user['id']);
                error_log("Admin ID: " . $user['owner_admin_id']);

                // Validation
                if ($room_id <= 0) {
                    $error = 'Pilih room yang valid.';
                    error_log("Validation Error: Room ID invalid");
                } elseif (empty($start) || empty($end)) {
                    $error = 'Waktu mulai dan selesai wajib diisi.';
                    error_log("Validation Error: Time empty");
                } elseif (strtotime($end) <= strtotime($start)) {
                    $error = 'Waktu selesai harus setelah waktu mulai.';
                    error_log("Validation Error: End time <= Start time");
                } elseif (strtotime($start) < time()) {
                    $error = 'Tidak dapat membuat booking di waktu yang sudah lewat.';
                    error_log("Validation Error: Start time in past");
                } else {
                    // Convert datetime format
                    $start_time = date('Y-m-d H:i:s', strtotime($start));
                    $end_time = date('Y-m-d H:i:s', strtotime($end));
                    $created_at = date('Y-m-d H:i:s');
                    
                    error_log("Formatted Start: $start_time");
                    error_log("Formatted End: $end_time");
                    
                    // Check for overlapping bookings
                    $stmt = $pdo->prepare("
                        SELECT COUNT(*) as count 
                        FROM bookings 
                        WHERE room_id = :room_id 
                        AND (
                            (start_time < :end_time AND end_time > :start_time)
                        )
                    ");
                    $stmt->execute([
                        ':room_id' => $room_id,
                        ':start_time' => $start_time,
                        ':end_time' => $end_time
                    ]);
                    
                    $result = $stmt->fetch();
                    
                        try {
                            // Create booking
                            $bookingData = [
                                'admin_id'   => (int)$user['owner_admin_id'],
                                'user_id'    => (int)$user['id'],
                                'room_id'    => $room_id,
                                'start_time' => $start_time,
                                'end_time'   => $end_time,
                                'purpose'    => $purpose,
                                'created_at' => $created_at,
                            ];
                            
                            error_log("Attempting to create booking with data: " . json_encode($bookingData));
                            
                            // Use the existing create method
                            Booking::create($pdo, $bookingData);
                            
                            $notice = 'Booking berhasil dibuat!';
                            error_log("SUCCESS: Booking created successfully");
                            
                        } catch (PDOException $e) {
                            $error = 'Gagal membuat booking. Error: ' . $e->getMessage();
                            error_log("PDO Exception: " . $e->getMessage());
                            error_log("Error Code: " . $e->getCode());
                            error_log("SQL State: " . $e->errorInfo[0] ?? '');
                        } catch (Exception $e) {
                            $error = 'Terjadi kesalahan sistem.';
                            error_log("General Exception: " . $e->getMessage());
                        }
                }
            }

            // =====================
            // EDIT
            // =====================
            elseif ($action === 'edit') {
                $booking_id = (int)($_POST['booking_id'] ?? 0);
                $room_id    = (int)($_POST['edit_room_id'] ?? 0);
                $start      = $_POST['edit_start_time'] ?? '';
                $end        = $_POST['edit_end_time'] ?? '';
                $purpose    = trim($_POST['edit_purpose'] ?? '');

                if ($booking_id <= 0 || $room_id <= 0 || empty($start) || empty($end)) {
                    $error = 'Data tidak lengkap.';
                } elseif (strtotime($end) <= strtotime($start)) {
                    $error = 'Waktu tidak valid.';
                } else {
                    $start_time = date('Y-m-d H:i:s', strtotime($start));
                    $end_time = date('Y-m-d H:i:s', strtotime($end));
                    
                    // Check for overlapping bookings (excluding current)
                    $stmt = $pdo->prepare("
                        SELECT COUNT(*) as count 
                        FROM bookings 
                        WHERE room_id = :room_id 
                        AND id != :booking_id
                        AND (
                            (start_time < :end_time AND end_time > :start_time)
                        )
                    ");
                    $stmt->execute([
                        ':room_id' => $room_id,
                        ':booking_id' => $booking_id,
                        ':start_time' => $start_time,
                        ':end_time' => $end_time
                    ]);
                    
                    $result = $stmt->fetch();
                    
                        try {
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
                                ':start_time' => $start_time,
                                ':end_time'  => $end_time,
                                ':purpose'   => $purpose,
                                ':id'        => $booking_id,
                                ':user_id'   => $user['id'],
                                ':admin_id'  => $user['owner_admin_id'],
                            ]);
                            
                            if ($stmt->rowCount() > 0) {
                                $notice = 'Booking berhasil diperbarui.';
                            } else {
                                $error = 'Gagal memperbarui booking atau booking tidak ditemukan.';
                            }
                        } catch (PDOException $e) {
                            $error = 'Gagal memperbarui booking. Error: ' . $e->getMessage();
                        }
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
                    try {
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
                        
                        if ($stmt->rowCount() > 0) {
                            $notice = 'Booking berhasil dihapus.';
                        } else {
                            $error = 'Gagal menghapus booking atau booking tidak ditemukan.';
                        }
                    } catch (PDOException $e) {
                        $error = 'Gagal menghapus booking. Error: ' . $e->getMessage();
                    }
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

            // Store in session for redirect
            if ($notice) {
                $_SESSION['notice'] = $notice;
            }
            if ($error) {
                $_SESSION['error'] = $error;
            }
            
            header('Location: /booking_user');
            exit;
        }

        // =====================
        // GET (AFTER REDIRECT)
        // =====================
        $notice = $_SESSION['notice'] ?? null;
        $error = $_SESSION['error'] ?? null;
        
        // Clear session messages
        unset($_SESSION['notice']);
        unset($_SESSION['error']);

        // Get bookings
        $bookings = Booking::byUser(
            $pdo,
            (int)$user['id'],
            (int)$user['owner_admin_id']
        );

        // Get rooms - using the correct method name
        $rooms = Room::availableByOwner(
            $pdo,
            (int)$user['owner_admin_id']
        );

        // Debug log untuk melihat data yang didapat
        error_log("=== RENDERING VIEW ===");
        error_log("User ID: " . $user['id']);
        error_log("Admin ID: " . $user['owner_admin_id']);
        error_log("Rooms count: " . count($rooms));
        error_log("Bookings count: " . count($bookings));

        render_view('user/booking', [
            'user'     => $user,
            'notice'   => $notice,
            'error'    => $error,
            'rooms'    => $rooms,
            'bookings' => $bookings,
        ], 'Booking User');
    }
}