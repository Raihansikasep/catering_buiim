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
    --text-dark: #111A10;
    --text-mid: #3D5040;
    --text-muted: #7A8F7C;
    --white: #FFFFFF;
    --border: rgba(44,90,48,0.12);
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: 'Outfit', sans-serif; background: var(--cream); overflow-x: hidden; }

/* HERO */
.contact-hero {
    background: var(--green-deep);
    padding: 110px 0 90px;
    position: relative; overflow: hidden;
}
.contact-hero::before {
    content: '';
    position: absolute; top: -100px; right: -80px;
    width: 550px; height: 550px; border-radius: 50%;
    background: radial-gradient(circle, rgba(76,175,106,0.1), transparent 60%);
}
.contact-hero .container {
    max-width: 1200px; margin: 0 auto; padding: 0 40px;
    position: relative; z-index: 2;
    display: grid; grid-template-columns: 1fr 1fr; gap: 80px; align-items: center;
}

.hero-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    font-size: 0.7rem; font-weight: 600; letter-spacing: 0.15em;
    text-transform: uppercase; color: var(--green-accent);
    background: rgba(76,175,106,0.1); border: 1px solid rgba(76,175,106,0.2);
    padding: 7px 16px; border-radius: 30px; margin-bottom: 24px; width: fit-content;
}
.contact-hero-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(2.2rem, 4.5vw, 3.6rem);
    font-weight: 600; line-height: 1.1; color: #fff;
    letter-spacing: -0.02em; margin-bottom: 16px;
}
.contact-hero-title em { font-style: italic; color: var(--green-accent); }
.contact-hero-desc { color: rgba(255,255,255,0.5); font-size: 0.92rem; line-height: 1.85; font-weight: 300; }

.hero-contact-quick { display: flex; flex-direction: column; gap: 14px; }
.quick-contact-item {
    display: flex; align-items: center; gap: 16px;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 16px; padding: 18px 20px;
    transition: all 0.3s; text-decoration: none;
}
.quick-contact-item:hover { background: rgba(76,175,106,0.08); border-color: rgba(76,175,106,0.25); }
.qci-icon {
    width: 44px; height: 44px; border-radius: 12px;
    background: rgba(76,175,106,0.12); border: 1px solid rgba(76,175,106,0.2);
    display: flex; align-items: center; justify-content: center; font-size: 1.1rem;
    flex-shrink: 0;
}
.qci-label { font-size: 0.7rem; color: rgba(255,255,255,0.35); text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 3px; font-weight: 600; }
.qci-value { font-size: 0.9rem; color: #fff; font-weight: 500; }

/* MAIN SECTION */
.contact-main { padding: 80px 0 100px; background: var(--cream); }
.contact-main .container { max-width: 1200px; margin: 0 auto; padding: 0 40px; display: grid; grid-template-columns: 1fr 1.6fr; gap: 40px; }

/* INFO CARD */
.info-card {
    background: var(--green-deep);
    border-radius: 28px; padding: 44px 36px;
    position: relative; overflow: hidden;
    height: fit-content;
}
.info-card::before {
    content: '';
    position: absolute; top: -60px; right: -60px;
    width: 250px; height: 250px; border-radius: 50%;
    background: radial-gradient(circle, rgba(76,175,106,0.1), transparent 60%);
}
.info-card-eyebrow {
    font-size: 0.68rem; font-weight: 600; letter-spacing: 0.12em;
    text-transform: uppercase; color: var(--green-accent); margin-bottom: 12px;
}
.info-card-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.7rem; font-weight: 600; color: #fff; line-height: 1.2; margin-bottom: 8px;
}
.info-card-sub { color: rgba(255,255,255,0.4); font-size: 0.82rem; line-height: 1.7; font-weight: 300; margin-bottom: 36px; }

