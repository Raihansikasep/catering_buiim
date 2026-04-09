<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=DM+Sans:wght@300;400;500;600&display=swap');

:root {
    --forest:     #1B3A20;
    --forest-mid: #2D5C35;
    --leaf:       #4B8A55;
    --mint:       #A8D5A2;
    --ink:        #1C1208;
    --ink-soft:   #7A6A56;
    --warm-white: #FDFAF6;
}

/* ── TOP BAR ── */
.topbar {
    position: fixed;
    top: 0; left: 0; right: 0;
    z-index: 10000;
    background: var(--forest);
    border-bottom: 1px solid rgba(255,255,255,.06);
    padding: 8px 0;
    font-family: 'DM Sans', sans-serif;
    transition: transform .3s ease;
}
.tb-inner {
    max-width: 1280px; margin: 0 auto; padding: 0 48px;
    display: flex; align-items: center; justify-content: space-between;
    gap: 12px;
}
.tb-left {
    display: flex; align-items: center; gap: 20px; flex-wrap: wrap;
}
.tb-item {
    display: flex; align-items: center; gap: 7px;
    font-size: .73rem; color: rgba(255,255,255,.48); font-weight: 400;
}
.tb-item svg { opacity: .55; flex-shrink: 0; }
.tb-right {
    display: flex; align-items: center; gap: 4px;
}
.tb-soc-label {
    font-size: .72rem; color: rgba(255,255,255,.35); margin-right: 8px;
}
.tb-soc {
    width: 28px; height: 28px; border-radius: 50%;
    background: rgba(255,255,255,.07);
    border: 1px solid rgba(255,255,255,.09);
    display: flex; align-items: center; justify-content: center;
    color: rgba(255,255,255,.5); text-decoration: none;
    font-size: .72rem; transition: all .2s;
}
.tb-soc:hover { background: var(--leaf); border-color: var(--leaf); color: #fff; }

@media (max-width: 1024px) {
    .topbar { display: none; }
}

/* ── MAIN NAVBAR ── */
.main-nav {
    position: fixed;
    left: 0; right: 0;
    z-index: 9999;
    font-family: 'DM Sans', sans-serif;
    background: var(--forest);
    box-shadow: 0 2px 24px rgba(0,0,0,.18);
}

/* di desktop, navbar duduk di bawah topbar */
@media (min-width: 1025px) {
    .main-nav { top: 37px; }
}
@media (max-width: 1024px) {
    .main-nav { top: 0; }
}

/* homepage: transparan saat di atas */
.main-nav.transparent {
    background: transparent;
    box-shadow: none;
}


.nav-inner {
    max-width: 1280px; margin: 0 auto; padding: 0 48px;
    display: flex; align-items: center;
    height: 68px;
}
@media (max-width: 768px) { .nav-inner { padding: 0 20px; } }

/* Logo */
.nav-logo {
    text-decoration: none;
    display: flex; align-items: center; gap: 10px;
    flex-shrink: 0;
    margin-right: 48px;
}
.nav-logo .logo-icon {
    width: 36px; height: 36px; border-radius: 10px;
    background: var(--mint);
    display: flex; align-items: center; justify-content: center;
    font-size: .9rem; font-weight: 700; color: var(--forest);
    font-family: 'Playfair Display', serif;
    flex-shrink: 0;
}
.nav-logo .logo-text {
    font-family: 'Playfair Display', serif;
    font-size: 1.25rem; font-weight: 700; line-height: 1;
    color: #fff; letter-spacing: -.01em;
}
.nav-logo .logo-text span { color: var(--mint); font-style: italic; }

/* Desktop links */
.nav-links {
    display: flex; align-items: center;
    gap: 2px; flex: 1;
    list-style: none; margin: 0; padding: 0;
}
.nav-links .nav-lnk {
    position: relative;
    padding: 8px 14px;
    font-size: .85rem; font-weight: 500;
    color: rgba(255,255,255,.65);
    text-decoration: none;
    border-radius: 8px;
    transition: color .2s, background .2s;
    white-space: nowrap;
}
.nav-links .nav-lnk:hover { color: #fff; background: rgba(255,255,255,.07); }
.nav-links .nav-lnk.active { color: #fff; font-weight: 600; }
.nav-links .nav-lnk.active::after {
    content: '';
    position: absolute; bottom: 2px; left: 14px; right: 14px;
    height: 2px; border-radius: 2px;
    background: var(--mint);
}

/* Dropdown */
.nav-dropdown { position: relative; }
.nav-dropdown .nav-lnk { cursor: default; }
.nav-dropdown .nav-lnk .chevron {
    display: inline-block;
    margin-left: 4px; font-size: .65rem;
    transition: transform .2s;
}
.nav-dropdown:hover .chevron { transform: rotate(180deg); }

.nav-droplist {
    position: absolute;
    top: calc(100% + 8px); left: 0;
    background: var(--forest);
    border: 1px solid rgba(255,255,255,.1);
    border-radius: 14px;
    padding: 8px;
    min-width: 180px;
    list-style: none; margin: 0;
    box-shadow: 0 16px 40px rgba(0,0,0,.25);
    opacity: 0; visibility: hidden;
    transform: translateY(8px);
    transition: all .22s ease;
    z-index: 100;
}
.nav-dropdown:hover .nav-droplist {
    opacity: 1; visibility: visible; transform: translateY(0);
}
.nav-droplist li a {
    display: block; padding: 9px 14px;
    border-radius: 8px;
    font-size: .84rem; font-weight: 500;
    color: rgba(255,255,255,.65);
    text-decoration: none;
    transition: all .15s;
}
.nav-droplist li a:hover { background: rgba(255,255,255,.08); color: #fff; }
.nav-droplist li a.active { color: var(--mint); font-weight: 600; }

/* Right actions */
.nav-actions {
    display: flex; align-items: center;
    gap: 8px; margin-left: auto; flex-shrink: 0;
}
.nav-icon-btn {
    position: relative;
    width: 38px; height: 38px; border-radius: 10px;
    background: rgba(255,255,255,.08);
    border: 1px solid rgba(255,255,255,.1);
    display: flex; align-items: center; justify-content: center;
    color: rgba(255,255,255,.75); text-decoration: none;
    transition: all .2s; flex-shrink: 0;
    cursor: pointer;
}
.nav-icon-btn:hover { background: rgba(255,255,255,.15); color: #fff; border-color: rgba(255,255,255,.2); }
.nav-icon-btn.active-page { border-color: var(--mint); color: var(--mint); }

/* Cart badge */
.cart-badge {
    position: absolute; top: -4px; right: -4px;
    width: 16px; height: 16px; border-radius: 50%;
    background: var(--mint); color: var(--forest);
    font-size: .6rem; font-weight: 700;
    display: flex; align-items: center; justify-content: center;
    border: 2px solid var(--forest);
    line-height: 1;
}

/* User dropdown */
.user-dropdown-wrap { position: relative; }
.user-card-popup {
    position: absolute;
    top: calc(100% + 10px); right: 0;
    background: var(--warm-white);
    border: 1px solid rgba(60,40,20,.12);
    border-radius: 16px;
    padding: 8px;
    min-width: 200px;
    box-shadow: 0 20px 48px rgba(0,0,0,.14);
    opacity: 0; visibility: hidden;
    transform: translateY(8px);
    transition: all .22s ease;
    z-index: 200;
}
.user-card-popup.open { opacity: 1; visibility: visible; transform: translateY(0); }
.user-card-popup .u-info {
    padding: 12px 14px 10px;
    border-bottom: 1px solid rgba(60,40,20,.08);
    margin-bottom: 6px;
}
.user-card-popup .u-name { font-weight: 600; font-size: .88rem; color: var(--ink); }
.user-card-popup .u-email { font-size: .75rem; color: var(--ink-soft); margin-top: 2px; }
.user-card-popup a {
    display: flex; align-items: center; gap: 10px;
    padding: 9px 14px; border-radius: 10px;
    font-size: .84rem; font-weight: 500; color: var(--ink);
    text-decoration: none; transition: background .15s;
}
.user-card-popup a:hover { background: rgba(60,40,20,.05); }
.user-card-popup a svg { opacity: .5; }

/* ── HAMBURGER ── */
.nav-hamburger {
    display: none;
    flex-direction: column; gap: 5px;
    padding: 8px 6px; cursor: pointer;
    background: rgba(255,255,255,.08);
    border: 1px solid rgba(255,255,255,.12);
    border-radius: 8px;
    margin-left: 12px;
}
.nav-hamburger span {
    display: block; width: 20px; height: 2px;
    background: rgba(255,255,255,.8); border-radius: 2px;
    transition: all .3s;
}
.nav-hamburger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
.nav-hamburger.open span:nth-child(2) { opacity: 0; transform: scaleX(0); }
.nav-hamburger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

/* ── MOBILE MENU ── */
.mobile-menu {
    display: none;
    position: fixed;
    /* top diatur oleh JS */
    left: 0; right: 0;
    background: var(--forest);
    border-top: 1px solid rgba(255,255,255,.07);
    padding: 12px 20px 24px;
    z-index: 9997;
    box-shadow: 0 24px 48px rgba(0,0,0,.3);
    max-height: calc(100vh - 68px);
    overflow-y: auto;
}
.mobile-menu.open { display: block; }
.mobile-menu .mm-link {
    display: flex; align-items: center; gap: 10px;
    padding: 13px 14px; border-radius: 10px;
    font-size: .9rem; font-weight: 500;
    color: rgba(255,255,255,.7); text-decoration: none;
    transition: all .15s; margin-bottom: 2px;
}
.mobile-menu .mm-link:hover,
.mobile-menu .mm-link.active { background: rgba(255,255,255,.08); color: #fff; }
.mobile-menu .mm-link.active { color: var(--mint); }
.mobile-menu .mm-sep {
    height: 1px; background: rgba(255,255,255,.07); margin: 10px 0;
}
.mobile-menu .mm-sub { padding-left: 16px; }
.mobile-menu .mm-sub .mm-link {
    font-size: .84rem; padding: 10px 14px;
    color: rgba(255,255,255,.5);
}
.mobile-menu .mm-actions {
    display: flex; gap: 10px; margin-top: 14px; padding-top: 14px;
    border-top: 1px solid rgba(255,255,255,.07);
}
.mobile-menu .mm-btn {
    flex: 1; padding: 11px;
    border-radius: 10px; text-align: center;
    font-size: .84rem; font-weight: 600;
    text-decoration: none; transition: all .2s;
}
.mobile-menu .mm-btn-ghost {
    background: rgba(255,255,255,.07);
    border: 1px solid rgba(255,255,255,.12);
    color: rgba(255,255,255,.7);
}
.mobile-menu .mm-btn-solid { background: var(--mint); color: var(--forest); }
.mobile-menu .mm-btn-ghost:hover { background: rgba(255,255,255,.12); color: #fff; }
.mobile-menu .mm-btn-solid:hover { background: #fff; }

@media (max-width: 1024px) {
    .nav-links, .nav-actions { display: none; }
    .nav-hamburger { display: flex; }
    .nav-logo { margin-right: auto; }
}
</style>

{{-- ============================================================ --}}
{{-- TOP BAR (hanya desktop, fixed di paling atas)               --}}
{{-- ============================================================ --}}
<div class="topbar" id="topBar">
    <div class="tb-inner">
        <div class="tb-left">
            <span class="tb-item">
                <svg width="13" height="13" viewBox="0 0 13 13" fill="none">
                    <path d="M6.5 1C4.29 1 2.5 2.79 2.5 5c0 3 4 7 4 7s4-4 4-7c0-2.21-1.79-4-4-4zm0 5.5A1.5 1.5 0 1 1 6.5 3a1.5 1.5 0 0 1 0 3z" fill="currentColor"/>
                </svg>
                Bojong Malaka Indah No. 13, Bandung
            </span>
            <span class="tb-item">
                <svg width="13" height="13" viewBox="0 0 13 13" fill="none">
                    <path d="M2 3h9a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zm4.5 3.5L11 4H2l4.5 2.5z" fill="currentColor"/>
                </svg>
                <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="82c1e3f6e7f0ebece5c0f7ebebefc2e5efe3ebeeace1edef">[email&#160;protected]</a>
            </span>
        </div>
        <div class="tb-right">
            <span class="tb-soc-label">Ikuti Kami:</span>
            <a href="#" class="tb-soc" aria-label="Facebook">
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                    <path d="M8 1H6.5C5.12 1 4 2.12 4 3.5V5H2.5v2H4v4h2V7h1.5L8 5H6V3.5c0-.28.22-.5.5-.5H8V1z" fill="currentColor"/>
                </svg>
            </a>
            <a href="#" class="tb-soc" aria-label="Instagram">
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                    <rect x="1.5" y="1.5" width="9" height="9" rx="2.5" stroke="currentColor" stroke-width="1.2"/>
                    <circle cx="6" cy="6" r="2" stroke="currentColor" stroke-width="1.2"/>
                    <circle cx="8.7" cy="3.3" r=".6" fill="currentColor"/>
                </svg>
            </a>
            <a href="#" class="tb-soc" aria-label="Twitter/X">
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                    <path d="M2 2l3.5 4L2 10h1.2l2.9-3.3L9 10h2L7.2 5.8 11 2H9.8L6.7 5.1 4 2H2z" fill="currentColor"/>
                </svg>
            </a>
        </div>
    </div>
</div>

{{-- ============================================================ --}}
{{-- MAIN NAVBAR                                                  --}}
{{-- ============================================================ --}}
<nav class="main-nav" id="mainNav">
    <div class="nav-inner">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="nav-logo">
            <div class="logo-text">
                <span class="text-success">Dapur</span>
                <span class="text-secondary"> Bu </span>
                <span class="text-success">Iim</span>
            </div>
        </a>

        {{-- Desktop Links --}}
        <ul class="nav-links">
            <li>
                <a href="{{ route('home') }}"
                   class="nav-lnk {{ request()->routeIs('home') ? 'active' : '' }}">
                    Beranda
                </a>
            </li>
            <li>
                <a href="{{ route('about') }}"
                   class="nav-lnk {{ request()->routeIs('about') ? 'active' : '' }}">
                    Tentang Kami
                </a>
            </li>
            <li>
                <a href="{{ route('product') }}"
                   class="nav-lnk {{ request()->routeIs('product') ? 'active' : '' }}">
                    Produk
                </a>
            </li>
            <li class="nav-dropdown">
                <a href="#" class="nav-lnk {{ request()->routeIs('blog', 'testimonial') ? 'active' : '' }}">
                    Halaman <span class="chevron">▾</span>
                </a>
                <ul class="nav-droplist">
                    <li>
                        <a href="{{ route('blog') }}"
                           class="{{ request()->routeIs('blog') ? 'active' : '' }}">
                            Blog
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('testimonial') }}"
                           class="{{ request()->routeIs('testimonial') ? 'active' : '' }}">
                            Ulasan Pelanggan
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('contact') }}"
                   class="nav-lnk {{ request()->routeIs('contact') ? 'active' : '' }}">
                    Kontak
                </a>
            </li>
        </ul>

        {{-- Desktop Right Actions --}}
        <div class="nav-actions">

            {{-- User --}}
            <div class="user-dropdown-wrap">
                <button class="nav-icon-btn" id="userToggle" aria-label="Akun Saya">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <circle cx="8" cy="5.5" r="2.5" stroke="currentColor" stroke-width="1.4"/>
                        <path d="M2.5 13.5c0-2.76 2.46-5 5.5-5s5.5 2.24 5.5 5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                    </svg>
                </button>
                <div class="user-card-popup" id="userCard">
                    @guest
                        <a href="{{ route('login') }}">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                                <path d="M5 2H3a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h2M9 10l3-3-3-3M12 7H5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Login
                        </a>
                        <a href="{{ route('register') }}">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                                <circle cx="6" cy="5" r="2.5" stroke="currentColor" stroke-width="1.4"/>
                                <path d="M1.5 12c0-2.5 2-4 4.5-4M10 8v4M8 10h4" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                            </svg>
                            Daftar
                        </a>
                    @endguest
                    @auth
                        <div class="u-info">
                            <div class="u-name">{{ auth()->user()->name }}</div>
                            <div class="u-email">{{ auth()->user()->email }}</div>
                        </div>
                        <a href="{{ route('profile') }}">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                                <circle cx="7" cy="5" r="2.5" stroke="currentColor" stroke-width="1.4"/>
                                <path d="M2 12c0-2.5 2.24-4.5 5-4.5s5 2 5 4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                            </svg>
                            Profile Saya
                        </a>
                    @endauth
                </div>
            </div>

            {{-- Cart --}}
            <a href="{{ route('cart') }}"
               class="nav-icon-btn {{ request()->routeIs('cart') ? 'active-page' : '' }}"
               aria-label="Keranjang">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M2 2h1.5l1.8 7.5h6.5l1.5-5H5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="7.5" cy="13" r="1" fill="currentColor"/>
                    <circle cx="11.5" cy="13" r="1" fill="currentColor"/>
                </svg>
            </a>

        </div>

        {{-- Hamburger --}}
        <button class="nav-hamburger" id="navHamburger" aria-label="Menu">
            <span></span><span></span><span></span>
        </button>

    </div>
</nav>

{{-- ============================================================ --}}
{{-- MOBILE MENU                                                  --}}
{{-- ============================================================ --}}
<div class="mobile-menu" id="mobileMenu">
    <a href="{{ route('home') }}" class="mm-link {{ request()->routeIs('home') ? 'active' : '' }}">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
            <path d="M2 7L8 2l6 5v7a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V7z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/>
            <path d="M6 16v-5h4v5" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/>
        </svg>
        Beranda
    </a>
    <a href="{{ route('about') }}" class="mm-link {{ request()->routeIs('about') ? 'active' : '' }}">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
            <circle cx="8" cy="8" r="6" stroke="currentColor" stroke-width="1.4"/>
            <path d="M8 7v5M8 5.5v.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
        </svg>
        Tentang Kami
    </a>
    <a href="{{ route('product') }}" class="mm-link {{ request()->routeIs('product') ? 'active' : '' }}">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
            <rect x="2" y="2" width="5.5" height="5.5" rx="1.5" stroke="currentColor" stroke-width="1.4"/>
            <rect x="8.5" y="2" width="5.5" height="5.5" rx="1.5" stroke="currentColor" stroke-width="1.4"/>
            <rect x="2" y="8.5" width="5.5" height="5.5" rx="1.5" stroke="currentColor" stroke-width="1.4"/>
            <rect x="8.5" y="8.5" width="5.5" height="5.5" rx="1.5" stroke="currentColor" stroke-width="1.4"/>
        </svg>
        Produk
    </a>
    <div class="mm-sep"></div>
    <div class="mm-sub">
        <a href="{{ route('blog') }}" class="mm-link {{ request()->routeIs('blog') ? 'active' : '' }}">Blog</a>
        <a href="{{ route('testimonial') }}" class="mm-link {{ request()->routeIs('testimonial') ? 'active' : '' }}">Ulasan Pelanggan</a>
    </div>
    <div class="mm-sep"></div>
    <a href="{{ route('contact') }}" class="mm-link {{ request()->routeIs('contact') ? 'active' : '' }}">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
            <path d="M2 3h12a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zm6 4.5L13 4H3l5 3.5z" fill="currentColor"/>
        </svg>
        Kontak
    </a>
    <div class="mm-actions">
        @guest
            <a href="{{ route('login') }}" class="mm-btn mm-btn-ghost">Login</a>
            <a href="{{ route('register') }}" class="mm-btn mm-btn-solid">Daftar</a>
        @endguest
        @auth
            <a href="{{ route('profile') }}" class="mm-btn mm-btn-ghost">Profile Saya</a>
            <a href="{{ route('cart') }}" class="mm-btn mm-btn-solid">Keranjang</a>
        @endauth
    </div>
</div>

{{-- ============================================================ --}}
{{-- SPACER — mendorong konten agar tidak tertutup navbar         --}}
{{-- ============================================================ --}}
@if (request()->routeIs('home'))
    {{-- Homepage pakai hero fullscreen, tidak butuh spacer --}}
@else
    {{-- Desktop: topbar (37px) + navbar (68px) = 105px         --}}
    {{-- Mobile:  hanya navbar (68px)                           --}}
    <div id="navSpacer" style="height: 105px;"></div>
@endif

{{-- ============================================================ --}}
{{-- SCRIPT                                                       --}}
{{-- ============================================================ --}}
<script>
(function () {
    var nav        = document.getElementById('mainNav');
    var hamburger  = document.getElementById('navHamburger');
    var mobile     = document.getElementById('mobileMenu');
    var userToggle = document.getElementById('userToggle');
    var userCard   = document.getElementById('userCard');
    var topBar     = document.getElementById('topBar');
    var spacer     = document.getElementById('navSpacer');
    var isHome     = {{ request()->routeIs('home') ? 'true' : 'false' }};

    var TB_H = (topBar && window.innerWidth >= 1025) ? topBar.offsetHeight : 0;

    function setNavTop() {
        TB_H = (topBar && window.innerWidth >= 1025) ? topBar.offsetHeight : 0;
        nav.style.top = TB_H + 'px';
        if (spacer) spacer.style.height = (TB_H + 68) + 'px';
        if (mobile.classList.contains('open')) {
            mobile.style.top = nav.getBoundingClientRect().bottom + 'px';
        }
    }
    setNavTop();

    function updateTopBar() {
        if (!topBar || window.innerWidth < 1025) return;
        if (window.scrollY > 10) {
            topBar.style.transform = 'translateY(-100%)';
            nav.style.top          = '0';
            if (spacer) spacer.style.height = '68px';
        } else {
            topBar.style.transform = 'translateY(0)';
            nav.style.top          = TB_H + 'px';
            if (spacer) spacer.style.height = (TB_H + 68) + 'px';
        }
    }

    window.addEventListener('scroll', function () {
        updateTopBar();
    }, { passive: true });

    window.addEventListener('resize', function () {
        setNavTop();
    });

    hamburger.addEventListener('click', function () {
        hamburger.classList.toggle('open');
        mobile.classList.toggle('open');
        mobile.style.top = nav.getBoundingClientRect().bottom + 'px';
    });

    if (userToggle) {
        userToggle.addEventListener('click', function (e) {
            e.stopPropagation();
            userCard.classList.toggle('open');
        });
        document.addEventListener('click', function (e) {
            if (!userToggle.contains(e.target) && !userCard.contains(e.target)) {
                userCard.classList.remove('open');
            }
        });
    }

    mobile.querySelectorAll('a').forEach(function (a) {
        a.addEventListener('click', function () {
            hamburger.classList.remove('open');
            mobile.classList.remove('open');
        });
    });
})();
</script>
