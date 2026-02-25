<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RuangMeet | Admin Dashboard</title>
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

        /* Header Styles */
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(42, 49, 61, 0.5);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header-logo {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-2) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #1a1a1a;
            font-weight: 700;
        }

        .header-text h1 {
            font-family: "Fraunces", serif;
            font-size: 32px;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 4px;
        }

        .header-text p {
            color: var(--muted);
            font-size: 14px;
            margin: 0;
        }

        .admin-badge {
            padding: 8px 16px;
            border-radius: 20px;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-2) 100%);
            color: #1a1a1a;
            font-weight: 700;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: linear-gradient(145deg, rgba(26, 31, 40, 0.9) 0%, rgba(22, 27, 36, 0.9) 100%);
            border-radius: 20px;
            padding: 25px;
            border: 1px solid var(--stroke);
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: rgba(247, 200, 66, 0.3);
            box-shadow: 0 15px 30px rgba(5, 6, 9, 0.8);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            font-size: 20px;
        }

        .stat-icon.users { background: rgba(87, 184, 255, 0.15); color: var(--info); }
        .stat-icon.rooms { background: rgba(87, 255, 117, 0.15); color: var(--success); }
        .stat-icon.bookings { background: rgba(247, 200, 66, 0.15); color: var(--accent); }
        .stat-icon.active { background: rgba(179, 102, 255, 0.15); color: var(--purple); }

        .stat-content h3 {
            font-size: 14px;
            font-weight: 600;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .stat-value {
            font-family: "Fraunces", serif;
            font-size: 32px;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 5px;
        }

        /* Main Grid Layout */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        @media (max-width: 1024px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Card Styles */
        .card {
            background: linear-gradient(145deg, rgba(26, 31, 40, 0.95) 0%, rgba(22, 27, 36, 0.95) 100%);
            border-radius: 20px;
            padding: 30px;
            border: 1px solid var(--stroke);
            box-shadow: var(--shadow);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(42, 49, 61, 0.5);
        }

        .card-title {
            font-family: "Fraunces", serif;
            font-size: 24px;
            font-weight: 600;
            color: var(--ink);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .card-title i {
            color: var(--accent);
        }

        .card-actions {
            display: flex;
            gap: 10px;
        }

        /* Action Cards */
        .action-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }

        .action-card {
            background: rgba(17, 21, 28, 0.7);
            border-radius: 15px;
            padding: 20px;
            border: 1px solid var(--stroke);
            text-decoration: none;
            color: var(--ink);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .action-card:hover {
            background: rgba(17, 21, 28, 0.9);
            border-color: var(--accent);
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(247, 200, 66, 0.1);
        }

        .action-card i {
            font-size: 24px;
            color: var(--accent);
            margin-bottom: 12px;
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(247, 200, 66, 0.1);
        }

        .action-card span {
            font-weight: 600;
            font-size: 14px;
            margin-top: 5px;
        }

        /* Alert Styles */
        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideIn 0.3s ease;
        }

        .alert.warning {
            background: linear-gradient(135deg, rgba(247, 200, 66, 0.15) 0%, rgba(255, 168, 87, 0.1) 100%);
            border: 1px solid rgba(247, 200, 66, 0.3);
            color: var(--accent);
        }

        .alert.error {
            background: linear-gradient(135deg, rgba(255, 87, 87, 0.15) 0%, rgba(255, 87, 135, 0.1) 100%);
            border: 1px solid rgba(255, 87, 87, 0.3);
            color: var(--error);
        }

        .alert.success {
            background: linear-gradient(135deg, rgba(87, 255, 117, 0.15) 0%, rgba(87, 255, 190, 0.1) 100%);
            border: 1px solid rgba(87, 255, 117, 0.3);
            color: var(--success);
        }

        .alert i {
            font-size: 18px;
        }

        /* Table Styles */
        .table-container {
            overflow-x: auto;
            border-radius: 12px;
            border: 1px solid var(--stroke);
            background: rgba(17, 21, 28, 0.5);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }

        .table thead {
            background: linear-gradient(90deg, rgba(17, 21, 28, 0.9) 0%, rgba(26, 31, 40, 0.9) 100%);
        }

        .table th {
            padding: 16px 20px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid var(--stroke);
        }

        .table tbody tr {
            border-bottom: 1px solid rgba(42, 49, 61, 0.5);
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background: rgba(17, 21, 28, 0.4);
        }

        .table td {
            padding: 18px 20px;
            color: var(--ink);
            font-size: 14px;
        }

        .booking-status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-upcoming {
            background: rgba(87, 184, 255, 0.15);
            color: var(--info);
            border: 1px solid rgba(87, 184, 255, 0.3);
        }

        .status-ongoing {
            background: rgba(247, 200, 66, 0.15);
            color: var(--accent);
            border: 1px solid rgba(247, 200, 66, 0.3);
        }

        .status-completed {
            background: rgba(87, 255, 117, 0.15);
            color: var(--success);
            border: 1px solid rgba(87, 255, 117, 0.3);
        }

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
        }

        /* Subscription Form */
        .subscription-form {
            background: linear-gradient(135deg, rgba(26, 31, 40, 0.9) 0%, rgba(17, 21, 28, 0.9) 100%);
            border-radius: 15px;
            padding: 25px;
            border: 1px solid var(--stroke);
            margin-bottom: 15px;
        }

        .subscription-form:last-child {
            margin-bottom: 0;
        }

        .subscription-form h3 {
            font-size: 16px;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .subscription-form h3 i {
            color: var(--accent);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            font-size: 13px;
            color: var(--muted);
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border-radius: 10px;
            border: 1px solid var(--stroke);
            background: rgba(11, 13, 18, 0.7);
            color: var(--ink);
            font-size: 14px;
            font-family: "Space Grotesk", sans-serif;
            transition: all 0.2s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--accent);
            background: rgba(11, 13, 18, 0.9);
            box-shadow: 0 0 0 3px rgba(247, 200, 66, 0.1);
        }

        .btn {
            padding: 12px 24px;
            border-radius: 10px;
            border: none;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            font-family: "Space Grotesk", sans-serif;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-2) 100%);
            color: #1a1a1a;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(247, 200, 66, 0.2);
        }

        .btn-secondary {
            background: rgba(17, 21, 28, 0.9);
            color: var(--ink);
            border: 1px solid var(--stroke);
        }

        .btn-secondary:hover {
            background: rgba(24, 28, 37, 0.9);
            border-color: var(--accent);
            color: var(--accent);
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 1000;
            align-items: flex-start;
            justify-content: center;
            padding: 20px;
            overflow-y: auto;
            animation: fadeIn 0.3s ease;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: linear-gradient(145deg, rgba(26, 31, 40, 0.95) 0%, rgba(22, 27, 36, 0.95) 100%);
            border-radius: 20px;
            width: 90%;
            max-width: 500px;
            padding: 30px;
            border: 1px solid var(--stroke);
            box-shadow: var(--shadow);
            position: relative;
            max-height: calc(100vh - 40px);
            overflow-y: auto;
            margin: 20px 0;
            animation: slideUp 0.3s ease;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(42, 49, 61, 0.5);
        }

        .modal-title {
            font-family: "Fraunces", serif;
            font-size: 24px;
            font-weight: 600;
            color: var(--ink);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .modal-title i {
            color: var(--accent);
        }

        .modal-close {
            background: none;
            border: none;
            color: var(--muted);
            font-size: 24px;
            cursor: pointer;
            transition: color 0.2s ease;
            padding: 5px;
        }

        .modal-close:hover {
            color: var(--accent);
        }

        /* Animations */
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

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes slideUp {
            from { 
                opacity: 0;
                transform: translateY(30px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            body {
                padding: 20px 15px;
            }
            
            .container {
                padding: 0;
            }
            
            .dashboard-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .header-left {
                width: 100%;
                justify-content: space-between;
                flex-wrap: wrap;
            }

            .admin-badge {
                width: 100%;
                justify-content: center;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }
            
            .dashboard-grid {
                gap: 20px;
            }
            
            .card {
                padding: 20px;
            }
            
            .card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .action-cards {
                grid-template-columns: 1fr 1fr;
            }
            
            .table-container {
                border-radius: 10px;
            }
            
            .table th, .table td {
                padding: 12px 15px;
            }
        }

        @media (max-width: 640px) {
            .stats-grid {
                grid-template-columns: repeat(2, minmax(140px, 1fr));
                gap: 12px;
            }

            .stat-card {
                padding: 16px;
                border-radius: 16px;
            }

            .stat-icon {
                width: 40px;
                height: 40px;
                font-size: 16px;
                margin-bottom: 10px;
            }

            .stat-content h3 {
                font-size: 11px;
                letter-spacing: 0.4px;
            }

            .stat-value {
                font-size: 24px;
            }

            .header-left {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .card-actions {
                width: 100%;
                justify-content: flex-start;
            }

            .action-cards {
                grid-template-columns: repeat(2, minmax(140px, 1fr));
            }

            .table {
                min-width: 0;
            }

            .table thead {
                display: none;
            }

            .table,
            .table tbody,
            .table tr,
            .table td {
                display: block;
                width: 100%;
            }

            .table tr {
                border: 1px solid var(--stroke);
                border-radius: 12px;
                margin-bottom: 12px;
                background: rgba(17, 21, 28, 0.5);
            }

            .table td {
                display: flex;
                justify-content: space-between;
                gap: 12px;
                padding: 12px 16px;
            }

            .table td::before {
                content: attr(data-label);
                color: var(--muted);
                font-weight: 600;
                font-size: 12px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .table tr.empty-row {
                border: none;
                background: transparent;
                margin: 0;
            }

            .table tr.empty-row td {
                padding: 0;
                display: block;
            }

            .table tr.empty-row td::before {
                content: none;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 15px 10px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, minmax(140px, 1fr));
            }
            
            .header-text h1 {
                font-size: 24px;
            }
            
            .stat-card {
                padding: 16px;
            }
            
            .stat-value {
                font-size: 24px;
            }
            
            .card-title {
                font-size: 20px;
            }
            
            .action-cards {
                grid-template-columns: repeat(2, minmax(140px, 1fr));
            }
            
            .subscription-form {
                padding: 20px;
            }
            
            .modal-content {
                padding: 20px;
            }
        }

        /* Loading Skeleton */
        .skeleton {
            background: linear-gradient(90deg, rgba(42, 49, 61, 0.2) 25%, rgba(42, 49, 61, 0.4) 50%, rgba(42, 49, 61, 0.2) 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
    </style>
</head>
<body data-plan-blocked="<?php echo !empty($blocked) ? '1' : '0'; ?>">
    <div class="container">
        <?php if (!empty($billing_notice)): ?>
            <div class="alert success">
                <i class="fas fa-check-circle"></i>
                <?php echo htmlspecialchars($billing_notice); ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($billing_error)): ?>
            <div class="alert error">
                <i class="fas fa-exclamation-circle"></i>
                <?php echo htmlspecialchars($billing_error); ?>
            </div>
        <?php endif; ?>
        <!-- Header -->
        <header class="dashboard-header">
            <div class="header-left">
                <div class="header-logo">
                    <i class="fas fa-users"></i>
                </div>
                <div class="header-text">
                    <h1>Dashboard Admin</h1>
                </div>
            </div>
            <div class="admin-badge">
                Administrator
            </div>
        </header>

        <!-- Stats Overview -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon users">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-content">
                    <h3>Total Users</h3>
                    <div class="stat-value"><?php echo isset($stats['total_users']) ? $stats['total_users'] : '0'; ?></div>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon rooms">
                    <i class="fas fa-door-open"></i>
                </div>
                <div class="stat-content">
                    <h3>Total Ruangan</h3>
                    <div class="stat-value"><?php echo isset($stats['total_rooms']) ? $stats['total_rooms'] : '0'; ?></div>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon bookings">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="stat-content">
                    <h3>Booking Bulan Ini</h3>
                    <div class="stat-value"><?php echo isset($stats['monthly_bookings']) ? $stats['monthly_bookings'] : '0'; ?></div>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon active">
                    <i class="fas fa-bolt"></i>
                </div>
                <div class="stat-content">
                    <h3>Meeting Aktif</h3>
                    <div class="stat-value"><?php echo isset($stats['active_meetings']) ? $stats['active_meetings'] : '0'; ?></div>
                </div>
            </div>
        </div>
        <div class="card" style="margin-bottom:30px;">
            <div class="card-header">
                <h2 class="card-title">
                    <i class="fas fa-crown"></i>
                    Status Akun
                </h2>
            </div>

            <?php if ($plan_status['type'] === 'paid'): ?>
                <div class="alert success">
                    <i class="fas fa-check-circle"></i>
                    Akun <strong>Berbayar</strong> — sisa
                    <strong><?php echo $plan_status['days_left']; ?> hari</strong>
                    <br>
                    Aktif sampai: <?php echo $plan_status['until']; ?>
                </div>

            <?php elseif ($plan_status['type'] === 'trial'): ?>
                <div class="alert warning">
                    <i class="fas fa-hourglass-half"></i>
                    Akun <strong>Trial</strong> — sisa
                    <strong><?php echo $plan_status['days_left']; ?> hari</strong>
                    <br>
                    Berakhir: <?php echo $plan_status['until']; ?>
                </div>

            <?php else: ?>
                <div class="alert error">
                    <i class="fas fa-ban"></i>
                    Akun <strong>Tidak Aktif</strong> — perlu perpanjangan
                </div>
            <?php endif; ?>

            <!-- Extend Paid -->
            <div class="subscription-form">
                <h3><i class="fas fa-plus-circle"></i> Perpanjang Langganan</h3>
                <a href="/billing/checkout" class="btn btn-primary">
                    <i class="fas fa-credit-card"></i>
                    Bayar  - Rp95.000/30 hari
                </a>
            </div>
        </div>

        <!-- Main Dashboard Grid -->
        <div class="dashboard-grid">
            <!-- Left Column -->
            <div class="left-column">
                <!-- Quick Actions -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-bolt"></i>
                            Quick Actions
                        </h2>
                        <div class="card-actions">
                            <button class="btn btn-secondary" onclick="refreshDashboard()">
                                <i class="fas fa-redo"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="action-cards">
                        <a href="/users" class="action-card">
                            <i class="fas fa-user-plus"></i>
                            <span>Tambah User</span>
                        </a>
                        <a href="/rooms" class="action-card">
                            <i class="fas fa-door-open"></i>
                            <span>Kelola Ruangan</span>
                        </a>
                        <a href="/bookings" class="action-card">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Jadwalkan Meeting</span>
                        </a>
                        <a href="/reports" class="action-card">
                            <i class="fas fa-chart-bar"></i>
                            <span>Lihat Laporan</span>
                        </a>
                    </div>
                </div>

                <!-- Subscription Status -->
                <?php if (!empty($blocked)): ?>
                <div class="card" id="subscription" style="margin-top: 30px;">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-credit-card"></i>
                            Status Langganan
                        </h2>
                    </div>
                    
                    <?php if (!empty($plan_message)): ?>
                        <div class="alert error">
                            <i class="fas fa-exclamation-circle"></i>
                            <?php echo htmlspecialchars($plan_message); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="alert warning">
                        <i class="fas fa-ban"></i>
                        Akses scheduling diblokir karena masa trial/pembayaran habis.
                    </div>
                    
                    <div class="subscription-form">
                        <h3><i class="fas fa-rocket"></i> Aktifkan Kembali</h3>
                        <a href="/billing/checkout" class="btn btn-primary">
                            <i class="fas fa-credit-card"></i>
                            Bayar & Aktifkan 30 Hari
                        </a>
                    </div>
                    
                    <div class="subscription-form">
                        <h3><i class="fas fa-calendar-plus"></i> Perpanjang Manual</h3>
                        <form method="post">
                            <input type="hidden" name="action" value="extend_paid">
                            <div class="form-group">
                                <label>Tanggal Berakhir</label>
                                <input type="datetime-local" name="paid_until" required>
                            </div>
                            <button type="submit" class="btn btn-secondary">
                                <i class="fas fa-save"></i>
                                Simpan Perpanjangan
                            </button>
                        </form>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            
            <!-- Right Column -->
            <div class="right-column">
                <!-- Recent Bookings -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-history"></i>
                            Recent Bookings
                        </h2>
                        <div class="card-actions">
                            <a href="/bookings" class="btn btn-secondary">
                                <i class="fas fa-external-link-alt"></i>
                                Lihat Semua
                            </a>
                        </div>
                    </div>
                    
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Ruangan</th>
                                    <th>Waktu</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($recent): ?>
                                    <?php foreach ($recent as $row): 
                                        // Determine status based on time
                                        $now = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
                                        $start = new DateTime($row['start_time'], new DateTimeZone('Asia/Jakarta'));
                                        $end = new DateTime($row['end_time'], new DateTimeZone('Asia/Jakarta'));
                                        
                                        if ($now > $end) {
                                            $status = 'completed';
                                            $statusText = 'Selesai';
                                            $statusClass = 'status-completed';
                                        } elseif ($now >= $start && $now <= $end) {
                                            $status = 'ongoing';
                                            $statusText = 'Berlangsung';
                                            $statusClass = 'status-ongoing';
                                        } else {
                                            $status = 'upcoming';
                                            $statusText = 'Akan Datang';
                                            $statusClass = 'status-upcoming';
                                        }
                                    ?>
                                    <tr>
                                        <td data-label="User">
                                            <div style="display: flex; align-items: center; gap: 10px;">
                                                <div style="width: 32px; height: 32px; border-radius: 50%; background: rgba(87, 184, 255, 0.2); display: flex; align-items: center; justify-content: center; color: var(--info);">
                                                    <?php echo strtoupper(substr($row['user_name'], 0, 1)); ?>
                                                </div>
                                                <span><?php echo htmlspecialchars($row['user_name']); ?></span>
                                            </div>
                                        </td>
                                        <td data-label="Ruangan"><?php echo htmlspecialchars($row['room_name']); ?></td>
                                        <td data-label="Waktu">
                                            <?php 
                                                $startTime = date('H:i', strtotime($row['start_time']));
                                                $endTime = date('H:i', strtotime($row['end_time']));
                                                echo $startTime . ' - ' . $endTime;
                                            ?>
                                        </td>
                                        <td data-label="Status">
                                            <span class="booking-status <?php echo $statusClass; ?>">
                                                <?php echo $statusText; ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr class="empty-row">
                                        <td colspan="4" style="padding: 40px 20px;">
                                            <div class="empty-state">
                                                <i class="fas fa-calendar-times"></i>
                                                <h3>Belum ada booking</h3>
                                                <p>Mulai jadwalkan meeting pertama Anda</p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Subscription Modal -->
    <?php if (!empty($blocked)): ?>
    <div class="modal" id="subscriptionModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">
                    <i class="fas fa-lock"></i>
                    Akses Terkunci
                </h2>
                <button class="modal-close" onclick="closeModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div style="margin: 20px 0;">
                <div style="text-align: center; margin-bottom: 20px;">
                    <div style="width: 80px; height: 80px; border-radius: 50%; background: rgba(255, 87, 87, 0.1); display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; border: 2px solid rgba(255, 87, 87, 0.3);">
                        <i class="fas fa-ban" style="font-size: 32px; color: var(--error);"></i>
                    </div>
                    <h3 style="font-family: 'Fraunces', serif; font-size: 20px; color: var(--ink); margin-bottom: 10px;">
                        Fitur Dikunci
                    </h3>
                </div>
                
                <?php if (!empty($plan_message)): ?>
                    <div class="alert error">
                        <i class="fas fa-exclamation-circle"></i>
                        <?php echo htmlspecialchars($plan_message); ?>
                    </div>
                <?php endif; ?>
                
                <p style="color: var(--muted); font-size: 14px; line-height: 1.6; margin-bottom: 20px;">
                    Untuk mengakses semua fitur scheduling, silakan aktifkan kembali langganan Anda.
                </p>
                
                <div style="display: flex; gap: 10px; margin-top: 20px;">
                    <button class="btn btn-secondary" onclick="closeModal()" style="flex: 1;">
                        <i class="fas fa-times"></i>
                        Tutup
                    </button>
                    <a href="#subscription" class="btn btn-primary" style="flex: 2;">
                        <i class="fas fa-credit-card"></i>
                        Aktifkan Langganan
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const blocked = document.body.dataset.planBlocked === '1';
            const modal = document.getElementById('subscriptionModal');
            
            // Close modal function
            window.closeModal = function() {
                if (modal) {
                    modal.classList.remove('active');
                    document.body.style.overflow = 'auto';
                }
            };
            
            // Close modal on outside click
            if (modal) {
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        closeModal();
                    }
                });
            }
            
            // Close modal with ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && modal && modal.classList.contains('active')) {
                    closeModal();
                }
            });
            
            // Prevent blocked actions
            document.querySelectorAll('a[href^="/"]').forEach(link => {
                if (blocked && !modal) return;
                
                const href = link.getAttribute('href');
                const allowedPaths = ['/users', '/rooms', '/bookings', '/reports', '/logout'];
                
                if (href && !allowedPaths.includes(href) && href !== '#' && !href.startsWith('#')) {
                    link.addEventListener('click', function(e) {
                        if (blocked) {
                            e.preventDefault();
                            if (modal) {
                                modal.classList.add('active');
                                document.body.style.overflow = 'hidden';
                            }
                        }
                    });
                }
            });
            
            // Refresh dashboard function
            window.refreshDashboard = function() {
                const btn = document.querySelector('[onclick="refreshDashboard()"]');
                const icon = btn.querySelector('i');
                const originalClass = icon.className;
                
                icon.className = 'fas fa-spinner fa-spin';
                btn.disabled = true;
                
                setTimeout(() => {
                    window.location.reload();
                }, 500);
            };
            
            // Form submission loading states
            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', function() {
                    const submitBtn = this.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        const originalHTML = submitBtn.innerHTML;
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
                        submitBtn.disabled = true;
                        
                        // Revert after 5 seconds if still processing
                        setTimeout(() => {
                            if (submitBtn.disabled) {
                                submitBtn.innerHTML = originalHTML;
                                submitBtn.disabled = false;
                            }
                        }, 5000);
                    }
                });
            });
            
            // Stats counter animation (demo)
            const statValues = document.querySelectorAll('.stat-value');
            statValues.forEach(stat => {
                if (stat.textContent.trim() === '0') return;
                
                const value = parseInt(stat.textContent);
                let counter = 0;
                const increment = Math.ceil(value / 20);
                const timer = setInterval(() => {
                    counter += increment;
                    if (counter >= value) {
                        counter = value;
                        clearInterval(timer);
                    }
                    stat.textContent = counter;
                }, 50);
            });
        });
    </script>
</body>
</html>


