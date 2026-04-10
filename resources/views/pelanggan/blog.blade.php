@extends('layouts.frontend')
@section('content')

{{-- CSS variabel & font TIDAK perlu ditulis ulang kalau sudah ada di layouts.frontend --}}
{{-- Cukup tambahkan class-class khusus halaman blog ini --}}

<style>
    /* ── BLOG GRID CARD (REFINED) ── */
.blog-card {
    background: #fff;
    border: 1px solid var(--border-warm);
    border-radius: 16px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: all .3s ease;
    height: 100%;
}

.blog-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(28,18,8,0.08);
    border-color: var(--leaf);
}

.blog-img {
    position: relative;
    aspect-ratio: 16/10;
    overflow: hidden;
    background: var(--mint-pale);
}

.blog-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .5s ease;
}

.blog-card:hover .blog-img img {
    transform: scale(1.08);
}

.blog-date {
    position: absolute;
    bottom: 12px;
    left: 12px;
    background: rgba(255,255,255,0.9);
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 0.7rem;
    font-weight: 600;
    color: var(--forest);
    backdrop-filter: blur(4px);
}

.blog-body {
    padding: 20px;
    display: flex;
    flex-direction: column;
    flex: 1;
}

.blog-title-link {
    font-family: 'Playfair Display', serif;
    font-size: 1.25rem;
    font-weight: 700;
    line-height: 1.4;
    color: var(--ink);
    text-decoration: none;
    margin-bottom: 12px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    transition: color .2s;
}

.blog-title-link:hover {
    color: var(--leaf);
}

.blog-desc {
    font-size: 0.88rem;
    line-height: 1.6;
    color: var(--ink-soft);
    margin-bottom: 20px;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    flex: 1;
}
/* ── BLOG HERO ── */
.bph{
    background:var(--forest);
    padding:90px 0 72px;
    position:relative;overflow:hidden;
}
.bph::before{
    content:'';position:absolute;top:-120px;right:-80px;
    width:480px;height:480px;border-radius:50%;
    background:radial-gradient(circle,rgba(168,213,162,.1),transparent 65%);
}
.bph::after{
    content:'';position:absolute;bottom:-80px;left:-60px;
    width:320px;height:320px;border-radius:50%;
    background:radial-gradient(circle,rgba(168,213,162,.07),transparent 65%);
}
.container-main {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 48px;
}
@media(max-width: 768px) {
    .container-main { padding: 0 20px; }
}
.bph-eyebrow{
    display:inline-flex;align-items:center;gap:8px;
    font-size:.69rem;font-weight:600;letter-spacing:.13em;
    text-transform:uppercase;color:var(--mint);margin-bottom:16px;
}
.bph-eyebrow::before{content:'';width:24px;height:1.5px;background:var(--mint)}
.bph h1{
    font-family:'Playfair Display',serif;
    font-size:clamp(2.2rem,5vw,4rem);font-weight:700;
    line-height:1.1;color:#fff;letter-spacing:-.025em;margin-bottom:18px;
}
.bph h1 em{font-style:italic;color:var(--mint)}
.bph-sub{color:rgba(255,255,255,.52);font-size:.95rem;line-height:1.85;max-width:500px;font-weight:300}

.breadcrumb-bar{
    padding:20px 0 0;font-size:.8rem;color:var(--ink-ghost);
    display:flex;align-items:center;gap:7px;
}
.breadcrumb-bar a{color:var(--ink-soft);text-decoration:none;transition:color .2s}
.breadcrumb-bar a:hover{color:var(--forest-mid)}

/* ── MAIN ── */
.blog-main{padding:80px 0 110px;background:var(--warm-white)}

