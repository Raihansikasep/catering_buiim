@extends('layouts.backend')
@section('content')

<form action="{{ route('admin.order-schedules.update', $orderSchedule) }}" method="POST">
@csrf
@method('PUT')

<div class="w-full p-6 mx-auto">
  <div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 md:w-8/12">
      <div class="relative flex flex-col bg-white shadow-xl rounded-2xl">

        {{-- HEADER --}}
        <div class="p-6 pb-0">
          <div class="flex items-center">
            <h2 class="mb-0">Edit Order Schedule</h2>
            <a href="{{ route('admin.order-schedules.index') }}"
               class="ml-auto px-8 py-2 text-xs font-bold text-white bg-blue-500 rounded-lg">
              Kembali
            </a>
          </div>
        </div>

        {{-- BODY --}}
        <div class="p-6">
          <div class="flex flex-wrap -mx-3">

            {{-- ORDER --}}
            <div class="w-full px-3 mb-4">
              <label class="block mb-2 text-xs font-bold">Order</label>
              <select name="order_id" class="w-full px-3 py-2 border rounded-lg" required>
                <option value="">-- Pilih Order --</option>
                @foreach($orders as $order)
                  <option value="{{ $order->id }}"
                    {{ $orderSchedule->order_id == $order->id ? 'selected' : '' }}>
                    {{ $order->customer_name }} - {{ $order->variant->menu->name ?? '-' }}
                    ({{ $order->variant->name ?? '-' }})
                  </option>
                @endforeach
              </select>
            </div>

            {{-- TANGGAL ACARA --}}
            <div class="w-full px-3 mb-4">
              <label class="block mb-2 text-xs font-bold">Tanggal Acara</label>
              <input type="date" name="schedule_date"
                     value="{{ old('schedule_date', $orderSchedule->schedule_date) }}"
                     class="w-full px-3 py-2 border rounded-lg"
                     required>
            </div>

            {{-- STATUS --}}
            <div class="w-full px-3 mb-4">
              <label class="block mb-2 text-xs font-bold">Status</label>
              <select name="status" class="w-full px-3 py-2 border rounded-lg" required>
                @foreach(['belum','sedang_diproses','selesai'] as $status)
                  <option value="{{ $status }}"
                    {{ $orderSchedule->status == $status ? 'selected' : '' }}>
                    {{ ucfirst(str_replace('_',' ',$status)) }}
                  </option>
                @endforeach
              </select>
            </div>

            {{-- BUTTON --}}
            <div class="w-full px-3 mt-6">
              <button type="submit"
                      class="px-8 py-2 text-xs font-bold text-white bg-blue-500 rounded-lg">
                Update
              </button>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
</div>

</form>

@endsection
