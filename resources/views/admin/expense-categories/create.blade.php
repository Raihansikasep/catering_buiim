@extends('layouts.backend')
@section('content')

<form action="{{ route('admin.expense-categories.store') }}" method="POST">
@csrf

<div class="w-full p-6 mx-auto">
  <div class="flex flex-wrap -mx-3">
    <div class="w-full md:w-6/12 px-3">
      <div class="bg-white shadow-xl rounded-2xl p-6">

        {{-- HEADER --}}
        <div class="flex items-center mb-4">
          <h2 class="text-lg font-semibold">Tambah Kategori Expense</h2>
          <a href="{{ route('admin.expense-categories.index') }}"
             class="ml-auto px-6 py-2 text-xs font-bold text-white bg-gray-500 rounded-lg">
            Kembali
          </a>
        </div>

        {{-- NAMA --}}
        <div class="w-full mb-4">
          <label class="block text-xs font-bold mb-1">Nama Kategori</label>
          <input type="text" name="name" value="{{ old('name') }}"
                 class="w-full px-3 py-2 border rounded-lg"
                 required>
        </div>

        {{-- BUTTON --}}
        <div class="w-full">
          <button type="submit"
                  class="px-8 py-2 text-xs font-bold text-white bg-blue-500 rounded-lg">
            Simpan
          </button>
        </div>

      </div>
    </div>
  </div>
</div>

</form>
@endsection