/* FEATURED */
.featured-card{
    display:grid;grid-template-columns:1fr 1fr;
    background:#fff;border-radius:20px;overflow:hidden;
    border:1px solid var(--border-warm);margin-bottom:64px;
    transition:all .4s ease;
}
.featured-card:hover{
    border-color:var(--border-strong);
    box-shadow:0 24px 64px rgba(28,18,8,.1);
    transform:translateY(-4px);
}
.feat-img{height:460px;overflow:hidden;position:relative;background:var(--mint-pale)}
.feat-img img{width:100%;height:100%;object-fit:cover;transition:transform .7s;display:block}
.featured-card:hover .feat-img img{transform:scale(1.05)}
.feat-badge{
    position:absolute;top:18px;left:18px;
    background:var(--forest);color:var(--mint);
    font-size:.67rem;font-weight:600;letter-spacing:.1em;
    text-transform:uppercase;padding:5px 14px;border-radius:100px;
}
.feat-body{padding:48px 52px;display:flex;flex-direction:column;justify-content:space-between}
.feat-meta{display:flex;align-items:center;gap:10px;font-size:.75rem;color:var(--ink-ghost);margin-bottom:18px}
.feat-meta-dot{width:3px;height:3px;border-radius:50%;background:var(--ink-ghost)}
.feat-title{
    font-family:'Playfair Display',serif;
    font-size:clamp(1.5rem,2.5vw,2.1rem);font-weight:700;
    line-height:1.24;color:var(--ink);letter-spacing:-.02em;
    text-decoration:none;display:block;margin-bottom:18px;transition:color .2s;
}
.feat-title:hover{color:var(--forest-mid)}
.feat-desc{
    font-size:.9rem;line-height:1.88;color:var(--ink-soft);font-weight:300;flex:1;
    display:-webkit-box;-webkit-line-clamp:5;-webkit-box-orient:vertical;overflow:hidden;
    margin-bottom:36px;
}
.feat-foot{
    display:flex;align-items:center;justify-content:space-between;
    padding-top:22px;border-top:1px solid var(--border-warm);
}
.feat-author{display:flex;align-items:center;gap:10px}
.av{
    width:34px;height:34px;border-radius:50%;background:var(--forest);
    display:flex;align-items:center;justify-content:center;
    font-size:.7rem;font-weight:600;color:var(--mint);
}
.av-name{font-size:.82rem;font-weight:500;color:var(--ink-mid)}
.av-date{font-size:.72rem;color:var(--ink-ghost);margin-top:1px}
.btn-read{
    display:inline-flex;align-items:center;gap:9px;
    background:var(--forest);color:#fff;font-size:.8rem;font-weight:600;
    padding:12px 24px;border-radius:100px;text-decoration:none;transition:all .25s;
}
.btn-read:hover{background:var(--forest-mid);gap:14px}

/* DIVIDER */
.divider{display:flex;align-items:center;gap:18px;margin-bottom:40px}
.d-line{flex:1;height:1px;background:var(--border-warm)}
.d-txt{font-size:.69rem;font-weight:600;letter-spacing:.13em;text-transform:uppercase;color:var(--ink-ghost)}

/* BLOG GRID — sama persis dengan .blog-grid di home */
.blog-grid-full{display:grid;grid-template-columns:repeat(3,1fr);gap:22px;margin-bottom:64px}
@media(max-width:1024px){.blog-grid-full{grid-template-columns:repeat(2,1fr)}}
@media(max-width:600px){.blog-grid-full{grid-template-columns:1fr}}

.blog-meta-row{
    display:flex;align-items:center;justify-content:space-between;
    font-size:.73rem;color:var(--ink-ghost);
    padding-top:16px;border-top:1px solid var(--border-warm);
}
.blog-meta-left{display:flex;align-items:center;gap:12px}
.blog-meta-left span{display:flex;align-items:center;gap:5px}
.btn-read-sm{
    display:inline-flex;align-items:center;gap:6px;
    color:var(--forest-mid);font-size:.78rem;font-weight:600;
    text-decoration:none;transition:gap .2s;
}
.btn-read-sm:hover{gap:10px}
.blog-cat{
    position:absolute;top:14px;right:14px;
    background:var(--forest);color:var(--mint);
    font-size:.65rem;font-weight:600;letter-spacing:.08em;
    text-transform:uppercase;padding:4px 11px;border-radius:100px;
}

/* PAGINATION */
.blog-pagination{display:flex;justify-content:center;gap:8px}
.page-btn{
    min-width:44px;height:44px;border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    font-size:.84rem;font-weight:600;
    border:1.5px solid var(--border-warm);
    background:#fff;color:var(--ink-soft);
    text-decoration:none;transition:all .25s;
}
.page-btn:hover{border-color:var(--forest-mid);color:var(--forest-mid)}
.page-btn.active{background:var(--forest);border-color:var(--forest);color:#fff}
.page-btn.disabled{opacity:.35;pointer-events:none}

@media(max-width:768px){
    .featured-card{grid-template-columns:1fr}
    .feat-img{height:260px}
    .feat-body{padding:28px}
}
/* ── SEC HEAD ── */
.sec-head {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    margin-bottom: 32px;
    flex-wrap: wrap;
    gap: 16px;
}

/* ── FEATURED CARD ── */
.featured-card {
    display: grid;
    grid-template-columns: 1fr 1fr;
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    border: 1px solid var(--border-warm);
    margin-bottom: 64px;
    min-height: 420px;        /* ← tambah ini biar tingginya konsisten */
    transition: all .4s ease;
}
.featured-card:hover {
    border-color: var(--border-strong);
    box-shadow: 0 24px 64px rgba(28,18,8,.1);
    transform: translateY(-4px);
}

.feat-img {
    height: 100%;             /* ← full height ikut card */
    min-height: 380px;        /* ← minimum biar ga kempes */
    overflow: hidden;
    position: relative;
    background: var(--mint-pale);
}
.feat-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform .7s ease;
}
.featured-card:hover .feat-img img { transform: scale(1.05); }

