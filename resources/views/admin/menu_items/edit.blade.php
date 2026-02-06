@extends('layouts.backend')
@section('content')

<form action="{{ route('menu-items.update', $menu_item->id) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="w-full p-6 mx-auto">
  <div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 md:w-8/12">
      <div class="relative flex flex-col bg-white shadow-xl rounded-2xl">

        {{-- HEADER --}}
        <div class="p-6 pb-0">
          <div class="flex items-center">
            <h2 class="mb-0">Edit Menu Item</h2>
            <a href="{{ route('menu-items.index') }}"
               class="ml-auto inline-block px-8 py-2 mb-4 font-bold text-white bg-blue-500 rounded-lg text-xs">
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
                <label class="inline-block mb-2 ml-1 font-bold text-xs">
                  Menu
                </label>
                <select name="menu_id"
                        class="block w-full px-3 py-2 border rounded-lg">
                  @foreach ($menus as $menu)
                    <option value="{{ $menu->id }}"
                      {{ $menu_item->menu_id == $menu->id ? 'selected' : '' }}>
                      {{ $menu->name }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>

            {{-- NAMA ITEM --}}
            <div class="w-full px-3 md:w-6/12">
              <div class="mb-4">
                <label class="inline-block mb-2 ml-1 font-bold text-xs">
                  Nama Item
                </label>
                <input type="text" name="name"
                       value="{{ old('name', $menu_item->name) }}"
                       class="block w-full px-3 py-2 border rounded-lg">
              </div>
            </div>

            {{-- QUANTITY --}}
            <div class="w-full px-3 md:w-6/12">
              <div class="mb-4">
                <label class="inline-block mb-2 ml-1 font-bold text-xs">
                  Quantity
                </label>
                <input type="number" name="quantity"
                       value="{{ old('quantity', $menu_item->quantity) }}"
                       class="block w-full px-3 py-2 border rounded-lg">
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
