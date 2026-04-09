@extends('layouts.frontend')
@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500;600&display=swap');

:root {
    --clay: #F5EFE6;
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
.prod-hero{
    background:var(--forest);
    padding:100px 0 80px;
    position:relative;overflow:hidden;
}
.prod-hero::before{
    content:'';position:absolute;
    top:-80px;left:-80px;
    width:500px;height:500px;border-radius:50%;
    background:radial-gradient(circle,rgba(168,213,162,.1),transparent 62%);
}
.hero-inner{
    position:relative;z-index:2;
    display:flex;align-items:flex-end;
    justify-content:space-between;
    gap:40px;flex-wrap:wrap;
}
.hero-tag{
    display:inline-flex;align-items:center;gap:8px;
    background:rgba(168,213,162,.12);
    border:1px solid rgba(168,213,162,.22);
    padding:7px 18px;border-radius:100px;
    font-size:.71rem;font-weight:600;letter-spacing:.12em;
    text-transform:uppercase;color:var(--mint);
    margin-bottom:20px;width:fit-content;
}
.hero-title{
    font-family:'Playfair Display',serif;
    font-size:clamp(2rem,4vw,3.4rem);
    font-weight:700;line-height:1.1;
    color:#fff;letter-spacing:-.025em;margin-bottom:14px;
}
.hero-title em{font-style:italic;color:var(--mint)}
.hero-desc{color:rgba(255,255,255,.45);font-size:.9rem;line-height:1.82;font-weight:300;max-width:400px}

.search-wrap{
    display:flex;gap:8px;
    background:rgba(255,255,255,.07);
    border:1px solid rgba(255,255,255,.12);
    border-radius:100px;padding:5px;
    min-width:340px;flex-shrink:0;
}
@media(max-width:768px){.search-wrap{min-width:100%}.hero-inner{flex-direction:column;align-items:flex-start}}
.search-input{
    flex:1;padding:10px 18px;
    background:transparent;border:none;outline:none;
    color:#fff;font-size:.87rem;
    font-family:'DM Sans',sans-serif;
}
.search-input::placeholder{color:rgba(255,255,255,.32)}
.search-btn{
    padding:10px 24px;background:var(--mint);
    color:var(--forest);border:none;border-radius:100px;
    font-size:.82rem;font-weight:600;cursor:pointer;
    font-family:'DM Sans',sans-serif;transition:all .2s;
}
.search-btn:hover{background:#fff}

/* ── FILTER ── */
.filter-bar{
    background:var(--warm-white);
    border-bottom:1px solid var(--border-warm);
    position:sticky;top:0;z-index:50;
}
.filter-inner{
    display:flex;align-items:center;gap:8px;
    padding:14px 0;overflow-x:auto;
}
.filter-inner::-webkit-scrollbar{display:none}
.cat-btn{
    padding:9px 22px;border-radius:100px;
    border:1.5px solid var(--border-warm);background:transparent;
    font-size:.79rem;font-weight:600;color:var(--ink-soft);
    cursor:pointer;white-space:nowrap;transition:all .2s;
    font-family:'DM Sans',sans-serif;text-decoration:none;
}
.cat-btn:hover{border-color:var(--forest-mid);color:var(--forest-mid)}
.cat-btn.active{background:var(--forest);border-color:var(--forest);color:#fff}

/* ── PRODUCTS ── */
.products-area{padding:60px 0 100px;background:var(--clay)}
.prod-head{
    display:flex;align-items:center;justify-content:space-between;
    margin-bottom:36px;flex-wrap:wrap;gap:12px;
}
.prod-count{
    font-family:'Playfair Display',serif;
    font-size:1.5rem;font-weight:700;color:var(--ink);
}
.prod-count span{font-size:.85rem;font-weight:400;color:var(--ink-soft);font-family:'DM Sans',sans-serif;margin-left:8px}

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
.prod-card:hover{transform:translateY(-6px);box-shadow:0 28px 64px rgba(27,58,32,.1);border-color:transparent}

.prod-img{
    position:relative;overflow:hidden;
    aspect-ratio:4/3;background:var(--mint-pale);
}
.prod-img img{width:100%;height:100%;object-fit:cover;transition:transform .5s;display:block}
.prod-card:hover .prod-img img{transform:scale(1.08)}
.prod-cat-tag{
    position:absolute;top:12px;left:12px;
    background:rgba(27,58,32,.75);backdrop-filter:blur(8px);
    color:#fff;font-size:.67rem;font-weight:600;
    padding:4px 12px;border-radius:100px;
    letter-spacing:.06em;text-transform:uppercase;
}

.prod-body{padding:18px 20px 14px;flex:1;display:flex;flex-direction:column}
.prod-name{font-weight:600;font-size:.92rem;color:var(--ink);margin-bottom:8px}
.prod-price{
    font-family:'Playfair Display',serif;
    font-size:1.2rem;font-weight:700;color:var(--forest-mid);margin-top:auto;
}
.prod-foot{
    border-top:1px solid var(--border-warm);padding:12px 20px;
    display:flex;align-items:center;justify-content:center;
}
.btn-detail{
    display:inline-flex;align-items:center;gap:6px;
    font-size:.79rem;font-weight:600;
    color:var(--forest-mid);text-decoration:none;transition:gap .2s;
}
.btn-detail:hover{gap:12px;color:var(--forest)}

.empty-state{text-align:center;padding:80px 20px;grid-column:1/-1}
.empty-state .ei{font-size:2.5rem;margin-bottom:14px}
.empty-state p{color:var(--ink-soft);font-size:.9rem}

.reveal{opacity:0;transform:translateY(24px);transition:opacity .55s ease,transform .55s ease}
.reveal.on{opacity:1;transform:translateY(0)}
</style>

<div class="prod-page">

{{-- HERO --}}
<div class="prod-hero">
    <div class="container-main">
        <div class="hero-inner">
            <div>
                <div class="hero-tag">Menu Kami</div>
                <h1 class="hero-title">Pilihan Menu<br><em>Terlezat</em> untuk Anda</h1>
                <p class="hero-desc">Temukan berbagai pilihan masakan rumahan yang lezat, sehat, dan siap memenuhi kebutuhan Anda setiap hari.</p>
            </div>
            <div class="search-wrap">
                <input type="text" id="searchInput" class="search-input"
                    placeholder="Cari menu favorit kamu..."
                    oninput="applyFilter()">
                <button class="search-btn" onclick="applyFilter()">Cari</button>
            </div>
        </div>
    </div>
</div>

{{-- FILTER --}}
<div class="filter-bar">
    <div class="container-main">
        <div class="filter-inner">
            <button class="cat-btn active" onclick="filterCat('all',this)">Semua Menu</button>
            @foreach($categories as $category)
            <button class="cat-btn" onclick="filterCat('{{ $category->id }}',this)">{{ $category->name }}</button>
            @endforeach
        </div>
    </div>
</div>

{{-- PRODUCTS --}}
<section class="products-area">
    <div class="container-main">
        <div class="prod-head">
            <div class="prod-count">
                Semua Menu
                <span id="countLabel">{{ $menus->count() }} menu tersedia</span>
            </div>
        </div>

        <div class="prod-grid" id="menuGrid">
            @foreach($menus as $i => $menu)
            <div class="prod-card product-item reveal"
                 data-name="{{ strtolower($menu->name) }}"
                 data-cat="{{ $menu->category_id }}"
                 style="transition-delay:{{ ($i % 8) * 0.05 }}s">
                <div class="prod-img">
                    <img src="{{ asset('storage/'.$menu->image) }}" alt="{{ $menu->name }}" loading="lazy">
                    <span class="prod-cat-tag">{{ $menu->category->name }}</span>
                </div>
                <div class="prod-body">
                    <div class="prod-name">{{ $menu->name }}</div>
                    <div class="prod-price">Rp {{ number_format($menu->price) }}</div>
                </div>
                <div class="prod-foot">
                    <a href="{{ route('product.detail', $menu->id) }}" class="btn-detail">
                        Lihat Detail
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M2 6h8M6 2l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div id="emptyState" class="empty-state" style="display:none">
            <div class="ei">🔍</div>
            <p>Menu tidak ditemukan. Coba kata kunci lain.</p>
        </div>
    </div>
</section>

</div>

<script>
let currentCat='all',currentSearch='';
function applyFilter(){
    currentSearch=document.getElementById('searchInput').value.toLowerCase();
    const items=document.querySelectorAll('.product-item');
    let visible=0;
    items.forEach(item=>{
        const show=item.dataset.name.includes(currentSearch)&&(currentCat==='all'||item.dataset.cat===currentCat);
        item.style.display=show?'':'none';
        if(show)visible++;
    });
    document.getElementById('emptyState').style.display=visible>0?'none':'block';
    document.getElementById('countLabel').textContent=`${visible} menu tersedia`;
}
function filterCat(cat,btn){
    currentCat=cat;
    document.querySelectorAll('.cat-btn').forEach(b=>b.classList.remove('active'));
    btn.classList.add('active');
    applyFilter();
}
const io=new IntersectionObserver(entries=>{
    entries.forEach(e=>{if(e.isIntersecting)e.target.classList.add('on')});
},{threshold:.05});
document.querySelectorAll('.reveal').forEach(el=>io.observe(el));
</script>

@endsection
