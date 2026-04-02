@extends('layouts.backend')
@section('content')

<div class="flex flex-wrap -mx-3">
  <div class="flex-none w-full max-w-full px-3">
    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white shadow-xl rounded-2xl">

      {{-- HEADER --}}
      <div class="p-6 pb-0 mb-4 flex justify-between items-center">
        <h6 class="text-lg font-semibold">Expenses</h6>
        <a href="{{ route('admin.expenses.create') }}"
           class="bg-gradient-to-tl from-emerald-500 to-teal-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block font-bold uppercase text-white">
          + Tambah Expense
        </a>
      </div>

      {{-- TABLE --}}
      <div class="flex-auto px-0 pt-0 pb-2">
        <div class="p-0 overflow-x-auto">
          <table class="items-center w-full mb-0 align-top border-collapse text-slate-600">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-bold uppercase">No</th>
                <th class="px-6 py-3 text-left text-xs font-bold uppercase">Kategori</th>
                <th class="px-6 py-3 text-left text-xs font-bold uppercase">Deskripsi</th>
                <th class="px-6 py-3 text-left text-xs font-bold uppercase">Jumlah</th>
                <th class="px-6 py-3 text-left text-xs font-bold uppercase">Tanggal</th>
                <th class="px-6 py-3 text-left text-xs font-bold uppercase">Catatan</th>
                <th class="px-6 py-3 text-center text-xs font-bold uppercase">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($expenses as $expense)
              <tr class="border-b">
                <td class="px-6 py-3">{{ $loop->iteration }}</td>
                <td class="px-6 py-3">{{ $expense->category->name ?? '-' }}</td>
                <td class="px-6 py-3">{{ Str::limit($expense->description, 50) }}</td>
                <td class="px-6 py-3">Rp {{ number_format($expense->amount, 2, ',', '.') }}</td>
                <td class="px-6 py-3">{{ \Carbon\Carbon::parse($expense->expense_date)->format('d M Y') }}</td>
                <td class="px-6 py-3">{{ Str::limit($expense->notes, 50) ?? '-' }}</td>
                <td class="px-6 py-3 text-center space-x-2">
                  <a href="{{ route('admin.expenses.edit', $expense->id) }}"
                     class="bg-gradient-to-tl from-emerald-500 to-teal-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block font-bold uppercase text-white">
                    Edit
                  </a>
                  <form action="{{ route('admin.expenses.destroy', $expense->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Yakin hapus expense ini?')"
                            class="bg-gradient-to-tl from-red-600 to-red-600 px-2.5 text-xs rounded-1.8 py-1.4 inline-block font-bold uppercase text-white">
                      Delete
                    </button>
                  </form>

                </td>
              </tr>
              @empty
              <tr>
                <td colspan="7" class="px-6 py-4 text-center text-gray-400">
                  Data expense masih kosong
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
