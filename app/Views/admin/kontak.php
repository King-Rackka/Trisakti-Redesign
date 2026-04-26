<?= $this->extend('layout/admin') ?>
<?= $this->section('styles') ?>
<style>
    .page-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;}
    .page-header h2{font-size:16px;font-weight:600;color:var(--text-dark);}
    .kontak-grid{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
    .form-card{background:#fff;border-radius:8px;border:1px solid var(--gray-mid);padding:24px;margin-bottom:20px;}
    .form-card h3{font-size:14px;font-weight:600;color:var(--navy);margin-bottom:16px;padding-bottom:10px;border-bottom:1px solid var(--gray-mid);}
    .form-group{margin-bottom:14px;}
    .form-group label{display:block;font-size:12px;font-weight:600;color:var(--gray-text);text-transform:uppercase;letter-spacing:0.5px;margin-bottom:5px;}
    .form-group input{width:100%;padding:9px 12px;border:1px solid var(--gray-mid);border-radius:6px;font-size:13px;font-family:'Inter',sans-serif;color:var(--text-dark);background:#fff;outline:none;transition:border-color 0.2s;}
    .form-group input:focus{border-color:var(--blue-mid);box-shadow:0 0 0 3px rgba(35,81,164,0.07);}
    .form-group textarea{width:100%;padding:9px 12px;border:1px solid var(--gray-mid);border-radius:6px;font-size:13px;font-family:'Inter',sans-serif;color:var(--text-dark);resize:vertical;min-height:80px;outline:none;transition:border-color 0.2s;}
    .form-group textarea:focus{border-color:var(--blue-mid);}
    .form-hint{font-size:11px;color:var(--gray-text);margin-top:3px;}
    .form-actions{display:flex;justify-content:flex-end;padding-top:16px;border-top:1px solid var(--gray-mid);margin-top:4px;}
    .btn-submit{background:var(--navy);color:#fff;font-size:13px;font-weight:600;padding:9px 24px;border-radius:6px;border:none;cursor:pointer;transition:background 0.2s;}
    .btn-submit:hover{background:var(--blue-mid);}
    .sosmed-icon{display:inline-flex;align-items:center;gap:6px;font-size:12px;color:var(--gray-text);margin-bottom:5px;}
    .sosmed-icon i{width:16px;}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="page-header">
    <h2>Kelola Kontak</h2>
</div>

<form action="<?= base_url('admin/kontak/update') ?>" method="POST">
    <?= csrf_field() ?>

    <div class="kontak-grid">
        <!-- Informasi Kontak -->
        <div class="form-card">
            <h3>Informasi Kontak</h3>
            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat"><?= esc((string)($kontak['alamat'] ?? '')) ?></textarea>
            </div>
            <div class="form-group">
                <label>Telepon</label>
                <input type="text" name="telepon" value="<?= esc((string)($kontak['telepon'] ?? '')) ?>">
            </div>
            <div class="form-group">
                <label>WhatsApp</label>
                <input type="text" name="whatsapp" value="<?= esc((string)($kontak['whatsapp'] ?? '')) ?>">
                <div class="form-hint">Format: +62 8xx xxxx xxxx</div>
            </div>
            <div class="form-group">
                <label>Fax</label>
                <input type="text" name="fax" value="<?= esc((string)($kontak['fax'] ?? '')) ?>">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" value="<?= esc((string)($kontak['email'] ?? '')) ?>">
            </div>
        </div>

        <!-- Media Sosial -->
        <div class="form-card">
            <h3>Media Sosial</h3>
            <div class="form-group">
                <div class="sosmed-icon"><i class="fab fa-facebook-f" style="color:#1877f2"></i> Facebook</div>
                <input type="text" name="facebook" value="<?= esc((string)($kontak['facebook'] ?? '')) ?>" placeholder="https://facebook.com/...">
            </div>
            <div class="form-group">
                <div class="sosmed-icon"><i class="fab fa-instagram" style="color:#e1306c"></i> Instagram</div>
                <input type="text" name="instagram" value="<?= esc((string)($kontak['instagram'] ?? '')) ?>" placeholder="https://instagram.com/...">
            </div>
            <div class="form-group">
                <div class="sosmed-icon"><i class="fab fa-x-twitter"></i> Twitter / X</div>
                <input type="text" name="twitter" value="<?= esc((string)($kontak['twitter'] ?? '')) ?>" placeholder="https://x.com/...">
            </div>
            <div class="form-group">
                <div class="sosmed-icon"><i class="fab fa-youtube" style="color:#ff0000"></i> YouTube</div>
                <input type="text" name="youtube" value="<?= esc((string)($kontak['youtube'] ?? '')) ?>" placeholder="https://youtube.com/...">
            </div>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn-submit">Simpan Semua Kontak</button>
    </div>

</form>

<?= $this->endSection() ?>