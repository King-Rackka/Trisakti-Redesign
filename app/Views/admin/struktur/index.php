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
    .td-jabatan{font-weight:500;}
    .td-actions{display:flex;gap:8px;}
    .btn-edit{font-size:12px;padding:5px 12px;border-radius:4px;border:1px solid var(--blue-mid);color:var(--blue-mid);background:#fff;text-decoration:none;transition:all 0.15s;}
    .btn-edit:hover{background:var(--blue-mid);color:#fff;}
    .btn-hapus{font-size:12px;padding:5px 12px;border-radius:4px;border:1px solid #e53e3e;color:#e53e3e;background:#fff;text-decoration:none;transition:all 0.15s;}
    .btn-hapus:hover{background:#e53e3e;color:#fff;}
    .empty-state{text-align:center;padding:48px 24px;color:var(--gray-text);font-size:13px;}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="page-header">
    <h2>Struktur Organisasi</h2>
</div>

<div class="table-card">
    <table>
        <thead>
            <tr>
                <th style="width:40px">No</th>
                <th>Jabatan</th>
                <th>Nama</th>
                <th style="width:140px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($struktur)): ?>
                <?php foreach ($struktur as $i => $item): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td class="td-jabatan"><?= esc($item['jabatan']) ?></td>
                    <td><?= esc($item['nama']) ?></td>
                    <td class="td-actions">
                        <a href="<?= base_url('admin/struktur/edit/' . $item['id']) ?>" class="btn-edit">Edit</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4"><div class="empty-state">Belum ada data.</div></td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>