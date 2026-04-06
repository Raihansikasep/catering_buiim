@extends('layouts.frontend')
@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=Outfit:wght@300;400;500;600;700&display=swap');

:root {
    --cream: #FAF7F2;
    --green-deep: #0C2210;
    --green-mid: #1A4A22;
    --green-bright: #2D7A3A;
    --green-accent: #4CAF6A;
    --green-light: #E8F5E9;
    --gold: #C9A84C;
    --text-dark: #111A10;
    --text-mid: #3D5040;
    --text-muted: #7A8F7C;
    --white: #FFFFFF;
    --border: rgba(44,90,48,0.12);
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: 'Outfit', sans-serif; background: var(--cream); color: var(--text-dark); overflow-x: hidden; }

/* ===== HERO ===== */
.about-hero {
    background: var(--green-deep);
    padding: 120px 0 90px;
    position: relative;
    overflow: hidden;
}
.about-hero::before {
    content: '';
    position: absolute;
    top: -100px; right: -100px;
    width: 600px; height: 600px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(76,175,106,0.1), transparent 60%);
}
.about-hero::after {
    content: '';
    position: absolute;
    bottom: -60px; left: 30%;
    width: 300px; height: 300px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(76,175,106,0.06), transparent 60%);
}
.about-hero .container {
    max-width: 1200px; margin: 0 auto;
    padding: 0 40px;
    position: relative; z-index: 2;
    display: grid; grid-template-columns: 1fr 1fr;
    gap: 80px; align-items: center;
}

.hero-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    font-size: 0.7rem; font-weight: 600; letter-spacing: 0.15em;
    text-transform: uppercase; color: var(--green-accent);
    background: rgba(76,175,106,0.1);
    border: 1px solid rgba(76,175,106,0.2);
    padding: 7px 16px; border-radius: 30px;
    margin-bottom: 24px;
    width: fit-content;
}
.about-hero-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(2.5rem, 5vw, 4rem);
    font-weight: 600; line-height: 1.1;
    color: #fff; letter-spacing: -0.02em;
    margin-bottom: 20px;
}
.about-hero-title em { font-style: italic; color: var(--green-accent); }
.about-hero-desc {
    color: rgba(255,255,255,0.55);
    font-size: 0.95rem; line-height: 1.85;
    font-weight: 300;
}

.hero-stats-grid {
    display: grid; grid-template-columns: 1fr 1fr;
    gap: 16px;
}
.hero-stat-card {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 16px;
    padding: 24px 20px;
    transition: all 0.3s;
}
.hero-stat-card:hover { background: rgba(76,175,106,0.08); border-color: rgba(76,175,106,0.2); }
.hero-stat-card .num {
    font-family: 'Cormorant Garamond', serif;
    font-size: 2.6rem; font-weight: 700;
    color: var(--green-accent); line-height: 1; margin-bottom: 6px;
}
.hero-stat-card .label { font-size: 0.78rem; color: rgba(255,255,255,0.45); font-weight: 400; line-height: 1.4; }

/* ===== STORY ===== */
.story-section {
    padding: 100px 0;
    background: var(--white);
}
.story-section .container {
    max-width: 1200px; margin: 0 auto;
    padding: 0 40px;
    display: grid; grid-template-columns: 1fr 1fr;
    gap: 80px; align-items: center;
}

.story-img-stack { position: relative; }
.story-img-main {
    border-radius: 24px; overflow: hidden;
    aspect-ratio: 4/5;
    box-shadow: 0 40px 80px rgba(12,34,16,0.15);
}
.story-img-main img { width: 100%; height: 100%; object-fit: cover; }
.story-img-thumb {
    position: absolute;
    bottom: -24px; right: -24px;
    width: 200px;
    border-radius: 18px; overflow: hidden;
    border: 5px solid var(--white);
    box-shadow: 0 20px 40px rgba(12,34,16,0.15);
    aspect-ratio: 4/3;
}
.story-img-thumb img { width: 100%; height: 100%; object-fit: cover; }
.story-img-float {
    position: absolute;
    top: -16px; left: -16px;
    background: var(--green-deep);
    border-radius: 18px;
    padding: 20px;
    box-shadow: 0 16px 40px rgba(12,34,16,0.2);
}
.story-img-float .label { font-size: 0.68rem; color: rgba(255,255,255,0.4); text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 4px; }
.story-img-float .value { font-family: 'Cormorant Garamond', serif; font-size: 1.6rem; font-weight: 700; color: var(--green-accent); line-height: 1; }

