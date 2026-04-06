@extends('layouts.frontend')
@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap');

*, *::before, *::after { box-sizing: border-box; }
* { font-family: 'Plus Jakarta Sans', sans-serif; }

/* ─── PAGE ─────────────────────────────────────── */
.orders-page {
    background: #f4f6f9;
    min-height: 100vh;
    padding: 40px 0 80px;
}

/* ─── HEADER ────────────────────────────────────── */
.page-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 16px;
    margin-bottom: 28px;
    flex-wrap: wrap;
}
.page-header-text h2 {
    font-size: 1.55rem;
    font-weight: 700;
    color: #0f172a;
    margin: 0 0 3px;
    letter-spacing: -0.3px;
}
.page-header-text p {
    color: #94a3b8;
    font-size: 0.83rem;
    margin: 0;
}

/* ─── BUTTON PESAN LAGI ─────────────────────────── */
.btn-pesan-lagi {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 10px 22px;
    background: #16a34a;
    color: #fff;
    border: none;
    border-radius: 50px;
    font-size: 0.83rem;
    font-weight: 700;
    text-decoration: none;
    transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
    white-space: nowrap;
    box-shadow: 0 2px 8px rgba(22,163,74,0.25);
}
.btn-pesan-lagi:hover {
    background: #15803d;
    color: #fff;
    transform: translateY(-1px);
    box-shadow: 0 4px 14px rgba(22,163,74,0.35);
}

/* ─── ALERT ─────────────────────────────────────── */
.alert-custom {
    display: flex;
    align-items: center;
    gap: 10px;
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    border-radius: 14px;
    padding: 13px 18px;
    font-size: 0.84rem;
    color: #166534;
    font-weight: 500;
    margin-bottom: 20px;
    transition: opacity 0.3s;
}
.alert-custom-icon {
    width: 22px;
    height: 22px;
    background: #16a34a;
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    flex-shrink: 0;
}

/* ─── FILTER TABS ───────────────────────────────── */
.filter-tabs {
    display: flex;
    gap: 6px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}
.filter-btn {
    padding: 7px 16px;
    border-radius: 50px;
    border: 1.5px solid #e2e8f0;
    background: #fff;
    font-size: 0.78rem;
    font-weight: 600;
    color: #64748b;
    cursor: pointer;
    transition: all 0.15s;
    white-space: nowrap;
}
.filter-btn:hover  { border-color: #16a34a; color: #16a34a; }
.filter-btn.active { background: #16a34a; border-color: #16a34a; color: #fff; box-shadow: 0 2px 8px rgba(22,163,74,0.2); }

/* ─── ORDER CARD ────────────────────────────────── */
.order-card {
    background: #fff;
    border-radius: 18px;
    border: 1px solid #f1f5f9;
    margin-bottom: 12px;
    overflow: hidden;
    transition: border-color 0.18s, transform 0.18s, box-shadow 0.18s;
}
.order-card:hover {
    border-color: #86efac;
    transform: translateY(-2px);
    box-shadow: 0 6px 24px rgba(22,163,74,0.08);
}

/* ─── CARD HEAD ─────────────────────────────────── */
.order-card-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 18px;
    border-bottom: 1px solid #f8fafc;
    flex-wrap: wrap;
    gap: 8px;
    background: #fafafa;
}
.order-meta { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
.order-num  { font-size: 0.78rem; font-weight: 700; color: #0f172a; }
.order-dot  { width: 3px; height: 3px; border-radius: 50%; background: #cbd5e1; }
.order-date { font-size: 0.75rem; color: #94a3b8; }

/* ─── STATUS BADGE ──────────────────────────────── */
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 4px 11px;
    border-radius: 50px;
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 0.1px;
}
.status-badge::before {
    content: '';
    display: inline-block;
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: currentColor;
    opacity: 0.7;
}
.s-menunggu     { background: #fffbeb; color: #b45309; border: 1px solid #fde68a; }
.s-sudah_bayar  { background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; }
.s-diproses     { background: #f0f9ff; color: #0369a1; border: 1px solid #bae6fd; }
.s-siap_dikirim { background: #faf5ff; color: #7c3aed; border: 1px solid #ddd6fe; }
.s-selesai      { background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; }
.s-default      { background: #f8fafc; color: #475569; border: 1px solid #e2e8f0; }

/* ─── CARD BODY ─────────────────────────────────── */
.order-card-body {
    padding: 16px 18px;
    display: flex;
    align-items: flex-start;
    gap: 14px;
}

/* ─── MENU IMAGE ────────────────────────────────── */
.menu-img-wrap {
    flex-shrink: 0;
    width: 64px;
    height: 64px;
    border-radius: 12px;
    background: #f1f5f9;
    overflow: hidden;
    border: 1px solid #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
}
.menu-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* ─── ORDER INFO ────────────────────────────────── */
.order-info { flex: 1; min-width: 0; }
.order-menu-name {
    font-size: 0.95rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 2px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.order-variant { font-size: 0.77rem; color: #94a3b8; margin-bottom: 7px; }

/* ─── ADDON BADGES ──────────────────────────────── */
.addon-list { display: flex; flex-wrap: wrap; gap: 4px; margin-bottom: 8px; }
.addon-badge {
    background: #f0fdf4;
    color: #16a34a;
    border: 1px solid #bbf7d0;
    border-radius: 50px;
    font-size: 0.68rem;
    font-weight: 600;
    padding: 2px 9px;
}

.page-header {
    background: none !important;
    padding-top: 0 !important;
    padding-bottom: 0 !important;
}

/* ─── ORDER BOTTOM ROW ──────────────────────────── */
.order-bottom {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
    flex-wrap: wrap;
}
.order-schedule {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 0.73rem;
    color: #475569;
    background: #f8fafc;
    border-radius: 8px;
    padding: 3px 10px;
    border: 1px solid #f1f5f9;
}
.order-schedule svg { flex-shrink: 0; }
.order-total-wrap { text-align: right; }
.order-qty   { font-size: 0.7rem; color: #94a3b8; margin-bottom: 1px; }
.order-total { font-size: 0.95rem; font-weight: 700; color: #16a34a; }

/* ─── CARD FOOTER ───────────────────────────────── */
.order-card-foot {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    padding: 11px 18px;
    border-top: 1px solid #f8fafc;
    gap: 8px;
    background: #fafafa;
}
.btn-detail {
    padding: 7px 18px;
    border-radius: 10px;
    border: 1.5px solid #e2e8f0;
    background: transparent;
    font-size: 0.78rem;
    font-weight: 600;
    color: #475569;
    text-decoration: none;
    transition: all 0.15s;
    cursor: pointer;
}
.btn-detail:hover { border-color: #16a34a; color: #16a34a; background: #f0fdf4; }

.btn-reorder {
    padding: 7px 18px;
    border-radius: 10px;
    border: 1.5px solid #bbf7d0;
    background: #f0fdf4;
    font-size: 0.78rem;
    font-weight: 600;
    color: #166534;
    text-decoration: none;
    transition: all 0.15s;
    cursor: pointer;
}
.btn-reorder:hover { background: #dcfce7; border-color: #86efac; }

/* ─── EMPTY STATE ───────────────────────────────── */
.empty-state {
    background: #fff;
    border-radius: 18px;
    border: 1px solid #f1f5f9;
    text-align: center;
    padding: 80px 20px;
}
.empty-icon {
    width: 76px;
    height: 76px;
    background: #f0fdf4;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 16px;
    font-size: 2rem;
}
.empty-state h5 { font-weight: 700; color: #0f172a; margin-bottom: 6px; font-size: 1.05rem; }
.empty-state p  { color: #94a3b8; font-size: 0.84rem; margin: 0; }

/* ─── TOAST ─────────────────────────────────────── */
.toast-notif {
    position: fixed;
    bottom: 28px;
    right: 28px;
    background: #0f172a;
    color: #fff;
    padding: 12px 20px;
    border-radius: 14px;
    font-size: 0.83rem;
    font-weight: 600;
    z-index: 9999;
    opacity: 0;
    transform: translateY(10px);
    transition: all 0.3s;
    pointer-events: none;
    display: flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.15);
    max-width: 320px;
}
.toast-notif.show    { opacity: 1; transform: translateY(0); }
.toast-notif.success { background: #16a34a; }

/* ─── RESPONSIVE ─────────────────────────────────── */
@media (max-width: 576px) {
    .page-header-text h2 { font-size: 1.25rem; }
    .order-card-body { flex-direction: column; }
    .menu-img-wrap { width: 100%; height: 130px; border-radius: 12px; }
    .order-bottom { flex-direction: column; align-items: flex-start; }
    .order-total-wrap { text-align: left; }
    .order-card-foot { justify-content: stretch; }
    .btn-detail, .btn-reorder { flex: 1; text-align: center; }
}
</style>

<div class="orders-page">
<div class="container">

    {{-- ─── HEADER ─────────────────────────────────── --}}
    <div class="page-header">
        <div class="page-header-text">
            <h2>Pesanan Saya</h2>
            <p>Pantau semua pesanan kamu di sini</p>
        </div>
        <a href="{{ route('product') }}" class="btn-pesan-lagi">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Pesan Lagi
        </a>
    </div>

    {{-- ─── ALERT SESSION ──────────────────────────── --}}
    @if(session('success'))
    <div class="alert-custom" id="auto-alert">
        <div class="alert-custom-icon">✓</div>
        {{ session('success') }}
    </div>
    @endif

    @if($orders->count())

    {{-- ─── FILTER TABS ─────────────────────────────── --}}
    <div class="filter-tabs">
        <button class="filter-btn active" data-filter="all">
            Semua <span style="opacity:.6">({{ $orders->count() }})</span>
        </button>
        <button class="filter-btn" data-filter="menunggu">Menunggu</button>
        <button class="filter-btn" data-filter="sudah_bayar">Sudah Bayar</button>
        <button class="filter-btn" data-filter="sedang_diproses">Diproses</button>
        <button class="filter-btn" data-filter="siap_dikirim">Siap Dikirim</button>
        <button class="filter-btn" data-filter="selesai">Selesai</button>
    </div>

    {{-- ─── ORDER LIST ──────────────────────────────── --}}
    <div id="orderList">
    @foreach($orders as $order)
    @php
        $statusMap = [
            'menunggu'        => ['label' => 'Menunggu',        'cls' => 's-menunggu'],
            'sudah_bayar'     => ['label' => 'Sudah Bayar',     'cls' => 's-sudah_bayar'],
            'sedang_diproses' => ['label' => 'Sedang Diproses', 'cls' => 's-diproses'],
            'siap_dikirim'    => ['label' => 'Siap Dikirim',    'cls' => 's-siap_dikirim'],
            'selesai'         => ['label' => 'Selesai',         'cls' => 's-selesai'],
        ];
        $s = $statusMap[$order->status] ?? ['label' => ucfirst($order->status), 'cls' => 's-default'];
    @endphp

    <div class="order-card order-item" data-status="{{ $order->status }}">

        {{-- Head --}}
        <div class="order-card-head">
            <div class="order-meta">
                <span class="order-num">#ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</span>
                <span class="order-dot"></span>
                <span class="order-date">{{ \Carbon\Carbon::parse($order->order_date)->translatedFormat('d M Y') }}</span>
            </div>
            <span class="status-badge {{ $s['cls'] }}">{{ $s['label'] }}</span>
        </div>

        {{-- Body --}}
        <div class="order-card-body">

            {{-- Gambar --}}
            <div class="menu-img-wrap">
                @if($order->variant->menu->image)
                    <img src="{{ asset('storage/' . $order->variant->menu->image) }}"
                         alt="{{ $order->variant->menu->name }}">
                @else
                    🍱
                @endif
            </div>

            {{-- Info --}}
            <div class="order-info">
                <div class="order-menu-name">{{ $order->variant->menu->name }}</div>
                <div class="order-variant">{{ $order->variant->name_variant }} &middot; {{ $order->variant->name_item }}</div>

                @if($order->addons->count())
                <div class="addon-list">
                    @foreach($order->addons as $oa)
                        <span class="addon-badge">+ {{ $oa->addon->name }} (Rp {{ number_format($oa->price) }})</span>
                    @endforeach
                </div>
                @endif

                <div class="order-bottom">
                    <div>
                        @if($order->schedule)
                        <span class="order-schedule">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            Acara: {{ \Carbon\Carbon::parse($order->schedule->schedule_date)->translatedFormat('d M Y') }}
                        </span>
                        @endif
                    </div>
                    <div class="order-total-wrap">
                        <div class="order-qty">{{ $order->quantity }} porsi</div>
                        <div class="order-total">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Footer --}}
        <div class="order-card-foot">
            @if($order->status === 'selesai')
            <a href="{{ route('product') }}" class="btn-reorder">Pesan Lagi</a>
            @endif
            <a href="{{ route('my.orders.detail', $order->id) }}" class="btn-detail">Lihat Detail →</a>
        </div>

    </div>
    @endforeach
    </div>

    {{-- Empty filter state --}}
    <div id="emptyFilter" class="empty-state d-none">
        <div class="empty-icon">📭</div>
        <h5>Tidak ada pesanan</h5>
        <p>Tidak ada pesanan dengan status ini</p>
    </div>

    @else

    {{-- Empty orders state --}}
    <div class="empty-state">
        <div class="empty-icon">🛒</div>
        <h5>Belum ada pesanan</h5>
        <p>Yuk, pesan catering sekarang untuk acara kamu!</p>
        <a href="{{ route('product') }}" class="btn-pesan-lagi d-inline-flex mt-3">Mulai Pesan</a>
    </div>

    @endif

</div>
</div>

{{-- Toast --}}
<div class="toast-notif" id="toastNotif"></div>

<script>
// ─── Filter tabs ───────────────────────────────────
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');

        const filter = this.dataset.filter;
        let visible = 0;

        document.querySelectorAll('.order-item').forEach(item => {
            const show = filter === 'all' || item.dataset.status === filter;
            item.style.display = show ? '' : 'none';
            if (show) visible++;
        });

        const emptyEl = document.getElementById('emptyFilter');
        if (emptyEl) emptyEl.classList.toggle('d-none', visible > 0);
    });
});

// ─── Toast from session ────────────────────────────
@if(session('success'))
const toast = document.getElementById('toastNotif');
toast.textContent = '{{ session('success') }}';
toast.className = 'toast-notif success show';
setTimeout(() => toast.classList.remove('show'), 3500);
@endif

// ─── Auto-dismiss alert ────────────────────────────
const alert = document.getElementById('auto-alert');
if (alert) {
    setTimeout(() => {
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 350);
    }, 3000);
}
</script>

@endsection
