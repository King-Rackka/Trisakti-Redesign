<?= $this->extend('layout/main') ?>
<?= $this->section('styles') ?>
<style>
    /* ===== BREADCRUMB ===== */
    .breadcrumb-bar {
        background: #eef2f9;
        padding: 14px 0;
        border-bottom: 1px solid #dde4f0;
    }
    .breadcrumb-inner {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .breadcrumb-title {
        font-size: 20px;
        font-weight: 600;
        color: var(--navy);
    }
    .breadcrumb-path {
        font-size: 12px;
        color: var(--gray-text);
    }
    .breadcrumb-path a {
        color: var(--gray-text);
        text-decoration: none;
        transition: color 0.2s;
    }
    .breadcrumb-path a:hover { color: var(--navy); }
    .breadcrumb-path span { color: var(--navy); font-weight: 500; }

    /* ===== CONTENT LAYOUT ===== */
    .detail-wrap {
        max-width: 1280px;
        margin: 0 auto;
        padding: 40px 24px 60px;
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 40px;
        align-items: start;
    }

    /* ===== ARTIKEL (kiri) ===== */
    .artikel-main {}

    .artikel-hero {
        width: 100%;
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 24px;
        background: linear-gradient(135deg, var(--navy-dark), var(--blue-mid));
        min-height: 560px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .artikel-hero img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        max-height: 1100px;
    }
    .artikel-hero-placeholder {
        color: rgba(255,255,255,0.3);
        font-size: 13px;
        text-align: center;
        padding: 80px 24px;
    }

    .artikel-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-bottom: 16px;
        border-bottom: 1px solid var(--gray-mid);
        margin-bottom: 20px;
    }
    .artikel-meta .date {
        font-size: 13px;
        color: var(--gray-text);
    }
    .artikel-meta .author {
        font-size: 13px;
        color: var(--gray-text);
    }
    .artikel-meta .author span {
        color: var(--blue-mid);
        font-weight: 500;
    }

    .artikel-judul {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-dark);
        line-height: 1.4;
        margin-bottom: 24px;
    }

    .artikel-body {
        font-size: 15px;
        line-height: 1.8;
        color: #2d3748;
    }
    .artikel-body p {
        margin-bottom: 18px;
    }
    .artikel-body p:last-child { margin-bottom: 0; }

    .artikel-share {
        margin-top: 32px;
        padding-top: 24px;
        border-top: 1px solid var(--gray-mid);
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .artikel-share span {
        font-size: 13px;
        color: var(--gray-text);
        font-weight: 500;
    }
    .share-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        font-weight: 500;
        padding: 6px 14px;
        border-radius: 4px;
        border: 1px solid var(--gray-mid);
        color: var(--text-dark);
        text-decoration: none;
        transition: background 0.15s;
        cursor: pointer;
    }
    .share-btn:hover { background: var(--gray-light); }
    .share-btn.wa  { color: #25d366; border-color: #25d366; }
    .share-btn.fb  { color: #1877f2; border-color: #1877f2; }
    .share-btn.tw  { color: #1da1f2; border-color: #1da1f2; }

    .sidebar {}

    .sidebar-section {
        margin-bottom: 32px;
    }
    .sidebar-heading {
        font-size: 15px;
        font-weight: 600;
        color: var(--navy);
        padding-bottom: 10px;
        border-bottom: 3px solid var(--navy);
        margin-bottom: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .sidebar-heading a {
        font-size: 11px;
        font-weight: 400;
        color: var(--gray-text);
        text-decoration: none;
    }
    .sidebar-heading a:hover { color: var(--navy); }

    .sidebar-list { display: flex; flex-direction: column; gap: 12px; }

    .sidebar-card {
        display: flex;
        gap: 10px;
        align-items: flex-start;
        text-decoration: none;
        transition: opacity 0.15s;
    }
    .sidebar-card:hover { opacity: 0.8; }

    .sidebar-card-img {
        width: 72px;
        height: 56px;
        flex-shrink: 0;
        border-radius: 4px;
        overflow: hidden;
        background: linear-gradient(135deg, var(--navy), var(--blue-mid));
    }
    .sidebar-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .sidebar-card-body {}
    .sidebar-card-body .date {
        font-size: 10px;
        color: var(--gray-text);
        text-transform: uppercase;
        letter-spacing: 0.4px;
        margin-bottom: 3px;
    }
    .sidebar-card-body h4 {
        font-size: 12px;
        font-weight: 600;
        color: var(--text-dark);
        line-height: 1.4;
    }

    .sidebar-semua-btn {
        display: block;
        text-align: center;
        margin-top: 14px;
        padding: 8px;
        border: 1px solid var(--gray-mid);
        border-radius: 4px;
        font-size: 12px;
        color: var(--navy);
        font-weight: 500;
        text-decoration: none;
        transition: background 0.15s;
    }
    .sidebar-semua-btn:hover { background: var(--gray-light); }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- BREADCRUMB -->
<div class="breadcrumb-bar">
    <div class="breadcrumb-inner">
        <div class="breadcrumb-title">Berita</div>
        <div class="breadcrumb-path">
            <a href="<?= base_url('/') ?>">Beranda</a> &gt;
            <a href="<?= base_url('news') ?>">Berita</a> &gt;
            <span><?= esc(character_limiter($berita['judul'])) ?></span>
        </div>
    </div>
</div>

<div class="detail-wrap">

    <article class="artikel-main">

        <div class="artikel-hero">
            <?php if (!empty($berita['gambar'])): ?>
                <img src="<?= base_url('assets/news/' . $berita['gambar']) ?>"
                     alt="<?= esc($berita['judul']) ?>">
            <?php else: ?>
                <div class="artikel-hero-placeholder">Foto tidak tersedia</div>
            <?php endif; ?>
        </div>

        <div class="artikel-meta">
            <div class="date">
                <?= date('l, d F Y', strtotime($berita['tanggal'])) ?>
            </div>
            <div class="author">
                Oleh: <span>adminnewtrisakti</span>
            </div>
        </div>

        <h1 class="artikel-judul"><?= esc($berita['judul']) ?></h1>

        <div class="artikel-body">
           <?= nl2br(esc((string)$berita['deskripsi'])) ?>
        </div>

        <div class="artikel-share">
            <span>Bagikan:</span>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(current_url()) ?>"
               target="_blank" class="share-btn fb">Facebook</a>
            <a href="https://twitter.com/intent/tweet?text=<?= urlencode($berita['judul']) ?>&url=<?= urlencode(current_url()) ?>"
               target="_blank" class="share-btn tw">Twitter</a>
        </div>

    </article>

    <aside class="sidebar">

        <div class="sidebar-section">
            <div class="sidebar-heading">
                Berita Terkini
            </div>
            <div class="sidebar-list">
                <?php foreach ($terkait as $item): ?>
                <a href="<?= base_url('news/' . $item['slug']) ?>" class="sidebar-card">
                    <div class="sidebar-card-img">
                        <?php if (!empty($item['gambar'])): ?>
                            <img src="<?= base_url('assets/news/' . $item['gambar']) ?>"
                                 alt="<?= esc($item['judul']) ?>">
                        <?php endif; ?>
                    </div>
                    <div class="sidebar-card-body">
                        <div class="date"><?= strtoupper(date('l, d F Y', strtotime($item['tanggal']))) ?></div>
                        <h4><?= esc(character_limiter($item['judul'])) ?></h4>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
            <a href="<?= base_url('news') ?>" class="sidebar-semua-btn">Semua Berita →</a>
        </div>

    </aside>

</div>

<?= $this->endSection() ?>