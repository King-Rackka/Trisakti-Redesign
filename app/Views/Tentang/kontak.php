<?= $this->extend('layout/main') ?>
<?= $this->section('styles') ?>
<style>
    .breadcrumb-bar{background:#eef2f9;padding:14px 0;border-bottom:1px solid #dde4f0;}
    .breadcrumb-inner{max-width:1280px;margin:0 auto;padding:0 24px;display:flex;justify-content:space-between;align-items:center;}
    .breadcrumb-title{font-size:20px;font-weight:600;color:var(--navy);}
    .breadcrumb-path{font-size:12px;color:var(--gray-text);}
    .breadcrumb-path a{color:var(--gray-text);text-decoration:none;}
    .breadcrumb-path span{color:var(--navy);font-weight:500;}

    .tentang-wrap{max-width:1280px;margin:0 auto;padding:40px 24px 60px;display:grid;grid-template-columns:260px 1fr;gap:32px;align-items:start;}

    .tentang-sidebar{background:#fff;border:1px solid var(--gray-mid);border-radius:8px;overflow:hidden;}
    .tentang-sidebar-title{background:var(--navy);color:#fff;font-size:13px;font-weight:600;padding:14px 18px;}
    .tentang-sidebar ul{list-style:none;padding:6px 0;}
    .tentang-sidebar ul li a{display:block;padding:10px 18px;font-size:13px;color:var(--text-dark);border-left:3px solid transparent;transition:all 0.15s;text-decoration:none;}
    .tentang-sidebar ul li a:hover{background:var(--gray-light);color:var(--navy);}
    .tentang-sidebar ul li a.active{background:var(--gray-light);color:var(--navy);font-weight:600;border-left-color:var(--navy);}

    .konten-title{font-size:22px;font-weight:700;color:var(--navy);margin-bottom:8px;}
    .konten-underline{width:48px;height:3px;background:var(--navy);margin-bottom:28px;}

    .kontak-list{list-style:none;padding:0;}
    .kontak-list li{
        display:flex;align-items:flex-start;gap:0;
        padding:10px 0;border-bottom:1px solid var(--gray-mid);
        font-size:14px;line-height:1.7;color:var(--text-dark);
    }
    .kontak-list li:last-child{border-bottom:none;}

    .sosmed-wrap{margin-top:28px;}
    .sosmed-wrap h3{font-size:13px;font-weight:600;color:var(--navy);margin-bottom:14px;}
    .sosmed-btns{display:flex;gap:10px;flex-wrap:wrap;}
    .sosmed-btn{
        display:flex;align-items:center;gap:8px;
        padding:8px 16px;border-radius:6px;
        border:1px solid var(--gray-mid);
        font-size:13px;color:var(--text-dark);
        text-decoration:none;transition:all 0.15s;
    }
    .sosmed-btn:hover{border-color:var(--navy);color:var(--navy);background:var(--gray-light);}
    .sosmed-btn i{font-size:15px;}

    .map-wrap{margin-top:32px;border-radius:8px;overflow:hidden;border:1px solid var(--gray-mid);}
    .map-wrap iframe{width:100%;height:320px;border:none;display:block;}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="breadcrumb-bar">
    <div class="breadcrumb-inner">
        <div class="breadcrumb-title">Hubungi Kami</div>
        <div class="breadcrumb-path">
            <a href="<?= base_url('/') ?>">Beranda</a> &gt;
            <span>Hubungi Kami</span>
        </div>
    </div>
</div>

<div class="tentang-wrap">
    <aside class="tentang-sidebar">
        <div class="tentang-sidebar-title">Tentang Trisakti</div>
        <ul>
            <?php foreach ($sidebar_menu as $menu): ?>
            <li>
                <a href="<?= base_url($menu['url']) ?>"
                   class="<?= $active === $menu['url'] ? 'active' : '' ?>">
                    <?= esc($menu['label']) ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </aside>

    <div>
        <h1 class="konten-title">Hubungi Kami</h1>
        <div class="konten-underline"></div>

        <ul class="kontak-list">
            <?php if (!empty($kontak['alamat'])): ?>
            <li><?= esc($kontak['alamat']) ?></li>
            <?php endif; ?>
            <?php if (!empty($kontak['telepon'])): ?>
            <li>Phone: <?= esc($kontak['telepon']) ?></li>
            <?php endif; ?>
            <?php if (!empty($kontak['whatsapp'])): ?>
            <li>Whatsapp: <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $kontak['whatsapp']) ?>" target="_blank"><?= esc($kontak['whatsapp']) ?></a></li>
            <?php endif; ?>
            <?php if (!empty($kontak['fax'])): ?>
            <li>Fax: <?= esc($kontak['fax']) ?></li>
            <?php endif; ?>
            <?php if (!empty($kontak['email'])): ?>
            <li>Email: <a href="mailto:<?= esc($kontak['email']) ?>"><?= esc($kontak['email']) ?></a></li>
            <?php endif; ?>
        </ul>

        <div class="sosmed-wrap">
            <h3>Media Sosial</h3>
            <div class="sosmed-btns">
                <?php if (!empty($kontak['facebook'])): ?>
                <a href="<?= esc($kontak['facebook']) ?>" target="_blank" class="sosmed-btn">
                    <i class="fab fa-facebook-f" style="color:#1877f2"></i> Facebook
                </a>
                <?php endif; ?>
                <?php if (!empty($kontak['instagram'])): ?>
                <a href="<?= esc($kontak['instagram']) ?>" target="_blank" class="sosmed-btn">
                    <i class="fab fa-instagram" style="color:#e1306c"></i> Instagram
                </a>
                <?php endif; ?>
                <?php if (!empty($kontak['twitter'])): ?>
                <a href="<?= esc($kontak['twitter']) ?>" target="_blank" class="sosmed-btn">
                    <i class="fab fa-x-twitter"></i> Twitter / X
                </a>
                <?php endif; ?>
                <?php if (!empty($kontak['youtube'])): ?>
                <a href="<?= esc($kontak['youtube']) ?>" target="_blank" class="sosmed-btn">
                    <i class="fab fa-youtube" style="color:#ff0000"></i> YouTube
                </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- <div class="map-wrap">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.79777931476917!3d-6.1681382620820145!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f7078a9b8c7f%3A0x7d3d6df6d96c4b8e!2sUniversitas%20Trisakti!5e0!3m2!1sid!2sid!4v1620000000000!5m2!1sid!2sid"
                allowfullscreen="" loading="lazy">
            </iframe>
        </div> -->
    </div>
</div>

<?= $this->endSection() ?>