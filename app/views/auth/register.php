<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MeetFlow | Register</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        body.auth {
            background: #0f1218;
        }

        .auth-layout {
            display: flex;
            width: 100%;
            max-width: 900px;
            background: var(--card);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow);
            min-height: 500px;
        }

        .auth-side {
            flex: 1;
            background: linear-gradient(135deg, rgba(26, 31, 40, 0.95) 0%, rgba(20, 24, 32, 0.95) 100%);
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            border-right: 1px solid var(--stroke);
        }

        .auth-side::before {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(247, 200, 66, 0.05);
            border-radius: 50%;
            top: -50px;
            left: -50px;
        }

        .auth-side::after {
            content: '';
            position: absolute;
            width: 150px;
            height: 150px;
            background: rgba(247, 200, 66, 0.03);
            border-radius: 50%;
            bottom: -50px;
            right: -50px;
        }

        .auth-mini {
            position: relative;
            z-index: 2;
            text-align: left;
        }

        .auth-mini h2 {
            font-family: "Fraunces", serif;
            font-size: 32px;
            font-weight: 600;
            margin-bottom: 16px;
            line-height: 1.3;
            color: var(--ink);
        }

        .auth-mini p {
            font-size: 16px;
            line-height: 1.6;
            color: var(--muted);
            margin-bottom: 30px;
        }

        .auth-features {
            list-style: none;
            margin-top: 30px;
        }

        .auth-features li {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
            font-size: 15px;
            color: var(--muted);
        }

        .auth-features i {
            background: rgba(247, 200, 66, 0.1);
            color: var(--accent);
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            flex-shrink: 0;
        }

        .auth-card {
            flex: 1;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: var(--card);
        }

        .auth-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 8px;
            border: 1px solid rgba(242, 243, 245, 0.2);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            color: var(--muted);
            background: rgba(17, 21, 28, 0.7);
            margin-bottom: 20px;
            transition: all 0.2s ease;
        }

        .auth-back:hover {
            border-color: rgba(247, 200, 66, 0.4);
            color: var(--accent);
            background: rgba(17, 21, 28, 0.9);
        }

        .auth-card h1 {
            font-family: "Fraunces", serif;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--ink);
        }

        .muted {
            color: var(--muted);
            font-size: 15px;
            margin-bottom: 20px;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            background: rgba(87, 255, 117, 0.1);
            border: 1px solid rgba(87, 255, 117, 0.3);
            margin-bottom: 20px;
            color: #57ff75;
            font-size: 14px;
        }

        .alert.error {
            background: rgba(255, 87, 87, 0.1);
            border: 1px solid rgba(255, 87, 87, 0.3);
            color: #ff5757;
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
        }

        input {
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

        input:focus {
            outline: none;
            border-color: var(--accent);
            background: rgba(17, 21, 28, 0.95);
            box-shadow: 0 0 0 3px rgba(247, 200, 66, 0.1);
        }

        input::placeholder {
            color: rgba(154, 160, 170, 0.6);
        }

        .plan-toggle {
            margin-top: 10px;
            background: rgba(17, 21, 28, 0.7);
            border: 1px solid var(--stroke);
            border-radius: 10px;
            overflow: hidden;
            display: flex;
        }

        .plan-option {
            flex: 1;
            text-align: center;
            padding: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .plan-option input[type="radio"] {
            display: none;
        }

        .plan-option.active {
            background: rgba(247, 200, 66, 0.15);
            border: 1px solid rgba(247, 200, 66, 0.3);
            color: var(--accent);
            font-weight: 600;
        }

        .plan-option:not(.active):hover {
            background: rgba(154, 160, 170, 0.1);
        }

        .plan-details {
            margin-top: 15px;
            padding: 15px;
            background: rgba(17, 21, 28, 0.7);
            border-radius: 10px;
            border: 1px solid var(--stroke);
            display: none;
        }

        .plan-details.active {
            display: block;
        }

        .plan-details h3 {
            font-size: 16px;
            margin-bottom: 10px;
            color: var(--ink);
        }

        .plan-feature {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
            font-size: 14px;
            color: var(--muted);
        }

        .plan-feature i {
            color: var(--accent);
        }

        .plan-price {
            font-family: "Fraunces", serif;
            font-size: 24px;
            font-weight: 600;
            color: var(--accent);
            margin-top: 15px;
        }

        .checkbox {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            margin: 15px 0;
            color: var(--muted);
            font-size: 14px;
        }

        .checkbox input {
            width: auto;
        }

        .terms {
            font-size: 13px;
            color: var(--muted);
            margin-top: 10px;
        }

        .terms a {
            color: var(--accent);
            text-decoration: none;
        }

        .terms a:hover {
            text-decoration: underline;
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
        }

        button[type="submit"]:hover {
            background: var(--accent-2);
        }

        .auth-foot {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid var(--stroke);
            color: var(--muted);
            font-size: 14px;
        }

        .auth-foot a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
            margin-left: 6px;
        }

        .auth-foot a:hover {
            color: var(--accent-2);
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .auth-layout {
                flex-direction: column;
                max-width: 450px;
            }
            
            .auth-side {
                padding: 40px 30px;
                border-right: none;
                border-bottom: 1px solid var(--stroke);
            }
            
            .auth-card {
                padding: 40px 30px;
            }
            
            .auth-mini h2 {
                font-size: 26px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 16px;
            }
            
            .auth-side,
            .auth-card {
                padding: 30px 24px;
            }
            
            .auth-mini h2 {
                font-size: 24px;
            }
            
            .auth-card h1 {
                font-size: 24px;
            }
            
            input,
            button[type="submit"] {
                padding: 12px 14px;
            }
            
            .plan-toggle {
                flex-direction: column;
            }
        }
    </style>
</head>
<body class="auth">
    <div class="auth-layout">
        <div class="auth-side">
            <div class="auth-mini">
                <h2>Buat Akun</h2>
                <p>Bergabung dengan MeetFlow untuk mengelola ruang meeting dan jadwal dengan sistem manajemen yang efisien.</p>
                
                <ul class="auth-features">
                    <li><i class="fas fa-check"></i> Kelola semua ruang meeting</li>
                    <li><i class="fas fa-check"></i> Atur jadwal dengan mudah</li>
                    <li><i class="fas fa-check"></i> Pantau penggunaan ruangan</li>
                    <li><i class="fas fa-check"></i> Dapatkan akses prioritas</li>
                </ul>
            </div>
        </div>
        
        <div class="auth-card">
            <a class="auth-back" href="/">← Kembali ke Home</a>
            <h1>Register Akun</h1>
            <p class="muted">Isi data akun, lalu pilih paket yang diinginkan.</p>
            
            <!-- PHP success/error messages -->
            <?php if (!empty($success)): ?>
                <div class="alert"><?php echo htmlspecialchars($success); ?></div>
            <?php elseif (!empty($error)): ?>
                <div class="alert error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            
            <form method="post" class="grid" id="registerForm">
                <div>
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" placeholder="Nama Lengkap" value="<?php echo htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES); ?>" required>
                </div>
                <div>
                    <label>Email</label>
                    <input type="email" name="email" placeholder="you@company.com" value="<?php echo htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES); ?>" required>
                </div>
                <div>
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Minimal 8 karakter" required>
                </div>
                
                <div>
                    <label>Pilih Paket</label>
                    <div class="plan-toggle">
                        <label class="plan-option active" data-plan="trial">
                            <input type="radio" name="plan_type" value="trial" checked>
                            Trial 10 Hari
                        </label>
                        <label class="plan-option" data-plan="permanent">
                            <input type="radio" name="plan_type" value="permanent">
                            Langganan Bulanan
                        </label>
                    </div>
                    
                    <!-- Trial Plan Details -->
                    <div class="plan-details active" id="trial-details">
                        <h3>Trial 10 Hari</h3>
                        <div class="plan-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Gratis selama 10 hari</span>
                        </div>
                        <div class="plan-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Akses semua fitur dasar</span>
                        </div>
                        <div class="plan-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Bisa upgrade kapan saja</span>
                        </div>
                        <div class="plan-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Support email dasar</span>
                        </div>
                        <div class="plan-price">Rp0</div>
                    </div>
                    
                    <!-- Permanent Plan Details -->
                    <div class="plan-details" id="permanent-details">
                        <h3>Langganan Bulanan</h3>
                        <div class="plan-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Akses penuh semua fitur</span>
                        </div>
                        <div class="plan-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Prioritas support 24/7</span>
                        </div>
                        <div class="plan-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Laporan analitik lengkap</span>
                        </div>
                        <div class="plan-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Integrasi dengan kalender</span>
                        </div>
                        <div class="plan-price">Rp95.000/bulan</div>
                        
                        <label class="checkbox">
                            <input type="checkbox" name="pay_now" value="1" checked>
                            Bayar sekarang (aktif 30 hari)
                        </label>
                    </div>
                </div>
                
                <label class="checkbox">
                    <input type="checkbox" name="terms" value="1" required>
                    Saya setuju dengan <a href="#">Syarat & Ketentuan</a> dan <a href="#">Kebijakan Privasi</a>
                </label>
                
                <button type="submit">Buat Akun</button>
                
                <div class="auth-foot">
                    <span class="muted">Sudah punya akun?</span>
                    <a href="/login">Login sekarang</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const planOptions = document.querySelectorAll('.plan-option');
            const trialDetails = document.getElementById('trial-details');
            const permanentDetails = document.getElementById('permanent-details');
            
            planOptions.forEach(option => {
                option.addEventListener('click', function() {
                    // Remove active class from all options
                    planOptions.forEach(opt => {
                        opt.classList.remove('active');
                        opt.querySelector('input[type="radio"]').checked = false;
                    });
                    
                    // Add active class to clicked option
                    this.classList.add('active');
                    this.querySelector('input[type="radio"]').checked = true;
                    
                    // Show corresponding plan details
                    const planType = this.getAttribute('data-plan');
                    trialDetails.classList.remove('active');
                    permanentDetails.classList.remove('active');
                    
                    if (planType === 'trial') {
                        trialDetails.classList.add('active');
                    } else {
                        permanentDetails.classList.add('active');
                    }
                });
            });
            
            // Form submission
            const registerForm = document.getElementById('registerForm');
            registerForm.addEventListener('submit', function(e) {
                // Client-side validation
                const password = document.querySelector('input[name="password"]').value;
                const terms = document.querySelector('input[name="terms"]').checked;
                
                // if (password.length < 8) {
                //     e.preventDefault();
                //     alert('Password harus minimal 8 karakter.');
                //     return false;
                // }
                
                if (!terms) {
                    e.preventDefault();
                    alert('Anda harus menyetujui Syarat & Ketentuan.');
                    return false;
                }
                
                // You can add more validation here if needed
                return true;
            });
        });
    </script>
</body>
</html>