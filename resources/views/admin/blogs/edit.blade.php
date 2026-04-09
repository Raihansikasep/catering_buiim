@extends('layouts.backend')

@section('content')
<div class="flex flex-wrap -mx-3">
  <div class="flex-none w-full max-w-full px-3">
    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white shadow-xl rounded-2xl">

      {{-- HEADER --}}
      <div class="p-6 pb-0 mb-4 flex justify-between items-center">
        <h6 class="text-lg font-semibold">Blog Table</h6>

        <a href="{{ route('admin.blogs.create') }}"
           class="bg-gradient-to-tl from-emerald-500 to-teal-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block font-bold uppercase text-white">
          + Tambah Blog
        </a>
      </div>

      {{-- SUCCESS --}}
      @if(session('success'))
        <div class="mx-6 mb-4 p-3 text-white bg-green-500 rounded">
          {{ session('success') }}
        </div>
      @endif

      {{-- TABLE --}}
      <div class="flex-auto px-0 pt-0 pb-2">
        <div class="p-0 overflow-x-auto">
          <table class="items-center w-full mb-0 align-top border-collapse text-slate-600">

            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-bold uppercase">No</th>
                <th class="px-6 py-3 text-left text-xs font-bold uppercase">Judul</th>
                <th class="px-6 py-3 text-left text-xs font-bold uppercase">Konten</th>
                <th class="px-6 py-3 text-center text-xs font-bold uppercase">Gambar</th>
                <th class="px-6 py-3 text-center text-xs font-bold uppercase">Aksi</th>
              </tr>
            </thead>

            <tbody>
              @forelse ($blog as $blogs)
              <tr class="border-b">
                <td class="px-6 py-3">{{ $loop->iteration }}</td>

                <td class="px-6 py-3 font-medium">
                  {{ $blogs->title }}
                </td>

                <td class="px-6 py-3 text-sm">
                  {{ \Illuminate\Support\Str::limit($blogs->content, 50) }}
                </td>

                <td class="px-6 py-3 text-center">
                  @if ($blogs->image)
                    <img src="{{ asset('storage/'.$blogs->image) }}"
                         class="mx-auto h-10 w-10 object-cover rounded">
                  @else
                    <span class="text-gray-400 text-xs">No Image</span>
                  @endif
                </td>

                <td class="px-6 py-3 text-center space-x-2">

                  {{-- EDIT --}}
                  <a href="{{ route('admin.blogs.edit', $blogs->id) }}"
                     class="bg-gradient-to-tl from-emerald-500 to-teal-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block font-bold uppercase text-white">
                    Edit
                  </a>

                  {{-- DELETE --}}
                  <form action="{{ route('admin.blogs.destroy', $blogs->id) }}"
                        method="POST"
                        class="inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Yakin hapus blog?')"
                            class="bg-gradient-to-tl from-red-600 to-red-600 px-2.5 text-xs rounded-1.8 py-1.4 inline-block font-bold uppercase text-white">
                      Delete
                    </button>
                  </form>

                </td>
              </tr>

              @empty
              <tr>
                <td colspan="5" class="px-6 py-4 text-center text-gray-400">
                  Data blog masih kosong
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
