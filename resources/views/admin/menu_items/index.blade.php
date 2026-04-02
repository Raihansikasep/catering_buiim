@extends('layouts.backend')

@section('content')
<div class="flex flex-wrap -mx-3">
  <div class="flex-none w-full max-w-full px-3">
    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white shadow-xl rounded-2xl">

      {{-- HEADER --}}
      <div class="p-6 pb-0 mb-4 flex justify-between items-center">
        <h6 class="text-lg font-semibold">Menu Item Table</h6>

        <a href="{{ route('admin.menu-items.create') }}"
           class="bg-gradient-to-tl from-emerald-500 to-teal-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
          + Tambah Menu Item
        </a>
      </div>

      {{-- TABLE --}}
      <div class="flex-auto px-0 pt-0 pb-2">
        <div class="p-0 overflow-x-auto">
          <table class="items-center w-full mb-0 align-top border-collapse text-slate-600">

            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-bold uppercase">No</th>
                <th class="px-6 py-3 text-left text-xs font-bold uppercase">Menu</th>
                <th class="px-6 py-3 text-left text-xs font-bold uppercase">Nama Item</th>
                <th class="px-6 py-3 text-center text-xs font-bold uppercase">Qty</th>
                <th class="px-6 py-3 text-center text-xs font-bold uppercase">Aksi</th>
              </tr>
            </thead>

            <tbody>
              @forelse ($items as $item)
              <tr class="border-b">
                <td class="px-6 py-3">{{ $loop->iteration }}</td>

                <td class="px-6 py-3 font-medium">
                  {{ $item->menu->name ?? '-' }}
                </td>

                <td class="px-6 py-3 text-sm">
                  {{ $item->name }}
                </td>

                <td class="px-6 py-3 text-center text-sm">
                  {{ $item->quantity }}
                </td>

                <td class="px-6 py-3 text-center space-x-2">

                  {{-- EDIT --}}
                  <a href="{{ route('admin.menu-items.edit', $item->id) }}"
                     class="bg-gradient-to-tl from-emerald-500 to-teal-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block font-bold uppercase text-white">
                    Edit
                  </a>

                  {{-- DELETE --}}
                  <form action="{{ route('admin.menu-items.destroy', $item->id) }}"
                        method="POST"
                        class="inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Yakin hapus menu item?')"
                            class="bg-gradient-to-tl from-red-600 to-red-600 px-2.5 text-xs rounded-1.8 py-1.4 inline-block font-bold uppercase text-white">
                      Delete
                    </button>
                  </form>

                </td>
              </tr>
              @empty
              <tr>
                <td colspan="5" class="px-6 py-4 text-center text-gray-400">
                  Data menu item masih kosong
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
