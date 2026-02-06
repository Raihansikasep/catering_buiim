@extends('layouts.backend')
@section('content')

<form action="{{ route('menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="w-full p-6 mx-auto">
  <div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 md:w-8/12">
      <div class="relative flex flex-col bg-white shadow-xl rounded-2xl">

        {{-- HEADER --}}
        <div class="p-6 pb-0">
          <div class="flex items-center">
            <h2 class="mb-0">Edit Menu</h2>
            <a href="{{ route('menus.index') }}"
               class="ml-auto inline-block px-8 py-2 mb-4 font-bold text-white bg-blue-500 rounded-lg text-xs">
              Kembali
            </a>
          </div>
        </div>

        {{-- BODY --}}
        <div class="p-6">
          <div class="flex flex-wrap -mx-3">

            {{-- NAMA MENU --}}
            <div class="w-full px-3 md:w-6/12">
              <div class="mb-4">
                <label class="inline-block mb-2 ml-1 font-bold text-xs">
                  Nama Menu
                </label>
                <input type="text" name="name"
                       value="{{ old('name', $menu->name) }}"
                       class="block w-full px-3 py-2 border rounded-lg">
              </div>
            </div>

            {{-- KATEGORI --}}
            <div class="w-full px-3 md:w-6/12">
              <div class="mb-4">
                <label class="inline-block mb-2 ml-1 font-bold text-xs">
                  Kategori
                </label>
                <select name="category_id"
                        class="block w-full px-3 py-2 border rounded-lg">
                  @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                      {{ $menu->category_id == $category->id ? 'selected' : '' }}>
                      {{ $category->name }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>

            {{-- DESKRIPSI --}}
            <div class="w-full px-3 md:w-6/12">
              <div class="mb-4">
                <label class="inline-block mb-2 ml-1 font-bold text-xs">
                  Deskripsi
                </label>
                <input type="text" name="description"
                       value="{{ old('description', $menu->description) }}"
                       class="block w-full px-3 py-2 border rounded-lg">
              </div>
            </div>

            {{-- GAMBAR --}}
            <div class="w-full px-3 md:w-6/12">
              <div class="mb-4">
                <label class="inline-block mb-2 ml-1 font-bold text-xs">
                  Gambar
                </label>
                <input type="file" name="image"
                       class="block w-full px-3 py-2 border rounded-lg">

                @if ($menu->image)
                  <img src="{{ asset('storage/'.$menu->image) }}"
                       class="mt-2 h-16 rounded">
                @endif
              </div>
            </div>

            {{-- BUTTON --}}
            <div class="w-full px-3">
              <button type="submit"
                      class="inline-block px-8 py-2 font-bold text-white bg-blue-500 rounded-lg text-xs">
                Update
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
