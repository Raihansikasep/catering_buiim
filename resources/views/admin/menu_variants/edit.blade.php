@extends('layouts.backend')

@section('content')
<form action="{{ route('admin.menu-variants.update', $menu_variant) }}" method="POST">
@csrf
@method('PUT')

<div class="w-full p-6 mx-auto">
  <div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 md:w-8/12">
      <div class="relative flex flex-col bg-white shadow-xl rounded-2xl">

        {{-- HEADER --}}
        <div class="p-6 pb-0 border-b">
          <div class="flex items-center">
            <h2 class="mb-0">Edit Menu Variant</h2>
            <a href="{{ route('admin.menu-variants.index') }}"
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
              <div class="mb-4">
                <label class="block mb-2 text-xs font-bold">Menu</label>
                <select name="menu_id" class="w-full px-3 py-2 border rounded-lg" required>
                  @foreach($menus as $menu)
                      <option value="{{ $menu->id }}" {{ $menu_variant->menu_id == $menu->id ? 'selected' : '' }}>
                          {{ $menu->name }}
                      </option>
                  @endforeach
                </select>
              </div>
            </div>

            {{-- NAMA VARIANT --}}
            <div class="w-full px-3 md:w-6/12">
              <div class="mb-4">
                <label class="block mb-2 text-xs font-bold">Nama Variant</label>
                <input type="text" name="name_variant"
                       value="{{ old('name_variant', $menu_variant->name_variant) }}"
                       class="w-full px-3 py-2 border rounded-lg" required>
              </div>
            </div>




            <div class="w-full px-3 md:w-6/12 mt-4">
              <div class="mb-4">
                <label class="block mb-2 text-xs font-bold">Nama Item</label>
                <input type="text" name="name_item"
                       value="{{ old('name_item', $menu_variant->name_item) }}"
                       class="w-full px-3 py-2 border rounded-lg" required>
              </div>
            </div>


            <div class="w-full px-3 md:w-6/12 mt-4">
              <div class="mb-4">
                <label class="block mb-2 text-xs font-bold">Deskripsi</label>
                <input type="text" name="description"
                       value="{{ old('description', $menu_variant->description) }}"
                       class="w-full px-3 py-2 border rounded-lg" required>
              </div>
            </div>

            {{-- BUTTON --}}
            <div class="w-full px-3 mt-6">
              <button type="submit"
                      class="px-8 py-2 text-xs font-bold text-white bg-blue-500 rounded-lg">
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
