@extends('layouts.backend')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
:root{--font:'Plus Jakarta Sans',sans-serif;--bg:#f5f4ef;--surface:#fff;--surface2:#f9f8f5;--surface3:#f2f1ec;--border:rgba(0,0,0,0.07);--border-md:rgba(0,0,0,0.12);--text1:#141210;--text2:#6a6760;--text3:#a9a59d;--green:#1a7f5a;--green-bg:#eafaf3;--green-bd:#c6f0de;--orange:#c9610a;--orange-bg:#fff4e8;--orange-bd:#fdddb8;--purple:#5b3fbe;--purple-bg:#f0eeff;--purple-bd:#d5ceff;--red:#c02828;--red-bg:#fff0f0;--red-bd:#fecaca;--shadow-sm:0 2px 8px rgba(0,0,0,0.07),0 0 0 1px rgba(0,0,0,0.04);--r-sm:10px;--r-md:14px;--r-lg:20px;}
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
.thumb{width:44px;height:44px;border-radius:var(--r-sm);object-fit:cover;border:1px solid var(--border);}
.badge{display:inline-flex;align-items:center;gap:4px;padding:3px 10px;border-radius:99px;font-family:var(--font);font-size:10px;font-weight:800;white-space:nowrap;}
.badge-green{background:var(--green-bg);color:var(--green);border:1px solid var(--green-bd);}
.badge-orange{background:var(--orange-bg);color:var(--orange);border:1px solid var(--orange-bd);}
.menu-name-cell .mn{font-size:13px;font-weight:700;color:var(--text1);}
.menu-name-cell .mc{font-size:11px;color:var(--text3);margin-top:2px;}
.price-text{font-size:13px;font-weight:700;color:var(--green);}
.desc-text{font-size:12px;color:var(--text2);max-width:200px;}
.no-img{display:inline-flex;align-items:center;justify-content:center;width:44px;height:44px;border-radius:var(--r-sm);background:var(--surface3);font-size:18px;}
.action-group{display:flex;align-items:center;gap:6px;flex-wrap:nowrap;}
.empty-row td{padding:60px 24px;text-align:center;color:var(--text3);font-size:13px;}
</style>

<div class="adm">
  <div class="adm-card">

    {{-- Header --}}
    <div class="adm-card-header">
      <div>
        <div class="adm-card-title">🍽️ Daftar Menu</div>
        <div class="adm-card-sub">Kelola semua menu catering Dapur Ibu Iim</div>
      </div>
      <a href="{{ route('admin.menus.create') }}" class="btn btn-primary">
        + Tambah Menu
      </a>
    </div>

    {{-- Table --}}
    <div class="adm-table-wrap">
      <table class="adm-table">
        <thead>
          <tr>
            <th>No</th>
            <th>Menu</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Min / Max</th>
            <th>Deskripsi</th>
            <th class="td-center" style="text-align:center;">Gambar</th>
            <th class="td-center" style="text-align:center;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($menus as $menu)
          <tr>
            <td><span class="row-num">{{ $loop->iteration }}</span></td>

            <td>
              <div class="menu-name-cell">
                <div class="mn">{{ $menu->name }}</div>
              </div>
            </td>

            <td>
              @if($menu->category)
                <span class="badge badge-purple">{{ $menu->category->name }}</span>
              @else
                <span style="color:var(--text3);font-size:12px;">—</span>
              @endif
            </td>

            <td>
              <span class="price-text">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
            </td>

            <td>
              <div style="font-size:12px;color:var(--text2);">
                <span style="font-weight:700;">{{ $menu->min_order }}</span>
                <span style="color:var(--text3);"> – </span>
                <span style="font-weight:700;">{{ $menu->max_order }}</span>
                <span style="color:var(--text3);font-size:10px;margin-left:2px;">porsi</span>
              </div>
            </td>

            <td>
              <div class="desc-text">{{ Str::limit($menu->description, 40) ?: '—' }}</div>
            </td>

            <td style="text-align:center;">
              @if ($menu->image)
                <img src="{{ asset('storage/'.$menu->image) }}" class="thumb" style="margin:0 auto;display:block;">
              @else
                <div class="no-img" style="margin:0 auto;">🍴</div>
              @endif
            </td>

            <td style="text-align:center;">
              <div class="action-group" style="justify-content:center;">
                <a href="{{ route('admin.menus.show', $menu->id) }}" class="btn btn-success btn-sm">👁 Show</a>
                <a href="{{ route('admin.menus.edit', $menu->id) }}" class="btn btn-primary btn-sm">✏️ Edit</a>
                <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" style="display:inline;">
                  @csrf @method('DELETE')
                  <button onclick="return confirm('Yakin hapus menu ini?')" class="btn btn-danger btn-sm">🗑 Hapus</button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr class="empty-row">
            <td colspan="8">
              <div style="font-size:32px;margin-bottom:10px;">🍽️</div>
              <div style="font-weight:700;color:var(--text2);margin-bottom:4px;">Belum ada menu</div>
              <div>Tambahkan menu pertama untuk mulai menerima pesanan</div>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

  </div>
</div>
@endsection
