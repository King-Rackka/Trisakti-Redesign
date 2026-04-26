<?= $this->extend('layout/main') ?>
<?= $this->section('styles') ?>
<style>
    .hero {
        position: relative;
        width: 100%;
        height: 620px;
        overflow: hidden;
        background: var(--navy-dark);
    }
    .hero-slide { position: absolute; inset: 0; opacity: 0; transition: opacity 1s ease; }
    .hero-slide.active { opacity: 1; }
    .hero-slide-bg {
        width: 100%; height: 100%;
        background-size: cover; background-position: center;
        transform: scale(1.05); transition: transform 6s ease;
    }
    .hero-slide.active .hero-slide-bg { transform: scale(1); }
    .hero-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(105deg, rgba(10,18,45,0.88) 0%, rgba(10,18,45,0.5) 55%, rgba(10,18,45,0.15) 100%);
    }
    .hero-content {
        position: absolute;
        top: 50%; left: 0; right: 0;
        transform: translateY(-50%);
        max-width: 1280px; margin: 0 auto; padding: 0 80px;
    }
    .hero-eyebrow { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; }
    .hero-eyebrow-line { width: 40px; height: 2px; background: #fff; }
    .hero-eyebrow span {
        font-family: 'DM Sans', sans-serif;
        font-size: 12px; font-weight: 600;
        letter-spacing: 3px; text-transform: uppercase;
        color: rgba(255,255,255,0.85);             
    }
    .hero-title {
        font-family: 'Playfair Display', serif;
        font-size: 58px; font-weight: 700; color: #fff;
        line-height: 1.2; max-width: 600px; margin-bottom: 20px;
    }
    .hero-title em { font-style: bold; color: #fff; opacity: 0.95; }
    .hero-subtitle {
        font-size: 16px; color: rgba(255,255,255,0.6);
        max-width: 420px; line-height: 1.7; margin-bottom: 32px;
    }
    .hero-cta {
        display: inline-flex; align-items: center; gap: 10px;
        background: #fff;                          
        color: var(--navy-dark);                    
        font-size: 13px; font-weight: 700;
        padding: 13px 28px; border-radius: 3px;
        text-decoration: none; transition: all 0.2s;
        letter-spacing: 0.5px; text-transform: uppercase;
    }
    .hero-cta:hover { background: var(--gray-light); }
    .hero-cta i { font-size: 11px; }
 
    .hero-dots { position: absolute; bottom: 32px; left: 80px; display: flex; gap: 8px; align-items: center; }
    .hero-dot { width: 28px; height: 3px; border-radius: 2px; background: rgba(255,255,255,0.3); cursor: pointer; transition: all 0.3s; }
    .hero-dot.active { background: #fff; width: 44px; } /* ← putih, bukan kuning */
    .hero-counter {
        position: absolute; bottom: 28px; right: 80px;
        font-size: 13px; color: rgba(255,255,255,0.45);
    }
    .hero-counter span { color: #fff; font-weight: 600; font-size: 16px; }
 
    .stats-section { background: var(--navy); }
    .stats-grid {
        max-width: 1280px; margin: 0 auto; padding: 0 24px;
        display: grid; grid-template-columns: repeat(5, 1fr);
    }
    .stat-item {
        padding: 28px 20px;
        border-right: 1px solid rgba(255,255,255,0.1);
        text-align: center;
    }
    .stat-item:last-child { border-right: none; }
    .stat-num {
        font-size: 32px; font-weight: 700;
        color: #fff;                                
        line-height: 1; margin-bottom: 6px;
    }
    .stat-lbl {
        font-size: 11px; font-weight: 600;
        color: rgba(255,255,255,0.45);
        text-transform: uppercase; letter-spacing: 1px;
    }
 
    .fakultas-section { padding: 72px 0 0; }
    .section-wrap { max-width: 1280px; margin: 0 auto; padding: 0 24px; }
 
    .section-label {
        font-size: 11px; font-weight: 700;
        letter-spacing: 3px; text-transform: uppercase;
        color: var(--blue-mid); margin-bottom: 8px;
    }
    .section-title {
        font-family: 'Playfair Display', serif;
        font-size: 32px; font-weight: 700;
        color: var(--navy); margin-bottom: 4px;
    }
    .section-line { width: 48px; height: 3px; background: var(--navy); margin-bottom: 36px; }
 
    .section-label--light { color: rgba(255,255,255,0.7); }
    .section-title--light { color: #fff; }
    .section-line--light  { background: rgba(255,255,255,0.4); }
 
    .fak-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
        margin-bottom: 14px;
    }
    .fak-grid-bottom {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 14px;
        max-width: 320px;
        margin: 0 auto;
    }
    .fak-card {
    display: flex;
    align-items: center;
    gap: 0;
    background: #fff;
    border: 0.5px solid rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    overflow: hidden;
    text-decoration: none;
    transition: transform 0.15s, box-shadow 0.15s;
}
.fak-card:hover {
    transform: translateX(4px);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.07);
    border-color: var(--fak);
}
/* Strip warna di sisi kiri — pakai CSS variable dari inline style */
.fak-strip {
    display: block;
    width: 4px;
    align-self: stretch;
    background: var(--fak, #1a3a6b);
    flex-shrink: 0;
}
.fak-nama {
    display: block;
    padding: 14px 18px;
    font-size: 14px;
    color: #1f2937;
    font-weight: 500;
}
.fak-card:hover .fak-nama {
    color: var(--fak, #1a3a6b);
}
 
    .profil-section { background: #f7f9fd; padding: 72px 0; }
    .profil-inner { display: grid; grid-template-columns: 1fr 1fr; gap: 56px; align-items: center; }
    .profil-video {
        border-radius: 10px; overflow: hidden;
        aspect-ratio: 16/9; background: #000;
        box-shadow: 0 16px 48px rgba(26,46,90,0.12);
    }
    .profil-video iframe { width: 100%; height: 100%; border: none; display: block; }
    .profil-text p {
        font-size: 15px; line-height: 1.85; color: #4a5568;
        margin-bottom: 24px;
        display: -webkit-box; -webkit-line-clamp: 7;
        -webkit-box-orient: vertical; overflow: hidden;
    }
    .btn-outline-navy {
        display: inline-flex; align-items: center; gap: 8px;
        border: 2px solid var(--navy); color: var(--navy);
        font-size: 13px; font-weight: 700;
        padding: 11px 24px; border-radius: 3px;
        text-decoration: none; text-transform: uppercase;
        letter-spacing: 0.5px; transition: all 0.2s;
    }
    .btn-outline-navy:hover { background: var(--navy); color: #fff; }
 
    .rektor-section {
        background: var(--navy-dark);
        padding: 72px 0;
        position: relative; overflow: hidden;
    }
    .rektor-section::before {
        content: ''; position: absolute; top: -80px; right: -80px;
        width: 400px; height: 400px; border-radius: 50%;
        background: rgba(255,255,255,0.02);
    }
    .rektor-inner { display: grid; grid-template-columns: 1fr 340px; gap: 64px; align-items: center; }
    .rektor-section .section-label { color: rgba(255,255,255,0.6); }
    .rektor-section .section-title { color: #fff; font-family: 'Playfair Display', serif; }
    .rektor-section .section-line  { background: rgba(255,255,255,0.35); } /* ← putih semi, bukan kuning */
    .rektor-text h3 {
        font-family: 'Playfair Display', serif;
        font-size: 28px; font-weight: 700; color: #fff; margin-bottom: 6px;
    }
    .rektor-jabatan {
        font-size: 13px; color: rgba(255,255,255,0.55); /* ← putih redup, bukan kuning */
        font-weight: 600; text-transform: uppercase;
        letter-spacing: 1px; margin-bottom: 24px;
    }
    .rektor-text p { font-size: 15px; line-height: 1.85; color: rgba(255,255,255,0.6); margin-bottom: 28px; }
 
    .btn-accent {
        display: inline-flex; align-items: center; gap: 8px;
        background: #e53935; color: #fff;
        font-size: 13px; font-weight: 700;
        padding: 11px 24px; border-radius: 3px;
        text-decoration: none; text-transform: uppercase;
        letter-spacing: 0.5px; transition: background 0.2s;
    }
    .btn-accent:hover { background: #c62828; }
    .rektor-img img { width: 100%; height: 400px; object-fit: cover; object-position: top; display: block; border-radius: 8px; }
    .rektor-img-placeholder {
        width: 100%; height: 400px;
        background: rgba(255,255,255,0.05); border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        color: rgba(255,255,255,0.2); font-size: 13px;
    }
 
    .berita-section { padding: 72px 0; }
    .berita-header { display: flex; align-items: flex-end; justify-content: space-between; margin-bottom: 36px; }
    .berita-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }
    .berita-card {
        border-radius: 8px; overflow: hidden; background: #fff;
        border: 1px solid #e0e8f4; text-decoration: none;
        display: flex; flex-direction: column; transition: all 0.25s;
    }
    .berita-card:hover { transform: translateY(-4px); box-shadow: 0 12px 32px rgba(26,46,90,0.10); }
    .berita-card-img {
        height: 180px;
        background: var(--navy);
        overflow: hidden; flex-shrink: 0;
    }
    .berita-card-img img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .berita-card-body { padding: 18px; flex: 1; display: flex; flex-direction: column; }
    .berita-card-date {
        font-size: 11px; color: var(--gray-text);
        text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;
    }
    .berita-card-title { font-size: 14px; font-weight: 600; color: var(--text-dark); line-height: 1.5; flex: 1; margin-bottom: 14px; }
    .berita-card-more {
        display: flex; align-items: center; gap: 6px;
        font-size: 12px; color: var(--blue-mid);
        font-weight: 600; text-transform: uppercase;
        letter-spacing: 0.5px; margin-top: auto;
    }
    .berita-card-more i { font-size: 10px; transition: transform 0.2s; }
    .berita-card:hover .berita-card-more i { transform: translateX(4px); }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- ===== HERO ===== -->
<section class="hero" id="hero">
    <div class="hero-slide active">
        <div class="hero-slide-bg" style="background-image:url('<?= base_url('assets/home-1.png') ?>')"></div>
    </div>
    <div class="hero-slide">
        <div class="hero-slide-bg" style="background-image:url('<?= base_url('assets/home-2.jpg') ?>')"></div>
    </div>
    <div class="hero-slide">
        <div class="hero-slide-bg" style="background-image:url('<?= base_url('assets/home-3.png') ?>')"></div>
    </div>
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="hero-eyebrow">
            <div class="hero-eyebrow-line"></div>
            <span>Universitas Trisakti</span>
        </div>
        <h1 class="hero-title">
            The New Generation<br>of <em>Entrepreneur</em>
        </h1>
        <p class="hero-subtitle">Berdiri sejak 1965, membentuk generasi unggul yang berdaulat, berdikari, dan berkepribadian.</p>
    </div>
    <div class="hero-dots">
        <div class="hero-dot active" onclick="goToSlide(0)"></div>
        <div class="hero-dot" onclick="goToSlide(1)"></div>
        <div class="hero-dot" onclick="goToSlide(2)"></div>
    </div>
    <div class="hero-counter">
        <span id="slideNum">01</span> / 03
    </div>
</section>

<!-- ===== STATS ===== -->
<section class="stats-section">
    <div class="stats-grid">
        <div class="stat-item">
            <div class="stat-num">18.110</div>
            <div class="stat-lbl">Mahasiswa Aktif</div>
        </div>
        <div class="stat-item">
            <div class="stat-num">9 & 51</div>
            <div class="stat-lbl">Fakultas & Prodi</div>
        </div>
        <div class="stat-item">
            <div class="stat-num">76</div>
            <div class="stat-lbl">Guru Besar</div>
        </div>
        <div class="stat-item">
            <div class="stat-num">139</div>
            <div class="stat-lbl">Lektor Kepala</div>
        </div>
        <div class="stat-item">
            <div class="stat-num">342</div>
            <div class="stat-lbl">Pengajar</div>
        </div>
    </div>
</section>

<section class="fakultas-section">
    <div class="section-wrap">
        <div class="section-label">Akademik</div>
        <div class="section-title">Fakultas</div>
        <div class="section-line"></div>
 
        <div class="fak-grid">
            <?php if (!empty($fakultas)) : ?>
                <?php foreach ($fakultas as $item) : ?>
                <?php
                    $warna = esc($item['warna'] ?? '#1a3a6b');
                ?>
                <a href="<?= base_url('fakultas/' . $item['slug']) ?>"
                   class="fak-card"
                   style="--fak: <?= $warna ?>;">
                    <span class="fak-strip"></span>
                    <span class="fak-nama"><?= esc($item['nama']) ?></span>
                </a>
                <?php endforeach; ?>
            <?php else : ?>
                <p style="color:#9ca3af; font-size:13px; grid-column:1/-1;">Belum ada fakultas.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="profil-section">
    <div class="section-wrap">
        <div class="profil-inner">
            <div class="profil-video">
                <iframe
                    src="https://www.youtube.com/embed/5OVNGs66fQ0"
                    title="Profil Universitas Trisakti"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
            </div>
            <div class="profil-text">
                <div class="section-label">Tentang Kami</div>
                <div class="section-title">Profil Universitas Trisakti</div>
                <div class="section-line"></div>
                <p><?= nl2br(esc((string)($profil['sejarah'] ?? 'Universitas Trisakti merupakan satu-satunya perguruan tinggi swasta di Indonesia yang didirikan oleh Pemerintah Republik Indonesia pada tanggal 29 November 1965.'))) ?></p>
                <a href="<?= base_url('tentang/sejarah') ?>" class="btn-outline-navy">
                    Selengkapnya <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="rektor-section">
    <div class="section-wrap">
        <div class="rektor-inner">
            <div class="rektor-text">
                <div class="section-label" style="color:var(--accent);">Sambutan</div>
                <div class="section-title" style="color:#fff;font-family:'Playfair Display',serif;">Sambutan Rektor</div>
                <div class="section-line"></div>
                <h3>Prof. Dr. Ir. Kadarsah Suryadi, DEA</h3>
                <div class="rektor-jabatan">Rektor Universitas Trisakti</div>
                <p>Perkembangan Universitas Trisakti dimulai dengan pendirian Universitas Trisakti oleh Pemerintah Republik pada tanggal 29 November 1965 berdasarkan Surat Keputusan Menteri PTIP Nomor 013/dar/1965 yang ditandatangani oleh Dr. Sjarief Thajeb. Adapun nama Universitas Trisakti diberikan oleh Presiden Soekarno yang mempunyai arti berdaulat dibidang politik, berdikari dibidang ekonomi dan berkepribadian dalam kebudayaan.</p>
            </div>
            <div class="rektor-img">
                <div class="rektor-img-placeholder">
                    <img src="<?= base_url('assets/foto-rektor.png') ?>" alt="Foto Rektor">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="berita-section">
    <div class="section-wrap">
        <div class="berita-header">
            <div>
                <div class="section-label">Terkini</div>
                <div class="section-title">Agenda</div>
                <div class="section-line"></div>
            </div>
            <a href="<?= base_url('agenda') ?>" class="btn-accent" style="margin-bottom:36px;">
                Lihat Semua <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        <div class="berita-grid">
            <?php if (!empty($agenda)): ?>
                <?php foreach ($agenda as $item): ?>
                <a href="<?= base_url('agenda/' . $item['slug']) ?>" class="berita-card">
                    <div class="berita-card-img">
                        <?php if (!empty($item['gambar'])): ?>
                            <img src="<?= base_url('assets/agenda/' . $item['gambar']) ?>" alt="<?= esc($item['judul']) ?>">
                        <?php endif; ?>
                    </div>
                    <div class="berita-card-body">
                        <div class="berita-card-date"><?= date('l, d F Y', strtotime($item['tanggal'])) ?></div>
                        <div class="berita-card-title"><?= esc(character_limiter($item['judul'])) ?></div>
                        <div class="berita-card-more">Selengkapnya <i class="fas fa-arrow-right"></i></div>
                    </div>
                </a>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="color:var(--gray-text);font-size:13px;grid-column:1/-1;">Belum ada agenda.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="berita-section">
    <div class="section-wrap">
        <div class="berita-header">
            <div>
                <div class="section-label">Terkini</div>
                <div class="section-title">Berita</div>
                <div class="section-line"></div>
            </div>
            <a href="<?= base_url('news') ?>" class="btn-accent" style="margin-bottom:36px;">
                Lihat Semua <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        <div class="berita-grid">
            <?php if (!empty($berita)): ?>
                <?php foreach ($berita as $item): ?>
                <a href="<?= base_url('assets/news/' . $item['slug']) ?>" class="berita-card">
                    <div class="berita-card-img">
                        <?php if (!empty($item['gambar'])): ?>
                            <img src="<?= base_url('assets/news/' . $item['gambar']) ?>" alt="<?= esc($item['judul']) ?>">
                        <?php endif; ?>
                    </div>
                    <div class="berita-card-body">
                        <div class="berita-card-date"><?= date('l, d F Y', strtotime($item['tanggal'])) ?></div>
                        <div class="berita-card-title"><?= esc(character_limiter($item['judul'])) ?></div>
                        <div class="berita-card-more">Selengkapnya <i class="fas fa-arrow-right"></i></div>
                    </div>
                </a>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="color:var(--gray-text);font-size:13px;grid-column:1/-1;">Belum ada berita.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    let cur = 0;
    const slides = document.querySelectorAll('.hero-slide');
    const dots   = document.querySelectorAll('.hero-dot');
    const nums   = ['01','02','03'];
    let timer    = setInterval(() => changeSlide(1), 6000);

    function goToSlide(i) {
        slides[cur].classList.remove('active');
        dots[cur].classList.remove('active');
        cur = i;
        slides[cur].classList.add('active');
        dots[cur].classList.add('active');
        document.getElementById('slideNum').textContent = nums[cur];
    }
    function changeSlide(dir) {
        clearInterval(timer);
        goToSlide((cur + dir + slides.length) % slides.length);
        timer = setInterval(() => changeSlide(1), 6000);
    }
</script>
<?= $this->endSection() ?>