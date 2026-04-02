@extends('layouts.frontend')
@section('content')

<div class="container py-5">
    <h2 class="mb-4">📦 Pesanan Saya</h2>

    @if($orders->count())

    <div class="table-responsive">
        <table class="table table-bordered text-center">

            <thead class="table-light">
                <tr>
                    <th>Produk</th>
                    <th>Tanggal</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->variant->menu->name }}</td>
                    <td>{{ $order->order_date }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>Rp {{ number_format($order->total_price) }}</td>

                    <td>
                        <span class="badge bg-warning">
                            {{ $order->status }}
                        </span>
                    </td>

                    <td>
                        <a href="{{ route('my.orders.detail', $order->id) }}"
                           class="btn btn-sm btn-primary">
                           Detail
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    @else
        <div class="text-center py-5">
            <h4>Belum ada pesanan 😢</h4>
        </div>
    @endif

</div>

@endsection
