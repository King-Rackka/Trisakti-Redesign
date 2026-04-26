<?= $this->extend('layout/main') ?>
<?= $this->section('styles') ?>
<style>
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
    .breadcrumb-path a { color: var(--gray-text); }
    .breadcrumb-path span { color: var(--navy); font-weight: 500; }

    .content-wrap {
        max-width: 1280px;
        margin: 0 auto;
        padding: 40px 24px 0;
    }

    .section-heading {
        font-size: 18px;
        font-weight: 600;
        color: var(--navy);
        margin-bottom: 6px;
    }
    .section-underline {
        width: 52px;
        height: 3px;
        background: var(--navy);
        margin-bottom: 28px;
    }

    .berita-terbaru-grid {
        display: grid;
        grid-template-columns: 1.7fr 1fr;
        gap: 24px;
        margin-bottom: 52px;
    }

    .featured-card {
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid var(--gray-mid);
        transition: box-shadow 0.2s;
    }
    .featured-card:hover { box-shadow: 0 4px 20px rgba(26,46,90,0.12); }
    .featured-img {
        height: 360px;
        background: linear-gradient(135deg, var(--navy-dark), var(--blue-mid));
        position: relative;
        overflow: hidden;
    }
    .featured-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .featured-img-overlay {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        background: linear-gradient(to top, rgba(10,20,50,0.85), transparent);
        padding: 24px 16px 14px;
    }
    .news-badge {
        display: inline-block;
        background: var(--gray-mid);
        color: var(--navy-dark);
        font-size: 10px;
        font-weight: 700;
        padding: 3px 9px;
        border-radius: 3px;
        text-transform: uppercase;
        margin-bottom: 6px;
    }
    .featured-img-overlay .date {
        font-size: 11px;
        color: rgba(255,255,255,0.65);
        margin-bottom: 4px;
    }
    .featured-img-overlay h3 {
        font-size: 14px;
        font-weight: 600;
        color: #fff;
        line-height: 1.4;
    }
    .featured-body {
        padding: 16px;
    }
    .featured-body .date {
        font-size: 11px;
        color: var(--gray-text);
        text-transform: uppercase;
        letter-spacing: 0.4px;
        margin-bottom: 6px;
    }
    .featured-body h3 {
        font-size: 15px;
        font-weight: 600;
        color: var(--text-dark);
        line-height: 1.45;
    }

    /* Side list (kanan) */
    .side-list { display: flex; flex-direction: column; gap: 12px; }
    .side-card {
        display: flex;
        gap: 0;
        border: 1px solid var(--gray-mid);
        border-radius: 6px;
        overflow: hidden;
        align-items: stretch;
        text-decoration: none;
        transition: box-shadow 0.2s;
    }
    .side-card:hover { box-shadow: 0 2px 12px rgba(26,46,90,0.1); }
    .side-img {
        width: 140px;
        height: 90px;
        flex-shrink: 0;
        background: linear-gradient(135deg, var(--navy), var(--blue-mid));
        position: relative;
        overflow: hidden;
    }
    .side-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .side-body {
        padding: 10px 12px;
        flex: 1;
    }
    .side-body .date {
        font-size: 10px;
        color: var(--gray-text);
        text-transform: uppercase;
        letter-spacing: 0.4px;
        margin-bottom: 4px;
    }
    .side-body h4 {
        font-size: 12px;
        font-weight: 600;
        color: var(--text-dark);
        line-height: 1.45;
    }

    /* ===== BERITA POPULER ===== */
    .berita-dua-kolom {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        margin-bottom: 52px;
    }
    .populer-list { display: flex; flex-direction: column; gap: 12px; }

    /* ===== SEMUA BERITA ===== */
    .semua-berita-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 36px;
    }
    .news-card {
        border: 1px solid var(--gray-mid);
        border-radius: 8px;
        overflow: hidden;
        background: #fff;
        transition: box-shadow 0.2s, transform 0.2s;
        display: flex;
        flex-direction: column;
    }
    .news-card:hover {
        box-shadow: 0 4px 20px rgba(26,46,90,0.12);
        transform: translateY(-2px);
    }
    .news-card-img {
        height: 180px;
        background: linear-gradient(135deg, var(--navy), var(--blue-mid));
        position: relative;
        overflow: hidden;
        flex-shrink: 0;
    }
    .news-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .news-card-img .news-badge {
        position: absolute;
        top: 10px;
        left: 10px;
    }
    .news-card-body {
        padding: 12px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .news-card-body .date {
        font-size: 10px;
        color: var(--gray-text);
        text-transform: uppercase;
        letter-spacing: 0.4px;
        margin-bottom: 5px;
    }
    .news-card-body h4 {
        font-size: 13px;
        font-weight: 600;
        color: var(--text-dark);
        line-height: 1.45;
        flex: 1;
        margin-bottom: 10px;
    }
    .news-card-arrow {
        display: flex;
        justify-content: flex-end;
        margin-top: auto;
    }
    .arrow-btn {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        border: 1px solid var(--gray-mid);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--navy);
        font-size: 14px;
        transition: background 0.2s, color 0.2s;
    }
    .news-card:hover .arrow-btn {
        background: var(--navy);
        color: #fff;
        border-color: var(--navy);
    }

    /* ===== PAGINATION ===== */
    .pagination-wrap {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 6px;
        padding: 12px 0 52px;
    }
    .pg-btn {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        border: 1px solid var(--gray-mid);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 500;
        color: var(--navy);
        text-decoration: none;
        transition: all 0.15s;
    }
    .pg-btn:hover { background: var(--gray-light); }
    .pg-btn.active { background: var(--navy); color: #fff; border-color: var(--navy); }
    .pg-btn.disabled { border: none; color: var(--gray-text); pointer-events: none; }
    .pg-btn.arrow { font-size: 18px; color: var(--gray-text); }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="breadcrumb-bar">
    <div class="breadcrumb-inner">
        <div class="breadcrumb-title">Berita</div>
        <div class="breadcrumb-path">
            <a href="<?= base_url('/') ?>">Beranda</a> &gt; <span>Berita</span>
        </div>
    </div>
</div>

<div class="content-wrap">

    <h2 class="section-heading">Berita Terbaru</h2>
    <div class="section-underline"></div>

    <?php if (!empty($berita_terbaru)): ?>
    <div class="berita-terbaru-grid">

        <a href="<?= base_url('news/' . $berita_terbaru[0]['slug']) ?>" class="featured-card">
            <div class="featured-img">
                <?php if (!empty($berita_terbaru[0]['gambar'])): ?>
                    <img src="<?= base_url('assets/news/' . $berita_terbaru[0]['gambar']) ?>"
                         alt="<?= esc($berita_terbaru[0]['judul']) ?>">
                <?php endif; ?>
                <div class="featured-img-overlay">
                    <span class="news-badge">Trisakti News</span>
                </div>
            </div>
            <div class="featured-body">
                <div class="date"><?= strtoupper(date('l, d F Y', strtotime($berita_terbaru[0]['tanggal']))) ?></div>
                <h3><?= esc($berita_terbaru[0]['judul']) ?></h3>
            </div>
        </a>

        <div class="side-list">
            <?php foreach (array_slice($berita_terbaru, 1, 4) as $item): ?>
            <a href="<?= base_url('news/' . $item['slug']) ?>" class="side-card">
                <div class="side-img">
                    <?php if (!empty($item['gambar'])): ?>
                        <img src="<?= base_url('assets/news/' . $item['gambar']) ?>"
                             alt="<?= esc($item['judul']) ?>">
                    <?php endif; ?>
                </div>
                <div class="side-body">
                    <div class="date"><?= strtoupper(date('l, d F Y', strtotime($item['tanggal']))) ?></div>
                    <h4><?= esc(character_limiter($item['judul'])) ?></h4>
                </div>
            </a>
            <?php endforeach; ?>
        </div>

    </div>
    <?php endif; ?>

    <h2 class="section-heading">Semua Berita</h2>
    <div class="section-underline"></div>

    <?php if (!empty($semua_berita)): ?>
    <div class="semua-berita-grid">
        <?php foreach ($semua_berita as $item): ?>
        <a href="<?= base_url('news/' . $item['slug']) ?>" class="news-card">
            <div class="news-card-img">
                <?php if (!empty($item['gambar'])): ?>
                    <img src="<?= base_url('assets/news/' . $item['gambar']) ?>"
                         alt="<?= esc($item['judul']) ?>">
                <?php endif; ?>
                <span class="news-badge">Trisakti News</span>
            </div>
            <div class="news-card-body">
                <div class="date"><?= strtoupper(date('l, d F Y', strtotime($item['tanggal']))) ?></div>
                <h4><?= esc(character_limiter($item['judul'])) ?></h4>
                <div class="news-card-arrow">
                    <div class="arrow-btn">→</div>
                </div>
            </div>
        </a>
        <?php endforeach; ?>
    </div>
    <?php else: ?>
        <p style="color:var(--gray-text);padding:24px 0;">Belum ada berita.</p>
    <?php endif; ?>

    <?php if ($pager): ?>
<?php
    $currentPage = $pager->getCurrentPage('berita');
    $pageCount   = $pager->getPageCount('berita');
    $baseURL     = current_url() . '?page_berita=';
?>
<div class="pagination-wrap">
    <?php if ($currentPage > 1): ?>
        <a href="<?= $baseURL . ($currentPage - 1) ?>" class="pg-btn arrow">‹</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $pageCount; $i++): ?>
        <?php if ($i === 1 || $i === $pageCount || abs($i - $currentPage) <= 1): ?>
            <a href="<?= $baseURL . $i ?>"
               class="pg-btn <?= $i === $currentPage ? 'active' : '' ?>">
                <?= $i ?>
            </a>
        <?php elseif (abs($i - $currentPage) === 2): ?>
            <span class="pg-btn disabled">...</span>
        <?php endif; ?>
    <?php endfor; ?>

    <?php if ($currentPage < $pageCount): ?>
        <a href="<?= $baseURL . ($currentPage + 1) ?>" class="pg-btn arrow">›</a>
    <?php endif; ?>
</div>
<?php endif; ?>
    

</div><!-- end content-wrap -->

<?= $this->endSection() ?>