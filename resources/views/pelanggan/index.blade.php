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
    --saffron: #C8862A;
    --saffron-pale: #FDF2E3;
    --border-warm: rgba(60,40,20,0.1);
    --border-strong: rgba(60,40,20,0.18);
}

*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{font-family:'DM Sans',sans-serif;background:var(--warm-white);color:var(--ink);overflow-x:hidden}

/* ── UTILITY ── */
.serif{font-family:'Playfair Display',serif}
.container-main{max-width:1280px;margin:0 auto;padding:0 48px}
@media(max-width:768px){.container-main{padding:0 20px}}

/* ── HERO CAROUSEL ── */
.hero{
    position:relative;
    height:100vh;min-height:560px;
    overflow:hidden;
}

/* slides */
.hero-slides{
    position:absolute;inset:0;
    width:100%;height:100%;
}
.hero-slide{
    position:absolute;inset:0;
    opacity:0;transition:opacity 1.2s ease;
    will-change:opacity;
}
.hero-slide.active{opacity:1}
.hero-slide img{
    width:100%;height:100%;object-fit:cover;
    display:block;
    transform:scale(1.06);
    transition:transform 8s ease;
}
.hero-slide.active img{transform:scale(1)}

/* dark overlay + vignette */
.hero-overlay{
    position:absolute;inset:0;
    background:linear-gradient(
        to bottom,
        rgba(10,22,12,.25) 0%,
        rgba(10,22,12,.55) 50%,
        rgba(10,22,12,.78) 100%
    );
    z-index:2;
}

/* content */
.hero-content{
    position:absolute;inset:0;z-index:3;
    display:flex;flex-direction:column;
    align-items:center;justify-content:center;
    text-align:center;
    padding:0 24px;
}

.hero-tag{
    display:inline-flex;align-items:center;gap:8px;
    background:rgba(168,213,162,.13);
    border:1px solid rgba(168,213,162,.25);
    padding:7px 18px;border-radius:100px;
    font-size:.71rem;font-weight:600;letter-spacing:.13em;
    text-transform:uppercase;color:var(--mint);
    margin-bottom:28px;
    opacity:0;animation:fadeUp .8s .3s forwards;
}
.hero-tag .blink{
    width:5px;height:5px;border-radius:50%;
    background:var(--mint);animation:blink 2s ease infinite;
}
@keyframes blink{0%,100%{opacity:1}50%{opacity:.3}}
@keyframes fadeUp{from{opacity:0;transform:translateY(18px)}to{opacity:1;transform:translateY(0)}}

.hero-h1{
    font-family:'Playfair Display',serif;
    font-size:clamp(2.6rem,7vw,5.6rem);
    font-weight:700;line-height:1.06;
    color:#fff;letter-spacing:-.025em;
    margin-bottom:22px;
    max-width:780px;
    opacity:0;animation:fadeUp .8s .5s forwards;
}
.hero-h1 em{font-style:italic;color:var(--mint)}

.hero-p{
    color:rgba(255,255,255,.55);
    font-size:clamp(.88rem,2vw,1.05rem);line-height:1.85;
    max-width:520px;margin-bottom:44px;
    font-weight:300;
    opacity:0;animation:fadeUp .8s .7s forwards;
}

.hero-actions{
    display:flex;align-items:center;gap:14px;flex-wrap:wrap;
    justify-content:center;
    opacity:0;animation:fadeUp .8s .9s forwards;
}

