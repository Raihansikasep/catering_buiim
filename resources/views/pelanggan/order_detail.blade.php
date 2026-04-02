@extends('layouts.frontend')
@section('content')

<div class="container py-5">

    <h2 class="mb-4">📄 Detail Pesanan</h2>

    <div class="card shadow-sm p-4">

        <h4>{{ $order->variant->menu->name }}</h4>

        <p class="text-muted">
            {{ $order->variant->menu->description }}
        </p>

        <hr>

        <p><strong>Nama:</strong> {{ $order->customer_name }}</p>
        <p><strong>No HP:</strong> {{ $order->customer_phone }}</p>
        <p><strong>Alamat:</strong> {{ $order->customer_address }}</p>

        <hr>

        <p><strong>Jumlah:</strong> {{ $order->quantity }}</p>
        <p><strong>Total:</strong> Rp {{ number_format($order->total_price) }}</p>

        <p><strong>Status:</strong> 
            <span class="badge bg-success">
                {{ $order->status }}
            </span>
        </p>

        <p><strong>Tanggal Kirim:</strong> 
            {{ $order->schedule->schedule_date ?? '-' }}
        </p>

        <a href="{{ route('my.orders') }}" class="btn btn-secondary mt-3">
            ← Kembali
        </a>

    </div>

</div>

@endsection