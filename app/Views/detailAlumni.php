<?= $this->extend('layout/main') ?>
<?= $this->section('styles') ?>
<style>
    .breadcrumb-bar{background:#eef2f9;padding:14px 0;border-bottom:1px solid #dde4f0;}
    .breadcrumb-inner{max-width:1280px;margin:0 auto;padding:0 24px;display:flex;justify-content:space-between;align-items:center;}
    .breadcrumb-title{font-size:20px;font-weight:600;color:var(--navy);}
    .breadcrumb-path{font-size:12px;color:var(--gray-text);}
    .breadcrumb-path a{color:var(--gray-text);text-decoration:none;}
    .breadcrumb-path span{color:var(--navy);font-weight:500;}

    .alumni-hero {
        position: relative;
        height: 400px;
        background: var(--navy-dark);
        overflow: hidden;
    }
    .alumni-hero-bg {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center center;
        filter: brightness(0.4);
    }
    .alumni-hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(10,18,45,0.92) 0%, rgba(10,18,45,0.3) 60%, transparent 100%);
    }
    .alumni-hero-content {
        position: absolute;
        bottom: 32px; left: 0; right: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .alumni-foto-wrap {
        width: 100px; height: 100px;
        border-radius: 50%;
        border: 4px solid #fff;
        overflow: hidden;
        background: var(--navy);
        margin-bottom: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.3);
        flex-shrink: 0;
    }
    .alumni-foto-wrap img {
        width: 100%; height: 100%;
        object-fit: cover; object-position: top;
        display: block;
    }
    .alumni-foto-placeholder {
        width: 100%; height: 100%;
        display: flex; align-items: center; justify-content: center;
        font-size: 32px; font-weight: 700; color: #fff;
        background: var(--blue-mid);
    }
    .alumni-hero-name {
        font-size: 24px;
        font-weight: 700;
        color: #fff;
        text-align: center;
        text-shadow: 0 2px 8px rgba(0,0,0,0.3);
    }

    /* ===== BADGES ===== */
    .alumni-badges-wrap {
        background: #fff;
        border-bottom: 1px solid var(--gray-mid);
    }
    .alumni-badges-inner {
        max-width: 860px;
        margin: 0 auto;
        padding: 0 24px;
        display: flex;
        gap: 0;
    }
    .alumni-badge {
        flex: 1;
        padding: 18px 20px;
        border-right: 1px solid var(--gray-mid);
    }
    .alumni-badge:last-child { border-right: none; }
    .alumni-badge-label {
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--gray-text);
        margin-bottom: 5px;
    }
    .alumni-badge-value {
        font-size: 14px;
        font-weight: 600;
        color: var(--navy);
    }

    .alumni-wrap {
        max-width: 860px;
        margin: 0 auto;
        padding: 40px 24px 64px;
    }

    .alumni-quote {
        border-left: 4px solid var(--navy);
        padding: 16px 24px;
        background: var(--gray-light);
        border-radius: 0 6px 6px 0;
        margin-bottom: 28px;
    }
    .alumni-quote p {
        font-size: 15px;
        font-style: italic;
        color: var(--navy);
        line-height: 1.75;
        font-weight: 500;
    }

    .alumni-deskripsi {
        font-size: 15px;
        line-height: 1.85;
        color: #4a5568;
    }
    .alumni-deskripsi p { margin-bottom: 16px; }
    .alumni-deskripsi p:last-child { margin-bottom: 0; }

    .alumni-divider {
        border: none;
        border-top: 1px solid var(--gray-mid);
        margin: 40px 0;
    }

    /* ===== ALUMNI LAIN ===== */
    .alumni-lain-title {
        font-size: 16px;
        font-weight: 700;
        color: var(--navy);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .alumni-lain-title::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--gray-mid);
    }
    .alumni-lain-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }
    .alumni-lain-card {
        border: 1px solid var(--gray-mid);
        border-radius: 8px;
        overflow: hidden;
        text-decoration: none;
        transition: all 0.2s;
        background: #fff;
    }
    .alumni-lain-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(26,46,90,0.1);
        border-color: var(--navy);
    }
    .alumni-lain-img {
        height: 90px;
        background: linear-gradient(135deg, var(--navy), var(--blue-mid));
        position: relative;
        overflow: hidden;
    }
    .alumni-lain-img img {
        width: 100%; height: 100%;
        object-fit: cover; object-position: top;
        display: block; filter: brightness(0.8);
    }
    .alumni-lain-foto {
        position: absolute;
        bottom: -18px; left: 14px;
        width: 40px; height: 40px;
        border-radius: 50%;
        border: 3px solid #fff;
        overflow: hidden;
        background: var(--navy);
    }
    .alumni-lain-foto img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .alumni-lain-foto-placeholder {
        width: 100%; height: 100%;
        display: flex; align-items: center; justify-content: center;
        font-size: 14px; font-weight: 700; color: #fff;
        background: var(--blue-mid);
    }
    .alumni-lain-body { padding: 26px 14px 14px; }
    .alumni-lain-name { font-size: 13px; font-weight: 600; color: var(--navy); margin-bottom: 3px; }
    .alumni-lain-info { font-size: 11px; color: var(--gray-text); }

    .btn-semua {
        display: flex;
        justify-content: flex-end;
    }
    .btn-semua a {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--navy);
        color: #fff;
        font-size: 12px;
        font-weight: 700;
        padding: 10px 22px;
        border-radius: 5px;
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: background 0.2s;
    }
    .btn-semua a:hover { background: var(--blue-mid); }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="breadcrumb-bar">
    <div class="breadcrumb-inner">
        <div class="breadcrumb-title">Alumni</div>
        <div class="breadcrumb-path">
            <a href="<?= base_url('/') ?>">Beranda</a> &gt;
            <a href="<?= base_url('alumni') ?>">Alumni</a> &gt;
            <span><?= esc($alumni['nama']) ?></span>
        </div>
    </div>
