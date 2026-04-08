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
    --gold-light: #F5EDDA;
    --text-dark: #111A10;
    --text-mid: #3D5040;
    --text-muted: #7A8F7C;
    --white: #FFFFFF;
    --border: rgba(44,90,48,0.12);
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body { font-family: 'Outfit', sans-serif; background: var(--cream); color: var(--text-dark); overflow-x: hidden; }

.serif { font-family: 'Cormorant Garamond', serif; }

/* ===== UTILITY ===== */
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

/* ===== HERO ===== */
.hero {
    position: relative;
    min-height: 100vh;
    display: grid;
    grid-template-columns: 1fr 1fr;
    overflow: hidden;
    background: var(--green-deep);
}

.hero-left {
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 100px 60px 80px 80px;
    z-index: 2;
}

.hero-left::after {
    content: '';
    position: absolute;
    right: -1px; top: 0; bottom: 0;
    width: 80px;
    background: linear-gradient(to right, transparent, var(--green-deep));
    z-index: 3;
}

.hero-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(76,175,106,0.12);
    border: 1px solid rgba(76,175,106,0.25);
    padding: 8px 18px; border-radius: 50px;
    font-size: 0.72rem; font-weight: 600; letter-spacing: 0.1em;
    text-transform: uppercase; color: var(--green-accent);
    margin-bottom: 32px;
    width: fit-content;
}
.hero-badge .dot {
    width: 6px; height: 6px; border-radius: 50%;
    background: var(--green-accent);
    animation: pulse 2s infinite;
}
@keyframes pulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.5; transform: scale(0.8); }
}

.hero-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(3rem, 5vw, 5.2rem);
    font-weight: 600;
    line-height: 1.08;
    color: var(--white);
    margin-bottom: 24px;
    letter-spacing: -0.02em;
}
.hero-title em {
    font-style: italic;
    color: var(--green-accent);
}

.hero-desc {
    color: rgba(255,255,255,0.55);
    font-size: 0.95rem;
    line-height: 1.85;
    max-width: 380px;
    margin-bottom: 44px;
    font-weight: 300;
}

.hero-cta-group { display: flex; align-items: center; gap: 16px; flex-wrap: wrap; }

