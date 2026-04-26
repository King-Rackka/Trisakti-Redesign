<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --navy: #1a2e5a;
            --navy-dark: #0f1f3d;
            --blue-mid: #2351a4;
            --accent: #e8b800;
            --gray-light: #f4f6fb;
            --gray-mid: #e0e6f0;
            --gray-text: #6b7a99;
            --text-dark: #1a2035;
        }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--gray-light);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-wrap { width: 100%; max-width: 420px; padding: 16px; }
        .login-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 32px rgba(26,46,90,0.10);
            overflow: hidden;
        }
        .login-header {
            background: var(--navy);
            padding: 32px 32px 28px;
            text-align: center;
        }
        .login-logo {
            width: 56px; height: 56px;
            background: rgba(255,255,255,0.12);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 16px;
        }
        .login-logo svg { width: 32px; height: 32px; fill: #fff; }
        .login-header h1 { font-size: 18px; font-weight: 600; color: #fff; margin-bottom: 4px; }
        .login-header p { font-size: 13px; color: rgba(255,255,255,0.55); }
        .login-body { padding: 32px; }
        .alert { padding: 10px 14px; border-radius: 6px; font-size: 13px; margin-bottom: 20px; }
        .alert-error { background: #fdecea; color: #c0392b; border: 1px solid #f5c6c2; }
        .alert-success { background: #eafaf1; color: #1e8449; border: 1px solid #a9dfbf; }
        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; font-size: 13px; font-weight: 500; color: var(--text-dark); margin-bottom: 6px; }
        .form-group input {
            width: 100%; padding: 10px 14px;
            border: 1px solid var(--gray-mid); border-radius: 6px;
            font-size: 14px; font-family: 'Inter', sans-serif;
            color: var(--text-dark); background: #fff;
            transition: border-color 0.2s; outline: none;
        }
        .form-group input:focus { border-color: var(--blue-mid); box-shadow: 0 0 0 3px rgba(35,81,164,0.08); }
        .btn-login {
            width: 100%; padding: 11px;
            background: var(--navy); color: #fff;
            font-size: 14px; font-weight: 600; font-family: 'Inter', sans-serif;
            border: none; border-radius: 6px; cursor: pointer;
            transition: background 0.2s; margin-top: 4px;
        }
        .btn-login:hover { background: var(--blue-mid); }
        .login-footer {
            text-align: center; padding: 16px 32px 24px;
            font-size: 12px; color: var(--gray-text);
            border-top: 1px solid var(--gray-mid);
        }
    </style>
</head>
<body>
<div class="login-wrap">
    <div class="login-card">
        <div class="login-header">
            <h1>Selamat Datang Admin</h1>
            <p>Universitas Trisakti</p>
        </div>
        <div class="login-body">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-error"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>
            <form action="<?= base_url('admin/login') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email"
                           value="<?= old('email') ?>" placeholder="Masukkan email" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password"
                           placeholder="Masukkan password" required>
                </div>
                <button type="submit" class="btn-login">Masuk</button>
            </form>
        </div>
        <div class="login-footer">&copy; <?= date('Y') ?> Universitas Trisakti</div>
    </div>
</div>
</body>
</html>