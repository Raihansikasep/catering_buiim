@extends('layouts.frontend')

@section('content')

<style>
:root {
    --clay: #F5EFE6;
    --warm-white: #FDFAF6;
    --ink: #1C1208;
    --ink-mid: #3D2E1A;
    --ink-soft: #7A6A56;
    --ink-ghost: #B5A898;
    --forest: #1B3A20;
    --forest-mid: #2D5C35;
    --mint: #A8D5A2;
    --mint-pale: #E8F5E4;
    --border-warm: rgba(60,40,20,0.1);
    --saffron: #E8B923;
    --saffron-glow: rgba(232,185,35,0.3);
}

/* ── TESTIMONIALS SECTION ── */
.testi-sec {
    padding: 140px 0 160px;
    background: linear-gradient(135deg, var(--clay) 0%, #F8F4EF 100%);
    position: relative;
    overflow: hidden;
}

.testi-sec::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background:
        radial-gradient(circle at 20% 20%, rgba(168,213,162,0.12) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(75,138,85,0.08) 0%, transparent 60%),
        radial-gradient(circle at 50% 10%, rgba(232,185,35,0.05) 0%, transparent 70%);
    pointer-events: none;
    animation: float 20s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: scale(1) rotate(0deg); }
    50% { transform: scale(1.05) rotate(1deg); }
}

.testi-container {
    position: relative;
    z-index: 2;
}

/* Header - Enhanced */
.testi-header {
    text-align: center;
    margin-bottom: 90px;
    position: relative;
}

.testi-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    font-size: 0.85rem;
    font-weight: 600;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--forest-mid);
    margin-bottom: 16px;
    position: relative;
}

.testi-eyebrow::before,
.testi-eyebrow::after {
    content: '';
    width: 42px;
    height: 2px;
    background: linear-gradient(90deg, transparent, var(--mint), transparent);
    position: absolute;
}

.testi-eyebrow::before { left: -50px; }
.testi-eyebrow::after { right: -50px; }

.testi-sec h2 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2.4rem, 5vw, 3.6rem);
    font-weight: 700;
    line-height: 1.12;
    color: var(--ink);
    margin-bottom: 20px;
    position: relative;
    background: linear-gradient(135deg, var(--ink) 0%, var(--forest-mid) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.testi-sec h2 em {
    font-style: italic;
    background: linear-gradient(135deg, var(--forest) 0%, var(--forest-mid) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.testi-sub {
    max-width: 560px;
    margin: 0 auto;
    font-size: 1.05rem;
    color: var(--ink-soft);
    line-height: 1.8;
    position: relative;
}

.testi-sub::before {
    content: '';
    position: absolute;
    top: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 2px;
    background: linear-gradient(90deg, var(--saffron), var(--mint));
    border-radius: 2px;
}

/* Testimonial Grid - Enhanced */
.testi-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 36px;
    max-width: 1200px;
    margin: 0 auto;
}

.testi-card {
    background: var(--warm-white);
    border: 1px solid var(--border-warm);
    border-radius: 28px;
    padding: 42px 36px 36px;
    position: relative;
    transition: all .5s cubic-bezier(0.34, 1.56, 0.64, 1);
    height: 100%;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.testi-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--saffron), var(--mint), var(--forest-mid));
    transform: scaleX(0);
    transition: transform 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.testi-card:hover::before {
    transform: scaleX(1);
}

.testi-card:hover {
    border-color: var(--mint);
    transform: translateY(-16px) scale(1.02);
    box-shadow:
        0 35px 80px rgba(28,18,8,0.15),
        0 0 0 1px rgba(168,213,162,0.2);
}

.testi-quote {
    font-family: 'Playfair Display', serif;
    font-size: 6rem;
    line-height: 0.65;
    font-weight: 800;
    background: linear-gradient(135deg, rgba(168,213,162,0.2) 0%, rgba(232,185,35,0.15) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    position: absolute;
    top: 24px;
    right: 28px;
    user-select: none;
    pointer-events: none;
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
}

/* Enhanced Stars */
.testi-stars {
    display: flex;
    gap: 4px;
    margin-bottom: 22px;
    position: relative;
}

.testi-stars span {
    color: var(--saffron);
    font-size: 1.15rem;
    position: relative;
    transition: all 0.3s ease;
    filter: drop-shadow(0 1px 2px var(--saffron-glow));
}

.testi-card:hover .testi-stars span {
    transform: scale(1.1) rotate(5deg);
    filter: drop-shadow(0 2px 8px var(--saffron-glow));
}

/* Text */
.testi-txt {
    font-size: 0.96rem;
    line-height: 1.9;
    color: var(--ink-mid);
    font-style: italic;
    font-weight: 300;
    flex: 1;
    margin-bottom: 30px;
    position: relative;
}

.testi-txt::before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 40px;
    height: 2px;
    background: linear-gradient(90deg, var(--mint), transparent);
    transform: scaleX(0);
    transition: transform 0.4s ease;
}

.testi-card:hover .testi-txt::before {
    transform: scaleX(1);
}

/* Person - Enhanced */
.testi-person {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-top: auto;
    padding-top: 20px;
    position: relative;
}

.testi-person::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: var(--border-warm);
}