.btn-hero-main{
    display:inline-flex;align-items:center;gap:10px;
    background:var(--mint);color:var(--forest);
    padding:15px 38px;border-radius:100px;
    font-size:.875rem;font-weight:600;
    text-decoration:none;transition:all .25s;
}
.btn-hero-main:hover{background:#fff;transform:translateY(-2px);box-shadow:0 16px 40px rgba(0,0,0,.25)}

.btn-hero-ghost{
    display:inline-flex;align-items:center;gap:8px;
    color:rgba(255,255,255,.6);
    font-size:.875rem;font-weight:500;
    text-decoration:none;padding:15px 0;
    border-bottom:1px solid rgba(255,255,255,.2);
    transition:all .2s;
}
.btn-hero-ghost:hover{color:#fff;border-color:rgba(255,255,255,.5)}

/* stats bar */
.hero-stats-bar{
    position:absolute;bottom:0;left:0;right:0;z-index:4;
    display:flex;
    border-top:1px solid rgba(255,255,255,.08);
    background:rgba(10,22,12,.45);
    backdrop-filter:blur(12px);
    -webkit-backdrop-filter:blur(12px);
}
.hero-stat{
    flex:1;padding:20px 0;
    text-align:center;
    border-right:1px solid rgba(255,255,255,.07);
}
.hero-stat:last-child{border-right:none}
.hero-stat .n{
    font-family:'Playfair Display',serif;
    font-size:1.8rem;font-weight:700;
    color:var(--mint);line-height:1;margin-bottom:4px;
}
.hero-stat .l{font-size:.72rem;color:rgba(255,255,255,.38);letter-spacing:.04em}

/* dots */
.hero-dots{
    position:absolute;bottom:90px;left:50%;transform:translateX(-50%);
    display:flex;gap:8px;z-index:5;
}
.hero-dot{
    width:6px;height:6px;border-radius:50%;
    background:rgba(255,255,255,.3);cursor:pointer;
    transition:all .3s;border:none;padding:0;
}
.hero-dot.active{width:22px;border-radius:3px;background:var(--mint)}

/* nav arrows */
.hero-arrow{
    position:absolute;top:50%;transform:translateY(-50%);
    z-index:5;width:44px;height:44px;border-radius:50%;
    background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.15);
    backdrop-filter:blur(8px);
    display:flex;align-items:center;justify-content:center;
    cursor:pointer;transition:all .2s;color:#fff;
}
.hero-arrow:hover{background:rgba(255,255,255,.2);border-color:rgba(255,255,255,.3)}
.hero-arrow.prev{left:28px}
.hero-arrow.next{right:28px}
@media(max-width:768px){
    .hero-arrow{display:none}
    .hero-h1{font-size:clamp(2rem,8vw,3.2rem)}
    .hero-stat .n{font-size:1.4rem}
    .hero-stat .l{font-size:.65rem}
    .hero-stats-bar{display:none}
    .hero-dots{bottom:20px}
}


/* ── MARQUEE STRIP ── */
.marquee-strip{
    background:var(--forest-mid);
    padding:14px 0;overflow:hidden;
    position:relative;
}
.marquee-inner{
    display:flex;gap:0;
    white-space:nowrap;
    animation:marquee 20s linear infinite;
    width:max-content;
}
.marquee-inner:hover{animation-play-state:paused}
@keyframes marquee{from{transform:translateX(0)}to{transform:translateX(-50%)}}
.marquee-item{
    display:inline-flex;align-items:center;gap:10px;
    padding:0 32px;
    font-size:.78rem;font-weight:600;letter-spacing:.08em;
    text-transform:uppercase;color:rgba(255,255,255,.55);
}
.marquee-dot{width:4px;height:4px;border-radius:50%;background:var(--mint);opacity:.6}

/* ── ABOUT ── */
.about-sec{padding:112px 0;background:var(--warm-white)}
.about-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:80px;align-items:center;
}
@media(max-width:1024px){.about-grid{grid-template-columns:1fr;gap:56px}}

.about-imgs{
    display:grid;
    grid-template-columns:3fr 2fr;
    grid-template-rows:auto auto;
    gap:12px;
    position:relative;
}
.img-tall{
    grid-column:1;grid-row:1/span 2;
    border-radius:20px;overflow:hidden;
    aspect-ratio:3/4;
}
.img-short{
    grid-column:2;grid-row:1;
    border-radius:16px;overflow:hidden;
    aspect-ratio:4/3;
}
.img-badge{
    grid-column:2;grid-row:2;
    background:var(--forest);
    border-radius:16px;
    padding:24px 20px;
    display:flex;flex-direction:column;gap:4px;justify-content:center;
}
.img-badge .big{
    font-family:'Playfair Display',serif;
    font-size:2.6rem;font-weight:700;
    color:var(--mint);line-height:1;
}
.img-badge .sm{font-size:.75rem;color:rgba(255,255,255,.45);line-height:1.5}
.img-tall img,.img-short img{
    width:100%;height:100%;object-fit:cover;
    transition:transform .6s ease;display:block;
}
.img-tall:hover img,.img-short:hover img{transform:scale(1.04)}

.eyebrow{
    display:inline-flex;align-items:center;gap:8px;
    font-size:.68rem;font-weight:600;letter-spacing:.14em;
    text-transform:uppercase;color:var(--leaf);
    margin-bottom:16px;
}
.eyebrow::before{content:'';display:block;width:24px;height:1.5px;background:var(--leaf)}

.sec-title{
    font-family:'Playfair Display',serif;
    font-size:clamp(1.9rem,3.2vw,2.9rem);
    font-weight:700;line-height:1.18;
    color:var(--ink);letter-spacing:-.02em;
    margin-bottom:18px;
}
.sec-title em{font-style:italic;color:var(--forest-mid)}
.sec-p{color:var(--ink-soft);font-size:.91rem;line-height:1.9;margin-bottom:12px;font-weight:300}

.checks{list-style:none;margin:28px 0 40px;display:flex;flex-direction:column;gap:11px}
.checks li{
    display:flex;align-items:center;gap:12px;
    font-size:.875rem;font-weight:500;color:var(--ink-mid);
}
.chk{
    width:20px;height:20px;border-radius:50%;
    background:var(--mint-pale);flex-shrink:0;
    display:flex;align-items:center;justify-content:center;
}
.chk svg{width:10px;height:10px}

