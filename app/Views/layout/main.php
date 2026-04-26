<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Universitas Trisakti' ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --navy:      #1a2e5a;
            --navy-dark: #0f1f3d;
            --blue-mid:  #2351a4;
            --white:     #ffffff;
            --gray-light:#f4f6fb;
            --gray-mid:  #e0e6f0;
            --gray-text: #6b7a99;
            --text-dark: #1a2035;
            --font:      'DM Sans', sans-serif;
        }
        html { scroll-behavior: smooth; }
        body { font-family: var(--font); color: var(--text-dark); background: #fff; }
        a { text-decoration: none; color: inherit; }

        /* ===== NAVBAR ===== */
        .navbar {
            background: var(--navy);
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 16px rgba(10,20,50,0.18);
        }
        .navbar-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            align-items: center;
            height: 68px;
        }
        .navbar-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
            margin-right: 16px;
        }
        .navbar-logo img {
            height: 44px;
            width: auto;
            filter: brightness(0) invert(1);
        }
        .nav-menu {
            display: flex;
            align-items: center;
            list-style: none;
            flex: 1;
        }
        .nav-menu > li { position: relative; }
        .nav-menu > li > a {
            display: flex;
            align-items: center;
            gap: 5px;
            color: rgba(255,255,255,0.80);
            font-size: 13.5px;
            font-weight: 500;
            padding: 0 14px;
            height: 68px;
            /* garis bawah aktif: putih, bukan kuning */
            border-bottom: 3px solid transparent;
            transition: all 0.2s;
            white-space: nowrap;
        }
        .nav-menu > li > a:hover,
        .nav-menu > li > a.active {
            color: #fff;
            border-bottom-color: #fff;           /* ← putih (was kuning) */
            background: rgba(255,255,255,0.07);
        }
        .nav-menu > li > a .arrow { font-size: 9px; opacity: 0.6; }

        /* dropdown */
        .dropdown { position: relative; }
        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%; left: 0;
            background: #fff;
            border-radius: 0 0 6px 6px;
            box-shadow: 0 8px 32px rgba(10,20,50,0.15);
            min-width: 200px;
            padding: 6px 0;
            z-index: 999;
            border-top: 3px solid var(--navy);   /* ← navy, bukan kuning */
        }
        .dropdown:hover .dropdown-menu { display: block; }
        .dropdown-menu a {
            display: block;
            padding: 9px 18px;
            font-size: 13px;
            color: var(--text-dark);
            transition: background 0.15s, color 0.15s;
            white-space: nowrap;
        }
        .dropdown-menu a:hover {
            background: var(--gray-light);
            color: var(--navy);
        }

        .navbar-search {
            margin-left: auto;
            background: none;
            border: none;
            color: rgba(255,255,255,0.75);
            font-size: 17px;
            cursor: pointer;
            padding: 6px;
            border-radius: 4px;
            transition: color 0.2s;
        }
        .navbar-search:hover { color: #fff; }

        main { min-height: 60vh; }

        /* ===== FOOTER ===== */
        .footer {
            background: var(--navy-dark);
            color: rgba(255,255,255,0.65);
            padding: 56px 0 0;
        }
        .footer-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px 48px;
            display: grid;
            grid-template-columns: 2fr 1.4fr 1.4fr 1.4fr;
            gap: 40px;
        }

        /* brand */
        .footer-brand .logo-wrap {
            display: flex; align-items: center; gap: 12px; margin-bottom: 18px;
        }
        .footer-brand .logo-circle {
            width: 52px; height: 52px;
            background: rgba(255,255,255,0.08);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .footer-brand .logo-circle img { width: 32px; filter: brightness(0) invert(1); }
        .footer-brand-name { font-size: 15px; font-weight: 600; color: #fff; line-height: 1.35; }
        .footer-brand-name span { display: block; font-size: 11px; font-weight: 400; color: rgba(255,255,255,0.4); margin-top: 2px; }

        /* kontak list */
        .footer-contact-list { list-style: none; margin-bottom: 18px; }
        .footer-contact-list li {
            display: flex; align-items: flex-start; gap: 10px;
            font-size: 12.5px; color: rgba(255,255,255,0.5);
            margin-bottom: 8px; line-height: 1.5;
        }
        .footer-contact-list li i {
            font-size: 12px;
            color: rgba(255,255,255,0.7);        /* ← putih redup, bukan kuning */
            margin-top: 2px; width: 14px; flex-shrink: 0;
        }

        /* sosmed */
        .footer-sosmed { display: flex; gap: 8px; }
        .footer-sosmed a {
            width: 32px; height: 32px;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,0.2);
            display: flex; align-items: center; justify-content: center;
            color: rgba(255,255,255,0.55);
            font-size: 13px;
            transition: all 0.2s;
        }
        .footer-sosmed a:hover {
            background: rgba(255,255,255,0.12);
            color: #fff;
            border-color: rgba(255,255,255,0.5);
        }

        /* kolom */
        .footer-col h4 {
            font-size: 11px; font-weight: 700; color: #fff;
            text-transform: uppercase; letter-spacing: 1.5px;
            margin-bottom: 14px; padding-bottom: 10px;
            border-bottom: 1px solid rgba(255,255,255,0.15);
            display: block;
        }
        .footer-col ul { list-style: none; }
        .footer-col ul li { margin-bottom: 8px; }
        .footer-col ul li a {
            font-size: 13px; color: rgba(255,255,255,0.5);
            transition: color 0.2s;
            display: flex; align-items: center; gap: 6px;
        }
        .footer-col ul li a::before { content: '›'; color: rgba(255,255,255,0.4); font-size: 15px; }
        .footer-col ul li a:hover { color: #fff; }
        .footer-col ul li a:hover::before { color: #fff; }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.07);
            padding: 14px 24px;
            text-align: center;
            font-size: 12px;
            color: rgba(255,255,255,0.3);
        }
    </style>
    <?= $this->renderSection('styles') ?>
</head>
<body>

<nav class="navbar">
    <div class="navbar-inner">
        <a href="<?= base_url('/') ?>" class="navbar-logo">
            <img src="<?= base_url('assets/logo-trisakti.png') ?>" alt="Logo Universitas Trisakti">
        </a>
        <ul class="nav-menu">
            <li>
                <a href="<?= base_url('/') ?>"
                   class="<?= uri_string() === '' ? 'active' : '' ?>">Beranda</a>
            </li>
            <li>
                <a href="<?= base_url('news') ?>"
                   class="<?= str_starts_with(uri_string(), 'news') ? 'active' : '' ?>">Berita</a>
            </li>

            <li class="dropdown">
                <a href="#"
                   class="<?= str_starts_with(uri_string(), 'tentang') ? 'active' : '' ?>">
                    Tentang <span class="arrow">▾</span>
                </a>
                <div class="dropdown-menu">
                    <a href="<?= base_url('tentang/tentang-universitas') ?>">Tentang Universitas</a>
                    <a href="<?= base_url('tentang/sejarah') ?>">Sejarah Singkat</a>
                    <a href="<?= base_url('tentang/visi-misi') ?>">Visi dan Misi</a>
                    <a href="<?= base_url('tentang/motto') ?>">Motto</a>
                    <a href="<?= base_url('tentang/struktur-organisasi') ?>">Struktur Organisasi</a>
                    <a href="<?= base_url('tentang/kontak') ?>">Hubungi Kami</a>
                </div>
            </li>

            <li>
                <a href="<?= base_url('agenda') ?>"
                   class="<?= str_starts_with(uri_string(), 'agenda') ? 'active' : '' ?>">Agenda</a>
            </li>
            <li>
                <a href="<?= base_url('alumni') ?>"
                   class="<?= str_starts_with(uri_string(), 'alumni') ? 'active' : '' ?>">Alumni</a>
            </li>
        </ul>
    </div>
</nav>

<main>
    <?= $this->renderSection('content') ?>
</main>

<footer class="footer">
    <div class="footer-inner">

        <div class="footer-brand">
            <div class="logo-wrap">
                <div class="logo-circle">
                    <img src="<?= base_url('assets/logo-trisakti.png') ?>" alt="Logo">
                </div>
                <div class="footer-brand-name">
                    Universitas Trisakti
                    <span>Jakarta, Indonesia</span>
                </div>
            </div>
            
            <div class="footer-sosmed">
                <?php if (!empty($sosmedFooter)): ?>
                    <?php foreach ($sosmedFooter as $s): if (empty($s['nilai'])) continue;
                        $icon = match($s['jenis']) {
                            'facebook'  => 'fab fa-facebook-f',
                            'instagram' => 'fab fa-instagram',
                            'twitter'   => 'fab fa-x-twitter',
                            'youtube'   => 'fab fa-youtube',
                            default     => 'fas fa-link',
                        }; ?>
                        <a href="<?= esc($s['nilai']) ?>" target="_blank"><i class="<?= $icon ?>"></i></a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-x-twitter"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                <?php endif; ?>
            </div>
        </div>

        <div class="footer-col">
            <h4>Hubungi Kami</h4>
            <ul class="footer-contact-list">
                <?php if (!empty($kontakFooter)): ?>
                    <?php foreach ($kontakFooter as $k): ?>
                        <?php
                            $icon = match($k['jenis']) {
                                'alamat'   => 'fas fa-map-marker-alt',
                                'telepon'  => 'fas fa-phone',
                                'whatsapp' => 'fab fa-whatsapp',
                                'fax'      => 'fas fa-fax',
                                'email'    => 'fas fa-envelope',
                                default    => 'fas fa-info-circle',
                            };
                        ?>
                        <li><i class="<?= $icon ?>"></i> <?= esc($k['nilai']) ?></li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </div>

        <div class="footer-col">
            <h4>Tentang Trisakti</h4>
            <ul>
                <li><a href="<?= base_url('tentang/tentang-universitas') ?>">Tentang Trisakti</a></li>
                <li><a href="<?= base_url('tentang/sejarah') ?>">Sejarah Singkat</a></li>
                <li><a href="<?= base_url('tentang/moto') ?>">Moto</a></li>
                <li><a href="<?= base_url('tentang/visi-misi') ?>">Visi dan Misi</a></li>
                <li><a href="<?= base_url('tentang/struktur-organisasi') ?>">Struktur Organisasi</a></li>
                
            </ul>
        </div>

        <div class="footer-col">
            <h4>Fakultas</h4>
            <ul>
                <?php if (!empty($fakultasFooter)): ?>
                    <?php foreach ($fakultasFooter as $f): ?>
                        <li><a href="<?= base_url('fakultas/' . ($f['slug'] ?? '#')) ?>"><?= esc($f['nama']) ?></a></li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li><a href="#">Fakultas Hukum</a></li>
                    <li><a href="#">Fakultas Ekonomi dan Bisnis</a></li>
                    <li><a href="#">Fakultas Kedokteran</a></li>
                    <li><a href="#">Fakultas Teknologi Industri</a></li>
                    <li><a href="#">Fakultas Seni Rupa dan Desain</a></li>
                <?php endif; ?>
            </ul>
        </div>

    </div>
    <div class="footer-bottom">
        &copy; <?= date('Y') ?> Universitas Trisakti. Hak Cipta dilindungi oleh Undang-undang.
    </div>
</footer>

<?= $this->renderSection('scripts') ?>
</body>
</html>