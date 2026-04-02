@extends('layouts.backend')

@section('content')
<div class="flex flex-wrap -mx-3">
  <div class="flex-none w-full max-w-full px-3">
    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white shadow-xl rounded-2xl">

      {{-- HEADER --}}
      <div class="p-6 pb-0 mb-4 flex justify-between items-center">
        <h6 class="text-lg font-semibold">Menu Table</h6>

        <a href="{{ route('admin.menus.create') }}"
           class="bg-gradient-to-tl from-emerald-500 to-teal-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
          + Tambah Category
        </a>
      </div>

      {{-- TABLE --}}
    <div class="flex-auto px-0 pt-0 pb-2">
    <div class="p-0 overflow-x-auto">
    <table class="items-center w-full mb-0 align-top border-collapse text-slate-600">

      <thead class="bg-gray-50">
        <tr>
          <th class="px-6 py-3 text-left text-xs font-bold uppercase">No</th>
          <th class="px-6 py-3 text-left text-xs font-bold uppercase">Nama Menu</th>
          <th class="px-6 py-3 text-left text-xs font-bold uppercase">Kategori</th>
          <th class="px-6 py-3 text-center text-xs font-bold uppercase">Price</th>
          <th class="px-6 py-3 text-left text-xs font-bold uppercase">Min</th>
          <th class="px-6 py-3 text-left text-xs font-bold uppercase">Max</th>
          <th class="px-6 py-3 text-left text-xs font-bold uppercase">Deskripsi</th>
          <th class="px-6 py-3 text-center text-xs font-bold uppercase">Gambar</th>
          <th class="px-6 py-3 text-center text-xs font-bold uppercase">Aksi</th>
        </tr>
      </thead>

      <tbody>
        @forelse ($menus as $menu)
        <tr class="border-b">
          <td class="px-6 py-3">{{ $loop->iteration }}</td>

          <td class="px-6 py-3 font-medium">
            {{ $menu->name }}
          </td>

          <td class="px-6 py-3 text-sm">
            {{ $menu->category->name ?? '-' }}
          </td>

          <td class="px-6 py-3 text-center text-sm">
            Rp {{ number_format($menu->price, 0, ',', '.') }}
          </td>

          <td>{{ $menu->min_order }}</td>
          <td>{{ $menu->max_order }}</td>

          <td class="px-6 py-3 text-sm">
            {{ Str::limit($menu->description, 50) }}
          </td>

          <td class="px-6 py-3 text-center">
            @if ($menu->image)
              <img src="{{ asset('storage/'.$menu->image) }}"
                   class="mx-auto h-10 w-10 object-cover rounded">
            @else
              <span class="text-gray-400 text-xs">No Image</span>
            @endif
          </td>

          <td class="px-6 py-3 text-center space-x-2">

            {{-- EDIT --}}
            <a href="{{ route('admin.menus.show', $menu->id) }}"
               class="bg-gradient-to-tl from-emerald-500 to-teal-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block font-bold uppercase text-white">
              Show
            </a>
             <a href="{{ route('admin.menus.edit', $menu->id) }}"
               class="bg-gradient-to-tl from-emerald-500 to-teal-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block font-bold uppercase text-white">
              Edit
            </a>

            {{-- DELETE --}}
            <form action="{{ route('admin.menus.destroy', $menu->id) }}"
                  method="POST"
                  class="inline">
              @csrf
              @method('DELETE')
              <button onclick="return confirm('Yakin hapus menu?')"
                      class="bg-gradient-to-tl from-red-600 to-red-600 px-2.5 text-xs rounded-1.8 py-1.4 inline-block font-bold uppercase text-white">
                Delete
              </button>
            </form>

          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="px-6 py-4 text-center text-gray-400">
            Data menu masih kosong
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
