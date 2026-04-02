@extends('layouts.backend')
@section('content')

<form action="{{ route('admin.orders.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="w-full p-6 mx-auto">
  <div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 md:w-8/12">
      <div class="relative flex flex-col bg-white shadow-xl rounded-2xl">

        {{-- HEADER --}}
        <div class="p-6 pb-0">
          <div class="flex items-center">
            <h2 class="mb-0">Detail Order</h2>
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
              <select name="menu_variant_id" class="w-full px-3 py-2 border rounded-lg" required>
                <option value="">-- Pilih Variant --</option>
                @foreach($variants as $v)
                  <option value="{{ $v->id }}">
                    {{ $v->menu->name }} - {{ $v->name }} (Rp {{ number_format($v->price) }})
                  </option>
                @endforeach
              </select>
            </div>

            {{-- QTY --}}
            <div class="w-full px-3 md:w-6/12">
              <label class="block mb-2 text-xs font-bold">Quantity</label>
              <input type="number" name="quantity"
                     class="w-full px-3 py-2 border rounded-lg" required>
            </div>

            {{-- CUSTOMER --}}
            <div class="w-full px-3 mt-4 md:w-6/12">
              <label class="block mb-2 text-xs font-bold">Nama Customer</label>
              <input type="text" name="customer_name"
                     class="w-full px-3 py-2 border rounded-lg" required>
            </div>

            <div class="w-full px-3 mt-4 md:w-6/12">
              <label class="block mb-2 text-xs font-bold">No HP</label>
              <input type="text" name="customer_phone"
                     class="w-full px-3 py-2 border rounded-lg" required>
            </div>

            {{-- ALAMAT --}}
            <div class="w-full px-3 mt-4">
              <label class="block mb-2 text-xs font-bold">Alamat</label>
              <textarea name="customer_address"
                        class="w-full px-3 py-2 border rounded-lg"
                        rows="2" required></textarea>
            </div>

            {{-- TANGGAL --}}
            <div class="w-full px-3 mt-4 md:w-6/12">
              <label class="block mb-2 text-xs font-bold">Tanggal Order</label>
              <input type="date" name="order_date"
                     class="w-full px-3 py-2 border rounded-lg" required>
            </div>

            <div class="w-full px-3 mt-4 md:w-6/12">
              <label class="block mb-2 text-xs font-bold">Tanggal Jadwal</label>
              <input type="date" name="schedule_date"
                     class="w-full px-3 py-2 border rounded-lg" required>
            </div>

            {{-- STATUS --}}
            <div class="w-full px-3 mt-4 md:w-6/12">
              <label class="block mb-2 text-xs font-bold">Status</label>
              <select name="status" class="w-full px-3 py-2 border rounded-lg">
                <option value="menunggu">Menunggu</option>
                <option value="diproses">Diproses</option>
                <option value="selesai">Selesai</option>
              </select>
            </div>

            {{-- BUKTI --}}
            <div class="w-full px-3 mt-4 md:w-6/12">
              <label class="block mb-2 text-xs font-bold">Bukti Pembayaran</label>
              <input type="file" name="payment_proof"
                     class="w-full px-3 py-2 border rounded-lg">
            </div>

            {{-- CATATAN --}}
            <div class="w-full px-3 mt-4">
              <label class="block mb-2 text-xs font-bold">Catatan</label>
              <textarea name="notes"
                        class="w-full px-3 py-2 border rounded-lg"
                        rows="2"></textarea>
            </div>

            {{-- BUTTON --}}
            <div class="w-full px-3 mt-6">
              <button type="submit"
                      class="px-8 py-2 text-xs font-bold text-white bg-blue-500 rounded-lg">
                Simpan
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
