<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin' ?> — Universitas Trisakti</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --navy: #1a2e5a;
            --navy-dark: #0f1f3d;
            --blue-mid: #2351a4;
            --accent: #e8b800;
            --sidebar-w: 240px;
            --gray-light: #f4f6fb;
            --gray-mid: #e0e6f0;
            --gray-text: #6b7a99;
            --text-dark: #1a2035;
        }
        body { font-family: 'Inter', sans-serif; background: var(--gray-light); color: var(--text-dark); }
        a { text-decoration: none; color: inherit; }

        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-w);
            height: 100vh;
            background: var(--navy-dark);
            display: flex;
            flex-direction: column;
            z-index: 100;
            overflow-y: auto;
        }
        .sidebar-brand {
            padding: 24px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255,255,255,0.07);
        }
        .sidebar-brand-logo {
            width: 40px; height: 40px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .sidebar-brand-logo svg { width: 22px; height: 22px; fill: #fff; }
        .sidebar-brand-text { font-size: 13px; font-weight: 600; color: #fff; line-height: 1.35; }
        .sidebar-brand-text span { display: block; font-size: 11px; font-weight: 400; color: rgba(255,255,255,0.45); }

        .sidebar-section-label {
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255,255,255,0.3);
            padding: 20px 20px 8px;
        }

        .sidebar-menu { list-style: none; padding: 0 10px; }
        .sidebar-menu li { margin-bottom: 2px; }
        .sidebar-menu li a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            border-radius: 6px;
            font-size: 13px;
            color: rgba(255,255,255,0.65);
            transition: all 0.15s;
        }
        .sidebar-menu li a i { width: 16px; text-align: center; font-size: 13px; }
        .sidebar-menu li a:hover { background: rgba(255,255,255,0.07); color: #fff; }
        .sidebar-menu li a.active { background: var(--blue-mid); color: #fff; }

        .sidebar-footer {
            margin-top: auto;
            padding: 16px 10px;
            border-top: 1px solid rgba(255,255,255,0.07);
        }
        .sidebar-footer a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            border-radius: 6px;
            font-size: 13px;
            color: rgba(255,255,255,0.55);
            transition: all 0.15s;
        }
        .sidebar-footer a:hover { background: rgba(255,255,255,0.07); color: #fff; }
        .sidebar-footer a i { width: 16px; text-align: center; }

        .topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-w);
            right: 0;
            height: 56px;
            background: #fff;
            border-bottom: 1px solid var(--gray-mid);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            z-index: 99;
        }
        .topbar-title {
            font-size: 15px;
            font-weight: 600;
            color: var(--text-dark);
        }
        .topbar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            color: var(--gray-text);
        }
        .topbar-avatar {
            width: 32px; height: 32px;
            background: var(--navy);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; font-weight: 600; color: #fff;
        }

        .main-content {
            margin-left: var(--sidebar-w);
            padding-top: 56px;
            min-height: 100vh;
        }
        .page-content {
            padding: 28px 28px;
        }

        .alert { padding: 10px 16px; border-radius: 6px; font-size: 13px; margin-bottom: 20px; }
        .alert-success { background: #eafaf1; color: #1e8449; border: 1px solid #a9dfbf; }
        .alert-error   { background: #fdecea; color: #c0392b; border: 1px solid #f5c6c2; }
    </style>
    <?= $this->renderSection('styles') ?>
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="sidebar-brand-logo">
            <div class="logo-circle">
                <img style="width: 36px;" src="<?= base_url('assets/logo-trisakti.png') ?>" alt="Logo">
            </div>
        </div>
        <div class="sidebar-brand-text">
            Panel Admin
            <span>Universitas Trisakti</span>
        </div>
    </div>

    <div class="sidebar-section-label">Menu</div>
    <ul class="sidebar-menu">
        <li>
            <a href="<?= base_url('admin/dashboard') ?>"
               class="<?= url_is('admin/dashboard') ? 'active' : '' ?>">
                <i class="fas fa-gauge"></i> Dashboard
            </a>
        </li>
    </ul>

    <div class="sidebar-section-label">Kelola Konten</div>
    <ul class="sidebar-menu">
        <li>
            <a href="<?= base_url('admin/berita') ?>"
               class="<?= url_is('admin/berita*') ? 'active' : '' ?>">
                <i class="fas fa-newspaper"></i> Berita
            </a>
        </li>
        <li><a href="<?= base_url('admin/fakultas') ?>"><i class="fas fa-building-columns"></i> Fakultas</a></li>
        <li><a href="<?= base_url('admin/agenda') ?>"><i class="fas fa-calendar-alt"></i> Agenda</a></li>
        <li><a href="<?= base_url('admin/alumni') ?>"><i class="fas fa-graduation-cap"></i> Alumni</a></li>
    </ul>

    <div class="sidebar-section-label">Pengaturan</div>
    <ul class="sidebar-menu">
        <li>
            <a href="<?= base_url('admin/profil') ?>"
               class="<?= url_is('admin/profil*') ? 'active' : '' ?>">
                <i class="fas fa-university"></i> Profil Kampus
            </a>
        </li>
        <li>
            <a href="<?= base_url('admin/kontak') ?>"
               class="<?= url_is('admin/kontak*') ? 'active' : '' ?>">
                <i class="fas fa-address-book"></i> Kontak
            </a>
        </li>
        <li>
            <a href="<?= base_url('admin/struktur') ?>"
               class="<?= url_is('admin/struktur*') ? 'active' : '' ?>">
                <i class="fas fa-sitemap"></i> Struktur Organisasi
            </a>
        </li>
    </ul>

    <div class="sidebar-footer">
        <a href="<?= base_url('admin/logout') ?>">
            <i class="fas fa-right-from-bracket"></i> Logout
        </a>
    </div>
</aside>

<!-- TOPBAR -->
<div class="topbar">
    <div class="topbar-title"><?= $title ?? 'Dashboard' ?></div>
    <div class="topbar-user">
        <span>Halo, <?= esc(session()->get('email')) ?></span>
        <div class="topbar-avatar"><?= strtoupper(substr(session()->get('email'), 0, 1)) ?></div>
    </div>
</div>

<!-- MAIN -->
<div class="main-content">
    <div class="page-content">

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-error"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>
    </div>
</div>

<?= $this->renderSection('scripts') ?>
</body>
</html>