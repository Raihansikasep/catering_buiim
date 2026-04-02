@extends('layouts.frontend')
@section('content')

<style>
.product-img { height: 420px; object-fit: cover; border-radius: 16px; }
.variant-card { cursor: pointer; border: 2px solid #e5e7eb; border-radius: 12px;
                padding: 12px 16px; transition: all 0.2s; }
.variant-card:hover, .variant-card.active { border-color: #198754; background: #f0fdf4; }
.addon-item { border: 1.5px solid #e5e7eb; border-radius: 10px; padding: 10px 14px;
              cursor: pointer; transition: all 0.2s; }
.addon-item:hover { border-color: #198754; }
.addon-item.active { border-color: #198754; background: #f0fdf4; }
.qty-btn { width: 36px; height: 36px; border-radius: 50%; border: 1.5px solid #dee2e6;
           background: #fff; font-size: 1.1rem; cursor: pointer; transition: all 0.15s; }
.qty-btn:hover { background: #198754; color: #fff; border-color: #198754; }
.price-box { background: linear-gradient(135deg, #f0fdf4, #dcfce7);
             border-radius: 14px; padding: 16px 20px; }
</style>

<div class="container-xxl py-5">
<div class="container">
<div class="row g-5">

    {{-- GAMBAR --}}
    <div class="col-lg-6">
        <div class="position-relative">
            <img class="img-fluid w-100 product-img shadow"
                 src="{{ asset('storage/' . $menu->image) }}"
                 alt="{{ $menu->name }}">
            <span class="badge bg-success position-absolute top-0 start-0 m-3 px-3 py-2 rounded-pill">
                {{ $menu->category->name }}
            </span>
        </div>

        {{-- Min/Max info --}}
        @php
            $min = $menu->min_order && $menu->min_order > 0 ? $menu->min_order : 1;
            $max = $menu->max_order && $menu->max_order > 0 ? $menu->max_order : 9999;
        @endphp

        {{-- DESKRIPSI --}}
        @if($menu->description)
        <div class="mt-3" style="border:1.5px solid #e5e7eb; border-radius:14px; overflow:hidden;">
            <div style="background:#f0fdf4; padding:10px 16px; border-bottom:1px solid #d1fae5;">
                <span class="fw-semibold text-success" style="font-size:0.9rem;">Deskripsi Produk</span>
            </div>
            <div style="padding:14px 16px;">
                <p class="text-muted mb-3" style="font-size:0.88rem; line-height:1.75; margin:0;">
                    {{ $menu->description }}
                </p>
                <div class="d-flex gap-2 flex-wrap">
                    <span style="background:#f0fdf4; color:#166534; border:1px solid #bbf7d0;
                                font-size:0.8rem; padding:4px 12px; border-radius:20px;">
                        Minimal Order. {{ $min }} pcs
                    </span>
                    <span style="background:#f0fdf4; color:#166534; border:1px solid #bbf7d0;
                                font-size:0.8rem; padding:4px 12px; border-radius:20px;">
                        Maksimal Order. {{ $max == 9999 ? 'tidak terbatas' : $max . ' pcs' }}
                    </span>
                    <span style="background:#fffbeb; color:#92400e; border:1px solid #fde68a;
                                font-size:0.8rem; padding:4px 12px; border-radius:20px;">
                        Harga sama di semua varian
                    </span>
                </div>
            </div>
        </div>
        @endif

    </div>

    {{-- DETAIL --}}
    <div class="col-lg-6">

        <span class="text-muted small">{{ $menu->category->name }}</span>
        <h1 class="fw-bold mb-1">{{ $menu->name }}</h1>
        <span id="" class="fw-bold text-success"
                              style="font-size:1.5rem;">
                            Rp {{ number_format($menu->price) }}
                        </span>
                        <hr>

        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="menu_id" value="{{ $menu->id }}">

            {{-- PILIH VARIAN --}}
            @if($menu->variants->count())
            <div class="mb-4">
                <label class="fw-semibold mb-2 d-block">Pilih Varian</label>
                <input type="hidden" name="variant_id" id="variant_id_input" required>

                <div class="d-flex flex-column gap-2" id="variant-list">
                    @foreach($menu->variants as $variant)
                    <div class="variant-card d-flex justify-content-between align-items-center"
                         data-id="{{ $variant->id }}"
                         data-name-item="{{ $variant->name_item }}"
                         onclick="selectVariant(this)">
                        <div>
                            <div class="fw-semibold">{{ $variant->name_variant }}</div>
                            <small class="text-muted">{{ $variant->name_item }}</small>
                        </div>
                        <i class="fa fa-circle-check text-success d-none check-icon"></i>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- ADDON --}}
            @if($addons->count())
            <div class="mb-4">
                <label class="fw-semibold mb-2 d-block">
                    Tambahan
                    <span class="text-muted fw-normal">(opsional)</span>
                </label>
                <div class="d-flex flex-column gap-2">
                    @foreach($addons as $addon)
                    <label class="addon-item d-flex justify-content-between align-items-center"
                           for="addon-{{ $addon->id }}">
                        <div class="d-flex align-items-center gap-2">
                            <input class="form-check-input addon-check m-0"
                                   type="checkbox"
                                   name="addon_ids[]"
                                   id="addon-{{ $addon->id }}"
                                   value="{{ $addon->id }}"
                                   data-price="{{ $addon->price }}"
                                   onchange="recalcPrice()">
                            <span>{{ $addon->name }}</span>
                        </div>
                        <span class="text-success fw-semibold">
                            +Rp {{ number_format($addon->price) }}
                        </span>
                    </label>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- QTY --}}
            <div class="mb-4">
                <label class="fw-semibold mb-2 d-block">Jumlah Porsi</label>
                <div class="d-flex align-items-center gap-3">
                    <button type="button" class="qty-btn" id="btn-minus">−</button>
                    <input type="number" id="qty" name="qty"
                           class="form-control text-center fw-bold"
                           style="width:80px; font-size:1.1rem;"
                           value="{{ $min }}" min="{{ $min }}" max="{{ $max }}"
                           onchange="recalcPrice()">
                    <button type="button" class="qty-btn" id="btn-plus">+</button>
                    <small class="text-muted">/ porsi</small>
                </div>
            </div>

            {{-- HARGA --}}
            <div class="price-box mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted d-block">Total Harga</small>
                        <span id="display-price" class="fw-bold text-success"
                              style="font-size:1.5rem;">
                            Rp {{ number_format($menu->price * $min) }}
                        </span>
                    </div>
                    <div class="text-end">
                        <small class="text-muted d-block">Per porsi</small>
                        <span id="price-per-pcs" class="text-muted">
                            Rp {{ number_format($menu->price) }}
                        </span>
                    </div>
                </div>
            </div>

            <button type="submit" id="btn-submit"
                    class="btn btn-success w-100 py-3 rounded-pill fw-semibold"
                    {{ $menu->variants->count() ? 'disabled' : '' }}>
                🛒 Tambah ke Keranjang
            </button>

        </form>

        <a href="{{ route('product') }}" class="btn btn-outline-secondary w-100 mt-2 rounded-pill">
            ← Kembali ke Produk
        </a>

    </div>
</div>
</div>
</div>

<script>
const basePrice = {{ $menu->price }};
const minOrder  = {{ $min }};
const maxOrder  = {{ $max == 9999 ? 999999 : $max }};

function selectVariant(el) {
    // reset semua
    document.querySelectorAll('.variant-card').forEach(c => {
        c.classList.remove('active');
        c.querySelector('.check-icon').classList.add('d-none');
    });
    // aktifkan yang dipilih
    el.classList.add('active');
    el.querySelector('.check-icon').classList.remove('d-none');
    document.getElementById('variant_id_input').value = el.dataset.id;

    // enable submit
    document.getElementById('btn-submit').disabled = false;
    recalcPrice();
}

function recalcPrice() {
    let addonTotal = 0;
    document.querySelectorAll('.addon-check:checked').forEach(cb => {
        addonTotal += parseInt(cb.dataset.price) || 0;
    });

    const qty = parseInt(document.getElementById('qty').value) || minOrder;
    const perPcs = basePrice + addonTotal;
    const total  = perPcs * qty;

    document.getElementById('display-price').textContent =
        'Rp ' + total.toLocaleString('id-ID');
    document.getElementById('price-per-pcs').textContent =
        'Rp ' + perPcs.toLocaleString('id-ID');
}

document.getElementById('btn-plus').addEventListener('click', function () {
    const input = document.getElementById('qty');
    let val = parseInt(input.value) || minOrder;
    if (val < maxOrder) { input.value = val + 1; recalcPrice(); }
});

document.getElementById('btn-minus').addEventListener('click', function () {
    const input = document.getElementById('qty');
    let val = parseInt(input.value) || minOrder;
    if (val > minOrder) { input.value = val - 1; recalcPrice(); }
});

document.addEventListener('DOMContentLoaded', recalcPrice);
</script>

@endsection
