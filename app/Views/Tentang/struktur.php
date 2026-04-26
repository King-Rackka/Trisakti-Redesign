<?= $this->extend('layout/main') ?>
<?= $this->section('styles') ?>
<style>
    .breadcrumb-bar{background:#eef2f9;padding:14px 0;border-bottom:1px solid #dde4f0;}
    .breadcrumb-inner{max-width:1280px;margin:0 auto;padding:0 24px;display:flex;justify-content:space-between;align-items:center;}
    .breadcrumb-title{font-size:20px;font-weight:600;color:var(--navy);}
    .breadcrumb-path{font-size:12px;color:var(--gray-text);}
    .breadcrumb-path a{color:var(--gray-text);text-decoration:none;}
    .breadcrumb-path span{color:var(--navy);font-weight:500;}
    .tentang-wrap{max-width:1280px;margin:0 auto;padding:40px 24px 60px;display:grid;grid-template-columns:260px 1fr;gap:32px;align-items:start;}
    .tentang-sidebar{background:#fff;border:1px solid var(--gray-mid);border-radius:8px;overflow:hidden;}
    .tentang-sidebar-title{background:var(--navy);color:#fff;font-size:13px;font-weight:600;padding:14px 18px;}
    .tentang-sidebar ul{list-style:none;padding:6px 0;}
    .tentang-sidebar ul li a{display:block;padding:10px 18px;font-size:13px;color:var(--text-dark);border-left:3px solid transparent;transition:all 0.15s;text-decoration:none;}
    .tentang-sidebar ul li a:hover{background:var(--gray-light);color:var(--navy);}
    .tentang-sidebar ul li a.active{background:var(--gray-light);color:var(--navy);font-weight:600;border-left-color:var(--navy);}
    .konten-title{font-size:22px;font-weight:700;color:var(--navy);margin-bottom:8px;}
    .konten-underline{width:48px;height:3px;background:var(--navy);margin-bottom:28px;}

    .struktur-list{list-style:none;padding:0;}
    .struktur-list li{
        display:flex;align-items:baseline;gap:0;
        padding:11px 0;border-bottom:1px solid var(--gray-mid);
        font-size:14px;line-height:1.6;
    }
    .struktur-list li:last-child{border-bottom:none;}
    .struktur-dot{
        width:7px;height:7px;border-radius:50%;
        background:var(--navy);flex-shrink:0;
        margin-right:12px;margin-top:6px;
    }
    .struktur-jabatan{font-weight:600;color:var(--navy);min-width:300px;}
    .struktur-sep{color:var(--gray-text);margin:0 10px;}
    .struktur-nama{color:var(--text-dark);}
    .empty-state{padding:32px 0;color:var(--gray-text);font-size:13px;}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="breadcrumb-bar">
    <div class="breadcrumb-inner">
        <div class="breadcrumb-title"><?= esc($page_title) ?></div>
        <div class="breadcrumb-path">
            <a href="<?= base_url('/') ?>">Beranda</a> &gt;
            <a href="#">Tentang</a> &gt;
            <span><?= esc($page_title) ?></span>
        </div>
    </div>
</div>

<div class="tentang-wrap">
    <aside class="tentang-sidebar">
        <div class="tentang-sidebar-title">Tentang Trisakti</div>
        <ul>
            <?php foreach ($sidebar_menu as $menu): ?>
            <li>
                <a href="<?= base_url($menu['url']) ?>"
                   class="<?= $active === $menu['url'] ? 'active' : '' ?>">
                    <?= esc($menu['label']) ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </aside>

    <div>
        <h1 class="konten-title"><?= esc($page_title) ?></h1>
        <div class="konten-underline"></div>

        <?php if (!empty($struktur)): ?>
        <ul class="struktur-list">
            <?php foreach ($struktur as $item): ?>
            <li>
                <div class="struktur-dot"></div>
                <div class="struktur-jabatan"><?= esc($item['jabatan']) ?></div>
                <div class="struktur-sep">:</div>
                <div class="struktur-nama"><?= esc($item['nama']) ?></div>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php else: ?>
        <div class="empty-state">Data struktur organisasi belum tersedia.</div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>