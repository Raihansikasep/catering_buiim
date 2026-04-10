@extends('layouts.frontend')

@section('content')

<style>
:root {
    --warm-white: #FDFAF6;
    --clay: #F5EFE6;
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
    --border-warm: rgba(60,40,20,0.1);
}

/* ── DETAIL HERO ── */
.show-hero {
    background: var(--forest);
    padding: 72px 0 64px;
    position: relative;
    overflow: hidden;
}
.show-hero::before {
    content: '';
    position: absolute;
    top: -100px; right: -80px;
    width: 420px; height: 420px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(75,138,85,.18), transparent 62%);
}

.show-hero .container-main { position: relative; z-index: 2; max-width: 1280px; margin: 0 auto; padding: 0 48px; }
@media(max-width:768px) { .show-hero .container-main { padding: 0 20px; } }

.show-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: .68rem;
    font-weight: 600;
    letter-spacing: .14em;
    text-transform: uppercase;
    color: var(--mint);
    margin-bottom: 20px;
}
.show-eyebrow::before {
    content: '';
    display: block;
    width: 24px; height: 1.5px;
    background: var(--mint);
}

.show-hero h1 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.8rem, 3.5vw, 3rem);
    font-weight: 700;
    line-height: 1.16;
    color: #fff;
    letter-spacing: -.025em;
    max-width: 780px;
    margin-bottom: 24px;
}

.show-hero-meta {
    display: flex;
    align-items: center;
    gap: 14px;
    font-size: .75rem;
    color: rgba(255,255,255,.45);
    letter-spacing: .08em;
    flex-wrap: wrap;
}
.show-hero-meta .sep {
    width: 3px; height: 3px;
    border-radius: 50%;
    background: rgba(255,255,255,.25);
}
.show-hero-meta a {
    color: rgba(255,255,255,.45);
    text-decoration: none;
    transition: color .2s;
}
.show-hero-meta a:hover { color: var(--mint); }

/* ── CONTENT BODY ── */
.show-body-wrap {
    background: var(--warm-white);
    padding: 0 0 96px;
}

.show-body {
    max-width: 760px;
    margin: 0 auto;
    padding: 0 48px;
}
@media(max-width:768px) { .show-body { padding: 0 20px; } }

/* Hero image — bleeds below the dark hero */
.show-img-wrap {
    margin: 0 auto 52px;
    max-width: 860px;
    padding: 0 48px;
    margin-top: -48px;
    position: relative;
    z-index: 10;
}
@media(max-width:768px) { .show-img-wrap { padding: 0 20px; margin-top: -32px; } }

.show-img-wrap img {
    width: 100%;
    aspect-ratio: 16/9;
    object-fit: cover;
    display: block;
    border-radius: 20px;
    box-shadow: 0 32px 80px rgba(28,18,8,.18);
}

/* Content padding accounts for image */
.show-body-inner { padding-top: 20px; }

/* Drop cap */
.show-content p:first-child::first-letter {
    font-family: 'Playfair Display', serif;
    font-size: 66px;
    font-weight: 700;
    float: left;
    line-height: .84;
    margin-right: 8px;
    margin-top: 6px;
    color: var(--forest-mid);
}

.show-content {
    font-size: 1rem;
    line-height: 1.95;
    color: var(--ink-mid);
    font-weight: 300;
}
.show-content p { margin-bottom: 1.55em; }
.show-content strong { font-weight: 600; color: var(--ink); }

/* ── ARTICLE FOOTER ── */
.show-article-footer {
    margin-top: 56px;
    padding-top: 32px;
    border-top: 1px solid var(--border-warm);
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 16px;
}

.show-back-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: .8rem;
    font-weight: 600;
    letter-spacing: .06em;
    color: var(--forest-mid);
    text-decoration: none;
    padding: 10px 22px;
    border: 1.5px solid var(--border-warm);
    border-radius: 100px;
    transition: all .25s;
}
.show-back-link:hover {
    border-color: var(--forest-mid);
    background: var(--mint-pale);
}

.show-share {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: .75rem;
    color: var(--ink-ghost);
    letter-spacing: .08em;
    text-transform: uppercase;
}

/* ── RELATED / NEXT ── */
.show-related {
    background: var(--clay);
    padding: 72px 0;
}
.show-related .container-main { max-width: 1280px; margin: 0 auto; padding: 0 48px; }
@media(max-width:768px) { .show-related .container-main { padding: 0 20px; } }