.feat-badge {
    position: absolute;
    top: 18px; left: 18px;
    background: var(--forest);
    color: var(--mint);
    font-size: .67rem;
    font-weight: 600;
    letter-spacing: .1em;
    text-transform: uppercase;
    padding: 5px 14px;
    border-radius: 100px;
}

.feat-body {
    padding: 40px 44px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    overflow: hidden;          /* ← biar konten ga meluber */
}

.feat-meta {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: .75rem;
    color: var(--ink-ghost);
    margin-bottom: 14px;
}
.feat-meta-dot {
    width: 3px; height: 3px;
    border-radius: 50%;
    background: var(--ink-ghost);
}

.feat-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.3rem, 2.2vw, 1.9rem);
    font-weight: 700;
    line-height: 1.28;
    color: var(--ink);
    letter-spacing: -.02em;
    text-decoration: none;
    display: block;
    margin-bottom: 16px;
    transition: color .2s;
    /* biar ga overflow */
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.feat-title:hover { color: var(--forest-mid); }

.feat-desc {
    font-size: .9rem;
    line-height: 1.85;
    color: var(--ink-soft);
    font-weight: 300;
    display: -webkit-box;
    -webkit-line-clamp: 5;
    -webkit-box-orient: vertical;
    overflow: hidden;
    margin-bottom: 32px;
}

.feat-foot {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding-top: 20px;
    border-top: 1px solid var(--border-warm);
    flex-wrap: wrap;
}

.feat-author { display: flex; align-items: center; gap: 10px; }
.av {
    width: 34px; height: 34px;
    border-radius: 50%;
    background: var(--forest);
    display: flex; align-items: center; justify-content: center;
    font-size: .7rem; font-weight: 600; color: var(--mint);
    flex-shrink: 0;
}
.av-name  { font-size: .82rem; font-weight: 500; color: var(--ink-mid); }
.av-date  { font-size: .72rem; color: var(--ink-ghost); margin-top: 2px; }

.btn-read {
    display: inline-flex; align-items: center; gap: 9px;
    background: var(--forest); color: #fff;
    font-size: .8rem; font-weight: 600;
    padding: 12px 22px; border-radius: 100px;
    text-decoration: none;
    white-space: nowrap;        /* ← biar teks tombol ga wrap */
    transition: all .25s;
    flex-shrink: 0;
}
.btn-read:hover { background: var(--forest-mid); gap: 14px; }

/* Responsive */
@media(max-width: 768px) {
    .featured-card { grid-template-columns: 1fr; }
    .feat-img { min-height: 240px; height: 240px; }
    .feat-body { padding: 24px 24px 28px; }
}
.sec-head-modern {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 40px;
    border-bottom: 1px solid var(--border-warm);
    padding-bottom: 20px;
}
.sec-head-modern .eyebrow {
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: var(--leaf);
    display: block;
    margin-bottom: 8px;
}
.sec-head-modern .sec-title {
    font-family: 'Playfair Display', serif;
    font-size: 2.2rem;
    line-height: 1;
    margin: 0;
    color: var(--ink);
}
.sec-head-modern .sec-title em {
    font-style: italic;
    font-weight: 400;
    color: var(--ink-soft);
}
</style>

{{-- HERO --}}
<section class="bph">
    <div class="container-main">
        <div class="bph-eyebrow">Artikel &amp; Inspirasi</div>
        <h1>Inspirasi &amp; <em>Tips Masak</em><br>untuk Keluarga</h1>
        <p class="bph-sub">Temukan resep lezat, tips memasak praktis, dan inspirasi kuliner rumahan yang sehat dan penuh cinta.</p>
        <div class="breadcrumb-bar">
            <a href="{{ route('home') }}">Beranda</a>
            <span>›</span>
            <span>Artikel</span>
        </div>
    </div>
