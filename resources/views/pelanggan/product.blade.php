{{-- =====================================================
   PRODUCT PAGE (product.blade.php)
   ===================================================== --}}

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
body { font-family: 'Outfit', sans-serif; background: var(--cream); color: var(--text-dark); overflow-x: hidden; }

/* HERO */
.product-hero {
    background: var(--green-deep);
    padding: 100px 0 80px;
    position: relative; overflow: hidden;
}
.product-hero::before {
    content: '';
    position: absolute;
    top: -80px; left: -80px;
    width: 500px; height: 500px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(76,175,106,0.1), transparent 60%);
}
.product-hero .container {
    max-width: 1200px; margin: 0 auto; padding: 0 40px;
    position: relative; z-index: 2;
    display: flex; align-items: flex-end; justify-content: space-between;
    gap: 40px; flex-wrap: wrap;
}
.hero-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    font-size: 0.7rem; font-weight: 600; letter-spacing: 0.15em;
    text-transform: uppercase; color: var(--green-accent);
    background: rgba(76,175,106,0.1); border: 1px solid rgba(76,175,106,0.2);
    padding: 7px 16px; border-radius: 30px; margin-bottom: 20px;
    width: fit-content;
}
.product-hero-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(2rem, 4vw, 3.4rem);
    font-weight: 600; line-height: 1.12;
    color: #fff; letter-spacing: -0.02em; margin-bottom: 16px;
}
.product-hero-title em { font-style: italic; color: var(--green-accent); }
.product-hero-desc { color: rgba(255,255,255,0.5); font-size: 0.9rem; line-height: 1.8; font-weight: 300; max-width: 420px; }

.search-group {
    display: flex; gap: 10px;
    background: rgba(255,255,255,0.07);
    border: 1px solid rgba(255,255,255,0.12);
    border-radius: 50px; padding: 6px;
    min-width: 360px;
}
.search-input {
    flex: 1; padding: 10px 20px;
    background: transparent; border: none; outline: none;
    color: #fff; font-size: 0.88rem;
    font-family: 'Outfit', sans-serif;
}
.search-input::placeholder { color: rgba(255,255,255,0.35); }
.search-btn {
    padding: 10px 24px; background: var(--green-bright);
    color: #fff; border: none; border-radius: 50px;
    font-size: 0.82rem; font-weight: 600; cursor: pointer;
    font-family: 'Outfit', sans-serif; transition: all 0.2s;
}
.search-btn:hover { background: var(--green-accent); }

/* FILTER BAR */
.filter-bar {
    background: var(--white);
    border-bottom: 1px solid var(--border);
    position: sticky; top: 0; z-index: 50;
}
.filter-bar .container {
    max-width: 1200px; margin: 0 auto; padding: 0 40px;
}
.filter-inner {
    display: flex; align-items: center; gap: 8px;
    padding: 14px 0; overflow-x: auto;
}
.filter-inner::-webkit-scrollbar { display: none; }
.cat-btn {
    padding: 9px 22px; border-radius: 50px;
    border: 1.5px solid var(--border); background: transparent;
    font-size: 0.8rem; font-weight: 600; color: var(--text-muted);
    cursor: pointer; white-space: nowrap; transition: all 0.2s;
    font-family: 'Outfit', sans-serif; text-decoration: none;
}
.cat-btn:hover { border-color: var(--green-bright); color: var(--green-bright); }
.cat-btn.active { background: var(--green-deep); border-color: var(--green-deep); color: #fff; }

/* PRODUCTS */
.products-main {
    padding: 60px 0 100px;
    background: var(--cream);
}
.products-main .container { max-width: 1200px; margin: 0 auto; padding: 0 40px; }
.products-header {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 36px; flex-wrap: wrap; gap: 12px;
}
.products-count {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.5rem; font-weight: 600; color: var(--text-dark);
}
.products-count span { font-size: 0.85rem; font-weight: 400; color: var(--text-muted); font-family: 'Outfit', sans-serif; margin-left: 8px; }

.products-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }

.product-card {
    background: var(--white);
    border-radius: 20px; overflow: hidden;
    border: 1px solid var(--border);
    transition: all 0.3s ease;
    display: flex; flex-direction: column;
}
.product-card:hover { transform: translateY(-6px); box-shadow: 0 24px 56px rgba(12,34,16,0.1); border-color: transparent; }

.product-card-img {
    position: relative; overflow: hidden;
    aspect-ratio: 4/3; background: var(--green-light);
}
.product-card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; display: block; }
.product-card:hover .product-card-img img { transform: scale(1.08); }
.product-cat-tag {
    position: absolute; top: 12px; left: 12px;
    background: rgba(12,34,16,0.75); backdrop-filter: blur(8px);
    color: #fff; font-size: 0.68rem; font-weight: 600;
    padding: 4px 12px; border-radius: 20px;
    letter-spacing: 0.06em; text-transform: uppercase;
}

