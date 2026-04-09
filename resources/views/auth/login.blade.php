<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login — Dapur Bu Iim</title>
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
            --mint-soft:  #E8F5E4;
            --ink:        #1C1208;
            --ink-soft:   #7A6A56;
            --warm-white: #FDFAF6;
            --warm-gray:  #F5F2EC;
        }

        body {
            min-height: 100vh;
            font-family: 'DM Sans', sans-serif;
            background: var(--warm-white);
            display: flex;
            overflow: hidden;
        }

        /* ── LEFT PANEL (dekorasi) ── */
        .panel-left {
            width: 52%;
            position: relative;
            background: var(--forest);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            overflow: hidden;
            flex-shrink: 0;
        }

        .panel-left .bg-photo {
            position: absolute;
            inset: 0;
            background: url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=900&q=80') center/cover no-repeat;
            opacity: .38;
            transition: opacity 8s ease;
        }

        /* pattern overlay */
        .panel-left::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                linear-gradient(to top, var(--forest) 30%, transparent 80%),
                linear-gradient(160deg, rgba(27,58,32,.7) 0%, transparent 60%);
            z-index: 1;
        }

        /* dekorasi lingkaran */
        .deco-circle {
            position: absolute;
            border-radius: 50%;
            border: 1px solid rgba(168,213,162,.12);
            z-index: 1;
        }
        .deco-circle.c1 { width: 340px; height: 340px; top: -80px; left: -80px; }
        .deco-circle.c2 { width: 220px; height: 220px; top: 60px;  left: 60px; border-color: rgba(168,213,162,.07); }
        .deco-circle.c3 { width: 480px; height: 480px; right: -160px; bottom: -160px; }

        .panel-left .content {
            position: relative;
            z-index: 2;
            padding: 52px 56px;
        }

        .panel-left .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 48px;
            text-decoration: none;
        }
        .panel-left .logo-icon {
            width: 40px; height: 40px;
            border-radius: 11px;
            background: var(--mint);
            display: flex; align-items: center; justify-content: center;
            font-family: 'Playfair Display', serif;
            font-weight: 700; font-size: 1rem;
            color: var(--forest);
            flex-shrink: 0;
        }
        .panel-left .logo-text {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem; font-weight: 700;
            color: #fff; line-height: 1;
        }
        .panel-left .logo-text span { color: var(--mint); font-style: italic; }

        .panel-left .tagline {
            font-family: 'Playfair Display', serif;
            font-size: 2.6rem;
            font-weight: 700;
            color: #fff;
            line-height: 1.2;
            margin-bottom: 20px;
        }
        .panel-left .tagline em {
            color: var(--mint);
            font-style: italic;
        }
        .panel-left .sub {
            font-size: .9rem;
            color: rgba(255,255,255,.5);
            line-height: 1.7;
            max-width: 340px;
            margin-bottom: 40px;
        }

        /* pill items */
        .pill-row {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        .pill {
            display: flex; align-items: center; gap: 7px;
            padding: 8px 16px;
            background: rgba(255,255,255,.07);
            border: 1px solid rgba(255,255,255,.1);
            border-radius: 50px;
            font-size: .78rem;
            color: rgba(255,255,255,.6);
        }
        .pill svg { opacity: .7; flex-shrink: 0; }

        /* ── RIGHT PANEL (form) ── */
        .panel-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 40px;
            background: var(--warm-white);
            overflow-y: auto;
            position: relative;
        }

        /* dekorasi sudut kanan atas */
        .panel-right::before {
            content: '';
            position: absolute;
            top: -60px; right: -60px;
            width: 240px; height: 240px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(168,213,162,.18) 0%, transparent 70%);
            pointer-events: none;
        }
        .panel-right::after {
            content: '';
            position: absolute;
            bottom: -40px; left: -40px;
            width: 180px; height: 180px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(75,138,85,.1) 0%, transparent 70%);
            pointer-events: none;
        }

        .form-wrap {
            width: 100%;
            max-width: 420px;
            position: relative;
            z-index: 1;
        }

        /* CARD pembungkus form */
        .form-card {
            background: #fff;
            border-radius: 24px;
            border: 1px solid rgba(168,213,162,.25);
            padding: 36px 36px 32px;
            box-shadow:
                0 1px 3px rgba(0,0,0,.04),
                0 8px 32px rgba(27,58,32,.07);
        }

        .form-head {
            margin-bottom: 28px;
        }
        .form-head .eyebrow {
            display: inline-flex; align-items: center; gap: 7px;
            font-size: .7rem;
            font-weight: 600;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--leaf);
            margin-bottom: 12px;
            background: rgba(75,138,85,.08);
            padding: 5px 12px;
            border-radius: 50px;
            border: 1px solid rgba(75,138,85,.15);
        }
        .form-head h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.85rem;
            font-weight: 700;
            color: var(--ink);
            line-height: 1.2;
            margin-bottom: 8px;
        }
        .form-head p {
            font-size: .84rem;
            color: var(--ink-soft);
            line-height: 1.6;
        }

        /* form fields */
        .field {
            margin-bottom: 18px;
        }
        .field label {
            display: block;
            font-size: .78rem;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 7px;
            letter-spacing: .02em;
        }
        .field .input-wrap {
            position: relative;
        }
        .field .input-wrap svg {
            position: absolute;
            left: 14px; top: 50%; transform: translateY(-50%);
            color: var(--ink-soft);
            pointer-events: none;
        }
        .field input {
            width: 100%;
            padding: 12px 14px 12px 42px;
            border: 1.5px solid #DDD8D0;
            border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: .88rem;
            color: var(--ink);
            background: #fff;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }
        .field input:focus {
            border-color: var(--leaf);
            box-shadow: 0 0 0 4px rgba(75,138,85,.1);
        }
        .field input::placeholder { color: #B8B0A4; }

        /* error */
        .field .err {
            font-size: .75rem;
            color: #C0392B;
            margin-top: 5px;
            display: flex; align-items: center; gap: 5px;
        }

        /* remember + forgot row */
        .row-between {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 24px;
        }
        .check-label {
            display: flex; align-items: center; gap: 8px;
            font-size: .82rem; color: var(--ink-soft);
            cursor: pointer; user-select: none;
        }
        .check-label input[type=checkbox] {
            width: 16px; height: 16px;
            accent-color: var(--leaf);
            cursor: pointer;
        }
        .forgot {
            font-size: .82rem;
            color: var(--leaf);
            text-decoration: none;
            font-weight: 500;
        }
        .forgot:hover { text-decoration: underline; }

        /* submit button */
        .btn-submit {
            width: 100%;
            padding: 13px;
            background: var(--forest);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: .92rem;
            font-weight: 600;
            cursor: pointer;
            transition: background .2s, transform .15s;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            margin-bottom: 24px;
        }
        .btn-submit:hover { background: var(--forest-mid); transform: translateY(-1px); }
        .btn-submit:active { transform: translateY(0); }

        /* divider */
        .divider {
            display: flex; align-items: center; gap: 14px;
            margin-bottom: 24px;
        }
        .divider hr { flex: 1; border: none; border-top: 1px solid #E5E0D8; }
        .divider span { font-size: .75rem; color: #B8B0A4; white-space: nowrap; }

        /* register link */
        .register-row {
            text-align: center;
            font-size: .84rem;
            color: var(--ink-soft);
        }
        .register-row a {
            color: var(--forest);
            font-weight: 600;
            text-decoration: none;
        }
        .register-row a:hover { text-decoration: underline; }

        /* back to home */
        .back-home {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: .78rem; color: var(--ink-soft);
            text-decoration: none;
            margin-bottom: 32px;
            transition: color .2s;
        }
        .back-home:hover { color: var(--forest); }

        @media (max-width: 860px) {
            .back-home { display: none; }
        }

        /* mobile hero banner */
        .mobile-hero {
            display: none;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 860px) {
            body { overflow-y: auto; flex-direction: column; }
            .panel-left { display: none; }
            .panel-right {
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
            .back-home { margin-bottom: 20px; }
            .form-head { margin-bottom: 24px; }
            .form-head h2 { font-size: 1.65rem; }

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
                background: url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=800&q=70') center/cover no-repeat;
                opacity: .28;
            }
            .mobile-hero::before {
                content: '';
                position: absolute; inset: 0;
                background: linear-gradient(to bottom, rgba(27,58,32,.3) 0%, var(--forest) 100%);
                z-index: 1;
            }
            .mobile-hero .mh-content {
                position: relative; z-index: 2;
            }
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

<!-- LEFT PANEL -->
<div class="panel-left">
    <div class="bg-photo"></div>
    <div class="deco-circle c1"></div>
    <div class="deco-circle c2"></div>
    <div class="deco-circle c3"></div>
    <div class="content">
        <a href="{{ route('home') }}" class="logo">
            <div class="logo-text">Dapur <span>Bu Iim</span></div>
        </a>
        <div class="tagline">
            Masakan Rumahan<br>
            yang <em>Menghangatkan</em><br>
            Hati
        </div>
        <p class="sub">
            Disiapkan dari bahan segar pilihan dengan resep turun-temurun — setiap suapan membawa rasa rumah yang sesungguhnya.
        </p>
        <div class="pill-row">
            <div class="pill">
                <svg width="13" height="13" viewBox="0 0 13 13" fill="none"><path d="M6.5 1l1.4 3 3.1.4-2.3 2.2.6 3.1L6.5 8.1 3.7 9.7l.6-3.1L2 4.4l3.1-.4z" fill="currentColor"/></svg>
                Bahan Segar
            </div>
            <div class="pill">
                <svg width="13" height="13" viewBox="0 0 13 13" fill="none"><circle cx="6.5" cy="6.5" r="5" stroke="currentColor" stroke-width="1.3"/><path d="M6.5 3.5v3l2 1.2" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/></svg>
                Tepat Waktu
            </div>
            <div class="pill">
                <svg width="13" height="13" viewBox="0 0 13 13" fill="none"><path d="M6.5 1.5C4 1.5 2 3.5 2 6c0 1.7 1 3.2 2.4 4l.6 1.5h3l.6-1.5C10 8.8 11 7.3 11 5.5c0-2.5-2-4-4.5-4z" stroke="currentColor" stroke-width="1.3"/></svg>
                Resep Keluarga
            </div>
        </div>
    </div>
</div>

<!-- MOBILE HERO (hanya tampil di mobile) -->
<div class="mobile-hero">
    <div class="mh-bg"></div>
    <div class="mh-content">
        <a href="{{ route('home') }}" class="mh-logo">
            <div class="mh-logo-text">Dapur <span>Bu Iim</span></div>
        </a>
        <div class="mh-tagline">Masakan Rumahan yang <em>Menghangatkan</em></div>
    </div>
</div>

<!-- RIGHT PANEL -->
<div class="panel-right">
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
                    Selamat datang kembali
                </div>
                <h2>Masuk ke Akun Anda</h2>
                <p>Belum punya akun? <a href="{{ route('register') }}" style="color:var(--leaf);font-weight:600;text-decoration:none;">Daftar sekarang</a></p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

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
                            required autofocus>
                    </div>
                    @error('email')
                        <div class="err">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><circle cx="6" cy="6" r="5" stroke="currentColor" stroke-width="1.2"/><path d="M6 4v3M6 8.5v.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <rect x="3" y="7" width="10" height="7" rx="1.5" stroke="currentColor" stroke-width="1.3"/>
                            <path d="M5 7V5a3 3 0 0 1 6 0v2" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                        </svg>
                        <input type="password" id="password" name="password"
                            placeholder="Masukkan password"
                            class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                            required>
                    </div>
                    @error('password')
                        <div class="err">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><circle cx="6" cy="6" r="5" stroke="currentColor" stroke-width="1.2"/><path d="M6 4v3M6 8.5v.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="row-between">
                    <label class="check-label">
                        <input type="checkbox" name="remember"> Ingat saya
                    </label>
                    @if (Route::has('password.request'))
                        <a class="forgot" href="{{ route('password.request') }}">Lupa password?</a>
                    @endif
                </div>

                <button type="submit" class="btn-submit">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <path d="M5 2H3a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h2M10 11l3-3-3-3M13 8H5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Masuk Sekarang
                </button>

            </form>
        </div>

        <div class="register-row" style="margin-top:20px;">
            Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
        </div>

    </div>
</div>

</body>
</html>
