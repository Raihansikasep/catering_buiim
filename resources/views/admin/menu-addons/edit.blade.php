@extends('layouts.backend')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
:root{--font:'Plus Jakarta Sans',sans-serif;--surface:#fff;--surface2:#f9f8f5;--surface3:#f2f1ec;--border:rgba(0,0,0,0.07);--border-md:rgba(0,0,0,0.12);--text1:#141210;--text2:#6a6760;--text3:#a9a59d;--green:#1a7f5a;--green-bg:#eafaf3;--green-bd:#c6f0de;--purple:#5b3fbe;--purple-bg:#f0eeff;--purple-bd:#d5ceff;--orange:#c9610a;--orange-bg:#fff4e8;--orange-bd:#fdddb8;--red:#c02828;--red-bg:#fff0f0;--red-bd:#fecaca;--shadow-sm:0 2px 8px rgba(0,0,0,0.07),0 0 0 1px rgba(0,0,0,0.04);--r-sm:10px;--r-md:14px;--r-lg:20px;}
*{box-sizing:border-box;}
.adm{font-family:var(--font);color:var(--text1);}
.adm-layout{display:grid;grid-template-columns:1fr 300px;gap:20px;}
@media(max-width:860px){.adm-layout{grid-template-columns:1fr;}}
.adm-card{background:var(--surface);border-radius:var(--r-lg);border:1px solid var(--border);box-shadow:var(--shadow-sm);}
.adm-card-header{padding:20px 24px;border-bottom:1px solid var(--border);display:flex;justify-content:space-between;}
.adm-card-title{font-size:15px;font-weight:700;}
.adm-card-sub{font-size:12px;color:var(--text3);}
.adm-card-body{padding:24px;}
.btn{display:inline-flex;align-items:center;gap:7px;font-size:12px;font-weight:700;padding:10px 20px;border-radius:var(--r-sm);text-decoration:none;}
.btn-success{background:var(--green);color:#fff;}
.btn-back{font-size:12px;background:#eee;padding:8px 16px;border-radius:8px;text-decoration:none;}
.form-group{margin-bottom:18px;}
.form-label{font-size:12px;font-weight:700;margin-bottom:6px;display:block;}
.form-control{width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;font-size:13px;}
.grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
@media(max-width:600px){.grid-2{grid-template-columns:1fr;}}
.info-row{display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid #eee;font-size:12px;}
.badge-purple{background:#f0eeff;color:#5b3fbe;padding:4px 10px;border-radius:20px;font-size:11px;font-weight:700;}
.badge-orange{background:#fff4e8;color:#c9610a;padding:4px 10px;border-radius:20px;font-size:11px;font-weight:700;}
</style>

<div class="adm">
<form action="{{ route('admin.menu-addons.update', $addon->id) }}" method="POST">
@csrf
@method('PUT')

<div class="adm-layout">

  {{-- FORM --}}
  <div>
    <div class="adm-card">
      <div class="adm-card-header">
        <div>
          <div class="adm-card-title">✏️ Edit Menu Addon</div>
          <div class="adm-card-sub">Update addon <strong>{{ $addon->name }}</strong></div>
        </div>
        <a href="{{ route('admin.menu-addons.index') }}" class="btn-back">← Kembali</a>
      </div>

      <div class="adm-card-body">

        @if ($errors->any())
        <div style="background:#ffe5e5;padding:10px;border-radius:8px;margin-bottom:15px;">
          @foreach ($errors->all() as $error)
            <div>• {{ $error }}</div>
          @endforeach
        </div>
        @endif

        {{-- MENU --}}
        <div class="form-group">
          <label class="form-label">Menu</label>
          <select name="menu_id" class="form-control">
            @foreach ($menus as $menu)
              <option value="{{ $menu->id }}" {{ $addon->menu_id == $menu->id ? 'selected' : '' }}>
                {{ $menu->name }}
              </option>
            @endforeach
          </select>
        </div>

        {{-- INPUT --}}
        <div class="grid-2">
          <div class="form-group">
            <label class="form-label">Nama Addon</label>
            <input type="text" name="name" value="{{ old('name', $addon->name) }}" class="form-control">
          </div>

          <div class="form-group">
            <label class="form-label">Harga</label>
            <input type="number" name="price" value="{{ old('price', $addon->price) }}" class="form-control">
          </div>
        </div>

        <div style="margin-top:10px;">
          <button class="btn btn-success">✓ Update Addon</button>
          <a href="{{ route('admin.menu-addons.index') }}" class="btn-back">Batal</a>
        </div>

      </div>
    </div>
  </div>

  {{-- SIDEBAR --}}
  <div>
    <div class="adm-card">
      <div class="adm-card-header">
        <div class="adm-card-title">📋 Data Saat Ini</div>
      </div>
      <div class="adm-card-body">

        <div class="info-row">
          <span>ID</span>
          <strong>#{{ $addon->id }}</strong>
        </div>

        <div class="info-row">
          <span>Menu</span>
          <span class="badge-purple">
            {{ $addon->menu->name ?? '-' }}
          </span>
        </div>

        <div class="info-row">
          <span>Addon</span>
          <span class="badge-orange">
            {{ $addon->name }}
          </span>
        </div>

        <div class="info-row">
          <span>Harga</span>
          <strong>Rp {{ number_format($addon->price,0,',','.') }}</strong>
        </div>

        <div class="info-row">
          <span>Dibuat</span>
          <strong>{{ $addon->created_at?->format('d M Y') ?? '-' }}</strong>
        </div>

      </div>
    </div>
  </div>

</div>
</form>
</div>
@endsection
