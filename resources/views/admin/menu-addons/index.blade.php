@extends('layouts.backend')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
:root{--font:'Plus Jakarta Sans',sans-serif;--surface:#fff;--surface2:#f9f8f5;--surface3:#f2f1ec;--border:rgba(0,0,0,0.07);--border-md:rgba(0,0,0,0.12);--text1:#141210;--text2:#6a6760;--text3:#a9a59d;--green:#1a7f5a;--green-bg:#eafaf3;--green-bd:#c6f0de;--purple:#5b3fbe;--purple-bg:#f0eeff;--purple-bd:#d5ceff;--red:#c02828;--red-bg:#fff0f0;--red-bd:#fecaca;--orange:#c9610a;--orange-bg:#fff4e8;--orange-bd:#fdddb8;--shadow-sm:0 2px 8px rgba(0,0,0,0.07),0 0 0 1px rgba(0,0,0,0.04);--r-sm:10px;--r-md:14px;--r-lg:20px;}
*{box-sizing:border-box;}
.adm{font-family:var(--font);color:var(--text1);}
.adm-card{background:var(--surface);border-radius:var(--r-lg);border:1px solid var(--border);box-shadow:var(--shadow-sm);overflow:hidden;}
.adm-card-header{padding:20px 24px 18px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;}
.adm-card-title{font-size:15px;font-weight:700;}
.adm-card-sub{font-size:12px;color:var(--text3);}
.btn{display:inline-flex;align-items:center;gap:7px;font-size:12px;font-weight:700;padding:9px 18px;border-radius:var(--r-sm);text-decoration:none;}
.btn-primary{background:var(--purple);color:#fff;}
.btn-danger{background:var(--red);color:#fff;}
.btn-sm{font-size:11px;padding:6px 13px;}
.adm-table-wrap{overflow-x:auto;}
.adm-table{width:100%;border-collapse:collapse;}
.adm-table thead tr{background:var(--surface2);}
.adm-table th{padding:12px 16px;font-size:10px;font-weight:800;text-transform:uppercase;color:var(--text3);}
.adm-table td{padding:13px 16px;border-bottom:1px solid var(--border);font-size:13px;}
.adm-table tbody tr:hover{background:var(--surface2);}
.row-num{display:inline-flex;align-items:center;justify-content:center;width:24px;height:24px;border-radius:6px;background:var(--surface3);font-size:11px;font-weight:700;}
.badge-purple{background:var(--purple-bg);color:var(--purple);padding:4px 10px;border-radius:20px;font-size:11px;font-weight:700;}
.badge-orange{background:var(--orange-bg);color:var(--orange);padding:4px 10px;border-radius:20px;font-size:11px;font-weight:700;}
.action-group{display:flex;gap:6px;justify-content:center;}
.adm-table th,
.adm-table td {
  padding: 14px 20px; /* lebih balance */
}

.adm-table th {
  text-align: left;
}

.adm-table td {
  vertical-align: middle;
}

/* Biar row lebih compact & rapi */
.adm-table tbody tr {
  height: 60px;
}

/* NO */
.row-num {
  width: 28px;
  height: 28px;
  font-size: 12px;
}

/* BADGE biar gak kepanjangan */
.badge-purple,
.badge-orange {
  max-width: 220px;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

/* KONTEN biar gak kepanjangan banget */
.badge-orange {
  max-width: 300px;
}

/* GAMBAR */
.adm-table img {
  width: 48px;
  height: 48px;
  border-radius: 10px;
  object-fit: cover;
  display: block;
  margin: auto;
}

/* AKSI biar center & rapih */
.action-group {
  display: flex;
  justify-content: center;
  gap: 8px;
}

/* BUTTON biar konsisten */
.btn {
  padding: 6px 14px;
  border-radius: 8px;
  font-size: 11px;
}

/* HEADER biar balance */
.adm-card-header {
  align-items: center;
}

/* TABLE hover biar lebih halus */
.adm-table tbody tr:hover {
  background: #f9f8f5;
}
</style>

<div class="adm">
  <div class="adm-card">

    {{-- HEADER --}}
    <div class="adm-card-header">
      <div>
        <div class="adm-card-title">🍽️ Daftar Menu Addon</div>
        <div class="adm-card-sub">Kelola addon untuk setiap menu</div>
      </div>
      <a href="{{ route('admin.menu-addons.create') }}" class="btn btn-primary">+ Tambah Addon</a>
    </div>

    {{-- TABLE --}}
    <div class="adm-table-wrap">
      <table class="adm-table">
        <thead>
          <tr>
            <th>No</th>
            <th>Menu</th>
            <th>Nama Addon</th>
            <th>Harga</th>
            <th style="text-align:center;">Aksi</th>
          </tr>
        </thead>

        <tbody>
          @forelse ($addons as $addon)
          <tr>
            <td><span class="row-num">{{ $loop->iteration }}</span></td>

            <td>
              <span class="badge-purple">
                {{ $addon->menu->name ?? '-' }}
              </span>
            </td>

            <td>
              <span class="badge-orange">
                {{ $addon->name }}
              </span>
            </td>

            <td>
              Rp {{ number_format($addon->price, 0, ',', '.') }}
            </td>

            <td>
              <div class="action-group">
                <a href="{{ route('admin.menu-addons.edit', $addon->id) }}" class="btn btn-primary btn-sm">✏️ Edit</a>

                <form action="{{ route('admin.menu-addons.destroy', $addon->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">🗑 Hapus</button>
                </form>
              </div>
            </td>
          </tr>

          @empty
          <tr>
            <td colspan="5" style="padding:50px;text-align:center;color:gray;">
              <div style="font-size:30px;">🍽️</div>
              <div>Data addon masih kosong</div>
            </td>
          </tr>
          @endforelse
        </tbody>

      </table>
    </div>

  </div>
</div>
@endsection
