@extends('layouts.frontend')
@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500;600&display=swap');

:root {
    --clay: #F5EFE6;
    --clay-dark: #EDE4D7;
    --warm-white: #FDFAF6;
    --ink: #1C1208;
    --ink-mid: #3D2E1A;
    --ink-soft: #7A6A56;
    --ink-ghost: #B5A898;
    --forest: #1B3A20;
    --forest-mid: #2D5C35;
    --leaf: #4B8A55;
    --mint: #A8D5A2;
    --mint-pale: #E8F5E4;
    --border-warm: rgba(60,40,20,0.1);
    --border-strong: rgba(60,40,20,0.18);
}

*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
body{font-family:'DM Sans',sans-serif;background:var(--warm-white);color:var(--ink);overflow-x:hidden}
.container-main{max-width:1280px;margin:0 auto;padding:0 48px}
@media(max-width:768px){.container-main{padding:0 20px}}

/* ── HERO ── */
.about-hero{
    background:var(--forest);
    padding:120px 0 90px;
    position:relative;overflow:hidden;
}
.about-hero::before{
    content:'';position:absolute;
    top:-120px;right:-80px;
    width:600px;height:600px;border-radius:50%;
    background:radial-gradient(circle,rgba(168,213,162,.1),transparent 62%);
}
.about-hero::after{
    content:'';position:absolute;
    bottom:-60px;left:20%;
    width:350px;height:350px;border-radius:50%;
    background:radial-gradient(circle,rgba(168,213,162,.06),transparent 62%);
}
.hero-inner{
    position:relative;z-index:2;
    display:grid;grid-template-columns:1.1fr 1fr;
    gap:80px;align-items:center;
}
@media(max-width:1024px){
    .hero-inner{grid-template-columns:1fr;gap:48px}
}
@media(max-width:768px){
    .about-hero{padding:80px 0 60px}
}

.hero-tag{
    display:inline-flex;align-items:center;gap:8px;
    background:rgba(168,213,162,.12);
    border:1px solid rgba(168,213,162,.22);
    padding:7px 18px;border-radius:100px;
    font-size:.71rem;font-weight:600;letter-spacing:.12em;
    text-transform:uppercase;color:var(--mint);
    margin-bottom:28px;width:fit-content;
}
.hero-title{
    font-family:'Playfair Display',serif;
    font-size:clamp(2.2rem,5vw,4rem);
    font-weight:700;line-height:1.08;
    color:#fff;letter-spacing:-.025em;margin-bottom:20px;
}
.hero-title em{font-style:italic;color:var(--mint)}
.hero-desc{color:rgba(255,255,255,.48);font-size:.93rem;line-height:1.9;font-weight:300}

.stat-grid{
    display:grid;grid-template-columns:1fr 1fr;
    gap:14px;
}
@media(max-width:480px){
    .stat-grid{grid-template-columns:1fr 1fr;gap:10px}
}
.stat-card{
    background:rgba(255,255,255,.05);
    border:1px solid rgba(255,255,255,.1);
    border-radius:18px;padding:26px 22px;
    transition:all .3s;
}
@media(max-width:480px){
    .stat-card{padding:18px 16px;border-radius:14px}
}
.stat-card:hover{background:rgba(168,213,162,.08);border-color:rgba(168,213,162,.2)}
.stat-card .n{
    font-family:'Playfair Display',serif;
    font-size:2.6rem;font-weight:700;
    color:var(--mint);line-height:1;margin-bottom:6px;
}
@media(max-width:480px){.stat-card .n{font-size:2rem}}
.stat-card .l{font-size:.77rem;color:rgba(255,255,255,.42);font-weight:400;line-height:1.45}

/* ── EYEBROW & TITLES (shared) ── */
.eyebrow{
    display:inline-flex;align-items:center;gap:8px;
    font-size:.68rem;font-weight:600;letter-spacing:.14em;
    text-transform:uppercase;color:var(--leaf);margin-bottom:16px;
}
.eyebrow::before{content:'';display:block;width:24px;height:1.5px;background:var(--leaf)}
.sec-title{
    font-family:'Playfair Display',serif;
    font-size:clamp(1.9rem,3.2vw,2.9rem);
    font-weight:700;line-height:1.18;
    color:var(--ink);letter-spacing:-.02em;margin-bottom:18px;
}
.sec-title em{font-style:italic;color:var(--forest-mid)}
.sec-p{color:var(--ink-soft);font-size:.91rem;line-height:1.9;margin-bottom:12px;font-weight:300}

