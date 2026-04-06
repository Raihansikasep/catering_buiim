@extends('layouts.frontend')
@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
* { font-family: 'Plus Jakarta Sans', sans-serif; }

.detail-page { background: #f7f8fa; min-height: 100vh; padding: 40px 0 80px; }

.detail-card {
    background: #fff;
    border-radius: 20px;
    border: 1px solid #eee;
    padding: 24px;
    margin-bottom: 16px;
}
.section-title {
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: #aaa;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 6px;
}

.info-row {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 10px 0;
    border-bottom: 1px solid #f4f4f5;
    font-size: 0.88rem;
    gap: 12px;
}
.info-row:last-child { border-bottom: none; }
.info-label { color: #999; flex-shrink: 0; }
.info-value { font-weight: 500; color: #111; text-align: right; }

.status-pill {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 6px 16px; border-radius: 20px; font-size: 0.8rem; font-weight: 600;
}
.s-menunggu     { background: #fffbeb; color: #92400e; }
.s-sudah_bayar  { background: #eff6ff; color: #1e40af; }
.s-diproses     { background: #f0f9ff; color: #0369a1; }
.s-siap_dikirim { background: #faf5ff; color: #7e22ce; }
.s-selesai      { background: #f0fdf4; color: #166534; }
.s-default      { background: #f4f4f5; color: #555; }

.btn-back {
    width: 38px; height: 38px;
    border-radius: 50%;
    background: #fff;
    border: 1px solid #eee;
    display: flex; align-items: center; justify-content: center;
    text-decoration: none;
    color: #555;
    font-size: 1rem;
    transition: all 0.15s;
    flex-shrink: 0;
}
.btn-back:hover { background: #f4f4f5; color: #111; }

/* TIMELINE */
.timeline-step { display: flex; align-items: flex-start; gap: 14px; }
.timeline-icon {
    width: 36px; height: 36px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.95rem; flex-shrink: 0;
}
.timeline-icon.done    { background: #d1fae5; color: #065f46; }
.timeline-icon.active  { background: #dbeafe; color: #1d4ed8; }
.timeline-icon.pending { background: #f3f4f6; color: #9ca3af; }
.timeline-line { width: 2px; height: 20px; background: #e5e7eb; margin-left: 17px; margin-top: 2px; margin-bottom: 2px; }

/* ADDON */
.addon-badge {
    display: inline-block;
    background: #f0fdf4; color: #166534;
    border: 1px solid #bbf7d0;
    border-radius: 20px; font-size: 0.75rem;
    padding: 3px 10px; margin: 3px 3px 3px 0;
}

/* SUMMARY */
.summary-row {
    display: flex; justify-content: space-between;
    align-items: center; font-size: 0.88rem;
    color: #777; padding: 8px 0;
    border-bottom: 1px solid #f4f4f5;
}
.summary-row:last-child { border-bottom: none; }
.summary-row.grand {
    font-size: 1rem; font-weight: 700; color: #111;
    border-top: 1px dashed #e5e7eb; padding-top: 12px; margin-top: 4px;
}
.summary-row.grand span:last-child { color: #16a34a; }

.btn-wa {
    display: block; width: 100%; padding: 12px;
    background: #16a34a; color: #fff; border: none;
    border-radius: 12px; font-size: 0.88rem; font-weight: 600;
    text-align: center; text-decoration: none;
    transition: all 0.2s;
}
.btn-wa:hover { background: #15803d; color: #fff; transform: translateY(-1px); }

.schedule-box { text-align: center; padding: 16px 0; }
.schedule-box .day-name { font-size: 1.1rem; font-weight: 700; color: #111; margin-top: 8px; }
.schedule-box .day-date { font-size: 0.85rem; color: #999; }

@media (max-width: 576px) {
    .detail-card { padding: 16px; }
}
</style>

<div class="detail-page">
<div class="container">

@php
    $statusMap = [
        'menunggu'        => ['label' => 'Menunggu',        'cls' => 's-menunggu',     'icon' => '🕐', 'step' => 1],
        'sudah_bayar'     => ['label' => 'Sudah Bayar',     'cls' => 's-sudah_bayar',  'icon' => '💳', 'step' => 2],
        'sedang_diproses' => ['label' => 'Sedang Diproses', 'cls' => 's-diproses',     'icon' => '🍳', 'step' => 3],
        'siap_dikirim'    => ['label' => 'Siap Dikirim',    'cls' => 's-siap_dikirim', 'icon' => '🚚', 'step' => 4],
        'selesai'         => ['label' => 'Selesai',         'cls' => 's-selesai',      'icon' => '✅', 'step' => 5],
    ];
    $s = $statusMap[$order->status] ?? ['label' => ucfirst($order->status), 'cls' => 's-default', 'icon' => '•', 'step' => 0];
    $currentStep = $s['step'];

    $addonTotal = $order->addons->sum('price') * $order->quantity;
    $baseTotal  = $order->variant->menu->price * $order->quantity;
@endphp

{{-- HEADER --}}
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('my.orders') }}" class="btn-back">←</a>
    <div class="flex-grow-1">
        <h5 class="mb-0 fw-700" style="font-weight:700; color:#111;">Detail Pesanan</h5>
        <small style="color:#aaa;">
            #ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}
            &nbsp;·&nbsp;
            {{ \Carbon\Carbon::parse($order->order_date)->translatedFormat('d M Y') }}
        </small>
    </div>
    <span class="status-pill {{ $s['cls'] }}">{{ $s['icon'] }} {{ $s['label'] }}</span>
</div>

<div class="row g-4">

    {{-- KIRI --}}
    <div class="col-lg-8">

        {{-- STATUS TRACKING --}}
        <div class="detail-card">
            <div class="section-title">📍 Status Pesanan</div>
            @php
                $steps = [
                    1 => ['icon' => '🕐', 'label' => 'Pesanan Masuk'],
                    2 => ['icon' => '💳', 'label' => 'Pembayaran Dikonfirmasi'],
                    3 => ['icon' => '🍳', 'label' => 'Sedang Dimasak'],
                    4 => ['icon' => '🚚', 'label' => 'Dalam Pengiriman'],
                    5 => ['icon' => '✅', 'label' => 'Pesanan Selesai'],
                ];
            @endphp
            @foreach($steps as $step => $info)
            <div class="timeline-step">
                <div class="timeline-icon {{ $step < $currentStep ? 'done' : ($step == $currentStep ? 'active' : 'pending') }}">
                    {{ $info['icon'] }}
                </div>
                <div style="padding-top: 6px;">
                    <div style="font-size:0.88rem; font-weight:600; color: {{ $step > $currentStep ? '#ccc' : '#111' }};">
                        {{ $info['label'] }}
                    </div>
                    @if($step == $currentStep)
                        <small style="color:#2563eb;">● Sedang berlangsung</small>
                    @elseif($step < $currentStep)
                        <small style="color:#16a34a;">✓ Selesai</small>
                    @endif
                </div>
            </div>
            @if($step < 5)<div class="timeline-line"></div>@endif
            @endforeach
        </div>

        {{-- INFO PRODUK --}}
        <div class="detail-card">
            <div class="section-title">🛒 Info Produk</div>

            <div class="d-flex gap-3 align-items-center mb-4">
                @if($order->variant->menu->image)
                <img src="{{ asset('storage/' . $order->variant->menu->image) }}"
                     style="width:72px; height:72px; object-fit:cover; border-radius:14px; flex-shrink:0;"
                     alt="{{ $order->variant->menu->name }}">
                @endif
                <div>
                    <div style="font-size:0.95rem; font-weight:700; color:#111;">{{ $order->variant->menu->name }}</div>
                    <div style="font-size:0.82rem; color:#aaa; margin-top:2px;">
                        {{ $order->variant->name_variant }} · {{ $order->variant->name_item }}
                    </div>

                    {{-- ADDON --}}
                    @if($order->addons->count())
                    <div style="margin-top:8px;">
                        @foreach($order->addons as $oa)
                            <span class="addon-badge">+ {{ $oa->addon->name }} (Rp {{ number_format($oa->price) }})</span>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>

            <div class="info-row">
                <span class="info-label">Harga per porsi</span>
                <span class="info-value">Rp {{ number_format($order->variant->menu->price) }}</span>
            </div>
            @if($order->addons->count())
            <div class="info-row">
                <span class="info-label">Addon per porsi</span>
                <span class="info-value">+ Rp {{ number_format($order->addons->sum('price')) }}</span>
            </div>
            @endif
            <div class="info-row">
                <span class="info-label">Jumlah</span>
                <span class="info-value">{{ $order->quantity }} porsi</span>
            </div>
            <div class="info-row">
                <span class="info-label">Catatan</span>
                <span class="info-value">{{ $order->notes ?? '-' }}</span>
            </div>
        </div>

        {{-- INFO PENERIMA --}}
        <div class="detail-card">
            <div class="section-title">👤 Info Penerima</div>
            <div class="info-row">
                <span class="info-label">Nama</span>
                <span class="info-value">{{ $order->customer_name }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">No HP</span>
                <span class="info-value">{{ $order->customer_phone }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Alamat</span>
                <span class="info-value">{{ $order->customer_address }}</span>
            </div>
        </div>

        {{-- BUKTI BAYAR --}}
        @if($order->payment_proof)
        <div class="detail-card">
            <div class="section-title">🧾 Bukti Pembayaran</div>
            <img src="{{ asset('storage/' . $order->payment_proof) }}"
                 class="img-fluid rounded-3 border"
                 style="max-width:280px;"
                 alt="Bukti Pembayaran">
        </div>
        @endif

    </div>

    {{-- KANAN --}}
    <div class="col-lg-4">

        {{-- RINGKASAN PEMBAYARAN --}}
        <div class="detail-card">
            <div class="section-title">💰 Ringkasan Pembayaran</div>
            <div class="summary-row">
                <span>Subtotal menu</span>
                <span>Rp {{ number_format($baseTotal) }}</span>
            </div>
            @if($order->addons->count())
            <div class="summary-row">
                <span>Total addon</span>
                <span>Rp {{ number_format($addonTotal) }}</span>
            </div>
            @endif
            <div class="summary-row">
                <span>Biaya layanan</span>
                <span style="color:#16a34a; font-size:0.82rem;">Gratis</span>
            </div>
            <div class="summary-row grand">
                <span>Total</span>
                <span>Rp {{ number_format($order->total_price) }}</span>
            </div>
        </div>

        {{-- JADWAL ACARA --}}
        <div class="detail-card">
            <div class="section-title">🗓 Jadwal Acara</div>
            @if($order->schedule)
            <div class="schedule-box">
                <div style="font-size:2.2rem;">📅</div>
                <div class="day-name">
                    {{ \Carbon\Carbon::parse($order->schedule->schedule_date)->translatedFormat('l') }}
                </div>
                <div class="day-date">
                    {{ \Carbon\Carbon::parse($order->schedule->schedule_date)->translatedFormat('d F Y') }}
                </div>
            </div>
            @else
            <div class="text-center py-3" style="color:#ccc; font-size:0.85rem;">
                <div style="font-size:2rem;">📭</div>
                Jadwal belum tersedia
            </div>
            @endif
        </div>

        {{-- BANTUAN --}}
        <div class="detail-card" style="background:#f9fafb;">
            <div class="section-title">💬 Butuh Bantuan?</div>
            <p style="font-size:0.82rem; color:#999; margin-bottom:14px;">
                Hubungi kami jika ada pertanyaan seputar pesanan kamu.
            </p>
            <a href="https://wa.me/6282129539896" target="_blank" class="btn-wa">
                WhatsApp Kami
            </a>
        </div>

    </div>
    <div class="mt-4">

    @if($order->status === 'menunggu')

        {{-- Jika payment sebelumnya ditolak --}}
        @if($order->payment && $order->payment->isRejected())
        <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:14px;padding:14px 18px;font-size:0.84rem;color:#dc2626;margin-bottom:14px;display:flex;gap:10px;align-items:flex-start">
            <span>✕</span>
            <div>
                <strong>Pembayaran Ditolak</strong><br>
                Alasan: {{ $order->payment->note }}<br>
                <span style="color:#475569;font-size:0.8rem">Silakan upload ulang bukti transfer yang benar.</span>
            </div>
        </div>
        @endif

        {{-- Tombol upload bukti --}}
        <a href="{{ route('payment.create', $order->id) }}"
           style="display:inline-flex;align-items:center;gap:8px;padding:12px 26px;background:#16a34a;color:#fff;border-radius:12px;font-weight:700;font-size:0.88rem;text-decoration:none;transition:all 0.2s;box-shadow:0 2px 8px rgba(22,163,74,0.25)">
            💳 Upload Bukti Pembayaran
        </a>

    @elseif($order->status === 'sudah_bayar')

        <div style="background:#fffbeb;border:1px solid #fde68a;border-radius:14px;padding:14px 18px;font-size:0.84rem;color:#92400e;display:flex;gap:10px;align-items:center">
            ⏳
            <div>
                <strong>Menunggu Konfirmasi Admin</strong><br>
                <span style="font-size:0.8rem">Bukti transfer kamu sedang diverifikasi. Mohon tunggu.</span>
            </div>
        </div>

    @elseif($order->status === 'sedang_diproses')

        <div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:14px;padding:14px 18px;font-size:0.84rem;color:#166534;display:flex;gap:10px;align-items:center">
            ✓
            <div>
                <strong>Pembayaran Dikonfirmasi</strong><br>
                <span style="font-size:0.8rem">Pesanan kamu sedang diproses oleh dapur.</span>
            </div>
        </div>

    @elseif($order->status === 'siap_dikirim')

        <div style="background:#faf5ff;border:1px solid #ddd6fe;border-radius:14px;padding:14px 18px;font-size:0.84rem;color:#7c3aed;display:flex;gap:10px;align-items:center">
            🚚
            <div>
                <strong>Pesanan Siap Dikirim</strong><br>
                <span style="font-size:0.8rem">Pesanan kamu sedang dalam perjalanan.</span>
            </div>
        </div>

    @elseif($order->status === 'selesai')

        <div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:14px;padding:14px 18px;font-size:0.84rem;color:#166534;display:flex;gap:10px;align-items:center">
            🎉
            <div>
                <strong>Pesanan Selesai</strong><br>
                <span style="font-size:0.8rem">Terima kasih sudah memesan di Dapur Bu Iim!</span>
            </div>
        </div>

    @endif

</div>

</div>

</div>
</div>
@endsection
