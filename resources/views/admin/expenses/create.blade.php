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
.form-control::placeholder{color:var(--text3);}
textarea.form-control{resize:vertical;min-height:110px;line-height:1.6;}
.form-hint{font-size:11px;color:var(--text3);margin-top:5px;}
.preview-card{background:var(--purple-bg);border:1px solid var(--purple-bd);border-radius:var(--r-md);padding:20px;text-align:center;}
.preview-avatar{width:56px;height:56px;border-radius:14px;background:var(--purple);color:#fff;display:flex;align-items:center;justify-content:center;font-size:22px;font-weight:800;margin:0 auto 12px;}
.preview-name{font-size:15px;font-weight:800;color:var(--purple);margin-bottom:4px;}
.preview-desc{font-size:12px;color:var(--text2);}
</style>
<form action="{{ route('admin.expenses.store') }}" method="POST">
@csrf

<div class="w-full p-6 mx-auto">
  <div class="flex flex-wrap -mx-3">

    {{-- FORM KIRI --}}
    <div class="w-full md:w-8/12 px-3">
      <div class="bg-white shadow-xl rounded-2xl p-6">

        {{-- HEADER --}}
        <div class="flex items-center mb-6" style="padding-bottom:1rem; border-bottom:1px solid #f1f5f9;">
          <div>
            <h2 class="text-lg font-semibold">✨ Tambah Pengeluaran</h2>
            <p style="font-size:0.78rem; color:#94a3b8; margin-top:2px;">Catat pengeluaran operasional baru</p>
          </div>
          <a href="{{ route('admin.expenses.index') }}"
             class="ml-auto px-4 py-2 text-xs font-bold text-white bg-gray-500 rounded-lg btn-back">
            ← Kembali
          </a>
        </div>

        {{-- KATEGORI --}}
        <div class="w-full mb-4">
          <label class="block text-xs font-bold mb-1">Kategori <span style="color:red">*</span></label>
          <select name="expense_category_id" class="w-full px-3 py-2 border rounded-lg" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach($categories as $category)
              <option value="{{ $category->id }}" {{ old('expense_category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
              </option>
            @endforeach
          </select>
        </div>

        {{-- DESKRIPSI --}}
        <div class="w-full mb-4">
          <label class="block text-xs font-bold mb-1">Deskripsi <span style="color:red">*</span></label>
          <input type="text" name="description" value="{{ old('description') }}"
                 class="w-full px-3 py-2 border rounded-lg" required>
        </div>

        {{-- JUMLAH --}}
        <div class="w-full mb-4">
          <label class="block text-xs font-bold mb-1">Jumlah (Rp) <span style="color:red">*</span></label>
          <input type="number" step="1" name="amount" value="{{ old('amount') }}"
                 class="w-full px-3 py-2 border rounded-lg" required>
        </div>

        {{-- TANGGAL --}}
        <div class="w-full mb-4">
          <label class="block text-xs font-bold mb-1">Tanggal Pengeluaran <span style="color:red">*</span></label>
          <input type="date" name="expense_date" value="{{ old('expense_date') }}"
                 class="w-full px-3 py-2 border rounded-lg" required>
        </div>

        {{-- CATATAN --}}
        <div class="w-full mb-5">
          <label class="block text-xs font-bold mb-1">Catatan</label>
          <textarea name="notes" class="w-full px-3 py-2 border rounded-lg" rows="3">{{ old('notes') }}</textarea>
        </div>

        {{-- BUTTON --}}
    

         <div style="display:flex;gap:10px;padding-top:4px;">
            <button type="submit" class="btn btn-success btn-lg">✓ Simpan Kategori</button>
            <a href="{{ route('admin.expenses.index') }}" class="btn-back" style="font-size:13px;padding:12px 20px;">Batal</a>
          </div>

      </div>
    </div>

    {{-- TIPS KANAN --}}
    <div class="w-full md:w-4/12 px-3">
      <div class="bg-white shadow-xl rounded-2xl p-6">
        <p class="text-xs font-bold mb-4">💡 Tips</p>
        <div style="display:flex; flex-direction:column; gap:12px; font-size:0.78rem; color:#64748b;">
          <div style="display:flex; gap:8px;">
            <span style="color:#7c3aed;">•</span>
            <p>Pilih kategori yang sesuai agar laporan keuangan lebih terstruktur.</p>
          </div>
          <div style="display:flex; gap:8px;">
            <span style="color:#7c3aed;">•</span>
            <p>Isi deskripsi dengan jelas agar mudah diidentifikasi.</p>
          </div>
          <div style="display:flex; gap:8px;">
            <span style="color:#7c3aed;">•</span>
            <p>Gunakan catatan untuk info tambahan seperti nama supplier atau nomor invoice.</p>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

</form>
@endsection
