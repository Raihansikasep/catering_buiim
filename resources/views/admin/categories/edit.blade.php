@extends('layouts.backend')
@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
:root{--font:'Plus Jakarta Sans',sans-serif;--surface:#fff;--surface2:#f9f8f5;--surface3:#f2f1ec;--border:rgba(0,0,0,0.07);--border-md:rgba(0,0,0,0.12);--text1:#141210;--text2:#6a6760;--text3:#a9a59d;--green:#1a7f5a;--green-bg:#eafaf3;--green-bd:#c6f0de;--purple:#5b3fbe;--purple-bg:#f0eeff;--purple-bd:#d5ceff;--red:#c02828;--red-bg:#fff0f0;--red-bd:#fecaca;--shadow-sm:0 2px 8px rgba(0,0,0,0.07),0 0 0 1px rgba(0,0,0,0.04);--r-sm:10px;--r-md:14px;--r-lg:20px;}
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
.form-control{display:block;width:100%;font-family:var(--font);font-size:13px;color:var(--text1);background:var(--surface);border:1px solid var(--border-md);border-radius:var(--r-sm);padding:10px 14px;outline:none;transition:border-color .15s,box-shadow .15s;}
.form-control:focus{border-color:var(--purple);box-shadow:0 0 0 3px rgba(91,63,190,0.12);}
textarea.form-control{resize:vertical;min-height:110px;line-height:1.6;}
.info-row{display:flex;justify-content:space-between;padding:9px 0;border-bottom:1px solid var(--border);font-size:12px;}
.info-row:last-child{border-bottom:none;}
.preview-card{background:var(--purple-bg);border:1px solid var(--purple-bd);border-radius:var(--r-md);padding:20px;text-align:center;}
.preview-avatar{width:56px;height:56px;border-radius:14px;background:var(--purple);color:#fff;display:flex;align-items:center;justify-content:center;font-size:22px;font-weight:800;margin:0 auto 12px;}
.preview-name{font-size:15px;font-weight:800;color:var(--purple);margin-bottom:4px;}
.preview-desc{font-size:12px;color:var(--text2);}
</style>

<div class="adm">
<form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
@csrf @method('PUT')

  <div class="adm-layout">

    <div>
      <div class="adm-card">
        <div class="adm-card-header">
          <div>
            <div class="adm-card-title">✏️ Edit Kategori</div>
            <div class="adm-card-sub">Perbarui informasi kategori <strong>{{ $category->name }}</strong></div>
          </div>
          <a href="{{ route('admin.categories.index') }}" class="btn-back">← Kembali</a>
        </div>
        <div class="adm-card-body">

          @if ($errors->any())
          <div style="background:var(--red-bg);border:1px solid var(--red-bd);border-radius:var(--r-sm);padding:14px 16px;margin-bottom:20px;font-size:13px;color:var(--red);">
            @foreach ($errors->all() as $error)<div>• {{ $error }}</div>@endforeach
          </div>
          @endif

          <div class="form-group">
            <label class="form-label">Nama Kategori <span class="req">*</span></label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}"
                   class="form-control" required
                   oninput="updatePreview(this.value)">
          </div>

          <div class="form-group">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control"
                      oninput="updateDesc(this.value)">{{ old('description', $category->description) }}</textarea>
          </div>

          <div style="display:flex;gap:10px;padding-top:4px;">
            <button type="submit" class="btn btn-success btn-lg">✓ Update Kategori</button>
            <a href="{{ route('admin.categories.index') }}" class="btn-back" style="font-size:13px;padding:12px 20px;">Batal</a>
          </div>

        </div>
      </div>
    </div>

    {{-- Sidebar --}}
    <div style="display:flex;flex-direction:column;gap:14px;">

      <div class="adm-card">
        <div class="adm-card-header">
          <div class="adm-card-title">👁 Preview</div>
        </div>
        <div class="adm-card-body">
          <div class="preview-card">
            <div class="preview-avatar" id="previewAvatar">{{ strtoupper(substr($category->name,0,1)) }}</div>
            <div class="preview-name" id="previewName">{{ $category->name }}</div>
            <div class="preview-desc" id="previewDesc">{{ $category->description ?: 'Tidak ada deskripsi' }}</div>
          </div>
        </div>
      </div>

      <div class="adm-card">
        <div class="adm-card-header">
          <div class="adm-card-title">📋 Info</div>
        </div>
        <div class="adm-card-body" style="padding:16px 20px;">
          <div class="info-row">
            <span style="color:var(--text3);font-weight:600;">ID</span>
            <span style="font-weight:700;">#{{ $category->id }}</span>
          </div>
          <div class="info-row">
            <span style="color:var(--text3);font-weight:600;">Dibuat</span>
            <span style="font-weight:700;">{{ $category->created_at?->format('d M Y') ?? '—' }}</span>
          </div>
          <div class="info-row">
            <span style="color:var(--text3);font-weight:600;">Total Menu</span>
            <span style="font-weight:700;">{{ $category->menus?->count() ?? 0 }} menu</span>
          </div>
        </div>
      </div>

    </div>

  </div>
</form>
</div>

<script>
function updatePreview(val) {
  const name = val.trim();
  document.getElementById('previewName').textContent = name || 'Nama Kategori';
  document.getElementById('previewAvatar').textContent = name ? name.charAt(0).toUpperCase() : '?';
}
function updateDesc(val) {
  document.getElementById('previewDesc').textContent = val.trim() || 'Tidak ada deskripsi';
}
</script>
@endsection