/* ── STORY ── */
.story-sec{padding:104px 0;background:var(--warm-white)}
@media(max-width:768px){.story-sec{padding:64px 0}}

.story-grid{
    display:grid;grid-template-columns:1fr 1fr;
    gap:80px;align-items:center;
}
@media(max-width:1024px){.story-grid{grid-template-columns:1fr;gap:56px}}

.story-imgs{
    position:relative;
    padding-bottom:32px;
    padding-right:32px;
}
@media(max-width:1024px){
    .story-imgs{padding:0}
}
.story-main{
    border-radius:24px;overflow:hidden;
    aspect-ratio:4/5;
    box-shadow:0 48px 96px rgba(27,58,32,.14);
    position:relative;z-index:2;
}
@media(max-width:1024px){
    .story-main{aspect-ratio:16/9}
}
.story-main img{width:100%;height:100%;object-fit:cover;display:block}

.story-thumb{
    position:absolute;bottom:0;right:0;
    width:180px;
    border-radius:18px;overflow:hidden;
    border:5px solid var(--warm-white);
    box-shadow:0 20px 48px rgba(27,58,32,.14);
    aspect-ratio:4/3;z-index:3;
}
.story-thumb img{width:100%;height:100%;object-fit:cover;display:block}

.story-float{
    position:absolute;top:-16px;left:-16px;
    background:var(--forest);border-radius:18px;
    padding:22px 20px;
    box-shadow:0 16px 40px rgba(27,58,32,.22);
    z-index:3;
}
.story-float .sf-label{
    font-size:.67rem;color:rgba(255,255,255,.4);
    text-transform:uppercase;letter-spacing:.1em;margin-bottom:4px;
}
.story-float .sf-val{
    font-family:'Playfair Display',serif;
    font-size:1.6rem;font-weight:700;
    color:var(--mint);line-height:1;
}
@media(max-width:1024px){
    .story-thumb{display:none}
    .story-float{top:12px;left:12px}
}

/* ── PREMIUM CHECKS ── */
.premium-checks{
    list-style:none;
    margin:28px 0 38px;
    display:flex;flex-direction:column;gap:10px;
}
.premium-checks li{
    display:flex;
    align-items:flex-start;
    gap:14px;
    padding:14px 16px;
    background:var(--clay);
    border:1px solid var(--border-warm);
    border-radius:12px;
    transition:all .2s;
}
.premium-checks li:hover{
    background:var(--mint-pale);
    border-color:rgba(75,138,85,.18);
}
.chk{
    width:22px;height:22px;
    border-radius:50%;
    background:var(--mint-pale);
    flex-shrink:0;
    display:flex;align-items:center;justify-content:center;
    margin-top:1px;
}
.chk svg{width:10px;height:10px}
.chk-txt{font-size:.875rem;font-weight:500;color:var(--ink-mid);line-height:1.55}

/* ── COMMITMENT ── */
.commit-sec{
    display:grid;grid-template-columns:1fr 1fr;
}
@media(max-width:1024px){.commit-sec{grid-template-columns:1fr}}

.commit-left{
    background:var(--forest);
    padding:96px 80px;
    position:relative;overflow:hidden;
}
.commit-left::before{
    content:'';position:absolute;
    top:-80px;right:-80px;
    width:420px;height:420px;border-radius:50%;
    background:radial-gradient(circle,rgba(168,213,162,.1),transparent 62%);
}
@media(max-width:768px){.commit-left{padding:60px 24px}}

.commit-ey{
    display:inline-flex;align-items:center;gap:8px;
    font-size:.68rem;font-weight:600;letter-spacing:.14em;
    text-transform:uppercase;color:var(--mint);margin-bottom:20px;
}
.commit-ey::before{content:'';display:block;width:24px;height:1.5px;background:var(--mint)}

