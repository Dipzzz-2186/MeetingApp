<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MeetFlow | Scheduling</title>
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
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--stroke);
        }

        .header h1 {
            font-family: "Fraunces", serif;
            font-size: 32px;
            font-weight: 600;
            color: var(--ink);
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

        .grid-two {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        @media (max-width: 1024px) {
            .grid-two {
                grid-template-columns: 1fr;
            }
        }

        .card {
            background: var(--card);
            border-radius: 20px;
            padding: 30px;
            box-shadow: var(--shadow);
            border: 1px solid var(--stroke);
        }

        .card h1, .card h2 {
            font-family: "Fraunces", serif;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--ink);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card h1 i, .card h2 i {
            color: var(--accent);
        }

        .alert {
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideIn 0.3s ease;
        }

        .alert.success {
            background: rgba(87, 255, 117, 0.1);
            border: 1px solid rgba(87, 255, 117, 0.3);
            color: var(--success);
        }

        .alert.error {
            background: rgba(255, 87, 87, 0.1);
            border: 1px solid rgba(255, 87, 87, 0.3);
            color: var(--error);
        }

        .alert.info {
            background: rgba(87, 184, 255, 0.1);
            border: 1px solid rgba(87, 184, 255, 0.3);
            color: var(--info);
        }

        .alert.warning {
            background: rgba(255, 168, 87, 0.1);
            border: 1px solid rgba(255, 168, 87, 0.3);
            color: var(--warning);
        }

        .alert i {
            font-size: 16px;
        }

        form.grid {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        form.grid > div {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        label {
            font-weight: 600;
            font-size: 14px;
            color: var(--ink);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        label i {
            color: var(--accent);
            font-size: 12px;
        }

        input, select, textarea {
            width: 100%;
            padding: 14px 16px;
            border-radius: 10px;
            border: 1px solid var(--stroke);
            background: rgba(17, 21, 28, 0.9);
            font-size: 15px;
            font-family: "Space Grotesk", sans-serif;
            color: var(--ink);
            transition: all 0.2s ease;
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--accent);
            background: rgba(17, 21, 28, 0.95);
            box-shadow: 0 0 0 3px rgba(247, 200, 66, 0.1);
        }

        input::placeholder, textarea::placeholder {
            color: rgba(154, 160, 170, 0.6);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }

        button[type="submit"] {
            background: var(--accent);
            color: #1a1a1a;
            border: none;
            padding: 15px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            margin-top: 10px;
            font-family: "Space Grotesk", sans-serif;
            width: 100%;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        button[type="submit"]:hover {
            background: var(--accent-2);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(247, 200, 66, 0.2);
        }

        /* Tabel Styling */
        .table-container {
            overflow-x: auto;
            margin-top: 20px;
            border-radius: 10px;
            border: 1px solid var(--stroke);
            background: rgba(17, 21, 28, 0.5);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }

        .table thead {
            background: rgba(17, 21, 28, 0.8);
        }

        .table th {
            padding: 18px 15px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid var(--stroke);
        }

        .table tbody tr {
            border-bottom: 1px solid rgba(42, 49, 61, 0.3);
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background: rgba(17, 21, 28, 0.4);
        }

        .table td {
            padding: 20px 15px;
            color: var(--ink);
            font-size: 14px;
            vertical-align: middle;
        }

        /* User Avatar */
        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-2) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #1a1a1a;
            font-size: 14px;
        }

        .room-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            background: rgba(179, 102, 255, 0.1);
            color: var(--purple);
            font-size: 11px;
            font-weight: 600;
            border: 1px solid rgba(179, 102, 255, 0.3);
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        .action-btn {
            padding: 8px 12px;
            border-radius: 8px;
            border: 1px solid var(--stroke);
            background: rgba(17, 21, 28, 0.7);
            color: var(--muted);
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .action-btn:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: rgba(247, 200, 66, 0.1);
        }

        .action-btn.edit:hover {
            border-color: var(--info);
            color: var(--info);
            background: rgba(87, 184, 255, 0.1);
        }

        .action-btn.delete:hover {
            border-color: var(--error);
            color: var(--error);
            background: rgba(255, 87, 87, 0.1);
        }

        .action-btn.view:hover {
            border-color: var(--success);
            color: var(--success);
            background: rgba(87, 255, 117, 0.1);
        }

        /* Filter Controls */
        .filter-controls {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 10px 16px;
            border-radius: 10px;
            border: 1px solid var(--stroke);
            background: rgba(17, 21, 28, 0.7);
            color: var(--muted);
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-btn.active {
            background: rgba(247, 200, 66, 0.1);
            border-color: var(--accent);
            color: var(--accent);
        }

        .filter-btn:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: rgba(247, 200, 66, 0.1);
        }

        /* Booking Status */
        .booking-status {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-upcoming {
            background: rgba(87, 255, 117, 0.1);
            color: var(--success);
            border: 1px solid rgba(87, 255, 117, 0.3);
        }

        .status-ongoing {
            background: rgba(87, 184, 255, 0.1);
            color: var(--info);
            border: 1px solid rgba(87, 184, 255, 0.3);
        }

        .status-completed {
            background: rgba(154, 160, 170, 0.1);
            color: var(--muted);
            border: 1px solid rgba(154, 160, 170, 0.3);
        }

        /* Duration Indicator */
        .duration-indicator {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            background: rgba(87, 255, 117, 0.1);
            color: var(--success);
            font-size: 11px;
            font-weight: 600;
        }

        /* Time Input Helper */
        .time-helper {
            font-size: 12px;
            color: var(--muted);
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 50px 20px;
            color: var(--muted);
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 15px;
            opacity: 0.5;
        }

        .empty-state h3 {
            font-size: 16px;
            margin-bottom: 8px;
            color: var(--muted);
        }

        .empty-state p {
            font-size: 14px;
            max-width: 400px;
            margin: 0 auto;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-top: 25px;
        }

        .stat-card {
            padding: 15px;
            border-radius: 12px;
            border: 1px solid;
        }

        .stat-label {
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 600;
            color: var(--ink);
        }

        /* Pagination Styles */
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            padding: 15px 0;
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

        .pagination-btn.active {
            background: var(--accent);
            border-color: var(--accent);
            color: #1a1a1a;
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

        .page-number.dots {
            border: none;
            background: transparent;
            cursor: default;
            pointer-events: none;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }
            
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .card {
                padding: 20px;
            }
            
            .actions {
                flex-direction: column;
                gap: 5px;
            }
            
            .action-btn {
                width: 100%;
                justify-content: center;
            }
            
            .filter-controls {
                justify-content: center;
            }

            .pagination-container {
                flex-direction: column;
                gap: 15px;
                align-items: stretch;
            }

            .pagination-info {
                text-align: center;
            }

            .pagination-controls {
                flex-direction: column;
                width: 100%;
            }

            .page-numbers {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 15px 10px;
            }
            
            .header h1 {
                font-size: 24px;
            }
            
            .card h1, .card h2 {
                font-size: 20px;
            }
            
            input, select, button[type="submit"] {
                padding: 12px 14px;
            }
        }
        input[type="datetime-local"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
            opacity: 0.9;
            cursor: pointer;
        }

        /* Optional: hover biar konsisten */
        input[type="datetime-local"]::-webkit-calendar-picker-indicator:hover {
            opacity: 1;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-calendar-alt"></i> Scheduling & Booking</h1>
            <a href="/dashboard" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Dashboard
            </a>
        </div>
        
        <div class="grid-two">
            <!-- Form Buat Booking -->
            <div class="card">
                <h1><i class="fas fa-plus-circle"></i> Buat Booking Baru</h1>
                
                <?php if (!empty($notice)): ?>
                    <div class="alert success">
                        <i class="fas fa-check-circle"></i>
                        <?php echo htmlspecialchars($notice); ?>
                    </div>
                <?php endif; ?>
                
                <?php if (!empty($error)): ?>
                    <div class="alert error">
                        <i class="fas fa-exclamation-circle"></i>
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>
                
                <form method="post" class="grid">
                    <div class="form-row">
                        <div>
                            <label><i class="fas fa-door-open"></i> Room</label>
                            <select name="room_id" required>
                                <option value="">Pilih room</option>
                                <?php foreach ($rooms as $row): ?>
                                    <option value="<?php echo (int)$row['id']; ?>" data-capacity="<?php echo $row['capacity']; ?>">
                                        <?php echo htmlspecialchars($row['name']); ?> (<?php echo $row['capacity']; ?> orang)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div>
                            <label><i class="fas fa-calendar-day"></i> Mulai</label>
                            <input type="datetime-local" name="start_time" id="start_time" required 
                                  min="<?php echo date('Y-m-d\TH:i'); ?>"
                                  placeholder="Pilih waktu mulai">
                            <div class="time-helper">
                                <i class="fas fa-clock"></i>
                                <span id="start_time_display">Belum dipilih</span>
                            </div>
                        </div>
                        <div>
                            <label><i class="fas fa-calendar-check"></i> Selesai</label>
                            <input type="datetime-local" name="end_time" id="end_time" required
                                  min="<?php echo date('Y-m-d\TH:i'); ?>"
                                  placeholder="Pilih waktu selesai">
                            <div class="time-helper">
                                <i class="fas fa-clock"></i>
                                <span id="end_time_display">Belum dipilih</span>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <label><i class="fas fa-bullseye"></i> Tujuan Meeting</label>
                        <input type="text" name="purpose" placeholder="Contoh: Rapat Tim Marketing, Presentasi Klien, dll.">
                    </div>

                    <button type="submit">
                        <i class="fas fa-calendar-plus"></i>
                        Buat Booking
                    </button>
                </form>
            </div>
            
            <!-- Daftar Booking -->
            <div class="card">
                <h2><i class="fas fa-list"></i> Daftar Booking</h2>
                
                <!-- Filter Controls -->
                <div class="filter-controls">
                    <button class="filter-btn active" onclick="filterBookings('all')">
                        <i class="fas fa-layer-group"></i>
                        Semua
                    </button>
                    <button class="filter-btn" onclick="filterBookings('upcoming')">
                        <i class="fas fa-clock"></i>
                        Akan Datang
                    </button>
                    <button class="filter-btn" onclick="filterBookings('ongoing')">
                        <i class="fas fa-play-circle"></i>
                        Berlangsung
                    </button>
                    <button class="filter-btn" onclick="filterBookings('completed')">
                        <i class="fas fa-check-circle"></i>
                        Selesai
                    </button>
                    <button class="filter-btn" onclick="filterBookings('today')">
                        <i class="fas fa-calendar-day"></i>
                        Hari Ini
                    </button>
                </div>
                
                <?php if (!$bookings): ?>
                    <div class="empty-state">
                        <i class="fas fa-calendar-times"></i>
                        <h3>Belum ada booking</h3>
                        <p>Buat booking pertama Anda menggunakan form di samping</p>
                    </div>
                <?php else: ?>
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Waktu</th>
                                    <th>Durasi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($bookings as $row): 
                                    // Hitung durasi dan status dengan error handling
                                    try {
                                        $start = new DateTime($row['start_time']);
                                        $end = new DateTime($row['end_time']);
                                    } catch (Exception $e) {
                                        // Jika format datetime tidak valid, gunakan waktu sekarang sebagai fallback
                                        $start = new DateTime();
                                        $end = new DateTime('+1 hour');
                                    }
                                    
                                    $duration = $start->diff($end);
                                    $hours = $duration->h + ($duration->days * 24);
                                    $minutes = $duration->i;
                                    
                                    // Tentukan status dengan lebih akurat
                                    $now = new DateTime();
                                    $status = 'upcoming'; // default
                                    
                                    if ($now >= $start && $now <= $end) {
                                        $status = 'ongoing';
                                    } elseif ($now > $end) {
                                        $status = 'completed';
                                    }
                                    
                                    // Format waktu untuk display
                                    $startDate = $start->format('d/m/Y');
                                    $startTime = $start->format('H:i');
                                    $endTime = $end->format('H:i');
                                    
                                    // Warna berdasarkan status
                                    $statusClass = 'status-' . $status;
                                    $statusText = $status == 'upcoming' ? 'Akan Datang' : 
                                                ($status == 'ongoing' ? 'Berlangsung' : 'Selesai');
                                ?>
                                    <tr data-status="<?php echo $status; ?>" 
                                        data-date="<?php echo $start->format('Y-m-d'); ?>"
                                        class="booking-row">
                                      <td>
                                          <div style="display: flex; flex-direction: column; gap: 6px;">
                                              <div style="font-weight: 600; color: var(--ink);">
                                                  <i class="fas fa-door-open" style="color: var(--accent); margin-right: 6px;"></i>
                                                  <?php echo htmlspecialchars($row['room_name']); ?>
                                              </div>

                                              <?php if (!empty($row['purpose'])): ?>
                                                  <div style="font-size: 12px; color: var(--muted);">
                                                      <?php echo htmlspecialchars($row['purpose']); ?>
                                                  </div>
                                              <?php endif; ?>
                                          </div>
                                      </td>
                                        <td>
                                            <div style="display: flex; flex-direction: column; gap: 4px;">
                                                <div style="font-size: 13px; color: var(--muted);">
                                                    <?php echo $startDate; ?>
                                                </div>
                                                <div style="font-weight: 600; color: var(--ink);">
                                                    <?php echo $startTime; ?> - <?php echo $endTime; ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="duration-indicator">
                                                <?php 
                                                if ($hours > 0) echo $hours . ' jam ';
                                                if ($minutes > 0) echo $minutes . ' menit';
                                                if ($hours == 0 && $minutes == 0) echo '< 1 menit';
                                                ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="booking-status <?php echo $statusClass; ?>">
                                                <i class="fas <?php 
                                                    echo $status == 'upcoming' ? 'fa-clock' : 
                                                        ($status == 'ongoing' ? 'fa-play-circle' : 'fa-check-circle'); 
                                                ?>"></i>
                                                <?php echo $statusText; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="actions">
                                                <button class="action-btn view" onclick="viewBooking(<?php echo $row['id']; ?>)">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="action-btn edit" onclick="editBooking(<?php echo $row['id']; ?>)">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="action-btn delete" onclick="deleteBooking(<?php echo $row['id']; ?>)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-container">
                        <div class="pagination-info">
                            Menampilkan <span id="currentStart">1</span> - <span id="currentEnd">5</span> 
                            dari <span id="totalItems">0</span> booking
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
                    
                    <!-- Stats Summary -->
                    <div class="stats-grid">
                        <div class="stat-card" style="background: rgba(87, 255, 117, 0.1); border-color: rgba(87, 255, 117, 0.3);">
                            <div class="stat-label" style="color: var(--success);">AKAN DATANG</div>
                            <div class="stat-value" id="stat-upcoming">
                                <?php 
                                $upcomingCount = 0;
                                foreach ($bookings as $row) {
                                    $start = new DateTime($row['start_time']);
                                    $now = new DateTime();
                                    if ($now < $start) $upcomingCount++;
                                }
                                echo $upcomingCount;
                                ?>
                            </div>
                        </div>
                        
                        <div class="stat-card" style="background: rgba(87, 184, 255, 0.1); border-color: rgba(87, 184, 255, 0.3);">
                            <div class="stat-label" style="color: var(--info);">BERLANGSUNG</div>
                            <div class="stat-value" id="stat-ongoing">
                                <?php 
                                $ongoingCount = 0;
                                foreach ($bookings as $row) {
                                    $start = new DateTime($row['start_time']);
                                    $end = new DateTime($row['end_time']);
                                    $now = new DateTime();
                                    if ($now >= $start && $now <= $end) $ongoingCount++;
                                }
                                echo $ongoingCount;
                                ?>
                            </div>
                        </div>
                        
                        <div class="stat-card" style="background: rgba(154, 160, 170, 0.1); border-color: rgba(154, 160, 170, 0.3);">
                            <div class="stat-label" style="color: var(--muted);">SELESAI</div>
                            <div class="stat-value" id="stat-completed">
                                <?php 
                                $completedCount = 0;
                                foreach ($bookings as $row) {
                                    $end = new DateTime($row['end_time']);
                                    $now = new DateTime();
                                    if ($now > $end) $completedCount++;
                                }
                                echo $completedCount;
                                ?>
                            </div>
                        </div>
                        
                        <div class="stat-card" style="background: rgba(247, 200, 66, 0.1); border-color: rgba(247, 200, 66, 0.3);">
                            <div class="stat-label" style="color: var(--accent);">TOTAL</div>
                            <div class="stat-value" id="stat-total">
                                <?php echo count($bookings); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
<script>
    // Pagination variables
    let currentPage = 1;
    const itemsPerPage = 5;
    let currentFilter = 'all';

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const startInput = document.getElementById('start_time');
        const endInput = document.getElementById('end_time');
        const startDisplay = document.getElementById('start_time_display');
        const endDisplay = document.getElementById('end_time_display');
        
        // Initialize pagination
        initializePagination();
        
        // Format tanggal untuk display
        function formatDateTimeDisplay(dateString) {
            if (!dateString) return 'Belum dipilih';
            
            const date = new Date(dateString);
            // Validasi date
            if (isNaN(date.getTime())) return 'Format tidak valid';
            
            const options = { 
                weekday: 'long', 
                day: 'numeric', 
                month: 'long', 
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            return date.toLocaleDateString('id-ID', options);
        }
        
        // Update display saat input berubah
        function updateTimeDisplays() {
            if (startInput.value) {
                startDisplay.textContent = formatDateTimeDisplay(startInput.value);
                startDisplay.style.color = 'var(--ink)';
                startDisplay.style.fontWeight = '500';
            } else {
                startDisplay.textContent = 'Belum dipilih';
                startDisplay.style.color = 'var(--muted)';
                startDisplay.style.fontWeight = 'normal';
            }
            
            if (endInput.value) {
                endDisplay.textContent = formatDateTimeDisplay(endInput.value);
                endDisplay.style.color = 'var(--ink)';
                endDisplay.style.fontWeight = '500';
            } else {
                endDisplay.textContent = 'Belum dipilih';
                endDisplay.style.color = 'var(--muted)';
                endDisplay.style.fontWeight = 'normal';
            }
        }
        
        // Update end time minimum saat start time berubah
        startInput.addEventListener('change', function() {
            if (this.value) {
                const start = new Date(this.value);
                const minEnd = new Date(start.getTime() + 30 * 60 * 1000); // Minimal 30 menit setelah mulai
                endInput.min = minEnd.toISOString().slice(0, 16);
                
                // Jika end time sudah dipilih dan kurang dari minimal, reset
                if (endInput.value) {
                    const currentEnd = new Date(endInput.value);
                    if (currentEnd < minEnd) {
                        endInput.value = '';
                        showAlert('Waktu selesai harus minimal 30 menit setelah waktu mulai. Silahkan pilih ulang.', 'warning');
                    }
                }
            }
            updateTimeDisplays();
        });
        
        endInput.addEventListener('change', updateTimeDisplays);
        
        // Initial display
        updateTimeDisplays();
        
        // Form validation
        form.addEventListener('submit', function(e) {
            const start = startInput.value ? new Date(startInput.value) : null;
            const end = endInput.value ? new Date(endInput.value) : null;
            const now = new Date();
            
            // Validasi waktu sudah dipilih
            if (!start) {
                e.preventDefault();
                showAlert('Harap pilih waktu mulai.', 'error');
                startInput.focus();
                return false;
            }
            
            if (!end) {
                e.preventDefault();
                showAlert('Harap pilih waktu selesai.', 'error');
                endInput.focus();
                return false;
            }
            
            // Validasi waktu
            if (end <= start) {
                e.preventDefault();
                showAlert('Waktu selesai harus setelah waktu mulai.', 'error');
                endInput.focus();
                return false;
            }
            
            // Validasi durasi minimal 30 menit
            const durationMinutes = (end - start) / (1000 * 60);
            if (durationMinutes < 30) {
                e.preventDefault();
                showAlert('Durasi booking minimal 30 menit.', 'error');
                return false;
            }
            
            // Validasi durasi maksimal 8 jam
            const durationHours = (end - start) / (1000 * 60 * 60);
            if (durationHours > 8) {
                e.preventDefault();
                showAlert('Durasi booking maksimal 8 jam.', 'error');
                return false;
            }
            
            // Validasi booking di masa lalu
            if (start < now) {
                e.preventDefault();
                showAlert('Tidak bisa membuat booking di waktu yang sudah lewat.', 'error');
                return false;
            }
            
            // Add loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
            submitBtn.disabled = true;
            
            return true;
        });
        
        // Cegah form resubmission warning
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.pathname + window.location.search);
        }
    });

    // Pagination functions
    function initializePagination() {
        updatePagination();
    }

    function updatePagination() {
        // Get ALL rows first
        const allRows = document.querySelectorAll('.booking-row');
        
        // First, show all rows temporarily to check filter
        allRows.forEach(row => {
            const status = row.getAttribute('data-status');
            const date = row.getAttribute('data-date');
            const today = new Date().toISOString().slice(0, 10);
            
            let show = true;
            
            switch(currentFilter) {
                case 'upcoming':
                    show = status === 'upcoming';
                    break;
                case 'ongoing':
                    show = status === 'ongoing';
                    break;
                case 'completed':
                    show = status === 'completed';
                    break;
                case 'today':
                    show = date === today;
                    break;
                case 'all':
                default:
                    show = true;
            }
            
            // Mark rows based on filter (using data attribute)
            row.setAttribute('data-filtered', show ? 'true' : 'false');
        });
        
        // Get visible rows after filter
        const visibleRows = Array.from(allRows).filter(row => row.getAttribute('data-filtered') === 'true');
        const totalItems = visibleRows.length;
        const totalPages = Math.ceil(totalItems / itemsPerPage);
        
        // Update info text
        const start = totalItems === 0 ? 0 : (currentPage - 1) * itemsPerPage + 1;
        const end = Math.min(currentPage * itemsPerPage, totalItems);
        
        document.getElementById('currentStart').textContent = start;
        document.getElementById('currentEnd').textContent = end;
        document.getElementById('totalItems').textContent = totalItems;
        
        // Show/hide rows for current page
        allRows.forEach(row => {
            if (row.getAttribute('data-filtered') === 'false') {
                row.style.display = 'none';
            } else {
                // This row passes the filter, now check pagination
                const indexInVisible = visibleRows.indexOf(row);
                const rowPage = Math.floor(indexInVisible / itemsPerPage) + 1;
                
                if (rowPage === currentPage) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        });
        
        // Update page numbers
        renderPageNumbers(totalPages);
        
        // Update prev/next buttons
        document.getElementById('prevBtn').disabled = currentPage === 1;
        document.getElementById('nextBtn').disabled = currentPage === totalPages || totalPages === 0;
        
        // Show/hide pagination container - hanya tampilkan jika data lebih dari itemsPerPage
        const paginationContainer = document.querySelector('.pagination-container');
        if (totalItems <= itemsPerPage) {
            paginationContainer.style.display = 'none';
        } else {
            paginationContainer.style.display = 'flex';
        }
    }

    function renderPageNumbers(totalPages) {
        const pageNumbersContainer = document.getElementById('pageNumbers');
        pageNumbersContainer.innerHTML = '';
        
        if (totalPages <= 1) return;
        
        // Show max 5 page numbers
        let startPage = Math.max(1, currentPage - 2);
        let endPage = Math.min(totalPages, startPage + 4);
        
        // Adjust if we're near the end
        if (endPage - startPage < 4) {
            startPage = Math.max(1, endPage - 4);
        }
        
        // First page
        if (startPage > 1) {
            addPageNumber(1);
            if (startPage > 2) {
                addPageDots();
            }
        }
        
        // Page numbers
        for (let i = startPage; i <= endPage; i++) {
            addPageNumber(i);
        }
        
        // Last page
        if (endPage < totalPages) {
            if (endPage < totalPages - 1) {
                addPageDots();
            }
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
        const allRows = document.querySelectorAll('.booking-row');
        const visibleRows = Array.from(allRows).filter(row => row.getAttribute('data-filtered') === 'true');
        const totalPages = Math.ceil(visibleRows.length / itemsPerPage);
        
        currentPage += direction;
        currentPage = Math.max(1, Math.min(currentPage, totalPages));
        updatePagination();
    }

    // Filter functionality
    window.filterBookings = function(filter) {
        const rows = document.querySelectorAll('.booking-row');
        const filterBtns = document.querySelectorAll('.filter-btn');
        
        // Update active button
        filterBtns.forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');
        
        // Update current filter
        currentFilter = filter;
        
        // Reset to page 1 when filtering
        currentPage = 1;
        
        // Update pagination after filtering (this will handle the display logic)
        updatePagination();
        
        // Update stat counts after filtering
        updateFilteredStats(filter);
    };
    
    // Fungsi untuk update stats berdasarkan filter
    function updateFilteredStats(filter) {
        const rows = document.querySelectorAll('.booking-row');
        let upcomingCount = 0;
        let ongoingCount = 0;
        let completedCount = 0;
        let totalCount = 0;
        
        rows.forEach(row => {
            if (row.getAttribute('data-filtered') === 'true') {
                const status = row.getAttribute('data-status');
                totalCount++;
                
                if (status === 'upcoming') upcomingCount++;
                if (status === 'ongoing') ongoingCount++;
                if (status === 'completed') completedCount++;
            }
        });
        
        // Update stats display
        const upcomingStat = document.getElementById('stat-upcoming');
        const ongoingStat = document.getElementById('stat-ongoing');
        const completedStat = document.getElementById('stat-completed');
        const totalStat = document.getElementById('stat-total');
        
        if (upcomingStat) upcomingStat.textContent = upcomingCount;
        if (ongoingStat) ongoingStat.textContent = ongoingCount;
        if (completedStat) completedStat.textContent = completedCount;
        if (totalStat) totalStat.textContent = totalCount;
    }
    
    // Booking actions
    window.viewBooking = function(bookingId) {
        alert(`Melihat detail booking ID: ${bookingId}\n\nDalam implementasi nyata, ini akan membuka modal detail.`);
    };
    
    window.editBooking = function(bookingId) {
        alert(`Edit booking ID: ${bookingId}\n\nDalam implementasi nyata, ini akan membuka form edit.`);
    };
    
    window.deleteBooking = function(bookingId) {
        if (confirm('Apakah Anda yakin ingin membatalkan booking ini?\n\nData booking akan dihapus permanen.')) {
            // Kirim AJAX request (contoh implementasi)
            fetch(`/booking/${bookingId}/delete`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAlert('Booking berhasil dibatalkan!', 'success');
                    setTimeout(() => window.location.reload(), 1500);
                } else {
                    showAlert(data.error || 'Gagal membatalkan booking.', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('Terjadi kesalahan.', 'error');
            });
        }
    };
    
    // Helper function untuk menampilkan alert
    function showAlert(message, type) {
        // Remove existing alerts
        const existingAlerts = document.querySelectorAll('.alert');
        existingAlerts.forEach(alert => alert.remove());
        
        // Create new alert
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert ${type}`;
        alertDiv.innerHTML = `
            <i class="fas fa-${type === 'error' ? 'exclamation-circle' : 'check-circle'}"></i>
            ${message}
        `;
        
        // Insert after the h1
        const card = document.querySelector('.card');
        const h1 = card.querySelector('h1');
        if (h1 && card) {
            h1.insertAdjacentElement('afterend', alertDiv);
        }
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            if (alertDiv.parentNode) {
                alertDiv.remove();
            }
        }, 5000);
    }
</script>
</body>
</html>