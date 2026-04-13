@extends('layouts.backend')
@section('content')

<style>
/* COPY FULL STYLE DARI CATEGORIES */
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
:root{--font:'Plus Jakarta Sans',sans-serif;--surface:#fff;--surface2:#f9f8f5;--surface3:#f2f1ec;--border:rgba(0,0,0,0.07);--border-md:rgba(0,0,0,0.12);--text1:#141210;--text2:#6a6760;--text3:#a9a59d;--green:#1a7f5a;--green-bg:#eafaf3;--green-bd:#c6f0de;--purple:#5b3fbe;--purple-bg:#f0eeff;--purple-bd:#d5ceff;--red:#c02828;--red-bg:#fff0f0;--red-bd:#fecaca;--shadow-sm:0 2px 8px rgba(0,0,0,0.07),0 0 0 1px rgba(0,0,0,0.04);--r-sm:10px;--r-md:14px;--r-lg:20px;}
*{box-sizing:border-box;}
.adm{font-family:var(--font);color:var(--text1);}
.adm-layout{display:grid;grid-template-columns:1fr 300px;gap:20px;}
@media(max-width:860px){.adm-layout{grid-template-columns:1fr;}}
.adm-card{background:var(--surface);border-radius:var(--r-lg);border:1px solid var(--border);box-shadow:var(--shadow-sm);}
.adm-card-header{padding:20px 24px;border-bottom:1px solid var(--border);display:flex;justify-content:space-between;}
.adm-card-title{font-weight:700;}
.adm-card-sub{font-size:12px;color:var(--text3);}
.adm-card-body{padding:24px;}
.form-group{margin-bottom:20px;}
.form-label{font-size:12px;font-weight:700;color:var(--text2);}
.form-control{width:100%;padding:10px;border:1px solid var(--border-md);border-radius:var(--r-sm);}
.btn{padding:10px 18px;border-radius:var(--r-sm);font-size:12px;font-weight:700;text-decoration:none;}
.btn-success{background:var(--green);color:white;}
.btn-back{background:var(--surface2);padding:8px 16px;border-radius:var(--r-sm);}
</style>

<div class="adm">
<form action="{{ route('admin.order-schedules.store') }}" method="POST">
@csrf

<div class="adm-layout">

{{-- FORM --}}
<div class="adm-card">
<div class="adm-card-header">
<div>
<div class="adm-card-title">📅 Tambah Order Schedule</div>
<div class="adm-card-sub">Tambahkan jadwal order</div>
</div>
<a href="{{ route('admin.order-schedules.index') }}" class="btn-back">← Kembali</a>
</div>

<div class="adm-card-body">

<div class="form-group">
<label class="form-label">Order</label>
<select name="order_id" class="form-control" required>
<option value="">-- Pilih Order --</option>
@foreach($orders as $order)
<option value="{{ $order->id }}">
{{ $order->customer_name }} - {{ $order->variant->menu->name ?? '-' }}
</option>
@endforeach
</select>
</div>

<div class="form-group">
<label class="form-label">Tanggal Acara</label>
<input type="date" name="schedule_date" class="form-control" required>
</div>

<div class="form-group">
<label class="form-label">Status</label>
<select name="status" class="form-control">
<option value="belum">Belum</option>
<option value="sedang_diproses">Sedang Diproses</option>
<option value="selesai">Selesai</option>
</select>
</div>

<div style="display:flex;gap:10px;">
<button class="btn btn-success">✓ Simpan</button>
<a href="{{ route('admin.order-schedules.index') }}" class="btn-back">Batal</a>
</div>

</div>
</div>

{{-- SIDEBAR --}}
<div class="adm-card">
<div class="adm-card-header">
<div class="adm-card-title">Info</div>
</div>
<div class="adm-card-body">
<p style="font-size:12px;color:var(--text3);">
Isi schedule sesuai tanggal acara customer.
</p>
</div>
</div>

</div>
</form>
</div>

@endsection
