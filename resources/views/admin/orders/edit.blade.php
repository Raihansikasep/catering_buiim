@extends('layouts.backend')
@section('content')

<form action="{{ route('admin.orders.update', $order->id) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="w-full p-6 mx-auto">
  <div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 md:w-8/12">
      <div class="relative flex flex-col bg-white shadow-xl rounded-2xl">

        {{-- HEADER --}}
        <div class="p-6 pb-0">
          <div class="flex items-center">
            <h2 class="mb-0">Edit Order</h2>
            <a href="{{ route('admin.orders.index') }}"
               class="ml-auto px-8 py-2 text-xs font-bold text-white bg-blue-500 rounded-lg">
              Kembali
            </a>
          </div>
        </div>

        {{-- BODY --}}
        <div class="p-6">
          <div class="flex flex-wrap -mx-3">

            {{-- MENU VARIANT --}}
            <div class="w-full px-3 md:w-6/12">
              <label class="block mb-2 text-xs font-bold">Menu Variant</label>
              <select name="menu_variant_id" class="w-full px-3 py-2 border rounded-lg">
                @foreach($variants as $v)
                  <option value="{{ $v->id }}"
                    {{ $order->menu_variant_id == $v->id ? 'selected' : '' }}>
                    {{-- ✅ GANTI $v->name → $v->name_variant & $v->name_item --}}
                    {{ $v->menu->name }} - {{ $v->name_variant }} ({{ $v->name_item }})
                  </option>
                @endforeach
              </select>
            </div>

            {{-- QTY --}}
            <div class="w-full px-3 md:w-6/12">
              <label class="block mb-2 text-xs font-bold">Quantity</label>
              <input type="number" name="quantity"
                     value="{{ $order->quantity }}"
                     min="1"
                     class="w-full px-3 py-2 border rounded-lg">
            </div>

            {{-- CUSTOMER --}}
            <div class="w-full px-3 mt-4 md:w-6/12">
              <label class="block mb-2 text-xs font-bold">Nama Customer</label>
              <input type="text" name="customer_name"
                     value="{{ $order->customer_name }}"
                     class="w-full px-3 py-2 border rounded-lg">
            </div>

            <div class="w-full px-3 mt-4 md:w-6/12">
              <label class="block mb-2 text-xs font-bold">No HP</label>
              <input type="text" name="customer_phone"
                     value="{{ $order->customer_phone }}"
                     class="w-full px-3 py-2 border rounded-lg">
            </div>

            {{-- ALAMAT --}}
            <div class="w-full px-3 mt-4">
              <label class="block mb-2 text-xs font-bold">Alamat</label>
              <textarea name="customer_address"
                        class="w-full px-3 py-2 border rounded-lg"
                        rows="2">{{ $order->customer_address }}</textarea>
            </div>

            {{-- TANGGAL --}}
            <div class="w-full px-3 mt-4 md:w-6/12">
              <label class="block mb-2 text-xs font-bold">Tanggal Order</label>
              <input type="date" name="order_date"
                     value="{{ $order->order_date }}"
                     class="w-full px-3 py-2 border rounded-lg">
            </div>

            <div class="w-full px-3 mt-4 md:w-6/12">
              <label class="block mb-2 text-xs font-bold">Tanggal Jadwal</label>
              <input type="date" name="schedule_date"
                     value="{{ optional($order->schedule)->schedule_date }}"
                     class="w-full px-3 py-2 border rounded-lg">
            </div>

            {{-- STATUS ORDER --}}
            <div class="w-full px-3 mt-4 md:w-6/12">
              <label class="block mb-2 text-xs font-bold">Status Order</label>
              {{-- ✅ SESUAIKAN DENGAN ENUM DI MIGRATION --}}
              <select name="status" class="w-full px-3 py-2 border rounded-lg">
                <option value="menunggu"
                  {{ $order->status == 'menunggu' ? 'selected' : '' }}>
                  Menunggu
                </option>
                <option value="sudah_bayar"
                  {{ $order->status == 'sudah_bayar' ? 'selected' : '' }}>
                  Sudah Bayar
                </option>
                <option value="sedang_diproses"
                  {{ $order->status == 'sedang_diproses' ? 'selected' : '' }}>
                  Sedang Diproses
                </option>
                <option value="siap_dikirim"
                  {{ $order->status == 'siap_dikirim' ? 'selected' : '' }}>
                  Siap Dikirim
                </option>
                <option value="selesai"
                  {{ $order->status == 'selesai' ? 'selected' : '' }}>
                  Selesai
                </option>
              </select>
            </div>

            {{-- BUKTI PEMBAYARAN --}}
            <div class="w-full px-3 mt-4 md:w-6/12">
              <label class="block mb-2 text-xs font-bold">Bukti Pembayaran</label>
              @if($order->payment_proof)
                <div class="mb-2">
                  <img src="{{ asset('storage/' . $order->payment_proof) }}"
                       alt="Bukti"
                       class="rounded"
                       style="max-width:120px;">
                  <small class="block text-gray-500 mt-1">Bukti saat ini</small>
                </div>
              @endif
              <input type="file" name="payment_proof"
                     accept="image/*"
                     class="w-full px-3 py-2 border rounded-lg">
              <small class="text-gray-400">Kosongkan jika tidak ingin mengubah</small>
            </div>

            {{-- CATATAN --}}
            <div class="w-full px-3 mt-4">
              <label class="block mb-2 text-xs font-bold">Catatan</label>
              <textarea name="notes"
                        class="w-full px-3 py-2 border rounded-lg"
                        rows="2">{{ $order->notes }}</textarea>
            </div>

            {{-- BUTTON --}}
            <div class="w-full px-3 mt-6">
              <button type="submit"
                      class="px-8 py-2 text-xs font-bold text-white bg-blue-500 rounded-lg">
                Update Order
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
