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
    .td-img{width:64px;height:46px;border-radius:4px;overflow:hidden;background:linear-gradient(135deg,var(--navy),var(--blue-mid));}
    .td-img img{width:100%;height:100%;object-fit:cover;display:block;}
    .td-judul{font-weight:500;max-width:380px;}
    .td-judul small{display:block;font-size:11px;font-weight:400;color:var(--gray-text);margin-top:2px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:380px;}
    .td-date{color:var(--gray-text);white-space:nowrap;font-size:12px;}
    .td-actions{display:flex;gap:8px;white-space:nowrap;}
    .btn-edit{font-size:12px;padding:5px 12px;border-radius:4px;border:1px solid var(--blue-mid);color:var(--blue-mid);background:#fff;text-decoration:none;transition:all 0.15s;}
    .btn-edit:hover{background:var(--blue-mid);color:#fff;}
    .btn-hapus{font-size:12px;padding:5px 12px;border-radius:4px;border:1px solid #e53e3e;color:#e53e3e;background:#fff;text-decoration:none;transition:all 0.15s;}
    .btn-hapus:hover{background:#e53e3e;color:#fff;}
    .empty-state{text-align:center;padding:48px 24px;color:var(--gray-text);font-size:13px;}
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
$curPage = isset($pager) ? $pager->getCurrentPage('berita') : 1;
$totalPages = isset($pager) ? $pager->getPageCount('berita')   : 1;
$prevUrl = isset($pager) ? $pager->getPreviousPageURI('berita') : null;
$nextUrl = isset($pager) ? $pager->getNextPageURI('berita')     : null;
$offset = ($curPage - 1) * $perPage;
?>

<div class="page-header">
    <h2>Daftar Berita</h2>
    <a href="<?= base_url('admin/berita/tambah') ?>" class="btn-tambah">+ Tambah Berita</a>
</div>

<div class="table-card">
    <table>
        <thead>
            <tr>
                <th style="width:40px">No</th>
                <th style="width:80px">Gambar</th>
                <th>Judul</th>
                <th>Tanggal</th>
                <th style="width:140px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($berita)): ?>
                <?php foreach ($berita as $i => $item): ?>
                <tr>
                    <td><?= $offset + $i + 1 ?></td>
                    <td>
                        <div class="td-img">
                            <?php if (!empty($item['gambar'])): ?>
                                <img src="<?= base_url('assets/news/' . $item['gambar']) ?>"
                                     alt="<?= esc($item['judul']) ?>">
                            <?php endif; ?>
                        </div>
                    </td>
                    <td class="td-judul">
                        <?= esc(character_limiter($item['judul'])) ?>
                        <small><?= esc($item['slug']) ?></small>
                    </td>
                    <td class="td-date"><?= date('d M Y', strtotime($item['tanggal'])) ?></td>
                    <td class="td-actions">
                        <a href="<?= base_url('admin/berita/edit/' . $item['id']) ?>" class="btn-edit">Edit</a>
                        <a href="<?= base_url('admin/berita/hapus/' . $item['id']) ?>"
                           class="btn-hapus"
                           onclick="return confirm('Yakin hapus berita ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">
                        <div class="empty-state">Belum ada berita. <a href="<?= base_url('admin/berita/tambah') ?>">Tambah sekarang</a></div>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if ($totalPages > 1): ?>
    <div class="pagination-wrap">

        <?php if ($prevUrl): ?>
            <a href="<?= site_url('admin/berita?page_berita=' . ($curPage - 1)) ?>" class="pg-btn arrow">&#8249;</a>
        <?php else: ?>
            <span class="pg-btn arrow disabled">&#8249;</span>
        <?php endif; ?>

        <?php for ($p = 1; $p <= $totalPages; $p++): ?>
            <?php if ($p === $curPage): ?>
                <span class="pg-btn active"><?= $p ?></span>
            <?php elseif ($p === 1 || $p === $totalPages || abs($p - $curPage) <= 1): ?>
                <a href="<?= site_url('admin/berita?page_berita=' . $p) ?>" class="pg-btn"><?= $p ?></a>
            <?php elseif (abs($p - $curPage) === 2): ?>
                <span class="pg-btn disabled">…</span>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if ($nextUrl): ?>
            <a href="<?= site_url('admin/berita?page_berita=' . ($curPage + 1)) ?>" class="pg-btn arrow">&#8250;</a>
        <?php else: ?>
            <span class="pg-btn arrow disabled">&#8250;</span>
        <?php endif; ?>

    </div>
    <?php endif; ?>

</div>

<?= $this->endSection() ?>