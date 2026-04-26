<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>

<?php $isEdit = isset($fak) && $fak !== null; ?>

<div class="form-page-header">
    <a href="<?= base_url('admin/fakultas?tab=fakultas') ?>" class="back-btn">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
    <div>
        <h1 class="page-title"><?= $isEdit ? 'Edit Fakultas' : 'Tambah Fakultas' ?></h1>
        <p class="page-sub"><?= $isEdit ? 'Perbarui data ' . esc($fak['nama']) : 'Tambahkan fakultas baru' ?></p>
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

<form action="<?= $isEdit ? base_url('admin/fakultas/update/' . $fak['id']) : base_url('admin/fakultas/simpan') ?>"
      method="POST" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="form-layout">

        <!-- KOLOM KIRI -->
        <div class="form-col-main">

            <!-- Identitas -->
            <div class="form-card">
                <div class="form-card-head">Identitas Fakultas</div>
                <div class="form-card-body">
                    <div class="form-group">
                        <label>Nama Fakultas <span class="req">*</span></label>
                        <input type="text" name="nama" class="form-control"
                               value="<?= old('nama', $fak['nama'] ?? '') ?>"
                               placeholder="cth: Fakultas Hukum" required>
                    </div>
                    <div class="form-row-2">
                        <div class="form-group">
                            <label>Warna Aksen <span class="req">*</span></label>
                            <div class="color-input-wrap">
                                <input type="color" name="warna" id="warnaInput"
                                       value="<?= old('warna', $fak['warna'] ?? '#1a3a6b') ?>">
                                <input type="text" id="warnaText" class="form-control"
                                       value="<?= old('warna', $fak['warna'] ?? '#1a3a6b') ?>"
                                       maxlength="7" placeholder="#1a3a6b"
                                       oninput="document.getElementById('warnaInput').value=this.value">
                            </div>
                            <p class="hint">Warna border kartu fakultas di halaman publik</p>
                        </div>
                        <div class="form-group">
                            <label>Nama Dekan</label>
                            <input type="text" name="nama_dekan" class="form-control"
                                   value="<?= old('nama_dekan', $fak['nama_dekan'] ?? '') ?>"
                                   placeholder="Prof. Dr. ...">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Background hero -->
            <div class="form-card">
                <div class="form-card-head">Background Halaman Publik</div>
                <div class="form-card-body">
                    <div class="form-group">
                        <label>Tipe Background <span class="req">*</span></label>
                        <div class="radio-group">
                            <label class="radio-opt">
                                <input type="radio" name="bg_tipe" value="image"
                                    <?= old('bg_tipe', $fak['bg_tipe'] ?? 'image') === 'image' ? 'checked' : '' ?>
                                    onchange="toggleBg(this.value)">
                                <span><i class="fas fa-image"></i> Upload Gambar</span>
                            </label>
                            <label class="radio-opt">
                                <input type="radio" name="bg_tipe" value="youtube"
                                    <?= old('bg_tipe', $fak['bg_tipe'] ?? '') === 'youtube' ? 'checked' : '' ?>
                                    onchange="toggleBg(this.value)">
                                <span><i class="fas fa-play-circle" style="color:#e53935"></i> Video YouTube</span>
                            </label>
                        </div>
                    </div>

                    <div id="bg-image-wrap" class="form-group">
                        <label>File Gambar</label>
                        <?php if ($isEdit && $fak['bg_tipe'] === 'image' && $fak['bg_value']): ?>
                        <div class="img-preview-wrap">
                            <img src="<?= base_url('assets/fakultas/' . $fak['bg_value']) ?>"
                                 alt="bg" class="img-preview">
                            <span class="img-preview-name"><?= esc($fak['bg_value']) ?></span>
                        </div>
                        <?php endif; ?>
                        <input type="file" name="bg_image" class="form-control" accept="image/jpeg,image/png,image/webp">
                        <p class="hint">Format: JPG, PNG, WebP. Disarankan ukuran landscape 1920×600px</p>
                    </div>

                    <div id="bg-youtube-wrap" class="form-group" style="display:none">
                        <label>URL / Embed ID YouTube</label>
                        <input type="text" name="bg_youtube" class="form-control"
                               value="<?= old('bg_youtube', ($fak['bg_tipe'] ?? '') === 'youtube' ? ($fak['bg_value'] ?? '') : '') ?>"
                               placeholder="cth: dQw4w9WgXcQ atau https://youtube.com/watch?v=...">
                        <p class="hint">Paste URL YouTube atau video ID saja</p>
                    </div>
                </div>
            </div>

            <!-- Sejarah & Sambutan -->
            <div class="form-card">
                <div class="form-card-head">Konten</div>
                <div class="form-card-body">
                    <div class="form-group">
                        <label>Sejarah Singkat</label>
                        <textarea name="sejarah_singkat" class="form-control" rows="5"
                                  placeholder="Tuliskan sejarah singkat fakultas..."><?= old('sejarah_singkat', $fak['sejarah_singkat'] ?? '') ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Sambutan Dekan</label>
                        <textarea name="sambutan_dekan" class="form-control" rows="5"
                                  placeholder="Tuliskan sambutan dari dekan..."><?= old('sambutan_dekan', $fak['sambutan_dekan'] ?? '') ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN -->
        <div class="form-col-side">

            <!-- Foto Dekan -->
            <div class="form-card">
                <div class="form-card-head">Foto Dekan</div>
                <div class="form-card-body">
                    <?php if ($isEdit && !empty($fak['foto_dekan'])): ?>
                    <div style="text-align:center;margin-bottom:12px">
                        <img src="<?= base_url('assets/dekan/' . $fak['foto_dekan']) ?>"
                             alt="Foto Dekan"
                             style="width:100px;height:100px;border-radius:50%;object-fit:cover;border:3px solid #e8edf5">
                        <p style="font-size:11px;color:#999;margin-top:6px"><?= esc($fak['foto_dekan']) ?></p>
                    </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <input type="file" name="foto_dekan" class="form-control" accept="image/*">
                        <p class="hint">Format: JPG, PNG. Ukuran kotak 1:1 disarankan</p>
                    </div>
                </div>
            </div>

            <!-- Statistik -->
            <div class="form-card">
                <div class="form-card-head">Statistik</div>
                <div class="form-card-body">
                    <div class="form-group">
                        <label>Jumlah Mahasiswa</label>
                        <input type="number" name="jmlh_mahasiswa" class="form-control" min="0"
                               value="<?= old('jmlh_mahasiswa', $fak['jmlh_mahasiswa'] ?? 0) ?>">
                    </div>
                    <div class="form-group">
                        <label>Jumlah Pengajar</label>
                        <input type="number" name="jmlh_pengajar" class="form-control" min="0"
                               value="<?= old('jmlh_pengajar', $fak['jmlh_pengajar'] ?? 0) ?>">
                    </div>
                    <div class="form-group">
                        <label>Guru Besar</label>
                        <input type="number" name="jmlh_guru_besar" class="form-control" min="0"
                               value="<?= old('jmlh_guru_besar', $fak['jmlh_guru_besar'] ?? 0) ?>">
                    </div>
                    <div class="form-group">
                        <label>Doktor</label>
                        <input type="number" name="jmlh_doktor" class="form-control" min="0"
                               value="<?= old('jmlh_doktor', $fak['jmlh_doktor'] ?? 0) ?>">
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="form-card">
                <div class="form-card-body">
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-save"></i>
                        <?= $isEdit ? 'Perbarui Fakultas' : 'Simpan Fakultas' ?>
                    </button>
                    <a href="<?= base_url('admin/fakultas?tab=fakultas') ?>" class="btn-cancel">Batal</a>
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

