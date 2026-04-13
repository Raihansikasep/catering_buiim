@extends('layouts.backend')

@section('content')

<style>
  @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

  * { box-sizing: border-box; }

  :root {
    --font: 'Plus Jakarta Sans', sans-serif;
    --bg: #f6f5f0;
    --surface: #ffffff;
    --surface2: #f9f8f4;
    --border: rgba(0,0,0,0.07);
    --border2: rgba(0,0,0,0.12);
    --text1: #16150e;
    --text2: #6b6860;
    --text3: #a8a49c;
    --green: #1a7f5a;
    --green-bg: #eafaf3;
    --green-light: #d0f5e5;
    --orange: #c9610a;
    --orange-bg: #fff4e8;
    --orange-light: #fdddb8;
    --purple: #5c40c0;
    --purple-bg: #f0edff;
    --purple-light: #d8d0ff;
    --rose: #c0326e;
    --rose-bg: #ffeef5;
    --rose-light: #ffd0e5;
    --blue: #1a5fc8;
    --blue-bg: #eef4ff;
    --shadow-sm: 0 1px 4px rgba(0,0,0,0.06), 0 0 0 1px rgba(0,0,0,0.04);
    --shadow-md: 0 4px 16px rgba(0,0,0,0.08), 0 0 0 1px rgba(0,0,0,0.04);
    --r-sm: 10px;
    --r-md: 14px;
    --r-lg: 20px;
  }

  .dash { font-family: var(--font); }

  /* BANNER */
  .banner {
    background: linear-gradient(135deg, #1c1812 0%, #2e2820 50%, #1c1812 100%);
    border-radius: var(--r-lg);
    padding: 24px 28px;
    margin-bottom: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
    position: relative;
    overflow: hidden;
  }
  .banner::before {
    content: '';
    position: absolute;
    top: -40px; right: -40px;
    width: 200px; height: 200px;
    background: radial-gradient(circle, rgba(255,200,100,0.12) 0%, transparent 70%);
    pointer-events: none;
  }
  .banner::after {
    content: '';
    position: absolute;
    bottom: -30px; left: 60px;
    width: 150px; height: 150px;
    background: radial-gradient(circle, rgba(100,200,180,0.08) 0%, transparent 70%);
    pointer-events: none;
  }
  .banner-date {
    font-size: 11px; font-weight: 700; letter-spacing: 1.5px;
    text-transform: uppercase; color: rgba(255,255,255,0.35); margin-bottom: 8px;
  }
  .banner-title { font-size: 1.5rem; font-weight: 800; color: #fff; margin-bottom: 4px; letter-spacing: -0.4px; }
  .banner-sub { font-size: 13px; color: rgba(255,255,255,0.4); }
  .banner-btn {
    background: rgba(255,255,255,0.08);
    color: rgba(255,255,255,0.85);
    font-family: var(--font);
    font-size: 12px; font-weight: 700;
    padding: 10px 20px;
    border-radius: var(--r-sm);
    text-decoration: none;
    display: inline-flex; align-items: center; gap: 8px;
    border: 1px solid rgba(255,255,255,0.14);
    cursor: pointer;
    transition: background 0.2s;
    white-space: nowrap;
    position: relative; z-index: 1;
  }
  .banner-btn:hover { background: rgba(255,255,255,0.14); color: #fff; }
  .badge-notif {
    background: #e84a6a; color: #fff;
    border-radius: 99px; font-size: 10px; font-weight: 800;
    padding: 1px 7px; line-height: 16px;
  }

  /* STAT GRID */
  .stat-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 14px;
    margin-bottom: 20px;
  }
  .stat-card {
    border-radius: var(--r-md);
    padding: 20px;
    position: relative;
    overflow: hidden;
    min-height: 120px;
    display: flex; flex-direction: column; justify-content: space-between;
    transition: transform 0.2s, box-shadow 0.2s;
    cursor: default;
    font-family: var(--font);
  }
  .stat-card:hover { transform: translateY(-2px); box-shadow: var(--shadow-md); }
  .stat-card-top { display: flex; justify-content: space-between; align-items: flex-start; }
  .stat-label { font-size: 11px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; opacity: 0.7; margin-bottom: 10px; }
  .stat-value { font-size: 1.6rem; font-weight: 800; letter-spacing: -0.5px; line-height: 1; margin-bottom: 8px; }
  .stat-sub { font-size: 12px; opacity: 0.65; display: flex; align-items: center; gap: 5px; }
  .stat-icon-wrap {
    width: 38px; height: 38px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 17px; flex-shrink: 0;
  }
  .s-green  { background: var(--green-bg);  color: var(--green);  border: 1px solid var(--green-light); }
  .s-orange { background: var(--orange-bg); color: var(--orange); border: 1px solid var(--orange-light); }
  .s-purple { background: var(--purple-bg); color: var(--purple); border: 1px solid var(--purple-light); }
  .s-rose   { background: var(--rose-bg);   color: var(--rose);   border: 1px solid var(--rose-light); }
  .s-green  .stat-icon-wrap { background: var(--green-light); }
  .s-orange .stat-icon-wrap { background: var(--orange-light); }
  .s-purple .stat-icon-wrap { background: var(--purple-light); }
  .s-rose   .stat-icon-wrap { background: var(--rose-light); }

  /* CARD */
  .dash-card {
    background: var(--surface);
    border-radius: var(--r-lg);
    border: 1px solid var(--border);
    box-shadow: var(--shadow-sm);
    overflow: hidden;
    font-family: var(--font);
  }
  .dash-card-body { padding: 22px; }
  .dash-card-header {
    padding: 18px 22px 16px;
    border-bottom: 1px solid var(--border);
    display: flex; justify-content: space-between; align-items: center;
  }
  .sec-title { font-size: 14px; font-weight: 700; color: var(--text1); font-family: var(--font); }
  .sec-sub   { font-size: 12px; color: var(--text3); margin-top: 3px; font-family: var(--font); }
  .sec-link  {
    font-size: 12px; font-weight: 700; color: var(--purple); font-family: var(--font);
    text-decoration: none; background: var(--purple-bg);
    padding: 6px 14px; border-radius: var(--r-sm);
    transition: background 0.15s;
  }
  .sec-link:hover { background: var(--purple-light); }

  /* ROW 2 */
  .row2-grid { display: grid; grid-template-columns: 1.9fr 1fr; gap: 14px; margin-bottom: 20px; }

  /* CHART */
  .chart-wrap { position: relative; height: 220px; margin-top: 4px; }
  .chart-legend { display: flex; gap: 18px; font-size: 11px; font-weight: 700; color: var(--text2); font-family: var(--font); }
  .chart-legend-dot { width: 10px; height: 3px; border-radius: 3px; display: inline-block; margin-right: 5px; vertical-align: middle; }

  /* PAYMENT LIST */
  .pay-item {
    display: flex; align-items: center; gap: 12px;
    padding: 11px 0; border-bottom: 1px solid var(--border);
  }
  .pay-item:last-child { border-bottom: none; }
  .pay-avatar {
    width: 36px; height: 36px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 800; flex-shrink: 0;
    background: var(--orange-bg); color: var(--orange);
    font-family: var(--font);
  }
  .pay-name { font-size: 13px; font-weight: 700; color: var(--text1); font-family: var(--font); }
  .pay-meta { font-size: 11px; color: var(--text3); margin-top: 2px; font-family: var(--font); }
  .pay-btn {
    font-family: var(--font); font-size: 11px; font-weight: 800;
    padding: 5px 13px; border-radius: 8px; border: 1px solid var(--orange-light);
    cursor: pointer; background: var(--orange-bg); color: var(--orange);
    transition: background 0.15s; white-space: nowrap; flex-shrink: 0;
    text-decoration: none; display: inline-block;
  }
  .pay-btn:hover { background: var(--orange-light); color: var(--orange); }
  .pay-scroll { max-height: 205px; overflow-y: auto; }
  .pay-empty { text-align: center; padding: 32px 0; color: var(--text3); font-size: 13px; font-family: var(--font); }
  .pay-see-all {
    display: block; text-align: center;
    background: var(--orange-bg); color: var(--orange);
    font-size: 12px; font-weight: 700; padding: 10px;
    border-radius: var(--r-sm); text-decoration: none;
    margin-top: 14px; border: 1px solid var(--orange-light);
    transition: background 0.15s; font-family: var(--font);
  }
  .pay-see-all:hover { background: var(--orange-light); }

  /* ROW 3 */
  .row3-grid { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 14px; margin-bottom: 20px; }

  /* MENU BARS */
  .mbar-wrap  { display: flex; align-items: center; gap: 10px; margin-bottom: 11px; }
  .mbar-label { font-size: 12px; font-weight: 600; color: var(--text2); min-width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-family: var(--font); }
  .mbar-track { flex: 1; height: 7px; background: var(--bg); border-radius: 99px; overflow: hidden; }
  .mbar-fill  { height: 100%; border-radius: 99px; transition: width 0.8s ease; }
  .mbar-count { font-size: 11px; font-weight: 700; color: var(--text3); min-width: 26px; text-align: right; font-family: var(--font); }

  /* AGENDA */
  .agenda-item { display: flex; align-items: center; gap: 12px; padding: 11px 0; border-bottom: 1px solid var(--border); }
  .agenda-item:last-child { border-bottom: none; }
  .agenda-date {
    min-width: 44px; height: 48px; border-radius: 10px;
    display: flex; flex-direction: column; align-items: center; justify-content: center;
    flex-shrink: 0; background: var(--bg); color: var(--text1);
  }
  .agenda-date.today { background: var(--purple); color: #fff; }
  .agenda-day { font-size: 18px; font-weight: 800; line-height: 1; font-family: var(--font); }
  .agenda-mon { font-size: 10px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-top: 2px; opacity: 0.65; font-family: var(--font); }
  .today-badge {
    background: var(--orange-bg); color: var(--orange);
    font-size: 10px; font-weight: 700; padding: 2px 8px;
    border-radius: 99px; border: 1px solid var(--orange-light);
    white-space: nowrap; flex-shrink: 0; font-family: var(--font);
  }

  /* REKAP KEUANGAN */
  .rekap-row { display: flex; align-items: center; gap: 12px; padding: 12px 0; border-bottom: 1px solid var(--border); }
  .rekap-row:last-child { border-bottom: none; }
  .rekap-icon { width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0; }
  .rekap-label { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text3); margin-bottom: 2px; font-family: var(--font); }
  .rekap-val-green { font-size: 15px; font-weight: 800; color: var(--green); font-family: var(--font); }
  .rekap-val-red   { font-size: 15px; font-weight: 800; color: #c02c2c; font-family: var(--font); }
  .profit-box { border-radius: var(--r-sm); padding: 14px; text-align: center; margin-top: 10px; }
  .profit-box.pos { background: var(--green-bg); border: 1px solid var(--green-light); }
  .profit-box.neg { background: #fef2f2; border: 1px solid #fecaca; }
  .profit-label { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; font-family: var(--font); }
  .profit-val   { font-size: 1.25rem; font-weight: 800; font-family: var(--font); }
  .profit-box.pos .profit-label, .profit-box.pos .profit-val { color: var(--green); }
  .profit-box.neg .profit-label, .profit-box.neg .profit-val { color: #c02c2c; }
  .progress-bar { height: 7px; border-radius: 99px; overflow: hidden; display: flex; gap: 2px; margin-top: 12px; }
  .prog-in  { background: linear-gradient(90deg, #1a7f5a, #38d98a); border-radius: 99px 0 0 99px; }
  .prog-out { background: linear-gradient(90deg, #e84a6a, #c02c2c); border-radius: 0 99px 99px 0; }
  .prog-labels { display: flex; justify-content: space-between; margin-top: 6px; font-size: 10px; font-weight: 700; color: var(--text3); font-family: var(--font); }

  /* ORDERS TABLE */
  .orders-table { width: 100%; border-collapse: collapse; font-family: var(--font); }
  .orders-table th {
    padding: 11px 16px; text-align: left;
    font-size: 10px; font-weight: 800; text-transform: uppercase;
    letter-spacing: 0.6px; color: var(--text3);
    background: #faf9f6; border-bottom: 1px solid var(--border);
  }
  .orders-table th:first-child { padding-left: 20px; }
  .orders-table th:last-child  { padding-right: 20px; text-align: right; }
  .orders-table td { padding: 13px 16px; border-bottom: 1px solid var(--border); vertical-align: middle; }
  .orders-table td:first-child { padding-left: 20px; }
  .orders-table td:last-child  { padding-right: 20px; text-align: right; }
  .orders-table tr:last-child td { border-bottom: none; }
  .orders-table tbody tr { transition: background 0.12s; }
  .orders-table tbody tr:hover { background: var(--surface2); }
  .cust-name  { font-size: 13px; font-weight: 700; color: var(--text1); }
  .cust-phone { font-size: 11px; color: var(--text3); margin-top: 2px; }
  .menu-name  { font-size: 12px; font-weight: 600; color: var(--text2); }
  .menu-sub   { font-size: 11px; color: var(--text3); margin-top: 2px; }
  .tgl-text   { font-size: 12px; font-weight: 600; color: var(--text2); }
  .total-val  { font-size: 14px; font-weight: 800; color: var(--green); }

  /* STATUS & PAYMENT BADGES */
  .status-badge {
    display: inline-block; padding: 3px 10px;
    border-radius: 99px; font-size: 10px; font-weight: 800; white-space: nowrap;
    font-family: var(--font);
  }
  .sb-menunggu  { background: #fffbeb; color: #92560a; border: 1px solid #fde68a; }
  .sb-bayar     { background: var(--blue-bg); color: var(--blue); border: 1px solid #bfdbfe; }
  .sb-diproses  { background: #f0f9ff; color: #0369a1; border: 1px solid #bae6fd; }
  .sb-kirim     { background: var(--purple-bg); color: var(--purple); border: 1px solid var(--purple-light); }
  .sb-selesai   { background: var(--green-bg); color: var(--green); border: 1px solid var(--green-light); }

  .pay-badge {
    display: inline-block; padding: 3px 10px;
    border-radius: 99px; font-size: 10px; font-weight: 800; white-space: nowrap;
    font-family: var(--font);
  }
  .pb-review { background: var(--orange-bg); color: var(--orange); border: 1px solid var(--orange-light); }
  .pb-lunas  { background: var(--green-bg);  color: var(--green);  border: 1px solid var(--green-light); }
  .pb-tolak  { background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; }

  /* RESPONSIVE */
  @media(max-width:960px) {
    .stat-grid  { grid-template-columns: repeat(2,1fr); }
    .row2-grid  { grid-template-columns: 1fr; }
    .row3-grid  { grid-template-columns: 1fr 1fr; }
  }
  @media(max-width:600px) {
    .stat-grid  { grid-template-columns: 1fr; }
    .row3-grid  { grid-template-columns: 1fr; }
    .banner     { flex-direction: column; align-items: flex-start; }
  }
</style>

<div class="dash">

  {{-- ══════════════════════════════════════
       BANNER
  ══════════════════════════════════════ --}}
  <div class="banner">
    <div>
      <div class="banner-date">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</div>
      <div class="banner-title">Selamat datang, Admin 👋</div>
      <div class="banner-sub">Dapur Ibu Iim &mdash; Panel Admin Catering</div>
    </div>
    <div style="display:flex;gap:10px;flex-wrap:wrap;">
      <a href="{{ route('admin.payments.index') }}" class="banner-btn">
        💳 Kelola Pembayaran
        @if(isset($pendingPayments) && $pendingPayments > 0)
          <span class="badge-notif">{{ $pendingPayments }}</span>
        @endif
      </a>
    </div>
  </div>


  {{-- ══════════════════════════════════════
       ROW 1: STAT CARDS
  ══════════════════════════════════════ --}}
  <div class="stat-grid">

    <div class="stat-card s-green">
      <div class="stat-card-top">
        <div>
          <div class="stat-label">Revenue Hari Ini</div>
          <div class="stat-value">Rp {{ number_format($todayRevenue, 0, ',', '.') }}</div>
        </div>
        <div class="stat-icon-wrap">💰</div>
      </div>
      <div class="stat-sub">🛒 {{ $todayOrders }} pesanan masuk</div>
    </div>

    <div class="stat-card s-orange">
      <div class="stat-card-top">
        <div>
          <div class="stat-label">Pesanan Hari Ini</div>
          <div class="stat-value">{{ $todayOrders }}</div>
        </div>
        <div class="stat-icon-wrap">📦</div>
      </div>
      <div class="stat-sub">⏰ order baru hari ini</div>
    </div>

    <div class="stat-card s-purple">
      <div class="stat-card-top">
        <div>
          <div class="stat-label">Pelanggan Bulan Ini</div>
          <div class="stat-value">{{ $newClients }}</div>
        </div>
        <div class="stat-icon-wrap">👥</div>
      </div>
      <div class="stat-sub">😊 pelanggan unik</div>
    </div>

    <div class="stat-card s-rose">
      <div class="stat-card-top">
        <div>
          <div class="stat-label">Revenue Bulan Ini</div>
          <div class="stat-value">Rp {{ number_format($monthRevenue, 0, ',', '.') }}</div>
        </div>
        <div class="stat-icon-wrap">📊</div>
      </div>
      <div class="stat-sub">📅 {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</div>
    </div>

  </div>


  {{-- ══════════════════════════════════════
       ROW 2: CHART + PENDING PAYMENT
  ══════════════════════════════════════ --}}
  <div class="row2-grid">

    {{-- Chart --}}
    <div class="dash-card">
      <div class="dash-card-header">
        <div>
          <div class="sec-title">📈 Sales Overview {{ \Carbon\Carbon::now()->year }}</div>
          <div class="sec-sub">Revenue & jumlah pesanan per bulan</div>
        </div>
        <div class="chart-legend">
          <span><span class="chart-legend-dot" style="background:#5c40c0;"></span>Revenue</span>
          <span><span class="chart-legend-dot" style="background:#1a7f5a;"></span>Pesanan</span>
        </div>
      </div>
      <div class="dash-card-body">
        <div class="chart-wrap">
          <canvas id="chart-line"></canvas>
        </div>
      </div>
    </div>

    {{-- Pending Payment --}}
    <div class="dash-card">
      <div class="dash-card-header">
        <div>
          <div class="sec-title" style="display:flex;align-items:center;gap:8px;">
            <span style="background:#fef2f2;color:#c02c2c;border-radius:8px;width:26px;height:26px;display:inline-flex;align-items:center;justify-content:center;font-size:12px;flex-shrink:0;">🔔</span>
            Menunggu Konfirmasi
          </div>
          <div class="sec-sub" style="margin-top:4px;">Bukti bayar yang perlu direview</div>
        </div>
      </div>
      <div class="dash-card-body">
        <div class="pay-scroll">
          @forelse($pendingPaymentList ?? [] as $payment)
          @php
            $initials = collect(explode(' ', $payment->order->customer_name))
              ->take(2)->map(fn($w) => strtoupper($w[0]))->join('');
            $avatarColors = [
              ['background:var(--orange-bg);color:var(--orange)'],
              ['background:var(--purple-bg);color:var(--purple)'],
              ['background:var(--green-bg);color:var(--green)'],
              ['background:var(--blue-bg);color:var(--blue)'],
            ];
            $colorStyle = $avatarColors[$loop->index % count($avatarColors)][0];
          @endphp
          <div class="pay-item">
            <div class="pay-avatar" style="{{ $colorStyle }}">{{ $initials }}</div>
            <div style="flex:1;min-width:0;">
              <div class="pay-name">{{ $payment->order->customer_name }}</div>
              <div class="pay-meta">
                {{ $payment->order->variant->menu->name ?? '-' }} &bull;
                {{ \Carbon\Carbon::parse($payment->created_at)->diffForHumans() }}
              </div>
            </div>
            <a href="{{ route('admin.payments.show', $payment->id) }}" class="pay-btn">Review</a>
          </div>
          @empty
          <div class="pay-empty">
            <div style="font-size:28px;margin-bottom:8px;">✅</div>
            Semua sudah dikonfirmasi
          </div>
          @endforelse
        </div>

        @if(isset($pendingPayments) && $pendingPayments > 0)
        <a href="{{ route('admin.payments.index') }}" class="pay-see-all">
          Lihat semua ({{ $pendingPayments }}) →
        </a>
        @endif
      </div>
    </div>

  </div>


  {{-- ══════════════════════════════════════
       ROW 3: MENU TERLARIS + JADWAL + KEUANGAN
  ══════════════════════════════════════ --}}
  <div class="row3-grid">

    {{-- Menu Terlaris --}}
    <div class="dash-card dash-card-body">
      <div style="margin-bottom:18px;">
        <div class="sec-title">🍽️ Menu Terlaris</div>
        <div class="sec-sub">Berdasarkan jumlah pesanan</div>
      </div>
      @php
        $barColors = ['#5c40c0','#1a7f5a','#c9610a','#c0326e','#1a5fc8'];
        $maxQty = isset($topMenus) && $topMenus->count() ? $topMenus->first()->total_qty : 1;
      @endphp
      @forelse($topMenus ?? [] as $i => $menu)
      <div class="mbar-wrap">
        <div class="mbar-label" title="{{ $menu->menu_name }}">{{ $menu->menu_name }}</div>
        <div class="mbar-track">
          <div class="mbar-fill" style="width:{{ min(100, ($menu->total_qty / $maxQty) * 100) }}%;background:{{ $barColors[$i % count($barColors)] }};"></div>
        </div>
        <div class="mbar-count">{{ $menu->total_qty }}x</div>
      </div>
      @empty
      <div style="text-align:center;color:var(--text3);font-size:13px;padding:24px 0;">Belum ada data</div>
      @endforelse
    </div>

    {{-- Jadwal Minggu Ini --}}
    <div class="dash-card dash-card-body">
      <div style="margin-bottom:16px;">
        <div class="sec-title">📅 Jadwal Minggu Ini</div>
        <div class="sec-sub">
          {{ \Carbon\Carbon::now()->startOfWeek()->format('d M') }} –
          {{ \Carbon\Carbon::now()->endOfWeek()->format('d M Y') }}
        </div>
      </div>
      @forelse($weekSchedules ?? [] as $schedule)
      @php $d = \Carbon\Carbon::parse($schedule->schedule_date); $isToday = $d->isToday(); @endphp
      <div class="agenda-item">
        <div class="agenda-date {{ $isToday ? 'today' : '' }}">
          <div class="agenda-day">{{ $d->format('d') }}</div>
          <div class="agenda-mon">{{ $d->format('M') }}</div>
        </div>
        <div style="flex:1;min-width:0;">
          <div style="font-size:13px;font-weight:700;color:var(--text1);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
            {{ $schedule->order->customer_name ?? '-' }}
          </div>
          <div style="font-size:11px;color:var(--text3);margin-top:2px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
            {{ $schedule->order->variant->menu->name ?? '-' }} &bull; {{ $schedule->order->quantity ?? '-' }} porsi
          </div>
        </div>
        @if($isToday)
          <span class="today-badge">Hari ini</span>
        @endif
      </div>
      @empty
      <div style="text-align:center;color:var(--text3);font-size:13px;padding:24px 0;">
        <div style="font-size:28px;margin-bottom:8px;">📭</div>
        Tidak ada acara minggu ini
      </div>
      @endforelse
    </div>

    {{-- Rekap Keuangan --}}
    <div class="dash-card dash-card-body">
      <div style="margin-bottom:16px;">
        <div class="sec-title">💰 Rekap Keuangan</div>
        <div class="sec-sub">Bulan {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</div>
      </div>

      <div class="rekap-row">
        <div class="rekap-icon" style="background:var(--green-bg);">⬆️</div>
        <div>
          <div class="rekap-label">Pemasukan</div>
          <div class="rekap-val-green">Rp {{ number_format($monthRevenue, 0, ',', '.') }}</div>
        </div>
      </div>

      <div class="rekap-row">
        <div class="rekap-icon" style="background:#fef2f2;">⬇️</div>
        <div>
          <div class="rekap-label">Pengeluaran</div>
          <div class="rekap-val-red">Rp {{ number_format($monthExpense, 0, ',', '.') }}</div>
        </div>
      </div>

      @php $profit = $monthRevenue - $monthExpense; @endphp
      <div class="profit-box {{ $profit >= 0 ? 'pos' : 'neg' }}">
        <div class="profit-label">{{ $profit >= 0 ? 'Profit Bersih' : 'Minus' }}</div>
        <div class="profit-val">Rp {{ number_format(abs($profit), 0, ',', '.') }}</div>
      </div>

      @php
        $total  = $monthRevenue + $monthExpense;
        $incPct = $total > 0 ? round($monthRevenue / $total * 100) : 50;
        $expPct = 100 - $incPct;
      @endphp
      <div class="progress-bar">
        <div class="prog-in"  style="width:{{ $incPct }}%;"></div>
        <div class="prog-out" style="width:{{ $expPct }}%;"></div>
      </div>
      <div class="prog-labels">
        <span>Masuk {{ $incPct }}%</span>
        <span>Keluar {{ $expPct }}%</span>
      </div>
    </div>

  </div>


  {{-- ══════════════════════════════════════
       ROW 4: PESANAN TERBARU
  ══════════════════════════════════════ --}}
  <div class="dash-card" style="overflow:hidden;margin-bottom:8px;">
    <div class="dash-card-header">
      <div>
        <div class="sec-title">📋 Pesanan Terbaru</div>
        <div class="sec-sub">5 pesanan terakhir masuk</div>
      </div>
      <a href="{{ route('admin.orders.index') }}" class="sec-link">Lihat semua →</a>
    </div>
    <div style="overflow-x:auto;">
      <table class="orders-table">
        <thead>
          <tr>
            <th>Customer</th>
            <th>Menu</th>
            <th style="text-align:center;">Tgl Acara</th>
            <th style="text-align:center;">Status Order</th>
            <th style="text-align:center;">Pembayaran</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          @forelse($recentOrders as $order)
          <tr>
            <td>
              <div class="cust-name">{{ $order->customer_name }}</div>
              <div class="cust-phone">{{ $order->customer_phone }}</div>
            </td>
            <td>
              <div class="menu-name">{{ $order->variant->menu->name ?? '-' }}</div>
              <div class="menu-sub">{{ $order->variant->name_variant ?? '' }} &bull; {{ $order->quantity }}x</div>
            </td>
            <td style="text-align:center;">
              <span class="tgl-text">
                {{ $order->schedule ? \Carbon\Carbon::parse($order->schedule->schedule_date)->format('d M Y') : '-' }}
              </span>
            </td>
            <td style="text-align:center;">
              @php
                $statusMap = [
                  'menunggu'        => ['label' => 'Menunggu',   'class' => 'sb-menunggu'],
                  'sudah_bayar'     => ['label' => 'Sudah Bayar','class' => 'sb-bayar'],
                  'sedang_diproses' => ['label' => 'Diproses',   'class' => 'sb-diproses'],
                  'siap_dikirim'    => ['label' => 'Siap Kirim', 'class' => 'sb-kirim'],
                  'selesai'         => ['label' => 'Selesai',    'class' => 'sb-selesai'],
                ];
                $st = $statusMap[$order->status] ?? ['label' => $order->status, 'class' => 'sb-menunggu'];
              @endphp
              <span class="status-badge {{ $st['class'] }}">{{ $st['label'] }}</span>
            </td>
            <td style="text-align:center;">
              @if($order->payment)
                @if($order->payment->isPending())
                  <span class="pay-badge pb-review">Review</span>
                @elseif($order->payment->isConfirmed())
                  <span class="pay-badge pb-lunas">Lunas</span>
                @else
                  <span class="pay-badge pb-tolak">Ditolak</span>
                @endif
              @else
                <span style="font-size:11px;color:var(--text3);">Belum bayar</span>
              @endif
            </td>
            <td>
              <span class="total-val">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" style="padding:40px;text-align:center;color:var(--text3);font-size:13px;font-family:var(--font);">
              Belum ada pesanan
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</div>

@endsection


@push('scripts')
<script>
(function () {
  var canvas = document.getElementById('chart-line');
  if (!canvas || typeof Chart === 'undefined') return;

  var ctx = canvas.getContext('2d');
  var labels  = {!! json_encode($chartLabels)  !!};
  var revenue = {!! json_encode($chartRevenue) !!};
  var orders  = {!! json_encode($chartOrders)  !!};

  var gradPurple = ctx.createLinearGradient(0, 0, 0, 220);
  gradPurple.addColorStop(0, 'rgba(92,64,192,0.18)');
  gradPurple.addColorStop(1, 'rgba(92,64,192,0)');

  var gradGreen = ctx.createLinearGradient(0, 0, 0, 220);
  gradGreen.addColorStop(0, 'rgba(26,127,90,0.14)');
  gradGreen.addColorStop(1, 'rgba(26,127,90,0)');

  new Chart(ctx, {
    type: 'line',
    data: {
      labels: labels,
      datasets: [
        {
          label: 'Revenue',
          data: revenue,
          borderColor: '#5c40c0',
          backgroundColor: gradPurple,
          borderWidth: 2.5,
          tension: 0.42,
          fill: true,
          pointRadius: 5,
          pointBackgroundColor: '#fff',
          pointBorderColor: '#5c40c0',
          pointBorderWidth: 2,
          yAxisID: 'y',
        },
        {
          label: 'Pesanan',
          data: orders,
          borderColor: '#1a7f5a',
          backgroundColor: gradGreen,
          borderWidth: 2.5,
          tension: 0.42,
          fill: true,
          pointRadius: 5,
          pointBackgroundColor: '#fff',
          pointBorderColor: '#1a7f5a',
          pointBorderWidth: 2,
          yAxisID: 'y1',
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      interaction: { intersect: false, mode: 'index' },
      plugins: {
        legend: { display: false },
        tooltip: {
          backgroundColor: '#1c1812',
          titleColor: '#fff',
          bodyColor: 'rgba(255,255,255,0.7)',
          padding: 12,
          cornerRadius: 10,
          callbacks: {
            label: function (ctx) {
              if (ctx.datasetIndex === 0)
                return '  Revenue: Rp ' + ctx.raw.toLocaleString('id-ID');
              return '  Pesanan: ' + ctx.raw + ' order';
            }
          }
        }
      },
      scales: {
        x: {
          grid: { display: false },
          ticks: { font: { size: 11, family: 'Plus Jakarta Sans' }, color: '#a8a49c' }
        },
        y: {
          position: 'left',
          beginAtZero: true,
          grid: { color: 'rgba(0,0,0,0.04)' },
          ticks: {
            font: { size: 10, family: 'Plus Jakarta Sans' },
            color: '#a8a49c',
            callback: function (v) {
              if (v >= 1000000) return 'Rp ' + Math.round(v / 1000000) + 'jt';
              if (v >= 1000)    return 'Rp ' + Math.round(v / 1000) + 'rb';
              return 'Rp ' + v;
            }
          }
        },
        y1: {
          position: 'right',
          beginAtZero: true,
          grid: { display: false },
          ticks: { font: { size: 10, family: 'Plus Jakarta Sans' }, color: '#a8a49c' }
        }
      }
    }
  });
})();
</script>
@endpush
