@extends('layouts.backend')
@section('content')

<form action="{{ route('expenses.store') }}" method="POST">
@csrf

<div class="w-full p-6 mx-auto">
  <div class="flex flex-wrap -mx-3">
    <div class="w-full md:w-8/12 px-3">
      <div class="bg-white shadow-xl rounded-2xl p-6">

        {{-- HEADER --}}
        <div class="flex items-center mb-4">
          <h2 class="text-lg font-semibold">Tambah Expense</h2>
          <a href="{{ route('expenses.index') }}"
             class="ml-auto px-6 py-2 text-xs font-bold text-white bg-gray-500 rounded-lg">
            Kembali
          </a>
        </div>

        {{-- KATEGORI --}}
        <div class="w-full mb-4">
          <label class="block text-xs font-bold mb-1">Kategori</label>
          <select name="expense_category_id" class="w-full px-3 py-2 border rounded-lg" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach($categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
          </select>
        </div>

        {{-- DESKRIPSI --}}
        <div class="w-full mb-4">
          <label class="block text-xs font-bold mb-1">Deskripsi</label>
          <input type="text" name="description" value="{{ old('description') }}"
                 class="w-full px-3 py-2 border rounded-lg" required>
        </div>

        {{-- JUMLAH --}}
        <div class="w-full mb-4">
          <label class="block text-xs font-bold mb-1">Jumlah</label>
          <input type="number" step="0.01" name="amount" value="{{ old('amount') }}"
                 class="w-full px-3 py-2 border rounded-lg" required>
        </div>

        {{-- TANGGAL --}}
        <div class="w-full mb-4">
          <label class="block text-xs font-bold mb-1">Tanggal Expense</label>
          <input type="date" name="expense_date" value="{{ old('expense_date') }}"
                 class="w-full px-3 py-2 border rounded-lg" required>
        </div>

        {{-- CATATAN --}}
        <div class="w-full mb-4">
          <label class="block text-xs font-bold mb-1">Catatan</label>
          <textarea name="notes" class="w-full px-3 py-2 border rounded-lg" rows="3">{{ old('notes') }}</textarea>
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
