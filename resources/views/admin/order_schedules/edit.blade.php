@extends('layouts.backend')
@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

:root{
--font:'Plus Jakarta Sans',sans-serif;
--surface:#fff;
--surface2:#f9f8f5;
--surface3:#f2f1ec;
--border:rgba(0,0,0,0.07);
--border-md:rgba(0,0,0,0.12);
--text1:#141210;
--text2:#6a6760;
--text3:#a9a59d;
--green:#1a7f5a;
--green-bg:#eafaf3;
--green-bd:#c6f0de;
--purple:#5b3fbe;
--purple-bg:#f0eeff;
--purple-bd:#d5ceff;
--red:#c02828;
--red-bg:#fff0f0;
--red-bd:#fecaca;
--shadow-sm:0 2px 8px rgba(0,0,0,0.07),0 0 0 1px rgba(0,0,0,0.04);
--r-sm:10px;
--r-md:14px;
--r-lg:20px;
}

*{box-sizing:border-box;}

.adm{font-family:var(--font);color:var(--text1);}

.adm-layout{
display:grid;
grid-template-columns:1fr 300px;
gap:20px;
align-items:start;
}

@media(max-width:860px){
.adm-layout{grid-template-columns:1fr;}
}

.adm-card{
background:var(--surface);
border-radius:var(--r-lg);
border:1px solid var(--border);
box-shadow:var(--shadow-sm);
overflow:hidden;
}

.adm-card-header{
padding:20px 24px 18px;
border-bottom:1px solid var(--border);
display:flex;
align-items:center;
justify-content:space-between;
gap:12px;
}

.adm-card-title{
font-size:15px;
font-weight:700;
margin:0;
}

.adm-card-sub{
font-size:12px;
color:var(--text3);
margin-top:3px;
}

.adm-card-body{padding:24px;}

.btn{
display:inline-flex;
align-items:center;
gap:7px;
font-size:12px;
font-weight:700;
padding:9px 18px;
border-radius:var(--r-sm);
text-decoration:none;
cursor:pointer;
}

.btn-success{background:var(--green);color:#fff;}

.btn-back{
font-size:12px;
font-weight:700;
color:var(--text2);
background:var(--surface2);
border:1px solid var(--border-md);
padding:8px 16px;
border-radius:var(--r-sm);
text-decoration:none;
}

.form-group{margin-bottom:20px;}

.form-label{
display:block;
margin-bottom:7px;
font-size:12px;
font-weight:700;
color:var(--text2);
}

.form-control{
width:100%;
font-size:13px;
border:1px solid var(--border-md);
border-radius:var(--r-sm);
padding:10px 14px;
}

</style>

<div class="adm">
<form action="{{ route('admin.order-schedules.update', $orderSchedule) }}" method="POST">
@csrf
@method('PUT')

<div class="adm-layout">

{{-- FORM --}}
<div class="adm-card">
<div class="adm-card-header">
<div>
<div class="adm-card-title">✏️ Edit Order Schedule</div>
<div class="adm-card-sub">Perbarui jadwal order</div>
</div>
<a href="{{ route('admin.order-schedules.index') }}" class="btn-back">← Kembali</a>
</div>

<div class="adm-card-body">

<div class="form-group">
<label class="form-label">Order</label>
<select name="order_id" class="form-control">
@foreach($orders as $order)
<option value="{{ $order->id }}"
{{ $orderSchedule->order_id == $order->id ? 'selected' : '' }}>
{{ $order->customer_name }} - {{ $order->variant->menu->name ?? '-' }}
</option>
@endforeach
</select>
</div>

<div class="form-group">
<label class="form-label">Tanggal Acara</label>
<input type="date" name="schedule_date"
value="{{ old('schedule_date', $orderSchedule->schedule_date) }}"
class="form-control">
</div>

<div class="form-group">
<label class="form-label">Status</label>
<select name="status" class="form-control">
@foreach(['belum','sedang_diproses','selesai'] as $status)
<option value="{{ $status }}"
{{ $orderSchedule->status == $status ? 'selected' : '' }}>
{{ ucfirst(str_replace('_',' ',$status)) }}
</option>
@endforeach
</select>
</div>

<div style="display:flex;gap:10px;">
<button type="submit" class="btn btn-success">✓ Update</button>
<a href="{{ route('admin.order-schedules.index') }}" class="btn-back">Batal</a>
</div>

</div>
</div>

{{-- SIDEBAR --}}
<div class="adm-card">
<div class="adm-card-header">
<div class="adm-card-title">📋 Info</div>
</div>

<div class="adm-card-body" style="font-size:12px;">

<div style="margin-bottom:10px;">
<b>Customer:</b><br>
{{ $orderSchedule->order->customer_name ?? '-' }}
</div>

<div>
<b>Tanggal:</b><br>
{{ \Carbon\Carbon::parse($orderSchedule->schedule_date)->format('d M Y') }}
</div>

</div>
</div>

</div>
</form>
</div>

@endsection