</section>

{{-- MAIN --}}
<section class="blog-main">
    <div class="container-main">

        @if($blogs->isEmpty())
            <div style="text-align:center;padding:72px 0;color:var(--ink-ghost)">Belum ada artikel yang tersedia.</div>
        @else
            @php $featured = $blogs->first(); $rest = $blogs->slice(1); @endphp

            {{-- Section Header --}}
            <div class="sec-head-modern reveal">
                <div>
                    <span class="eyebrow">Ruang Literasi</span>
                    <h1 class="sec-title">Artikel <em>Kami</em></h1>
                </div>

            </div>

            {{-- Featured --}}
            <div class="featured-card reveal d1">
                <div class="feat-img">
                    @if($featured->image)
                        <img src="{{ asset('storage/'.$featured->image) }}" alt="{{ $featured->title }}">
                    @endif
                    <div class="feat-badge">Pilihan Editor</div>
                </div>
                <div class="feat-body">
                    <div>
                        <div class="feat-meta">
                            <span>{{ $featured->created_at->format('d M Y') }}</span>
                            <span class="feat-meta-dot"></span>
                            <span>Admin</span>
                        </div>
                        <a href="{{ route('blog.show', $featured->slug) }}" class="feat-title">{{ $featured->title }}</a>
                        <p class="feat-desc">{{ \Illuminate\Support\Str::limit(strip_tags($featured->content), 320) }}</p>
                    </div>
                    <div class="feat-foot">
                        <div class="feat-author">
                            <div class="av">A</div>
                            <div>
                                <div class="av-name">Admin Dapur Bu Iim</div>
                                <div class="av-date">{{ $featured->created_at->format('d M Y') }}</div>
                            </div>
                        </div>
                        <a href="{{ route('blog.show', $featured->slug) }}" class="btn-read">
                            Baca Selengkapnya
                            <svg width="13" height="13" viewBox="0 0 12 12" fill="none"><path d="M2 6h8M6 2l4 4-4 4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Divider --}}
            <div class="divider reveal">
                <div class="d-line"></div>
                <span class="d-txt">Artikel Terbaru</span>
                <div class="d-line"></div>
            </div>

            {{-- Grid --}}
            <div class="blog-grid-full">
    @foreach($rest as $blog)
    <div class="blog-card reveal">
        <div class="blog-img">
            @if($blog->image)
                <img src="{{ asset('storage/'.$blog->image) }}" alt="{{ $blog->title }}" loading="lazy">
            @else
                <img src="{{ asset('img/default.jpg') }}" alt="default" loading="lazy">
            @endif
            <span class="blog-date">{{ $blog->created_at->format('d M Y') }}</span>
        </div>

        <div class="blog-body">
            <a href="{{ route('blog.show', $blog->slug) }}" class="blog-title-link">{{ $blog->title }}</a>
            <p class="blog-desc">{{ \Illuminate\Support\Str::limit(strip_tags($blog->content), 110) }}</p>

            <div class="blog-meta-row">
                <div class="blog-meta-left">
                    <span>Admin</span>
                </div>
                <a href="{{ route('blog.show', $blog->slug) }}" class="btn-read-sm">
                    Baca
                    <svg width="11" height="11" viewBox="0 0 12 12" fill="none"><path d="M2 6h8M6 2l4 4-4 4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>
        @endif

        {{-- Pagination --}}
        @if($blogs instanceof \Illuminate\Pagination\LengthAwarePaginator && $blogs->hasPages())
        <div class="blog-pagination reveal">
            @if(!$blogs->onFirstPage())
                <a href="{{ $blogs->previousPageUrl() }}" class="page-btn">←</a>
            @else
                <span class="page-btn disabled">←</span>
            @endif
            @foreach($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
                <a href="{{ $url }}" class="page-btn {{ $page == $blogs->currentPage() ? 'active' : '' }}">{{ $page }}</a>
            @endforeach
            @if($blogs->hasMorePages())
                <a href="{{ $blogs->nextPageUrl() }}" class="page-btn">→</a>
            @else
                <span class="page-btn disabled">→</span>
            @endif
        </div>
        @endif

    </div>
</section>

<script>
const io = new IntersectionObserver(entries=>{
    entries.forEach(e=>{if(e.isIntersecting)e.target.classList.add('on')})
},{threshold:.1,rootMargin:'0px 0px -40px 0px'});
document.querySelectorAll('.reveal').forEach(el=>io.observe(el));
</script>

@endsection
