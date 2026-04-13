@extends('layouts.backend')
@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
:root{--font:'Plus Jakarta Sans',sans-serif;--surface:#fff;--surface2:#f9f8f5;--surface3:#f2f1ec;--border:rgba(0,0,0,0.07);--border-md:rgba(0,0,0,0.12);--text1:#141210;--text2:#6a6760;--text3:#a9a59d;--green:#1a7f5a;--green-bg:#eafaf3;--green-bd:#c6f0de;--purple:#5b3fbe;--purple-bg:#f0eeff;--purple-bd:#d5ceff;--red:#c02828;--shadow-sm:0 2px 8px rgba(0,0,0,0.07),0 0 0 1px rgba(0,0,0,0.04);--r-sm:10px;--r-md:14px;--r-lg:20px;}
*{box-sizing:border-box;}
.adm{font-family:var(--font);color:var(--text1);}
.adm-layout{display:grid;grid-template-columns:1fr 300px;gap:20px;align-items:start;}
@media(max-width:900px){.adm-layout{grid-template-columns:1fr;}}
.adm-card{background:var(--surface);border-radius:var(--r-lg);border:1px solid var(--border);box-shadow:var(--shadow-sm);overflow:hidden;}
.adm-card-header{padding:20px 24px 18px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;}
.adm-card-title{font-size:15px;font-weight:700;color:var(--text1);margin:0;}
.adm-card-sub{font-size:12px;color:var(--text3);margin-top:3px;}
.adm-card-body{padding:24px;}
.btn{display:inline-flex;align-items:center;gap:7px;font-family:var(--font);font-size:12px;font-weight:700;padding:9px 18px;border-radius:var(--r-sm);border:none;cursor:pointer;text-decoration:none;transition:filter .15s,transform .12s;white-space:nowrap;line-height:1;}
.btn:hover{filter:brightness(1.06);transform:translateY(-1px);}
.btn-primary{background:var(--purple);color:#fff;}
.btn-success{background:var(--green);color:#fff;}
.btn-back{display:inline-flex;align-items:center;gap:6px;font-family:var(--font);font-size:12px;font-weight:700;color:var(--text2);text-decoration:none;background:var(--surface2);border:1px solid var(--border-md);padding:8px 16px;border-radius:var(--r-sm);transition:background .15s;}
.btn-back:hover{background:var(--surface3);color:var(--text1);}
.detail-row{display:flex;padding:13px 0;border-bottom:1px solid var(--border);align-items:flex-start;gap:16px;}
.detail-row:last-child{border-bottom:none;}
.detail-key{font-size:12px;font-weight:700;color:var(--text3);min-width:130px;flex-shrink:0;}
.detail-val{font-size:13px;font-weight:600;color:var(--text1);}
.badge{display:inline-flex;align-items:center;gap:4px;padding:3px 10px;border-radius:99px;font-family:var(--font);font-size:10px;font-weight:800;white-space:nowrap;}
.badge-purple{background:var(--purple-bg);color:var(--purple);border:1px solid var(--purple-bd);}
.badge-green{background:var(--green-bg);color:var(--green);border:1px solid var(--green-bd);}
.menu-hero{width:100%;border-radius:var(--r-md);object-fit:cover;max-height:280px;border:1px solid var(--border);display:block;}
.no-image{width:100%;height:180px;background:var(--surface2);border-radius:var(--r-md);border:1px dashed var(--border-md);display:flex;flex-direction:column;align-items:center;justify-content:center;color:var(--text3);}
.stat-box{background:var(--surface2);border-radius:var(--r-md);padding:16px;text-align:center;border:1px solid var(--border);}
.stat-box .sv{font-size:1.4rem;font-weight:800;color:var(--text1);}
.stat-box .sl{font-size:11px;font-weight:700;color:var(--text3);text-transform:uppercase;letter-spacing:.5px;margin-top:4px;}
.desc-block{background:var(--surface2);border:1px solid var(--border);border-radius:var(--r-sm);padding:14px 16px;font-size:13px;color:var(--text2);line-height:1.7;}
</style>

<div class="adm">
  <div class="adm-layout">

    {{-- MAIN --}}
    <div>
      <div class="adm-card">
        <div class="adm-card-header">
          <div>
            <div class="adm-card-title">🍽️ {{ $menu->name }}</div>
            <div class="adm-card-sub">
              @if($menu->category)
                <span class="badge badge-purple">{{ $menu->category->name }}</span>
              @endif
              <span style="margin-left:8px;">Detail lengkap menu</span>
            </div>
          </div>
          <div style="display:flex;gap:8px;flex-wrap:wrap;">
            <a href="{{ route('admin.menus.edit', $menu->id) }}" class="btn btn-primary">✏️ Edit</a>
            <a href="{{ route('admin.menus.index') }}" class="btn-back">← Kembali</a>
          </div>
        </div>
        <div class="adm-card-body">

          {{-- Stats row --}}
          <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:14px;margin-bottom:24px;">
            <div class="stat-box">
              <div class="sv" style="color:var(--green);">Rp {{ number_format($menu->price,0,',','.') }}</div>
              <div class="sl">Harga per porsi</div>
            </div>
            <div class="stat-box">
              <div class="sv">{{ $menu->min_order }}</div>
              <div class="sl">Min. Order</div>
            </div>
            <div class="stat-box">
              <div class="sv">{{ $menu->max_order }}</div>
              <div class="sl">Max. Order</div>
            </div>
          </div>

          {{-- Detail rows --}}
          <div class="detail-row">
            <div class="detail-key">ID Menu</div>
            <div class="detail-val">#{{ $menu->id }}</div>
          </div>
          <div class="detail-row">
            <div class="detail-key">Nama Menu</div>
            <div class="detail-val">{{ $menu->name }}</div>
          </div>
          <div class="detail-row">
            <div class="detail-key">Kategori</div>
            <div class="detail-val">
              @if($menu->category)
                <span class="badge badge-purple">{{ $menu->category->name }}</span>
              @else <span style="color:var(--text3);">—</span>
              @endif
            </div>
          </div>
          <div class="detail-row">
            <div class="detail-key">Deskripsi</div>
            <div class="detail-val">
              @if($menu->description)
                <div class="desc-block">{{ $menu->description }}</div>
              @else <span style="color:var(--text3);">Tidak ada deskripsi</span>
              @endif
            </div>
          </div>
          <div class="detail-row">
            <div class="detail-key">Dibuat</div>
            <div class="detail-val">{{ $menu->created_at?->format('d F Y, H:i') ?? '—' }}</div>
          </div>
          <div class="detail-row">
            <div class="detail-key">Diperbarui</div>
            <div class="detail-val">{{ $menu->updated_at?->format('d F Y, H:i') ?? '—' }}</div>
          </div>

        </div>
      </div>
    </div>

    {{-- SIDEBAR: photo --}}
    <div>
      <div class="adm-card">
        <div class="adm-card-header">
          <div class="adm-card-title">📷 Foto Menu</div>
        </div>
        <div class="adm-card-body">
          @if ($menu->image)
            <img src="{{ asset('storage/'.$menu->image) }}" class="menu-hero" alt="{{ $menu->name }}">
            <div style="margin-top:12px;font-size:11px;color:var(--text3);text-align:center;">
              Foto terakhir diperbarui {{ $menu->updated_at?->diffForHumans() ?? '' }}
            </div>
          @else
            <div class="no-image">
              <span style="font-size:32px;margin-bottom:8px;">🍴</span>
              <span style="font-size:12px;font-weight:600;">Belum ada foto</span>
            </div>
          @endif

          <a href="{{ route('admin.menus.edit', $menu->id) }}"
             class="btn btn-primary" style="width:100%;justify-content:center;margin-top:14px;">
            ✏️ Edit Menu Ini
          </a>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection
