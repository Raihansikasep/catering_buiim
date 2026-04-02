@extends('layouts.frontend')
@section('content')

<div class="container-xxl py-5">
    <div class="container">

        <h1 class="mb-4">Keranjang Belanja</h1>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(!empty($cart))

            <div class="table-responsive">
                <table class="table table-bordered align-middle">

                    <thead class="table-light text-center">
                        <tr>
                            <th width="50">Pilih</th>
                            <th class="text-start">Produk</th>
                            <th width="130">Harga/Porsi</th>
                            <th width="170">Qty</th>
                            <th width="130">Subtotal</th>
                            <th width="80">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php $grandTotal = 0; @endphp

                        @foreach($cart as $id => $item)
                            @php
                                $subtotal = $item['price'] * $item['qty'];
                                if ($item['selected']) $grandTotal += $subtotal;
                            @endphp

                            <tr id="row-{{ $id }}">

                                {{-- CHECKBOX --}}
                                <td class="text-center">
                                    <input type="checkbox"
                                           class="form-check-input"
                                           onchange="toggleItem('{{ $id }}')"
                                           {{ $item['selected'] ? 'checked' : '' }}>
                                </td>

                                {{-- PRODUK --}}
                                <td>
                                    <div class="d-flex align-items-start gap-3">
                                        <img src="{{ asset('storage/' . $item['image']) }}"
                                             width="70" height="70"
                                             class="rounded flex-shrink-0"
                                             style="object-fit:cover;"
                                             alt="{{ $item['name'] }}">

                                        <div>
                                            <div class="fw-semibold">{{ $item['name'] }}</div>

                                            {{-- Tampilkan addon jika ada --}}
                                            @if(!empty($item['addons']))
                                                <div class="mt-1">
                                                    @foreach($item['addons'] as $addon)
                                                        <span class="badge bg-light text-dark border me-1 mb-1">
                                                            + {{ $addon['name'] }}
                                                            <span class="text-success">
                                                                (Rp {{ number_format($addon['price']) }})
                                                            </span>
                                                        </span>
                                                    @endforeach
                                                </div>

                                                {{-- Breakdown harga --}}
                                                <small class="text-muted">
                                                    Rp {{ number_format($item['base_price']) }} + addon
                                                    Rp {{ number_format($item['addon_price']) }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                {{-- HARGA PER PORSI --}}
                                <td class="text-center">
                                    Rp {{ number_format($item['price']) }}
                                </td>

                                {{-- QTY --}}
                                <td class="text-center">
                                    <div class="d-flex justify-content-center align-items-center gap-1">
                                        <button type="button"
                                                class="btn btn-sm btn-outline-secondary"
                                                onclick="changeQty('{{ $id }}', -1)">−</button>

                                        <input type="number"
                                               id="qty-{{ $id }}"
                                               value="{{ $item['qty'] }}"
                                               min="1"
                                               class="form-control form-control-sm text-center"
                                               style="width:60px;"
                                               readonly>

                                        <button type="button"
                                                class="btn btn-sm btn-outline-secondary"
                                                onclick="changeQty('{{ $id }}', 1)">+</button>
                                    </div>
                                </td>

                                {{-- SUBTOTAL --}}
                                <td class="text-center" id="subtotal-{{ $id }}">
                                    Rp {{ number_format($subtotal) }}
                                </td>

                                {{-- HAPUS --}}
                                <td class="text-center">
                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $id }}">
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                    <tfoot class="table-light">
                        <tr>
                            <th colspan="4" class="text-end pe-3">Grand Total</th>
                            <th colspan="2" id="grand-total" class="text-center fs-5 text-success">
                                Rp {{ number_format($grandTotal) }}
                            </th>
                        </tr>
                    </tfoot>

                </table>
            </div>

            <div class="text-end mt-3">
                <a href="{{ route('product') }}" class="btn btn-outline-secondary me-2">
                    ← Lanjut Belanja
                </a>
                <a href="{{ route('checkout') }}" class="btn btn-success px-5">
                    Checkout →
                </a>
            </div>

        @else

            <div class="text-center py-5">
                <i class="fa fa-shopping-cart fa-3x text-muted mb-3"></i>
                <h4>Keranjang masih kosong</h4>
                <p class="text-muted">Yuk tambahkan produk favoritmu!</p>
                <a href="{{ route('product') }}" class="btn btn-success mt-2">
                    Belanja Sekarang
                </a>
            </div>

        @endif

    </div>
</div>

<script>
// Harga per porsi tiap item (sudah include addon)
const cartPrices = @json(collect($cart ?? [])->map(fn($i) => $i['price']));

function changeQty(id, change) {
    const input = document.getElementById('qty-' + id);
    let qty     = parseInt(input.value) + change;
    if (qty < 1) qty = 1;
    input.value = qty;
    updateCart(id, qty);
}

function updateCart(id, qty) {
    fetch("{{ route('cart.update.ajax') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ id, qty })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            const price    = cartPrices[id] ?? 0;
            const subtotal = price * qty;

            document.getElementById('subtotal-' + id).textContent =
                'Rp ' + subtotal.toLocaleString('id-ID');

            recalcGrandTotal();
        }
    });
}

function toggleItem(id) {
    fetch("{{ route('cart.toggle') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ id })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) recalcGrandTotal();
    });
}

function recalcGrandTotal() {
    let total = 0;

    document.querySelectorAll('input[type=checkbox]').forEach(cb => {
        if (cb.checked) {
            const rowId = cb.closest('tr').id.replace('row-', '');
            const qty   = parseInt(document.getElementById('qty-' + rowId).value);
            const price = cartPrices[rowId] ?? 0;
            total      += price * qty;
        }
    });

    document.getElementById('grand-total').textContent =
        'Rp ' + total.toLocaleString('id-ID');
}
</script>

@endsection
