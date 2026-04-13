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
<form action="{{ route('admin.expense-categories.update', $expenseCategory->id) }}" method="POST">
@csrf
@method('PUT')

<div class="w-full p-6 mx-auto">
  <div class="flex flex-wrap -mx-3">

    {{-- FORM KIRI --}}
    <div class="w-full md:w-7/12 px-3">
      <div class="bg-white shadow-xl rounded-2xl p-6">

        {{-- HEADER --}}
        <div class="flex items-center mb-6" style="padding-bottom:1rem; border-bottom:1px solid #f1f5f9;">
          <div>
            <h2 class="text-lg font-semibold">✏️ Edit Kategori Pengeluaran</h2>
            <p style="font-size:0.78rem; color:#94a3b8; margin-top:2px;">Perbarui informasi kategori <strong>{{ $expenseCategory->name }}</strong></p>
          </div>
          <a href="{{ route('admin.expense-categories.index') }}"
             class="ml-auto px-4 py-2 text-xs font-bold text-white bg-gray-500 rounded-lg btn-back">
            ← Kembali
          </a>
        </div>

        {{-- NAMA --}}
        <div class="w-full mb-4">
          <label class="block text-xs font-bold mb-1">
            Nama Kategori <span style="color:red">*</span>
          </label>
          <input type="text" name="name" id="input-name"
                 value="{{ old('name', $expenseCategory->name) }}"
                 class="w-full px-3 py-2 border rounded-lg" required>
        </div>

        {{-- DESKRIPSI --}}
        <div class="w-full mb-5">
          <label class="block text-xs font-bold mb-1">Deskripsi</label>
          <textarea name="description" rows="4" id="input-desc"
                    class="w-full px-3 py-2 border rounded-lg">{{ old('description', $expenseCategory->description) }}</textarea>
        </div>

        {{-- BUTTON --}}

        <div style="display:flex;gap:10px;padding-top:4px;">
            <button type="submit" class="btn btn-success btn-lg">✓ Update Kategori</button>
            <a href="{{ route('admin.expense-categories.index') }}" class="btn-back" style="font-size:13px;padding:12px 20px;">Batal</a>
          </div>

      </div>
    </div>

    {{-- PREVIEW + INFO KANAN --}}
    <div class="w-full md:w-5/12 px-3">
      <div class="bg-white shadow-xl rounded-2xl p-6">

        <p class="text-xs font-bold mb-4">👁️ Preview</p>

        <div style="background:#f5f3ff; border-radius:12px; padding:20px; text-align:center; margin-bottom:16px;">
          <div id="preview-icon"
               style="width:48px; height:48px; border-radius:12px; background:linear-gradient(135deg,#7c3aed,#ec4899); display:flex; align-items:center; justify-content:center; color:white; font-weight:bold; font-size:1.2rem; margin:0 auto 10px;">
            {{ strtoupper(substr($expenseCategory->name, 0, 1)) }}
          </div>
          <p id="preview-name" style="font-weight:700; font-size:0.875rem; color:#7c3aed;">{{ $expenseCategory->name }}</p>
          <p id="preview-desc" style="font-size:0.75rem; color:#94a3b8; margin-top:4px;">{{ $expenseCategory->description ?? 'Tidak ada deskripsi' }}</p>
        </div>

        {{-- INFO --}}
        <div style="border-top:1px solid #f1f5f9; padding-top:16px;">
          <p class="text-xs font-bold mb-3">📋 Info</p>
          <div style="font-size:0.78rem; display:flex; flex-direction:column; gap:8px;">
            <div style="display:flex; justify-content:space-between;">
              <span style="color:#94a3b8;">ID</span>
              <span style="font-weight:600;">#{{ $expenseCategory->id }}</span>
            </div>
            <div style="display:flex; justify-content:space-between;">
              <span style="color:#94a3b8;">Dibuat</span>
              <span style="font-weight:600;">{{ $expenseCategory->created_at->format('d M Y') }}</span>
            </div>
          </div>
        </div>

      </div>
    </div>

  </div>
</div>

</form>

<script>
document.getElementById('input-name').addEventListener('input', function() {
  const v = this.value.trim();
  document.getElementById('preview-name').textContent = v || 'Nama Kategori';
  document.getElementById('preview-icon').textContent = v ? v.charAt(0).toUpperCase() : '?';
});
document.getElementById('input-desc').addEventListener('input', function() {
  const v = this.value.trim();
  document.getElementById('preview-desc').textContent = v || 'Tidak ada deskripsi';
});
</script>

@endsection