.story-content {}
.section-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    font-size: 0.7rem; font-weight: 600; letter-spacing: 0.15em;
    text-transform: uppercase; color: var(--green-bright);
    margin-bottom: 16px;
}
.section-eyebrow::before {
    content: ''; display: block;
    width: 28px; height: 1.5px; background: var(--green-bright);
}
.section-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(1.8rem, 3vw, 2.6rem);
    font-weight: 600; line-height: 1.2;
    color: var(--text-dark); letter-spacing: -0.02em; margin-bottom: 20px;
}
.section-title em { font-style: italic; color: var(--green-bright); }
.section-text { color: var(--text-muted); font-size: 0.92rem; line-height: 1.9; margin-bottom: 14px; font-weight: 300; }

.check-list-premium { list-style: none; margin: 28px 0 36px; display: flex; flex-direction: column; gap: 14px; }
.check-list-premium li {
    display: flex; align-items: flex-start; gap: 14px;
    padding: 14px 16px;
    background: var(--cream);
    border-radius: 12px;
    border: 1px solid var(--border);
    transition: all 0.2s;
}
.check-list-premium li:hover { background: var(--green-light); border-color: rgba(44,90,48,0.2); }
.check-icon {
    width: 22px; height: 22px; border-radius: 50%;
    background: var(--green-light);
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; margin-top: 1px;
}
.check-icon svg { width: 11px; height: 11px; }
.check-text { font-size: 0.875rem; font-weight: 500; color: var(--text-dark); }