.btn-primary-hero {
    display: inline-flex; align-items: center; gap: 10px;
    background: var(--green-bright);
    color: #fff;
    padding: 14px 32px;
    border-radius: 50px;
    font-size: 0.875rem; font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    letter-spacing: 0.01em;
}
.btn-primary-hero:hover { background: var(--green-accent); color: #fff; transform: translateY(-2px); box-shadow: 0 12px 32px rgba(45,122,58,0.4); }
.btn-primary-hero .arrow { transition: transform 0.3s; }
.btn-primary-hero:hover .arrow { transform: translateX(4px); }

.btn-ghost-hero {
    display: inline-flex; align-items: center; gap: 8px;
    color: rgba(255,255,255,0.7);
    font-size: 0.875rem; font-weight: 500;
    text-decoration: none;
    padding: 14px 0;
    transition: color 0.2s;
    letter-spacing: 0.01em;
}
.btn-ghost-hero:hover { color: #fff; }

.hero-stats {
    display: flex; gap: 32px;
    margin-top: 52px;
    padding-top: 32px;
    border-top: 1px solid rgba(255,255,255,0.1);
}
.hero-stat .num {
    font-family: 'Cormorant Garamond', serif;
    font-size: 2.2rem; font-weight: 700;
    color: var(--green-accent);
    line-height: 1;
    margin-bottom: 4px;
}
.hero-stat .label {
    font-size: 0.75rem;
    color: rgba(255,255,255,0.4);
    font-weight: 400;
    letter-spacing: 0.05em;
}

.hero-right {
    position: relative;
    overflow: hidden;
}
.hero-right img {
    width: 100%; height: 100%;
    object-fit: cover;
    display: block;
    filter: brightness(0.75) saturate(1.1);
    transition: transform 8s ease;
}
.hero-right:hover img { transform: scale(1.04); }

.hero-right-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(135deg, var(--green-deep) 0%, transparent 50%);
}

.hero-scroll {
    position: absolute;
    bottom: 36px; left: 80px;
    display: flex; align-items: center; gap: 10px;
    font-size: 0.72rem; letter-spacing: 0.12em; text-transform: uppercase;
    color: rgba(255,255,255,0.35);
    z-index: 10;
}
.hero-scroll::after {
    content: '';
    width: 40px; height: 1px;
    background: rgba(255,255,255,0.2);
}

/* Slide dots */
.hero-dots {
    position: absolute;
    bottom: 36px; right: 32px;
    display: flex; gap: 8px;
    z-index: 10;
}
.hero-dot {
    width: 6px; height: 6px; border-radius: 50%;
    background: rgba(255,255,255,0.3);
    cursor: pointer; transition: all 0.3s;
}
.hero-dot.active { width: 24px; border-radius: 3px; background: var(--green-accent); }

/* ===== TRUST STRIP ===== */
.trust-strip {
    background: var(--white);
    border-bottom: 1px solid var(--border);
    padding: 20px 0;
}
.trust-strip .inner {
    max-width: 1200px; margin: 0 auto;
    padding: 0 40px;
    display: flex; align-items: center; justify-content: space-between;
    gap: 20px; flex-wrap: wrap;
}
.trust-item {
    display: flex; align-items: center; gap: 10px;
    font-size: 0.82rem; font-weight: 500; color: var(--text-mid);
}
.trust-item .icon-wrap {
    width: 34px; height: 34px; border-radius: 8px;
    background: var(--green-light);
    display: flex; align-items: center; justify-content: center;
    font-size: 0.9rem;
}
.trust-divider {
    width: 1px; height: 28px;
    background: var(--border);
}

/* ===== ABOUT ===== */
.about-section {
    padding: 100px 0;
    background: var(--cream);
}
.about-section .container {
    max-width: 1200px; margin: 0 auto;
    padding: 0 40px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 80px;
    align-items: center;
}

.about-img-grid {
    display: grid;
    grid-template-columns: 1.2fr 1fr;
    grid-template-rows: auto auto;
    gap: 14px;
}
.about-img-1 {
    grid-column: 1; grid-row: 1 / span 2;
    border-radius: 24px; overflow: hidden;
    aspect-ratio: 3/4;
}
.about-img-2 {
    grid-column: 2; grid-row: 1;
    border-radius: 20px; overflow: hidden;
    aspect-ratio: 4/3;
}
.about-img-badge-box {
    grid-column: 2; grid-row: 2;
    background: var(--green-deep);
    border-radius: 20px;
    padding: 24px;
    display: flex; flex-direction: column;
    justify-content: center;
    gap: 4px;
}
.about-img-badge-box .big {
    font-family: 'Cormorant Garamond', serif;
    font-size: 2.4rem; font-weight: 700;
    color: var(--green-accent);
    line-height: 1;
}
.about-img-badge-box .small {
    font-size: 0.78rem; color: rgba(255,255,255,0.5); font-weight: 400;
    line-height: 1.4;
}

.about-img-1 img,
.about-img-2 img {
    width: 100%; height: 100%; object-fit: cover;
    transition: transform 0.6s ease;
}
.about-img-1:hover img,
.about-img-2:hover img { transform: scale(1.04); }

.about-content {}
.about-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(2rem, 3.5vw, 3rem);
    font-weight: 600; line-height: 1.2;
    color: var(--text-dark);
    margin-bottom: 20px;
    letter-spacing: -0.02em;
}
.about-title em { font-style: italic; color: var(--green-bright); }
.about-text {
    color: var(--text-muted);
    font-size: 0.92rem;
    line-height: 1.9;
    margin-bottom: 14px;
    font-weight: 300;
}

.check-list {
    list-style: none;
    margin: 28px 0 36px;
    display: flex; flex-direction: column; gap: 12px;
}
.check-list li {
    display: flex; align-items: center; gap: 12px;
    font-size: 0.875rem; font-weight: 500; color: var(--text-dark);
}
.check-icon {
    width: 22px; height: 22px; border-radius: 50%;
    background: var(--green-light);
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.check-icon svg { width: 11px; height: 11px; }

.btn-link-green {
    display: inline-flex; align-items: center; gap: 10px;
    color: var(--green-bright);
    font-size: 0.875rem; font-weight: 600;
    text-decoration: none;
    padding-bottom: 4px;
    border-bottom: 1.5px solid var(--green-bright);
    transition: all 0.2s;
    letter-spacing: 0.01em;
}
.btn-link-green:hover { color: var(--green-accent); border-color: var(--green-accent); gap: 16px; }

/* ===== FEATURES ===== */
.features-section {
    padding: 100px 0;
    background: var(--white);
}
.features-section .container {
    max-width: 1200px; margin: 0 auto;
    padding: 0 40px;
}
.section-header {
    display: flex; align-items: flex-end; justify-content: space-between;
    margin-bottom: 56px; flex-wrap: wrap; gap: 20px;
}
.section-header-left {}
.section-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(1.8rem, 3vw, 2.6rem);
    font-weight: 600; line-height: 1.2;
    color: var(--text-dark);
    letter-spacing: -0.02em;
}
.section-title em { font-style: italic; color: var(--green-bright); }
.section-sub {
    color: var(--text-muted);
    font-size: 0.88rem; line-height: 1.8;
    max-width: 400px; margin-top: 12px;
    font-weight: 300;
}