.testi-av {
    width: 54px;
    height: 54px;
    border-radius: 50%;
    overflow: hidden;
    flex-shrink: 0;
    border: 3px solid var(--mint-pale);
    transition: all 0.3s ease;
    position: relative;
}

.testi-card:hover .testi-av {
    border-color: var(--mint);
    transform: scale(1.05);
    box-shadow: 0 8px 20px rgba(168,213,162,0.3);
}

.testi-av::before {
    content: '';
    position: absolute;
    top: -100%;
    left: -100%;
    width: 300%;
    height: 300%;
    background: conic-gradient(from 0deg, transparent, rgba(168,213,162,0.4), transparent 30%);
    animation: spin 2s linear infinite;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.testi-card:hover .testi-av::before {
    opacity: 1;
}

@keyframes spin {
    100% { transform: rotate(360deg); }
}

.testi-av img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.testi-card:hover .testi-av img {
    transform: scale(1.1);
}

.testi-name {
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--ink);
    margin-bottom: 3px;
    transition: color 0.3s ease;
}

.testi-card:hover .testi-name {
    color: var(--forest-mid);
}

.testi-role {
    font-size: 0.78rem;
    color: var(--ink-ghost);
    font-weight: 500;
}

/* Reveal Animation - Enhanced */
.reveal {
    opacity: 0;
    transform: translateY(40px) scale(0.95);
    transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.reveal.on {
    opacity: 1;
    transform: translateY(0) scale(1);
}

.d1 { transition-delay: 0.15s; }
.d2 { transition-delay: 0.3s; }
.d3 { transition-delay: 0.45s; }
.d4 { transition-delay: 0.6s; }

/* Responsive */
@media (max-width: 768px) {
    .testi-sec {
        padding: 100px 0 120px;
    }

    .testi-grid {
        grid-template-columns: 1fr;
        gap: 28px;
    }

    .testi-card {
        padding: 32px 28px;
    }
}
</style>

<section class="testi-sec">
    <div class="container-main testi-container">
        <!-- Header -->
        <div class="testi-header reveal">
            <div class="testi-eyebrow">Testimonial</div>
            <h2>Apa Kata <em>Mereka?</em></h2>
            <p class="testi-sub">
                Ribuan keluarga dan pelanggan telah merasakan kelezatan dan kualitas masakan kami.
            </p>
        </div>

        <!-- Grid Testimonial -->
        <div class="testi-grid">
            <div class="testi-card reveal d1">
                <div class="testi-quote">“</div>
                <div class="testi-stars">
                    <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                </div>
                <p class="testi-txt">
                    "Makanannya enak banget, rasanya kaya masakan rumah sendiri. Porsinya juga pas. Sangat direkomendasikan!"
                </p>
                <div class="testi-person">
                    <div class="testi-av">
                        <img src="img/testimonial-1.jpg" alt="Ibu Rina">
                    </div>
                    <div>
                        <div class="testi-name">Ibu Rina</div>
                        <div class="testi-role">Pelanggan Catering</div>
                    </div>
                </div>
            </div>

            <div class="testi-card reveal d2">
                <div class="testi-quote">“</div>
                <div class="testi-stars">
                    <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                </div>
                <p class="testi-txt">
                    "Sudah langganan untuk acara kantor. Rasanya konsisten enak, bersih, packaging rapi. Pelayanan juga sangat ramah."
                </p>
                <div class="testi-person">
                    <div class="testi-av">
                        <img src="img/testimonial-2.jpg" alt="Pak Andi">
                    </div>
                    <div>
                        <div class="testi-name">Pak Andi</div>
                        <div class="testi-role">Karyawan Swasta</div>
                    </div>
                </div>
            </div>

            <div class="testi-card reveal d3">
                <div class="testi-quote">“</div>
                <div class="testi-stars">
                    <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                </div>
                <p class="testi-txt">
                    "Suka banget sama kebersihannya. Makanannya fresh dan tidak berminyak. Cocok banget buat keluarga dengan anak kecil."
                </p>
                <div class="testi-person">
                    <div class="testi-av">
                        <img src="img/testimonial-3.jpg" alt="Mbak Sari">
                    </div>
                    <div>
                        <div class="testi-name">Mbak Sari</div>
                        <div class="testi-role">Ibu Rumah Tangga</div>
                    </div>
                </div>
            </div>

            <div class="testi-card reveal d4">
                <div class="testi-quote">“</div>
                <div class="testi-stars">
                    <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                </div>
                <p class="testi-txt">
                    "Harga terjangkau tapi kualitas premium. Cocok bangat buat acara keluarga dan hajatan besar maupun kecil."
                </p>
                <div class="testi-person">
                    <div class="testi-av">
                        <img src="img/testimonial-4.jpg" alt="Bapak Dedi">
                    </div>
                    <div>
                        <div class="testi-name">Bapak Dedi</div>
                        <div class="testi-role">Pelanggan Tetap</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Enhanced reveal animation with staggered timing
    const observerOptions = {
        threshold: 0.2,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('on');
                observer.unobserve(entry.target); // Stop observing once revealed
            }
        });
    }, observerOptions);

    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

    // Add cursor pointer for better UX
    document.querySelectorAll('.testi-card').forEach(card => {
        card.style.cursor = 'pointer';
    });
</script>

@endsection
