@extends('layouts.backend')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
:root{--font:'Plus Jakarta Sans',sans-serif;--surface:#fff;--surface2:#f9f8f5;--surface3:#f2f1ec;--border:rgba(0,0,0,0.07);--text1:#141210;--text2:#6a6760;--text3:#a9a59d;--purple:#5b3fbe;--purple-bg:#f0eeff;--orange:#c9610a;--orange-bg:#fff4e8;--red:#c02828;--shadow-sm:0 2px 8px rgba(0,0,0,0.07);--r-sm:10px;--r-lg:20px;}
*{box-sizing:border-box;}
.adm{font-family:var(--font);color:var(--text1);}
.adm-card{background:#fff;border-radius:var(--r-lg);border:1px solid var(--border);box-shadow:var(--shadow-sm);}
.adm-card-header{padding:20px 24px;border-bottom:1px solid var(--border);display:flex;justify-content:space-between;}
.adm-card-title{font-size:15px;font-weight:700;}
.adm-table{width:100%;border-collapse:collapse;}
.adm-table th{padding:12px 16px;font-size:10px;text-transform:uppercase;color:var(--text3);}
.adm-table td{padding:14px 16px;border-bottom:1px solid var(--border);font-size:13px;}
.adm-table tr:hover{background:var(--surface2);}
.row-num{background:var(--surface3);padding:5px 8px;border-radius:6px;font-size:11px;}
.badge-purple{background:var(--purple-bg);color:var(--purple);padding:4px 10px;border-radius:20px;font-size:11px;font-weight:700;}
.badge-orange{background:var(--orange-bg);color:var(--orange);padding:4px 10px;border-radius:20px;font-size:11px;font-weight:700;}
.btn{padding:6px 12px;border-radius:8px;font-size:11px;font-weight:700;text-decoration:none;}
.btn-primary{background:var(--purple);color:#fff;}
.btn-danger{background:var(--red);color:#fff;}
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
      <div class="adm-card-title">📝 Daftar Blog</div>
      <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">+ Tambah Blog</a>
    </div>

    {{-- SUCCESS --}}
    @if(session('success'))
      <div style="margin:15px;background:#eafaf3;padding:10px;border-radius:8px;">
        {{ session('success') }}
      </div>
    @endif

    {{-- TABLE --}}
    <div style="overflow-x:auto;">
      <table class="adm-table">

        <thead>
          <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Konten</th>
            <th style="text-align:center;">Gambar</th>
            <th style="text-align:center;">Aksi</th>
          </tr>
        </thead>

        <tbody>
          @forelse ($blogs as $blog)
          <tr>

            <td><span class="row-num">{{ $loop->iteration }}</span></td>

            <td>
              <span class="badge-purple">
                {{ $blog->title }}
              </span>
            </td>

            <td>
              <span class="badge-orange">
                {{ \Illuminate\Support\Str::limit($blog->content, 50) }}
              </span>
            </td>

            <td style="text-align:center;">
              @if ($blog->image)
                <img src="{{ asset('storage/'.$blog->image) }}"
                     style="height:40px;width:40px;object-fit:cover;border-radius:8px;">
              @else
                <span style="color:gray;font-size:11px;">No Image</span>
              @endif
            </td>

            <td>
              <div class="action-group">

                <a href="{{ route('admin.blogs.edit', $blog->id) }}"
                   class="btn btn-primary">Edit</a>

                <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button onclick="return confirm('Yakin hapus blog?')"
                          class="btn btn-danger">Hapus</button>
                </form>

              </div>
            </td>

          </tr>

          @empty
          <tr>
            <td colspan="5" style="text-align:center;padding:40px;color:gray;">
              <div style="font-size:28px;">📝</div>
              Data blog masih kosong
            </td>
          </tr>
          @endforelse
        </tbody>

      </table>
    </div>

  </div>
</div>
@endsection