.commit-title{
    font-family:'Playfair Display',serif;
    font-size:clamp(2rem,3.5vw,3rem);
    font-weight:700;line-height:1.14;
    color:#fff;letter-spacing:-.02em;margin-bottom:20px;
}
.commit-title em{font-style:italic;color:var(--mint)}
.commit-desc{
    color:rgba(255,255,255,.45);
    font-size:.91rem;line-height:1.88;
    font-weight:300;margin-bottom:40px;
}
.btn-commit{
    display:inline-flex;align-items:center;gap:10px;
    padding:14px 38px;background:var(--mint);
    color:var(--forest);border-radius:100px;
    font-size:.875rem;font-weight:700;
    text-decoration:none;transition:all .3s;
}
.btn-commit:hover{background:#fff;transform:translateY(-2px)}

.commit-right{
    background:var(--forest-mid);
    padding:96px 80px;
    display:flex;flex-direction:column;
    gap:32px;justify-content:center;
}
@media(max-width:768px){.commit-right{padding:60px 24px}}

.commit-item{display:flex;align-items:flex-start;gap:18px}
.commit-num{
    font-family:'Playfair Display',serif;
    font-size:2rem;font-weight:700;
    color:rgba(168,213,162,.28);line-height:1;
    flex-shrink:0;min-width:40px;
}
.commit-item-title{font-size:.95rem;font-weight:600;color:#fff;margin-bottom:6px}
.commit-item-desc{font-size:.83rem;color:rgba(255,255,255,.42);line-height:1.75;font-weight:300}

/* ── KEUNGGULAN ── */
.unggulan-sec{padding:96px 0;background:var(--clay)}
@media(max-width:768px){.unggulan-sec{padding:64px 0}}

.unggulan-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:20px;
}
@media(max-width:1024px){.unggulan-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:600px){.unggulan-grid{grid-template-columns:1fr}}

.feat-card{
    background:var(--warm-white);
    border:1px solid var(--border-warm);
    border-radius:22px;padding:36px 28px;
    position:relative;overflow:hidden;
    transition:all .3s;
    display:flex;flex-direction:column;
}
.feat-card:hover{
    transform:translateY(-6px);
    box-shadow:0 24px 56px rgba(27,58,32,.1);
    border-color:rgba(75,138,85,.15);
}
.feat-card::after{
    content:'';position:absolute;
    top:0;left:0;right:0;height:2.5px;
    background:linear-gradient(90deg,var(--forest),var(--leaf));
    transform:scaleX(0);transform-origin:left;
    transition:transform .4s;
}
.feat-card:hover::after{transform:scaleX(1)}

.feat-icon{
    width:54px;height:54px;border-radius:14px;
    background:var(--mint-pale);
    display:flex;align-items:center;justify-content:center;
    font-size:1.3rem;margin-bottom:20px;
    transition:background .3s;
    flex-shrink:0;
}
.feat-card:hover .feat-icon{background:var(--forest)}
.feat-title{font-weight:600;font-size:1rem;color:var(--ink);margin-bottom:10px}
.feat-desc{font-size:.85rem;color:var(--ink-soft);line-height:1.78;font-weight:300;margin-bottom:18px;flex:1}

.btn-read-more{
    display:inline-flex;align-items:center;gap:7px;
    font-size:.8rem;font-weight:600;color:var(--leaf);
    background:none;border:none;padding:0;cursor:pointer;
    transition:gap .2s;font-family:'DM Sans',sans-serif;
    margin-top:auto;
}
.btn-read-more:hover{gap:12px;color:var(--forest)}

/* ── MODAL ── */
.modal-content{border-radius:20px;border:none;overflow:hidden}
.modal-head-dark{
    background:var(--forest);
    padding:24px 28px;border:none;
    display:flex;align-items:center;justify-content:space-between;
}
.modal-head-dark .modal-title{
    font-family:'Playfair Display',serif;
    color:#fff;font-size:1.25rem;font-weight:600;
}
.modal-body{
    padding:28px;
    font-size:.88rem;color:var(--ink-mid);line-height:1.82;
}
.modal-body p+p{margin-top:12px}

/* ── ANIMATIONS ── */
.reveal{opacity:0;transform:translateY(28px);transition:opacity .65s ease,transform .65s ease}
.reveal.on{opacity:1;transform:translateY(0)}
.d1{transition-delay:.1s}
.d2{transition-delay:.2s}
.d3{transition-delay:.3s}
</style>

<div class="about-page">

{{-- HERO --}}
<div class="about-hero">
    <div class="container-main">
        <div class="hero-inner">
            <div class="reveal">
                <div class="hero-tag">Tentang Kami</div>
                <h1 class="hero-title">
                    Dapur Bu Iim —<br><em>Masak dengan Hati</em>
                </h1>
                <p class="hero-desc">
                    Menghadirkan cita rasa masakan rumahan yang autentik, sehat, dan penuh kehangatan untuk setiap momen spesial Anda sejak 2019.
                </p>
            </div>
            <div class="stat-grid reveal d2">
                <div class="stat-card"><div class="n">5+</div><div class="l">Tahun Berpengalaman</div></div>
                <div class="stat-card"><div class="n">500+</div><div class="l">Pelanggan Puas</div></div>
                <div class="stat-card"><div class="n">30+</div><div class="l">Pilihan Menu Tersedia</div></div>
                <div class="stat-card"><div class="n">100%</div><div class="l">Bahan Segar &amp; Alami</div></div>
            </div>
        </div>
    </div>
</div>

{{-- STORY --}}
<section class="story-sec">
    <div class="container-main">
        <div class="story-grid">
            <div class="story-imgs reveal">
                <div class="story-float">
                    <div class="sf-label">Berdiri sejak</div>
                    <div class="sf-val">2019</div>
                </div>
                <div class="story-main">
                    <img src="img/nasbox (1).jpg" alt="Dapur Bu Iim">
                </div>
                <div class="story-thumb">
                    <img src="img/catering lunch box (4).jpg" alt="Catering Bu Iim">
                </div>
            </div>
            <div class="reveal d2">
                <div class="eyebrow">Cerita Kami</div>
                <h2 class="sec-title">Masakan Rumahan yang<br><em>Sehat</em> &amp; Lezat</h2>
                <p class="sec-p">
                    <strong style="font-weight:600;color:var(--ink)">Dapur Bu Iim</strong> hadir untuk memberikan pengalaman makan terbaik dengan cita rasa khas rumahan yang autentik. Kami percaya bahwa makanan yang baik bukan hanya soal rasa — tetapi juga tentang kualitas, kebersihan, dan kehangatan yang dirasakan setiap pelanggan.
                </p>
                <p class="sec-p">
                    Dengan bahan pilihan yang segar dan proses memasak yang higienis, kami berkomitmen menghadirkan hidangan yang tidak hanya lezat, tetapi juga sehat dan aman untuk dikonsumsi setiap hari.
                </p>
                <ul class="premium-checks">
                    <li>
                        <div class="chk">
                            <svg viewBox="0 0 10 10" fill="none"><path d="M1.5 5L4 7.5L8.5 2.5" stroke="#4B8A55" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <span class="chk-txt">Bahan segar &amp; berkualitas dari supplier terpercaya</span>
                    </li>
                    <li>
                        <div class="chk">
                            <svg viewBox="0 0 10 10" fill="none"><path d="M1.5 5L4 7.5L8.5 2.5" stroke="#4B8A55" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <span class="chk-txt">Masakan rumahan dengan resep autentik warisan keluarga</span>
                    </li>
                    <li>
                        <div class="chk">
                            <svg viewBox="0 0 10 10" fill="none"><path d="M1.5 5L4 7.5L8.5 2.5" stroke="#4B8A55" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <span class="chk-txt">Proses memasak higienis &amp; standar kebersihan tinggi</span>
                    </li>
                    <li>
                        <div class="chk">
                            <svg viewBox="0 0 10 10" fill="none"><path d="M1.5 5L4 7.5L8.5 2.5" stroke="#4B8A55" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <span class="chk-txt">Rasa terjamin lezat di setiap hidangan</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- COMMITMENT --}}