.btn-link{
    display:inline-flex;align-items:center;gap:9px;
    color:var(--forest-mid);font-size:.875rem;font-weight:600;
    text-decoration:none;
    padding-bottom:3px;
    border-bottom:1.5px solid var(--forest-mid);
    transition:all .2s;
}
.btn-link:hover{color:var(--leaf);border-color:var(--leaf);gap:14px}

/* ── FEATURES ── */
.features-sec{padding:100px 0;background:var(--clay)}
.sec-head{
    display:flex;align-items:flex-end;justify-content:space-between;
    margin-bottom:56px;flex-wrap:wrap;gap:20px;
}
.feat-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:1024px){.feat-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:600px){.feat-grid{grid-template-columns:1fr}}

.feat-card{
    background:var(--warm-white);
    border:1px solid var(--border-warm);
    border-radius:20px;padding:36px 28px;
    position:relative;overflow:hidden;
    transition:all .3s ease;
}
.feat-card:hover{
    border-color:var(--border-strong);
    transform:translateY(-5px);
    box-shadow:0 24px 56px rgba(28,18,8,.07);
}
.feat-card::after{
    content:'';position:absolute;
    top:0;left:0;right:0;height:2.5px;
    background:linear-gradient(90deg,var(--forest-mid),var(--leaf));
    transform:scaleX(0);transform-origin:left;
    transition:transform .4s ease;
}
.feat-card:hover::after{transform:scaleX(1)}

.feat-icon{
    width:52px;height:52px;border-radius:14px;
    background:var(--mint-pale);
    display:flex;align-items:center;justify-content:center;
    font-size:1.3rem;margin-bottom:20px;
    transition:background .3s;
}
.feat-card:hover .feat-icon{background:var(--forest)}
.feat-n{
    font-family:'Playfair Display',serif;
    font-size:3rem;font-weight:700;
    color:rgba(27,58,32,.07);
    position:absolute;top:16px;right:22px;
    line-height:1;letter-spacing:-.04em;
}
.feat-title{font-weight:600;font-size:1rem;color:var(--ink);margin-bottom:9px}
.feat-desc{font-size:.85rem;color:var(--ink-soft);line-height:1.78;font-weight:300}

/* ── PRODUCTS ── */
.products-sec{padding:100px 0;background:var(--warm-white)}
.cat-pills{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:48px}
.cat-pill{
    padding:9px 22px;border-radius:100px;
    border:1.5px solid var(--border-warm);
    background:transparent;
    font-size:.79rem;font-weight:600;color:var(--ink-soft);
    cursor:pointer;text-decoration:none;
    transition:all .2s;font-family:'DM Sans',sans-serif;
}
.cat-pill:hover{border-color:var(--forest-mid);color:var(--forest-mid)}
.cat-pill.active{background:var(--forest);border-color:var(--forest);color:#fff}

.prod-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:18px}
@media(max-width:1024px){.prod-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:480px){.prod-grid{grid-template-columns:1fr}}

.prod-card{
    background:var(--warm-white);
    border:1px solid var(--border-warm);
    border-radius:20px;overflow:hidden;
    transition:all .3s ease;
    display:flex;flex-direction:column;
}
.prod-card:hover{transform:translateY(-6px);box-shadow:0 28px 60px rgba(28,18,8,.09);border-color:transparent}

.prod-img{
    position:relative;overflow:hidden;
    aspect-ratio:4/3;background:var(--mint-pale);
}
.prod-img img{
    width:100%;height:100%;object-fit:cover;
    transition:transform .5s ease;display:block;
}
.prod-card:hover .prod-img img{transform:scale(1.08)}
.prod-cat{
    position:absolute;top:12px;left:12px;
    background:rgba(28,18,8,.72);
    backdrop-filter:blur(8px);
    color:#fff;font-size:.67rem;font-weight:600;
    padding:4px 12px;border-radius:100px;
    letter-spacing:.06em;text-transform:uppercase;
}

.prod-body{padding:18px 20px 14px;flex:1;display:flex;flex-direction:column}
.prod-name{font-weight:600;font-size:.92rem;color:var(--ink);margin-bottom:8px}
.prod-price{
    font-family:'Playfair Display',serif;
    font-size:1.2rem;font-weight:700;color:var(--forest-mid);
    margin-top:auto;
}
.prod-foot{
    border-top:1px solid var(--border-warm);
    padding:12px 20px;
    display:flex;align-items:center;justify-content:center;
}
.btn-detail-p{
    display:inline-flex;align-items:center;gap:6px;
    font-size:.79rem;font-weight:600;
    color:var(--forest-mid);text-decoration:none;
    transition:gap .2s;
}
.btn-detail-p:hover{gap:12px;color:var(--forest)}