.features-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }

.feature-card {
    background: var(--cream);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 36px 28px;
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}
.feature-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--green-mid), var(--green-accent));
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.4s ease;
}
.feature-card:hover { background: var(--white); border-color: rgba(44,90,48,0.2); transform: translateY(-4px); box-shadow: 0 20px 48px rgba(12,34,16,0.08); }
.feature-card:hover::before { transform: scaleX(1); }

.feature-num {
    font-family: 'Cormorant Garamond', serif;
    font-size: 3rem; font-weight: 700;
    color: rgba(44,90,48,0.08);
    line-height: 1;
    position: absolute;
    top: 20px; right: 24px;
    letter-spacing: -0.04em;
}
.feature-icon {
    width: 52px; height: 52px; border-radius: 14px;
    background: var(--green-light);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.3rem; margin-bottom: 20px;
    transition: background 0.3s;
}
.feature-card:hover .feature-icon { background: var(--green-bright); }
.feature-title { font-weight: 600; font-size: 1rem; color: var(--text-dark); margin-bottom: 10px; }
.feature-desc { font-size: 0.85rem; color: var(--text-muted); line-height: 1.75; font-weight: 300; }

/* ===== PRODUCTS ===== */
.products-section {
    padding: 100px 0;
    background: var(--cream);
}
.products-section .container {
    max-width: 1200px; margin: 0 auto;
    padding: 0 40px;
}

.cat-tabs {
    display: flex; gap: 8px; flex-wrap: wrap;
    margin-bottom: 48px;
}
.cat-tab {
    padding: 9px 22px;
    border-radius: 50px;
    border: 1.5px solid var(--border);
    background: transparent;
    font-size: 0.8rem; font-weight: 600;
    color: var(--text-muted);
    cursor: pointer;
    text-decoration: none;
    transition: all 0.2s;
    font-family: 'Outfit', sans-serif;
}
.cat-tab:hover { border-color: var(--green-bright); color: var(--green-bright); }
.cat-tab.active { background: var(--green-deep); border-color: var(--green-deep); color: #fff; }

.products-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }

.product-card {
    background: var(--white);
    border-radius: 20px;
    overflow: hidden;
    border: 1px solid var(--border);
    transition: all 0.3s ease;
    display: flex; flex-direction: column;
}
.product-card:hover { transform: translateY(-6px); box-shadow: 0 24px 56px rgba(12,34,16,0.1); border-color: transparent; }

.product-card-img {
    position: relative; overflow: hidden;
    aspect-ratio: 4/3;
    background: var(--green-light);
}
.product-card-img img {
    width: 100%; height: 100%; object-fit: cover;
    transition: transform 0.5s ease;
    display: block;
}
.product-card:hover .product-card-img img { transform: scale(1.08); }

.product-cat-tag {
    position: absolute; top: 12px; left: 12px;
    background: rgba(12,34,16,0.75);
    backdrop-filter: blur(8px);
    color: #fff;
    font-size: 0.68rem; font-weight: 600;
    padding: 4px 12px; border-radius: 20px;
    letter-spacing: 0.06em; text-transform: uppercase;
}

.product-card-body {
    padding: 18px 20px 14px;
    flex: 1;
    display: flex; flex-direction: column;
}
.product-card-name {
    font-weight: 600; font-size: 0.95rem;
    color: var(--text-dark); margin-bottom: 8px;
}
.product-card-price {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.2rem; font-weight: 700;
    color: var(--green-bright);
    margin-top: auto;
}

.product-card-foot {
    border-top: 1px solid var(--border);
    padding: 12px 20px;
    display: flex; align-items: center; justify-content: center;
}
.btn-detail {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: 0.8rem; font-weight: 600;
    color: var(--green-bright); text-decoration: none;
    transition: gap 0.2s;
}
.btn-detail:hover { gap: 12px; color: var(--green-mid); }

.view-more-wrap { text-align: center; margin-top: 48px; }
.btn-outline-green {
    display: inline-flex; align-items: center; gap: 10px;
    padding: 14px 40px;
    border: 2px solid var(--green-bright);
    color: var(--green-bright);
    border-radius: 50px;
    font-size: 0.875rem; font-weight: 600;
    text-decoration: none;
    transition: all 0.3s;
    letter-spacing: 0.01em;
}
.btn-outline-green:hover { background: var(--green-deep); border-color: var(--green-deep); color: #fff; transform: translateY(-2px); }

/* ===== BANNER ===== */
.banner-section {
    position: relative;
    overflow: hidden;
    background: var(--green-deep);
    padding: 90px 0;
}
.banner-section::before {
    content: '';
    position: absolute;
    top: -120px; right: -120px;
    width: 500px; height: 500px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(76,175,106,0.12), transparent 60%);
}
.banner-section::after {
    content: '';
    position: absolute;
    bottom: -80px; left: -80px;
    width: 350px; height: 350px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(76,175,106,0.07), transparent 60%);
}
.banner-section .container {
    max-width: 1200px; margin: 0 auto;
    padding: 0 40px;
    position: relative; z-index: 2;
    display: flex; align-items: center; justify-content: space-between;
    gap: 40px; flex-wrap: wrap;
}
.banner-left {}
.banner-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    font-size: 0.7rem; font-weight: 600; letter-spacing: 0.15em;
    text-transform: uppercase; color: var(--green-accent);
    margin-bottom: 16px;
}
.banner-eyebrow::before {
    content: ''; display: block;
    width: 28px; height: 1.5px; background: var(--green-accent);
}
.banner-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(1.8rem, 3.5vw, 3rem);
    font-weight: 600; line-height: 1.15;
    color: #fff;
    letter-spacing: -0.02em;
}
.banner-title em { font-style: italic; color: var(--green-accent); }
.banner-desc {
    color: rgba(255,255,255,0.5);
    font-size: 0.9rem; line-height: 1.8;
    max-width: 520px; margin-top: 16px;
    font-weight: 300;
}
.btn-banner {
    display: inline-flex; align-items: center; gap: 10px;
    background: var(--green-accent);
    color: var(--green-deep);
    padding: 16px 40px;
    border-radius: 50px;
    font-size: 0.875rem; font-weight: 700;
    text-decoration: none;
    transition: all 0.3s;
    white-space: nowrap;
}
.btn-banner:hover { background: #fff; transform: translateY(-2px); box-shadow: 0 12px 32px rgba(0,0,0,0.2); }

/* ===== TESTIMONIALS ===== */
.testimonials-section {
    padding: 100px 0;
    background: var(--white);
}
.testimonials-section .container {
    max-width: 1200px; margin: 0 auto;
    padding: 0 40px;
}

.testimonials-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }

.testi-card {
    background: var(--cream);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 28px 24px;
    transition: all 0.3s;
    position: relative;
}
.testi-card:hover { background: var(--white); border-color: rgba(44,90,48,0.2); transform: translateY(-4px); box-shadow: 0 16px 40px rgba(12,34,16,0.08); }
.testi-card::before {
    content: '"';
    font-family: 'Cormorant Garamond', serif;
    font-size: 4rem; line-height: 1;
    color: var(--green-light);
    position: absolute;
    top: 16px; right: 20px;
    font-weight: 700;
}

.testi-stars { display: flex; gap: 2px; margin-bottom: 14px; }
.testi-stars span { color: var(--gold); font-size: 0.8rem; }
.testi-text { font-size: 0.875rem; line-height: 1.8; color: var(--text-mid); margin-bottom: 20px; font-weight: 300; font-style: italic; }
.testi-author { display: flex; align-items: center; gap: 12px; }
.testi-avatar {
    width: 40px; height: 40px; border-radius: 50%;
    overflow: hidden; flex-shrink: 0;
    background: var(--green-light);
}
.testi-avatar img { width: 100%; height: 100%; object-fit: cover; }
.testi-name { font-size: 0.85rem; font-weight: 600; color: var(--text-dark); }
.testi-role { font-size: 0.72rem; color: var(--text-muted); margin-top: 1px; }

/* ===== BLOG ===== */
.blog-section {
    padding: 100px 0;
    background: var(--cream);
}
.blog-section .container {
    max-width: 1200px; margin: 0 auto;
    padding: 0 40px;
}
.blog-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }

.blog-card {
    background: var(--white);
    border-radius: 20px; overflow: hidden;
    border: 1px solid var(--border);
    transition: all 0.3s;
    display: flex; flex-direction: column;
}
.blog-card:hover { transform: translateY(-4px); box-shadow: 0 20px 48px rgba(12,34,16,0.08); border-color: transparent; }

.blog-card-img {
    position: relative; overflow: hidden;
    aspect-ratio: 16/9;
    background: var(--green-light);
}
.blog-card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; display: block; }
.blog-card:hover .blog-card-img img { transform: scale(1.05); }
.blog-date-badge {
    position: absolute; top: 14px; left: 14px;
    background: rgba(12,34,16,0.8); backdrop-filter: blur(8px);
    color: #fff; font-size: 0.68rem; font-weight: 600;
    padding: 4px 12px; border-radius: 20px;
    letter-spacing: 0.04em;
}

.blog-card-body { padding: 24px; flex: 1; display: flex; flex-direction: column; }
.blog-card-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.2rem; font-weight: 600; line-height: 1.35;
    color: var(--text-dark); margin-bottom: 12px;
    text-decoration: none; display: block;
    transition: color 0.2s;
}
.blog-card-title:hover { color: var(--green-bright); }
.blog-card-desc { font-size: 0.83rem; color: var(--text-muted); line-height: 1.75; font-weight: 300; flex: 1; margin-bottom: 20px; }
.blog-card-meta {
    display: flex; align-items: center; gap: 16px;
    font-size: 0.75rem; color: var(--text-muted);
    padding-top: 16px; border-top: 1px solid var(--border);
}
.blog-card-meta span { display: flex; align-items: center; gap: 5px; }

/* ===== RESPONSIVE ===== */
@media (max-width: 1024px) {
    .hero { grid-template-columns: 1fr; min-height: auto; }
    .hero-right { display: none; }
    .hero-left { padding: 80px 40px 80px; }
    .about-section .container { grid-template-columns: 1fr; gap: 48px; }
    .about-img-grid { max-width: 500px; }
    .features-grid { grid-template-columns: repeat(2, 1fr); }
    .products-grid { grid-template-columns: repeat(2, 1fr); }
    .testimonials-grid { grid-template-columns: repeat(2, 1fr); }
    .blog-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 768px) {
    .hero-left { padding: 70px 24px; }
    .hero-stats { gap: 20px; }
    .about-section .container,
    .features-section .container,
    .products-section .container,
    .testimonials-section .container,
    .blog-section .container { padding: 0 24px; }
    .features-grid { grid-template-columns: 1fr; }
    .products-grid { grid-template-columns: 1fr; }
    .testimonials-grid { grid-template-columns: 1fr; }
    .blog-grid { grid-template-columns: 1fr; }
    .section-header { flex-direction: column; align-items: flex-start; }
    .trust-strip .inner { padding: 0 24px; flex-wrap: wrap; justify-content: center; }
    .trust-divider { display: none; }
    .banner-section .container { flex-direction: column; text-align: center; }
    .banner-eyebrow { margin: 0 auto 16px; }
    .banner-desc { margin: 16px auto 0; }
}

/* ===== ANIMATIONS ===== */
.fade-up {
    opacity: 0;
    transform: translateY(30px);
    transition: opacity 0.6s ease, transform 0.6s ease;
}
.fade-up.visible { opacity: 1; transform: translateY(0); }
.fade-up-delay-1 { transition-delay: 0.1s; }
.fade-up-delay-2 { transition-delay: 0.2s; }
.fade-up-delay-3 { transition-delay: 0.3s; }
.fade-up-delay-4 { transition-delay: 0.4s; }
</style>


<!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">

            <!-- SLIDE 1 -->
            <div class="carousel-item active position-relative">
                <img class="carousel-img" src="img/8e1e17f5f76a43bcb1fea0cc4ff951e1.jpg" alt="Image">

                <div class="overlay-dark"></div>

                <div class="carousel-caption d-flex justify-content-center align-items-center text-center">
                    <div class="col-lg-8">
                        <h1 class="display-3 text-white fw-bold mb-3">
                            Masakan Rumahan Berkualitas
                        </h1>
                        <p class="fs-5 text-white mb-2">
                            Disiapkan dari bahan segar pilihan dengan cita rasa khas rumahan
                        </p>
                        <p class="text-white">
                            Cocok untuk kebutuhan harian, acara keluarga, hingga katering kantor dengan kualitas terbaik
                        </p>
                    </div>
                </div>
            </div>

            <!-- SLIDE 2 -->
            <div class="carousel-item position-relative">
                <img class="carousel-img" src="img/catering lunch box (4).jpg" alt="Image">

                <div class="overlay-dark"></div>

                <div class="carousel-caption d-flex justify-content-center align-items-center text-center">
                    <div class="col-lg-8">
                        <h1 class="display-3 text-white fw-bold mb-3">
                            Menu Sehat & Lezat
                        </h1>
                        <p class="fs-5 text-white mb-2">
                            Perpaduan rasa nikmat dan nutrisi seimbang untuk keluarga Anda
                        </p>
                        <p class="text-white">
                            Tersedia berbagai pilihan menu nasi kotak, snack box, dan paket catering harian
                        </p>
                    </div>
                </div>
            </div>

        </div>

        <!-- NAV -->
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
            <span class="custom-arrow">&lt;</span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
            <span class="custom-arrow">&gt;</span>
        </button>

    </div>
</div>
    <!-- Carousel End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">

                <!-- IMAGE -->
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="about-img position-relative">
                        <img class="img-fluid w-100 rounded-4 shadow-lg" src="img/nasbox (1).jpg">
                    </div>
                </div>

                <!-- TEXT -->
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">

                    <h1 class="display-5 fw-bold mb-4">
                        Masakan Rumahan Lezat & Berkualitas
                    </h1>

                    <p class="mb-4 text-muted">
                        Kami menghadirkan hidangan rumahan dengan kualitas terbaik yang dibuat dari bahan segar pilihan.
                        Setiap menu diolah dengan penuh perhatian untuk memberikan rasa yang autentik dan kepuasan maksimal.
                    </p>

                    <div class="mb-4">
                        <p class="d-flex align-items-center mb-2">
                            <i class="fa fa-check-circle text-success me-2"></i>
                            Masakan rumahan berkualitas premium
                        </p>
                        <p class="d-flex align-items-center mb-2">
                            <i class="fa fa-check-circle text-success me-2"></i>
                            Bahan segar, higienis & terpercaya
                        </p>
                        <p class="d-flex align-items-center mb-2">
                            <i class="fa fa-check-circle text-success me-2"></i>
                            Rasa lezat & konsisten setiap hari
                        </p>
                    </div>

                    <a class="btn btn-success btn-modern px-4 py-2 mt-2" href="{{ route('about') }}">
                        Baca Selengkapnya
                    </a>

                </div>

            </div>
        </div>
    </div>
    <!-- About End -->


       <!-- Feature Start -->
    <div class="container-fluid bg-light py-6">
    <div class="container">

        <!-- HEADER -->
        <div class="text-center mx-auto mb-5" style="max-width: 500px;">
            <h1 class="display-5 mb-3">Keunggulan Kami</h1>
            <p class="text-muted">
                Kami menyediakan masakan rumahan berkualitas dengan bahan segar dan rasa terbaik untuk kepuasan Anda.
            </p>
        </div>

        <div class="row g-4">

            <!-- ITEM 1 -->
            <div class="col-lg-4 col-md-6">
                <div class="feature-card text-center p-4">

                    <div class="icon-box mb-4">
                        <img src="img/icon-1.png" alt="">
                    </div>

                    <h4 class="mb-3">Bahan Berkualitas</h4>
                    <p class="text-muted">
                        Menggunakan bahan segar pilihan.
                    </p>

                </div>
            </div>

            <!-- ITEM 2 -->
            <div class="col-lg-4 col-md-6">
                <div class="feature-card text-center p-4">

                    <div class="icon-box mb-4">
                        <img src="img/icon-1.png" alt="">
                    </div>

                    <h4 class="mb-3">Masakan Rumahan</h4>
                    <p class="text-muted">
                        Cita rasa khas rumahan yang autentik dan lezat.
                    </p>

                </div>
            </div>

            <!-- ITEM 3 -->
            <div class="col-lg-4 col-md-6">
                <div class="feature-card text-center p-4">

                    <div class="icon-box mb-4">
                        <img src="img/icon-1.png" alt="">
                    </div>

                    <h4 class="mb-3">Aman & Higienis</h4>
                    <p class="text-muted">
                        Diproses dengan standar kebersihan terbaik.
                    </p>

                </div>
            </div>
            <div class="text-center mt-4">
            <a href="{{ route('about') }}" class="btn btn-success rounded-pill px-5 py-3">
                Baca Selengkapnya
            </a>
        </div>
        </div>
    </div>
</div>
    <!-- Feature End -->

     <!-- MODAL POPUP -->
    <div class="modal fade" id="featureModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Judul</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body text-center">
                    <p>Isi deskripsi</p>
                </div>

            </div>
        </div>
    </div>
    <!-- modal pop op End -->


    <!-- Product Start -->
    <div class="container-xxl py-5">
    <div class="container">

        {{-- HEADER --}}
        <div class="row g-0 gx-5 align-items-end">
            <div class="col-lg-6">
                <h1 class="display-5 mb-3">Produk Kami</h1>
                <p>Pilihan catering lezat untuk Anda</p>
            </div>

            {{-- CATEGORY TAB --}}
            <div class="col-lg-6 text-lg-end">
                <ul class="nav nav-pills d-inline-flex mb-5">

                    {{-- TAB SEMUA --}}
                    <li class="nav-item me-2">
                        <a class="btn btn-outline-success border-2 active"
                           data-bs-toggle="pill"
                           href="#tab-all">
                            Semua
                        </a>
                    </li>

                    {{-- LOOP CATEGORY --}}
                    @foreach($categories as $category)
                        <li class="nav-item me-2">
                            <a class="btn btn-outline-success border-2"
                               data-bs-toggle="pill"
                               href="#tab-{{ $category->id }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>

        {{-- TAB CONTENT --}}
        <div class="tab-content">

            {{-- ================= SEMUA ================= --}}
            <div id="tab-all" class="tab-pane fade show active">
                <div class="row g-4">

                    @foreach($menus as $menu)
                    <div class="col-xl-3 col-lg-4 col-md-6">

                        <div class="product-item border rounded shadow-sm">

                            <div class="position-relative bg-light overflow-hidden">
                                <img class="img-fluid w-100"
                                     src="{{ asset('storage/'.$menu->image) }}"
                                     style="height:220px; object-fit:cover;">

                                <div class="bg-secondary text-white position-absolute top-0 start-0 m-3 px-2 py-1 rounded">
                                    {{ $menu->category->name }}
                                </div>
                            </div>

                            <div class="text-center p-4">
                                <h5 class="mb-2">{{ $menu->name }}</h5>

                                <span class="text-success">
                                    Rp {{ number_format($menu->price) }}
                                </span>
                            </div>

                            <div class="d-flex border-top">
                                <small class="w-100 text-center py-2">
                                    <a href="{{ route('product.detail', $menu->id) }}">
                                        <i class="fa fa-eye text-success me-2"></i>Detail
                                    </a>
                                </small>
                            </div>

                        </div>

                    </div>
                    @endforeach

                </div>
            </div>

            {{-- ================= PER KATEGORI ================= --}}
            @foreach($categories as $category)
            <div id="tab-{{ $category->id }}" class="tab-pane fade">
                <div class="row g-4">

                    @foreach($menus->where('category_id', $category->id) as $menu)
                    <div class="col-xl-3 col-lg-4 col-md-6">

                        <div class="product-item border rounded shadow-sm">

                            <div class="position-relative bg-light overflow-hidden">
                                <img class="img-fluid w-100"
                                     src="{{ asset('storage/'.$menu->image) }}"
                                     style="height:220px; object-fit:cover;">

                                <div class="bg-secondary text-white position-absolute top-0 start-0 m-3 px-2 py-1 rounded">
                                    {{ $category->name }}
                                </div>
                            </div>

                            <div class="text-center p-4">
                                <h5 class="mb-2">{{ $menu->name }}</h5>

                                <span class="text-success">
                                    Rp {{ number_format($menu->price) }}
                                </span>
                            </div>

                            <div class="d-flex border-top">
                                <small class="w-100 text-center py-2">
                                    <a href="{{ route('product.detail', $menu->id) }}">
                                        <i class="fa fa-eye text-success me-2"></i>Detail
                                    </a>
                                </small>
                            </div>

                        </div>

                    </div>
                    @endforeach

                </div>
            </div>
            @endforeach

        </div>
        <div class="text-center mt-4">
            <a href="{{ route('product') }}" class="btn btn-success rounded-pill px-5 py-3">
                Lihat Selengkapnya
            </a>
        </div>

    </div>
</div>
    <!-- Product End -->


    <!-- ===== BANNER ===== -->
<div class="banner-section">
    <div class="container">
        <div class="banner-left">
            <div class="banner-eyebrow">Komitmen Kami</div>
            <h2 class="banner-title">Kualitas Terbaik di<br><em>Setiap Hidangan</em></h2>
            <p class="banner-desc">
                Kami selalu menghadirkan masakan rumahan dengan kualitas terbaik, menggunakan bahan segar dan proses higienis untuk memastikan setiap hidangan lezat, sehat, dan memuaskan.
            </p>
        </div>
        <a href="{{ route('contact') }}" class="btn-banner">
            Pesan Sekarang →
        </a>
    </div>
</div>


    <!-- ===== TESTIMONIALS ===== -->
