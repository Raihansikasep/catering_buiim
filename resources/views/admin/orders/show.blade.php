@extends('layouts.backend')

@section('content')
<div class="w-full p-6 mx-auto">
  <div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 md:w-8/12">
      <div class="relative flex flex-col bg-white shadow-xl rounded-2xl">

        {{-- HEADER --}}
        <div class="p-6 pb-0">
          <div class="flex items-center">
            <h2 class="mb-0">Detail Order</h2>
            <a href="{{ route('orders.index') }}"
               class="ml-auto px-8 py-2 text-xs font-bold text-white bg-blue-500 rounded-lg">
              Kembali
            </a>
          </div>
        </div>

        {{-- BODY --}}
        <div class="p-6">
          <div class="grid grid-cols-2 gap-4">

            {{-- CUSTOMER NAME --}}
            <div>
              <label class="block text-xs font-bold mb-1">Customer</label>
              <div class="p-2 border rounded-lg bg-gray-50">
                {{ $order->customer_name }}
              </div>
            </div>

            {{-- CUSTOMER PHONE --}}
            <div>
              <label class="block text-xs font-bold mb-1">No Handphone</label>
              <div class="p-2 border rounded-lg bg-gray-50">
                {{ $order->customer_phone }}
              </div>
            </div>

            {{-- CUSTOMER ADDRESS --}}
            <div class="col-span-2">
              <label class="block text-xs font-bold mb-1">Alamat</label>
              <div class="p-2 border rounded-lg bg-gray-50">
                {{ $order->customer_address }}
              </div>
            </div>

            {{-- MENU --}}
            <div>
              <label class="block text-xs font-bold mb-1">Menu</label>
              <div class="p-2 border rounded-lg bg-gray-50">
                {{ $order->variant->menu->name ?? '-' }}
              </div>
            </div>

            {{-- VARIANT --}}
            <div>
              <label class="block text-xs font-bold mb-1">Variant</label>
              <div class="p-2 border rounded-lg bg-gray-50">
                {{ $order->variant->name ?? '-' }}
              </div>
            </div>

            {{-- QUANTITY --}}
            <div>
              <label class="block text-xs font-bold mb-1">Quantity</label>
              <div class="p-2 border rounded-lg bg-gray-50">
                {{ $order->quantity }}
              </div>
            </div>

            {{-- STATUS --}}
            <div>
              <label class="block text-xs font-bold mb-1">Status</label>
              <div class="p-2 border rounded-lg bg-gray-50">
                {{ $order->status }}
              </div>
            </div>

            {{-- ORDER DATE --}}
            <div>
              <label class="block text-xs font-bold mb-1">Tanggal Pesanan</label>
              <div class="p-2 border rounded-lg bg-gray-50">
                {{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}
              </div>
            </div>

            {{-- SCHEDULE DATE --}}
            <div>
              <label class="block text-xs font-bold mb-1">Tanggal Acara</label>
              <div class="p-2 border rounded-lg bg-gray-50">
                {{ $order->schedule
                    ? \Carbon\Carbon::parse($order->schedule->schedule_date)->format('d M Y')
                    : '-' }}
              </div>
            </div>

            {{-- TOTAL PRICE --}}
            <div>
              <label class="block text-xs font-bold mb-1">Total</label>
              <div class="p-2 border rounded-lg bg-gray-50">
                Rp {{ number_format($order->total_price,0,',','.') }}
              </div>
            </div>

            {{-- NOTES --}}
            <div class="col-span-2">
              <label class="block text-xs font-bold mb-1">Catatan</label>
              <div class="p-2 border rounded-lg bg-gray-50">
                {{ $order->notes ?? '-' }}
              </div>
            </div>

            {{-- PAYMENT PROOF --}}
            <div class="col-span-2">
              <label class="block text-xs font-bold mb-1">Bukti Pembayaran</label>
              <div class="p-2 border rounded-lg bg-gray-50">
                @if ($order->payment_proof)
                  <a href="{{ asset('storage/'.$order->payment_proof) }}" target="_blank"
                     class="bg-gradient-to-tl from-emerald-500 to-teal-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block font-bold uppercase text-white">
                    Lihat
                  </a>
                @else
                  <span class="text-gray-400 text-sm">Tidak ada bukti pembayaran</span>
                @endif
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection
