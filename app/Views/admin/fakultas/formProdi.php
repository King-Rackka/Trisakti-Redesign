<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>

<?php $isEdit = isset($prodi) && $prodi !== null; ?>

<div class="form-page-header">
    <a href="<?= base_url('admin/fakultas?tab=prodi') ?>" class="back-btn">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
    <div>
        <h1 class="page-title"><?= $isEdit ? 'Edit Program Studi' : 'Tambah Program Studi' ?></h1>
        <p class="page-sub"><?= $isEdit ? 'Perbarui data ' . esc($prodi['nama']) : 'Tambahkan program studi baru' ?></p>
    </div>
</div>

<?php if (session()->getFlashdata('errors') || isset($errors)): ?>
<div class="alert alert-error">
    <b>Harap perbaiki:</b>
    <ul style="margin:6px 0 0 16px">
        <?php foreach ((session()->getFlashdata('errors') ?? $errors ?? []) as $e): ?>
            <li><?= esc($e) ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<form action="<?= $isEdit ? base_url('admin/prodi/update/' . $prodi['id']) : base_url('admin/prodi/simpan') ?>"
      method="POST" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="form-layout">

        <div class="form-col-main">

            <div class="form-card">
                <div class="form-card-head">Identitas Program Studi</div>
                <div class="form-card-body">

                    <div class="form-group">
                        <label>Fakultas <span class="req">*</span></label>
                        <select name="id_fakultas" class="form-control" required id="fakSelect" onchange="updateFakColor()">
                            <option value="">-- Pilih Fakultas --</option>
                            <?php foreach ($fakList as $fak): ?>
                            <option value="<?= $fak['id'] ?>"
                                    data-warna="<?= esc($fak['warna']) ?>"
                                    <?= old('id_fakultas', $prodi['id_fakultas'] ?? '') == $fak['id'] ? 'selected' : '' ?>>
                                <?= esc($fak['nama']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                        <div id="fak-preview" style="display:none;margin-top:6px">
                            <span id="fak-preview-badge" style="display:inline-flex;align-items:center;gap:6px;font-size:12px;padding:4px 10px;border-radius:20px;font-weight:500;"></span>
                        </div>
                    </div>

                    <div class="form-row-2">
                        <div class="form-group">
                            <label>Nama Program Studi <span class="req">*</span></label>
                            <input type="text" name="nama" class="form-control"
                                   value="<?= old('nama', $prodi['nama'] ?? '') ?>"
                                   placeholder="cth: Teknik Informatika" required>
                        </div>
                        <div class="form-group">
                            <label>Jenjang <span class="req">*</span></label>
                            <select name="jenjang" class="form-control" required>
                                <?php foreach (['D3','S1','S2','S3','Profesi','Spesialis'] as $j): ?>
                                <option value="<?= $j ?>" <?= old('jenjang', $prodi['jenjang'] ?? 'S1') === $j ? 'selected' : '' ?>>
                                    <?= $j ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Background -->
            <div class="form-card">
                <div class="form-card-head">Background Halaman Prodi</div>
                <div class="form-card-body">
                    <div class="form-group">
                        <label>Tipe Background <span class="req">*</span></label>
                        <div class="radio-group">
                            <label class="radio-opt">
                                <input type="radio" name="bg_tipe" value="image"
                                    <?= old('bg_tipe', $prodi['bg_tipe'] ?? 'image') === 'image' ? 'checked' : '' ?>
                                    onchange="toggleBg(this.value)">
                                <span><i class="fas fa-image"></i> Upload Gambar</span>
                            </label>
                            <label class="radio-opt">
                                <input type="radio" name="bg_tipe" value="youtube"
                                    <?= old('bg_tipe', $prodi['bg_tipe'] ?? '') === 'youtube' ? 'checked' : '' ?>
                                    onchange="toggleBg(this.value)">
                                <span><i class="fas fa-play-circle" style="color:#e53935"></i> Video YouTube</span>
                            </label>
                        </div>
                    </div>

                    <div id="bg-image-wrap" class="form-group">
                        <label>File Gambar</label>
                        <?php if ($isEdit && $prodi['bg_tipe'] === 'image' && $prodi['bg_value']): ?>
                        <div class="img-preview-wrap">
                            <img src="<?= base_url('assets/prodi/' . $prodi['bg_value']) ?>"
                                 alt="bg" class="img-preview">
                            <span class="img-preview-name"><?= esc($prodi['bg_value']) ?></span>
                        </div>
                        <?php endif; ?>
                        <input type="file" name="bg_image" class="form-control" accept="image/jpeg,image/png,image/webp">
                        <p class="hint">Format: JPG, PNG, WebP. Landscape 1920x600px disarankan</p>
                    </div>

                    <div id="bg-youtube-wrap" class="form-group" style="display:none">
                        <label>URL / Video ID YouTube</label>
                        <input type="text" name="bg_youtube" class="form-control"
                               value="<?= old('bg_youtube', ($prodi['bg_tipe'] ?? '') === 'youtube' ? ($prodi['bg_value'] ?? '') : '') ?>"
                               placeholder="cth: dQw4w9WgXcQ atau full URL">
                        <p class="hint">Paste URL YouTube atau video ID saja</p>
                    </div>
                </div>
            </div>

            <!-- Konten -->
            <div class="form-card">
                <div class="form-card-head">Konten</div>
                <div class="form-card-body">
                    <div class="form-group">
                        <label>Tentang Prodi</label>
                        <textarea name="tentang" class="form-control" rows="5"
                                  placeholder="Deskripsi singkat tentang program studi ini..."><?= old('tentang', $prodi['tentang'] ?? '') ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Sejarah Prodi</label>
                        <textarea name="sejarah" class="form-control" rows="5"
                                  placeholder="Sejarah singkat program studi..."><?= old('sejarah', $prodi['sejarah'] ?? '') ?></textarea>
                    </div>
                </div>
            </div>

            <div class="form-card">
                <div class="form-card-head">Ketua Program Studi <span style="font-weight:400;color:#aaa;text-transform:none;letter-spacing:0;">(opsional)</span></div>
                <div class="form-card-body">

                    <div class="form-group">
                        <label>Nama Kaprodi</label>
                        <input type="text" name="nama_kaprodi" class="form-control"
                               value="<?= old('nama_kaprodi', $prodi['nama_kaprodi'] ?? '') ?>"
                               placeholder="cth: Dr. Ahmad, M.Kom.">
                    </div>

                    <div class="form-group">
                        <label>Foto Kaprodi</label>
                        <?php if ($isEdit && !empty($prodi['foto_kaprodi'])): ?>
                        <div class="img-preview-wrap">
                            <img src="<?= base_url('assets/kaprodi/' . $prodi['foto_kaprodi']) ?>"
                                 alt="foto kaprodi" class="img-preview">
                            <span class="img-preview-name"><?= esc($prodi['foto_kaprodi']) ?></span>
                        </div>
                        <?php endif; ?>
                        <input type="file" name="foto_kaprodi" class="form-control" accept="image/*">
                        <p class="hint">Kosongkan jika tidak ingin mengubah foto.</p>
                    </div>

                    <div class="form-group">
                        <label>Sambutan Kaprodi</label>
                        <textarea name="sambutan_kaprodi" class="form-control" rows="5"
                                  placeholder="Tulis sambutan ketua program studi... (opsional)"><?= old('sambutan_kaprodi', $prodi['sambutan_kaprodi'] ?? '') ?></textarea>
                    </div>

                </div>
            </div>

        </div>

        <div class="form-col-side">

            <div class="form-card">
                <div class="form-card-head">Ringkasan</div>
                <div class="form-card-body">
                    <div class="prodi-preview-box" id="prodiPreview">
                        <div style="font-size:12px;color:#999;text-align:center;padding:16px 0">
                            <i class="fas fa-book-open" style="font-size:24px;display:block;margin-bottom:8px"></i>
                            Pilih fakultas dan isi nama untuk melihat preview
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-card">
                <div class="form-card-body">
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-save"></i>
                        <?= $isEdit ? 'Perbarui Prodi' : 'Simpan Prodi' ?>
                    </button>
                    <a href="<?= base_url('admin/fakultas?tab=prodi') ?>" class="btn-cancel">Batal</a>
                </div>
            </div>

        </div>
    </div>
</form>

<style>
.form-page-header { display:flex; align-items:center; gap:16px; margin-bottom:24px; }
.back-btn { display:inline-flex; align-items:center; gap:7px; color:#666; font-size:13px; text-decoration:none; padding:7px 12px; border:1px solid #e0e6f0; border-radius:6px; transition:all 0.2s; }
.back-btn:hover { background:#f7f9ff; color:#1a2e5a; }
.page-title { font-size:20px; font-weight:600; color:#1a2e5a; margin-bottom:2px; }
.page-sub { font-size:13px; color:#888; }

.alert { padding:12px 16px; border-radius:6px; margin-bottom:20px; font-size:13px; }
.alert-error { background:#ffebee; color:#c62828; border:1px solid #ffcdd2; }

.form-layout { display:grid; grid-template-columns:1fr 280px; gap:20px; align-items:start; }
.form-col-main { display:flex; flex-direction:column; gap:16px; }
.form-col-side { display:flex; flex-direction:column; gap:16px; }

.form-card { background:#fff; border:1px solid #e8edf5; border-radius:10px; overflow:hidden; }
.form-card-head { padding:12px 18px; font-size:12px; font-weight:600; text-transform:uppercase; letter-spacing:0.7px; color:#666; background:#f7f9ff; border-bottom:1px solid #e8edf5; }
.form-card-body { padding:18px; display:flex; flex-direction:column; gap:14px; }

.form-group { display:flex; flex-direction:column; gap:5px; }
.form-row-2 { display:grid; grid-template-columns:1fr 120px; gap:14px; }
label { font-size:13px; font-weight:500; color:#374151; }
.req { color:#e53935; }
.hint { font-size:11px; color:#999; margin:0; }

.form-control { padding:9px 12px; border:1px solid #d0daf0; border-radius:6px; font-size:13px; color:#1a2035; font-family:inherit; background:#fff; transition:border-color 0.2s; width:100%; box-sizing:border-box; }
.form-control:focus { outline:none; border-color:#2351a4; box-shadow:0 0 0 3px rgba(35,81,164,0.08); }
textarea.form-control { resize:vertical; }
select.form-control { cursor:pointer; }

.radio-group { display:flex; gap:10px; flex-wrap:wrap; }
.radio-opt { display:flex; align-items:center; gap:7px; padding:8px 14px; border:1px solid #d0daf0; border-radius:6px; cursor:pointer; font-size:13px; color:#374151; transition:all 0.15s; }
.radio-opt:has(input:checked) { border-color:#2351a4; background:#f0f4ff; color:#1a2e5a; }
.radio-opt input { display:none; }
.radio-opt span { display:flex; align-items:center; gap:6px; }

.img-preview-wrap { display:flex; align-items:center; gap:10px; padding:8px; background:#f7f9ff; border-radius:6px; margin-bottom:4px; }
.img-preview { width:60px; height:40px; object-fit:cover; border-radius:4px; }
.img-preview-name { font-size:11px; color:#666; word-break:break-all; }

.prodi-preview-box { min-height:80px; }

.btn-submit { width:100%; padding:11px; background:#1a2e5a; color:#fff; border:none; border-radius:6px; font-size:14px; font-weight:500; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:8px; transition:background 0.2s; }
.btn-submit:hover { background:#2351a4; }
.btn-cancel { display:block; text-align:center; padding:9px; margin-top:8px; color:#666; font-size:13px; text-decoration:none; border:1px solid #e0e6f0; border-radius:6px; transition:all 0.2s; }
.btn-cancel:hover { background:#f7f9ff; }
</style>

<script>
function toggleBg(val) {
    document.getElementById('bg-image-wrap').style.display   = val === 'image'   ? 'flex' : 'none';
    document.getElementById('bg-youtube-wrap').style.display = val === 'youtube' ? 'flex' : 'none';
}
toggleBg(document.querySelector('input[name="bg_tipe"]:checked')?.value || 'image');

function updateFakColor() {
    const sel    = document.getElementById('fakSelect');
    const opt    = sel.options[sel.selectedIndex];
    const warna  = opt.dataset.warna || '#1a2e5a';
    const nama   = opt.text;
    const badge  = document.getElementById('fak-preview-badge');
    const wrap   = document.getElementById('fak-preview');

    if (sel.value) {
        wrap.style.display = 'block';
        badge.textContent  = nama;
        badge.style.background = warna + '22';
        badge.style.color      = warna;
        badge.style.border     = '1px solid ' + warna + '55';
    } else {
        wrap.style.display = 'none';
    }
    updatePreview();
}

function updatePreview() {
    const nama    = document.querySelector('[name="nama"]').value;
    const sel     = document.getElementById('fakSelect');
    const opt     = sel.options[sel.selectedIndex];
    const warna   = opt?.dataset.warna || '#1a2e5a';
    const fak     = opt?.text || '';
    const jenjang = document.querySelector('[name="jenjang"]').value;
    const box     = document.getElementById('prodiPreview');

    if (nama && sel.value) {
        box.innerHTML = `
            <div style="border-left:4px solid ${warna};padding:10px 12px;background:${warna}11;border-radius:0 6px 6px 0">
                <div style="font-size:11px;color:${warna};font-weight:600;letter-spacing:0.5px;margin-bottom:4px">${jenjang}</div>
                <div style="font-size:14px;font-weight:600;color:#1a2e5a;line-height:1.3">${nama}</div>
                <div style="font-size:11px;color:#888;margin-top:4px">${fak}</div>
            </div>`;
    }
}

document.querySelector('[name="nama"]')?.addEventListener('input', updatePreview);
document.querySelector('[name="jenjang"]')?.addEventListener('change', updatePreview);

updateFakColor();
</script>

<?= $this->endSection() ?>