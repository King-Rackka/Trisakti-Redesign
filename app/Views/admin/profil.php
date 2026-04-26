<?= $this->extend('layout/admin') ?>
<?= $this->section('styles') ?>
<style>
    .page-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;}
    .page-header h2{font-size:16px;font-weight:600;color:var(--text-dark);}

    /* Tabs */
    .tab-nav{display:flex;gap:0;border-bottom:2px solid var(--gray-mid);margin-bottom:24px;}
    .tab-btn{padding:10px 20px;font-size:13px;font-weight:500;color:var(--gray-text);background:none;border:none;cursor:pointer;border-bottom:2px solid transparent;margin-bottom:-2px;transition:all 0.15s;}
    .tab-btn:hover{color:var(--navy);}
    .tab-btn.active{color:var(--navy);border-bottom-color:var(--navy);font-weight:600;}

    .tab-pane{display:none;}
    .tab-pane.active{display:block;}

    .form-card{background:#fff;border-radius:8px;border:1px solid var(--gray-mid);padding:24px;}
    .form-group{margin-bottom:18px;}
    .form-group label{display:block;font-size:13px;font-weight:600;color:var(--text-dark);margin-bottom:6px;}
    .form-group input[type="text"],
    .form-group textarea{
        width:100%;padding:9px 12px;
        border:1px solid var(--gray-mid);border-radius:6px;
        font-size:13px;font-family:'Inter',sans-serif;
        color:var(--text-dark);background:#fff;
        outline:none;transition:border-color 0.2s;
    }
    .form-group input:focus,
    .form-group textarea:focus{border-color:var(--blue-mid);box-shadow:0 0 0 3px rgba(35,81,164,0.07);}
    .form-group textarea{resize:vertical;min-height:200px;line-height:1.7;}
    .form-hint{font-size:11px;color:var(--gray-text);margin-top:4px;}
    .form-actions{display:flex;gap:10px;justify-content:flex-end;padding-top:20px;border-top:1px solid var(--gray-mid);margin-top:8px;}
    .btn-submit{background:var(--navy);color:#fff;font-size:13px;font-weight:600;padding:9px 24px;border-radius:6px;border:none;cursor:pointer;transition:background 0.2s;}
    .btn-submit:hover{background:var(--blue-mid);}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="page-header">
    <h2>Profil Kampus</h2>
</div>

<div class="tab-nav">
    <button class="tab-btn active" onclick="switchTab('sejarah', this)">Sejarah Singkat</button>
    <button class="tab-btn" onclick="switchTab('visimisi', this)">Visi &amp; Misi</button>
    <button class="tab-btn" onclick="switchTab('motto', this)">Motto</button>
    <button class="tab-btn" onclick="switchTab('tentang', this)">Tentang</button>
</div>

<div id="tab-sejarah" class="tab-pane active">
    <div class="form-card">
        <form action="<?= base_url('admin/profil/update') ?>" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" name="field" value="sejarah">
            <div class="form-group">
                <label>Sejarah Singkat</label>
                <textarea name="sejarah" rows="12"><?= esc((string)($profil['sejarah'] ?? '')) ?></textarea>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-submit">Simpan Sejarah</button>
            </div>
        </form>
    </div>
</div>

<div id="tab-visimisi" class="tab-pane">
    <div class="form-card">
        <form action="<?= base_url('admin/profil/update') ?>" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" name="field" value="visimisi">
            <div class="form-group">
                <label>Visi</label>
                <textarea name="visi" rows="4"><?= esc((string)($profil['visi'] ?? '')) ?></textarea>
            </div>
            <div class="form-group">
                <label>Misi</label>
                <textarea name="misi" rows="10"><?= esc((string)($profil['misi'] ?? '')) ?></textarea>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-submit">Simpan Visi &amp; Misi</button>
            </div>
        </form>
    </div>
</div>

<!-- Tab: Motto -->
<div id="tab-motto" class="tab-pane">
    <div class="form-card">
        <form action="<?= base_url('admin/profil/update') ?>" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" name="field" value="motto">
            <div class="form-group">
                <label>Motto</label>
                <input type="text" name="motto" value="<?= esc((string)($profil['motto'] ?? '')) ?>">
            </div>
            <div class="form-group">
                <label>Deskripsi Motto</label>
                <textarea name="motto_deskripsi" rows="6"><?= esc((string)($profil['motto_deskripsi'] ?? '')) ?></textarea>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-submit">Simpan Motto</button>
            </div>
        </form>
    </div>
</div>

<div id="tab-tentang" class="tab-pane">
    <div class="form-card">
        <form action="<?= base_url('admin/profil/update') ?>" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" name="field" value="tentang">
            <div class="form-group">
                <label>Tentang Universitas</label>
                <textarea name="tentang" rows="8"><?= esc((string)($profil['tentang'] ?? '')) ?></textarea>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-submit">Simpan</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function switchTab(name, btn) {
    document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('tab-' + name).classList.add('active');
    btn.classList.add('active');
}
</script>
<?= $this->endSection() ?>