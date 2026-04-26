<?= $this->extend('layout/admin') ?>
<?= $this->section('styles') ?>
<style>
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        margin-bottom: 32px;
    }
    .dash-card {
        background: #fff;
        border-radius: 8px;
        border: 1px solid var(--gray-mid);
        padding: 20px 24px;
        display: flex;
        align-items: center;
        gap: 16px;
        text-decoration: none;
        transition: box-shadow 0.15s, transform 0.15s;
    }
    .dash-card:hover { box-shadow: 0 4px 16px rgba(26,46,90,0.10); transform: translateY(-2px); }
    .dash-icon {
        width: 48px; height: 48px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }
    .dash-icon.blue   { background: #e8f0fb; color: var(--blue-mid); }
    .dash-icon.navy   { background: #e4e9f2; color: var(--navy); }
    .dash-icon.amber  { background: #fef9e7; color: #d4a017; }
    .dash-icon.green  { background: #eafaf1; color: #1e8449; }
    .dash-icon.purple { background: #f3eef9; color: #7d3c98; }
    .dash-label { font-size: 12px; color: var(--gray-text); margin-bottom: 4px; }
    .dash-name  { font-size: 15px; font-weight: 600; color: var(--text-dark); }

    .section-title {
        font-size: 15px;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 16px;
        padding-bottom: 10px;
        border-bottom: 1px solid var(--gray-mid);
    }
    .quick-links {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 12px;
    }
    .quick-link {
        background: #fff;
        border: 1px solid var(--gray-mid);
        border-radius: 8px;
        padding: 16px;
        text-align: center;
        text-decoration: none;
        transition: all 0.15s;
        color: var(--text-dark);
    }
    .quick-link:hover { border-color: var(--blue-mid); color: var(--blue-mid); background: #f0f5ff; }
    .quick-link i { font-size: 22px; display: block; margin-bottom: 8px; }
    .quick-link span { font-size: 13px; font-weight: 500; }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Menu Kelola Konten -->
<div class="section-title">Kelola Konten</div>
<div class="dashboard-grid">
    <a href="<?= base_url('admin/berita') ?>" class="dash-card">
        <div class="dash-icon blue"><i class="fas fa-newspaper"></i></div>
        <div>
            <div class="dash-label">Konten</div>
            <div class="dash-name">Berita</div>
        </div>
    </a>
    <a href="<?= base_url('admin/fakultas') ?>" class="dash-card">
        <div class="dash-icon navy"><i class="fas fa-building-columns"></i></div>
        <div>
            <div class="dash-label">Konten</div>
            <div class="dash-name">Fakultas & Jurusan</div>
        </div>
    </a>
    <a href="<?= base_url('admin/agenda') ?>" class="dash-card">
        <div class="dash-icon amber"><i class="fas fa-calendar-alt"></i></div>
        <div>
            <div class="dash-label">Konten</div>
            <div class="dash-name">Agenda</div>
        </div>
    </a>
    <a href="<?= base_url('admin/alumni') ?>" class="dash-card">
        <div class="dash-icon green"><i class="fas fa-graduation-cap"></i></div>
        <div>
            <div class="dash-label">Konten</div>
            <div class="dash-name">Alumni</div>
        </div>
    </a>
    
</div>

<div class="section-title">Pengaturan</div>
<div class="quick-links">
    <a href="<?= base_url('admin/profil') ?>" class="quick-link">
        <i class="fas fa-university"></i>
        <span>Profil Kampus</span>
    </a>
    <a href="<?= base_url('admin/kontak') ?>" class="quick-link">
        <i class="fas fa-address-book"></i>
        <span>Kontak</span>
    </a>
    <a href="<?= base_url('admin/struktur') ?>" class="quick-link">
        <i class="fas fa-sitemap"></i>
        <span>Struktur Organisasi</span>
    </a>
</div>

<?= $this->endSection() ?>