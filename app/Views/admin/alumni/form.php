<?= $this->extend('layout/admin') ?>
<?= $this->section('styles') ?>
<style>
    .page-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;}
    .page-header h2{font-size:16px;font-weight:600;color:var(--text-dark);}
    .btn-back{font-size:12px;color:var(--gray-text);border:1px solid var(--gray-mid);background:#fff;padding:7px 14px;border-radius:5px;text-decoration:none;}
    .btn-back:hover{background:var(--gray-light);}
    .form-card{background:#fff;border-radius:8px;border:1px solid var(--gray-mid);padding:24px;}
    .form-row{display:grid;grid-template-columns:1fr 1fr;gap:16px;}
    .form-group{margin-bottom:18px;}
    .form-group label{display:block;font-size:13px;font-weight:600;color:var(--text-dark);margin-bottom:6px;}
    .required{color:#e53e3e;margin-left:2px;}
    .form-group input[type="text"],
    .form-group input[type="number"],
    .form-group textarea{width:100%;padding:9px 12px;border:1px solid var(--gray-mid);border-radius:6px;font-size:13px;font-family:'Inter',sans-serif;color:var(--text-dark);background:#fff;outline:none;transition:border-color 0.2s;}
    .form-group input:focus,.form-group textarea:focus{border-color:var(--blue-mid);box-shadow:0 0 0 3px rgba(35,81,164,0.07);}
    .form-group textarea{resize:vertical;min-height:100px;line-height:1.7;}
    .form-hint{font-size:11px;color:var(--gray-text);margin-top:4px;}

    .upload-area{border:2px dashed var(--gray-mid);border-radius:6px;padding:20px;text-align:center;background:var(--gray-light);cursor:pointer;transition:border-color 0.2s;}
    .upload-area:hover{border-color:var(--blue-mid);}
    .upload-area input[type="file"]{display:none;}
    .upload-icon{font-size:24px;color:var(--gray-text);margin-bottom:6px;}
    .upload-area p{font-size:12px;color:var(--gray-text);}
    .upload-area p span{color:var(--blue-mid);font-weight:600;}
    .upload-hint{font-size:10px;color:#9aa5b8;margin-top:3px;}

    .preview-wrap{display:none;margin-top:10px;}
    .preview-wrap.show{display:block;}
    .preview-foto{width:80px;height:80px;border-radius:50%;object-fit:cover;border:2px solid var(--gray-mid);}
    .preview-bg{width:100%;max-height:140px;object-fit:cover;border-radius:6px;border:1px solid var(--gray-mid);}

    .current-foto{margin-bottom:10px;display:flex;align-items:center;gap:12px;}
    .current-foto img{width:64px;height:64px;border-radius:50%;object-fit:cover;border:2px solid var(--gray-mid);}
    .current-foto p{font-size:11px;color:var(--gray-text);}
    .current-bg{margin-bottom:10px;}
    .current-bg img{width:100%;max-height:120px;object-fit:cover;border-radius:6px;border:1px solid var(--gray-mid);display:block;}
    .current-bg p{font-size:11px;color:var(--gray-text);margin-top:4px;}

    .form-actions{display:flex;gap:10px;justify-content:flex-end;padding-top:20px;border-top:1px solid var(--gray-mid);margin-top:8px;}
    .btn-submit{background:var(--navy);color:#fff;font-size:13px;font-weight:600;padding:9px 24px;border-radius:6px;border:none;cursor:pointer;transition:background 0.2s;}
    .btn-submit:hover{background:var(--blue-mid);}
    .btn-cancel{background:#fff;color:var(--gray-text);font-size:13px;padding:9px 18px;border-radius:6px;border:1px solid var(--gray-mid);text-decoration:none;}
    .btn-cancel:hover{background:var(--gray-light);}

    .errors-box{background:#fdecea;border:1px solid #f5c6c2;border-radius:6px;padding:12px 16px;margin-bottom:20px;}
    .errors-box ul{list-style:none;}
    .errors-box ul li{font-size:13px;color:#c0392b;margin-bottom:4px;}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="page-header">
    <h2><?= $alumni ? 'Edit Alumni' : 'Tambah Alumni' ?></h2>
    <a href="<?= base_url('admin/alumni') ?>" class="btn-back">← Kembali</a>
</div>

<?php if (session()->getFlashdata('errors')): ?>
<div class="errors-box">
    <ul>
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<div class="form-card">
    <form action="<?= $alumni
        ? base_url('admin/alumni/update/' . $alumni['id'])
        : base_url('admin/alumni/simpan') ?>"
          method="POST"
          enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="form-group">
            <label>Nama Lengkap <span class="required">*</span></label>
            <input type="text" name="nama"
                   value="<?= old('nama', $alumni['nama'] ?? '') ?>">
        </div>

        <!-- Jurusan + Angkatan -->
        <div class="form-row">
            <div class="form-group">
                <label>Jurusan / Program Studi <span class="required">*</span></label>
                <input type="text" name="jurusan"
                       value="<?= old('jurusan', $alumni['jurusan'] ?? '') ?>"
                       required>
            </div>
            <div class="form-group">
                <label>Angkatan</label>
                <input type="text" name="angkatan"
                       value="<?= old('angkatan', $alumni['angkatan'] ?? '') ?>">
            </div>
        </div>

        <div class="form-group">
            <label>Deskripsi / Pencapaian</label>
            <textarea name="deskripsi"><?= old('deskripsi', $alumni['deskripsi'] ?? '') ?></textarea>
        </div>

        <div class="form-group">
            <label>Foto Profil</label>
            <?php if (!empty($alumni['foto_profil'])): ?>
            <div class="current-foto">
                <img src="<?= base_url('assets/alumni/' . $alumni['foto_profil']) ?>" alt="Foto saat ini">
                <p>Foto saat ini — upload baru untuk mengganti</p>
            </div>
            <?php endif; ?>
            <label class="upload-area" for="foto_profil">
                <input type="file" id="foto_profil" name="foto_profil" accept="image/*">
                <div class="upload-icon">👤</div>
                <p><span>Klik untuk upload</span> foto profil</p>
                <p class="upload-hint">PNG, JPG — maks. 2MB, rasio 1:1 disarankan</p>
            </label>
            <div class="preview-wrap" id="previewFotoWrap">
                <img id="previewFoto" src="" class="preview-foto" alt="Preview">
            </div>
        </div>

        <div class="form-group">
            <label>Background Image</label>
            <?php if (!empty($alumni['background_images'])): ?>
            <div class="current-bg">
                <img src="<?= base_url('assets/alumni/' . $alumni['background_images']) ?>" alt="Background saat ini">
                <p>Background saat ini — upload baru untuk mengganti</p>
            </div>
            <?php endif; ?>
            <label class="upload-area" for="background_images">
                <input type="file" id="background_images" name="background_images" accept="image/*">
                <div class="upload-icon">🖼️</div>
                <p><span>Klik untuk upload</span> background image</p>
                <p class="upload-hint">PNG, JPG — maks. 2MB, rasio 16:9 disarankan</p>
            </label>
            <div class="preview-wrap" id="previewBgWrap">
                <img id="previewBg" src="" class="preview-bg" alt="Preview">
            </div>
        </div>

        <div class="form-actions">
            <a href="<?= base_url('admin/alumni') ?>" class="btn-cancel">Batal</a>
            <button type="submit" class="btn-submit">
                <?= $alumni ? 'Simpan Perubahan' : 'Simpan Alumni' ?>
            </button>
        </div>

    </form>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
document.getElementById('foto_profil').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = ev => {
        document.getElementById('previewFoto').src = ev.target.result;
        document.getElementById('previewFotoWrap').classList.add('show');
    };
    reader.readAsDataURL(file);
});

document.getElementById('background_image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = ev => {
        document.getElementById('previewBg').src = ev.target.result;
        document.getElementById('previewBgWrap').classList.add('show');
    };
    reader.readAsDataURL(file);
});
</script>
<?= $this->endSection() ?>