.cta-wrap{text-align:center;margin-top:52px}
.btn-outline{
    display:inline-flex;align-items:center;gap:10px;
    padding:14px 44px;
    border:2px solid var(--forest-mid);
    color:var(--forest-mid);border-radius:100px;
    font-size:.875rem;font-weight:600;
    text-decoration:none;transition:all .3s;
}
.btn-outline:hover{background:var(--forest);border-color:var(--forest);color:#fff;transform:translateY(-2px)}

/* ── BANNER ── */
.banner-sec{
    background:var(--forest);
    padding:96px 0;position:relative;overflow:hidden;
}
.banner-sec::before{
    content:'';position:absolute;
    top:-100px;right:-100px;
    width:520px;height:520px;border-radius:50%;
    background:radial-gradient(circle,rgba(75,138,85,.15),transparent 62%);
}
.banner-inner{
    display:flex;align-items:center;
    justify-content:space-between;
    gap:48px;flex-wrap:wrap;
}
@media(max-width:768px){.banner-inner{flex-direction:column;text-align:center}}

.banner-ey{
    display:inline-flex;align-items:center;gap:8px;
    font-size:.68rem;font-weight:600;letter-spacing:.14em;
    text-transform:uppercase;color:var(--mint);
    margin-bottom:16px;
}
.banner-ey::before{content:'';display:block;width:24px;height:1.5px;background:var(--mint)}
@media(max-width:768px){.banner-ey{margin-left:auto;margin-right:auto}}

.banner-title{
    font-family:'Playfair Display',serif;
    font-size:clamp(1.8rem,3.5vw,2.9rem);
    font-weight:700;line-height:1.14;
    color:#fff;letter-spacing:-.02em;
}
.banner-title em{font-style:italic;color:var(--mint)}
.banner-p{
    color:rgba(255,255,255,.45);
    font-size:.88rem;line-height:1.85;
    max-width:500px;margin-top:16px;font-weight:300;
}
@media(max-width:768px){.banner-p{margin:16px auto 0}}

.btn-banner{
    display:inline-flex;align-items:center;gap:10px;
    background:var(--mint);color:var(--forest);
    padding:16px 44px;border-radius:100px;
    font-size:.875rem;font-weight:700;
    text-decoration:none;transition:all .3s;
    white-space:nowrap;flex-shrink:0;
}
.btn-banner:hover{background:#fff;transform:translateY(-2px);box-shadow:0 16px 36px rgba(0,0,0,.2)}

/* ── TESTIMONIALS ── */
.testi-sec{padding:100px 0;background:var(--clay)}
.testi-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:18px}
@media(max-width:1024px){.testi-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:600px){.testi-grid{grid-template-columns:1fr}}

.testi-card{
    background:var(--warm-white);
    border:1px solid var(--border-warm);
    border-radius:20px;padding:28px 24px;
    position:relative;transition:all .3s;
}
.testi-card:hover{border-color:var(--border-strong);transform:translateY(-4px);box-shadow:0 18px 44px rgba(28,18,8,.07)}
.testi-quote{
    font-family:'Playfair Display',serif;
    font-size:3.5rem;line-height:.8;
    color:var(--mint-pale);
    position:absolute;top:20px;right:22px;
    font-weight:700;
}
.testi-stars{display:flex;gap:2px;margin-bottom:14px}
.testi-stars span{color:var(--saffron);font-size:.8rem}
.testi-txt{
    font-size:.86rem;line-height:1.82;
    color:var(--ink-mid);margin-bottom:20px;
    font-weight:300;font-style:italic;
}
.testi-person{display:flex;align-items:center;gap:12px}
.testi-av{
    width:40px;height:40px;border-radius:50%;
    overflow:hidden;flex-shrink:0;background:var(--mint-pale);
}
.testi-av img{width:100%;height:100%;object-fit:cover}
.testi-name{font-size:.85rem;font-weight:600;color:var(--ink)}
.testi-role{font-size:.72rem;color:var(--ink-ghost);margin-top:1px}

/* ── BLOG ── */
.blog-sec{padding:100px 0;background:var(--warm-white)}
.blog-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:22px}
@media(max-width:1024px){.blog-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:600px){.blog-grid{grid-template-columns:1fr}}

.blog-card{
    background:var(--warm-white);
    border:1px solid var(--border-warm);
    border-radius:20px;overflow:hidden;
    display:flex;flex-direction:column;
    transition:all .3s;
}
.blog-card:hover{transform:translateY(-4px);box-shadow:0 20px 48px rgba(28,18,8,.08);border-color:transparent}

.blog-img{
    position:relative;overflow:hidden;
    aspect-ratio:16/9;background:var(--mint-pale);
}
.blog-img img{width:100%;height:100%;object-fit:cover;transition:transform .5s;display:block}
.blog-card:hover .blog-img img{transform:scale(1.05)}
.blog-date{
    position:absolute;top:14px;left:14px;
    background:rgba(28,18,8,.78);backdrop-filter:blur(8px);
    color:#fff;font-size:.67rem;font-weight:600;
    padding:4px 12px;border-radius:100px;letter-spacing:.04em;
}

