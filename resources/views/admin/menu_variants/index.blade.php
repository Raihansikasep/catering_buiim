@extends('layouts.backend')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
:root{--font:'Plus Jakarta Sans',sans-serif;--surface:#fff;--surface2:#f9f8f5;--surface3:#f2f1ec;--border:rgba(0,0,0,0.07);--border-md:rgba(0,0,0,0.12);--text1:#141210;--text2:#6a6760;--text3:#a9a59d;--green:#1a7f5a;--green-bg:#eafaf3;--green-bd:#c6f0de;--purple:#5b3fbe;--purple-bg:#f0eeff;--purple-bd:#d5ceff;--red:#c02828;--red-bg:#fff0f0;--red-bd:#fecaca;--orange:#c9610a;--orange-bg:#fff4e8;--orange-bd:#fdddb8;--shadow-sm:0 2px 8px rgba(0,0,0,0.07),0 0 0 1px rgba(0,0,0,0.04);--r-sm:10px;--r-md:14px;--r-lg:20px;}
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
.adm-table td{padding:13px 16px;border-bottom:1px solid var(--border);font-size:13px;vertical-align:middle;}
.adm-table td:first-child{padding-left:24px;}
.adm-table td:last-child{padding-right:24px;}
.adm-table tbody tr:last-child td{border-bottom:none;}
.adm-table tbody tr{transition:background .1s;}
.adm-table tbody tr:hover{background:var(--surface2);}
.row-num{display:inline-flex;align-items:center;justify-content:center;width:24px;height:24px;border-radius:6px;background:var(--surface3);font-size:11px;font-weight:700;color:var(--text3);}
.badge{display:inline-flex;align-items:center;gap:4px;padding:3px 10px;border-radius:99px;font-family:var(--font);font-size:10px;font-weight:800;white-space:nowrap;}
.badge-purple{background:var(--purple-bg);color:var(--purple);border:1px solid var(--purple-bd);}
.badge-orange{background:var(--orange-bg);color:var(--orange);border:1px solid var(--orange-bd);}
.badge-green{background:var(--green-bg);color:var(--green);border:1px solid var(--green-bd);}
.action-group{display:flex;align-items:center;gap:6px;justify-content:center;}
.menu-link{font-size:12px;font-weight:700;color:var(--purple);}
.var-name{font-size:13px;font-weight:700;color:var(--text1);}
.var-item{font-size:11px;color:var(--text3);margin-top:2px;}
.desc-chip{display:inline-block;background:var(--surface2);border:1px solid var(--border-md);border-radius:6px;padding:3px 10px;font-size:11px;color:var(--text2);max-width:180px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
</style>

<div class="adm">
  <div class="adm-card">

    <div class="adm-card-header">
      <div>
        <div class="adm-card-title">🔀 Daftar Menu Variant</div>
        <div class="adm-card-sub">Kelola varian dari setiap menu catering</div>
      </div>
      <a href="{{ route('admin.menu-variants.create') }}" class="btn btn-primary">+ Tambah Variant</a>
    </div>

    <div class="adm-table-wrap">
      <table class="adm-table">
        <thead>
          <tr>
            <th>No</th>
            <th>Variant</th>
            <th>Menu Induk</th>
            <th>Nama Item</th>
            <th>Deskripsi</th>
            <th style="text-align:center;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($variants as $variant)
          <tr>
            <td><span class="row-num">{{ $loop->iteration }}</span></td>

            <td>
              <div class="var-name">{{ $variant->name_variant }}</div>
            </td>

            <td>
              @if($variant->menu)
                <span class="badge badge-purple">{{ $variant->menu->name }}</span>
              @else
                <span style="color:var(--text3);font-size:12px;">—</span>
              @endif
            </td>

            <td>
              <span class="badge badge-orange">{{ $variant->name_item }}</span>
            </td>

            <td>
              <span class="desc-chip" title="{{ $variant->description }}">
                {{ $variant->description ?: '—' }}
              </span>
            </td>

            <td>
              <div class="action-group">
                <a href="{{ route('admin.menu-variants.edit', $variant->id) }}" class="btn btn-primary btn-sm">✏️ Edit</a>
                <form action="{{ route('admin.menu-variants.destroy', $variant->id) }}" method="POST" style="display:inline;">
                  @csrf @method('DELETE')
                  <button onclick="return confirm('Yakin hapus variant ini?')" class="btn btn-danger btn-sm">🗑 Hapus</button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" style="padding:60px 24px;text-align:center;color:var(--text3);">
              <div style="font-size:32px;margin-bottom:10px;">🔀</div>
              <div style="font-weight:700;color:var(--text2);margin-bottom:4px;">Belum ada variant</div>
              <div style="font-size:12px;">Tambahkan varian untuk menu yang tersedia</div>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

  </div>
</div>
@endsection