.form-layout { display:grid; grid-template-columns:1fr 300px; gap:20px; align-items:start; }
.form-col-main { display:flex; flex-direction:column; gap:16px; }
.form-col-side { display:flex; flex-direction:column; gap:16px; }

.form-card { background:#fff; border:1px solid #e8edf5; border-radius:10px; overflow:hidden; }
.form-card-head { padding:12px 18px; font-size:12px; font-weight:600; text-transform:uppercase; letter-spacing:0.7px; color:#666; background:#f7f9ff; border-bottom:1px solid #e8edf5; }
.form-card-body { padding:18px; display:flex; flex-direction:column; gap:14px; }

.form-group { display:flex; flex-direction:column; gap:5px; }
.form-row-2 { display:grid; grid-template-columns:1fr 1fr; gap:14px; }
label { font-size:13px; font-weight:500; color:#374151; }
.req { color:#e53935; }
.hint { font-size:11px; color:#999; margin:0; }

.form-control { padding:9px 12px; border:1px solid #d0daf0; border-radius:6px; font-size:13px; color:#1a2035; font-family:inherit; background:#fff; transition:border-color 0.2s; width:100%; }
.form-control:focus { outline:none; border-color:#2351a4; box-shadow:0 0 0 3px rgba(35,81,164,0.08); }
textarea.form-control { resize:vertical; }

.color-input-wrap { display:flex; align-items:center; gap:8px; }
.color-input-wrap input[type=color] { width:40px; height:38px; border:1px solid #d0daf0; border-radius:6px; cursor:pointer; padding:2px; background:#fff; }
.color-input-wrap .form-control { flex:1; }

.radio-group { display:flex; gap:10px; flex-wrap:wrap; }
.radio-opt { display:flex; align-items:center; gap:7px; padding:8px 14px; border:1px solid #d0daf0; border-radius:6px; cursor:pointer; font-size:13px; color:#374151; transition:all 0.15s; }
.radio-opt:has(input:checked) { border-color:#2351a4; background:#f0f4ff; color:#1a2e5a; }
.radio-opt input { display:none; }
.radio-opt span { display:flex; align-items:center; gap:6px; }

.img-preview-wrap { display:flex; align-items:center; gap:10px; padding:8px; background:#f7f9ff; border-radius:6px; margin-bottom:8px; }
.img-preview { width:60px; height:40px; object-fit:cover; border-radius:4px; }
.img-preview-name { font-size:11px; color:#666; word-break:break-all; }

.btn-submit { width:100%; padding:11px; background:#1a2e5a; color:#fff; border:none; border-radius:6px; font-size:14px; font-weight:500; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:8px; transition:background 0.2s; }
.btn-submit:hover { background:#2351a4; }
.btn-cancel { display:block; text-align:center; padding:9px; margin-top:8px; color:#666; font-size:13px; text-decoration:none; border:1px solid #e0e6f0; border-radius:6px; transition:all 0.2s; }
.btn-cancel:hover { background:#f7f9ff; }
</style>

<script>
const warnaInput = document.getElementById('warnaInput');
const warnaText  = document.getElementById('warnaText');
warnaInput.addEventListener('input', () => warnaText.value = warnaInput.value);

function toggleBg(val) {
    document.getElementById('bg-image-wrap').style.display   = val === 'image'   ? 'flex' : 'none';
    document.getElementById('bg-youtube-wrap').style.display = val === 'youtube' ? 'flex' : 'none';
}
toggleBg(document.querySelector('input[name="bg_tipe"]:checked')?.value || 'image');
</script>

<?= $this->endSection() ?>