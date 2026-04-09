<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar — Dapur Bu Iim</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --forest:     #1B3A20;
            --forest-mid: #2D5C35;
            --leaf:       #4B8A55;
            --mint:       #A8D5A2;
            --ink:        #1C1208;
            --ink-soft:   #7A6A56;
            --warm-white: #FDFAF6;
        }

        body {
            min-height: 100vh;
            font-family: 'DM Sans', sans-serif;
            background: var(--warm-white);
            display: flex;
            overflow: hidden;
        }

        /* ── RIGHT PANEL (form) ── */
        .panel-form {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 40px;
            background: var(--warm-white);
            overflow-y: auto;
            position: relative;
        }
        .panel-form::before {
            content: '';
            position: absolute;
            top: -60px; left: -60px;
            width: 240px; height: 240px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(168,213,162,.18) 0%, transparent 70%);
            pointer-events: none;
        }
        .panel-form::after {
            content: '';
            position: absolute;
            bottom: -40px; right: -40px;
            width: 180px; height: 180px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(75,138,85,.1) 0%, transparent 70%);
            pointer-events: none;
        }

        .form-wrap {
            width: 100%;
            max-width: 440px;
            position: relative;
            z-index: 1;
        }

        .form-card {
            background: #fff;
            border-radius: 24px;
            border: 1px solid rgba(168,213,162,.25);
            padding: 36px 36px 32px;
            box-shadow:
                0 1px 3px rgba(0,0,0,.04),
                0 8px 32px rgba(27,58,32,.07);
        }

        .back-home {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: .78rem; color: var(--ink-soft);
            text-decoration: none;
            margin-bottom: 24px;
            transition: color .2s;
        }
        .back-home:hover { color: var(--forest); }

        .form-head { margin-bottom: 24px; }
        .form-head .eyebrow {
            display: inline-flex; align-items: center; gap: 7px;
            font-size: .7rem; font-weight: 600;
            letter-spacing: .12em; text-transform: uppercase;
            color: var(--leaf); margin-bottom: 12px;
            background: rgba(75,138,85,.08);
            padding: 5px 12px; border-radius: 50px;
            border: 1px solid rgba(75,138,85,.15);
        }
        .form-head h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.85rem; font-weight: 700;
            color: var(--ink); line-height: 1.2;
            margin-bottom: 8px;
        }
        .form-head p { font-size: .84rem; color: var(--ink-soft); line-height: 1.6; }

        /* fields */
        .field { margin-bottom: 16px; }
        .field label {
            display: block; font-size: .78rem; font-weight: 600;
            color: var(--ink); margin-bottom: 7px; letter-spacing: .02em;
        }
        .field .input-wrap { position: relative; }
        .field .input-wrap svg {
            position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
            color: var(--ink-soft); pointer-events: none;
        }
        .field input {
            width: 100%;
            padding: 12px 14px 12px 42px;
            border: 1.5px solid #DDD8D0;
            border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: .88rem; color: var(--ink);
            background: #fff; outline: none;
            transition: border-color .2s, box-shadow .2s;
        }
        .field input:focus {
            border-color: var(--leaf);
            box-shadow: 0 0 0 4px rgba(75,138,85,.1);
        }
        .field input::placeholder { color: #B8B0A4; }
        .field .err {
            font-size: .75rem; color: #C0392B;
            margin-top: 5px; display: flex; align-items: center; gap: 5px;
        }

        /* two column row */
        .field-row {
            display: grid; grid-template-columns: 1fr 1fr; gap: 14px;
        }

        /* password strength */
        .strength-bar {
            display: flex; gap: 4px; margin-top: 8px;
        }
        .strength-bar span {
            flex: 1; height: 3px; border-radius: 3px;
            background: #E5E0D8; transition: background .3s;
        }
        .strength-bar.s1 span:nth-child(1) { background: #E74C3C; }
        .strength-bar.s2 span:nth-child(1),
        .strength-bar.s2 span:nth-child(2) { background: #E67E22; }
        .strength-bar.s3 span:nth-child(1),
        .strength-bar.s3 span:nth-child(2),
        .strength-bar.s3 span:nth-child(3) { background: #27AE60; }

        /* terms */
        .terms-row {
            display: flex; align-items: flex-start; gap: 10px;
            margin-bottom: 22px; margin-top: 4px;
        }
        .terms-row input[type=checkbox] {
            width: 16px; height: 16px; margin-top: 2px;
            accent-color: var(--leaf); cursor: pointer; flex-shrink: 0;
        }
        .terms-row label {
            font-size: .82rem; color: var(--ink-soft); line-height: 1.5; cursor: pointer;
        }
        .terms-row label a { color: var(--leaf); text-decoration: none; font-weight: 500; }
        .terms-row label a:hover { text-decoration: underline; }

        /* submit */
        .btn-submit {
            width: 100%; padding: 13px;
            background: var(--forest); color: #fff;
            border: none; border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: .92rem; font-weight: 600;
            cursor: pointer; transition: background .2s, transform .15s;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            margin-bottom: 22px;
        }
        .btn-submit:hover { background: var(--forest-mid); transform: translateY(-1px); }
        .btn-submit:active { transform: translateY(0); }

        .login-row {
            text-align: center; font-size: .84rem; color: var(--ink-soft);
        }
        .login-row a { color: var(--forest); font-weight: 600; text-decoration: none; }
        .login-row a:hover { text-decoration: underline; }

        /* ── LEFT PANEL ── */
        .panel-deco {
            width: 44%;
            position: relative;
            background: var(--forest);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
            flex-shrink: 0;
            padding: 52px 48px;
        }

        .panel-deco .bg-photo {
            position: absolute; inset: 0;
            background: url('https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=900&q=80') center/cover no-repeat;
            opacity: .3;
        }
        .panel-deco::before {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(to bottom, rgba(27,58,32,.5) 0%, var(--forest) 100%);
            z-index: 1;
        }

        .deco-circle {
            position: absolute; border-radius: 50%;
            border: 1px solid rgba(168,213,162,.1); z-index: 1;
        }
        .deco-circle.c1 { width: 300px; height: 300px; top: -100px; right: -100px; }
        .deco-circle.c2 { width: 180px; height: 180px; top: -20px;  right: -20px; border-color: rgba(168,213,162,.06); }

        .panel-deco .top-logo {
            position: relative; z-index: 2;
            display: flex; align-items: center; gap: 12px;
            text-decoration: none;
        }
        .panel-deco .logo-icon {
            width: 40px; height: 40px; border-radius: 11px;
            background: var(--mint);
            display: flex; align-items: center; justify-content: center;
            font-family: 'Playfair Display', serif;
            font-weight: 700; font-size: 1rem; color: var(--forest);
        }
        .panel-deco .logo-text {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem; font-weight: 700; color: #fff; line-height: 1;
        }
        .panel-deco .logo-text span { color: var(--mint); font-style: italic; }

        .panel-deco .bottom-content { position: relative; z-index: 2; }

        .panel-deco .quote {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem; font-weight: 700;
            color: #fff; line-height: 1.3;
            margin-bottom: 20px;
        }
        .panel-deco .quote em { color: var(--mint); font-style: italic; }

        .panel-deco .quote-sub {
            font-size: .86rem; color: rgba(255,255,255,.5);
            line-height: 1.7; margin-bottom: 36px;
            max-width: 300px;
        }

        /* benefit list */
        .benefit-list { list-style: none; display: flex; flex-direction: column; gap: 14px; }
        .benefit-list li {
            display: flex; align-items: center; gap: 12px;
            font-size: .84rem; color: rgba(255,255,255,.65);
        }
        .benefit-list li .icon-wrap {
            width: 32px; height: 32px; border-radius: 9px;
            background: rgba(168,213,162,.12);
            border: 1px solid rgba(168,213,162,.15);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .benefit-list li .icon-wrap svg { color: var(--mint); }

        .mobile-hero { display: none; }

        /* ── RESPONSIVE ── */
        @media (max-width: 860px) {
            body { overflow-y: auto; flex-direction: column; }
            .panel-deco { display: none; }
            .panel-form {
                padding: 0;
                min-height: auto;
                align-items: flex-start;
                flex: none;
            }
            .form-wrap {
                width: 100%;
                max-width: 100%;
                padding: 28px 24px 48px;
            }
            .back-home { display: none; }
            .form-head { margin-bottom: 24px; }
            .form-head h2 { font-size: 1.65rem; }
            .field-row { grid-template-columns: 1fr; gap: 0; }

            .mobile-hero {
                display: flex;
                flex-direction: column;
                justify-content: flex-end;
                background: var(--forest);
                position: relative;
                overflow: hidden;
                padding: 32px 24px 28px;
                min-height: 200px;
            }
            .mobile-hero .mh-bg {
                position: absolute; inset: 0;
                background: url('https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=800&q=70') center/cover no-repeat;
                opacity: .28;
            }
            .mobile-hero::before {
                content: '';
                position: absolute; inset: 0;
                background: linear-gradient(to bottom, rgba(27,58,32,.3) 0%, var(--forest) 100%);
                z-index: 1;
            }
            .mobile-hero .mh-content { position: relative; z-index: 2; }
            .mobile-hero .mh-logo {
                display: flex; align-items: center; gap: 10px;
                text-decoration: none; margin-bottom: 16px;
            }
            .mobile-hero .mh-logo-icon {
                width: 36px; height: 36px; border-radius: 10px;
                background: var(--mint);
                display: flex; align-items: center; justify-content: center;
                font-family: 'Playfair Display', serif;
                font-weight: 700; font-size: .9rem; color: var(--forest);
                flex-shrink: 0;
            }
            .mobile-hero .mh-logo-text {
                font-family: 'Playfair Display', serif;
                font-size: 1.15rem; font-weight: 700; color: #fff; line-height: 1;
            }
            .mobile-hero .mh-logo-text span { color: var(--mint); font-style: italic; }
            .mobile-hero .mh-tagline {
                font-family: 'Playfair Display', serif;
                font-size: 1.3rem; font-weight: 700;
                color: #fff; line-height: 1.3;
            }
            .mobile-hero .mh-tagline em { color: var(--mint); font-style: italic; }
        }
    </style>
</head>
<body>

<!-- MOBILE HERO -->
<div class="mobile-hero">
    <div class="mh-bg"></div>
    <div class="mh-content">
        <a href="{{ route('home') }}" class="mh-logo">
            <div class="mh-logo-text">Dapur <span>Bu Iim</span></div>
        </a>
        <div class="mh-tagline">Pesan Catering Jadi Lebih <em>Mudah</em></div>
    </div>
</div>

<!-- FORM PANEL (kiri di register, supaya variasi dari login) -->
<div class="panel-form">
    <div class="form-wrap">

        <a href="{{ route('home') }}" class="back-home">
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                <path d="M9 11L5 7l4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Kembali ke Beranda
        </a>

        <div class="form-card">
        <div class="form-head">
            <div class="eyebrow">
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none"><path d="M5 1l1 2.5 2.5.3-1.8 1.7.5 2.5L5 6.8 2.8 8l.5-2.5L1.5 3.8l2.5-.3z" fill="currentColor"/></svg>
                Bergabung sekarang
            </div>
            <h2>Buat Akun Baru</h2>
            <p>Sudah punya akun? <a href="{{ route('login') }}" style="color:var(--leaf);font-weight:600;text-decoration:none;">Masuk di sini</a></p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Nama --}}
            <div class="field">
                <label for="name">Nama Lengkap</label>
                <div class="input-wrap">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <circle cx="8" cy="5.5" r="2.5" stroke="currentColor" stroke-width="1.3"/>
                        <path d="M2.5 13.5c0-2.76 2.46-5 5.5-5s5.5 2.24 5.5 5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                    </svg>
                    <input type="text" id="name" name="name"
                        value="{{ old('name') }}"
                        placeholder="Nama kamu"
                        class="{{ $errors->has('name') ? 'is-invalid' : '' }}"
                        required autofocus>
                </div>
                @error('name')
                    <div class="err">
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><circle cx="6" cy="6" r="5" stroke="currentColor" stroke-width="1.2"/><path d="M6 4v3M6 8.5v.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Email --}}
            <div class="field">
                <label for="email">Alamat Email</label>
                <div class="input-wrap">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <path d="M2 4h12a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1zm6 4.5L13 5H3l5 3.5z" fill="currentColor"/>
                    </svg>
                    <input type="email" id="email" name="email"
                        value="{{ old('email') }}"
                        placeholder="contoh@email.com"
                        class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                        required>
                </div>
                @error('email')
                    <div class="err">
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><circle cx="6" cy="6" r="5" stroke="currentColor" stroke-width="1.2"/><path d="M6 4v3M6 8.5v.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Password row --}}
            <div class="field-row">
                <div class="field">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <rect x="3" y="7" width="10" height="7" rx="1.5" stroke="currentColor" stroke-width="1.3"/>
                            <path d="M5 7V5a3 3 0 0 1 6 0v2" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                        </svg>
                        <input type="password" id="password" name="password"
                            placeholder="Min. 8 karakter"
                            class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                            required id="pwdInput">
                    </div>
                    <div class="strength-bar" id="strengthBar">
                        <span></span><span></span><span></span>
                    </div>
                    @error('password')
                        <div class="err">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><circle cx="6" cy="6" r="5" stroke="currentColor" stroke-width="1.2"/><path d="M6 4v3M6 8.5v.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="field">
                    <label for="password_confirmation">Konfirmasi</label>
                    <div class="input-wrap">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <rect x="3" y="7" width="10" height="7" rx="1.5" stroke="currentColor" stroke-width="1.3"/>
                            <path d="M5 7V5a3 3 0 0 1 6 0v2" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                        </svg>
                        <input type="password" id="password_confirmation"
                            name="password_confirmation"
                            placeholder="Ulangi password"
                            required>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-submit">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <circle cx="8" cy="5.5" r="2.5" stroke="currentColor" stroke-width="1.4"/>
                    <path d="M2.5 13.5c0-2.76 2.46-5 5.5-5s5.5 2.24 5.5 5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                    <path d="M12 8v4M10 10h4" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                </svg>
                Buat Akun Sekarang
            </button>

        </form>
        </div>{{-- end form-card --}}

        <div class="login-row" style="margin-top:20px;">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </div>

    </div>
</div>

<!-- DECO PANEL -->
<div class="panel-deco">
    <div class="bg-photo"></div>
    <div class="deco-circle c1"></div>
    <div class="deco-circle c2"></div>

    <a href="{{ route('home') }}" class="top-logo">
        <div class="logo-text">Dapur <span>Bu Iim</span></div>
    </a>

    <div class="bottom-content">
        <div class="quote">
            Pesan Catering<br>
            Jadi Lebih <em>Mudah</em><br>
            & Menyenangkan
        </div>
        <p class="quote-sub">
            Bergabunglah bersama ratusan pelanggan setia yang sudah menikmati masakan rumahan Bu Iim setiap harinya.
        </p>
        <ul class="benefit-list">
            <li>
                <div class="icon-wrap">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2 7l3.5 3.5L12 3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                Pemesanan cepat & mudah
            </li>
            <li>
                <div class="icon-wrap">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2 7l3.5 3.5L12 3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                Lacak status pesanan real-time
            </li>
            <li>
                <div class="icon-wrap">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2 7l3.5 3.5L12 3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                Riwayat & ulasan pesanan
            </li>
        </ul>
    </div>
</div>

<script>
document.getElementById('password').addEventListener('input', function() {
    var val = this.value;
    var bar = document.getElementById('strengthBar');
    bar.className = 'strength-bar';
    if (val.length >= 12 && /[A-Z]/.test(val) && /[0-9]/.test(val)) {
        bar.classList.add('s3');
    } else if (val.length >= 8) {
        bar.classList.add('s2');
    } else if (val.length >= 1) {
        bar.classList.add('s1');
    }
});
</script>

</body>
</html>
