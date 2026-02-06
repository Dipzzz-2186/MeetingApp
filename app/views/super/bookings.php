<?php
/** @var array $bookings */

// Set timezone Indonesia
date_default_timezone_set('Asia/Jakarta');

// Get current page from URL parameter
$currentPage = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$itemsPerPage = 10;

// Calculate total pages
$totalBookings = count($bookings);
$totalPages = ceil($totalBookings / $itemsPerPage);

// Ensure current page is within bounds
$currentPage = min($currentPage, max(1, $totalPages));

// Calculate offset
$offset = ($currentPage - 1) * $itemsPerPage;

// Get bookings for current page
$paginatedBookings = array_slice($bookings, $offset, $itemsPerPage);

// Calculate stats (menggunakan semua bookings, bukan yang dipaginasi)
$activeBookings = array_filter($bookings, function($b) {
    $now = time();
    $start = strtotime($b['start_time']);
    $end = strtotime($b['end_time']);
    return $start <= $now && $now <= $end;
});
$completedBookings = array_filter($bookings, function($b) {
    return time() > strtotime($b['end_time']);
});
$upcomingBookings = array_filter($bookings, function($b) {
    return time() < strtotime($b['start_time']);
});
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RuangMeet | Semua Booking</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Fraunces:ital,wght@0,300;0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg: #0b0d12;
            --ink: #f2f3f5;
            --accent: #f7c842;
            --accent-2: #ffd86b;
            --card: #1a1f28;
            --muted: #9aa0aa;
            --stroke: #2a313d;
            --shadow: 0 22px 55px rgba(5, 6, 9, 0.65);
            --success: #57ff75;
            --error: #ff5757;
            --info: #57b8ff;
            --warning: #ffa857;
            --purple: #b366ff;
            --cyan: #57d7ff;
        }

        * { 
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Space Grotesk", sans-serif;
            color: var(--ink);
            background: radial-gradient(circle at top left, #1a1f28 0%, #101319 55%, #0b0d12 100%);
            min-height: 100vh;
            padding: 30px 20px;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--stroke);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .header h1 {
            font-family: "Fraunces", serif;
            font-size: 36px;
            font-weight: 600;
            color: var(--ink);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header h1 i {
            color: var(--accent);
            font-size: 32px;
        }

        .header-actions {
            display: flex;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
            justify-content: flex-end;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            border-radius: 8px;
            border: 1px solid rgba(242, 243, 245, 0.2);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            color: var(--muted);
            background: rgba(17, 21, 28, 0.7);
            transition: all 0.2s ease;
        }

        .back-btn:hover {
            border-color: rgba(247, 200, 66, 0.4);
            color: var(--accent);
            background: rgba(17, 21, 28, 0.9);
        }

        /* Stats Bar */
        .stats-bar {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px 20px;
            background: var(--card);
            border-radius: 12px;
            border: 1px solid var(--stroke);
            min-width: 200px;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: var(--ink);
        }

        .stat-icon.total {
            background: linear-gradient(135deg, var(--info) 0%, #80d1ff 100%);
        }

        .stat-icon.active {
            background: linear-gradient(135deg, var(--success) 0%, #8dffa4 100%);
        }

        .stat-icon.completed {
            background: linear-gradient(135deg, var(--warning) 0%, #ffc477 100%);
        }

        .stat-icon.cancelled {
            background: linear-gradient(135deg, var(--error) 0%, #ff8a8a 100%);
        }

        .stat-content {
            flex: 1;
        }

        .stat-label {
            font-size: 12px;
            color: var(--muted);
            margin-bottom: 4px;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 600;
            color: var(--ink);
        }

        /* Search Container */
        .search-container {
            margin-bottom: 30px;
        }

        .search-box {
            position: relative;
            max-width: 400px;
        }

        .search-box i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            font-size: 16px;
        }

        .search-input {
            width: 100%;
            padding: 14px 20px 14px 48px;
            border-radius: 12px;
            border: 1px solid var(--stroke);
            background: rgba(17, 21, 28, 0.9);
            font-size: 15px;
            font-family: "Space Grotesk", sans-serif;
            color: var(--ink);
            transition: all 0.2s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--accent);
            background: rgba(17, 21, 28, 0.95);
            box-shadow: 0 0 0 3px rgba(247, 200, 66, 0.1);
        }

        /* Table Container */
        .table-container {
            background: var(--card);
            border-radius: 20px;
            padding: 25px;
            box-shadow: var(--shadow);
            border: 1px solid var(--stroke);
            overflow: hidden;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .table-header h2 {
            font-family: "Fraunces", serif;
            font-size: 20px;
            font-weight: 600;
            color: var(--ink);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .table-header h2 i {
            color: var(--accent);
        }

        /* Table Styles */
        .table-wrap {
            width: 100%;
            overflow-x: auto;
            border-radius: 12px;
            border: 1px solid var(--stroke);
            background: rgba(17, 21, 28, 0.5);
            -webkit-overflow-scrolling: touch;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            min-width: 900px;
        }

        .table thead {
            background: rgba(17, 21, 28, 0.8);
        }

        .table th {
            padding: 18px 20px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid var(--stroke);
        }

        .table th:first-child {
            border-radius: 12px 0 0 0;
        }

        .table th:last-child {
            border-radius: 0 12px 0 0;
        }

        .table tbody tr {
            border-bottom: 1px solid rgba(42, 49, 61, 0.3);
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background: rgba(17, 21, 28, 0.4);
        }

        .table td {
            padding: 20px;
            color: var(--ink);
            font-size: 14px;
            vertical-align: middle;
        }

        /* Avatar Styles */
        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #1a1a1a;
            font-size: 14px;
            text-transform: uppercase;
        }

        .avatar.room {
            background: linear-gradient(135deg, var(--purple) 0%, #d19cff 100%);
        }

        .avatar.user {
            background: linear-gradient(135deg, var(--info) 0%, #80d1ff 100%);
        }

        .avatar.admin {
            background: linear-gradient(135deg, var(--warning) 0%, #ffc477 100%);
        }

        /* Status Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .status-badge.active {
            background: rgba(87, 255, 117, 0.1);
            color: var(--success);
            border: 1px solid rgba(87, 255, 117, 0.3);
        }

        .status-badge.completed {
            background: rgba(255, 168, 87, 0.1);
            color: var(--warning);
            border: 1px solid rgba(255, 168, 87, 0.3);
        }

        .status-badge.cancelled {
            background: rgba(255, 87, 87, 0.1);
            color: var(--error);
            border: 1px solid rgba(255, 87, 87, 0.3);
        }

        .status-badge.pending {
            background: rgba(154, 160, 170, 0.1);
            color: var(--muted);
            border: 1px solid rgba(154, 160, 170, 0.3);
        }

        /* Time Info */
        .time-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .time-main {
            font-weight: 600;
            color: var(--ink);
            font-size: 13px;
        }

        .time-detail {
            font-size: 11px;
            color: var(--muted);
        }

        .duration {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 11px;
            color: var(--muted);
            margin-top: 2px;
        }

        /* Pagination */
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 25px;
            padding: 20px 0;
            border-top: 1px solid var(--stroke);
        }

        .pagination-info {
            font-size: 13px;
            color: var(--muted);
        }

        .pagination-controls {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .pagination-btn {
            padding: 8px 14px;
            border-radius: 8px;
            border: 1px solid var(--stroke);
            background: rgba(17, 21, 28, 0.7);
            color: var(--ink);
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
            text-decoration: none;
        }

        .pagination-btn:hover:not(.disabled) {
            border-color: var(--accent);
            color: var(--accent);
            background: rgba(247, 200, 66, 0.1);
        }

        .pagination-btn.disabled {
            opacity: 0.4;
            cursor: not-allowed;
            pointer-events: none;
        }

        .page-numbers {
            display: flex;
            gap: 5px;
        }

        .page-number {
            min-width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 10px;
            border-radius: 8px;
            border: 1px solid var(--stroke);
            background: rgba(17, 21, 28, 0.7);
            color: var(--ink);
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-weight: 500;
            text-decoration: none;
        }

        .page-number:hover:not(.dots):not(.active) {
            border-color: var(--accent);
            color: var(--accent);
            background: rgba(247, 200, 66, 0.1);
        }

        .page-number.active {
            background: var(--accent);
            border-color: var(--accent);
            color: #1a1a1a;
        }

        .page-number.dots {
            border: none;
            background: transparent;
            cursor: default;
            pointer-events: none;
        }

        .page-number.dots:hover {
            border: none;
            background: transparent;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 30px;
            color: var(--muted);
        }

        .empty-state i {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-state h3 {
            font-family: "Fraunces", serif;
            font-size: 22px;
            margin-bottom: 10px;
            color: var(--ink);
        }

        .empty-state p {
            font-size: 14px;
            max-width: 400px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* Filter Buttons */
        .filter-buttons {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 8px 16px;
            border-radius: 8px;
            border: 1px solid var(--stroke);
            background: rgba(17, 21, 28, 0.7);
            color: var(--muted);
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .filter-btn:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: rgba(247, 200, 66, 0.1);
        }

        .filter-btn.active {
            background: var(--accent);
            border-color: var(--accent);
            color: #1a1a1a;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }

            .header-actions {
                width: 100%;
                justify-content: flex-start;
            }

            .stats-bar {
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            body {
                padding: 20px 12px;
            }

            .header h1 {
                font-size: 28px;
            }

            .table-container {
                padding: 20px;
            }

            .table td {
                padding: 15px 12px;
            }

            .stat-item {
                min-width: calc(50% - 10px);
            }

            .stats-bar {
                gap: 10px;
            }
        }

        @media (max-width: 480px) {
            .header h1 {
                font-size: 24px;
            }

            .stat-item {
                min-width: 100%;
            }

            .table th,
            .table td {
                padding: 12px 10px;
                font-size: 12px;
            }

            .filter-buttons {
                justify-content: center;
            }

            .pagination-container {
                flex-direction: column;
                gap: 15px;
                align-items: stretch;
            }

            .pagination-controls {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header-left">
                <h1>
                    <i class="fas fa-calendar-check"></i>
                    Semua Booking
                </h1>
            </div>
            <div class="header-actions">
                <a href="/dashboard_superadmin" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Dashboard
                </a>
            </div>
        </div>

        <!-- Stats Bar -->
        <div class="stats-bar">
            <div class="stat-item">
                <div class="stat-icon total">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Total Booking</div>
                    <div class="stat-value"><?= number_format($totalBookings) ?></div>
                </div>
            </div>

            <div class="stat-item">
                <div class="stat-icon active">
                    <i class="fas fa-play-circle"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Sedang Berjalan</div>
                    <div class="stat-value"><?= number_format(count($activeBookings)) ?></div>
                </div>
            </div>

            <div class="stat-item">
                <div class="stat-icon completed">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Selesai</div>
                    <div class="stat-value"><?= number_format(count($completedBookings)) ?></div>
                </div>
            </div>

            <div class="stat-item">
                <div class="stat-icon cancelled">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Akan Datang</div>
                    <div class="stat-value"><?= number_format(count($upcomingBookings)) ?></div>
                </div>
            </div>
        </div>

        <!-- Search Box -->
        <div class="search-container">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" 
                       class="search-input" 
                       placeholder="Cari booking berdasarkan room, user, atau admin..."
                       onkeyup="searchBookings(this.value)">
            </div>
        </div>

        <!-- Filter Buttons -->
        <div class="filter-buttons">
            <button class="filter-btn active" onclick="filterBookings('all')">Semua</button>
            <button class="filter-btn" onclick="filterBookings('active')">Sedang Berjalan</button>
            <button class="filter-btn" onclick="filterBookings('completed')">Selesai</button>
            <button class="filter-btn" onclick="filterBookings('upcoming')">Akan Datang</button>
            <button class="filter-btn" onclick="filterBookings('today')">Hari Ini</button>
        </div>

        <!-- Booking Table -->
        <div class="table-container">
            <div class="table-header">
                <h2><i class="fas fa-list"></i> Daftar Booking</h2>
            </div>

            <div class="table-wrap">
                <?php if (empty($paginatedBookings)): ?>
                    <div class="empty-state">
                        <i class="fas fa-calendar-times"></i>
                        <h3>Tidak Ada Booking</h3>
                        <p>Belum ada booking yang dibuat. Booking akan muncul di sini setelah user membuat reservasi.</p>
                    </div>
                <?php else: ?>
                    <table class="table" id="bookingTable">
                        <thead>
                            <tr>
                                <th>Room</th>
                                <th>User</th>
                                <th>Admin</th>
                                <th>Waktu</th>
                                <th>Durasi</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $now = time();
                            foreach ($paginatedBookings as $b): 
                                $startTime = strtotime($b['start_time']);
                                $endTime = strtotime($b['end_time']);
                                
                                // Determine status
                                if ($now < $startTime) {
                                    $status = 'upcoming';
                                    $statusText = 'Akan Datang';
                                    $statusIcon = 'fa-clock';
                                    $statusClass = 'pending';
                                } elseif ($now > $endTime) {
                                    $status = 'completed';
                                    $statusText = 'Selesai';
                                    $statusIcon = 'fa-check-circle';
                                    $statusClass = 'completed';
                                } else {
                                    $status = 'active';
                                    $statusText = 'Berjalan';
                                    $statusIcon = 'fa-play-circle';
                                    $statusClass = 'active';
                                }
                                
                                // Calculate duration
                                $duration = $endTime - $startTime;
                                $hours = floor($duration / 3600);
                                $minutes = floor(($duration % 3600) / 60);
                                $durationText = $hours . ' jam ' . $minutes . ' menit';
                                
                                // Get initials for avatars
                                $roomInitial = strtoupper(substr($b['room_name'], 0, 1));
                                $userInitial = strtoupper(substr($b['user_name'], 0, 1));
                                $adminInitial = strtoupper(substr($b['admin_name'], 0, 1));
                            ?>
                                <tr data-status="<?= $status ?>"
                                    data-room="<?= htmlspecialchars(strtolower($b['room_name'])) ?>"
                                    data-user="<?= htmlspecialchars(strtolower($b['user_name'])) ?>"
                                    data-admin="<?= htmlspecialchars(strtolower($b['admin_name'])) ?>"
                                    data-start="<?= $startTime ?>"
                                    data-end="<?= $endTime ?>">
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 12px;">
                                            <div class="avatar room"><?= $roomInitial ?></div>
                                            <div>
                                                <div style="font-weight: 600; color: var(--ink);">
                                                    <?= htmlspecialchars($b['room_name']) ?>
                                                </div>
                                                <div style="font-size: 11px; color: var(--muted); margin-top: 2px;">
                                                    ID: <?= (int)($b['room_id'] ?? 0) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 12px;">
                                            <div class="avatar user"><?= $userInitial ?></div>
                                            <div>
                                                <div style="font-weight: 600; color: var(--ink);">
                                                    <?= htmlspecialchars($b['user_name']) ?>
                                                </div>
                                                <div style="font-size: 11px; color: var(--muted); margin-top: 2px;">
                                                    <?= htmlspecialchars($b['user_email'] ?? '') ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 12px;">
                                            <div class="avatar admin"><?= $adminInitial ?></div>
                                            <div>
                                                <div style="font-weight: 600; color: var(--ink);">
                                                    <?= htmlspecialchars($b['admin_name']) ?>
                                                </div>
                                                <div style="font-size: 11px; color: var(--muted); margin-top: 2px;">
                                                    <?= htmlspecialchars($b['admin_email'] ?? '') ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="time-info">
                                            <div class="time-main">
                                                <i class="fas fa-play" style="color: var(--success); font-size: 10px; margin-right: 6px;"></i>
                                                <?= date('d M Y, H:i', $startTime) ?>
                                            </div>
                                            <div class="time-detail">
                                                <i class="fas fa-stop" style="color: var(--error); font-size: 10px; margin-right: 6px;"></i>
                                                <?= date('d M Y, H:i', $endTime) ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="font-weight: 600; color: var(--ink);">
                                            <?= $hours ?> jam
                                        </div>
                                        <div class="duration">
                                            <i class="fas fa-hourglass-half"></i>
                                            <?= $durationText ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="status-badge <?= $statusClass ?>">
                                            <i class="fas <?= $statusIcon ?>"></i>
                                            <?= $statusText ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                <?php endif ?>
            </div>

            <!-- Pagination -->
            <div class="pagination-container">
                <div class="pagination-info">
                    Menampilkan <?= $totalBookings > 0 ? $offset + 1 : 0 ?> - <?= min($offset + $itemsPerPage, $totalBookings) ?> 
                    dari <?= $totalBookings ?> booking
                </div>
                <div class="pagination-controls">
                    <a href="?page=<?= max(1, $currentPage - 1) ?>" 
                       class="pagination-btn <?= $currentPage <= 1 ? 'disabled' : '' ?>">
                        <i class="fas fa-chevron-left"></i>
                        Sebelumnya
                    </a>
                    
                    <div class="page-numbers">
                        <?php
                        // Determine page range to display
                        $startPage = max(1, $currentPage - 2);
                        $endPage = min($totalPages, $startPage + 4);
                        
                        if ($endPage - $startPage < 4) {
                            $startPage = max(1, $endPage - 4);
                        }
                        
                        // First page
                        if ($startPage > 1) {
                            echo '<a href="?page=1" class="page-number">1</a>';
                            if ($startPage > 2) {
                                echo '<span class="page-number dots">...</span>';
                            }
                        }
                        
                        // Page numbers
                        for ($i = $startPage; $i <= $endPage; $i++) {
                            $activeClass = $i === $currentPage ? 'active' : '';
                            echo '<a href="?page=' . $i . '" class="page-number ' . $activeClass . '">' . $i . '</a>';
                        }
                        
                        // Last page
                        if ($endPage < $totalPages) {
                            if ($endPage < $totalPages - 1) {
                                echo '<span class="page-number dots">...</span>';
                            }
                            echo '<a href="?page=' . $totalPages . '" class="page-number">' . $totalPages . '</a>';
                        }
                        ?>
                    </div>
                    
                    <a href="?page=<?= min($totalPages, $currentPage + 1) ?>" 
                       class="pagination-btn <?= $currentPage >= $totalPages ? 'disabled' : '' ?>">
                        Selanjutnya
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Search functionality - hanya untuk data di halaman saat ini
        function searchBookings(query) {
            const searchTerm = query.toLowerCase();
            const rows = document.querySelectorAll('#bookingTable tbody tr');
            
            rows.forEach(row => {
                const room = row.getAttribute('data-room');
                const user = row.getAttribute('data-user');
                const admin = row.getAttribute('data-admin');
                
                const show = !searchTerm || 
                             room.includes(searchTerm) || 
                             user.includes(searchTerm) || 
                             admin.includes(searchTerm);
                
                row.style.display = show ? '' : 'none';
            });
        }

        // Filter functionality - hanya untuk data di halaman saat ini
        function filterBookings(filter) {
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');
            
            const rows = document.querySelectorAll('#bookingTable tbody tr');
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            
            rows.forEach(row => {
                const status = row.getAttribute('data-status');
                const startTime = parseInt(row.getAttribute('data-start'));
                const startDate = new Date(startTime * 1000);
                startDate.setHours(0, 0, 0, 0);
                
                let show = false;
                
                switch(filter) {
                    case 'all':
                        show = true;
                        break;
                    case 'today':
                        // Check if booking start date is today
                        show = startDate.getTime() === today.getTime();
                        break;
                    case 'active':
                    case 'completed':
                    case 'upcoming':
                        show = status === filter;
                        break;
                    default:
                        show = true;
                }
                
                row.style.display = show ? '' : 'none';
            });
        }

        // Auto-update status berdasarkan waktu real-time
        function updateBookingStatus() {
            const now = Math.floor(Date.now() / 1000);
            const rows = document.querySelectorAll('#bookingTable tbody tr');
            
            rows.forEach(row => {
                const startTime = parseInt(row.getAttribute('data-start'));
                const endTime = parseInt(row.getAttribute('data-end'));
                const statusBadge = row.querySelector('.status-badge');
                
                if (!statusBadge || !startTime || !endTime) return;
                
                let newStatus, newStatusText, newStatusIcon, newStatusClass;
                
                if (now < startTime) {
                    newStatus = 'upcoming';
                    newStatusText = 'Akan Datang';
                    newStatusIcon = 'fa-clock';
                    newStatusClass = 'pending';
                } else if (now > endTime) {
                    newStatus = 'completed';
                    newStatusText = 'Selesai';
                    newStatusIcon = 'fa-check-circle';
                    newStatusClass = 'completed';
                } else {
                    newStatus = 'active';
                    newStatusText = 'Berjalan';
                    newStatusIcon = 'fa-play-circle';
                    newStatusClass = 'active';
                }
                
                if (row.getAttribute('data-status') !== newStatus) {
                    row.setAttribute('data-status', newStatus);
                    statusBadge.className = 'status-badge ' + newStatusClass;
                    statusBadge.innerHTML = '<i class="fas ' + newStatusIcon + '"></i> ' + newStatusText;
                }
            });
        }

        setInterval(updateBookingStatus, 30000);
        document.addEventListener('DOMContentLoaded', updateBookingStatus);
    </script>
</body>
</html>