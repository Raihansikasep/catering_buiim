@extends('layouts.backend')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
:root{--font:'Plus Jakarta Sans',sans-serif;--surface:#fff;--surface2:#f9f8f5;--surface3:#f2f1ec;--border:rgba(0,0,0,0.07);--text1:#141210;--text2:#6a6760;--text3:#a9a59d;--green:#1a7f5a;--purple:#5b3fbe;--purple-bg:#f0eeff;--red:#c02828;--shadow-sm:0 2px 8px rgba(0,0,0,0.07);--r-sm:10px;--r-lg:20px;}
*{box-sizing:border-box;}
.adm{font-family:var(--font);}
.adm-layout{display:grid;grid-template-columns:1fr 300px;gap:20px;}
@media(max-width:860px){.adm-layout{grid-template-columns:1fr;}}
.adm-card{background:#fff;border-radius:var(--r-lg);border:1px solid var(--border);box-shadow:var(--shadow-sm);}
.adm-card-header{padding:20px;border-bottom:1px solid var(--border);display:flex;justify-content:space-between;}
.adm-card-title{font-weight:700;}
.adm-card-body{padding:24px;}
.form-group{margin-bottom:18px;}
.form-label{font-size:12px;font-weight:700;margin-bottom:6px;display:block;}
.form-control{width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;font-size:13px;}
textarea.form-control{min-height:120px;}
.btn{padding:10px 20px;border-radius:8px;font-size:12px;font-weight:700;text-decoration:none;}
.btn-success{background:var(--green);color:#fff;}
.btn-back{background:#eee;padding:8px 16px;border-radius:8px;text-decoration:none;font-size:12px;}
.info{font-size:12px;margin-bottom:10px;}
</style>

<div class="adm">
<form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="adm-layout">

  {{-- FORM --}}
  <div>
    <div class="adm-card">

      <div class="adm-card-header">
        <div class="adm-card-title">✨ Tambah Blog</div>
        <a href="{{ route('admin.blogs.index') }}" class="btn-back">← Kembali</a>
      </div>

      <div class="adm-card-body">

        @if ($errors->any())
        <div style="background:#ffe5e5;padding:10px;border-radius:8px;margin-bottom:15px;">
          @foreach ($errors->all() as $error)
            <div>• {{ $error }}</div>
          @endforeach
        </div>
        @endif

        <div class="form-group">
          <label class="form-label">Judul</label>
          <input type="text" name="title" value="{{ old('title') }}" class="form-control">
        </div>

        <div class="form-group">
          <label class="form-label">Konten</label>
          <textarea name="content" class="form-control">{{ old('content') }}</textarea>
        </div>

        <div class="form-group">
          <label class="form-label">Gambar</label>
          <input type="file" name="image" class="form-control">
        </div>

        <div style="margin-top:10px;">
          <button class="btn btn-success">✓ Simpan Blog</button>
          <a href="{{ route('admin.blogs.index') }}" class="btn-back">Batal</a>
        </div>

      </div>
    </div>
  </div>

  {{-- SIDEBAR --}}
  <div>
    <div class="adm-card">
      <div class="adm-card-header">
        <div class="adm-card-title">📖 Panduan</div>
      </div>
      <div class="adm-card-body">
        <div class="info">📝 Judul harus jelas & menarik</div>
        <div class="info">📄 Konten isi artikel blog</div>
        <div class="info">🖼 Upload gambar biar lebih menarik</div>
        <div class="info">💡 Blog bagus = SEO naik 🚀</div>
      </div>
    </div>
  </div>

</div>
</form>
</div>
@endsection