.blog-body{padding:24px;flex:1;display:flex;flex-direction:column}
.blog-title-link{
    font-family:'Playfair Display',serif;
    font-size:1.15rem;font-weight:600;line-height:1.38;
    color:var(--ink);margin-bottom:10px;
    text-decoration:none;display:block;transition:color .2s;
}
.blog-title-link:hover{color:var(--forest-mid)}
.blog-desc{font-size:.83rem;color:var(--ink-soft);line-height:1.78;font-weight:300;flex:1;margin-bottom:18px}
.blog-meta{
    display:flex;align-items:center;gap:16px;
    font-size:.73rem;color:var(--ink-ghost);
    padding-top:16px;border-top:1px solid var(--border-warm);
}
.blog-meta span{display:flex;align-items:center;gap:5px}

/* ── ANIMATIONS ── */
.reveal{opacity:0;transform:translateY(28px);transition:opacity .65s ease,transform .65s ease}
.reveal.on{opacity:1;transform:translateY(0)}
.d1{transition-delay:.1s}.d2{transition-delay:.2s}.d3{transition-delay:.3s}.d4{transition-delay:.4s}
</style>

{{-- HERO CAROUSEL --}}
<section class="hero">

    {{-- Slides --}}
    <div class="hero-slides">
        <div class="hero-slide active">
            <img src="img/8e1e17f5f76a43bcb1fea0cc4ff951e1.jpg" alt="Masakan Bu Iim" loading="eager">
        </div>
        <div class="hero-slide">
            <img src="img/catering lunch box (4).jpg" alt="Catering Bu Iim" loading="lazy">
        </div>
    </div>

    {{-- Overlay --}}
    <div class="hero-overlay"></div>

    {{-- Center Content --}}
    <div class="hero-content">
        <div class="hero-tag"><span class="blink"></span> Masakan Rumahan Autentik</div>
        <h1 class="hero-h1">
            Hidangan Penuh <em>Kehangatan</em><br>untuk Keluarga Anda
        </h1>
        <p class="hero-p">
            Disiapkan dari bahan segar pilihan dengan resep turun-temurun — setiap suapan membawa rasa rumah yang sesungguhnya.
        </p>
        <div class="hero-actions">
            <a href="{{ route('product') }}" class="btn-hero-main">
                Lihat Menu
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2 7h10M8 3l4 4-4 4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </a>
            <a href="{{ route('about') }}" class="btn-hero-ghost">
                Tentang Kami
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M2 6h8M6 2l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </a>
        </div>
    </div>

    {{-- Dots --}}
    <div class="hero-dots">
        <button class="hero-dot active" onclick="goSlide(0)"></button>
        <button class="hero-dot" onclick="goSlide(1)"></button>
        <button class="hero-dot" onclick="goSlide(2)"></button>
    </div>

    {{-- Arrows --}}
    <button class="hero-arrow prev" onclick="stepSlide(-1)" aria-label="Previous">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M10 3L5 8l5 5" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </button>
    <button class="hero-arrow next" onclick="stepSlide(1)" aria-label="Next">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M6 3l5 5-5 5" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </button>

    {{-- Stats bar --}}
    <div class="hero-stats-bar">
        <div class="hero-stat"><div class="n">5+</div><div class="l">Tahun Berpengalaman</div></div>
        <div class="hero-stat"><div class="n">500+</div><div class="l">Pelanggan Puas</div></div>
        <div class="hero-stat"><div class="n">30+</div><div class="l">Pilihan Menu</div></div>
        <div class="hero-stat"><div class="n">100%</div><div class="l">Bahan Segar</div></div>
    </div>

</section>

{{-- MARQUEE --}}
<div class="marquee-strip">
    <div class="marquee-inner">
        @for($i=0;$i<2;$i++)
        <span class="marquee-item"><span class="marquee-dot"></span>Masakan Rumahan</span>
        <span class="marquee-item"><span class="marquee-dot"></span>Bahan Segar</span>
        <span class="marquee-item"><span class="marquee-dot"></span>Nasi Kotak</span>
        <span class="marquee-item"><span class="marquee-dot"></span>Snack Box</span>
        <span class="marquee-item"><span class="marquee-dot"></span>Catering Kantor</span>
        <span class="marquee-item"><span class="marquee-dot"></span>Hajatan &amp; Acara</span>
        <span class="marquee-item"><span class="marquee-dot"></span>Higienis &amp; Terpercaya</span>
        @endfor
    </div>
</div>

