<?= $this->extend('layout/admin') ?>
<?= $this->section('styles') ?>
<style>
    .page-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;}
    .page-header h2{font-size:16px;font-weight:600;color:var(--text-dark);}
    .btn-back{font-size:12px;color:var(--gray-text);border:1px solid var(--gray-mid);background:#fff;padding:7px 14px;border-radius:5px;text-decoration:none;}
    .btn-back:hover{background:var(--gray-light);}
    .form-card{background:#fff;border-radius:8px;border:1px solid var(--gray-mid);padding:24px;}
    .form-group{margin-bottom:18px;}
    .form-group label{display:block;font-size:13px;font-weight:600;color:var(--text-dark);margin-bottom:6px;}
    .required{color:#e53e3e;margin-left:2px;}
    .form-group input{width:100%;padding:9px 12px;border:1px solid var(--gray-mid);border-radius:6px;font-size:13px;font-family:'Inter',sans-serif;color:var(--text-dark);background:#fff;outline:none;transition:border-color 0.2s;}
    .form-group input:focus{border-color:var(--blue-mid);box-shadow:0 0 0 3px rgba(35,81,164,0.07);}
    .form-actions{display:flex;gap:10px;justify-content:flex-end;padding-top:20px;border-top:1px solid var(--gray-mid);}
    .btn-submit{background:var(--navy);color:#fff;font-size:13px;font-weight:600;padding:9px 24px;border-radius:6px;border:none;cursor:pointer;}
    .btn-submit:hover{background:var(--blue-mid);}
    .btn-cancel{background:#fff;color:var(--gray-text);font-size:13px;padding:9px 18px;border-radius:6px;border:1px solid var(--gray-mid);text-decoration:none;}
    .btn-cancel:hover{background:var(--gray-light);}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="page-header">
    <h2><?= $struktur ? 'Edit Struktur' : 'Tambah Struktur' ?></h2>
    <a href="<?= base_url('admin/struktur') ?>" class="btn-back">← Kembali</a>
</div>

<div class="form-card">
    <form action="<?= $struktur
        ? base_url('admin/struktur/update/' . $struktur['id'])
        : base_url('admin/struktur/simpan') ?>"
          method="POST">
        <?= csrf_field() ?>

        <div class="form-group">
            <label>Jabatan <span class="required">*</span></label>
            <input type="text"
                   name="jabatan"
                   value="<?= old('jabatan', $struktur['jabatan'] ?? '') ?>"
                   placeholder="Contoh: Rektor"
                   required>
        </div>

        <div class="form-group">
            <label>Nama <span class="required">*</span></label>
            <input type="text"
                   name="nama"
                   value="<?= old('nama', $struktur['nama'] ?? '') ?>"
                   placeholder="Contoh: Prof. Dr. Ir. ..."
                   required>
        </div>

        <div class="form-actions">
            <a href="<?= base_url('admin/struktur') ?>" class="btn-cancel">Batal</a>
            <button type="submit" class="btn-submit">
                <?= $struktur ? 'Simpan Perubahan' : 'Simpan' ?>
            </button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>