.product-card-body { padding: 18px 20px 14px; flex: 1; display: flex; flex-direction: column; }
.product-card-name { font-weight: 600; font-size: 0.95rem; color: var(--text-dark); margin-bottom: 8px; }
.product-card-price {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.2rem; font-weight: 700; color: var(--green-bright); margin-top: auto;
}
.product-card-foot {
    border-top: 1px solid var(--border); padding: 12px 20px;
    display: flex; align-items: center; justify-content: center;
}
.btn-detail {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: 0.8rem; font-weight: 600; color: var(--green-bright); text-decoration: none;
    transition: gap 0.2s;
}
.btn-detail:hover { gap: 12px; }

.empty-state { text-align: center; padding: 80px 20px; }
.empty-state .icon { font-size: 3rem; margin-bottom: 16px; }
.empty-state p { color: var(--text-muted); font-size: 0.9rem; }

.fade-up { opacity: 0; transform: translateY(24px); transition: opacity 0.5s ease, transform 0.5s ease; }
.fade-up.visible { opacity: 1; transform: translateY(0); }

@media (max-width: 1024px) { .products-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 768px) {
    .product-hero .container, .products-main .container { padding: 0 24px; }
    .filter-bar .container { padding: 0 24px; }
    .search-group { min-width: 100%; }
    .product-hero .container { flex-direction: column; align-items: flex-start; }
    .products-grid { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 480px) { .products-grid { grid-template-columns: 1fr; } }
</style>

<div class="product-page">

{{-- HERO --}}
<div class="product-hero">
    <div class="container">
        <div>
            <div class="hero-eyebrow">Menu Kami</div>
            <h1 class="product-hero-title">Pilihan Menu<br><em>Terlezat</em> untuk Anda</h1>
            <p class="product-hero-desc">Temukan berbagai pilihan masakan rumahan yang lezat, sehat, dan siap memenuhi kebutuhan Anda.</p>
        </div>
        <div class="search-group">
            <input type="text" id="searchInput" class="search-input" placeholder="Cari menu favorit kamu..." oninput="filterMenu()">
            <button class="search-btn" onclick="filterMenu()">Cari</button>
        </div>
    </div>
</div>

{{-- FILTER --}}
<div class="filter-bar">
    <div class="container">
        <div class="filter-inner">
            <button class="cat-btn active" onclick="filterCat('all', this)">Semua Menu</button>
            @foreach($categories as $category)
            <button class="cat-btn" onclick="filterCat('{{ $category->id }}', this)">{{ $category->name }}</button>
            @endforeach
        </div>
    </div>
</div>

{{-- PRODUCTS --}}
<div class="products-main">
    <div class="container">
        <div class="products-header">
            <div class="products-count">
                Semua Menu <span id="countLabel">{{ $menus->count() }} menu tersedia</span>
            </div>
        </div>

        <div class="products-grid" id="menuGrid">
            @foreach($menus as $i => $menu)
            <div class="product-card product-item-filter fade-up"
                 data-name="{{ strtolower($menu->name) }}"
                 data-cat="{{ $menu->category_id }}"
                 style="transition-delay: {{ ($i % 8) * 0.05 }}s">
                <div class="product-card-img">
                    <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" loading="lazy">
                    <span class="product-cat-tag">{{ $menu->category->name }}</span>
                </div>
                <div class="product-card-body">
                    <div class="product-card-name">{{ $menu->name }}</div>
                    <div class="product-card-price">Rp {{ number_format($menu->price) }}</div>
                </div>
                <div class="product-card-foot">
                    <a href="{{ route('product.detail', $menu->id) }}" class="btn-detail">Lihat Detail →</a>
                </div>
            </div>
            @endforeach
        </div>

        <div id="emptySearch" class="empty-state d-none">
            <div class="icon">🔍</div>
            <p>Menu tidak ditemukan. Coba kata kunci lain.</p>
        </div>
    </div>
</div>

</div>

<script>
let currentCat = 'all', currentSearch = '';
function filterMenu() {
    currentSearch = document.getElementById('searchInput').value.toLowerCase();
    applyFilter();
}
function filterCat(cat, btn) {
    currentCat = cat;
    document.querySelectorAll('.cat-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    applyFilter();
}
function applyFilter() {
    const items = document.querySelectorAll('.product-item-filter');
    let visible = 0;
    items.forEach(item => {
        const show = item.dataset.name.includes(currentSearch) && (currentCat === 'all' || item.dataset.cat === currentCat);
        item.style.display = show ? '' : 'none';
        if (show) visible++;
    });
    document.getElementById('emptySearch').classList.toggle('d-none', visible > 0);
    document.getElementById('countLabel').textContent = `${visible} menu tersedia`;
}
const observer = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
}, { threshold: 0.05 });
document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
</script>

@endsection
