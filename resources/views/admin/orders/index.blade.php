@extends('layouts.backend')

@section('content')
<div class="flex flex-wrap -mx-3">
  <div class="flex-none w-full max-w-full px-3">
    <div class="relative flex flex-col min-w-0 mb-6 bg-white shadow-xl rounded-2xl">

      {{-- HEADER --}}
      <div class="p-6 pb-0 mb-4 flex justify-between items-center">
        <h6 class="text-lg font-semibold">Order Table</h6>

        <a href="{{ route('orders.create') }}"
           class="bg-gradient-to-tl from-emerald-500 to-teal-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block font-bold uppercase text-white">
          + Tambah Variant
        </a>
      </div>


      {{-- TABLE --}}

      <div class="flex-auto px-0 pt-0 pb-2">
        <div class="overflow-x-auto">
          <table class="w-full text-sm text-slate-600 border-collapse">

            <thead class="bg-gray-50">
              <tr>
                <th class="px-4 py-3 text-left text-xs font-bold uppercase">No</th>
                <th class="px-4 py-3 text-left text-xs font-bold uppercase">Customer</th>
                <th class="px-4 py-3 text-left text-xs font-bold uppercase">No Handphone</th>
                <th class="px-4 py-3 text-left text-xs font-bold uppercase">Alamat</th>
                <th class="px-4 py-3 text-left text-xs font-bold uppercase">Menu</th>
                <th class="px-4 py-3 text-center text-xs font-bold uppercase">Qty</th>
                <th class="px-6 py-3 text-left text-xs font-bold uppercase">Tanggal Pesanan</th>
                <th class="px-6 py-3 text-left text-xs font-bold uppercase">Tanggal Acara</th>
                <th class="px-4 py-3 text-center text-xs font-bold uppercase">Status</th>
                <th class="px-4 py-3 text-center text-xs font-bold uppercase">Total</th>
                <th class="px-4 py-3 text-left text-xs font-bold uppercase">Catatan</th>
                <th class="px-4 py-3 text-center text-xs font-bold uppercase">Bukti</th>
                <th class="px-4 py-3 text-center text-xs font-bold uppercase">Aksi</th>
              </tr>
            </thead>

            <tbody>
              @forelse ($orders as $order)
              <tr class="border-b">

                <td class="px-4 py-3">{{ $loop->iteration }}</td>

                {{-- CUSTOMER --}}
                <td class="px-4 py-3">
                  <div class="font-semibold">{{ $order->customer_name }}</div>
                </td>

                {{-- no hp--}}
                <td class="px-4 py-3">
                   <div class="text-xs text-gray-400">{{ $order->customer_phone }}</div>
                </td>

                {{-- ADDRESS --}}
                <td class="px-4 py-3 text-xs">
                  {{ $order->customer_address }}
                </td>

                {{-- MENU --}}
                <td class="px-4 py-3 text-xs">
                  <div class="font-medium">
                    {{ $order->variant->menu->name ?? '-' }}
                  </div>
                  <div class="text-gray-400">
                    {{ $order->variant->name ?? '-' }}
                  </div>
                </td>

                {{-- QTY --}}
                <td class="px-4 py-3 text-center">
                  {{ $order->quantity }}
                </td>

                {{-- tgl pesanan --}}
                <td class="px-6 py-3 text-sm">
                {{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}
                </td>

                {{-- tanggal acara --}}
                <td class="px-6 py-3 text-sm">
                {{ $order->schedule
                        ? \Carbon\Carbon::parse($order->schedule->schedule_date)->format('d M Y')
                        : '-' }}
                </td>

                {{-- STATUS --}}
                <td class="px-4 py-3 text-center text-xs font-bold uppercase">
                  {{ $order->status }}
                </td>

                {{-- TOTAL --}}
                <td class="px-4 py-3 text-center font-semibold">
                  Rp {{ number_format($order->total_price,0,',','.') }}
                </td>

                {{-- NOTES --}}
                <td class="px-4 py-3 text-xs">
                  {{ $order->notes ?? '-' }}
                </td>

                {{-- PAYMENT --}}
                <td class="px-4 py-3 text-center text-xs">
                  @if ($order->payment_proof)
                    <a href="{{ asset('storage/'.$order->payment_proof) }}"
                       target="_blank"
                       class="bg-gradient-to-tl from-emerald-500 to-teal-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block font-bold uppercase text-white">
                      Lihat
                    </a>
                  @else
                    -
                  @endif
                </td>

                {{-- ACTION --}}
                <td class="px-6 py-3 text-center space-x-2">
                  <a href="{{ route('orders.show', $order->id) }}"
                    class="bg-gradient-to-tl from-blue-500 to-indigo-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block font-bold uppercase text-white">
                    Lihat
                  </a>
                  {{-- EDIT --}}
                  <a href="{{ route('orders.edit',$order->id) }}"
                     class="bg-gradient-to-tl from-emerald-500 to-teal-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block font-bold uppercase text-white">
                    Edit
                  </a>

                  {{-- DELETE --}}
                  <form action="{{ route('orders.destroy',$order->id) }}"
                        method="POST"
                        class="inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Yakin hapus variant?')"
                            class="bg-gradient-to-tl from-red-600 to-red-600 px-2.5 text-xs rounded-1.8 py-1.4 inline-block font-bold uppercase text-white">
                      Delete
                    </button>
                  </form>
                </td>

              </tr>
              @empty
              <tr>
                <td colspan="11" class="px-6 py-4 text-center text-gray-400">
                  Data order masih kosong
                </td>
              </tr>
              @endforelse
            </tbody>

          </table>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
