<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<?php
$p     = $prodi;
$warna = $p['warna_fakultas'] ?? '#1a3a6b';

function ytbEmbedProdi(string $url): ?string {
    preg_match('/(?:youtu\.be\/|[?&]v=|embed\/)([a-zA-Z0-9_-]{11})/', $url, $m);
    if (!isset($m[1])) return null;
    $id = $m[1];
    return "https://www.youtube.com/embed/{$id}?autoplay=1&mute=1&loop=1&playlist={$id}&controls=0&playsinline=1";
}

$hasTentang  = !empty(trim($p['tentang'] ?? ''));
$hasSejarah  = !empty(trim($p['sejarah'] ?? ''));
$hasKaprodi  = !empty($p['nama_kaprodi']) || !empty($p['sambutan_kaprodi']);

$tabs = [];
if ($hasTentang) $tabs[] = ['id' => 'tentang', 'label' => 'Tentang'];
if ($hasSejarah) $tabs[] = ['id' => 'sejarah', 'label' => 'Sejarah'];
if ($hasKaprodi) $tabs[] = ['id' => 'kaprodi', 'label' => 'Sambutan Kaprodi'];
?>

<style>
.pd-hero {
    position: relative;
    width: 100%;
    aspect-ratio: 16 / 9; 
    overflow: hidden;
    background: <?= esc($warna) ?>;
}

.pd-hero iframe,
.pd-hero img {
    width: 100%;
    height: 100%;
    object-fit: contain; 
    background: black; 
}