<div class="commit-sec">
    <div class="commit-left reveal">
        <div class="commit-ey">Komitmen Kami</div>
        <h2 class="commit-title">Untuk <em>Kualitas</em><br>Terbaik Setiap Hari</h2>
        <p class="commit-desc">Kami selalu menghadirkan masakan rumahan dengan kualitas terbaik, menggunakan bahan segar dan proses higienis untuk memastikan setiap hidangan lezat, sehat, dan memuaskan pelanggan.</p>
        <a href="{{ route('product') }}" class="btn-commit">
            Pesan Sekarang
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2 7h10M8 3l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
    </div>
    <div class="commit-right reveal d2">
        <div class="commit-item">
            <div class="commit-num">01</div>
            <div>
                <div class="commit-item-title">Bahan Terpilih</div>
                <p class="commit-item-desc">Setiap bahan diseleksi ketat, memastikan kesegaran dan kualitas nutrisi terbaik untuk setiap hidangan kami.</p>
            </div>
        </div>
        <div class="commit-item">
            <div class="commit-num">02</div>
            <div>
                <div class="commit-item-title">Rasa Konsisten</div>
                <p class="commit-item-desc">Menggunakan resep yang telah teruji dan terstandarisasi untuk menjamin cita rasa yang konsisten setiap hari.</p>
            </div>
        </div>
        <div class="commit-item">
            <div class="commit-num">03</div>
            <div>
                <div class="commit-item-title">Kepuasan Pelanggan</div>
                <p class="commit-item-desc">Kepuasan Anda adalah prioritas kami. Kami selalu mendengar dan merespons kebutuhan pelanggan dengan cepat.</p>
            </div>
        </div>
    </div>
