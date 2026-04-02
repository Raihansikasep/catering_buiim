@extends('layouts.backend')

@section('content')
<form action="{{ route('admin.menus.store') }}" method="POST" enctype="multipart/form-data">
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

            {{-- NAMA MENU --}}
            <div class="w-full px-3 md:w-6/12">
              <label class="block mb-2 text-xs font-bold">Nama Menu</label>
              <input type="text" name="name"
                     class="w-full px-3 py-2 border rounded-lg"
                     required>
            </div>

            {{-- KATEGORI --}}
            <div class="w-full px-3 md:w-6/12">
              <label class="block mb-2 text-xs font-bold">Kategori</label>
              <select name="category_id"
                      class="w-full px-3 py-2 border rounded-lg"
                      required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $category)
                  <option value="{{ $category->id }}">
                    {{ $category->name }}
                  </option>
                @endforeach
              </select>
            </div>

            {{-- PRICE --}}
            <div class="w-full px-3 md:w-6/12 mt-4">
              <label class="block mb-2 text-xs font-bold">Harga</label>
              <input type="number" step="0.01" name="price" class="w-full px-3 py-2 border rounded-lg" required>
            </div>

            {{-- GAMBAR --}}
            <div class="w-full px-3 md:w-6/12 mt-4">
              <label class="block mb-2 text-xs font-bold">Gambar</label>
              <input type="file" name="image"
                     class="w-full px-3 py-2 border rounded-lg">
            </div>

            <div class="w-full px-3 md:w-6/12 mt-4">
            <label class="block mb-2 text-xs font-bold">Min Order</label>
            <input type="number" name="min_order" min="1"
                    class="w-full px-3 py-2 border rounded-lg" required>
            </div>

            <div class="w-full px-3 md:w-6/12 mt-4">
            <label class="block mb-2 text-xs font-bold">Max Order</label>
            <input type="number" name="max_order" min="1"
                    class="w-full px-3 py-2 border rounded-lg" required>
            </div>

            {{-- DESKRIPSI --}}
            <div class="w-full px-3 mt-4">
              <label class="block mb-2 text-xs font-bold">Deskripsi</label>
              <textarea name="description"
          class="w-full px-3 py-2 border rounded-lg"
          rows="6"></textarea>
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
