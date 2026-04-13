@extends('layouts.backend')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
:root{--font:'Plus Jakarta Sans',sans-serif;--surface:#fff;--surface2:#f9f8f5;--surface3:#f2f1ec;--border:rgba(0,0,0,0.07);--border-md:rgba(0,0,0,0.12);--text1:#141210;--text2:#6a6760;--text3:#a9a59d;--green:#1a7f5a;--green-bg:#eafaf3;--green-bd:#c6f0de;--purple:#5b3fbe;--purple-bg:#f0eeff;--purple-bd:#d5ceff;--red:#c02828;--red-bg:#fff0f0;--red-bd:#fecaca;--shadow-sm:0 2px 8px rgba(0,0,0,0.07),0 0 0 1px rgba(0,0,0,0.04);--r-sm:10px;--r-md:14px;--r-lg:20px;}
*{box-sizing:border-box;}
.adm{font-family:var(--font);color:var(--text1);}
.adm-layout{display:grid;grid-template-columns:1fr 340px;gap:20px;align-items:start;}
@media(max-width:900px){.adm-layout{grid-template-columns:1fr;}}
.adm-card{background:var(--surface);border-radius:var(--r-lg);border:1px solid var(--border);box-shadow:var(--shadow-sm);overflow:hidden;}
.adm-card-header{padding:20px 24px 18px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;gap:12px;}
.adm-card-title{font-size:15px;font-weight:700;color:var(--text1);margin:0;}
.adm-card-sub{font-size:12px;color:var(--text3);margin-top:3px;}
.adm-card-body{padding:24px;}
.btn{display:inline-flex;align-items:center;gap:7px;font-family:var(--font);font-size:12px;font-weight:700;padding:9px 18px;border-radius:var(--r-sm);border:none;cursor:pointer;text-decoration:none;transition:filter .15s,transform .12s;white-space:nowrap;line-height:1;}
.btn:hover{filter:brightness(1.06);transform:translateY(-1px);}
.btn-primary{background:var(--purple);color:#fff;}
.btn-success{background:var(--green);color:#fff;}
.btn-lg{font-size:13px;padding:12px 24px;}
.btn-back{display:inline-flex;align-items:center;gap:6px;font-family:var(--font);font-size:12px;font-weight:700;color:var(--text2);text-decoration:none;background:var(--surface2);border:1px solid var(--border-md);padding:8px 16px;border-radius:var(--r-sm);transition:background .15s;}
.btn-back:hover{background:var(--surface3);color:var(--text1);}
.form-group{margin-bottom:20px;}
.form-label{display:block;margin-bottom:7px;font-size:12px;font-weight:700;color:var(--text2);letter-spacing:.2px;}
.form-label .req{color:var(--red);margin-left:2px;}
.form-control{display:block;width:100%;font-family:var(--font);font-size:13px;color:var(--text1);background:var(--surface);border:1px solid var(--border-md);border-radius:var(--r-sm);padding:10px 14px;outline:none;transition:border-color .15s,box-shadow .15s;appearance:none;}
.form-control:focus{border-color:var(--purple);box-shadow:0 0 0 3px rgba(91,63,190,0.12);}
.form-control::placeholder{color:var(--text3);}
textarea.form-control{resize:vertical;min-height:110px;line-height:1.6;}
select.form-control{background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%23a9a59d' stroke-width='2.5'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 12px center;padding-right:36px;}
.form-hint{font-size:11px;color:var(--text3);margin-top:5px;}
.grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
@media(max-width:600px){.grid-2{grid-template-columns:1fr;}}
.file-wrap{position:relative;border:1.5px dashed var(--border-md);border-radius:var(--r-sm);padding:28px 20px;text-align:center;cursor:pointer;transition:border-color .15s,background .15s;background:var(--surface2);}
.file-wrap:hover{border-color:var(--purple);background:var(--purple-bg);}
.file-wrap input[type="file"]{position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%;}
.section-divider{font-size:11px;font-weight:800;text-transform:uppercase;letter-spacing:1px;color:var(--text3);padding-bottom:12px;border-bottom:1px solid var(--border);margin-bottom:20px;}
.preview-img{width:100%;border-radius:var(--r-md);border:1px solid var(--border);display:none;margin-top:12px;object-fit:cover;max-height:200px;}
.tip-card{background:var(--surface2);border:1px solid var(--border);border-radius:var(--r-md);padding:16px;margin-bottom:14px;}
.tip-card .tip-title{font-size:12px;font-weight:700;color:var(--text2);margin-bottom:8px;}
.tip-item{display:flex;align-items:flex-start;gap:8px;font-size:12px;color:var(--text2);margin-bottom:6px;}
.tip-item:last-child{margin-bottom:0;}
.tip-dot{width:5px;height:5px;border-radius:50%;background:var(--purple);flex-shrink:0;margin-top:5px;}
</style>

<div class="adm">
<form action="{{ route('admin.menus.store') }}" method="POST" enctype="multipart/form-data">
@csrf

  <div class="adm-layout">

    {{-- MAIN FORM --}}
    <div>
      <div class="adm-card">
        <div class="adm-card-header">
          <div>
            <div class="adm-card-title">✨ Tambah Menu Baru</div>
            <div class="adm-card-sub">Isi detail menu yang akan ditambahkan</div>
          </div>
          <a href="{{ route('admin.menus.index') }}" class="btn-back">← Kembali</a>
        </div>
        <div class="adm-card-body">

          {{-- Validation errors --}}
          @if ($errors->any())
          <div style="background:var(--red-bg);border:1px solid var(--red-bd);border-radius:var(--r-sm);padding:14px 16px;margin-bottom:20px;font-size:13px;color:var(--red);">
            <strong>Terdapat kesalahan:</strong>
            <ul style="margin:8px 0 0 16px;padding:0;">
              @foreach ($errors->all() as $error)
                <li style="margin-bottom:2px;">{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          <div class="section-divider">Informasi Dasar</div>

          <div class="grid-2">
            <div class="form-group">
              <label class="form-label">Nama Menu <span class="req">*</span></label>
              <input type="text" name="name" value="{{ old('name') }}"
                     class="form-control" placeholder="cth: Nasi Tumpeng Kuning" required>
            </div>
            <div class="form-group">
              <label class="form-label">Kategori <span class="req">*</span></label>
              <select name="category_id" class="form-control" required>
                <option value="">— Pilih Kategori —</option>
                @foreach ($categories as $category)
                  <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Harga <span class="req">*</span></label>
            <div style="position:relative;">
              <span style="position:absolute;left:12px;top:50%;transform:translateY(-50%);font-size:12px;font-weight:700;color:var(--text3);">Rp</span>
              <input type="number" step="1000" name="price" value="{{ old('price') }}"
                     class="form-control" style="padding-left:36px;" placeholder="0" required>
            </div>
          </div>

          <div class="section-divider" style="margin-top:4px;">Kapasitas Pesanan</div>

          <div class="grid-2">
            <div class="form-group">
              <label class="form-label">Minimum Order <span class="req">*</span></label>
              <input type="number" name="min_order" value="{{ old('min_order', 1) }}"
                     min="1" class="form-control" required>
              <div class="form-hint">Minimum porsi yang bisa dipesan</div>
            </div>
            <div class="form-group">
              <label class="form-label">Maximum Order <span class="req">*</span></label>
              <input type="number" name="max_order" value="{{ old('max_order') }}"
                     min="1" class="form-control" required>
              <div class="form-hint">Batas maksimum porsi per pesanan</div>
            </div>
          </div>

          <div class="section-divider" style="margin-top:4px;">Deskripsi & Foto</div>

          <div class="form-group">
            <label class="form-label">Deskripsi Menu</label>
            <textarea name="description" class="form-control"
                      placeholder="Tulis deskripsi menu, bahan-bahan, atau catatan penting...">{{ old('description') }}</textarea>
          </div>

          <div class="form-group">
            <label class="form-label">Foto Menu</label>
            <div class="file-wrap">
              <input type="file" name="image" accept="image/*" id="imgInput">
              <span style="font-size:28px;display:block;margin-bottom:8px;">📷</span>
              <div style="font-size:13px;font-weight:700;color:var(--text2);">Klik atau drag foto ke sini</div>
              <div style="font-size:11px;color:var(--text3);margin-top:4px;">PNG, JPG, WEBP — maks. 2MB</div>
            </div>
            <img id="imgPreview" class="preview-img" alt="Preview">
          </div>

          <div style="display:flex;gap:10px;padding-top:4px;">
            <button type="submit" class="btn btn-success btn-lg">✓ Simpan Menu</button>
            <a href="{{ route('admin.menus.index') }}" class="btn btn-back" style="font-size:13px;padding:12px 20px;">Batal</a>
          </div>

        </div>
      </div>
    </div>

    {{-- SIDEBAR TIPS --}}
    <div>
      <div class="adm-card">
        <div class="adm-card-header">
          <div class="adm-card-title">💡 Tips Pengisian</div>
        </div>
        <div class="adm-card-body">
          <div class="tip-card">
            <div class="tip-title">📝 Nama Menu</div>
            <div class="tip-item"><span class="tip-dot"></span>Gunakan nama yang jelas & mudah diingat pelanggan</div>
            <div class="tip-item"><span class="tip-dot"></span>Cantumkan ukuran atau kapasitas jika relevan</div>
          </div>
          <div class="tip-card">
            <div class="tip-title">💰 Harga</div>
            <div class="tip-item"><span class="tip-dot"></span>Masukkan harga per porsi</div>
            <div class="tip-item"><span class="tip-dot"></span>Harga variannya bisa diatur terpisah di Menu Variant</div>
          </div>
          <div class="tip-card">
            <div class="tip-title">📷 Foto</div>
            <div class="tip-item"><span class="tip-dot"></span>Foto akan ditampilkan di halaman order pelanggan</div>
            <div class="tip-item"><span class="tip-dot"></span>Gunakan foto resolusi bagus agar tampil menarik</div>
          </div>
        </div>
      </div>
    </div>

  </div>
</form>
</div>

<script>
document.getElementById('imgInput').addEventListener('change', function() {
  const file = this.files[0];
  if (!file) return;
  const preview = document.getElementById('imgPreview');
  preview.src = URL.createObjectURL(file);
  preview.style.display = 'block';
});
</script>
@endsection
