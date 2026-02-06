@extends('layouts.backend')

@section('content')
<div class="flex flex-wrap -mx-3">
  <div class="flex-none w-full max-w-full px-3">
    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white shadow-xl rounded-2xl">

      {{-- HEADER --}}
      <div class="p-6 pb-0 mb-4 flex justify-between items-center">
        <h6 class="text-lg font-semibold">Menu Variant Table</h6>

        <a href="{{ route('menu-variants.create') }}"
           class="bg-gradient-to-tl from-emerald-500 to-teal-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block font-bold uppercase text-white">
          + Tambah Variant
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
                <th class="px-6 py-3 text-left text-xs font-bold uppercase">Nama Variant</th>
                <th class="px-6 py-3 text-center text-xs font-bold uppercase">Price</th>
                <th class="px-6 py-3 text-center text-xs font-bold uppercase">Portion</th>
                <th class="px-6 py-3 text-center text-xs font-bold uppercase">Aksi</th>
              </tr>
            </thead>

            <tbody>
              @forelse ($variants as $variant)
              <tr class="border-b">
                <td class="px-6 py-3">{{ $loop->iteration }}</td>

                <td class="px-6 py-3 font-medium">
                  {{ $variant->menu->name ?? '-' }}
                </td>

                <td class="px-6 py-3 text-sm">
                  {{ $variant->name }}
                </td>

                <td class="px-6 py-3 text-center text-sm">
                  Rp {{ number_format($variant->price, 0, ',', '.') }}
                </td>

                <td class="px-6 py-3 text-center text-sm">
                  {{ $variant->portion }}
                </td>

                <td class="px-6 py-3 text-center space-x-2">

                  {{-- EDIT --}}
                  <a href="{{ route('menu-variants.edit', $variant->id) }}"
                     class="bg-gradient-to-tl from-emerald-500 to-teal-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block font-bold uppercase text-white">
                    Edit
                  </a>

                  {{-- DELETE --}}
                  <form action="{{ route('menu-variants.destroy', $variant->id) }}"
                        method="POST"
                        class="inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Yakin hapus variant?')"
                            class="bg-gradient-to-tl from-red-600 to-red-600 px-2.5 text-xs rounded-1.8 py-1.4 inline-block font-bold uppercase text-white">
                      Delete
                    </button>
                  </form>

                </td>
              </tr>
              @empty
              <tr>
                <td colspan="6" class="px-6 py-4 text-center text-gray-400">
                  Data menu variant masih kosong
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
