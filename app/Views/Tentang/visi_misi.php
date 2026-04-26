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
    .tentang-konten h1{font-size:22px;font-weight:700;color:var(--navy);margin-bottom:8px;}
    .konten-underline{width:48px;height:3px;background:var(--navy);margin-bottom:24px;}
    .vm-box{background:#fff;border:1px solid var(--gray-mid);border-radius:8px;padding:24px;margin-bottom:20px;}
    .vm-box h2{font-size:16px;font-weight:700;color:var(--navy);margin-bottom:12px;padding-bottom:10px;border-bottom:2px solid var(--accent);display:inline-block;}
    .vm-box p{font-size:14px;line-height:1.85;color:#2d3748;}
    .misi-list{list-style:none;padding:0;}
    .misi-list li{display:flex;gap:12px;font-size:14px;line-height:1.7;color:#2d3748;margin-bottom:10px;}
    .misi-num{width:24px;height:24px;background:var(--navy);color:#fff;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;flex-shrink:0;margin-top:2px;}
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

    <div class="tentang-konten">
        <h1><?= esc($page_title) ?></h1>
        <div class="konten-underline"></div>

        <!-- Visi -->
        <div class="vm-box">
            <h2>Visi</h2>
            <p><?= nl2br(esc((string)$visi)) ?></p>
        </div>

        <div class="vm-box">
            <h2>Misi</h2>
            <?php
                $misiLines = array_filter(explode("\n", $misi), fn($l) => trim($l) !== '');
                $misiLines = array_values($misiLines);
            ?>
            <ul class="misi-list">
                <?php foreach ($misiLines as $i => $line): ?>
                    <?php $text = preg_replace('/^\d+\.\s*/', '', trim($line)); ?>
                    <li>
                        <div class="misi-num"><?= $i + 1 ?></div>
                        <span><?= esc($text) ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

<?= $this->endSection() ?>