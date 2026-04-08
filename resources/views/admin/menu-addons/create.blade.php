@extends('layouts.backend')
@section('content')
<form action="{{ route('admin.menu-addons.store') }}" method="POST">
    @csrf
    <div class="w-full p-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
          <div class="w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-0">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
              <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                <div class="flex items-center justify-between">
                  <h2 class="mb-0 dark:text-white/80">Tambah Addon</h2>
                  <a href="{{ route('admin.menu-addons.index') }}"
                      class="inline-block px-8 py-2 mb-4 ml-auto font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-blue-500 border-0 rounded-lg shadow-md cursor-pointer text-xs tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">
                      Kembali
                  </a>
                </div>
              </div>
              <div class="flex-auto p-6">
                <div class="flex flex-wrap -mx-3">

                  {{-- PILIH MENU --}}
                  <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                    <div class="mb-4">
                      <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Pilih Menu</label>
                      <select name="menu_id" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-blue-500 focus:outline-none">
                        <option value="">-- Pilih Menu --</option>
                        @foreach ($menus as $menu)
                          <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                        @endforeach
                      </select>
                      @error('menu_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                  </div>

                  {{-- NAMA ADDON --}}
                  <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                    <div class="mb-4">
                      <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Nama Addon</label>
                      <input type="text" name="name" value="{{ old('name') }}" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                      @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                  </div>

                  {{-- HARGA --}}
                  <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                    <div class="mb-4">
                      <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Harga</label>
                      <input type="number" name="price" value="{{ old('price') }}" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                      @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                  </div>

                </div>
                <button type="submit" class="inline-block px-8 py-2 font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-blue-500 border-0 rounded-lg shadow-md cursor-pointer text-xs tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">Simpan</button>
              </div>
            </div>
          </div>
        </div>
    </div>
</form>
@endsection