.info-item { display: flex; align-items: flex-start; gap: 14px; margin-bottom: 20px; }
.info-item:last-of-type { margin-bottom: 0; }
.info-icon {
    width: 40px; height: 40px; border-radius: 12px;
    background: rgba(76,175,106,0.12); border: 1px solid rgba(76,175,106,0.2);
    display: flex; align-items: center; justify-content: center; font-size: 0.95rem; flex-shrink: 0;
}
.info-item-label { font-size: 0.68rem; color: rgba(255,255,255,0.35); font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 3px; }
.info-item-value { font-size: 0.88rem; color: #fff; font-weight: 500; }

.divider-incard { border: none; border-top: 1px solid rgba(255,255,255,0.08); margin: 28px 0; }

.btn-wa-cta {
    display: flex; align-items: center; justify-content: center; gap: 10px;
    width: 100%; padding: 15px;
    background: var(--green-accent); color: var(--green-deep);
    border: none; border-radius: 14px;
    font-size: 0.9rem; font-weight: 700; cursor: pointer;
    text-decoration: none; transition: all 0.3s;
    font-family: 'Outfit', sans-serif;
}
.btn-wa-cta:hover { background: #fff; transform: translateY(-2px); }

/* FORM CARD */
.form-card {
    background: var(--white);
    border-radius: 28px; border: 1px solid var(--border); padding: 44px 40px;
}
.form-card-eyebrow {
    font-size: 0.68rem; font-weight: 600; letter-spacing: 0.12em;
    text-transform: uppercase; color: var(--green-bright); margin-bottom: 12px;
}
.form-card-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.7rem; font-weight: 600; color: var(--text-dark); margin-bottom: 6px;
}
.form-card-sub { color: var(--text-muted); font-size: 0.82rem; line-height: 1.7; font-weight: 300; margin-bottom: 32px; }

.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px; }
.form-group { margin-bottom: 20px; }
.form-group:last-child { margin-bottom: 0; }
.form-label {
    display: block; font-size: 0.75rem; font-weight: 700;
    color: var(--text-mid); margin-bottom: 8px; letter-spacing: 0.03em;
}
.form-control-premium {
    width: 100%; padding: 13px 18px;
    border-radius: 14px; border: 1.5px solid var(--border);
    font-size: 0.88rem; color: var(--text-dark);
    font-family: 'Outfit', sans-serif; background: var(--cream);
    outline: none; transition: all 0.2s;
}
.form-control-premium:focus { border-color: var(--green-bright); background: var(--white); box-shadow: 0 0 0 4px rgba(45,122,58,0.08); }
.form-control-premium::placeholder { color: var(--text-muted); font-weight: 300; }
textarea.form-control-premium { resize: none; }

.btn-send-form {
    width: 100%; padding: 15px; background: var(--green-deep);
    color: #fff; border: none; border-radius: 14px;
    font-size: 0.9rem; font-weight: 700; cursor: pointer;
    font-family: 'Outfit', sans-serif; transition: all 0.3s;
    display: flex; align-items: center; justify-content: center; gap: 10px;
}
.btn-send-form:hover { background: var(--green-bright); transform: translateY(-2px); box-shadow: 0 12px 32px rgba(12,34,16,0.2); }

/* MAP */
.map-section { position: relative; }
.map-section iframe { width: 100%; height: 440px; border: none; display: block; filter: saturate(0.8) brightness(0.95); }
.map-card-overlay {
    position: absolute; top: 28px; left: 40px;
    background: var(--white); border-radius: 20px; padding: 18px 22px;
    box-shadow: 0 16px 48px rgba(12,34,16,0.15);
    border: 1px solid var(--border);
}
.map-card-overlay .name {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.05rem; font-weight: 600; color: var(--text-dark); margin-bottom: 4px;
}
.map-card-overlay .addr { font-size: 0.75rem; color: var(--text-muted); line-height: 1.5; }
.map-card-overlay .green-dot {
    width: 8px; height: 8px; border-radius: 50%;
    background: var(--green-accent); display: inline-block; margin-right: 6px;
}

/* Animations */
.fade-up { opacity: 0; transform: translateY(24px); transition: opacity 0.6s ease, transform 0.6s ease; }
.fade-up.visible { opacity: 1; transform: translateY(0); }
.fade-up-delay-1 { transition-delay: 0.1s; }
.fade-up-delay-2 { transition-delay: 0.2s; }

@media (max-width: 1024px) {
    .contact-hero .container { grid-template-columns: 1fr; gap: 40px; }
    .contact-main .container { grid-template-columns: 1fr; }
}
@media (max-width: 768px) {
    .contact-hero { padding: 80px 0 60px; }
    .contact-hero .container, .contact-main .container { padding: 0 24px; }
    .contact-main { padding: 60px 0 80px; }
    .form-card, .info-card { padding: 32px 24px; }
    .form-row { grid-template-columns: 1fr; gap: 0; }
    .map-card-overlay { display: none; }
    .map-section iframe { height: 320px; }
}
</style>

<div class="contact-page">

{{-- HERO --}}
<div class="contact-hero">
    <div class="container">
        <div class="fade-up">
            <div class="hero-eyebrow">Hubungi Kami</div>
            <h1 class="contact-hero-title">
                Ada yang Ingin<br><em>Ditanyakan?</em>
            </h1>
            <p class="contact-hero-desc">Punya pertanyaan atau ingin pesan catering? Hubungi kami langsung melalui WhatsApp — kami siap membantu kapan saja.</p>
        </div>
        <div class="hero-contact-quick fade-up fade-up-delay-1">
            <a href="https://wa.me/6282129539896" target="_blank" class="quick-contact-item">
                <div class="qci-icon">💬</div>
                <div>
                    <div class="qci-label">WhatsApp</div>
                    <div class="qci-value">+62 821 2953 9896</div>
                </div>
            </a>
            <div class="quick-contact-item">
                <div class="qci-icon">📍</div>
                <div>
                    <div class="qci-label">Lokasi</div>
                    <div class="qci-value">Baleendah, Kab. Bandung</div>
                </div>
            </div>
            <div class="quick-contact-item">
                <div class="qci-icon">🕐</div>
                <div>
                    <div class="qci-label">Jam Operasional</div>
                    <div class="qci-value">Setiap hari, 07.00 – 21.00</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MAIN --}}
