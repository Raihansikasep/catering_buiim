@extends('layouts.frontend')
@section('content')

<div class="container-xxl py-5">
    <div class="container">

        <div class="row g-5">

            {{-- FORM --}}
            <div class="col-lg-7">

                <div class="card border-0 shadow-sm p-4">
                    <h4 class="mb-4">Data Pemesan</h4>

                    <form action="{{ route('checkout.process') }}" method="POST">
                        @csrf

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="customer_name"
                                value="{{ $user->name }}" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">No HP</label>
                                <input type="text" name="customer_phone"
                                       value="{{ $user->phone }}" class="form-control" required>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Alamat Lengkap</label>
                                <textarea name="customer_address" class="form-control">{{ $user->address }}</textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Acara</label>
                                <input type="date" name="schedule_date" id="schedule_date" class="form-control" required>
                                <small class="text-muted d-block mt-2" id="estimasiText"></small>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Catatan (Opsional)</label>
                                <textarea name="notes" class="form-control" rows="2"></textarea>
                            </div>

                        </div>

                        <button class="btn btn-success w-100 py-3 mt-3">
                            Proses Checkout
                        </button>

                    </form>
                </div>

            </div>

            {{-- SUMMARY --}}
            <div class="col-lg-5">

                <div class="card border-0 shadow-sm p-4">
                    <h4 class="mb-4">Ringkasan Pesanan</h4>

                    @php
                        $grandTotal = 0;

                        // 🔥 FILTER ITEM YANG DIPILIH
                        $selectedItems = array_filter($cart, function($item){
                            return isset($item['selected']) && $item['selected'] == true;
                        });
                    @endphp

                    {{-- ❗ kalau tidak ada yang dipilih --}}
                    @if(empty($selectedItems))
                        <div class="text-center py-4">
                            <p class="text-muted">Belum ada item yang dipilih</p>
                        </div>
                    @else

                        @foreach($selectedItems as $item)
                            @php
                                $total = $item['price'] * $item['qty'];
                                $grandTotal += $total;
                            @endphp

                            <div class="d-flex align-items-center mb-3 border-bottom pb-3">

                                <img src="{{ asset('storage/'.$item['image']) }}"
                                     width="70"
                                     class="rounded me-3">

                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $item['name'] }}</h6>
                                    <small class="text-muted">
                                        {{ $item['qty'] }} x Rp {{ number_format($item['price']) }}
                                    </small>
                                </div>

                                <div class="text-end">
                                    <strong>
                                        Rp {{ number_format($total) }}
                                    </strong>
                                </div>

                            </div>
                        @endforeach

                        {{-- TOTAL --}}
                        <div class="d-flex justify-content-between mt-4">
                            <h5>Total</h5>
                            <h5 class="text-primary">
                                Rp {{ number_format($grandTotal) }}
                            </h5>
                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>
</div>

@endsection
