@extends('layouts.backend')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
:root{--font:'Plus Jakarta Sans',sans-serif;--surface:#fff;--surface2:#f9f8f5;--surface3:#f2f1ec;--border:rgba(0,0,0,0.07);--border-md:rgba(0,0,0,0.12);--text1:#141210;--text2:#6a6760;--text3:#a9a59d;--green:#1a7f5a;--green-bg:#eafaf3;--green-bd:#c6f0de;--purple:#5b3fbe;--purple-bg:#f0eeff;--purple-bd:#d5ceff;--orange:#c9610a;--orange-bg:#fff4e8;--orange-bd:#fdddb8;--red:#c02828;--red-bg:#fff0f0;--red-bd:#fecaca;--shadow-sm:0 2px 8px rgba(0,0,0,0.07),0 0 0 1px rgba(0,0,0,0.04);--r-sm:10px;--r-md:14px;--r-lg:20px;}
*{box-sizing:border-box;}
.adm{font-family:var(--font);color:var(--text1);}
.adm-layout{display:grid;grid-template-columns:1fr 300px;gap:20px;align-items:start;}
@media(max-width:860px){.adm-layout{grid-template-columns:1fr;}}
.adm-card{background:var(--surface);border-radius:var(--r-lg);border:1px solid var(--border);box-shadow:var(--shadow-sm);overflow:hidden;}
.adm-card-header{padding:20px 24px 18px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;gap:12px;}
.adm-card-title{font-size:15px;font-weight:700;color:var(--text1);margin:0;}
.adm-card-sub{font-size:12px;color:var(--text3);margin-top:3px;}
.adm-card-body{padding:24px;}
.btn{display:inline-flex;align-items:center;gap:7px;font-family:var(--font);font-size:12px;font-weight:700;padding:9px 18px;border-radius:var(--r-sm);border:none;cursor:pointer;text-decoration:none;transition:filter .15s,transform .12s;white-space:nowrap;line-height:1;}
.btn:hover{filter:brightness(1.06);transform:translateY(-1px);}
.btn-success{background:var(--green);color:#fff;}
.btn-lg{font-size:13px;padding:12px 24px;}
.btn-back{display:inline-flex;align-items:center;gap:6px;font-family:var(--font);font-size:12px;font-weight:700;color:var(--text2);text-decoration:none;background:var(--surface2);border:1px solid var(--border-md);padding:8px 16px;border-radius:var(--r-sm);transition:background .15s;}
.btn-back:hover{background:var(--surface3);color:var(--text1);}
.form-group{margin-bottom:20px;}
.form-label{display:block;margin-bottom:7px;font-size:12px;font-weight:700;color:var(--text2);}
.form-label .req{color:var(--red);margin-left:2px;}
.form-control{display:block;width:100%;font-family:var(--font);font-size:13px;color:var(--text1);background:var(--surface);border:1px solid var(--border-md);border-radius:var(--r-sm);padding:10px 14px;outline:none;transition:border-color .15s,box-shadow .15s;appearance:none;}
.form-control:focus{border-color:var(--purple);box-shadow:0 0 0 3px rgba(91,63,190,0.12);}
.form-control::placeholder{color:var(--text3);}
textarea.form-control{resize:vertical;min-height:90px;line-height:1.6;}
select.form-control{background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%23a9a59d' stroke-width='2.5'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 12px center;padding-right:36px;}
.grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
@media(max-width:600px){.grid-2{grid-template-columns:1fr;}}
.section-divider{font-size:11px;font-weight:800;text-transform:uppercase;letter-spacing:1px;color:var(--text3);padding-bottom:12px;border-bottom:1px solid var(--border);margin-bottom:20px;}
.info-row{display:flex;justify-content:space-between;padding:9px 0;border-bottom:1px solid var(--border);font-size:12px;}
.info-row:last-child{border-bottom:none;}
.badge{display:inline-flex;align-items:center;gap:4px;padding:3px 10px;border-radius:99px;font-family:var(--font);font-size:10px;font-weight:800;white-space:nowrap;}
.badge-purple{background:var(--purple-bg);color:var(--purple);border:1px solid var(--purple-bd);}
.badge-orange{background:var(--orange-bg);color:var(--orange);border:1px solid var(--orange-bd);}
</style>

<div class="adm">
<form action="{{ route('admin.menu-variants.update', $menu_variant) }}" method="POST">
@csrf @method('PUT')

  <div class="adm-layout">

    <div>
      <div class="adm-card">
        <div class="adm-card-header">
          <div>
            <div class="adm-card-title">✏️ Edit Menu Variant</div>
            <div class="adm-card-sub">Perbarui varian <strong>{{ $menu_variant->name_variant }}</strong></div>
          </div>
          <a href="{{ route('admin.menu-variants.index') }}" class="btn-back">← Kembali</a>
        </div>
        <div class="adm-card-body">

          @if ($errors->any())
          <div style="background:var(--red-bg);border:1px solid var(--red-bd);border-radius:var(--r-sm);padding:14px 16px;margin-bottom:20px;font-size:13px;color:var(--red);">
            @foreach ($errors->all() as $error)<div>• {{ $error }}</div>@endforeach
          </div>
          @endif

          <div class="section-divider">Hubungan Menu</div>

          <div class="form-group">
            <label class="form-label">Menu Induk <span class="req">*</span></label>
            <select name="menu_id" class="form-control" required>
              @foreach($menus as $menu)
                <option value="{{ $menu->id }}" {{ $menu_variant->menu_id == $menu->id ? 'selected' : '' }}>
                  {{ $menu->name }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="section-divider">Detail Variant</div>

          <div class="grid-2">
            <div class="form-group">
              <label class="form-label">Nama Variant <span class="req">*</span></label>
              <input type="text" name="name_variant"
                     value="{{ old('name_variant', $menu_variant->name_variant) }}"
                     class="form-control" required>
            </div>
            <div class="form-group">
              <label class="form-label">Nama Item <span class="req">*</span></label>
              <input type="text" name="name_item"
                     value="{{ old('name_item', $menu_variant->name_item) }}"
                     class="form-control" required>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Deskripsi <span class="req">*</span></label>
            <textarea name="description" class="form-control">{{ old('description', $menu_variant->description) }}</textarea>
          </div>

          <div style="display:flex;gap:10px;padding-top:4px;">
            <button type="submit" class="btn btn-success btn-lg">✓ Update Variant</button>
            <a href="{{ route('admin.menu-variants.index') }}" class="btn-back" style="font-size:13px;padding:12px 20px;">Batal</a>
          </div>

        </div>
      </div>
    </div>

    {{-- Sidebar: current data --}}
    <div>
      <div class="adm-card">
        <div class="adm-card-header">
          <div class="adm-card-title">📋 Data Saat Ini</div>
        </div>
        <div class="adm-card-body" style="padding:16px 20px;">
          <div class="info-row">
            <span style="color:var(--text3);font-weight:600;">ID Variant</span>
            <span style="font-weight:700;">#{{ $menu_variant->id }}</span>
          </div>
          <div class="info-row">
            <span style="color:var(--text3);font-weight:600;">Menu Induk</span>
            <span>
              @if($menu_variant->menu)
                <span class="badge badge-purple">{{ $menu_variant->menu->name }}</span>
              @else —
              @endif
            </span>
          </div>
          <div class="info-row">
            <span style="color:var(--text3);font-weight:600;">Variant</span>
            <span style="font-weight:700;">{{ $menu_variant->name_variant }}</span>
          </div>
          <div class="info-row">
            <span style="color:var(--text3);font-weight:600;">Item</span>
            <span class="badge badge-orange">{{ $menu_variant->name_item }}</span>
          </div>
          <div class="info-row">
            <span style="color:var(--text3);font-weight:600;">Dibuat</span>
            <span style="font-weight:700;">{{ $menu_variant->created_at?->format('d M Y') ?? '—' }}</span>
          </div>
        </div>
      </div>
    </div>

  </div>
</form>
</div>
@endsection
