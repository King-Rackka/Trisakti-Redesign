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
    .form-group input[type="date"],
    .form-group input[type="time"],
    .form-group textarea{width:100%;padding:9px 12px;border:1px solid var(--gray-mid);border-radius:6px;font-size:13px;font-family:'Inter',sans-serif;color:var(--text-dark);background:#fff;outline:none;transition:border-color 0.2s;}
    .form-group input:focus,.form-group textarea:focus{border-color:var(--blue-mid);box-shadow:0 0 0 3px rgba(35,81,164,0.07);}
    .form-group textarea{resize:vertical;min-height:160px;line-height:1.7;}
    .form-hint{font-size:11px;color:var(--gray-text);margin-top:4px;}

    .upload-area{border:2px dashed var(--gray-mid);border-radius:6px;padding:20px;text-align:center;background:var(--gray-light);cursor:pointer;transition:border-color 0.2s;}
    .upload-area:hover{border-color:var(--blue-mid);}
    .upload-area input[type="file"]{display:none;}
    .upload-icon{font-size:24px;color:var(--gray-text);margin-bottom:6px;}
    .upload-area p{font-size:12px;color:var(--gray-text);}
    .upload-area p span{color:var(--blue-mid);font-weight:600;}
    .upload-hint-text{font-size:10px;color:#9aa5b8;margin-top:3px;}

    .preview-wrap{display:none;margin-top:10px;}
    .preview-wrap.show{display:block;}
    .preview-wrap img{width:100%;max-height:180px;object-fit:cover;border-radius:6px;border:1px solid var(--gray-mid);display:block;}

    .current-img{margin-bottom:10px;}
    .current-img img{width:100%;max-height:160px;object-fit:cover;border-radius:6px;border:1px solid var(--gray-mid);display:block;}
    .current-img p{font-size:11px;color:var(--gray-text);margin-top:4px;}

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
    <h2><?= $agenda ? 'Edit Agenda' : 'Tambah Agenda' ?></h2>
    <a href="<?= base_url('admin/agenda') ?>" class="btn-back">← Kembali</a>
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
    <form action="<?= $agenda
        ? base_url('admin/agenda/update/' . $agenda['id'])
        : base_url('admin/agenda/simpan') ?>"
          method="POST"
          enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="form-group">
            <label>Judul Agenda <span class="required">*</span></label>
            <input type="text" name="judul"
                   value="<?= old('judul', $agenda['judul'] ?? '') ?>"
                   placeholder="Masukkan judul agenda..."
                   required>
            <div class="form-hint">Slug akan dibuat otomatis dari judul.</div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Tanggal <span class="required">*</span></label>
                <input type="date" name="tanggal"
                       value="<?= old('tanggal', $agenda['tanggal'] ?? date('Y-m-d')) ?>"
                       required>
            </div>
            <div class="form-group">
                <label>Waktu <span class="required">*</span></label>
                <input type="time" name="waktu"
                       value="<?= old('waktu', isset($agenda['waktu']) ? substr($agenda['waktu'], 0, 5) : '08:00') ?>"
                       required>
            </div>
        </div>

        <div class="form-group">
            <label>Tempat</label>
            <input type="text" name="tempat"
                   value="<?= old('tempat', $agenda['tempat'] ?? '') ?>"
                   placeholder="Contoh: Gedung Syarief Thayeb, Kampus A">
        </div>

        <div class="form-group">
            <label>Gambar</label>
            <?php if (!empty($agenda['gambar'])): ?>
            <div class="current-img">
                <img src="<?= base_url('assets/agenda/' . $agenda['gambar']) ?>"
                     alt="Gambar saat ini">
                <p>Gambar saat ini — upload baru untuk mengganti</p>
            </div>
            <?php endif; ?>
            <label class="upload-area" for="gambar">
                <input type="file" id="gambar" name="gambar" accept="image/*">
                <div class="upload-icon">⬆</div>
                <p><span>Klik untuk upload</span> atau drag & drop</p>
                <p class="upload-hint-text">PNG, JPG, WEBP — maks. 2MB</p>
            </label>
            <div class="preview-wrap" id="previewWrap">
                <img id="previewImg" src="" alt="Preview">
            </div>
        </div>

        <div class="form-group">
            <label>Deskripsi <span class="required">*</span></label>
            <textarea name="deskripsi"
                      placeholder="Tulis deskripsi agenda..."
                      required><?= old('deskripsi', $agenda['deskripsi'] ?? '') ?></textarea>
        </div>

        <div class="form-actions">
            <a href="<?= base_url('admin/agenda') ?>" class="btn-cancel">Batal</a>
            <button type="submit" class="btn-submit">
                <?= $agenda ? 'Simpan Perubahan' : 'Simpan Agenda' ?>
            </button>
        </div>

    </form>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
document.getElementById('gambar').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = ev => {
        document.getElementById('previewImg').src = ev.target.result;
        document.getElementById('previewWrap').classList.add('show');
    };
    reader.readAsDataURL(file);
});
</script>
<?= $this->endSection() ?>