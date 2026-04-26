<?= $this->extend('layout/main') ?>
<?= $this->section('styles') ?>
<style>
    .breadcrumb-bar{background:#eef2f9;padding:14px 0;border-bottom:1px solid #dde4f0;}
    .breadcrumb-inner{max-width:1280px;margin:0 auto;padding:0 24px;display:flex;justify-content:space-between;align-items:center;}
    .breadcrumb-title{font-size:20px;font-weight:600;color:var(--navy);}
    .breadcrumb-path{font-size:12px;color:var(--gray-text);}
    .breadcrumb-path a{color:var(--gray-text);text-decoration:none;}
    .breadcrumb-path span{color:var(--navy);font-weight:500;}

    .alumni-wrap{max-width:1280px;margin:0 auto;padding:48px 24px 64px;}
    .alumni-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px;margin-bottom:40px;}

    .alumni-card{
        border-radius:10px;
        overflow:visible;      
        border:1px solid var(--gray-mid);
        background:#fff;
        text-decoration:none;
        transition:all 0.2s;
        display:flex;
        flex-direction:column;
        position:relative;
    }
    .alumni-card:hover{transform:translateY(-4px);box-shadow:0 12px 32px rgba(26,46,90,0.12);border-color:var(--navy);}

    .alumni-card-bg-wrap{
        border-radius:10px 10px 0 0;  
        overflow:hidden;              
        flex-shrink:0;
    }
    .alumni-card-bg{
        height:200px;
        background:linear-gradient(135deg,var(--navy),var(--blue-mid));
        position:relative;
    }
    .alumni-card-bg img{
        width:100%;height:100%;
        object-fit:cover;object-position:center;
        display:block;filter:brightness(0.8);
    }

    .alumni-card-foto-wrap{
        display:flex;
        justify-content:center;
        margin-top:-44px;
        position:relative;
        z-index:3;
        padding-bottom:2px;
    }
    .alumni-card-foto{
        width:84px;height:84px;
        border-radius:50%;
        border:4px solid #fff;
        overflow:hidden;
        background:var(--navy);
        box-shadow:0 4px 16px rgba(0,0,0,0.18);
        flex-shrink:0;
    }
    .alumni-card-foto img{
        width:100%;height:100%;
        object-fit:cover;object-position:center top;
        display:block;
    }
    .alumni-card-foto-placeholder{
        width:100%;height:100%;
        display:flex;align-items:center;justify-content:center;
        font-size:28px;font-weight:700;color:#fff;
        background:var(--blue-mid);
    }

    .alumni-card-body{
        padding:10px 24px 24px;
        text-align:center;
        flex:1;display:flex;flex-direction:column;
    }
    .alumni-card-name{font-size:16px;font-weight:700;color:var(--navy);margin-bottom:5px;}
    .alumni-card-jurusan{font-size:13px;color:var(--gray-text);margin-bottom:8px;}
    .alumni-card-angkatan{display:inline-block;font-size:11px;font-weight:600;background:#e4e9f2;color:var(--navy);padding:3px 10px;border-radius:20px;margin-bottom:14px;}
    .alumni-card-desc{font-size:13px;color:#6b7a99;line-height:1.7;flex:1;margin-bottom:18px;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;text-align:left;}
    .alumni-card-link{display:inline-flex;align-items:center;gap:6px;font-size:12px;font-weight:700;color:var(--navy);text-transform:uppercase;letter-spacing:0.5px;margin-top:auto;}
    .alumni-card-link i{font-size:10px;transition:transform 0.2s;}
    .alumni-card:hover .alumni-card-link i{transform:translateX(4px);}

    .pagination-wrap{display:flex;justify-content:center;align-items:center;gap:6px;padding:8px 0;}
    .pg-btn{width:38px;height:38px;border-radius:50%;border:1px solid var(--gray-mid);display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:500;color:var(--navy);text-decoration:none;transition:all 0.15s;}
    .pg-btn:hover{background:var(--gray-light);}
    .pg-btn.active{background:var(--navy);color:#fff;border-color:var(--navy);}
    .pg-btn.disabled{border:none;color:var(--gray-text);pointer-events:none;}
    .pg-btn.arrow{font-size:18px;color:var(--gray-text);}
    .empty-state{text-align:center;padding:80px 24px;color:var(--gray-text);font-size:14px;}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="breadcrumb-bar">
    <div class="breadcrumb-inner">
        <div class="breadcrumb-title">Alumni</div>
        <div class="breadcrumb-path">
            <a href="<?= base_url('/') ?>">Beranda</a> &gt; <span>Alumni</span>
        </div>
    </div>
</div>

<div class="alumni-wrap">
    <?php if (!empty($alumni)): ?>
    <div class="alumni-grid">
        <?php foreach ($alumni as $item): ?>
        <a href="<?= base_url('alumni/' . $item['id']) ?>" class="alumni-card">

            <div class="alumni-card-bg-wrap">
                <div class="alumni-card-bg">
                    <?php if (!empty($item['background_images'])): ?>
                        <img src="<?= base_url('assets/alumni/' . $item['background_images']) ?>"
                             alt="<?= esc($item['nama']) ?>">
                    <?php endif; ?>
                </div>
            </div>

            <div class="alumni-card-foto-wrap">
                <div class="alumni-card-foto">
                    <?php if (!empty($item['foto_profil'])): ?>
                        <img src="<?= base_url('assets/alumni/' . $item['foto_profil']) ?>"
                             alt="<?= esc($item['nama']) ?>">
                    <?php else: ?>
                        <div class="alumni-card-foto-placeholder">
                            <?= strtoupper(substr($item['nama'], 0, 1)) ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="alumni-card-body">
                <div class="alumni-card-name"><?= esc($item['nama']) ?></div>
                <div class="alumni-card-jurusan"><?= esc($item['jurusan'] ?: '-') ?></div>
                <?php if (!empty($item['angkatan'])): ?>
                    <div><span class="alumni-card-angkatan">Angkatan <?= esc($item['angkatan']) ?></span></div>
                <?php endif; ?>
                <?php if (!empty($item['deskripsi'])): ?>
                    <div class="alumni-card-desc"><?= esc($item['deskripsi']) ?></div>
                <?php endif; ?>
                <div class="alumni-card-link">Lihat Profil <i class="fas fa-arrow-right"></i></div>
            </div>

        </a>
        <?php endforeach; ?>
    </div>

    <?php if (isset($pager) && $pager): ?>
    <?php
        $currentPage = $pager->getCurrentPage('alumni');
        $pageCount   = $pager->getPageCount('alumni');
        $baseURL     = current_url() . '?page_alumni=';
    ?>
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
    <div class="empty-state">Belum ada data alumni.</div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>