<div class="contact-main">
    <div class="container">

        {{-- INFO CARD --}}
        <div class="info-card fade-up">
            <div class="info-card-eyebrow">Informasi Kontak</div>
            <h3 class="info-card-title">Kami Siap<br>Melayani Anda</h3>
            <p class="info-card-sub">Jangan ragu untuk menghubungi kami kapan saja. Kami akan merespons dengan cepat.</p>

            <div class="info-item">
                <div class="info-icon">📍</div>
                <div>
                    <div class="info-item-label">Lokasi</div>
                    <div class="info-item-value">Baleendah, Kabupaten Bandung</div>
                </div>
            </div>
            <div class="info-item">
                <div class="info-icon">📞</div>
                <div>
                    <div class="info-item-label">Telepon / WA</div>
                    <div class="info-item-value">+62 821 2953 9896</div>
                </div>
            </div>
            <div class="info-item">
                <div class="info-icon">🕐</div>
                <div>
                    <div class="info-item-label">Jam Operasional</div>
                    <div class="info-item-value">Setiap hari, 07.00 – 21.00</div>
                </div>
            </div>

            <hr class="divider-incard">

            <a href="https://wa.me/6282129539896" target="_blank" class="btn-wa-cta">
                💬 Chat WhatsApp Sekarang
            </a>
        </div>

        {{-- FORM CARD --}}
        <div class="form-card fade-up fade-up-delay-1">
            <div class="form-card-eyebrow">Kirim Pesan</div>
            <h3 class="form-card-title">Pesan via WhatsApp</h3>
            <p class="form-card-sub">Isi form di bawah dan pesan Anda akan langsung dikirim via WhatsApp. Mudah dan cepat!</p>

            <div class="form-row">
                <div class="form-group" style="margin-bottom:0">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" id="nama" class="form-control-premium" placeholder="Masukkan nama Anda">
                </div>
                <div class="form-group" style="margin-bottom:0">
                    <label class="form-label">No HP / WhatsApp</label>
                    <input type="text" id="telepon" class="form-control-premium" placeholder="08xxxxxxxxxx">
                </div>
            </div>

            <div class="form-group" style="margin-top:20px;">
                <label class="form-label">Subjek / Jenis Pesanan</label>
                <input type="text" id="subjek" class="form-control-premium" placeholder="Misal: Nasi Box 50 porsi untuk acara...">
            </div>

            <div class="form-group">
                <label class="form-label">Pesan atau Detail Pesanan</label>
                <textarea id="pesan" class="form-control-premium" rows="5" placeholder="Tulis detail pesanan Anda, termasuk tanggal, jumlah porsi, menu yang diinginkan, dan informasi lainnya..."></textarea>
            </div>

            <button onclick="kirimWA()" class="btn-send-form">
                Kirim via WhatsApp →
            </button>
        </div>

    </div>
</div>

{{-- MAP --}}
<div class="map-section">
    <div class="map-card-overlay">
        <div class="name"><span class="green-dot"></span>Dapur Bu Iim</div>
        <div class="addr">Baleendah, Kabupaten Bandung,<br>Jawa Barat</div>
    </div>
    <iframe
        loading="lazy"
        allowfullscreen
        referrerpolicy="no-referrer-when-downgrade"
        src="https://maps.google.com/maps?q=Baleendah,%20Kabupaten%20Bandung&t=&z=14&ie=UTF8&iwloc=&output=embed">
    </iframe>
</div>

</div>

<script>
function kirimWA() {
    const nama    = document.getElementById('nama').value.trim();
    const telepon = document.getElementById('telepon').value.trim();
    const subjek  = document.getElementById('subjek').value.trim();
    const pesan   = document.getElementById('pesan').value.trim();
    if (!nama || !pesan) { alert('Mohon isi nama dan pesan terlebih dahulu.'); return; }
    const text = encodeURIComponent(`Halo Dapur Bu Iim,\n\nNama: ${nama}\nNo HP: ${telepon}\nSubjek: ${subjek}\n\n${pesan}`);
    window.open(`https://wa.me/6282129539896?text=${text}`, '_blank');
}
const observer = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
}, { threshold: 0.1 });
document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
</script>

@endsection
