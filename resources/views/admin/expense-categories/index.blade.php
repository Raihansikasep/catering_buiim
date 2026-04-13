@extends('layouts.backend')
@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
:root{--font:'Plus Jakarta Sans',sans-serif;--surface:#fff;--surface2:#f9f8f5;--surface3:#f2f1ec;--border:rgba(0,0,0,0.07);--border-md:rgba(0,0,0,0.12);--text1:#141210;--text2:#6a6760;--text3:#a9a59d;--green:#1a7f5a;--green-bg:#eafaf3;--green-bd:#c6f0de;--purple:#5b3fbe;--purple-bg:#f0eeff;--purple-bd:#d5ceff;--red:#c02828;--red-bg:#fff0f0;--red-bd:#fecaca;--shadow-sm:0 2px 8px rgba(0,0,0,0.07),0 0 0 1px rgba(0,0,0,0.04);--r-sm:10px;--r-md:14px;--r-lg:20px;}
*{box-sizing:border-box;}
.adm{font-family:var(--font);color:var(--text1);}
.adm-card{background:var(--surface);border-radius:var(--r-lg);border:1px solid var(--border);box-shadow:var(--shadow-sm);overflow:hidden;}
.adm-card-header{padding:20px 24px 18px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap;}
.adm-card-title{font-size:15px;font-weight:700;color:var(--text1);margin:0;}
.adm-card-sub{font-size:12px;color:var(--text3);margin-top:3px;}
.btn{display:inline-flex;align-items:center;gap:7px;font-family:var(--font);font-size:12px;font-weight:700;padding:9px 18px;border-radius:var(--r-sm);border:none;cursor:pointer;text-decoration:none;transition:filter .15s,transform .12s;white-space:nowrap;line-height:1;}
.btn:hover{filter:brightness(1.06);transform:translateY(-1px);}
.btn-primary{background:var(--purple);color:#fff;}
.btn-success{background:var(--green);color:#fff;}
.btn-danger{background:var(--red);color:#fff;}
.btn-sm{font-size:11px;padding:6px 13px;}
.adm-table-wrap{overflow-x:auto;}
.adm-table{width:100%;border-collapse:collapse;font-family:var(--font);}
.adm-table thead tr{background:var(--surface2);}
.adm-table th{padding:12px 16px;text-align:left;font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:.7px;color:var(--text3);border-bottom:1px solid var(--border);white-space:nowrap;}
.adm-table th:first-child{padding-left:24px;}
.adm-table th:last-child{padding-right:24px;}
.adm-table td{padding:14px 16px;border-bottom:1px solid var(--border);font-size:13px;vertical-align:middle;}
.adm-table td:first-child{padding-left:24px;}
.adm-table td:last-child{padding-right:24px;}
.adm-table tbody tr:last-child td{border-bottom:none;}
.adm-table tbody tr{transition:background .1s;}
.adm-table tbody tr:hover{background:var(--surface2);}
.row-num{display:inline-flex;align-items:center;justify-content:center;width:24px;height:24px;border-radius:6px;background:var(--surface3);font-size:11px;font-weight:700;color:var(--text3);}
.cat-avatar{width:40px;height:40px;border-radius:10px;background:var(--purple-bg);border:1px solid var(--purple-bd);display:flex;align-items:center;justify-content:center;font-size:16px;font-weight:800;color:var(--purple);flex-shrink:0;}
.cat-name{font-size:13px;font-weight:700;color:var(--text1);}
.desc-text{font-size:12px;color:var(--text2);max-width:260px;}
.action-group{display:flex;align-items:center;gap:6px;}
</style>

<div class="flex flex-wrap -mx-3">
  <div class="flex-none w-full max-w-full px-3">
    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white shadow-xl rounded-2xl">

      {{-- HEADER --}}
      <div class="p-6 pb-0 mb-4 flex justify-between items-start">
        <div>
          <h6 class="text-lg font-semibold">🏷️ Daftar Kategori Pengeluaran</h6>
          <p style="font-size:0.78rem; color:#94a3b8; margin-top:2px;">Kelola kategori pengeluaran operasional</p>
        </div>
        <a href="{{ route('admin.expense-categories.create') }}"
           class="btn btn-primary bg-gradient-to-tl from-purple-700 to-pink-500 px-4 text-xs rounded-lg py-2 inline-block font-bold uppercase text-white">
          + Tambah Kategori
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
                <th class="px-6 py-3 text-center text-xs font-bold uppercase">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($categories as $category)
              <tr class="border-b">
                <td class="px-6 py-3">{{ $loop->iteration }}</td>
                <td class="px-6 py-3 font-medium">{{ $category->name }}</td>
                <td style="text-align:center;">
                    <div class="action-group" style="justify-content:center;">
                        <a href="{{ route('admin.expense-categories.edit', $category->id) }}" class="btn btn-primary btn-sm">✏️ Edit</a>
                        <form action="{{ route('admin.expense-categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Yakin hapus kategori ini? Semua menu di kategori ini akan terpengaruh.')"
                                class="btn btn-danger btn-sm">🗑 Hapus</button>
                        </form>
                    </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="4" class="px-6 py-4 text-center text-gray-400">
                  Data kategori pengeluaran masih kosong
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
