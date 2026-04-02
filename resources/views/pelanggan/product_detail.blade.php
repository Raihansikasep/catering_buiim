@extends('layouts.frontend')
@section('content')

<div class="container-xxl py-5">
    <div class="container">

        <div class="row g-5">

            {{-- GAMBAR --}}
            <div class="col-lg-6">
                <div class="position-relative">
                    <img class="img-fluid w-100 rounded shadow"
                         src="{{ asset('storage/' . $menu->image) }}"
                         style="height:400px; object-fit:cover;"
                         alt="{{ $menu->name }}">

                    <span class="badge bg-success position-absolute top-0 start-0 m-3 px-3 py-2">
                        {{ $menu->category->name }}
                    </span>
                </div>
            </div>

            {{-- DETAIL --}}
            <div class="col-lg-6">

                <h1 class="mb-2">{{ $menu->name }}</h1>

                <h3 class="text-success mb-1" id="display-price">
                    Rp {{ number_format($menu->price) }}
                </h3>
                <small class="text-muted d-block mb-3">Harga dasar — belum termasuk tambahan</small>

                <p class="text-muted mb-4">
                    {{ $menu->description ?? 'Produk catering dengan bahan berkualitas dan rasa rumahan yang lezat.' }}
                </p>

                {{-- FORM --}}
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="menu_id" value="{{ $menu->id }}">

                    {{-- PILIH VARIAN --}}
                    @if($menu->variants->count())
                        <div class="mb-3">
                            <label class="form-label fw-bold">Pilih Varian:</label>
                            <select class="form-select" name="variant_id" id="variant-select" required onchange="updateVariantInfo()">
                                <option value="">-- Pilih Varian --</option>
                                @foreach($menu->variants as $variant)
                                    <option value="{{ $variant->id }}"
                                            data-name-item="{{ $variant->name_item }}">
                                        {{ $variant->name_variant }}
                                    </option>
                                @endforeach
                            </select>

                            {{-- Info Box yang lebih simpel --}}
                            <div id="variant-info" class="mt-2 p-3 bg-light border rounded" style="display:none;">
                                <div class="fw-bold text-dark">
                                    <i class="fa fa-utensils text-success me-2"></i>
                                    <span id="variant-name-item"></span>
                                </div>
                            </div>
                        </div>
                    @else
                        <input type="hidden" name="variant_id" value="">
                    @endif

                    {{-- MENU TAMBAHAN (ADDON GLOBAL) --}}
                    @if($addons->count())
                        <div class="mb-4">
                            <label class="form-label fw-bold">
                                Menu Tambahan
                                <span class="text-muted fw-normal">(opsional)</span>
                            </label>
                            <div class="border rounded p-3 bg-light">
                                @foreach($addons as $addon)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input addon-check"
                                               type="checkbox"
                                               name="addon_ids[]"
                                               id="addon-{{ $addon->id }}"
                                               value="{{ $addon->id }}"
                                               data-price="{{ $addon->price }}"
                                               onchange="recalcPrice()">

                                        <label class="form-check-label d-flex justify-content-between w-100"
                                               for="addon-{{ $addon->id }}">
                                            <span>{{ $addon->name }}</span>
                                            <span class="text-success fw-semibold">
                                                +Rp {{ number_format($addon->price) }}
                                            </span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-2 p-2 rounded bg-white border d-flex justify-content-between">
                                <span class="text-muted">Total harga per porsi:</span>
                                <span class="fw-bold text-success" id="total-per-porsi">
                                    Rp {{ number_format($menu->price) }}
                                </span>
                            </div>
                        </div>
                    @endif

                    {{-- QTY --}}
                    <div class="mb-4">
                        <label class="form-label fw-bold">Jumlah Pesanan:</label>

                        @php
                            $min = $menu->min_order && $menu->min_order > 0 ? $menu->min_order : 1;
                            $max = $menu->max_order && $menu->max_order > 0 ? $menu->max_order : 9999;
                        @endphp



                            <input type="number"
                                id="qty"
                                name="qty"
                                class="form-control text-center"
                                style="width:100px;"
                                value="{{ $min }}"
                                min="{{ $min }}"
                                max="{{ $max }}">


                        <small class="text-muted mt-1 d-block">
                            Minimal {{ $min }} — Maksimal {{ $max }} porsi
                        </small>
                    </div>


                    <button type="submit" class="btn btn-success w-100 py-2 mb-3">
                        <i class="fa fa-shopping-cart me-2"></i>
                        Tambah ke Keranjang
                    </button>

                </form>

                <a href="{{ route('product') }}" class="btn btn-outline-secondary w-100">
                    ← Kembali ke Produk
                </a>

            </div>
        </div>

    </div>
