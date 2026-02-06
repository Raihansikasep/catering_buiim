@extends('layouts.backend')
@section('content')

<div class="w-full p-6 mx-auto">
  <div class="w-full max-w-full px-3 md:w-8/12">
    <div class="relative flex flex-col bg-white shadow-xl rounded-2xl">

      {{-- HEADER --}}
      <div class="p-6 pb-0">
        <div class="flex items-center">
          <h2 class="mb-0">Detail Order Schedule</h2>
          <a href="{{ route('order-schedules.index') }}"
             class="ml-auto px-8 py-2 text-xs font-bold text-white bg-blue-500 rounded-lg">
            Kembali
          </a>
        </div>
      </div>

      {{-- BODY --}}
      <div class="p-6">
        <div class="grid grid-cols-2 gap-4">

          {{-- CUSTOMER --}}
          <div>
            <label class="block text-xs font-bold mb-1">Customer</label>
            <div class="p-2 border rounded-lg bg-gray-50">
              {{ $orderSchedule->order->customer_name ?? '-' }}
            </div>
          </div>

          {{-- MENU --}}
          <div>
            <label class="block text-xs font-bold mb-1">Menu</label>
            <div class="p-2 border rounded-lg bg-gray-50">
              {{ $orderSchedule->order->variant->menu->name ?? '-' }}
              ({{ $orderSchedule->order->variant->name ?? '-' }})
            </div>
          </div>

          {{-- TANGGAL ACARA --}}
          <div>
            <label class="block text-xs font-bold mb-1">Tanggal Acara</label>
            <div class="p-2 border rounded-lg bg-gray-50">
              {{ \Carbon\Carbon::parse($orderSchedule->schedule_date)->format('d M Y') }}
            </div>
          </div>

          {{-- STATUS --}}
          <div>
            <label class="block text-xs font-bold mb-1">Status</label>
            <div class="p-2 border rounded-lg bg-gray-50">
              {{ ucfirst(str_replace('_',' ',$orderSchedule->status)) }}
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>

@endsection
