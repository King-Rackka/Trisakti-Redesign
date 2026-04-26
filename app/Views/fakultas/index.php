<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<?php
$fak   = $fakultas;
$warna = $fak['warna'] ?? '#1a3a6b';

function ytbEmbed(string $url): ?string {
    preg_match('/(?:youtu\.be\/|[?&]v=|embed\/)([a-zA-Z0-9_-]{11})/', $url, $m);
    if (!isset($m[1])) return null;
    $id = $m[1];
    return "https://www.youtube.com/embed/{$id}?autoplay=1&mute=1&loop=1&playlist={$id}&controls=0&playsinline=1";
}
?>

<style>
.fd-hero {
    position: relative;
    width: 100%;
    aspect-ratio: 16 / 9; 
    overflow: hidden;
    background: <?= esc($warna) ?>;
}

.fd-hero iframe,
.fd-hero img {
    width: 100%;
    height: 100%;
    object-fit: contain; 
    background: black; 
}
.fd-hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top,
        rgba(5, 15, 40, .92) 0%,
        rgba(5, 15, 40, .55) 50%,
        rgba(5, 15, 40, .2)  100%);
    display: flex;
    align-items: flex-end;
    padding: 0 0 2.5rem 2rem;
}
.fd-hero-inner { max-width: 860px; }

.fd-bread {
    display: flex;
    gap: 6px;
    align-items: center;
    font-size: 12px;
    margin-bottom: 12px;
}
.fd-bread a { color: rgba(255,255,255,.5); text-decoration: none; }
.fd-bread a:hover { color: #fff; }
.fd-bread .sep { color: rgba(255,255,255,.25); }
.fd-bread .cur { color: rgba(255,255,255,.85); }

.fd-hero-title {
    color: #fff;
    font-size: 32px;
    font-weight: 700;
    margin: 0 0 18px;
    line-height: 1.3;
}

.fd-stats {
    display: flex;
    align-items: center;
    gap: 0;
    flex-wrap: wrap;
}
.fd-stat {
    text-align: center;
    padding: 0 24px;
    border-right: 1px solid rgba(255,255,255,.15);
}
.fd-stat:first-child { padding-left: 0; }
.fd-stat:last-child  { border-right: none; }
.fd-stat-num {
    display: block;
    font-size: 22px;
    font-weight: 700;
    color: <?= esc($warna) ?>;
    filter: brightness(1.8) saturate(.7);
}
.fd-stat-label { font-size: 11px; color: rgba(255,255,255,.6); }

.fd-tabnav {
    background: #fff;
    border-bottom: 1px solid #e5e7eb;
    position: sticky;
    top: 64px;
    z-index: 200;
    padding: 0 2rem;
}
.fd-tabs {
    display: flex;
    gap: 0;
    list-style: none;
    margin: 0;
    padding: 0;
}
.fd-tab-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 14px 20px;
    font-size: 14px;
    color: #6b7280;
    text-decoration: none;
    border-bottom: 2px solid transparent;
    transition: color .15s, border-color .15s;
    white-space: nowrap;
    cursor: pointer;
}
.fd-tab-link:hover { color: #1f2937; }
.fd-tab-link.active {
    color: <?= esc($warna) ?>;
    border-bottom-color: <?= esc($warna) ?>;
    font-weight: 600;
}
.fd-tab-badge {
    background: #f3f4f6;
    color: #6b7280;
    font-size: 11px;
    font-weight: 600;
    padding: 1px 7px;
    border-radius: 20px;
}
.fd-tab-link.active .fd-tab-badge {
    background: <?= esc($warna) ?>22;
    color: <?= esc($warna) ?>;
}


.fd-content {
    max-width: 900px;
    margin: 0 auto;
    padding: 2.5rem 1.5rem;
}
.fd-pane { display: none; }
.fd-pane.active { display: block; }

.fd-prose-card {
    display: flex;
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    overflow: hidden;
    max-width: 1000px;
}
.fd-prose-stripe {
    width: 4px;
    background: <?= esc($warna) ?>;
    flex-shrink: 0;
}
.fd-prose-body {
    padding: 1.5rem 1.5rem 1.5rem 1.25rem;
    flex: 1;
}
.fd-prose-heading {
    font-size: 17px;
    font-weight: 600;
    color: #1f2937;
    margin: 0 0 14px;
}
.fd-prose-text {
    font-size: 14px;
    color: #374151;
    line-height: 1.85;
    margin: 0;
}
.fd-dekan-wrap {
    display: flex;
    gap: 2rem;
    align-items: flex-start;
    flex-wrap: wrap;
}
.fd-dekan-foto-col { flex-shrink: 0; text-align: center; }
.fd-dekan-foto {
    width: 148px;
    height: 188px;
    object-fit: cover;
    border-radius: 10px;
    border: 3px solid <?= esc($warna) ?>;
    display: block;
    margin: 0 auto 10px;
}
.fd-dekan-foto-ph {
    width: 148px;
    height: 188px;
    border-radius: 10px;
    border: 3px solid <?= esc($warna) ?>;
    background: #f3f4f6;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 48px;
    color: #d1d5db;
    margin: 0 auto 10px;
}
.fd-dekan-nama {
    font-size: 13px;
    font-weight: 600;
    color: #1f2937;
    margin: 0 0 3px;
}
.fd-dekan-jabatan {
    font-size: 12px;
    color: #9ca3af;
    margin: 0;
}
.fd-dekan-kanan { flex: 1; min-width: 260px; }

.fd-prodi-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 14px;
}

.fd-prodi-card {
    display: flex;
    align-items: center;
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    overflow: hidden;
    text-decoration: none;
    transition: all .18s ease;
}

.fd-prodi-card:hover {
    transform: translateX(4px);
    box-shadow: 0 10px 24px rgba(0,0,0,.08);
    border-color: var(--prodi);
}

.fd-prodi-strip {
    width: 4px;
    background: var(--prodi);
    align-self: stretch;
    flex-shrink: 0;
}

.fd-prodi-content {
    padding: 14px 16px;
}

.fd-prodi-jenjang {
    font-size: 11px;
    font-weight: 700;
    color: var(--prodi);
    text-transform: uppercase;
    letter-spacing: .5px;
}

.fd-prodi-nama {
    font-size: 14px;
    font-weight: 600;
    color: #1f2937;
    margin: 4px 0 0;
}

.fd-prodi-card:hover .fd-prodi-nama {
    color: var(--prodi);
}

.fd-empty {
    text-align: center;
    padding: 3rem 1rem;
    color: #9ca3af;
    font-size: 14px;
}

.breadcrumb-bar{background:#eef2f9;padding:14px 0;border-bottom:1px solid #dde4f0;}
    .breadcrumb-inner{max-width:1280px;margin:0 auto;padding:0 24px;display:flex;justify-content:space-between;align-items:center;}
    .breadcrumb-title{font-size:20px;font-weight:600;color:var(--navy);}
    .breadcrumb-path{font-size:12px;color:var(--gray-text);}
    .breadcrumb-path a{color:var(--gray-text);text-decoration:none;}
    .breadcrumb-path span{color:var(--navy);font-weight:500;}

</style>

<div class="breadcrumb-bar">
    <div class="breadcrumb-inner">
        <div class="breadcrumb-title"><?= esc($fak['nama']) ?></div>
        <div class="breadcrumb-path">
            <a href="<?= base_url('/') ?>">Beranda</a> &gt; <span><?= esc($fak['nama']) ?></span>
        </div>
    </div>
</div>

<div class="fd-hero">
    <?php if ($fak['bg_tipe'] === 'youtube' && !empty($fak['bg_value'])) :
        $embed = ytbEmbed($fak['bg_value']); ?>
        <?php if ($embed) : ?>
            <iframe src="<?= $embed ?>" allow="autoplay; fullscreen" allowfullscreen></iframe>
        <?php endif; ?>
    <?php elseif ($fak['bg_tipe'] === 'image' && !empty($fak['bg_value'])) : ?>
        <img src="<?= base_url('assets/fakultas/' . $fak['bg_value']) ?>" alt="<?= esc($fak['nama']) ?>">
    <?php endif; ?>

    <div class="fd-hero-overlay">
        <div class="fd-hero-inner">

            <h1 class="fd-hero-title"><?= esc($fak['nama']) ?></h1>

            <div class="fd-stats">
                <div class="fd-stat">
                    <span class="fd-stat-num"><?= number_format($fak['jmlh_mahasiswa']) ?></span>
                    <span class="fd-stat-label">Mahasiswa</span>
                </div>
                <div class="fd-stat">
                    <span class="fd-stat-num"><?= number_format($fak['jmlh_guru_besar']) ?></span>
                    <span class="fd-stat-label">Guru Besar</span>
                </div>
                <div class="fd-stat">
                    <span class="fd-stat-num"><?= number_format($fak['jmlh_doktor']) ?></span>
                    <span class="fd-stat-label">Doktor</span>
                </div>
                <div class="fd-stat">
                    <span class="fd-stat-num"><?= number_format($fak['jmlh_pengajar']) ?></span>
                    <span class="fd-stat-label">Pengajar</span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$tabs = [];
if (!empty($fak['sejarah_singkat'])) $tabs[] = ['id'=>'sejarah',  'label'=>'Sejarah'];
if (!empty($fak['nama_dekan']) || !empty($fak['sambutan_dekan'])) $tabs[] = ['id'=>'dekan',    'label'=>'Sambutan Dekan'];
$tabs[] = ['id'=>'prodi', 'label'=>'Program Studi', 'count' => count($fak['prodi'] ?? [])];
?>
<div class="fd-tabnav">
    <div class="fd-tabs">
        <?php foreach ($tabs as $i => $tab) : ?>
        <a class="fd-tab-link <?= $i === 0 ? 'active' : '' ?>"
           onclick="switchTab('<?= $tab['id'] ?>', this)" href="#">
            <?= $tab['label'] ?>
            <?php if (!empty($tab['count'])) : ?>
            <span class="fd-tab-badge"><?= $tab['count'] ?></span>
            <?php endif; ?>
        </a>
        <?php endforeach; ?>
    </div>
</div>

<div class="fd-content">

    <?php if (!empty($fak['sejarah_singkat'])) : ?>
    <div class="fd-pane active" id="pane-sejarah">
        <div class="fd-prose-card">
            <div class="fd-prose-stripe"></div>
            <div class="fd-prose-body">
                <h2 class="fd-prose-heading">Sejarah Singkat</h2>
                <p class="fd-prose-text"><?= nl2br(esc((string)($fak['sejarah_singkat']))) ?></p>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if (!empty($fak['nama_dekan']) || !empty($fak['sambutan_dekan'])) :
        $firstPane = empty($fak['sejarah_singkat']); ?>
    <div class="fd-pane <?= $firstPane ? 'active' : '' ?>" id="pane-dekan">
        <div class="fd-dekan-wrap">
            <div class="fd-dekan-foto-col">
                <?php if (!empty($fak['foto_dekan'])) : ?>
                    <img class="fd-dekan-foto"
                         src="<?= base_url('assets/dekan/' . $fak['foto_dekan']) ?>"
                         alt="<?= esc($fak['nama_dekan'] ?? 'Dekan') ?>">
                <?php else : ?>
                    <div class="fd-dekan-foto-ph">
                        <i class="bi bi-person-fill"></i>
                    </div>
                <?php endif; ?>
                <?php if (!empty($fak['nama_dekan'])) : ?>
                    <p class="fd-dekan-nama"><?= esc($fak['nama_dekan']) ?></p>
                    <p class="fd-dekan-jabatan">Dekan <?= esc($fak['nama']) ?></p>
                <?php endif; ?>
            </div>
            <div class="fd-dekan-kanan">
                <div class="fd-prose-card">
                    <div class="fd-prose-stripe"></div>
                    <div class="fd-prose-body">
                        <h2 class="fd-prose-heading">Sambutan Dekan</h2>
                        <?php if (!empty($fak['sambutan_dekan'])) : ?>
                            <p class="fd-prose-text"><?= nl2br(esc((string)($fak['sambutan_dekan']))) ?></p>
                        <?php else : ?>
                            <p class="fd-prose-text" style="color:#9ca3af;">Sambutan belum tersedia.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php
    $prodiFirst = empty($fak['sejarah_singkat'])
               && empty($fak['nama_dekan'])
               && empty($fak['sambutan_dekan']);
    ?>
    <div class="fd-pane <?= $prodiFirst ? 'active' : '' ?>" id="pane-prodi">
    <?php if (!empty($fak['prodi'])) : ?>
    <div class="fd-prodi-grid">
        <?php foreach ($fak['prodi'] as $p) : 
            $warnaProdi = $p['warna'] ?? $warna; 
        ?>
        <a href="<?= base_url('fakultas/' . $fak['slug'] . '/' . $p['slug']) ?>"
           class="fd-prodi-card"
           style="--prodi: <?= esc($warnaProdi) ?>;">

            <span class="fd-prodi-strip"></span>

            <div class="fd-prodi-content">
                <span class="fd-prodi-jenjang"><?= esc($p['jenjang']) ?></span>
                <h3 class="fd-prodi-nama"><?= esc($p['nama']) ?></h3>
            </div>

        </a>
        <?php endforeach; ?>
    </div>
    <?php else : ?>
    <div class="fd-empty">Belum ada program studi yang terdaftar.</div>
    <?php endif; ?>
</div>

</div>

<script>
function switchTab(id, el) {
    event.preventDefault();
    document.querySelectorAll('.fd-pane').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.fd-tab-link').forEach(t => t.classList.remove('active'));
    document.getElementById('pane-' + id).classList.add('active');
    el.classList.add('active');
}
</script>

<?= $this->endSection() ?>