.pd-hero-overlay{position:absolute;inset:0;background:linear-gradient(to top,rgba(5,15,40,.92) 0%,rgba(5,15,40,.55) 50%,rgba(5,15,40,.2) 100%);display:flex;align-items:flex-end;padding:0 0 2.5rem 2rem;}
.pd-hero-inner{max-width:860px;}
.pd-bread{display:flex;gap:6px;align-items:center;font-size:12px;margin-bottom:12px;}
.pd-bread a{color:rgba(255,255,255,.5);text-decoration:none;}.pd-bread a:hover{color:#fff;}
.pd-bread .sep{color:rgba(255,255,255,.25);}.pd-bread .cur{color:rgba(255,255,255,.85);}
.pd-jenjang-badge{display:inline-block;background:<?= esc($warna) ?>;color:#fff;font-size:11px;font-weight:700;padding:3px 12px;border-radius:20px;margin-bottom:10px;filter:brightness(1.4);}
.pd-hero-title{color:#fff;font-size:30px;font-weight:700;line-height:1.35;margin:0 0 6px;}
.pd-hero-fak{color:rgba(255,255,255,.65);font-size:14px;margin:0;}

.pd-tabnav{background:#fff;border-bottom:1px solid #e5e7eb;position:sticky;top:64px;z-index:200;padding:0 2rem;}
.pd-tabs{display:flex;}
.pd-tab-link{display:inline-flex;align-items:center;gap:6px;padding:14px 20px;font-size:14px;color:#6b7280;text-decoration:none;border-bottom:2px solid transparent;transition:color .15s,border-color .15s;white-space:nowrap;cursor:pointer;}
.pd-tab-link:hover{color:#1f2937;}
.pd-tab-link.active{color:<?= esc($warna) ?>;border-bottom-color:<?= esc($warna) ?>;font-weight:600;}

.pd-content{max-width:960px;margin:0 auto;padding:2.5rem 1.5rem;}
.pd-pane{display:none;}.pd-pane.active{display:block;}

.pd-konten-grid{
    gap:20px;
    max-width: 1000px;
    margin: 0 auto;
    grid-template-columns:<?php
        if ($hasTentang && $hasSejarah) echo '1fr 1fr';
        else echo '1fr';
    ?>;
}
@media(max-width:640px){.pd-konten-grid{grid-template-columns:1fr;}}

.pd-card{display:flex;background:#fff;border:1px solid #e5e7eb;border-radius:12px;overflow:hidden;height:100%;}
.pd-stripe{width:4px;background:<?= esc($warna) ?>;flex-shrink:0;}
.pd-body{padding:1.5rem 1.5rem 1.5rem 1.25rem;flex:1;}
.pd-body h2{font-size:17px;font-weight:600;color:#1f2937;margin:0 0 14px;}
.pd-body p{font-size:14px;color:#374151;line-height:1.85;margin:0;}

.pd-kap-wrap{display:flex;gap:2rem;align-items:flex-start;flex-wrap:wrap;}
.pd-kap-col{flex-shrink:0;text-align:center;}
.pd-kap-foto{width:148px;height:188px;object-fit:cover;border-radius:10px;border:3px solid <?= esc($warna) ?>;display:block;margin:0 auto 10px;}
.pd-kap-foto-ph{width:148px;height:188px;border-radius:10px;border:3px solid <?= esc($warna) ?>;background:#f3f4f6;display:flex;align-items:center;justify-content:center;font-size:48px;color:#d1d5db;margin:0 auto 10px;}
.pd-kap-nama{font-size:13px;font-weight:600;color:#1f2937;margin:0 0 3px;}
.pd-kap-jabatan{font-size:12px;color:#9ca3af;margin:0;}
.pd-kap-kanan{flex:1;min-width:260px;}

.pd-empty{text-align:center;padding:3rem 1rem;}
.pd-empty-icon{font-size:52px;color:<?= esc($warna) ?>;margin-bottom:14px;}
.pd-empty h3{font-size:18px;font-weight:600;color:#1f2937;margin:0 0 8px;}
.pd-empty p{font-size:14px;color:#9ca3af;margin:0;}

.pd-back{display:inline-flex;align-items:center;gap:8px;margin-top:2rem;background:#fff;border:1px solid #e5e7eb;border-radius:8px;padding:9px 18px;font-size:13px;font-weight:500;color:#374151;text-decoration:none;transition:border-color .15s,color .15s;}
.pd-back:hover{border-color:<?= esc($warna) ?>;color:<?= esc($warna) ?>;}

.breadcrumb-bar{background:#eef2f9;padding:14px 0;border-bottom:1px solid #dde4f0;}
    .breadcrumb-inner{max-width:1280px;margin:0 auto;padding:0 24px;display:flex;justify-content:space-between;align-items:center;}
    .breadcrumb-title{font-size:20px;font-weight:600;color:var(--navy);}
    .breadcrumb-path{font-size:12px;color:var(--gray-text);}
    .breadcrumb-path a{color:var(--gray-text);text-decoration:none;}
    .breadcrumb-path span{color:var(--navy);font-weight:500;}

</style>

<div class="breadcrumb-bar">
    <div class="breadcrumb-inner">
        <div class="breadcrumb-title">(<?= esc($p['jenjang'])?>) <?= esc($p['nama']) ?></div>
        <div class="breadcrumb-path">
            <a href="<?= base_url('/') ?>">Beranda</a> &gt; 
            <a href="<?= base_url('fakultas/' . $p['slug_fakultas']) ?>"><?= esc($p['nama_fakultas']) ?></a><span class="sep"> &gt; </span>
            <span><?= esc($p['nama']) ?></span>
        </div>
    </div>
</div>

<div class="pd-hero">
    <?php if ($p['bg_tipe'] === 'youtube' && !empty($p['bg_value'])) :
        $embed = ytbEmbedProdi($p['bg_value']); ?>
        <?php if ($embed) : ?><iframe src="<?= $embed ?>" allow="autoplay; fullscreen" allowfullscreen></iframe><?php endif; ?>
    <?php elseif ($p['bg_tipe'] === 'image' && !empty($p['bg_value'])) : ?>
        <img src="<?= base_url('assets/prodi/' . $p['bg_value']) ?>" alt="<?= esc($p['nama']) ?>">
    <?php endif; ?>
    <div class="pd-hero-overlay">
        <div class="pd-hero-inner">
            <nav class="pd-bread">
                <a href="<?= base_url() ?>">Beranda</a><span class="sep">/</span>
                <a href="<?= base_url('fakultas') ?>">Fakultas</a><span class="sep">/</span>
                <a href="<?= base_url('fakultas/' . $p['slug_fakultas']) ?>"><?= esc($p['nama_fakultas']) ?></a><span class="sep">/</span>
                <span class="cur"><?= esc($p['nama']) ?></span>
            </nav>
            <span class="pd-jenjang-badge"><?= esc($p['jenjang']) ?></span>
            <h1 class="pd-hero-title"><?= esc($p['nama']) ?></h1>
            <p class="pd-hero-fak"><?= esc($p['nama_fakultas']) ?></p>
        </div>
    </div>
</div>

<?php if (!empty($tabs)) : ?>
<div class="pd-tabnav">
    <div class="pd-tabs">
        <?php foreach ($tabs as $i => $tab) : ?>
        <a class="pd-tab-link <?= $i === 0 ? 'active' : '' ?>"
           onclick="switchPdTab('<?= $tab['id'] ?>', this)" href="#">
            <?= $tab['label'] ?>
        </a>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>

<div class="pd-content">

    <?php if (!empty($tabs)) : ?>

        <?php if ($hasTentang) :
            $tentangFirst = ($tabs[0]['id'] === 'tentang'); ?>
        <div class="pd-pane <?= $tentangFirst ? 'active' : '' ?>" id="pane-tentang">
            <div class="pd-konten-grid">
                <?php if ($hasTentang) : ?>
                <div class="pd-card">
                    <div class="pd-stripe"></div>
                    <div class="pd-body">
                        <h2>Tentang Program Studi</h2>
                        <p><?= nl2br(esc((string)$p['tentang'])) ?></p>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if ($hasSejarah) :
            $sejarahFirst = ($tabs[0]['id'] === 'sejarah'); ?>
        <div class="pd-pane <?= $sejarahFirst ? 'active' : '' ?>" id="pane-sejarah">
            <div class="pd-konten-grid">
                <?php if ($hasSejarah) : ?>
                <div class="pd-card">
                    <div class="pd-stripe"></div>
                    <div class="pd-body">
                        <h2>Sejarah</h2>
                        <p><?= nl2br(esc((string)$p['sejarah'])) ?></p>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if ($hasKaprodi) :
            $kapFirst = ($tabs[0]['id'] === 'kaprodi'); ?>
        <div class="pd-pane <?= $kapFirst ? 'active' : '' ?>" id="pane-kaprodi">
            <div class="pd-kap-wrap">
                <div class="pd-kap-col">
                    <?php if (!empty($p['foto_kaprodi'])) : ?>
                        <img class="pd-kap-foto" src="<?= base_url('assets/kaprodi/' . $p['foto_kaprodi']) ?>" alt="<?= esc($p['nama_kaprodi'] ?? 'Kaprodi') ?>">
                    <?php else : ?>
                        <div class="pd-kap-foto-ph"><i class="bi bi-person-fill"></i></div>
                    <?php endif; ?>
                    <?php if (!empty($p['nama_kaprodi'])) : ?>
                    <p class="pd-kap-nama"><?= esc($p['nama_kaprodi']) ?></p>
                    <p class="pd-kap-jabatan">Ketua Program Studi<br><?= esc($p['nama']) ?></p>
                    <?php endif; ?>
                </div>
                <div class="pd-kap-kanan">
                    <div class="pd-card">
                        <div class="pd-stripe"></div>
                        <div class="pd-body">
                            <h2>Sambutan Ketua Program Studi</h2>
                            <p><?= !empty($p['sambutan_kaprodi']) ? nl2br(esc((string)$p['sambutan_kaprodi'])) : '<span style="color:#9ca3af;">Sambutan belum tersedia.</span>' ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

    <?php else : ?>
        <div class="pd-empty">
            <div class="pd-empty-icon"><i class="bi bi-mortarboard"></i></div>
            <h3><?= esc($p['nama']) ?></h3>
            <p>Informasi program studi akan segera tersedia.</p>
        </div>
    <?php endif; ?>

    <a class="pd-back" href="<?= base_url('fakultas/' . $p['slug_fakultas']) ?>">
        <i class="bi bi-arrow-left"></i>
        Kembali ke <?= esc($p['nama_fakultas']) ?>
    </a>
</div>

<script>
function switchPdTab(id, el) {
    event.preventDefault();
    document.querySelectorAll('.pd-pane').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.pd-tab-link').forEach(t => t.classList.remove('active'));
    document.getElementById('pane-' + id).classList.add('active');
    el.classList.add('active');
}
</script>

<?= $this->endSection() ?>