</div>

<script>
// Pastikan variabel basePrice terdefinisi dari PHP
const basePrice = {{ $menu->price }};

document.addEventListener('DOMContentLoaded', () => {
    // Jalankan fungsi saat pertama kali load untuk cek jika ada yang terpilih (old value)
    updateVariantInfo();
    recalcPrice();
});

function updateVariantInfo() {
    const select = document.getElementById('variant-select');
    const infoDiv = document.getElementById('variant-info');
    const nameItemDisplay = document.getElementById('variant-name-item');
    const descDisplay = document.getElementById('variant-description');

    if (!select || !infoDiv) return;

    const selectedOption = select.options[select.selectedIndex];

    // Cek apakah ada option yang dipilih dan nilainya tidak kosong
    if (selectedOption && selectedOption.value !== "") {
        // Ambil data dari atribut data- (Sesuai HTML: data-name-item dan data-description)
        const nameItem = selectedOption.getAttribute('data-name-item');
        const description = selectedOption.getAttribute('data-description');

        // Update tampilan teks
        nameItemDisplay.innerHTML = nameItem ? `<i class="fa fa-utensils text-success me-2"></i> ${nameItem}` : '-';
        descDisplay.textContent = description ? description : '-';

        // Munculkan box info
        infoDiv.style.display = 'block';
    } else {
        // Sembunyikan jika memilih "-- Pilih Varian --"
        infoDiv.style.display = 'none';
    }
}

function recalcPrice() {
    let addonTotal = 0;
    // Hitung semua addon yang dicentang
    document.querySelectorAll('.addon-check:checked').forEach(cb => {
        addonTotal += parseInt(cb.dataset.price) || 0;
    });

    const qtyInput = document.getElementById('qty');
    const qty = qtyInput ? (parseInt(qtyInput.value) || 1) : 1;

    const pricePerPcs = basePrice + addonTotal;

    // Update tampilan harga di UI
    const displayPrice = document.getElementById('display-price');
    const displayTotalPorsi = document.getElementById('total-per-porsi');

    if(displayPrice) displayPrice.textContent = 'Rp ' + pricePerPcs.toLocaleString('id-ID');
    if(displayTotalPorsi) displayTotalPorsi.textContent = 'Rp ' + pricePerPcs.toLocaleString('id-ID');
}

// Listener untuk input quantity agar harga update otomatis saat angka diketik
document.getElementById('qty')?.addEventListener('input', recalcPrice);
</script>
<script>
function updateVariantInfo() {
    const select = document.getElementById('variant-select');
    const infoDiv = document.getElementById('variant-info');
    const nameItemDisplay = document.getElementById('variant-name-item');

    if (!select || !infoDiv) return;

    const selectedOption = select.options[select.selectedIndex];

    if (selectedOption && selectedOption.value !== "") {
        const nameItem = selectedOption.getAttribute('data-name-item');

        // Langsung tampilkan isi menunya saja
        nameItemDisplay.textContent = nameItem ? nameItem : '-';

        infoDiv.style.display = 'block';
    } else {
        infoDiv.style.display = 'none';
    }
}

// Panggil fungsi saat halaman selesai dimuat
document.addEventListener('DOMContentLoaded', updateVariantInfo);
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const input = document.getElementById('qty');
    const btnPlus = document.getElementById('btn-plus');
    const btnMinus = document.getElementById('btn-minus');

    if (!input || !btnPlus || !btnMinus) {
        console.log("Element qty/button tidak ditemukan");
        return;
    }

    const min = parseInt(input.min) || 1;
    const max = parseInt(input.max) || 9999;

    btnPlus.addEventListener('click', function () {
        let val = parseInt(input.value) || min;
        if (val < max) {
            input.value = val + 1;
            recalcPrice();
        }
    });

    btnMinus.addEventListener('click', function () {
        let val = parseInt(input.value) || min;
        if (val > min) {
            input.value = val - 1;
            recalcPrice();
        }
    });

});
</script>

@endsection
