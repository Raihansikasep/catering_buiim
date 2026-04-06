@extends('layouts.backend')

@section('content')
<div class="flex flex-wrap -mx-3">
  <div class="flex-none w-full max-w-full px-3">
    <div class="relative flex flex-col min-w-0 mb-6 bg-white shadow-xl rounded-2xl">

      {{-- HEADER --}}
      <div class="p-6 pb-0 mb-4 flex justify-between items-center flex-wrap gap-3">
        <div>
          <h6 class="text-lg font-semibold">Order Table</h6>
          @if(isset($pendingPayments) && $pendingPayments > 0)
          <span style="background:#fffbeb;color:#b45309;border:1px solid #fde68a;border-radius:20px;font-size:0.72rem;font-weight:700;padding:3px 10px;">
            {{ $pendingPayments }} menunggu konfirmasi
          </span>
          @endif
        </div>
        <div style="display:flex;gap:8px;flex-wrap:wrap">
          <a href="{{ route('admin.payments.index') }}"
             style="background:linear-gradient(to right,#f59e0b,#d97706);padding:6px 16px;font-size:0.75rem;border-radius:8px;font-weight:700;color:#fff;text-decoration:none">
            Kelola Pembayaran
          </a>
          <a href="{{ route('admin.orders.create') }}"
             class="bg-gradient-to-tl from-emerald-500 to-teal-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block font-bold uppercase text-white">
            + Tambah Order
          </a>
        </div>
      </div>

      {{-- ALERT --}}
      @if(session('success'))
      <div style="margin:0 24px 16px;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:10px;padding:10px 16px;font-size:0.83rem;color:#166534">
        {{ session('success') }}
      </div>
      @endif

      {{-- TABLE --}}
      <div class="flex-auto px-0 pt-0 pb-2">
        <div class="overflow-x-auto">
          <table class="w-full text-sm text-slate-600 border-collapse">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-4 py-3 text-left text-xs font-bold uppercase">No</th>
                <th class="px-4 py-3 text-left text-xs font-bold uppercase">Customer</th>
                <th class="px-4 py-3 text-left text-xs font-bold uppercase">No HP</th>
                <th class="px-4 py-3 text-left text-xs font-bold uppercase">Menu & Addon</th>
                <th class="px-4 py-3 text-center text-xs font-bold uppercase">Qty</th>
                <th class="px-4 py-3 text-left text-xs font-bold uppercase">Tgl Pesanan</th>
                <th class="px-4 py-3 text-left text-xs font-bold uppercase">Tgl Acara</th>
                <th class="px-4 py-3 text-center text-xs font-bold uppercase">Status Order</th>
                <th class="px-4 py-3 text-center text-xs font-bold uppercase">Pembayaran</th>
                <th class="px-4 py-3 text-center text-xs font-bold uppercase">Total</th>
                <th class="px-4 py-3 text-center text-xs font-bold uppercase">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($orders as $order)
              <tr class="border-b hover:bg-gray-50">

                <td class="px-4 py-3 text-xs">{{ $loop->iteration }}</td>

                <td class="px-4 py-3">
                  <div class="font-semibold text-sm">{{ $order->customer_name }}</div>
                  <div class="text-xs text-gray-400">{{ $order->customer_address }}</div>
                </td>

                <td class="px-4 py-3 text-xs text-gray-500">{{ $order->customer_phone }}</td>

                {{-- MENU & ADDON --}}
                <td class="px-4 py-3 text-xs">
                  <div class="font-medium">{{ $order->variant->menu->name ?? '-' }}</div>
                  <div class="text-gray-400 mb-1">{{ $order->variant->name_variant ?? '-' }}</div>
                  @if($order->addons->count())
                  <div>
                    @foreach($order->addons as $oa)
                    <span style="display:inline-block;background:#f0fdf4;color:#166534;border:1px solid #bbf7d0;border-radius:20px;font-size:0.65rem;font-weight:600;padding:1px 7px;margin:1px 1px 0 0;">
                      +{{ $oa->addon->name }} (Rp {{ number_format($oa->price) }})
                    </span>
                    @endforeach
                  </div>
                  @endif
                </td>

                <td class="px-4 py-3 text-center text-sm">{{ $order->quantity }}</td>

                <td class="px-4 py-3 text-xs">
                  {{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}
                </td>

                <td class="px-4 py-3 text-xs">
                  {{ $order->schedule ? \Carbon\Carbon::parse($order->schedule->schedule_date)->format('d M Y') : '-' }}
                </td>

                {{-- Status Order --}}
                <td class="px-4 py-3 text-center">
                  @php
                    $sc = [
                      'menunggu'        => 'background:#fffbeb;color:#b45309;border:1px solid #fde68a',
                      'sudah_bayar'     => 'background:#eff6ff;color:#1d4ed8;border:1px solid #bfdbfe',
                      'sedang_diproses' => 'background:#f0f9ff;color:#0369a1;border:1px solid #bae6fd',
                      'siap_dikirim'    => 'background:#faf5ff;color:#7c3aed;border:1px solid #ddd6fe',
                      'selesai'         => 'background:#f0fdf4;color:#16a34a;border:1px solid #bbf7d0',
                    ];
                    $sl = [
                      'menunggu'        => 'Menunggu',
                      'sudah_bayar'     => 'Sudah Bayar',
                      'sedang_diproses' => 'Diproses',
                      'siap_dikirim'    => 'Siap Kirim',
                      'selesai'         => 'Selesai',
                    ];
                    $ss = $sc[$order->status] ?? 'background:#f1f5f9;color:#475569';
                  @endphp
                  <span style="display:inline-block;padding:3px 10px;border-radius:20px;font-size:0.7rem;font-weight:700;{{ $ss }}">
                    {{ $sl[$order->status] ?? $order->status }}
                  </span>
                </td>

                {{-- Status Pembayaran --}}
                <td class="px-4 py-3 text-center">
                  @if($order->payment)
                    @if($order->payment->isPending())
                      <a href="{{ route('admin.payments.show', $order->payment->id) }}"
                         style="display:inline-block;padding:3px 10px;border-radius:20px;font-size:0.7rem;font-weight:700;background:#fffbeb;color:#b45309;border:1px solid #fde68a;text-decoration:none">
                        Review
                      </a>
                    @elseif($order->payment->isConfirmed())
                      <span style="display:inline-block;padding:3px 10px;border-radius:20px;font-size:0.7rem;font-weight:700;background:#f0fdf4;color:#16a34a;border:1px solid #bbf7d0">
                        Lunas
                      </span>
                    @else
                      <span style="display:inline-block;padding:3px 10px;border-radius:20px;font-size:0.7rem;font-weight:700;background:#fef2f2;color:#dc2626;border:1px solid #fecaca">
                        Ditolak
                      </span>
                    @endif
                  @else
                    <span style="font-size:0.72rem;color:#94a3b8">Belum bayar</span>
                  @endif
                </td>

                {{-- TOTAL --}}
                <td class="px-4 py-3 text-center">
                  <div class="font-semibold text-sm" style="color:#16a34a">
                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                  </div>
                  @if($order->addons->count())
                  <div style="font-size:0.65rem;color:#aaa;">
                    incl. addon
                  </div>
                  @endif
                </td>

                {{-- Aksi --}}
                <td class="px-4 py-3 text-center">
                  <div style="display:flex;gap:4px;justify-content:center;flex-wrap:wrap">
                    <a href="{{ route('admin.orders.show', $order->id) }}"
                       class="bg-gradient-to-tl from-blue-500 to-indigo-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block font-bold uppercase text-white">
                      Lihat
                    </a>
                    <a href="{{ route('admin.orders.edit', $order->id) }}"
                       class="bg-gradient-to-tl from-emerald-500 to-teal-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block font-bold uppercase text-white">
                      Edit
                    </a>
                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="inline">
                      @csrf @method('DELETE')
                      <button onclick="return confirm('Yakin hapus order ini?')"
                              class="bg-gradient-to-tl from-red-600 to-red-600 px-2.5 text-xs rounded-1.8 py-1.4 inline-block font-bold uppercase text-white">
                        Hapus
                      </button>
                    </form>
                  </div>
                </td>

              </tr>
              @empty
              <tr>
                <td colspan="11" class="px-6 py-10 text-center text-gray-400 text-sm">
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
