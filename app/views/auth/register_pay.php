<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RuangMeet | Payment Gateway Register</title>
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
            --error: #ff5757;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: "Space Grotesk", sans-serif;
            color: var(--ink);
            background: radial-gradient(circle at top left, #1a1f28 0%, #101319 55%, #0b0d12 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .card {
            width: 100%;
            max-width: 620px;
            background: linear-gradient(145deg, rgba(26, 31, 40, 0.95) 0%, rgba(22, 27, 36, 0.95) 100%);
            border: 1px solid var(--stroke);
            border-radius: 20px;
            box-shadow: var(--shadow);
            padding: 28px;
        }

        h1 {
            font-family: "Fraunces", serif;
            font-size: 28px;
            margin-bottom: 6px;
        }

        .muted { color: var(--muted); }

        .box {
            margin-top: 18px;
            border: 1px solid var(--stroke);
            border-radius: 12px;
            background: rgba(11, 13, 18, 0.6);
            padding: 14px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin: 8px 0;
            color: var(--muted);
        }

        .row strong { color: var(--ink); }

        .total {
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid var(--stroke);
            display: flex;
            justify-content: space-between;
            align-items: baseline;
        }

        .total b {
            font-family: "Fraunces", serif;
            font-size: 30px;
            color: var(--accent);
        }

        .actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 16px;
        }

        .btn {
            border-radius: 10px;
            padding: 12px;
            font-weight: 700;
            border: 1px solid var(--stroke);
            cursor: pointer;
            font-family: "Space Grotesk", sans-serif;
        }

        .btn-primary {
            border: none;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-2) 100%);
            color: #1a1a1a;
        }

        .btn-secondary {
            background: rgba(11, 13, 18, 0.7);
            color: var(--ink);
        }

        .alert {
            margin-top: 12px;
            border-radius: 10px;
            border: 1px solid rgba(255, 87, 87, 0.3);
            background: rgba(255, 87, 87, 0.12);
            color: var(--error);
            padding: 12px;
            font-size: 14px;
        }
    </style>
</head>
<body class="auth">
    <div class="card">
        <h1>Gateway Pembayaran</h1>
        <p class="muted">Selesaikan pembayaran untuk aktivasi akun berbayar 30 hari.</p>

        <?php if (!empty($error)): ?>
            <div class="alert"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <div class="box">
            <div class="row"><span>Nama</span><strong><?php echo htmlspecialchars($pending['name'] ?? '-'); ?></strong></div>
            <div class="row"><span>Email</span><strong><?php echo htmlspecialchars($pending['email'] ?? '-'); ?></strong></div>
            <div class="row"><span>Metode</span><strong><?php echo htmlspecialchars($method_label ?? 'Virtual Account'); ?></strong></div>
            <div class="row"><span>Durasi Aktif</span><strong><?php echo (int)($pending['days'] ?? 30); ?> hari</strong></div>
            <div class="total">
                <span>Total Bayar</span>
                <b>Rp<?php echo number_format((int)($pending['amount'] ?? 95000), 0, ',', '.'); ?></b>
            </div>
        </div>

        <div class="actions">
            <form method="post">
                <input type="hidden" name="action" value="cancel">
                <button class="btn btn-secondary" type="submit">Batal</button>
            </form>
            <form method="post">
                <input type="hidden" name="action" value="confirm">
                <button class="btn btn-primary" type="submit">Konfirmasi Pembayaran</button>
            </form>
        </div>
    </div>
</body>
</html>