<div class="testimonials-section">
    <div class="container">

        <div class="section-header">
            <div class="section-header-left">
                <div class="section-eyebrow">Ulasan Pelanggan</div>
                <h2 class="section-title">Apa Kata <em>Mereka?</em></h2>
            </div>
        </div>

        <div class="testimonials-grid">

            <div class="testi-card fade-up">
                <div class="testi-stars">
                    <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                </div>
                <p class="testi-text">"Makanannya enak banget, rasanya kaya masakan rumah sendiri. Porsinya juga pas. Recommended!"</p>
                <div class="testi-author">
                    <div class="testi-avatar"><img src="img/testimonial-1.jpg" alt="Ibu Rina"></div>
                    <div>
                        <div class="testi-name">Ibu Rina</div>
                        <div class="testi-role">Pelanggan Catering</div>
                    </div>
                </div>
            </div>

            <div class="testi-card fade-up fade-up-delay-1">
                <div class="testi-stars">
                    <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                </div>
                <p class="testi-text">"Sudah langganan untuk acara kantor. Rasanya konsisten enak, bersih, dan packaging rapi. Pelayanan juga ramah."</p>
                <div class="testi-author">
                    <div class="testi-avatar"><img src="img/testimonial-2.jpg" alt="Pak Andi"></div>
                    <div>
                        <div class="testi-name">Pak Andi</div>
                        <div class="testi-role">Karyawan Swasta</div>
                    </div>
                </div>
            </div>

            <div class="testi-card fade-up fade-up-delay-2">
                <div class="testi-stars">
                    <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                </div>
                <p class="testi-text">"Suka banget sama kebersihannya. Makanannya fresh dan tidak berminyak. Cocok buat keluarga."</p>
                <div class="testi-author">
                    <div class="testi-avatar"><img src="img/testimonial-3.jpg" alt="Mbak Sari"></div>
                    <div>
                        <div class="testi-name">Mbak Sari</div>
                        <div class="testi-role">Ibu Rumah Tangga</div>
                    </div>
                </div>
            </div>

            <div class="testi-card fade-up fade-up-delay-3">
                <div class="testi-stars">
                    <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                </div>
                <p class="testi-text">"Harga terjangkau tapi kualitas premium. Cocok banget buat acara keluarga dan hajatan besar."</p>
                <div class="testi-author">
                    <div class="testi-avatar"><img src="img/testimonial-4.jpg" alt="Bapak Dedi"></div>
                    <div>
                        <div class="testi-name">Bapak Dedi</div>
                        <div class="testi-role">Pelanggan Tetap</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


    <!-- Blog Start -->
    <div class="container-xxl py-5">
    <div class="container">

        <!-- HEADER -->
        <div class="text-center mx-auto mb-5" style="max-width: 550px;">
            <h1 class="display-5 mb-3">Artikel Terbaru</h1>
            <p class="text-muted">
                Temukan berbagai tips, inspirasi, dan informasi seputar masakan rumahan
                serta panduan memilih catering terbaik untuk kebutuhan Anda.
            </p>
        </div>

        <div class="row g-4">

            <!-- ITEM 1 -->
            <div class="col-lg-4 col-md-6">
                <div class="blog-card">

                    <div class="blog-img">
                        <img src="img/blog-1.jpg" alt="">
                    </div>

                    <div class="blog-content">
                        <a href="#" class="blog-title">
                            Tips Memilih Catering Sehat untuk Keluarga
                        </a>

                        <p class="blog-desc">
                            Pelajari cara memilih catering dengan bahan berkualitas dan proses higienis untuk menjaga kesehatan keluarga Anda.
                        </p>

                        <div class="blog-meta">
                            <span><i class="fa fa-user"></i> Admin</span>
                            <span><i class="fa fa-calendar"></i> 10 Feb 2026</span>
                        </div>
                    </div>

                </div>
            </div>

                <!-- ITEM 2 -->
                <div class="col-lg-4 col-md-6">
                    <div class="blog-card">

                        <div class="blog-img">
                            <img src="img/blog-2.jpg" alt="">
                        </div>

                        <div class="blog-content">
                            <a href="#" class="blog-title">
                                Kenapa Masakan Rumahan Lebih Sehat?
                            </a>

                            <p class="blog-desc">
                                Masakan rumahan menggunakan bahan segar dan minim pengawet sehingga lebih aman dan sehat untuk dikonsumsi setiap hari.
                            </p>

                            <div class="blog-meta">
                                <span><i class="fa fa-user"></i> Admin</span>
                                <span><i class="fa fa-calendar"></i> 12 Feb 2026</span>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- ITEM 3 -->
                <div class="col-lg-4 col-md-6">
                    <div class="blog-card">

                        <div class="blog-img">
                            <img src="img/blog-3.jpg" alt="">
                        </div>

                        <div class="blog-content">
                            <a href="#" class="blog-title">
                                Tips Memilih Menu Catering untuk Acara
                            </a>

                            <p class="blog-desc">
                                Bingung pilih menu? Simak tips memilih menu catering yang cocok untuk acara keluarga maupun kantor.
                            </p>

                            <div class="blog-meta">
                                <span><i class="fa fa-user"></i> Admin</span>
                                <span><i class="fa fa-calendar"></i> 15 Feb 2026</span>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Blog End -->
<script>
// Scroll reveal
const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => {
        if (e.isIntersecting) { e.target.classList.add('visible'); }
    });
}, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));

// Hero slides
const slides = [
    'img/8e1e17f5f76a43bcb1fea0cc4ff951e1.jpg',
    'img/catering lunch box (4).jpg'
];
let currentSlide = 0;
function switchSlide(idx) {
    currentSlide = idx;
    document.getElementById('heroImg').src = slides[idx];
    document.querySelectorAll('.hero-dot').forEach((d, i) => d.classList.toggle('active', i === idx));
}
setInterval(() => switchSlide((currentSlide + 1) % slides.length), 5000);
</script>
@endsection
