<?= $this->extend('layout/admin') ?>
<?= $this->section('styles') ?>
<style>
    .page-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;}
    .page-header h2{font-size:16px;font-weight:600;color:var(--text-dark);}
    .btn-tambah{background:var(--navy);color:#fff;font-size:13px;font-weight:500;padding:8px 18px;border-radius:6px;text-decoration:none;transition:background 0.2s;}
    .btn-tambah:hover{background:var(--blue-mid);}
    .table-card{background:#fff;border-radius:8px;border:1px solid var(--gray-mid);overflow:hidden;}
    table{width:100%;border-collapse:collapse;font-size:13px;}
    thead th{background:var(--gray-light);padding:11px 16px;text-align:left;font-size:11px;font-weight:600;color:var(--gray-text);text-transform:uppercase;letter-spacing:0.5px;border-bottom:1px solid var(--gray-mid);}
    tbody tr{border-bottom:1px solid var(--gray-mid);transition:background 0.1s;}
    tbody tr:last-child{border-bottom:none;}
    tbody tr:hover{background:var(--gray-light);}
    tbody td{padding:12px 16px;color:var(--text-dark);vertical-align:middle;}
    .td-foto{width:48px;height:48px;border-radius:50%;overflow:hidden;background:var(--gray-mid);flex-shrink:0;}
    .td-foto img{width:100%;height:100%;object-fit:cover;display:block;}
    .td-foto-placeholder{width:48px;height:48px;border-radius:50%;background:var(--navy);display:flex;align-items:center;justify-content:center;font-size:16px;color:#fff;font-weight:600;}
    .td-nama{font-weight:500;}
    .td-actions{display:flex;gap:8px;}
    .btn-edit{font-size:12px;padding:5px 12px;border-radius:4px;border:1px solid var(--blue-mid);color:var(--blue-mid);background:#fff;text-decoration:none;transition:all 0.15s;}
    .btn-edit:hover{background:var(--blue-mid);color:#fff;}
    .btn-hapus{font-size:12px;padding:5px 12px;border-radius:4px;border:1px solid #e53e3e;color:#e53e3e;background:#fff;text-decoration:none;transition:all 0.15s;}
    .btn-hapus:hover{background:#e53e3e;color:#fff;}
    .empty-state{text-align:center;padding:48px 24px;color:var(--gray-text);font-size:13px;}
    .badge{display:inline-block;font-size:11px;padding:3px 8px;border-radius:20px;font-weight:500;}
    .badge-navy{background:#e4e9f2;color:var(--navy);}
    .pagination-wrap{display:flex;justify-content:center;align-items:center;gap:6px;padding:16px;}
    .pg-btn{width:34px;height:34px;border-radius:50%;border:1px solid var(--gray-mid);display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:500;color:var(--navy);text-decoration:none;transition:all 0.15s;}
    .pg-btn:hover{background:var(--gray-light);}
    .pg-btn.active{background:var(--navy);color:#fff;border-color:var(--navy);}
    .pg-btn.disabled{border:none;color:var(--gray-text);pointer-events:none;}
    .pg-btn.arrow{font-size:16px;color:var(--gray-text);}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php
$curPage = isset($pager) ? $pager->getCurrentPage('alumni') : 1;
$totalPages = isset($pager) ? $pager->getPageCount('alumni')   : 1;
$prevUrl = isset($pager) ? $pager->getPreviousPageURI('alumni') : null;
$nextUrl = isset($pager) ? $pager->getNextPageURI('alumni')     : null;
$offset = ($curPage - 1) * $perPage;
?>

<div class="page-header">
    <h2>Daftar Alumni</h2>
    <a href="<?= base_url('admin/alumni/tambah') ?>" class="btn-tambah">+ Tambah Alumni</a>
</div>

<div class="table-card">
    <table>
        <thead>
            <tr>
                <th style="width:40px">No</th>
                <th style="width:60px">Foto</th>
                <th>Nama</th>
                <th>Jurusan</th>
                <th>Angkatan</th>
                <th style="width:140px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($alumni)): ?>
                <?php foreach ($alumni as $i => $item): ?>
                <tr>
                    <td><?= $offset + $i + 1 ?></td>
                    <td>
                        <?php if (!empty($item['foto_profil'])): ?>
                            <img class="td-foto" src="<?= base_url('assets/alumni/' . $item['foto_profil']) ?>" alt="<?= esc($item['nama']) ?>">
                        <?php else: ?>
                            <div class="td-foto-placeholder"><?= strtoupper(substr($item['nama'], 0, 1)) ?></div>
                        <?php endif; ?>
                    </td>
                    <td class="td-nama"><?= esc($item['nama']) ?></td>
                    <td><?= esc($item['jurusan']) ?></td>
                    <td><span class="badge badge-navy"><?= esc($item['angkatan']) ?></span></td>
                    <td class="td-actions">
                        <a href="<?= base_url('admin/alumni/edit/' . $item['id']) ?>" class="btn-edit">Edit</a>
                        <a href="<?= base_url('admin/alumni/hapus/' . $item['id']) ?>"
                           class="btn-hapus"
                           onclick="return confirm('Yakin hapus alumni ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">
                        <div class="empty-state">Belum ada data alumni. <a href="<?= base_url('admin/alumni/tambah') ?>">Tambah sekarang</a></div>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if ($totalPages > 1): ?>
    <div class="pagination-wrap">

        <?php if ($prevUrl): ?>
            <a href="<?= site_url('admin/alumni?page_alumni=' . ($curPage - 1)) ?>" class="pg-btn arrow">&#8249;</a>
        <?php else: ?>
            <span class="pg-btn arrow disabled">&#8249;</span>
        <?php endif; ?>

        <?php for ($p = 1; $p <= $totalPages; $p++): ?>
            <?php if ($p === $curPage): ?>
                <span class="pg-btn active"><?= $p ?></span>
            <?php elseif ($p === 1 || $p === $totalPages || abs($p - $curPage) <= 1): ?>
                <a href="<?= site_url('admin/alumni?page_alumni=' . $p) ?>" class="pg-btn"><?= $p ?></a>
            <?php elseif (abs($p - $curPage) === 2): ?>
                <span class="pg-btn disabled">…</span>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if ($nextUrl): ?>
            <a href="<?= site_url('admin/alumni?page_alumni=' . ($curPage + 1)) ?>" class="pg-btn arrow">&#8250;</a>
        <?php else: ?>
            <span class="pg-btn arrow disabled">&#8250;</span>
        <?php endif; ?>

    </div>
    <?php endif; ?>

</div>

<?= $this->endSection() ?>