{{-- ABOUT --}}
<section class="about-sec">
    <div class="container-main">
        <div class="about-grid">
            <div class="about-imgs reveal">
                <div class="img-tall"><img src="img/nasbox (1).jpg" alt="Nasi Kotak Bu Iim"></div>
                <div class="img-short"><img src="img/catering lunch box (4).jpg" alt="Catering"></div>
                <div class="img-badge">
                    <div class="big">2019</div>
                    <div class="sm">Berdiri & melayani<br>dengan sepenuh hati</div>
                </div>
            </div>
            <div class="reveal d2">
                <div class="eyebrow">Tentang Kami</div>
                <h2 class="sec-title">Masak dengan <em>Hati</em>,<br>Sajikan yang Terbaik</h2>
                <p class="sec-p">Dapur Bu Iim hadir dengan komitmen sederhana — menghadirkan cita rasa rumahan yang autentik, dibuat dari bahan segar dan proses memasak yang higienis setiap harinya.</p>
                <p class="sec-p">Kepuasan Anda bukan sekadar target, melainkan alasan kami terus berkarya di dapur.</p>
                <ul class="checks">
                    <li>
                        <div class="chk"><svg viewBox="0 0 10 10" fill="none"><path d="M1.5 5L4 7.5L8.5 2.5" stroke="#4B8A55" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
                        Bahan segar pilihan dari supplier terpercaya
                    </li>
                    <li>
                        <div class="chk"><svg viewBox="0 0 10 10" fill="none"><path d="M1.5 5L4 7.5L8.5 2.5" stroke="#4B8A55" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
                        Resep autentik warisan keluarga
                    </li>
                    <li>
                        <div class="chk"><svg viewBox="0 0 10 10" fill="none"><path d="M1.5 5L4 7.5L8.5 2.5" stroke="#4B8A55" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
                        Proses higienis &amp; standar kebersihan tinggi
                    </li>
                    <li>
                        <div class="chk"><svg viewBox="0 0 10 10" fill="none"><path d="M1.5 5L4 7.5L8.5 2.5" stroke="#4B8A55" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
                        Rasa konsisten lezat setiap hidangan
                    </li>
                </ul>
                <a href="{{ route('about') }}" class="btn-link">
                    Baca Selengkapnya
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2 7h10M8 3l4 4-4 4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- FEATURES --}}
<section class="features-sec">
    <div class="container-main">
        <div class="sec-head reveal">
            <div>
                <div class="eyebrow">Keunggulan Kami</div>
                <h2 class="sec-title">Kenapa Pilih<br><em>Dapur Bu Iim?</em></h2>
            </div>
            <a href="{{ route('about') }}" class="btn-link" style="align-self:flex-end">Selengkapnya →</a>
        </div>
        <div class="feat-grid">
            <div class="feat-card reveal d1">
                <div class="feat-n">01</div>
                <div class="feat-icon">🌿</div>
                <div class="feat-title">Bahan Berkualitas</div>
                <p class="feat-desc">Setiap bahan diseleksi ketat dari supplier terpercaya, memastikan kesegaran dan nilai nutrisi terbaik di setiap hidangan.</p>
            </div>
            <div class="feat-card reveal d2">
                <div class="feat-n">02</div>
                <div class="feat-icon">🍱</div>
                <div class="feat-title">Masakan Rumahan</div>
                <p class="feat-desc">Cita rasa khas rumahan yang autentik menggunakan resep tradisional yang telah teruji dan disukai banyak keluarga.</p>
            </div>
            <div class="feat-card reveal d3">
                <div class="feat-n">03</div>
                <div class="feat-icon">✨</div>
                <div class="feat-title">Aman &amp; Higienis</div>
                <p class="feat-desc">Proses memasak dilakukan dengan standar kebersihan tinggi tanpa bahan berbahaya, aman untuk seluruh keluarga.</p>
            </div>
        </div>
    </div>
</section>

