<?php
/** @var array $stats */
$currentUser = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RuangMeet | Super Admin Dashboard</title>
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
            --pink: #ff57b3;
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

        .logout-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            border-radius: 8px;
            border: 1px solid rgba(255, 87, 87, 0.3);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            color: var(--error);
            background: rgba(255, 87, 87, 0.1);
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .logout-btn:hover {
            border-color: var(--error);
            background: var(--error);
            color: var(--ink);
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        .stat-card {
            background: var(--card);
            border-radius: 20px;
            padding: 30px;
            box-shadow: var(--shadow);
            border: 1px solid var(--stroke);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 60px rgba(5, 6, 9, 0.75);
            border-color: rgba(247, 200, 66, 0.3);
        }

        .stat-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 10px;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: var(--ink);
        }

        .stat-icon.admin {
            background: linear-gradient(135deg, var(--warning) 0%, #ffc477 100%);
        }

        .stat-icon.user {
            background: linear-gradient(135deg, var(--info) 0%, #80d1ff 100%);
        }

        .stat-icon.booking {
            background: linear-gradient(135deg, var(--success) 0%, #8dffa4 100%);
        }

        .stat-icon.room {
            background: linear-gradient(135deg, var(--purple) 0%, #d19cff 100%);
        }

        .stat-icon.schedule {
            background: linear-gradient(135deg, var(--cyan) 0%, #95e8ff 100%);
        }

        .stat-icon.analytics {
            background: linear-gradient(135deg, var(--pink) 0%, #ff95d0 100%);
        }

        .stat-title {
            font-family: "Fraunces", serif;
            font-size: 20px;
            font-weight: 600;
            color: var(--ink);
        }

        .stat-subtitle {
            font-size: 14px;
            color: var(--muted);
        }

        .stat-value {
            font-size: 48px;
            font-weight: 700;
            color: var(--ink);
            line-height: 1;
            margin-top: 10px;
        }

        .stat-growth {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-top: 10px;
        }

        .stat-growth.positive {
            background: rgba(87, 255, 117, 0.1);
            color: var(--success);
            border: 1px solid rgba(87, 255, 117, 0.3);
        }

        .stat-growth.negative {
            background: rgba(255, 87, 87, 0.1);
            color: var(--error);
            border: 1px solid rgba(255, 87, 87, 0.3);
        }

        /* Quick Actions */
        .quick-actions {
            margin-bottom: 40px;
        }

        .section-title {
            font-family: "Fraunces", serif;
            font-size: 24px;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: var(--accent);
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .action-card {
            background: var(--card);
            border-radius: 15px;
            padding: 25px;
            box-shadow: var(--shadow);
            border: 1px solid var(--stroke);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 20px;
            text-decoration: none;
            cursor: pointer;
        }

        .action-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(5, 6, 9, 0.7);
            border-color: rgba(247, 200, 66, 0.4);
            background: rgba(26, 31, 40, 0.8);
        }

        .action-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: var(--ink);
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-2) 100%);
        }

        .action-content {
            flex: 1;
        }

        .action-title {
            font-family: "Space Grotesk", sans-serif;
            font-size: 16px;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 5px;
        }

        .action-desc {
            font-size: 13px;
            color: var(--muted);
        }

        /* System Status */
        .system-status {
            margin-bottom: 40px;
        }

        .status-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .status-item {
            background: var(--card);
            border-radius: 12px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            border: 1px solid var(--stroke);
        }

        .status-indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .status-indicator.online {
            background: var(--success);
            box-shadow: 0 0 10px rgba(87, 255, 117, 0.5);
        }

        .status-indicator.warning {
            background: var(--warning);
            box-shadow: 0 0 10px rgba(255, 168, 87, 0.5);
        }

        .status-indicator.offline {
            background: var(--error);
            box-shadow: 0 0 10px rgba(255, 87, 87, 0.5);
        }

        .status-content {
            flex: 1;
        }

        .status-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 2px;
        }

        .status-subtitle {
            font-size: 12px;
            color: var(--muted);
        }

        /* Recent Activity */
        .recent-activity {
            margin-bottom: 40px;
        }

        .activity-list {
            background: var(--card);
            border-radius: 15px;
            overflow: hidden;
            border: 1px solid var(--stroke);
        }

        .activity-item {
            padding: 20px 25px;
            border-bottom: 1px solid var(--stroke);
            display: flex;
            align-items: center;
            gap: 15px;
            transition: all 0.2s ease;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-item:hover {
            background: rgba(17, 21, 28, 0.4);
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: var(--ink);
        }

        .activity-icon.create {
            background: linear-gradient(135deg, var(--success) 0%, #8dffa4 100%);
        }

        .activity-icon.update {
            background: linear-gradient(135deg, var(--info) 0%, #80d1ff 100%);
        }

        .activity-icon.delete {
            background: linear-gradient(135deg, var(--error) 0%, #ff8080 100%);
        }

        .activity-icon.access {
            background: linear-gradient(135deg, var(--warning) 0%, #ffc477 100%);
        }

        .activity-content {
            flex: 1;
        }

        .activity-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 3px;
        }

        .activity-time {
            font-size: 12px;
            color: var(--muted);
        }

        .activity-user {
            font-size: 12px;
            color: var(--accent);
            font-weight: 600;
        }

        /* Welcome Card */
        .welcome-card {
            background: linear-gradient(135deg, var(--card) 0%, rgba(26, 31, 40, 0.9) 100%);
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 40px;
            border: 1px solid var(--stroke);
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
        }

        .welcome-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(247, 200, 66, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .welcome-title {
            font-family: "Fraunces", serif;
            font-size: 32px;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 10px;
        }

        .welcome-subtitle {
            font-size: 18px;
            color: var(--muted);
            margin-bottom: 25px;
            max-width: 600px;
        }

        .welcome-features {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 25px;
        }

        .welcome-feature {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: rgba(247, 200, 66, 0.1);
            border: 1px solid rgba(247, 200, 66, 0.3);
            border-radius: 20px;
            font-size: 14px;
            color: var(--accent);
        }

        .welcome-feature i {
            font-size: 12px;
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
        }

        @media (max-width: 768px) {
            body {
                padding: 20px 12px;
            }

            .header h1 {
                font-size: 28px;
            }

            .stat-card {
                padding: 25px;
            }

            .stat-value {
                font-size: 36px;
            }

            .welcome-card {
                padding: 25px;
            }

            .welcome-title {
                font-size: 24px;
            }

            .welcome-subtitle {
                font-size: 16px;
            }

            .activity-item {
                padding: 15px 20px;
            }
        }

        @media (max-width: 480px) {
            .header h1 {
                font-size: 24px;
            }

            .stat-value {
                font-size: 32px;
            }

            .welcome-card {
                padding: 20px;
            }

            .welcome-title {
                font-size: 20px;
            }

            .welcome-subtitle {
                font-size: 14px;
            }

            .welcome-feature {
                font-size: 12px;
                padding: 6px 12px;
            }

            .action-card {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>
                Super Admin Dashboard
            </h1>
            <div class="header-actions">
                <a href="/logout" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            </div>
        </div>

        <!-- Welcome Section -->
        <div class="welcome-card">
            <div class="welcome-title">Selamat Datang, <?= htmlspecialchars($currentUser['name']) ?>!</div>
            <div class="welcome-features">
                <div class="welcome-feature">
                    <i class="fas fa-shield-alt"></i>
                    Akses Penuh
                </div>
                <div class="welcome-feature">
                    <i class="fas fa-user-shield"></i>
                    Manajemen Admin
                </div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon admin">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div>
                        <div class="stat-title">Total Admin</div>
                    </div>
                </div>
                <div class="stat-value"><?= number_format((int)$stats['admins']) ?></div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon user">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <div class="stat-title">Total User</div>
                    </div>
                </div>
                <div class="stat-value"><?= number_format((int)$stats['users']) ?></div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon booking">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div>
                        <div class="stat-title">Total Booking</div>
                    </div>
                </div>
                <div class="stat-value"><?= number_format((int)$stats['bookings']) ?></div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions">
            <h2 class="section-title">
                <i class="fas fa-bolt"></i>
                Quick Actions
            </h2>
            <div class="actions-grid">
                <a href="/super/admins" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-user-cog"></i>
                    </div>
                    <div class="action-content">
                        <div class="action-title">Kelola Admin</div>
                        <div class="action-desc">Tambah, edit, atau hapus admin sistem</div>
                    </div>
                </a>

                <a href="/super/users" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-user-edit"></i>
                    </div>
                    <div class="action-content">
                        <div class="action-title">Kelola User</div>
                        <div class="action-desc">Kelola semua pengguna terdaftar</div>
                    </div>
                </a>

                <a href="/super/bookings" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="action-content">
                        <div class="action-title">Scheduling</div>
                        <div class="action-desc">Lihat dan kelola semua booking</div>
                    </div>
                </a>

            </div>
        </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animasi untuk stat cards
            const statCards = document.querySelectorAll('.stat-card');
            statCards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    card.style.transition = 'all 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });

            // Hover efek untuk action cards
            const actionCards = document.querySelectorAll('.action-card');
            actionCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });

            // Real-time update untuk statistik (contoh)
            function updateStats() {
                // Di sini bisa ditambahkan AJAX call untuk update statistik real-time
                console.log('Updating stats...');
            }

            // Update setiap 30 detik
            setInterval(updateStats, 30000);

            // Smooth scroll untuk anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    if (targetId !== '#') {
                        const targetElement = document.querySelector(targetId);
                        if (targetElement) {
                            window.scrollTo({
                                top: targetElement.offsetTop - 20,
                                behavior: 'smooth'
                            });
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>