.show-related-head {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 36px;
}
.show-related-head::before {
    content: '';
    display: block;
    width: 24px; height: 1.5px;
    background: var(--leaf);
}
.show-related-head span {
    font-size: .7rem;
    font-weight: 600;
    letter-spacing: .14em;
    text-transform: uppercase;
    color: var(--leaf);
}

.show-related-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
}
@media(max-width:1024px) { .show-related-grid { grid-template-columns: repeat(2, 1fr); } }
@media(max-width:600px)  { .show-related-grid { grid-template-columns: 1fr; } }

.rel-card {
    background: var(--warm-white);
    border: 1px solid var(--border-warm);
    border-radius: 20px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    text-decoration: none;
    transition: all .3s;
}
.rel-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 22px 50px rgba(28,18,8,.09);
    border-color: transparent;
}
.rel-img {
    aspect-ratio: 16/9;
    overflow: hidden;
    background: var(--mint-pale);
}
.rel-img img {
    width: 100%; height: 100%;
    object-fit: cover;
    display: block;
    transition: transform .5s;
}
.rel-card:hover .rel-img img { transform: scale(1.06); }
.rel-body { padding: 18px 20px; flex: 1; }
.rel-date {
    font-size: .68rem;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: var(--ink-ghost);
    margin-bottom: 8px;
    display: block;
}
.rel-title {
    font-family: 'Playfair Display', serif;
    font-size: 1rem;
    font-weight: 600;
    line-height: 1.4;
    color: var(--ink);
    transition: color .2s;
}
.rel-card:hover .rel-title { color: var(--forest-mid); }
</style>

{{-- ARTICLE HERO --}}
<section class="show-hero">
    <div class="container-main">
        <div class="show-eyebrow">Artikel</div>
        <h1>{{ $blog->title }}</h1>
        <div class="show-hero-meta">
            <a href="{{ route('blog') }}">← Semua Artikel</a>
            <span class="sep"></span>
            <span>{{ $blog->created_at->translatedFormat('d M Y') }}</span>
            <span class="sep"></span>
            <span>Admin</span>
            <span class="sep"></span>
            <span>{{ max(1, ceil(str_word_count(strip_tags($blog->content)) / 200)) }} menit baca</span>
        </div>
    </div>
</section>

{{-- BODY --}}
<div class="show-body-wrap">

    {{-- Hero image (overlaps the dark hero) --}}
    @if($blog->image)
    <div class="show-img-wrap">
        <img src="{{ asset('storage/'.$blog->image) }}" alt="{{ $blog->title }}">
    </div>
    @else
    <div style="height:52px"></div>
    @endif

    <div class="show-body">
        <div class="show-body-inner">

            <div class="show-content">
                {!! nl2br(e($blog->content)) !!}
            </div>

            <div class="show-article-footer">
                <a href="{{ route('blog') }}" class="show-back-link">
                    <svg width="13" height="13" viewBox="0 0 13 13" fill="none"><path d="M10 6.5H3M6 3L3 6.5L6 10" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Semua Artikel
                </a>
                <div class="show-share">
                    <span>Bagikan</span>
                    <a href="https://wa.me/?text={{ urlencode($blog->title . ' ' . request()->url()) }}" target="_blank" rel="noopener"
                       style="display:inline-flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:50%;border:1.5px solid var(--border-warm);color:var(--ink-soft);text-decoration:none;transition:all .2s"
                       onmouseover="this.style.borderColor='var(--forest-mid)';this.style.color='var(--forest-mid)'"
                       onmouseout="this.style.borderColor='var(--border-warm)';this.style.color='var(--ink-soft)'">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.12 1.533 5.849L.057 23.5l5.797-1.521A11.94 11.94 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.004-1.375l-.359-.213-3.44.902.918-3.352-.234-.376A9.818 9.818 0 1112 21.818z"/></svg>
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- RELATED ARTICLES --}}
@if(isset($relatedBlogs) && $relatedBlogs->count())
<section class="show-related">
    <div class="container-main">
        <div class="show-related-head"><span>Artikel Lainnya</span></div>
        <div class="show-related-grid">
            @foreach($relatedBlogs as $rel)
            <a href="{{ route('blog.show', $rel->slug) }}" class="rel-card">
                <div class="rel-img">
                    <img src="{{ $rel->image ? asset('storage/'.$rel->image) : asset('img/default.jpg') }}" alt="{{ $rel->title }}" loading="lazy">
                </div>
                <div class="rel-body">
                    <span class="rel-date">{{ $rel->created_at->format('d M Y') }}</span>
                    <div class="rel-title">{{ $rel->title }}</div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
