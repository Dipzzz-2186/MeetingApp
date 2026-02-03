<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MeetFlow | Admin Dashboard</title>
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
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: "Space Grotesk", sans-serif;
            color: var(--ink);
            background: radial-gradient(circle at top left, #1a1f28 0%, #101319 55%, #0b0d12 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .grid.two.admin-dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 20px;
            margin-bottom: 24px;
        }

        .card.admin-card {
            background: linear-gradient(180deg, rgba(26, 31, 40, 0.98) 0%, rgba(20, 24, 32, 0.98) 100%);
            border: 1px solid var(--stroke);
            border-radius: 18px;
            padding: 24px;
            box-shadow: var(--shadow);
            color: var(--ink);
        }

        .admin-head {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--stroke);
        }

        .admin-kicker {
            text-transform: uppercase;
            letter-spacing: 1.4px;
            font-size: 11px;
            color: var(--accent);
            margin: 0 0 6px;
            font-weight: 700;
        }

        .admin-card h1, .admin-card h2 {
            font-family: "Fraunces", serif;
            margin: 0;
            color: var(--ink);
        }

        .admin-card h1 {
            font-size: 24px;
        }

        .admin-card h2 {
            font-size: 20px;
        }

        .admin-badge {
            padding: 6px 12px;
            border-radius: 999px;
            background: rgba(247, 200, 66, 0.16);
            color: var(--accent);
            font-weight: 700;
            font-size: 12px;
        }

        .alert {
            padding: 12px 14px;
            border-radius: 12px;
            background: rgba(247, 200, 66, 0.12);
            border: 1px solid rgba(247, 200, 66, 0.35);
            margin-bottom: 16px;
            font-size: 14px;
        }

        .alert.error {
            background: rgba(255, 87, 87, 0.12);
            border: 1px solid rgba(255, 87, 87, 0.35);
            color: #ff5757;
        }

        .alert.warning {
            background: rgba(247, 200, 66, 0.12);
            border: 1px solid rgba(247, 200, 66, 0.35);
            color: var(--accent);
        }

        .admin-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 12px;
            margin-top: 16px;
        }

        .admin-link {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 16px 12px;
            background: rgba(17, 21, 28, 0.9);
            border: 1px solid var(--stroke);
            border-radius: 12px;
            text-decoration: none;
            color: var(--ink);
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s ease;
            text-align: center;
        }

        .admin-link:hover {
            background: rgba(24, 28, 37, 0.9);
            border-color: rgba(247, 200, 66, 0.35);
            transform: translateY(-2px);
            box-shadow: 0 10px 18px rgba(10, 30, 45, 0.45);
        }

        .admin-link i {
            font-size: 18px;
            margin-bottom: 8px;
            color: var(--accent);
        }

        .admin-form {
            background: rgba(17, 21, 28, 0.9);
            border: 1px solid var(--stroke);
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 12px;
        }

        .admin-form:last-child {
            margin-bottom: 0;
        }

        .admin-form label {
            display: block;
            font-weight: 600;
            font-size: 13px;
            color: var(--ink);
            margin-bottom: 6px;
        }

        .admin-form input {
            width: 100%;
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid var(--stroke);
            background: #11151c;
            color: var(--ink);
            font-size: 14px;
            margin-bottom: 12px;
        }

        .admin-form input:focus {
            outline: none;
            border-color: var(--accent);
        }

        .admin-form button {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: none;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            font-family: "Space Grotesk", sans-serif;
        }

        .admin-form button[type="submit"] {
            background: var(--accent);
            color: #1a1a1a;
        }

        .admin-form button[type="submit"]:hover {
            background: var(--accent-2);
        }

        .admin-form button.secondary {
            background: #222832;
            color: var(--ink);
        }

        .admin-form button.secondary:hover {
            background: #2a313d;
        }

        .admin-table {
            margin-top: 24px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }

        .table thead {
            background: rgba(17, 21, 28, 0.9);
        }

        .table th {
            text-align: left;
            padding: 12px 16px;
            font-weight: 600;
            font-size: 14px;
            color: var(--ink);
            border-bottom: 1px solid var(--stroke);
        }

        .table td {
            padding: 12px 16px;
            border-bottom: 1px solid var(--stroke);
            font-size: 14px;
            color: var(--ink);
        }

        .table tbody tr:hover {
            background: rgba(17, 21, 28, 0.5);
        }

        .table .muted {
            text-align: center;
            color: var(--muted);
            padding: 24px 16px;
        }

        @media (max-width: 768px) {
            body {
                padding: 16px;
            }
            
            .grid.two.admin-dashboard {
                grid-template-columns: 1fr;
                gap: 16px;
            }
            
            .card.admin-card {
                padding: 20px;
            }
            
            .admin-head {
                flex-direction: column;
                gap: 12px;
            }
            
            .admin-actions {
                grid-template-columns: 1fr;
            }
            
            .table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
        }

        @media (max-width: 480px) {
            .card.admin-card {
                padding: 16px;
            }
            
            .admin-card h1 {
                font-size: 20px;
            }
            
            .admin-card h2 {
                font-size: 18px;
            }
            
            .admin-form {
                padding: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="grid two admin-dashboard">
        <div class="card admin-card">
            <div class="admin-head">
                <div>
                    <p class="admin-kicker">Admin Control</p>
                    <h1>Dashboard Admin</h1>
                </div>
                <div class="admin-badge">MeetFlow</div>
            </div>
            
            <?php if (!empty($plan_message)): ?>
                <div class="alert error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo htmlspecialchars($plan_message); ?>
                </div>
            <?php endif; ?>
            
            <?php if (!empty($blocked)): ?>
                <div class="alert warning">
                    <i class="fas fa-ban"></i>
                    Akses scheduling diblokir karena masa trial/pembayaran habis.
                </div>
            <?php endif; ?>
            
            <div class="admin-actions">
                <a class="admin-link" href="/users">
                    <i class="fas fa-user-plus"></i>
                    Add User
                </a>
                <a class="admin-link" href="/rooms">
                    <i class="fas fa-door-open"></i>
                    Add Room
                </a>
                <a class="admin-link" href="/bookings">
                    <i class="fas fa-calendar-alt"></i>
                    Scheduling
                </a>
            </div>
        </div>
        
        <div class="card admin-card">
            <div class="admin-head">
                <div>
                    <p class="admin-kicker">Subscription</p>
                    <h2>Kelola Paket</h2>
                </div>
            </div>
            
            <form method="post" class="admin-form">
                <input type="hidden" name="action" value="mark_paid">
                <button class="secondary" type="submit">
                    <i class="fas fa-credit-card"></i>
                    Bayar / Aktifkan 30 Hari
                </button>
            </form>
            
            <form method="post" class="admin-form">
                <input type="hidden" name="action" value="extend_paid">
                <label>Atur Tanggal Paid Until</label>
                <input type="datetime-local" name="paid_until">
                <button type="submit">
                    <i class="fas fa-save"></i>
                    Simpan
                </button>
            </form>
        </div>
    </div>

    <div class="card admin-card admin-table">
        <div class="admin-head">
            <div>
                <p class="admin-kicker">Activity</p>
                <h2>Recent Bookings</h2>
            </div>
        </div>
        
        <table class="table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Room</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($recent): ?>
                    <?php foreach ($recent as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['room_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['start_time']); ?></td>
                            <td><?php echo htmlspecialchars($row['end_time']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="muted">
                            <i class="fas fa-calendar-times"></i>
                            Belum ada booking.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>