{{-- PRODUCTS --}}
<section class="products-sec">
    <div class="container-main">
        <div class="sec-head reveal">
            <div>
                <div class="eyebrow">Menu Pilihan</div>
                <h2 class="sec-title">Produk <em>Kami</em></h2>
                <p style="color:var(--ink-soft);font-size:.88rem;margin-top:10px;font-weight:300">Pilihan catering lezat untuk berbagai kebutuhan Anda</p>
            </div>
        </div>

        {{-- CATEGORY TABS --}}
        <div class="cat-pills">
            <a class="cat-pill active" data-bs-toggle="pill" href="#tab-all">Semua</a>
            @foreach($categories as $category)
            <a class="cat-pill" data-bs-toggle="pill" href="#tab-{{ $category->id }}">{{ $category->name }}</a>
            @endforeach
        </div>

        {{-- TAB CONTENT --}}
        <div class="tab-content">
            <div id="tab-all" class="tab-pane fade show active">
                <div class="prod-grid">
                    @foreach($menus as $menu)
                    <div class="prod-card reveal">
                        <div class="prod-img">
                            <img src="{{ asset('storage/'.$menu->image) }}" alt="{{ $menu->name }}" loading="lazy">
                            <span class="prod-cat">{{ $menu->category->name }}</span>
                        </div>
                        <div class="prod-body">
                            <div class="prod-name">{{ $menu->name }}</div>
                            <div class="prod-price">Rp {{ number_format($menu->price) }}</div>
                        </div>
                        <div class="prod-foot">
                            <a href="{{ route('product.detail', $menu->id) }}" class="btn-detail-p">
                                Lihat Detail
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M2 6h8M6 2l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @foreach($categories as $category)
            <div id="tab-{{ $category->id }}" class="tab-pane fade">
                <div class="prod-grid">
                    @foreach($menus->where('category_id', $category->id) as $menu)
                    <div class="prod-card reveal">
                        <div class="prod-img">
                            <img src="{{ asset('storage/'.$menu->image) }}" alt="{{ $menu->name }}" loading="lazy">
                            <span class="prod-cat">{{ $category->name }}</span>
                        </div>
                        <div class="prod-body">
                            <div class="prod-name">{{ $menu->name }}</div>
                            <div class="prod-price">Rp {{ number_format($menu->price) }}</div>
                        </div>
                        <div class="prod-foot">
                            <a href="{{ route('product.detail', $menu->id) }}" class="btn-detail-p">
                                Lihat Detail
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M2 6h8M6 2l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>

        <div class="cta-wrap reveal">
            <a href="{{ route('product') }}" class="btn-outline">
                Lihat Semua Menu
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2 7h10M8 3l4 4-4 4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </a>
        </div>
    </div>
</section>

{{-- BANNER --}}
<section class="banner-sec">
    <div class="container-main">
        <div class="banner-inner">
            <div class="reveal">
                <div class="banner-ey">Komitmen Kami</div>
                <h2 class="banner-title">Kualitas Terbaik di<br><em>Setiap Hidangan</em></h2>
                <p class="banner-p">Kami selalu menghadirkan masakan rumahan dengan kualitas terbaik, menggunakan bahan segar dan proses higienis untuk setiap sajian yang lezat dan memuaskan.</p>
            </div>
            <a href="{{ route('contact') }}" class="btn-banner reveal d2">
                Pesan Sekarang
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2 7h10M8 3l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </a>
        </div>
    </div>
</section>

{{-- TESTIMONIALS --}}
<section class="testi-sec">
    <div class="container-main">
        <div class="sec-head reveal">
            <div>
                <div class="eyebrow">Ulasan Pelanggan</div>
                <h2 class="sec-title">Apa Kata <em>Mereka?</em></h2>
            </div>
        </div>
        <div class="testi-grid">
            <div class="testi-card reveal d1">
                <div class="testi-quote">"</div>
                <div class="testi-stars"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                <p class="testi-txt">"Makanannya enak banget, rasanya kaya masakan rumah sendiri. Porsinya juga pas. Sangat direkomendasikan!"</p>
                <div class="testi-person">
                    <div class="testi-av"><img src="img/testimonial-1.jpg" alt="Ibu Rina"></div>
                    <div><div class="testi-name">Ibu Rina</div><div class="testi-role">Pelanggan Catering</div></div>
                </div>
            </div>
            <div class="testi-card reveal d2">
                <div class="testi-quote">"</div>
                <div class="testi-stars"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                <p class="testi-txt">"Sudah langganan untuk acara kantor. Rasanya konsisten enak, bersih, packaging rapi. Pelayanan juga sangat ramah."</p>
                <div class="testi-person">
                    <div class="testi-av"><img src="img/testimonial-2.jpg" alt="Pak Andi"></div>
                    <div><div class="testi-name">Pak Andi</div><div class="testi-role">Karyawan Swasta</div></div>
                </div>
            </div>
            <div class="testi-card reveal d3">
                <div class="testi-quote">"</div>
                <div class="testi-stars"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                <p class="testi-txt">"Suka banget sama kebersihannya. Makanannya fresh dan tidak berminyak. Cocok banget buat keluarga dengan anak kecil."</p>
                <div class="testi-person">
                    <div class="testi-av"><img src="img/testimonial-3.jpg" alt="Mbak Sari"></div>
                    <div><div class="testi-name">Mbak Sari</div><div class="testi-role">Ibu Rumah Tangga</div></div>
                </div>
            </div>
            <div class="testi-card reveal d4">
                <div class="testi-quote">"</div>
                <div class="testi-stars"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                <p class="testi-txt">"Harga terjangkau tapi kualitas premium. Cocok banget buat acara keluarga dan hajatan besar maupun kecil."</p>
                <div class="testi-person">
                    <div class="testi-av"><img src="img/testimonial-4.jpg" alt="Bapak Dedi"></div>
                    <div><div class="testi-name">Bapak Dedi</div><div class="testi-role">Pelanggan Tetap</div></div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- BLOG --}}
