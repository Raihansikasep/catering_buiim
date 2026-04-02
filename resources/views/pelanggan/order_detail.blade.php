@extends('layouts.frontend')
@section('content')

<style>
.detail-card { border: none; border-radius: 16px; box-shadow: 0 2px 16px rgba(0,0,0,0.08); }
.section-title { font-size: 0.8rem; font-weight: 700; text-transform: uppercase;
                 letter-spacing: 1px; color: #888; margin-bottom: 12px; }
.info-row { display: flex; justify-content: space-between; padding: 8px 0;
            border-bottom: 1px solid #f0f0f0; font-size: 0.95rem; }
.info-row:last-child { border-bottom: none; }
.info-label { color: #888; }
.info-value { font-weight: 500; color: #1a1a2e; text-align: right; max-width: 60%; }
.status-pill { padding: 6px 16px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; }
.timeline-step { display: flex; align-items: flex-start; gap: 14px; margin-bottom: 16px; }
.timeline-icon { width: 36px; height: 36px; border-radius: 50%; display: flex;
                 align-items: center; justify-content: center; font-size: 1rem;
                 flex-shrink: 0; }
.timeline-icon.done  { background: #d1fae5; color: #065f46; }
.timeline-icon.active { background: #dbeafe; color: #1d4ed8; }
.timeline-icon.pending { background: #f3f4f6; color: #9ca3af; }
.timeline-line { width: 2px; height: 24px; background: #e5e7eb; margin-left: 17px; }
</style>

<div class="container py-5">

    @php
        $statusMap = [
            'menunggu'        => ['label' => 'Menunggu',        'class' => 'bg-warning text-dark',  'icon' => '🕐', 'step' => 1],
            'sudah_bayar'     => ['label' => 'Sudah Bayar',     'class' => 'bg-info text-dark',     'icon' => '💳', 'step' => 2],
            'sedang_diproses' => ['label' => 'Sedang Diproses', 'class' => 'bg-primary text-white', 'icon' => '🍳', 'step' => 3],
            'siap_dikirim'    => ['label' => 'Siap Dikirim',    'class' => 'bg-purple text-white',  'icon' => '🚚', 'step' => 4],
            'selesai'         => ['label' => 'Selesai',         'class' => 'bg-success text-white', 'icon' => '✅', 'step' => 5],
        ];
        $s = $statusMap[$order->status] ?? ['label' => $order->status, 'class' => 'bg-secondary', 'icon' => '•', 'step' => 0];
        $currentStep = $s['step'];

        $scheduleStatusMap = [
            'belum'           => ['label' => 'Belum Diproses',  'class' => 'bg-secondary text-white'],
            'sedang_diproses' => ['label' => 'Sedang Diproses', 'class' => 'bg-warning text-dark'],
            'selesai'         => ['label' => 'Selesai',         'class' => 'bg-success text-white'],
        ];
        $ss = $order->schedule
            ? ($scheduleStatusMap[$order->schedule->status] ?? ['label' => $order->schedule->status, 'class' => 'bg-secondary text-white'])
            : null;
    @endphp

    {{-- BACK + HEADER --}}
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('my.orders') }}" class="btn btn-light rounded-circle"
           style="width:40px;height:40px;display:flex;align-items:center;justify-content:center;">
            ←
        </a>
        <div>
            <h4 class="mb-0 fw-bold">Detail Pesanan</h4>
            <small class="text-muted">
                #ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}
                &nbsp;·&nbsp;
                {{ \Carbon\Carbon::parse($order->order_date)->translatedFormat('d M Y') }}
            </small>
        </div>
        <span class="status-pill {{ $s['class'] }} ms-auto">
            {{ $s['icon'] }} {{ $s['label'] }}
        </span>
    </div>

    <div class="row g-4">

        {{-- KIRI --}}
        <div class="col-lg-8">

            {{-- TRACKING STATUS --}}
            <div class="detail-card card mb-4 p-4">
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
                        <div class="pt-1">
                            <div class="fw-semibold {{ $step > $currentStep ? 'text-muted' : '' }}">
                                {{ $info['label'] }}
                            </div>
                            @if($step == $currentStep)
                                <small class="text-primary">● Sedang berlangsung</small>
                            @elseif($step < $currentStep)
                                <small class="text-success">✓ Selesai</small>
                            @endif
                        </div>
                    </div>
                    @if($step < 5)
                        <div class="timeline-line"></div>
                    @endif
                @endforeach
            </div>

            {{-- INFO PRODUK --}}
            <div class="detail-card card mb-4 p-4">
                <div class="section-title">🛒 Info Produk</div>

                <div class="d-flex gap-3 align-items-center mb-3">
                    @if($order->variant->menu->image)
                        <img src="{{ asset('storage/' . $order->variant->menu->image) }}"
                             style="width:70px;height:70px;object-fit:cover;border-radius:12px;"
                             alt="{{ $order->variant->menu->name }}">
                    @endif
                    <div>
                        <div class="fw-bold fs-6">{{ $order->variant->menu->name }}</div>
                        <small class="text-muted">
                            {{ $order->variant->name_variant }} · {{ $order->variant->name_item }}
                        </small>
                        @if($order->variant->menu->description)
                            <div class="text-muted small mt-1">
                                {{ $order->variant->menu->description }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="info-row">
                    <span class="info-label">Harga Satuan</span>
                    <span class="info-value">Rp {{ number_format($order->variant->menu->price, 0, ',', '.') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Jumlah</span>
                    <span class="info-value">{{ $order->quantity }} porsi</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Catatan</span>
                    <span class="info-value">{{ $order->notes ?? '-' }}</span>
                </div>
            </div>

            {{-- INFO PELANGGAN --}}
            <div class="detail-card card mb-4 p-4">
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
            <div class="detail-card card mb-4 p-4">
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
            <div class="detail-card card mb-4 p-4">
                <div class="section-title">💰 Ringkasan Pembayaran</div>

                <div class="info-row">
                    <span class="info-label">Subtotal</span>
                    <span class="info-value">
                        Rp {{ number_format($order->variant->menu->price * $order->quantity, 0, ',', '.') }}
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Biaya Layanan</span>
                    <span class="info-value text-muted">Gratis</span>
                </div>
                <div class="info-row border-top pt-2 mt-1">
                    <span class="fw-bold">Total</span>
                    <span class="fw-bold text-success fs-5">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </span>
                </div>
            </div>

            {{-- JADWAL PENGIRIMAN --}}
            <div class="detail-card card mb-4 p-4">
                <div class="section-title">🗓 Jadwal Acara</div>

                @if($order->schedule)
                    <div class="text-center py-2">
                        <div style="font-size:2.5rem">📅</div>
                        <div class="fw-bold fs-5 mt-2">
                            {{ \Carbon\Carbon::parse($order->schedule->schedule_date)->translatedFormat('l') }}
                        </div>
                        <div class="text-muted">
                            {{ \Carbon\Carbon::parse($order->schedule->schedule_date)->translatedFormat('d F Y') }}
                        </div>
                        <span class="status-pill {{ $ss['class'] }} mt-2 d-inline-block">
                            {{ $ss['label'] }}
                        </span>
                    </div>
                @else
                    <div class="text-center py-3 text-muted">
                        <div style="font-size:2rem">📭</div>
                        <small>Jadwal belum tersedia</small>
                    </div>
                @endif
            </div>

            {{-- BUTUH BANTUAN --}}
            <div class="detail-card card p-4 bg-light">
                <div class="section-title">💬 Butuh Bantuan?</div>
                <p class="text-muted small mb-3">
                    Hubungi kami jika ada pertanyaan seputar pesanan kamu.
                </p>
                <a href="https://wa.me/6282129539896" target="_blank"
                   class="btn btn-success w-100 rounded-pill">
                    <i class="fab fa-whatsapp me-2"></i> Chat WhatsApp
                </a>
            </div>

        </div>

    </div>

</div>

@endsection
