@extends('layouts.backend')
@section('content')

<div class="w-full p-6 mx-auto">
  <div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 md:w-8/12">
      <div class="relative flex flex-col bg-white shadow-xl rounded-2xl">

        {{-- HEADER --}}
        <div class="p-6 pb-0">
          <div class="flex items-center">
            <h2 class="mb-0">Detail Menu</h2>
            <a href="{{ route('menus.index') }}"
               class="ml-auto px-8 py-2 text-xs font-bold text-white bg-blue-500 rounded-lg">
              Kembali
            </a>
          </div>
        </div>

        {{-- BODY --}}
        <div class="p-6">
          <div class="grid grid-cols-2 gap-4">

            {{-- NAMA --}}
            <div>
              <label class="block text-xs font-bold mb-1">Nama Menu</label>
              <div class="p-2 border rounded-lg bg-gray-50">
                {{ $menu->name }}
              </div>
            </div>

            {{-- KATEGORI --}}
            <div>
              <label class="block text-xs font-bold mb-1">Kategori</label>
              <div class="p-2 border rounded-lg bg-gray-50">
                {{ $menu->category->name ?? '-' }}
              </div>
            </div>

            {{-- DESKRIPSI --}}
            <div class="col-span-2">
              <label class="block text-xs font-bold mb-1">Deskripsi</label>
              <div class="p-2 border rounded-lg bg-gray-50">
                {{ $menu->description ?? '-' }}
              </div>
            </div>

            {{-- GAMBAR --}}
            <div class="col-span-2">
              <label class="block text-xs font-bold mb-1">Gambar</label>
              @if ($menu->image)
                <div class="overflow-hidden">
                <img src="{{ asset('storage/'.$menu->image) }}"
                class="max-w-full h-auto rounded border">
                </div>
              @else
                <span class="text-gray-400 text-sm">Tidak ada gambar</span>
              @endif
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
</div>

@endsection