</div>

<div class="alumni-hero">
    <?php if (!empty($alumni['background_images'])): ?>
    <div class="alumni-hero-bg"
         style="background-image:url('<?= base_url('assets/alumni/' . $alumni['background_images']) ?>')">
    </div>
    <?php else: ?>
    <div style="position:absolute;inset:0;background:var(--navy);"></div>
    <?php endif; ?>
    <div class="alumni-hero-content">
        <div class="alumni-foto-wrap">
            <?php if (!empty($alumni['foto_profil'])): ?>
                <img src="<?= base_url('assets/alumni/' . $alumni['foto_profil']) ?>"
                     alt="<?= esc($alumni['nama']) ?>">
            <?php else: ?>
                <div class="alumni-foto-placeholder"><?= strtoupper(substr($alumni['nama'], 0, 1)) ?></div>
            <?php endif; ?>
        </div>
        <div class="alumni-hero-name"><?= esc($alumni['nama']) ?></div>
    </div>
</div>


<div class="alumni-badges-wrap">
    <div class="alumni-badges-inner">
        <div class="alumni-badge">
            <div class="alumni-badge-label">Jurusan / Fakultas</div>
            <div class="alumni-badge-value"><?= esc($alumni['jurusan']) ?></div>
        </div>
        <div class="alumni-badge">
            <div class="alumni-badge-label">Angkatan</div>
            <div class="alumni-badge-value"><?= !empty($alumni['angkatan']) ? esc($alumni['angkatan']) : '—' ?></div>
        </div>
    </div>
</div>

<!-- CONTENT -->
<div class="alumni-wrap">
    <?php
        $deskripsi  = $alumni['deskripsi'] ?? '';
        $paragraphs = array_values(array_filter(explode("\n", $deskripsi), fn($p) => trim($p) !== ''));
        $firstPara  = $paragraphs[0] ?? '';
        $restParas  = array_slice($paragraphs, 1);
    ?>

    <?php if (!empty($firstPara)): ?>
    <div class="alumni-quote">
        <p><?= esc($firstPara) ?></p>
    </div>
    <?php endif; ?>

    <?php if (!empty($restParas)): ?>
    <div class="alumni-deskripsi">
        <?php foreach ($restParas as $para): ?>
            <p><?= esc($para) ?></p>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- Alumni Lainnya -->
    <?php if (!empty($lainnya)): ?>
    <hr class="alumni-divider">
    <div class="alumni-lain-title">Alumni Lainnya</div>
    <div class="alumni-lain-grid">
        <?php foreach ($lainnya as $item): ?>
        <a href="<?= base_url('alumni/' . $item['id']) ?>" class="alumni-lain-card">
            <div class="alumni-lain-img">
                <?php if (!empty($item['background_images'])): ?>
                    <img src="<?= base_url('assets/alumni/' . $item['background_images']) ?>"
                         alt="<?= esc($item['nama']) ?>">
                <?php endif; ?>
                <div class="alumni-lain-foto">
                    <?php if (!empty($item['foto_profil'])): ?>
                        <img src="<?= base_url('assets/alumni/' . $item['foto_profil']) ?>"
                             alt="<?= esc($item['nama']) ?>">
                    <?php else: ?>
                        <div class="alumni-lain-foto-placeholder"><?= strtoupper(substr($item['nama'], 0, 1)) ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="alumni-lain-body">
                <div class="alumni-lain-name"><?= esc($item['nama']) ?></div>
                <div class="alumni-lain-info"><?= esc($item['jurusan']) ?><?= !empty($item['angkatan']) ? ' · ' . esc($item['angkatan']) : '' ?></div>
            </div>
        </a>
        <?php endforeach; ?>
    </div>
    <div class="btn-semua">
        <a href="<?= base_url('alumni') ?>">Semua Alumni <i class="fas fa-arrow-right"></i></a>
    </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>