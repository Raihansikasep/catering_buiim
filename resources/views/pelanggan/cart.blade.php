@extends('layouts.frontend')
@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

* { font-family: 'Plus Jakarta Sans', sans-serif; }

.cart-page { background: #f7f8fa; min-height: 100vh; padding: 40px 0 80px; }

.cart-header h2 {
    font-size: 1.6rem;
    font-weight: 700;
    color: #111;
    margin: 0;
}
.cart-header p { color: #888; font-size: 0.88rem; margin: 4px 0 0; }

.cart-card {
    background: #fff;
    border-radius: 20px;
    border: 1px solid #eee;
    overflow: hidden;
}

.cart-item {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    padding: 20px 24px;
    border-bottom: 1px solid #f0f0f0;
    transition: background 0.15s;
}
.cart-item:last-child { border-bottom: none; }
.cart-item:hover { background: #fafafa; }

.cart-item-check {
    margin-top: 4px;
    width: 18px; height: 18px;
    accent-color: #16a34a;
    cursor: pointer;
    flex-shrink: 0;
}

.cart-item-img {
    width: 80px; height: 80px;
    border-radius: 14px;
    object-fit: cover;
    flex-shrink: 0;
}

.cart-item-info { flex: 1; min-width: 0; }
.cart-item-name { font-weight: 600; font-size: 0.95rem; color: #111; margin-bottom: 4px; }
.cart-item-variant { font-size: 0.8rem; color: #888; margin-bottom: 6px; }

.addon-badge {
    display: inline-block;
    background: #f0fdf4;
    color: #166534;
    border: 1px solid #bbf7d0;
    border-radius: 20px;
    font-size: 0.75rem;
    padding: 2px 10px;
    margin: 2px 2px 2px 0;
}

.cart-item-price-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    margin-top: 10px;
}

.qty-control {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #f4f4f5;
    border-radius: 30px;
    padding: 4px 6px;
}
.qty-control button {
    width: 28px; height: 28px;
    border-radius: 50%;
    border: none;
    background: #fff;
    font-size: 1rem;
    font-weight: 600;
    color: #333;
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    transition: all 0.15s;
    box-shadow: 0 1px 3px rgba(0,0,0,0.08);
}
.qty-control button:hover { background: #16a34a; color: #fff; }
.qty-control span { font-size: 0.9rem; font-weight: 600; min-width: 24px; text-align: center; color: #111; }

.item-subtotal { font-weight: 700; font-size: 0.95rem; color: #16a34a; }
.item-base-price { font-size: 0.78rem; color: #aaa; }

.btn-hapus {
    background: none;
    border: none;
    color: #ccc;
    cursor: pointer;
    padding: 6px;
    border-radius: 8px;
    transition: all 0.15s;
    flex-shrink: 0;
}
.btn-hapus:hover { background: #fee2e2; color: #dc2626; }

.cart-summary-card {
    background: #fff;
    border-radius: 20px;
    border: 1px solid #eee;
    padding: 24px;
    position: sticky;
    top: 24px;
}
.cart-summary-card h5 { font-weight: 700; font-size: 1rem; margin-bottom: 20px; color: #111; }

.summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.88rem;
    color: #555;
    margin-bottom: 10px;
}
.summary-row.total {
    font-size: 1.05rem;
    font-weight: 700;
    color: #111;
    border-top: 1px solid #f0f0f0;
    padding-top: 14px;
    margin-top: 4px;
}
.summary-row.total span:last-child { color: #16a34a; }

.btn-checkout {
    display: block;
    width: 100%;
    padding: 14px;
    background: #16a34a;
    color: #fff;
    border: none;
    border-radius: 14px;
    font-size: 0.95rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    text-align: center;
    text-decoration: none;
    margin-top: 16px;
}
.btn-checkout:hover { background: #15803d; color: #fff; transform: translateY(-1px); }
.btn-checkout:disabled { background: #ccc; cursor: not-allowed; transform: none; }

.btn-lanjut {
    display: block;
    width: 100%;
    padding: 11px;
    background: transparent;
    color: #555;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    font-size: 0.88rem;
    font-weight: 500;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    margin-top: 10px;
    transition: all 0.15s;
}
.btn-lanjut:hover { background: #f9fafb; color: #333; }

.empty-state {
    text-align: center;
    padding: 80px 20px;
}
.empty-state .icon-wrap {
    width: 90px; height: 90px;
    background: #f0fdf4;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 20px;
    font-size: 2.2rem;
}
.empty-state h5 { font-weight: 700; color: #111; margin-bottom: 6px; }
.empty-state p { color: #888; font-size: 0.88rem; }

.select-all-row {
    padding: 14px 24px;
    border-bottom: 1px solid #f0f0f0;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 0.85rem;
    color: #555;
    font-weight: 500;
}

/* Toast notif */
.toast-notif {
    position: fixed;
    bottom: 30px; right: 30px;
    background: #111;
    color: #fff;
    padding: 12px 20px;
    border-radius: 12px;
    font-size: 0.85rem;
    font-weight: 500;
    z-index: 9999;
    opacity: 0;
    transform: translateY(10px);
    transition: all 0.3s;
    pointer-events: none;
}
.toast-notif.show { opacity: 1; transform: translateY(0); }
.toast-notif.success { background: #16a34a; }
.toast-notif.danger { background: #dc2626; }

@media (max-width: 768px) {
    .cart-item { flex-wrap: wrap; padding: 16px; }
    .cart-item-img { width: 64px; height: 64px; }
    .cart-summary-card { position: static; margin-top: 16px; }
}
</style>

<div class="cart-page">
<div class="container">

    <div class="cart-header mb-4">
        <h2>Keranjang Belanja</h2>
        <p>{{ count($cart ?? []) }} item dalam keranjang</p>
    </div>

    @if(session('success'))
    <div id="auto-alert" class="alert alert-success alert-dismissible fade show mb-4 rounded-3" role="alert" style="font-size:0.88rem;">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(!empty($cart))
    <div class="row g-4">

        {{-- KIRI: LIST ITEM --}}
        <div class="col-lg-8">
            <div class="cart-card">

                <div class="select-all-row">
                    <input type="checkbox" id="select-all" class="cart-item-check"
                           onchange="toggleAll(this)">
                    <label for="select-all" style="cursor:pointer; margin:0;">Pilih Semua</label>
                </div>

                @foreach($cart as $id => $item)
                @php $subtotal = $item['price'] * $item['qty']; @endphp
                <div class="cart-item" id="row-{{ $id }}">

                    <input type="checkbox" class="cart-item-check item-check"
                           data-id="{{ $id }}"
                           onchange="toggleItem('{{ $id }}')"
                           {{ $item['selected'] ? 'checked' : '' }}>

                    <img class="cart-item-img"
                         src="{{ asset('storage/' . $item['image']) }}"
                         alt="{{ $item['name'] }}">

                    <div class="cart-item-info">
                        <div class="cart-item-name">{{ $item['name'] }}</div>
                        @if(!empty($item['variant_name']))
                        <div class="cart-item-variant">Varian: {{ $item['variant_name'] }}</div>
                        @endif

                        @if(!empty($item['addons']))
                        <div class="mb-1">
                            @foreach($item['addons'] as $addon)
                            <span class="addon-badge">+ {{ $addon['name'] }} (Rp {{ number_format($addon['price']) }})</span>
                            @endforeach
                        </div>
                        @endif

                        <div class="cart-item-price-row">
                            <div class="qty-control">
                                <button onclick="changeQty('{{ $id }}', -1)">−</button>
                                <span id="qty-{{ $id }}">{{ $item['qty'] }}</span>
                                <button onclick="changeQty('{{ $id }}', 1)">+</button>
                            </div>
                            <div class="text-end">
                                <div class="item-subtotal" id="subtotal-{{ $id }}">Rp {{ number_format($subtotal) }}</div>
                                <div class="item-base-price">Rp {{ number_format($item['price']) }} / porsi</div>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('cart.remove') }}" method="POST" style="flex-shrink:0;">
                        @csrf
                        <input type="hidden" name="id" value="{{ $id }}">
                        <button type="submit" class="btn-hapus" title="Hapus">
                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </form>

                </div>
                @endforeach

            </div>
        </div>

        {{-- KANAN: SUMMARY --}}
        <div class="col-lg-4">
            <div class="cart-summary-card">
                <h5>Ringkasan Pesanan</h5>

                @php
                    $grandTotal = 0;
                    $selectedCount = 0;
                    foreach($cart as $item) {
                        if($item['selected']) {
                            $grandTotal += $item['price'] * $item['qty'];
                            $selectedCount++;
                        }
                    }
                @endphp

                <div class="summary-row">
                    <span>Item dipilih</span>
                    <span id="selected-count">{{ $selectedCount }} item</span>
                </div>
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span id="subtotal-summary">Rp {{ number_format($grandTotal) }}</span>
                </div>
                <div class="summary-row">
                    <span>Ongkos kirim</span>
                    <span class="text-success fw-semibold" style="font-size:0.82rem;">Dihitung saat checkout</span>
                </div>
                <div class="summary-row total">
                    <span>Total</span>
                    <span id="grand-total">Rp {{ number_format($grandTotal) }}</span>
                </div>

                <a href="{{ route('checkout') }}" class="btn-checkout">
                    Checkout Sekarang →
                </a>
                <a href="{{ route('product') }}" class="btn-lanjut">
                    ← Lanjut Belanja
                </a>
            </div>
        </div>

    </div>

    @else

    <div class="cart-card">
        <div class="empty-state">
            <div class="icon-wrap">🛒</div>
            <h5>Keranjang Masih Kosong</h5>
            <p>Yuk tambahkan produk favoritmu ke keranjang!</p>
            <a href="{{ route('product') }}" class="btn btn-success mt-3 px-5 rounded-pill" style="font-size:0.88rem;">
                Belanja Sekarang
            </a>
        </div>
    </div>

    @endif

</div>
</div>

<div class="toast-notif" id="toastNotif"></div>

<script>
const cartPrices = @json(collect($cart ?? [])->map(fn($i) => $i['price']));
let cartQtys = @json(collect($cart ?? [])->map(fn($i) => $i['qty']));
let cartSelected = @json(collect($cart ?? [])->map(fn($i) => $i['selected']));

function showToast(msg, type = 'success') {
    const t = document.getElementById('toastNotif');
    t.textContent = msg;
    t.className = 'toast-notif ' + type + ' show';
    setTimeout(() => t.classList.remove('show'), 2500);
}

function changeQty(id, change) {
    let qty = (cartQtys[id] ?? 1) + change;
    if (qty < 1) qty = 1;
    cartQtys[id] = qty;
    document.getElementById('qty-' + id).textContent = qty;

    fetch("{{ route('cart.update.ajax') }}", {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify({ id, qty })
    }).then(r => r.json()).then(data => {
        if (data.success) {
            const price = cartPrices[id] ?? 0;
            const subtotal = price * qty;
            document.getElementById('subtotal-' + id).textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
            recalcSummary();
        }
    });
}

function toggleItem(id) {
    fetch("{{ route('cart.toggle') }}", {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify({ id })
    }).then(r => r.json()).then(data => {
        if (data.success) {
            cartSelected[id] = !cartSelected[id];
            recalcSummary();
            updateSelectAll();
        }
    });
}

function toggleAll(masterCb) {
    document.querySelectorAll('.item-check').forEach(cb => {
        const id = cb.dataset.id;
        const isChecked = cb.checked;
        if (isChecked !== masterCb.checked) {
            cb.checked = masterCb.checked;
            cartSelected[id] = masterCb.checked;
            fetch("{{ route('cart.toggle') }}", {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ id, force: masterCb.checked })
            });
        }
    });
    recalcSummary();
}

function updateSelectAll() {
    const all = document.querySelectorAll('.item-check');
    const checked = document.querySelectorAll('.item-check:checked');
    document.getElementById('select-all').checked = all.length === checked.length;
}

function recalcSummary() {
    let total = 0, count = 0;
    document.querySelectorAll('.item-check').forEach(cb => {
        if (cb.checked) {
            const id = cb.dataset.id;
            const qty = cartQtys[id] ?? 1;
            total += (cartPrices[id] ?? 0) * qty;
            count++;
        }
    });
    document.getElementById('grand-total').textContent = 'Rp ' + total.toLocaleString('id-ID');
    document.getElementById('subtotal-summary').textContent = 'Rp ' + total.toLocaleString('id-ID');
    document.getElementById('selected-count').textContent = count + ' item';
}

// Auto dismiss alert
const aa = document.getElementById('auto-alert');
if(aa) setTimeout(() => { aa.classList.remove('show'); setTimeout(()=>aa.remove(), 300); }, 3000);
</script>

@endsection
