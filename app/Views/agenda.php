<?= $this->extend('layout/main') ?>
<?= $this->section('styles') ?>
<style>
    .breadcrumb-bar{background:#eef2f9;padding:14px 0;border-bottom:1px solid #dde4f0;}
    .breadcrumb-inner{max-width:1280px;margin:0 auto;padding:0 24px;display:flex;justify-content:space-between;align-items:center;}
    .breadcrumb-title{font-size:20px;font-weight:600;color:var(--navy);}
    .breadcrumb-path{font-size:12px;color:var(--gray-text);}
    .breadcrumb-path a{color:var(--gray-text);text-decoration:none;}
    .breadcrumb-path span{color:var(--navy);font-weight:500;}

    .agenda-wrap{max-width:1280px;margin:0 auto;padding:48px 24px 64px;}

    .featured-section{
        display:grid;
        grid-template-columns:1fr 1fr;
        gap:56px;
        align-items:center;
        padding:0 0 52px;
        border-bottom:1px solid var(--gray-mid);
        margin-bottom:52px;
    }
    .featured-left{}
    .featured-tag{
        display:inline-block;
        background:#e4e9f2;
        color:var(--navy);
        font-size:11px;font-weight:700;
        padding:5px 14px;border-radius:20px;
        margin-bottom:18px;letter-spacing:0.3px;
    }
    .featured-title{
        font-size:28px;font-weight:700;
        color:var(--navy);line-height:1.35;
        margin-bottom:16px;
    }
    .featured-desc{
        font-size:14px;color:#4a5568;
        line-height:1.8;margin-bottom:24px;
        display:-webkit-box;-webkit-line-clamp:5;
        -webkit-box-orient:vertical;overflow:hidden;
    }
    .featured-meta{
        display:flex;align-items:center;gap:16px;
        font-size:12px;color:var(--gray-text);
        margin-bottom:24px;
    }
    .featured-meta i{color:var(--navy);margin-right:4px;}
    .btn-detail{
        display:inline-flex;align-items:center;gap:8px;
        background:#e53935;color:#fff;
        font-size:13px;font-weight:700;
        padding:11px 24px;border-radius:4px;
        text-decoration:none;text-transform:uppercase;
        letter-spacing:0.5px;transition:background 0.2s;
    }
    .btn-detail:hover{background:#c62828;}
    .btn-detail i{font-size:11px;}

    .featured-right{}
    .featured-img{
        border-radius:10px;overflow:hidden;
        background:var(--navy);
        box-shadow:0 8px 32px rgba(26,46,90,0.14);
    }
    .featured-img img{
        width:100%;display:block;
        object-fit:cover;max-height:400px;
    }
    .featured-img-placeholder{
        height:340px;
        background:linear-gradient(135deg,var(--navy),var(--blue-mid));
        display:flex;align-items:center;justify-content:center;
    }
    .featured-img-placeholder i{font-size:48px;color:rgba(255,255,255,0.2);}
    .featured-dots{display:flex;gap:6px;margin-top:16px;}
    .featured-dot{width:24px;height:3px;border-radius:2px;background:var(--gray-mid);}
    .featured-dot.active{background:var(--navy);width:36px;}

    /* ===== SEMUA AGENDA ===== */
    .section-heading{font-size:20px;font-weight:700;color:var(--navy);margin-bottom:4px;}
    .section-underline{width:52px;height:3px;background:var(--navy);margin-bottom:28px;}

    .agenda-grid{
        display:grid;
        grid-template-columns:repeat(4,1fr);
        gap:20px;
        margin-bottom:40px;
    }
    .agenda-card{
        border-radius:8px;overflow:hidden;
        border:1px solid var(--gray-mid);
        background:#fff;text-decoration:none;
        transition:all 0.2s;display:flex;flex-direction:column;
    }
    .agenda-card:hover{transform:translateY(-4px);box-shadow:0 8px 24px rgba(26,46,90,0.12);}
    .agenda-card-img{
        height:200px;
        background:linear-gradient(135deg,var(--navy),var(--blue-mid));
        position:relative;overflow:hidden;flex-shrink:0;
    }
    .agenda-card-img img{width:100%;height:100%;object-fit:cover;display:block;}
    .agenda-card-date{
        position:absolute;bottom:0;left:0;right:0;
        background:rgba(10,20,50,0.82);
        padding:8px 12px;
        display:flex;align-items:center;gap:6px;
        font-size:11px;color:#fff;font-weight:500;
    }
    .agenda-card-date i{font-size:11px;color:rgba(255,255,255,0.7);}
    .agenda-card-body{padding:14px;flex:1;display:flex;flex-direction:column;}
    .agenda-card-title{
        font-size:13px;font-weight:600;color:var(--text-dark);
        line-height:1.5;flex:1;
        display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;
    }

    /* pagination */
    .pagination-wrap{display:flex;justify-content:center;align-items:center;gap:6px;padding:8px 0;}
    .pg-btn{width:38px;height:38px;border-radius:50%;border:1px solid var(--gray-mid);display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:500;color:var(--navy);text-decoration:none;transition:all 0.15s;background:#fff;}
    .pg-btn:hover{background:var(--gray-light);}
    .pg-btn.active{background:var(--navy);color:#fff;border-color:var(--navy);}
    .pg-btn.disabled{border:none;color:var(--gray-text);pointer-events:none;}
    .pg-btn.arrow{font-size:18px;color:var(--gray-text);}
    .empty-state{text-align:center;padding:64px 24px;color:var(--gray-text);font-size:14px;}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="breadcrumb-bar">
    <div class="breadcrumb-inner">
        <div class="breadcrumb-title">Agenda</div>
        <div class="breadcrumb-path">
            <a href="<?= base_url('/') ?>">Beranda</a> &gt; <span>Agenda</span>
        </div>
    </div>
</div>

<div class="agenda-wrap">

    <?php if (!empty($featured)): ?>
    <div class="featured-section">
        <div class="featured-left">
            <div class="featured-tag">
                <i class="fas fa-calendar-alt" style="margin-right:5px;"></i>
                <?= date('l, d F Y', strtotime($featured['tanggal'])) ?>
            </div>
            <div class="featured-title"><?= esc($featured['judul']) ?></div>
            <?php if (!empty($featured['tempat']) || !empty($featured['Waktu'])): ?>
            <div class="featured-meta">
                <?php if (!empty($featured['Waktu'])): ?>
                    <span><i class="fas fa-clock"></i><?= esc(substr($featured['Waktu'], 0, 5)) ?> WIB</span>
                <?php endif; ?>
                <?php if (!empty($featured['tempat'])): ?>
                    <span><i class="fas fa-map-marker-alt"></i><?= esc($featured['tempat']) ?></span>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <?php if (!empty($featured['deskripsi'])): ?>
            <div class="featured-desc"><?= nl2br(esc((string)$featured['deskripsi'])) ?></div>
            <?php endif; ?>
            <a href="<?= base_url('agenda/' . $featured['slug']) ?>" class="btn-detail">
                Selengkapnya <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        <div class="featured-right">
            <div class="featured-img">
                <?php if (!empty($featured['gambar'])): ?>
                    <img src="<?= base_url('assets/agenda/' . $featured['gambar']) ?>"
                         alt="<?= esc($featured['judul']) ?>">
                <?php else: ?>
                    <div class="featured-img-placeholder">
                        <i class="fas fa-calendar"></i>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="section-heading">Semua Agenda</div>
    <div class="section-underline"></div>

    <?php if (!empty($agenda)): ?>
    <div class="agenda-grid">
        <?php foreach ($agenda as $item): ?>
        <a href="<?= base_url('agenda/' . $item['slug']) ?>" class="agenda-card">
            <div class="agenda-card-img">
                <?php if (!empty($item['gambar'])): ?>
                    <img src="<?= base_url('assets/agenda/' . $item['gambar']) ?>"
                         alt="<?= esc($item['judul']) ?>">
                <?php endif; ?>
                <div class="agenda-card-date">
                    <i class="fas fa-calendar-alt"></i>
                    <?= date('l, d F Y', strtotime($item['tanggal'])) ?>
                </div>
            </div>
            <div class="agenda-card-body">
                <div class="agenda-card-title"><?= esc($item['judul']) ?></div>
            </div>
        </a>
        <?php endforeach; ?>
    </div>

    <?php if ($pageCount > 1): ?>
<?php $baseURL = current_url() . '?page_agenda='; ?>
<div class="pagination-wrap">
    <?php if ($currentPage > 1): ?>
        <a href="<?= $baseURL . ($currentPage - 1) ?>" class="pg-btn arrow">‹</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $pageCount; $i++): ?>
        <?php if ($i === 1 || $i === $pageCount || abs($i - $currentPage) <= 1): ?>
            <a href="<?= $baseURL . $i ?>"
               class="pg-btn <?= $i === $currentPage ? 'active' : '' ?>"><?= $i ?></a>
        <?php elseif (abs($i - $currentPage) === 2): ?>
            <span class="pg-btn disabled">...</span>
        <?php endif; ?>
    <?php endfor; ?>

    <?php if ($currentPage < $pageCount): ?>
        <a href="<?= $baseURL . ($currentPage + 1) ?>" class="pg-btn arrow">›</a>
    <?php endif; ?>
</div>
<?php endif; ?>

    <?php else: ?>
        <div class="empty-state">Belum ada agenda yang tersedia.</div>
    <?php endif; ?>

</div>

<?= $this->endSection() ?>