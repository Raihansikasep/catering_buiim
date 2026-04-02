@extends('layouts.backend')
@section('content')

<form action="{{ route('admin.menu-items.store') }}" method="POST">
@csrf

<div class="w-full p-6 mx-auto">
  <div class="bg-white shadow-xl rounded-2xl p-6">

    {{-- HEADER --}}
        <div class="p-6 pb-0">
          <div class="flex items-center">
            <h2 class="mb-0">Tambah Menu Item</h2>
            <a href="{{ route('admin.menu-items.index') }}"
               class="ml-auto inline-block px-8 py-2 mb-4 font-bold text-white bg-blue-500 rounded-lg text-xs">
              Kembali
            </a>
          </div>
        </div>

    <div class="mb-4">
      <label class="text-xs font-bold">Menu</label>
      <select name="menu_id" class="w-full border rounded-lg px-3 py-2">
        @foreach($menus as $menu)
          <option value="{{ $menu->id }}">{{ $menu->name }}</option>
        @endforeach
      </select>
    </div>

    <div class="mb-4">
      <label class="text-xs font-bold">Nama Item</label>
      <input type="text" name="name" class="w-full border rounded-lg px-3 py-2">
    </div>

    <div class="mb-4">
      <label class="text-xs font-bold">Quantity</label>
      <input type="number" name="quantity" class="w-full border rounded-lg px-3 py-2">
    </div>

    <button class="px-6 py-2 text-xs font-bold text-white bg-blue-500 rounded-lg">
      Simpan
    </button>

  </div>
</div>

</form>
@endsection
