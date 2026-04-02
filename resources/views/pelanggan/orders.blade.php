@extends('layouts.frontend')
@section('content')

<style>
.order-card {
    border: none;
    border-radius: 16px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.07);
    transition: box-shadow 0.2s;
}
.order-card:hover { box-shadow: 0 4px 24px rgba(0,0,0,0.13); }
.status-badge { font-size: 0.78rem; padding: 5px 12px; border-radius: 20px; font-weight: 600; }
.menu-img { width: 54px; height: 54px; object-fit: cover; border-radius: 10px; }
.order-number { color: #aaa; font-size: 0.82rem; }
.empty-box { padding: 60px 0; }
.page-title { font-size: 1.5rem; font-weight: 700; color: #1a1a2e; }
</style>

<div class="container py-5">

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h2 class="page-title mb-0">Pesanan Saya</h2>
            <small class="text-muted">Pantau semua pesanan kamu di sini</small>
        </div>
        <a href="{{ route('product') }}" class="btn btn-success btn-sm rounded-pill px-4">
            + Pesan Lagi
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($orders->count())

        {{-- FILTER TAB --}}
        <ul class="nav nav-pills mb-4 gap-2" id="orderTab">
            <li class="nav-item">
                <button class="nav-link active rounded-pill px-4 filter-btn" data-filter="all">
                    Semua
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link rounded-pill px-4 filter-btn" data-filter="menunggu">
                    Menunggu
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link rounded-pill px-4 filter-btn" data-filter="sedang_diproses">
                    Diproses
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link rounded-pill px-4 filter-btn" data-filter="selesai">
                    Selesai
                </button>
            </li>
        </ul>

        <div id="orderList">
        @foreach($orders as $i => $order)
            @php
                $statusMap = [
                    'menunggu'        => ['label' => 'Menunggu',        'class' => 'bg-warning text-dark',  'icon' => '🕐'],
                    'sudah_bayar'     => ['label' => 'Sudah Bayar',     'class' => 'bg-info text-dark',     'icon' => '💳'],
                    'sedang_diproses' => ['label' => 'Sedang Diproses', 'class' => 'bg-primary text-white', 'icon' => '🍳'],
                    'siap_dikirim'    => ['label' => 'Siap Dikirim',    'class' => 'bg-purple text-white',  'icon' => '🚚'],
                    'selesai'         => ['label' => 'Selesai',         'class' => 'bg-success text-white', 'icon' => '✅'],
                ];
                $s = $statusMap[$order->status] ?? ['label' => $order->status, 'class' => 'bg-secondary', 'icon' => '•'];
            @endphp

            <div class="card order-card mb-3 order-item" data-status="{{ $order->status }}">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="order-number">
                            #ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}
                            &nbsp;·&nbsp;
                            {{ \Carbon\Carbon::parse($order->order_date)->translatedFormat('d M Y') }}
                        </div>
                        <span class="status-badge {{ $s['class'] }}">
                            {{ $s['icon'] }} {{ $s['label'] }}
                        </span>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        @if($order->variant->menu->image)
                            <img src="{{ asset('storage/' . $order->variant->menu->image) }}"
                                 class="menu-img" alt="{{ $order->variant->menu->name }}">
                        @else
                            <div class="menu-img bg-light d-flex align-items-center justify-content-center rounded">
                                🍱
                            </div>
                        @endif

                        <div class="flex-grow-1">
                            <div class="fw-semibold">{{ $order->variant->menu->name }}</div>
                            <small class="text-muted">
                                {{ $order->variant->name_variant }} · {{ $order->variant->name_item }}
                            </small>
                        </div>

                        <div class="text-end">
                            <div class="text-muted small">{{ $order->quantity }} porsi</div>
                            <div class="fw-bold text-success">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mt-3 pt-3 border-top">
                        @if($order->schedule)
                            <small class="text-muted">
                                🗓 Acara:
                                <strong>
                                    {{ \Carbon\Carbon::parse($order->schedule->schedule_date)->translatedFormat('d M Y') }}
                                </strong>
                            </small>
                        @else
                            <small class="text-muted">🗓 Jadwal belum tersedia</small>
                        @endif

                        <a href="{{ route('my.orders.detail', $order->id) }}"
                           class="btn btn-sm btn-outline-primary rounded-pill px-4">
                            Lihat Detail →
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
        </div>

        {{-- Empty state setelah filter --}}
        <div id="emptyFilter" class="text-center py-5 d-none">
            <div style="font-size:3rem">🔍</div>
            <p class="text-muted mt-2">Tidak ada pesanan dengan status ini</p>
        </div>

    @else
        <div class="empty-box text-center">
            <img src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png"
                 width="90" class="mb-4 opacity-40" alt="empty">
            <h5 class="text-muted mb-2">Belum ada pesanan</h5>
            <p class="text-muted small mb-4">Yuk, pesan catering sekarang untuk acara kamu!</p>
            <a href="{{ route('product') }}" class="btn btn-success rounded-pill px-5">
                Mulai Pesan
            </a>
        </div>
    @endif

</div>

<script>
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');

        const filter = this.dataset.filter;
        const items  = document.querySelectorAll('.order-item');
        let visible  = 0;

        items.forEach(item => {
            if (filter === 'all' || item.dataset.status === filter) {
                item.style.display = '';
                visible++;
            } else {
                item.style.display = 'none';
            }
        });

        document.getElementById('emptyFilter').classList.toggle('d-none', visible > 0);
    });
});
</script>

@endsection
