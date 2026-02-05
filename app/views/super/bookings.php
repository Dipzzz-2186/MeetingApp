<?php
/** @var array $bookings */
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MeetFlow | Semua Booking</title>
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
        }

        .pagination-btn:hover:not(:disabled) {
            border-color: var(--accent);
            color: var(--accent);
            background: rgba(247, 200, 66, 0.1);
        }

        .pagination-btn:disabled {
            opacity: 0.4;
            cursor: not-allowed;
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
        }

        .page-number:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: rgba(247, 200, 66, 0.1);
        }

        .page-number.active {
            background: var(--accent);
            border-color: var(--accent);
            color: #1a1a1a;
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
            <?php
            $totalBookings = count($bookings);
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
        </div>

        <!-- Booking Table -->
        <div class="table-container">
            <div class="table-header">
                <h2><i class="fas fa-list"></i> Daftar Booking</h2>
            </div>

            <div class="table-wrap">
                <?php if (empty($bookings)): ?>
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
                            <?php foreach ($bookings as $b): 
                                $startTime = strtotime($b['start_time']);
                                $endTime = strtotime($b['end_time']);
                                $now = time();
                                
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
                                    data-admin="<?= htmlspecialchars(strtolower($b['admin_name'])) ?>">
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
                    Menampilkan <span id="currentStart">1</span> - <span id="currentEnd">10</span> 
                    dari <span id="totalItems"><?= $totalBookings ?></span> booking
                </div>
                <div class="pagination-controls">
                    <button class="pagination-btn" id="prevBtn" onclick="changePage(-1)">
                        <i class="fas fa-chevron-left"></i>
                        Sebelumnya
                    </button>
                    <div class="page-numbers" id="pageNumbers"></div>
                    <button class="pagination-btn" id="nextBtn" onclick="changePage(1)">
                        Selanjutnya
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // State
        let currentPage = 1;
        const itemsPerPage = 10;
        let currentFilter = 'all';
        let currentSearch = '';

        document.addEventListener('DOMContentLoaded', function() {
            initializePagination();
            updateFilterButtons();
        });

        // Search functionality
        function searchBookings(query) {
            currentSearch = query.toLowerCase();
            currentPage = 1;
            
            const rows = document.querySelectorAll('#bookingTable tbody tr');
            let visibleCount = 0;
            
            rows.forEach(row => {
                const room = row.getAttribute('data-room');
                const user = row.getAttribute('data-user');
                const admin = row.getAttribute('data-admin');
                const status = row.getAttribute('data-status');
                
                let show = true;
                
                if (currentSearch) {
                    show = room.includes(currentSearch) || user.includes(currentSearch) || admin.includes(currentSearch);
                }
                
                if (currentFilter !== 'all') {
                    show = show && status === currentFilter;
                }
                
                row.style.display = show ? '' : 'none';
                if (show) visibleCount++;
            });
            
            updatePaginationInfo(visibleCount);
            updatePagination();
        }

        // Filter functionality
        function filterBookings(filter) {
            currentFilter = filter;
            currentPage = 1;
            
            // Update filter buttons
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');
            
            searchBookings(currentSearch);
        }

        function updateFilterButtons() {
            document.querySelectorAll('.filter-btn').forEach(btn => {
                if (btn.textContent.toLowerCase().includes(currentFilter) || 
                    (currentFilter === 'all' && btn.textContent === 'Semua')) {
                    btn.classList.add('active');
                } else {
                    btn.classList.remove('active');
                }
            });
        }

        // Pagination functions
        function initializePagination() {
            updatePagination();
        }

        function updatePagination() {
            const rows = document.querySelectorAll('#bookingTable tbody tr');
            const visibleRows = Array.from(rows).filter(row => row.style.display !== 'none');
            const totalItems = visibleRows.length;
            const totalPages = Math.ceil(totalItems / itemsPerPage);
            
            // Update info text
            const start = totalItems === 0 ? 0 : (currentPage - 1) * itemsPerPage + 1;
            const end = Math.min(currentPage * itemsPerPage, totalItems);
            
            document.getElementById('currentStart').textContent = start;
            document.getElementById('currentEnd').textContent = end;
            document.getElementById('totalItems').textContent = totalItems;
            
            // Show/hide rows for current page
            visibleRows.forEach((row, index) => {
                const rowPage = Math.floor(index / itemsPerPage) + 1;
                row.style.display = rowPage === currentPage ? '' : 'none';
            });
            
            // Update page numbers
            renderPageNumbers(totalPages);
            
            // Update prev/next buttons
            document.getElementById('prevBtn').disabled = currentPage === 1;
            document.getElementById('nextBtn').disabled = currentPage === totalPages || totalPages === 0;
        }

        function renderPageNumbers(totalPages) {
            const pageNumbersContainer = document.getElementById('pageNumbers');
            pageNumbersContainer.innerHTML = '';
            
            if (totalPages <= 1) return;
            
            let startPage = Math.max(1, currentPage - 2);
            let endPage = Math.min(totalPages, startPage + 4);
            
            if (endPage - startPage < 4) {
                startPage = Math.max(1, endPage - 4);
            }
            
            if (startPage > 1) {
                addPageNumber(1);
                if (startPage > 2) addPageDots();
            }
            
            for (let i = startPage; i <= endPage; i++) {
                addPageNumber(i);
            }
            
            if (endPage < totalPages) {
                if (endPage < totalPages - 1) addPageDots();
                addPageNumber(totalPages);
            }
        }

        function addPageNumber(pageNum) {
            const pageNumbersContainer = document.getElementById('pageNumbers');
            const pageBtn = document.createElement('button');
            pageBtn.className = 'page-number' + (pageNum === currentPage ? ' active' : '');
            pageBtn.textContent = pageNum;
            pageBtn.onclick = () => goToPage(pageNum);
            pageNumbersContainer.appendChild(pageBtn);
        }

        function addPageDots() {
            const pageNumbersContainer = document.getElementById('pageNumbers');
            const dots = document.createElement('span');
            dots.className = 'page-number dots';
            dots.textContent = '...';
            pageNumbersContainer.appendChild(dots);
        }

        function goToPage(pageNum) {
            currentPage = pageNum;
            updatePagination();
        }

        function changePage(direction) {
            const rows = document.querySelectorAll('#bookingTable tbody tr');
            const visibleRows = Array.from(rows).filter(row => row.style.display !== 'none');
            const totalPages = Math.ceil(visibleRows.length / itemsPerPage);
            
            currentPage += direction;
            currentPage = Math.max(1, Math.min(currentPage, totalPages));
            updatePagination();
        }

        function updatePaginationInfo(totalItems) {
            const start = totalItems === 0 ? 0 : (currentPage - 1) * itemsPerPage + 1;
            const end = Math.min(currentPage * itemsPerPage, totalItems);
            
            document.getElementById('currentStart').textContent = start;
            document.getElementById('currentEnd').textContent = end;
            document.getElementById('totalItems').textContent = totalItems;
        }

        // Auto-refresh for active bookings
        setInterval(function() {
            if (currentFilter === 'all' || currentFilter === 'active') {
                const activeRows = document.querySelectorAll('#bookingTable tbody tr[data-status="active"]');
                activeRows.forEach(row => {
                    const statusBadge = row.querySelector('.status-badge');
                    if (statusBadge) {
                        const now = new Date();
                        const endTime = new Date(row.cells[3].querySelector('.time-detail').textContent.replace('⏱️ ', ''));
                        
                        if (now > endTime) {
                            row.setAttribute('data-status', 'completed');
                            statusBadge.className = 'status-badge completed';
                            statusBadge.innerHTML = '<i class="fas fa-check-circle"></i> Selesai';
                        }
                    }
                });
            }
        }, 60000); // Check every minute
    </script>
</body>
</html>