<section class="blog-sec">
    <div class="container-main">
        <div class="sec-head reveal">
            <div>
                <div class="eyebrow">Artikel</div>
                <h2 class="sec-title">Inspirasi & <em>Tips Masak</em></h2>
                <p style="color:var(--ink-soft);font-size:.88rem;margin-top:10px;font-weight:300;max-width:420px">Tips, inspirasi, dan informasi seputar masakan rumahan untuk Anda.</p>
            </div>
        </div>
        <div class="blog-grid">
            <div class="blog-card reveal d1">
                <div class="blog-img">
                    <img src="img/blog-1.jpg" alt="Blog 1" loading="lazy">
                    <span class="blog-date">10 Feb 2026</span>
                </div>
                <div class="blog-body">
                    <a href="#" class="blog-title-link">Tips Memilih Catering Sehat untuk Keluarga</a>
                    <p class="blog-desc">Pelajari cara memilih catering dengan bahan berkualitas dan proses higienis untuk menjaga kesehatan keluarga Anda setiap hari.</p>
                    <div class="blog-meta">
                        <span><svg width="11" height="11" viewBox="0 0 11 11" fill="none"><circle cx="5.5" cy="5.5" r="4.5" stroke="currentColor" stroke-width="1.2"/><path d="M5.5 3v2.5l1.5 1.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg> Admin</span>
                        <span><svg width="11" height="11" viewBox="0 0 11 11" fill="none"><rect x="1" y="2" width="9" height="8" rx="1.5" stroke="currentColor" stroke-width="1.2"/><path d="M1 5h9M4 1v2M7 1v2" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg> 10 Feb 2026</span>
                    </div>
                </div>
            </div>
            <div class="blog-card reveal d2">
                <div class="blog-img">
                    <img src="img/blog-2.jpg" alt="Blog 2" loading="lazy">
                    <span class="blog-date">12 Feb 2026</span>
                </div>
                <div class="blog-body">
                    <a href="#" class="blog-title-link">Kenapa Masakan Rumahan Lebih Sehat?</a>
                    <p class="blog-desc">Masakan rumahan menggunakan bahan segar dan minim pengawet sehingga lebih aman dan sehat untuk dikonsumsi setiap hari bersama keluarga.</p>
                    <div class="blog-meta">
                        <span><svg width="11" height="11" viewBox="0 0 11 11" fill="none"><circle cx="5.5" cy="5.5" r="4.5" stroke="currentColor" stroke-width="1.2"/><path d="M5.5 3v2.5l1.5 1.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg> Admin</span>
                        <span><svg width="11" height="11" viewBox="0 0 11 11" fill="none"><rect x="1" y="2" width="9" height="8" rx="1.5" stroke="currentColor" stroke-width="1.2"/><path d="M1 5h9M4 1v2M7 1v2" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg> 12 Feb 2026</span>
                    </div>
                </div>
            </div>
            <div class="blog-card reveal d3">
                <div class="blog-img">
                    <img src="img/blog-3.jpg" alt="Blog 3" loading="lazy">
                    <span class="blog-date">15 Feb 2026</span>
                </div>
                <div class="blog-body">
                    <a href="#" class="blog-title-link">Tips Memilih Menu Catering untuk Acara</a>
                    <p class="blog-desc">Bingung pilih menu? Simak tips memilih menu catering yang cocok untuk acara keluarga maupun kantor agar tamu merasa puas.</p>
                    <div class="blog-meta">
                        <span><svg width="11" height="11" viewBox="0 0 11 11" fill="none"><circle cx="5.5" cy="5.5" r="4.5" stroke="currentColor" stroke-width="1.2"/><path d="M5.5 3v2.5l1.5 1.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg> Admin</span>
                        <span><svg width="11" height="11" viewBox="0 0 11 11" fill="none"><rect x="1" y="2" width="9" height="8" rx="1.5" stroke="currentColor" stroke-width="1.2"/><path d="M1 5h9M4 1v2M7 1v2" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg> 15 Feb 2026</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// ── Carousel ──
const slides = document.querySelectorAll('.hero-slide');
const dots   = document.querySelectorAll('.hero-dot');
let current  = 0, timer;

function goSlide(idx) {
    slides[current].classList.remove('active');
    dots[current].classList.remove('active');
    current = (idx + slides.length) % slides.length;
    slides[current].classList.add('active');
    dots[current].classList.add('active');
    resetTimer();
}
function stepSlide(dir) { goSlide(current + dir); }
function resetTimer() {
    clearInterval(timer);
    timer = setInterval(() => goSlide(current + 1), 5000);
}
resetTimer();

// ── Scroll reveal ──
const io = new IntersectionObserver(entries => {
    entries.forEach(e => { if(e.isIntersecting) e.target.classList.add('on') });
}, { threshold:.1, rootMargin:'0px 0px -40px 0px' });
document.querySelectorAll('.reveal').forEach(el => io.observe(el));
</script>
@endsection
