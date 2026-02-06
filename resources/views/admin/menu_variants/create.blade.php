@extends('layouts.backend')

@section('content')
<form action="{{ route('menu-variants.store') }}" method="POST">
@csrf

<div class="w-full p-6 mx-auto">
  <div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 md:w-8/12">
      <div class="relative flex flex-col bg-white shadow-xl rounded-2xl">

        {{-- HEADER --}}
        <div class="p-6 pb-0 border-b">
          <div class="flex items-center">
            <h2 class="mb-0">Tambah Menu Variant</h2>
            <a href="{{ route('menu-variants.index') }}"
               class="ml-auto px-8 py-2 text-xs font-bold text-white bg-blue-500 rounded-lg">
              Kembali
            </a>
          </div>
        </div>

        {{-- BODY --}}
        <div class="p-6">
          <div class="flex flex-wrap -mx-3">

            {{-- MENU --}}
            <div class="w-full px-3 md:w-6/12">
              <label class="block mb-2 text-xs font-bold">Menu</label>
              <select name="menu_id" class="w-full px-3 py-2 border rounded-lg" required>
                  <option value="">-- Pilih Menu --</option>
                  @foreach($menus as $menu)
                      <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                  @endforeach
              </select>
            </div>

            {{-- NAMA VARIANT --}}
            <div class="w-full px-3 md:w-6/12">
              <label class="block mb-2 text-xs font-bold">Nama Variant</label>
              <input type="text" name="name" class="w-full px-3 py-2 border rounded-lg" required>
            </div>

            {{-- PRICE --}}
            <div class="w-full px-3 md:w-6/12 mt-4">
              <label class="block mb-2 text-xs font-bold">Price</label>
              <input type="number" step="0.01" name="price" class="w-full px-3 py-2 border rounded-lg" required>
            </div>

            {{-- PORTION --}}
            <div class="w-full px-3 md:w-6/12 mt-4">
              <label class="block mb-2 text-xs font-bold">Portion</label>
              <input type="text" name="portion" class="w-full px-3 py-2 border rounded-lg" required>
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