</div>

{{-- KEUNGGULAN --}}
<section class="unggulan-sec">
    <div class="container-main">
        <div class="text-center reveal" style="margin-bottom:56px">
            <div class="eyebrow" style="justify-content:center;margin-bottom:16px">Keunggulan Kami</div>
            <h2 class="sec-title" style="text-align:center">Kenapa Pilih <em>Dapur Bu Iim?</em></h2>
            <p style="color:var(--ink-soft);font-size:.9rem;line-height:1.75;max-width:460px;margin:12px auto 0;font-weight:300">
                Kami berkomitmen menghadirkan masakan berkualitas dengan bahan terbaik, rasa lezat, dan proses higienis.
            </p>
        </div>
        <div class="unggulan-grid">
            <div class="feat-card reveal d1">
                <div class="feat-icon">🌿</div>
                <div class="feat-title">Bahan Berkualitas</div>
                <p class="feat-desc">Menggunakan bahan segar pilihan dari supplier terpercaya untuk kualitas terbaik setiap hari.</p>
                <button class="btn-read-more"
                    data-bs-toggle="modal" data-bs-target="#featureModal"
                    data-title="Bahan Berkualitas"
                    data-desc="Kami hanya menggunakan bahan segar pilihan dari supplier terpercaya."
                    data-full="Setiap bahan dipilih dengan standar tinggi, memastikan kebersihan, kesegaran, dan kualitas terbaik sehingga menghasilkan hidangan yang sehat, lezat, dan bernutrisi untuk keluarga Anda.">
                    Baca selengkapnya
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M2 6h8M6 2l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
            </div>
            <div class="feat-card reveal d2">
                <div class="feat-icon">🍱</div>
                <div class="feat-title">Masakan Rumahan</div>
                <p class="feat-desc">Cita rasa khas rumahan yang autentik dengan resep tradisional dan sentuhan profesional.</p>
                <button class="btn-read-more"
                    data-bs-toggle="modal" data-bs-target="#featureModal"
                    data-title="Masakan Rumahan"
                    data-desc="Menghadirkan rasa rumahan yang autentik dan menggugah selera."
                    data-full="Setiap hidangan dimasak dengan resep tradisional dan sentuhan profesional, memberikan rasa yang familiar, lezat, dan cocok untuk semua kalangan — dari anak-anak hingga orang tua.">
                    Baca selengkapnya
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M2 6h8M6 2l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
            </div>
            <div class="feat-card reveal d3">
                <div class="feat-icon">✨</div>
                <div class="feat-title">Aman &amp; Higienis</div>
                <p class="feat-desc">Proses memasak dengan standar kebersihan tinggi tanpa bahan berbahaya, aman untuk keluarga.</p>
                <button class="btn-read-more"
                    data-bs-toggle="modal" data-bs-target="#featureModal"
                    data-title="Aman & Higienis"
                    data-desc="Semua proses dilakukan dengan standar kebersihan tinggi."
                    data-full="Kami memastikan setiap proses pengolahan makanan dilakukan secara higienis tanpa bahan berbahaya atau pengawet berlebih, sehingga aman dikonsumsi setiap hari oleh seluruh keluarga Anda.">
                    Baca selengkapnya
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M2 6h8M6 2l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
            </div>
        </div>
    </div>
</section>

</div>

{{-- MODAL --}}
<div class="modal fade" id="featureModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-head-dark">
                <h5 class="modal-title" id="modalTitle"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p style="color:var(--ink-soft);font-style:italic;margin-bottom:14px" id="modalDesc"></p>
                <hr style="border-color:var(--border-warm);margin-bottom:14px">
                <p id="modalFull"></p>
            </div>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('[data-bs-target="#featureModal"]').forEach(btn => {
    btn.addEventListener('click', function() {
        document.getElementById('modalTitle').textContent = this.dataset.title;
        document.getElementById('modalDesc').textContent  = this.dataset.desc;
        document.getElementById('modalFull').textContent  = this.dataset.full;
    });
});

const io = new IntersectionObserver(entries => {
    entries.forEach(e => { if(e.isIntersecting) e.target.classList.add('on') });
}, { threshold: .1, rootMargin: '0px 0px -40px 0px' });
document.querySelectorAll('.reveal').forEach(el => io.observe(el));
</script>

@endsection
