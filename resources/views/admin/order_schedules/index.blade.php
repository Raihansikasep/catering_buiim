@extends('layouts.backend')

@section('content')

<style>
/* COPY FULL DARI CATEGORIES (JANGAN DIUBAH) */
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
:root{--font:'Plus Jakarta Sans',sans-serif;--surface:#fff;--surface2:#f9f8f5;--surface3:#f2f1ec;--border:rgba(0,0,0,0.07);--border-md:rgba(0,0,0,0.12);--text1:#141210;--text2:#6a6760;--text3:#a9a59d;--green:#1a7f5a;--green-bg:#eafaf3;--green-bd:#c6f0de;--purple:#5b3fbe;--purple-bg:#f0eeff;--purple-bd:#d5ceff;--red:#c02828;--red-bg:#fff0f0;--red-bd:#fecaca;--shadow-sm:0 2px 8px rgba(0,0,0,0.07),0 0 0 1px rgba(0,0,0,0.04);--r-sm:10px;--r-md:14px;--r-lg:20px;}
*{box-sizing:border-box;}
.adm{font-family:var(--font);color:var(--text1);}
.adm-card{background:var(--surface);border-radius:var(--r-lg);border:1px solid var(--border);box-shadow:var(--shadow-sm);overflow:hidden;}
.adm-card-header{padding:20px 24px 18px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap;}
.adm-card-title{font-size:15px;font-weight:700;color:var(--text1);margin:0;}
.adm-card-sub{font-size:12px;color:var(--text3);margin-top:3px;}
.btn{display:inline-flex;align-items:center;gap:7px;font-family:var(--font);font-size:12px;font-weight:700;padding:9px 18px;border-radius:var(--r-sm);border:none;cursor:pointer;text-decoration:none;transition:filter .15s,transform .12s;}
.btn:hover{filter:brightness(1.06);transform:translateY(-1px);}
.btn-primary{background:var(--purple);color:#fff;}
.btn-danger{background:var(--red);color:#fff;}
.btn-sm{font-size:11px;padding:6px 13px;}
.adm-table-wrap{overflow-x:auto;}
.adm-table{width:100%;border-collapse:collapse;}
.adm-table thead tr{background:var(--surface2);}
.adm-table th{padding:12px 16px;text-align:left;font-size:10px;font-weight:800;text-transform:uppercase;color:var(--text3);border-bottom:1px solid var(--border);}
.adm-table td{padding:14px 16px;border-bottom:1px solid var(--border);font-size:13px;}
.row-num{display:inline-flex;align-items:center;justify-content:center;width:24px;height:24px;border-radius:6px;background:var(--surface3);font-size:11px;font-weight:700;color:var(--text3);}
.action-group{display:flex;gap:6px;}
.badge{padding:4px 10px;border-radius:999px;font-size:11px;font-weight:700;}
.badge-belum{background:var(--surface2);color:var(--text2);}
.badge-proses{background:var(--purple-bg);color:var(--purple);}
.badge-selesai{background:var(--green-bg);color:var(--green);}
</style>

<div class="adm">
  <div class="adm-card">

    <div class="adm-card-header">
      <div>
        <div class="adm-card-title">📅 Order Schedule</div>
        <div class="adm-card-sub">Kelola jadwal order</div>
      </div>
      <a href="{{ route('admin.order-schedules.create') }}" class="btn btn-primary">
        + Tambah Schedule
      </a>
    </div>

    <div class="adm-table-wrap">
      <table class="adm-table">
        <thead>
          <tr>
            <th>No</th>
            <th>Customer</th>
            <th>Menu</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th style="text-align:center;">Aksi</th>
          </tr>
        </thead>

        <tbody>
          @forelse ($schedules as $schedule)
          <tr>
            <td><span class="row-num">{{ $loop->iteration }}</span></td>

            <td style="font-weight:700;">
              {{ $schedule->order->customer_name ?? '-' }}
            </td>

            <td style="font-size:12px;color:var(--text2);">
              {{ $schedule->order->variant->menu->name ?? '-' }}
              <br>
              <small>{{ $schedule->order->variant->name ?? '' }}</small>
            </td>

            <td>
              {{ \Carbon\Carbon::parse($schedule->schedule_date)->format('d M Y') }}
            </td>

            <td>
              <span class="badge
              {{ $schedule->status == 'belum' ? 'badge-belum' : '' }}
              {{ $schedule->status == 'sedang_diproses' ? 'badge-proses' : '' }}
              {{ $schedule->status == 'selesai' ? 'badge-selesai' : '' }}">
              {{ ucfirst(str_replace('_',' ',$schedule->status)) }}
              </span>
            </td>

            <td style="text-align:center;">
              <div class="action-group" style="justify-content:center;">
                <a href="{{ route('admin.order-schedules.edit', $schedule->id) }}"
                   class="btn btn-primary btn-sm">✏️ Edit</a>

                <form action="{{ route('admin.order-schedules.destroy', $schedule->id) }}" method="POST">
                  @csrf @method('DELETE')
                  <button class="btn btn-danger btn-sm">🗑 Hapus</button>
                </form>
              </div>
            </td>

          </tr>
          @empty
          <tr>
            <td colspan="6" style="text-align:center;padding:60px;color:var(--text3);">
              Belum ada schedule
            </td>
          </tr>
          @endforelse
        </tbody>

      </table>
    </div>

  </div>
</div>

@endsection