/* ===== COMMITMENT ===== */
.commitment-section {
    padding: 0;
    position: relative;
}
.commitment-section .container {
    max-width: 100%;
    display: grid; grid-template-columns: 1fr 1fr;
}
.commitment-left {
    background: var(--green-deep);
    padding: 90px 80px;
    position: relative; overflow: hidden;
}
.commitment-left::before {
    content: '';
    position: absolute;
    top: -80px; right: -80px;
    width: 400px; height: 400px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(76,175,106,0.1), transparent 60%);
}
.commitment-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    font-size: 0.7rem; font-weight: 600; letter-spacing: 0.15em;
    text-transform: uppercase; color: var(--green-accent);
    margin-bottom: 20px;
}
.commitment-eyebrow::before { content: ''; display: block; width: 28px; height: 1.5px; background: var(--green-accent); }
.commitment-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(2rem, 3.5vw, 3rem);
    font-weight: 600; line-height: 1.15;
    color: #fff; letter-spacing: -0.02em; margin-bottom: 20px;
}
.commitment-title em { font-style: italic; color: var(--green-accent); }
.commitment-desc { color: rgba(255,255,255,0.5); font-size: 0.92rem; line-height: 1.85; font-weight: 300; margin-bottom: 36px; }
.btn-commitment {
    display: inline-flex; align-items: center; gap: 10px;
    padding: 14px 36px; background: var(--green-accent);
    color: var(--green-deep); border-radius: 50px;
    font-size: 0.875rem; font-weight: 700;
    text-decoration: none; transition: all 0.3s;
}
.btn-commitment:hover { background: #fff; transform: translateY(-2px); }
.commitment-right {
    background: var(--green-mid);
    padding: 90px 80px;
    display: flex; flex-direction: column;
    justify-content: center; gap: 28px;
}
.commitment-item { display: flex; align-items: flex-start; gap: 16px; }
.commitment-item-num {
    font-family: 'Cormorant Garamond', serif;
    font-size: 2rem; font-weight: 700;
    color: rgba(76,175,106,0.3); line-height: 1;
    flex-shrink: 0; min-width: 40px;
}
.commitment-item-title { font-size: 0.95rem; font-weight: 600; color: #fff; margin-bottom: 6px; }
.commitment-item-desc { font-size: 0.83rem; color: rgba(255,255,255,0.45); line-height: 1.7; font-weight: 300; }

/* ===== FEATURES ===== */
.features-section {
    padding: 100px 0;
    background: var(--cream);
}
.features-section .container { max-width: 1200px; margin: 0 auto; padding: 0 40px; }
.features-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; margin-top: 56px; }

.feature-card-premium {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: 24px;
    padding: 40px 32px;
    position: relative; overflow: hidden;
    transition: all 0.3s ease;
    cursor: pointer;
}
.feature-card-premium::after {
    content: '';
    position: absolute; inset: 0;
    border-radius: 24px;
    border: 2px solid var(--green-bright);
    opacity: 0;
    transition: opacity 0.3s;
}
.feature-card-premium:hover { transform: translateY(-6px); box-shadow: 0 24px 56px rgba(12,34,16,0.1); }
.feature-card-premium:hover::after { opacity: 1; }

.feature-card-bg-num {
    font-family: 'Cormorant Garamond', serif;
    font-size: 5rem; font-weight: 700;
    color: rgba(44,90,48,0.05);
    position: absolute; top: 12px; right: 20px;
    line-height: 1; letter-spacing: -0.04em;
}
.feature-emoji {
    width: 60px; height: 60px; border-radius: 18px;
    background: var(--green-light);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.5rem; margin-bottom: 24px;
    transition: background 0.3s;
}
.feature-card-premium:hover .feature-emoji { background: var(--green-bright); }
.feature-card-title { font-weight: 700; font-size: 1.05rem; color: var(--text-dark); margin-bottom: 12px; }
.feature-card-desc { font-size: 0.85rem; color: var(--text-muted); line-height: 1.8; margin-bottom: 20px; font-weight: 300; }
.btn-feature-more {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: 0.8rem; font-weight: 600; color: var(--green-bright);
    background: none; border: none; padding: 0; cursor: pointer;
    font-family: 'Outfit', sans-serif;
    transition: gap 0.2s;
}
.btn-feature-more:hover { gap: 10px; }

/* ===== MODAL ===== */
.modal-content { border-radius: 24px; border: none; overflow: hidden; font-family: 'Outfit', sans-serif; }
.modal-header-premium {
    background: var(--green-deep); padding: 28px 32px;
    border: none; display: flex; align-items: center; justify-content: space-between;
}
.modal-header-premium .modal-title { font-family: 'Cormorant Garamond', serif; font-size: 1.4rem; color: #fff; font-weight: 600; }
.modal-header-premium .btn-close { filter: invert(1); opacity: 0.7; }
.modal-body-premium { padding: 32px; }
.modal-body-premium p { font-size: 0.9rem; color: var(--text-muted); line-height: 1.85; font-weight: 300; }
.modal-body-premium hr { border: none; border-top: 1px solid var(--border); margin: 20px 0; }

/* ANIMATIONS */
.fade-up { opacity: 0; transform: translateY(30px); transition: opacity 0.6s ease, transform 0.6s ease; }
.fade-up.visible { opacity: 1; transform: translateY(0); }
.fade-up-delay-1 { transition-delay: 0.1s; }
.fade-up-delay-2 { transition-delay: 0.2s; }
.fade-up-delay-3 { transition-delay: 0.3s; }

@media (max-width: 1024px) {
    .about-hero .container { grid-template-columns: 1fr; gap: 48px; }
    .story-section .container { grid-template-columns: 1fr; gap: 56px; }
    .commitment-section .container { grid-template-columns: 1fr; }
    .features-grid { grid-template-columns: 1fr 1fr; }
    .story-img-thumb { display: none; }
}
@media (max-width: 768px) {
    .about-hero .container, .story-section .container, .features-section .container { padding: 0 24px; }
    .about-hero { padding: 80px 0 60px; }
    .hero-stats-grid { grid-template-columns: 1fr 1fr; }
    .story-section, .features-section { padding: 70px 0; }
    .commitment-left, .commitment-right { padding: 60px 24px; }
    .features-grid { grid-template-columns: 1fr; }
}
</style>

<div class="about-page">

{{-- HERO --}}
<div class="about-hero">
    <div class="container">

        <div class="fade-up">
            <div class="hero-eyebrow">Tentang Kami</div>
            <h1 class="about-hero-title">
                Dapur Bu Iim —<br><em>Masak dengan Hati</em>
            </h1>
            <p class="about-hero-desc">
                Menghadirkan cita rasa masakan rumahan yang autentik, sehat, dan penuh kehangatan untuk setiap momen spesial Anda.
            </p>
        </div>

        <div class="hero-stats-grid fade-up fade-up-delay-2">
            <div class="hero-stat-card">
                <div class="num">5+</div>
                <div class="label">Tahun Berpengalaman</div>
            </div>
            <div class="hero-stat-card">
                <div class="num">500+</div>
                <div class="label">Pelanggan Puas</div>
            </div>
            <div class="hero-stat-card">
                <div class="num">30+</div>
                <div class="label">Pilihan Menu Tersedia</div>
            </div>
            <div class="hero-stat-card">
                <div class="num">100%</div>
                <div class="label">Bahan Segar & Alami</div>
            </div>
        </div>

    </div>
</div>


{{-- STORY --}}
<div class="story-section">
    <div class="container">

        <div class="story-img-stack fade-up">
            <div class="story-img-float">
                <div class="label">Berdiri sejak</div>
                <div class="value">2019</div>
            </div>
            <div class="story-img-main">
                <img src="img/nasbox (1).jpg" alt="Dapur Bu Iim">
            </div>
            <div class="story-img-thumb">
                <img src="img/catering lunch box (4).jpg" alt="Catering Bu Iim">
            </div>
        </div>

        <div class="story-content fade-up fade-up-delay-2">
            <div class="section-eyebrow">Cerita Kami</div>
            <h2 class="section-title">Masakan Rumahan yang<br><em>Sehat</em> & Lezat</h2>
            <p class="section-text">
                <strong style="font-weight:600; color:var(--text-dark);">Dapur Bu Iim</strong> hadir untuk memberikan pengalaman makan terbaik dengan cita rasa khas rumahan yang autentik. Kami percaya bahwa makanan yang baik bukan hanya soal rasa, tetapi juga tentang kualitas, kebersihan, dan kehangatan yang dirasakan oleh setiap pelanggan.
            </p>
            <p class="section-text">
                Dengan bahan pilihan yang segar dan proses memasak yang higienis, kami berkomitmen menghadirkan hidangan yang tidak hanya lezat, tetapi juga sehat dan aman untuk dikonsumsi setiap hari.
            </p>
            <ul class="check-list-premium">
                <li>
                    <div class="check-icon">
                        <svg viewBox="0 0 12 12" fill="none"><path d="M2 6L5 9L10 3" stroke="#2D7A3A" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    <span class="check-text">Bahan segar & berkualitas dari supplier terpercaya</span>
                </li>
                <li>
                    <div class="check-icon">
                        <svg viewBox="0 0 12 12" fill="none"><path d="M2 6L5 9L10 3" stroke="#2D7A3A" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    <span class="check-text">Masakan rumahan dengan resep autentik warisan keluarga</span>
                </li>
                <li>
                    <div class="check-icon">
                        <svg viewBox="0 0 12 12" fill="none"><path d="M2 6L5 9L10 3" stroke="#2D7A3A" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    <span class="check-text">Proses memasak higienis & standar kebersihan tinggi</span>
                </li>
                <li>
                    <div class="check-icon">
                        <svg viewBox="0 0 12 12" fill="none"><path d="M2 6L5 9L10 3" stroke="#2D7A3A" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    <span class="check-text">Rasa terjamin lezat di setiap hidangan</span>
                </li>
            </ul>
        </div>

    </div>
</div>


{{-- COMMITMENT --}}
<div class="commitment-section">
    <div class="container">

        <div class="commitment-left">
            <div class="commitment-eyebrow">Komitmen Kami</div>
            <h2 class="commitment-title">Untuk <em>Kualitas</em><br>Terbaik Setiap Hari</h2>
            <p class="commitment-desc">
                Kami selalu menghadirkan masakan rumahan dengan kualitas terbaik, menggunakan bahan segar dan proses higienis untuk memastikan setiap hidangan lezat, sehat, dan memuaskan pelanggan.
            </p>
            <a href="{{ route('product') }}" class="btn-commitment">Pesan Sekarang →</a>
        </div>

        <div class="commitment-right">
            <div class="commitment-item">
                <div class="commitment-item-num">01</div>
                <div>
                    <div class="commitment-item-title">Bahan Terpilih</div>
                    <p class="commitment-item-desc">Setiap bahan diseleksi ketat, memastikan kesegaran dan kualitas nutrisi terbaik untuk setiap hidangan.</p>
                </div>
            </div>
            <div class="commitment-item">
                <div class="commitment-item-num">02</div>
                <div>
                    <div class="commitment-item-title">Rasa Konsisten</div>
                    <p class="commitment-item-desc">Menggunakan resep yang telah teruji dan terstandarisasi untuk menjamin cita rasa yang konsisten setiap hari.</p>
                </div>
            </div>
            <div class="commitment-item">
                <div class="commitment-item-num">03</div>
                <div>
                    <div class="commitment-item-title">Kepuasan Pelanggan</div>
                    <p class="commitment-item-desc">Kepuasan Anda adalah prioritas kami. Kami selalu mendengar dan merespons kebutuhan pelanggan dengan cepat.</p>
                </div>
            </div>
        </div>

    </div>
</div>


{{-- FEATURES --}}
<div class="features-section">
    <div class="container">

        <div style="text-align:center; max-width:560px; margin:0 auto;">
            <div class="section-eyebrow" style="margin:0 auto 16px; width:fit-content;">Keunggulan Kami</div>
            <h2 class="section-title">Kenapa Pilih <em>Dapur Bu Iim?</em></h2>
            <p class="section-text" style="margin-top:12px;">Kami berkomitmen menghadirkan masakan rumahan berkualitas dengan bahan terbaik, rasa lezat, dan proses higienis.</p>
        </div>

        <div class="features-grid">

            <div class="feature-card-premium fade-up">
                <div class="feature-card-bg-num">01</div>
                <div class="feature-emoji">🌿</div>
                <div class="feature-card-title">Bahan Berkualitas</div>
                <p class="feature-card-desc">Menggunakan bahan segar pilihan dari supplier terpercaya untuk kualitas terbaik setiap hari tanpa kompromi.</p>
                <button class="btn-feature-more"
                    data-bs-toggle="modal" data-bs-target="#featureModal"
                    data-title="Bahan Berkualitas"
                    data-desc="Kami hanya menggunakan bahan segar pilihan dari supplier terpercaya."
                    data-full="Setiap bahan dipilih dengan standar tinggi, memastikan kebersihan, kesegaran, dan kualitas terbaik sehingga menghasilkan hidangan yang sehat, lezat, dan bernutrisi untuk seluruh keluarga Anda.">
                    Baca selengkapnya →
                </button>
            </div>

            <div class="feature-card-premium fade-up fade-up-delay-2">
                <div class="feature-card-bg-num">02</div>
                <div class="feature-emoji">🍱</div>
                <div class="feature-card-title">Masakan Rumahan</div>
                <p class="feature-card-desc">Cita rasa khas rumahan yang autentik dengan resep tradisional dan sentuhan profesional yang memanjakan lidah.</p>
                <button class="btn-feature-more"
                    data-bs-toggle="modal" data-bs-target="#featureModal"
                    data-title="Masakan Rumahan"
                    data-desc="Menghadirkan rasa rumahan yang autentik dan menggugah selera."
                    data-full="Setiap hidangan dimasak dengan resep tradisional dan sentuhan profesional, memberikan rasa yang familiar, lezat, dan cocok untuk semua kalangan, dari anak-anak hingga orang dewasa.">
                    Baca selengkapnya →
                </button>
            </div>

            <div class="feature-card-premium fade-up fade-up-delay-3">
                <div class="feature-card-bg-num">03</div>
                <div class="feature-emoji">✨</div>
                <div class="feature-card-title">Aman & Higienis</div>
                <p class="feature-card-desc">Proses memasak dengan standar kebersihan tinggi tanpa bahan berbahaya, aman untuk seluruh keluarga Anda.</p>
                <button class="btn-feature-more"
                    data-bs-toggle="modal" data-bs-target="#featureModal"
                    data-title="Aman & Higienis"
                    data-desc="Semua proses dilakukan dengan standar kebersihan tinggi."
                    data-full="Kami memastikan setiap proses pengolahan makanan dilakukan secara higienis tanpa bahan berbahaya, sehingga aman dikonsumsi setiap hari oleh seluruh anggota keluarga Anda termasuk anak-anak dan lansia.">
                    Baca selengkapnya →
                </button>
            </div>

        </div>
    </div>
</div>

</div>

{{-- MODAL --}}
<div class="modal fade" id="featureModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header-premium">
                <h5 class="modal-title" id="modalTitle"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body-premium">
                <p style="font-weight:500; color:var(--text-dark); margin-bottom:16px;" id="modalDesc"></p>
                <hr>
                <p id="modalFull"></p>
            </div>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('[data-bs-target="#featureModal"]').forEach(btn => {
    btn.addEventListener('click', function() {
        document.getElementById('modalTitle').textContent = this.dataset.title;
        document.getElementById('modalDesc').textContent = this.dataset.desc;
        document.getElementById('modalFull').textContent = this.dataset.full;
    });
});
const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
}, { threshold: 0.1 });
document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
</script>

@endsection
