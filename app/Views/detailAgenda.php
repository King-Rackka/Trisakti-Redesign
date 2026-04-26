<?= $this->extend('layout/main') ?>
<?= $this->section('styles') ?>
<style>
    .breadcrumb-bar{background:#eef2f9;padding:14px 0;border-bottom:1px solid #dde4f0;}
    .breadcrumb-inner{max-width:1280px;margin:0 auto;padding:0 24px;display:flex;justify-content:space-between;align-items:center;}
    .breadcrumb-title{font-size:20px;font-weight:600;color:var(--navy);}
    .breadcrumb-path{font-size:12px;color:var(--gray-text);}
    .breadcrumb-path a{color:var(--gray-text);text-decoration:none;}
    .breadcrumb-path span{color:var(--navy);font-weight:500;}

    .detail-wrap{max-width:1100px;margin:0 auto;padding:48px 24px 64px;}

    .detail-grid{
        display:grid;
        grid-template-columns:1fr 1.1fr;
        gap:48px;
        align-items:start;
        margin-bottom:48px;
    }

    /* kolom kiri: gambar */
    .detail-img{
        border-radius:10px;overflow:hidden;
        background:linear-gradient(135deg,var(--navy),var(--blue-mid));
        box-shadow:0 8px 32px rgba(26,46,90,0.12);
    }
    .detail-img img{width:100%;display:block;object-fit:cover;}
    .detail-img-placeholder{
        height:320px;display:flex;align-items:center;justify-content:center;
    }
    .detail-img-placeholder i{font-size:48px;color:rgba(255,255,255,0.2);}

    /* kolom kanan: info */
    .detail-right{}
    .detail-meta-header{
        display:flex;align-items:center;gap:24px;
        margin-bottom:16px;
        font-size:12px;color:var(--gray-text);
    }
    .detail-meta-header span{display:flex;align-items:center;gap:5px;}
    .detail-meta-header i{color:var(--blue-mid);}
    .detail-title{
        font-size:22px;font-weight:700;
        color:var(--navy);line-height:1.4;
        margin-bottom:20px;
    }

    /* info table */
    .detail-info-table{
        width:100%;border-collapse:collapse;
        margin-bottom:24px;font-size:14px;
    }
    .detail-info-table tr td{
        padding:10px 14px;
        border:1px solid var(--gray-mid);
        vertical-align:top;
    }
    .detail-info-table tr td:first-child{
        width:80px;font-weight:600;color:var(--gray-text);
        background:#f8fafd;white-space:nowrap;
    }
    .detail-info-table tr td:last-child{color:var(--text-dark);}

    /* deskripsi */
    .detail-desc{
        font-size:14px;line-height:1.85;
        color:#4a5568;margin-bottom:24px;
    }

    /* share */
    .detail-share{display:flex;gap:8px;margin-bottom:0;}
    .share-btn{
        width:34px;height:34px;border-radius:4px;
        display:flex;align-items:center;justify-content:center;
        font-size:14px;color:#fff;text-decoration:none;transition:opacity 0.2s;
    }
    .share-btn:hover{opacity:0.85;}
    .share-fb{background:#1877f2;}
    .share-tw{background:#1da1f2;}

    /* ===== AGENDA TERDEKAT ===== */
    .divider{border:none;border-top:1px solid var(--gray-mid);margin:40px 0 32px;}
    .terdekat-header{
        display:flex;align-items:center;justify-content:space-between;
        margin-bottom:20px;
    }
    .terdekat-title{font-size:18px;font-weight:700;color:var(--navy);}
    .terdekat-underline{width:48px;height:3px;background:var(--navy);margin-bottom:20px;}
    .btn-semua{
        display:inline-flex;align-items:center;gap:6px;
        background:#e53935;color:#fff;
        font-size:12px;font-weight:700;
        padding:8px 16px;border-radius:4px;
        text-decoration:none;text-transform:uppercase;
        letter-spacing:0.5px;transition:background 0.2s;
    }
    .btn-semua:hover{background:#c62828;}

    .terdekat-grid{
        display:grid;
        grid-template-columns:repeat(4,1fr);
        gap:16px;
    }
    .terdekat-card{
        border-radius:8px;overflow:hidden;
        border:1px solid var(--gray-mid);
        background:#fff;text-decoration:none;
        transition:all 0.2s;display:flex;flex-direction:column;
    }
    .terdekat-card:hover{transform:translateY(-3px);box-shadow:0 6px 20px rgba(26,46,90,0.1);}
    .terdekat-card-img{
        height:160px;
        background:linear-gradient(135deg,var(--navy),var(--blue-mid));
        position:relative;overflow:hidden;flex-shrink:0;
    }
    .terdekat-card-img img{width:100%;height:100%;object-fit:cover;display:block;}
    .terdekat-card-date{
        position:absolute;bottom:0;left:0;right:0;
        background:rgba(10,20,50,0.82);
        padding:6px 10px;
        display:flex;align-items:center;gap:5px;
        font-size:10px;color:#fff;font-weight:500;
    }
    .terdekat-card-date i{font-size:10px;color:rgba(255,255,255,0.7);}
    .terdekat-card-body{padding:12px;flex:1;}
    .terdekat-card-title{
        font-size:12px;font-weight:600;color:var(--text-dark);
        line-height:1.5;
        display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="breadcrumb-bar">
    <div class="breadcrumb-inner">
        <div class="breadcrumb-title">Agenda</div>
        <div class="breadcrumb-path">
            <a href="<?= base_url('/') ?>">Beranda</a> &gt;
            <a href="<?= base_url('agenda') ?>">Agenda</a> &gt;
            <span><?= esc(mb_substr($agenda['judul'], 0, 60)) ?><?= mb_strlen($agenda['judul']) > 60 ? '...' : '' ?></span>
        </div>
    </div>
</div>

<div class="detail-wrap">

    <div class="detail-grid">

        <div class="detail-img">
            <?php if (!empty($agenda['gambar'])): ?>
                <img src="<?= base_url('assets/agenda/' . $agenda['gambar']) ?>"
                     alt="<?= esc($agenda['judul']) ?>">
            <?php else: ?>
                <div class="detail-img-placeholder">
                    <i class="fas fa-calendar" style="color:rgba(255,255,255,0.2);font-size:48px;"></i>
                </div>
            <?php endif; ?>
        </div>

        <div class="detail-right">
            <div class="detail-meta-header">
                <span>
                    <i class="fas fa-calendar-alt"></i>
                    <?= date('l, d F Y', strtotime($agenda['created_at'])) ?>
                </span>
            </div>

            <div class="detail-title"><?= esc($agenda['judul']) ?></div>

            <table class="detail-info-table">
                <tr>
                    <td>Tanggal</td>
                    <td><?= date('l, d F Y', strtotime($agenda['tanggal'])) ?></td>
                </tr>
                <?php if (!empty($agenda['waktu'])): ?>
                <tr>
                    <td>Waktu</td>
                    <td><?= esc(substr($agenda['waktu'], 0, 5)) ?></td>
                </tr>
                <?php endif; ?>
                <?php if (!empty($agenda['tempat'])): ?>
                <tr>
                    <td>Tempat</td>
                    <td><?= esc($agenda['tempat']) ?></td>
                </tr>
                <?php endif; ?>
            </table>

            <?php if (!empty($agenda['deskripsi'])): ?>
            <div class="detail-desc">
                <?= nl2br(esc((string)$agenda['deskripsi'])) ?>
            </div>
            <?php endif; ?>

        </div>

    </div>

    <?php if (!empty($terdekat)): ?>
    <hr class="divider">
    <div class="terdekat-header">
        <div>
            <div class="terdekat-title">Agenda Terdekat</div>
            <div class="terdekat-underline"></div>
        </div>
        <a href="<?= base_url('agenda') ?>" class="btn-semua">Semua Agenda</a>
    </div>
    <div class="terdekat-grid">
        <?php foreach ($terdekat as $item): ?>
        <a href="<?= base_url('agenda/' . $item['slug']) ?>" class="terdekat-card">
            <div class="terdekat-card-img">
                <?php if (!empty($item['gambar'])): ?>
                    <img src="<?= base_url('assets/agenda/' . $item['gambar']) ?>"
                         alt="<?= esc($item['judul']) ?>">
                <?php endif; ?>
                <div class="terdekat-card-date">
                    <i class="fas fa-calendar-alt"></i>
                    <?= date('l, d F Y', strtotime($item['tanggal'])) ?>
                </div>
            </div>
            <div class="terdekat-card-body">
                <div class="terdekat-card-title"><?= esc($item['judul']) ?></div>
            </div>
        </a>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

</div>

<?= $this->endSection() ?>