<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RuangMeet | Checkout Register</title>
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
            padding: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .wrapper {
            width: 100%;
            max-width: 960px;
            display: grid;
            grid-template-columns: 1.1fr 1fr;
            gap: 20px;
        }

        .card {
            background: linear-gradient(145deg, rgba(26, 31, 40, 0.95) 0%, rgba(22, 27, 36, 0.95) 100%);
            border-radius: 20px;
            padding: 28px;
            border: 1px solid var(--stroke);
            box-shadow: var(--shadow);
        }

        .title {
            font-family: "Fraunces", serif;
            font-size: 30px;
            margin-bottom: 8px;
        }

        .muted { color: var(--muted); }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin: 12px 0;
            color: var(--muted);
            gap: 12px;
        }

        .summary-item strong {
            color: var(--ink);
            text-align: right;
        }

        .price {
            margin-top: 18px;
            padding-top: 18px;
            border-top: 1px solid var(--stroke);
            display: flex;
            justify-content: space-between;
            align-items: baseline;
        }

        .price b {
            font-size: 30px;
            color: var(--accent);
            font-family: "Fraunces", serif;
        }

        .methods {
            margin-top: 20px;
            display: grid;
            gap: 12px;
        }

        .method {
            display: flex;
            align-items: center;
            border: 1px solid var(--stroke);
            border-radius: 12px;
            padding: 14px 16px;
            background: rgba(11, 13, 18, 0.65);
            cursor: pointer;
            gap: 12px;
        }

        .method input {
            margin: 0;
            width: 18px;
            height: 18px;
            padding: 0;
            border: 0;
            background: transparent;
            flex: 0 0 auto;
            accent-color: var(--accent);
        }

        .method-icon {
            width: 22px;
            text-align: center;
            color: #d5d8df;
            flex: 0 0 22px;
        }

        .method-text {
            font-weight: 600;
            line-height: 1.3;
        }

        .actions {
            margin-top: 18px;
            display: flex;
            gap: 10px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border-radius: 12px;
            border: 1px solid var(--stroke);
            padding: 12px 16px;
            text-decoration: none;
            font-weight: 600;
            cursor: pointer;
            font-family: "Space Grotesk", sans-serif;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-2) 100%);
            color: #1a1a1a;
            border: none;
            flex: 1;
        }

        .btn-secondary {
            background: rgba(11, 13, 18, 0.65);
            color: var(--ink);
            flex: 1;
        }

        .alert {
            margin-top: 14px;
            border-radius: 12px;
            border: 1px solid rgba(255, 87, 87, 0.3);
            background: rgba(255, 87, 87, 0.12);
            color: var(--error);
            padding: 12px;
            font-size: 14px;
        }

        @media (max-width: 860px) {
            .wrapper { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <section class="card">
            <h1 class="title">Checkout Register</h1>
            <p class="muted">Pilih metode pembayaran sebelum masuk ke payment gateway.</p>

            <?php if (!empty($error)): ?>
                <div class="alert"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form method="post" class="methods">
                <?php $selectedMethod = $pending['payment_method'] ?? 'bank_va'; ?>

                <label class="method">
                    <input type="radio" name="payment_method" value="bank_va" <?php echo $selectedMethod === 'bank_va' ? 'checked' : ''; ?>>
                    <span class="method-icon"><i class="fas fa-university"></i></span>
                    <span class="method-text">Virtual Account (BCA/BNI/BRI)</span>
                </label>
                <label class="method">
                    <input type="radio" name="payment_method" value="qris" <?php echo $selectedMethod === 'qris' ? 'checked' : ''; ?>>
                    <span class="method-icon"><i class="fas fa-qrcode"></i></span>
                    <span class="method-text">QRIS</span>
                </label>
                <label class="method">
                    <input type="radio" name="payment_method" value="ewallet" <?php echo $selectedMethod === 'ewallet' ? 'checked' : ''; ?>>
                    <span class="method-icon"><i class="fas fa-wallet"></i></span>
                    <span class="method-text">E-Wallet (OVO, DANA, GoPay)</span>
                </label>
                <label class="method">
                    <input type="radio" name="payment_method" value="card" <?php echo $selectedMethod === 'card' ? 'checked' : ''; ?>>
                    <span class="method-icon"><i class="fas fa-credit-card"></i></span>
                    <span class="method-text">Kartu Kredit/Debit</span>
                </label>

                <div class="actions">
                    <a href="/register" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-lock"></i>
                        Lanjut ke Payment
                    </button>
                </div>
            </form>
        </section>

        <aside class="card">
            <h2 style="font-size:20px; margin-bottom:10px;">Ringkasan Tagihan</h2>
            <div class="summary-item"><span>Nama</span><strong><?php echo htmlspecialchars($pending['name'] ?? '-'); ?></strong></div>
            <div class="summary-item"><span>Email</span><strong><?php echo htmlspecialchars($pending['email'] ?? '-'); ?></strong></div>
            <div class="summary-item"><span>Paket</span><strong>Langganan Bulanan</strong></div>
            <div class="summary-item"><span>Masa aktif</span><strong><?php echo (int)($pending['days'] ?? 30); ?> hari</strong></div>
            <div class="summary-item"><span>Metode saat ini</span><strong><?php echo htmlspecialchars($method_label ?? 'Virtual Account'); ?></strong></div>
            <div class="price">
                <span>Total</span>
                <b>Rp<?php echo number_format((int)($pending['amount'] ?? 95000), 0, ',', '.'); ?></b>
            </div>
            <p class="muted" style="margin-top:14px; font-size:13px;">Setelah memilih metode, Anda akan diarahkan ke halaman payment gateway untuk konfirmasi.</p>
        </aside>
    </div>
</body>
</html>
