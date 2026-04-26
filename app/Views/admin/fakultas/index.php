<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>

<style>
.page-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;}
    .page-header h2{font-size:16px;font-weight:600;color:var(--text-dark);}
.page-title { font-size:22px; font-weight:600; color:#1a2e5a; margin-bottom:4px; }
.page-sub { font-size:13px; color:#888; }

.tab-nav { display:flex; gap:4px; margin-bottom:24px; border-bottom:2px solid #e8edf5; }
.tab-btn { display:flex; align-items:center; gap:8px; padding:10px 20px; font-size:13.5px; font-weight:500; color:#666; text-decoration:none; border-bottom:2px solid transparent; margin-bottom:-2px; transition:all 0.2s; }
.tab-btn:hover { color:#1a2e5a; }
.tab-btn.active { color:#1a2e5a; border-bottom-color:#1a2e5a; }
.tab-count { background:#e8edf5; color:#666; font-size:11px; padding:2px 7px; border-radius:10px; }
.tab-btn.active .tab-count { background:#1a2e5a; color:#fff; }

.tab-panel { display:none; }
.tab-panel.active { display:block; }

.panel-toolbar { display:flex; justify-content:space-between; align-items:center; margin-bottom:16px; }
.panel-info { font-size:13px; color:#888; }

.alert { padding:12px 16px; border-radius:6px; margin-bottom:16px; font-size:13px; }
.alert-success { background:#e8f5e9; color:#2d7a2d; border:1px solid #c8e6c9; }
.alert-error { background:#ffebee; color:#c62828; border:1px solid #ffcdd2; }

.btn-primary { display:inline-flex; align-items:center; gap:7px; background:#1a2e5a; color:#fff; padding:9px 18px; border-radius:6px; font-size:13px; font-weight:500; text-decoration:none; transition:background 0.2s; }
.btn-primary:hover { background:#2351a4; }

/* Fakultas grid cards */
.fak-grid { display:grid; grid-template-columns:repeat(auto-fill, minmax(280px, 1fr)); gap:16px; }
.fak-card { background:#fff; border:1px solid #e8edf5; border-radius:10px; overflow:hidden; position:relative; transition:box-shadow 0.2s; }
.fak-card:hover { box-shadow:0 4px 16px rgba(26,46,90,0.1); }
.fak-card-accent { height:4px; }
.fak-card-body { padding:16px; }
.fak-card-top { display:flex; align-items:flex-start; gap:10px; margin-bottom:12px; }
.fak-dot { width:10px; height:10px; border-radius:50%; flex-shrink:0; margin-top:4px; }
.fak-card-name { font-size:14px; font-weight:600; color:#1a2e5a; line-height:1.4; }
.fak-stats { display:flex; gap:0; border-top:1px solid #f0f4fb; border-bottom:1px solid #f0f4fb; padding:10px 0; margin-bottom:10px; }
.fak-stat { flex:1; text-align:center; border-right:1px solid #f0f4fb; }
.fak-stat:last-child { border-right:none; }
.fak-stat-num { display:block; font-size:16px; font-weight:700; color:#1a2e5a; }
.fak-stat-lbl { font-size:10px; color:#999; text-transform:uppercase; letter-spacing:0.5px; }
.fak-dekan { display:flex; align-items:center; gap:6px; font-size:11.5px; color:#666; }
.fak-card-actions { display:flex; gap:0; border-top:1px solid #f0f4fb; }
.act-btn { flex:1; display:flex; align-items:center; justify-content:center; padding:9px; font-size:13px; text-decoration:none; transition:background 0.15s; }
.act-btn.edit { color:#2351a4; }
.act-btn.edit:hover { background:#f0f4ff; }
.act-btn.hapus { color:#e53935; border-left:1px solid #f0f4fb; }
.act-btn.hapus:hover { background:#fff5f5; }

/* Prodi table */
.table-wrap { background:#fff; border:1px solid #e8edf5; border-radius:10px; overflow:hidden; }
.data-table { width:100%; border-collapse:collapse; font-size:13px; }
.data-table thead th { background:#f7f9ff; padding:11px 14px; text-align:left; font-size:11px; font-weight:600; text-transform:uppercase; letter-spacing:0.6px; color:#666; border-bottom:1px solid #e8edf5; }
.data-table tbody tr { border-bottom:1px solid #f0f4fb; transition:background 0.15s; }
.data-table tbody tr:last-child { border-bottom:none; }
.data-table tbody tr:hover { background:#fafbff; }
.data-table td { padding:12px 14px; vertical-align:middle; }
.num-col { color:#bbb; font-size:12px; text-align:center; }
.empty-row { text-align:center; padding:40px; color:#bbb; }

.fak-badge { font-size:11px; font-weight:500; padding:3px 10px; border-radius:20px; border:1px solid; white-space:nowrap; }
.jenjang-badge { font-size:11px; font-weight:600; padding:3px 8px; border-radius:4px; }
.jenjang-s1 { background:#e3f2fd; color:#1565c0; }
.jenjang-s2 { background:#e8f5e9; color:#2e7d32; }
.jenjang-s3 { background:#f3e5f5; color:#6a1b9a; }
.jenjang-d3 { background:#fff3e0; color:#e65100; }
.jenjang-profesi { background:#fce4ec; color:#880e4f; }
.jejang-spesialis { background:#ede7f6; color:#4527a0; }
.bg-badge { display:inline-flex; align-items:center; gap:4px; font-size:11px; padding:3px 8px; border-radius:4px; }
.bg-yt { background:#fff3e0; color:#d84315; }
.bg-img { background:#e8f5e9; color:#2e7d32; }
.action-btns { display:flex; gap:4px; }

.empty-state { text-align:center; padding:48px 24px; color:#bbb; }
.empty-state i { font-size:36px; margin-bottom:12px; display:block; }
.empty-state p { margin-bottom:16px; font-size:14px; }

.btn-edit{font-size:12px;padding:5px 12px;border-radius:4px;border:1px solid var(--blue-mid);color:var(--blue-mid);background:#fff;text-decoration:none;transition:all 0.15s;}
    .btn-edit:hover{background:var(--blue-mid);color:#fff;}
    .btn-hapus{font-size:12px;padding:5px 12px;border-radius:4px;border:1px solid #e53e3e;color:#e53e3e;background:#fff;text-decoration:none;transition:all 0.15s;}
    .btn-hapus:hover{background:#e53e3e;color:#fff;}

</style>

<div class="page-header">
    <h2>Struktur Organisasi</h2>
</div>

<div class="tab-nav">
    <a href="?tab=fakultas" class="tab-btn <?= $activeTab === 'fakultas' ? 'active' : '' ?>">
        Fakultas
        <span class="tab-count"><?= count($fakultas) ?></span>
    </a>
    <a href="?tab=prodi" class="tab-btn <?= $activeTab === 'prodi' ? 'active' : '' ?>">
        Program Studi
        <span class="tab-count"><?= count($prodi) ?></span>
    </a>
</div>

<div class="tab-panel <?= $activeTab === 'fakultas' ? 'active' : '' ?>">
    <div class="panel-toolbar">
        <span class="panel-info"><?= count($fakultas) ?> fakultas terdaftar</span>
        <a href="<?= base_url('admin/fakultas/tambah') ?>" class="btn-primary">
            <i class="fas fa-plus"></i> Tambah Fakultas
        </a>
    </div>

    <div class="fak-grid">
        <?php foreach ($fakultas as $fak): ?>
        <div class="fak-card">
            <div class="fak-card-accent" style="background:<?= esc($fak['warna']) ?>"></div>
            <div class="fak-card-body">
                <div class="fak-card-top">
                    <div class="fak-dot" style="background:<?= esc($fak['warna']) ?>"></div>
                    <div class="fak-card-name"><?= esc($fak['nama']) ?></div>
                </div>
                <div class="fak-stats">
                    <div class="fak-stat">
                        <span class="fak-stat-num"><?= $fak['jmlh_prodi'] ?? 0 ?></span>
                        <span class="fak-stat-lbl">Prodi</span>
                    </div>
                    <div class="fak-stat">
                        <span class="fak-stat-num"><?= number_format($fak['jmlh_mahasiswa']) ?></span>
                        <span class="fak-stat-lbl">Mahasiswa</span>
                    </div>
                    <div class="fak-stat">
                        <span class="fak-stat-num"><?= $fak['jmlh_pengajar'] ?></span>
                        <span class="fak-stat-lbl">Pengajar</span>
                    </div>
                </div>
                <?php if ($fak['nama_dekan']): ?>
                <div class="fak-dekan">
                    <i class="fas fa-user-tie" style="font-size:11px;color:#888"></i>
                    <span><?= esc($fak['nama_dekan']) ?></span>
                </div>
                <?php endif; ?>
            </div>
            <div class="fak-card-actions">
                <a href="<?= base_url('admin/fakultas/edit/' . $fak['id']) ?>" class="act-btn edit" title="Edit">
                    <i class="fas fa-pen"></i> <h4 style="padding-left: 10px;">Edit</h4>
                </a>
                <a href="<?= base_url('admin/fakultas/hapus/' . $fak['id']) ?>"
                   class="act-btn hapus" title="Hapus"
                   onclick="return confirm('Hapus fakultas ini beserta semua prodinya?')">
                    <i class="fas fa-trash"></i> <h4 style="padding-left: 10px;">Hapus</h4>
                </a>
            </div>
        </div>
        <?php endforeach; ?>

        <?php if (empty($fakultas)): ?>
        <div class="empty-state" style="grid-column:1/-1">
            <i class="fas fa-university"></i>
            <p>Belum ada data fakultas</p>
            <a href="<?= base_url('admin/fakultas/tambah') ?>" class="btn-primary">Tambah Sekarang</a>
        </div>
        <?php endif; ?>
    </div>
</div>

<div class="tab-panel <?= $activeTab === 'prodi' ? 'active' : '' ?>">
    <div class="panel-toolbar">
        <span class="panel-info"><?= count($prodi) ?> program studi terdaftar</span>
        <a href="<?= base_url('admin/prodi/tambah') ?>" class="btn-primary">
            <i class="fas fa-plus"></i> Tambah Prodi
        </a>
    </div>

    <div class="table-wrap">
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width:40px">#</th>
                    <th>Nama Program Studi</th>
                    <th>Fakultas</th>
                    <th style="width:80px">Jenjang</th>
                    <th style="width:100px">Background</th>
                    <th style="width:100px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($prodi)): ?>
                <tr><td colspan="6" class="empty-row">Belum ada data program studi</td></tr>
                <?php else: ?>
                <?php foreach ($prodi as $i => $p): ?>
                <tr>
                    <td class="num-col"><?= $i + 1 ?></td>
                    <td>
                        <div style="font-weight:500;color:#1a2e5a"><?= esc($p['nama']) ?></div>
                        <div style="font-size:11px;color:#999">/<?= esc($p['slug']) ?></div>
                    </td>
                    <td>
                        <span class="fak-badge" style="background:<?= esc($p['warna']) ?>22;color:<?= esc($p['warna']) ?>;border-color:<?= esc($p['warna']) ?>44">
                            <?= esc($p['nama_fakultas']) ?>
                        </span>
                    </td>
                    <td>
                        <span class="jenjang-badge jenjang-<?= strtolower($p['jenjang']) ?>"><?= $p['jenjang'] ?></span>
                    </td>
                    <td>
                        <span class="bg-badge <?= $p['bg_tipe'] === 'youtube' ? 'bg-yt' : 'bg-img' ?>">
                            <i class="fas fa-<?= $p['bg_tipe'] === 'youtube' ? 'play-circle' : 'image' ?>"></i>
                            <?= $p['bg_tipe'] === 'youtube' ? 'YouTube' : 'Gambar' ?>
                        </span>
                    </td>
                    <td>
                        <div class="action-btns">
                            <a href="<?= base_url('admin/prodi/edit/' . $p['id']) ?>" class="btn-edit" title="Edit">
                               Edit
                            </a>
                            <a href="<?= base_url('admin/prodi/hapus/' . $p['id']) ?>"
                               class="btn-hapus" title="Hapus"
                               onclick="return confirm('Hapus prodi ini?')">
                                Hapus
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>