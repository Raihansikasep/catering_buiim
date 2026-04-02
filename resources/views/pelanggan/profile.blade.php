
Copy

@extends('layouts.frontend')
@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
* { font-family: 'Plus Jakarta Sans', sans-serif; }

.profile-page { background: #f7f8fa; min-height: 100vh; padding: 40px 0 80px; }

/* SIDEBAR */
.sidebar-card {
    background: #fff;
    border-radius: 24px;
    border: 1px solid #eee;
    padding: 32px 24px;
    text-align: center;
    position: sticky;
    top: 24px;
}
.avatar-wrap {
    width: 88px; height: 88px;
    border-radius: 50%;
    background: linear-gradient(135deg, #d1fae5, #a7f3d0);
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 16px;
    font-size: 2rem;
    font-weight: 700;
    color: #065f46;
    letter-spacing: -1px;
}
.sidebar-name { font-size: 1rem; font-weight: 700; color: #111; margin-bottom: 2px; }
.sidebar-email { font-size: 0.8rem; color: #999; margin-bottom: 20px; }

.sidebar-divider { border: none; border-top: 1px solid #f0f0f0; margin: 20px 0; }

.sidebar-nav-btn {
    display: flex;
    align-items: center;
    gap: 10px;
    width: 100%;
    padding: 11px 16px;
    border-radius: 12px;
    border: none;
    background: transparent;
    font-size: 0.88rem;
    font-weight: 500;
    color: #555;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.15s;
    margin-bottom: 4px;
}
.sidebar-nav-btn:hover { background: #f4f4f5; color: #111; }
.sidebar-nav-btn.active { background: #f0fdf4; color: #16a34a; font-weight: 600; }
.sidebar-nav-btn.danger { color: #dc2626; }
.sidebar-nav-btn.danger:hover { background: #fef2f2; }
.sidebar-nav-btn .nav-icon {
    width: 30px; height: 30px;
    border-radius: 8px;
    background: #f4f4f5;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.85rem;
    flex-shrink: 0;
}
.sidebar-nav-btn.active .nav-icon { background: #dcfce7; }
.sidebar-nav-btn.danger .nav-icon { background: #fee2e2; }

/* MAIN CONTENT */
.content-card {
    background: #fff;
    border-radius: 24px;
    border: 1px solid #eee;
    overflow: hidden;
}
.content-tabs {
    display: flex;
    gap: 4px;
    padding: 20px 24px 0;
    border-bottom: 1px solid #f0f0f0;
}
.tab-btn {
    padding: 10px 18px;
    border: none;
    background: transparent;
    font-size: 0.85rem;
    font-weight: 600;
    color: #999;
    cursor: pointer;
    border-bottom: 2.5px solid transparent;
    margin-bottom: -1px;
    transition: all 0.15s;
    border-radius: 0;
}
.tab-btn:hover { color: #333; }
.tab-btn.active { color: #16a34a; border-bottom-color: #16a34a; }

.tab-pane { display: none; padding: 28px 24px; }
.tab-pane.active { display: block; }

/* FORM */
.form-section-label {
    font-size: 0.78rem;
    font-weight: 700;
    color: #aaa;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    margin-bottom: 14px;
    margin-top: 4px;
}
.form-label { font-size: 0.82rem; font-weight: 600; color: #555; margin-bottom: 6px; }
.form-control {
    border-radius: 12px;
    border: 1.5px solid #e5e7eb;
    font-size: 0.88rem;
    padding: 10px 14px;
    color: #111;
    transition: border-color 0.15s, box-shadow 0.15s;
}
.form-control:focus {
    border-color: #16a34a;
    box-shadow: 0 0 0 3px rgba(22,163,74,0.1);
    outline: none;
}
.form-control:disabled { background: #f9fafb; color: #aaa; cursor: not-allowed; }

.btn-save {
    padding: 11px 28px;
    background: #16a34a;
    color: #fff;
    border: none;
    border-radius: 12px;
    font-size: 0.88rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
}
.btn-save:hover { background: #15803d; transform: translateY(-1px); }

/* ORDER LIST */
.order-item-card {
    border: 1.5px solid #f0f0f0;
    border-radius: 16px;
    padding: 16px 18px;
    margin-bottom: 12px;
    transition: border-color 0.15s;
}
.order-item-card:hover { border-color: #d1fae5; }
.order-id { font-size: 0.78rem; color: #aaa; margin-bottom: 4px; }
.order-name { font-size: 0.9rem; font-weight: 600; color: #111; }
.order-date { font-size: 0.78rem; color: #999; }
.order-total { font-size: 0.92rem; font-weight: 700; color: #16a34a; }
.status-badge {
    display: inline-block;
    padding: 3px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
}
.status-pending { background: #fffbeb; color: #92400e; }
.status-proses  { background: #eff6ff; color: #1d4ed8; }
.status-selesai { background: #f0fdf4; color: #166534; }
.status-batal   { background: #fef2f2; color: #b91c1c; }

.empty-tab {
    text-align: center;
    padding: 60px 20px;
    color: #bbb;
}
.empty-tab .empty-icon {
    width: 64px; height: 64px;
    background: #f4f4f5;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 14px;
    font-size: 1.6rem;
}
.empty-tab p { font-size: 0.85rem; margin: 0; }

/* Alert */
.alert-success-custom {
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    border-radius: 12px;
    padding: 12px 16px;
    font-size: 0.85rem;
    color: #166534;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 8px;
}

/* Toast */
.toast-notif {
    position: fixed;
    bottom: 28px; right: 28px;
    background: #111;
    color: #fff;
    padding: 12px 20px;
    border-radius: 14px;
    font-size: 0.85rem;
    font-weight: 500;
    z-index: 9999;
    opacity: 0;
    transform: translateY(10px);
    transition: all 0.3s;
    pointer-events: none;
}
.toast-notif.show { opacity: 1; transform: translateY(0); }
.toast-notif.success { background: #16a34a; }

@media (max-width: 991px) {
    .sidebar-card { position: static; margin-bottom: 16px; }
}
@media (max-width: 576px) {
    .tab-pane { padding: 20px 16px; }
    .content-tabs { padding: 16px 16px 0; overflow-x: auto; }
}
</style>

<div class="profile-page">
<div class="container">
<div class="row g-4">

    {{-- SIDEBAR --}}
    <div class="col-lg-4">
        <div class="sidebar-card">

            @php
                $initials = collect(explode(' ', auth()->user()->name))
                    ->take(2)->map(fn($w) => strtoupper($w[0]))->implode('');
            @endphp

            <div class="avatar-wrap">{{ $initials }}</div>
            <div class="sidebar-name">{{ auth()->user()->name }}</div>
            <div class="sidebar-email">{{ auth()->user()->email }}</div>

            <hr class="sidebar-divider">

            <button class="sidebar-nav-btn active" onclick="switchTab('info', this)">
                <span class="nav-icon">👤</span>
                Profil Saya
            </button>

            <button class="sidebar-nav-btn" onclick="switchTab('riwayat', this)">
                <span class="nav-icon">📦</span>
                Riwayat Pesanan
            </button>

            <a href="{{ route('my.orders') }}"
                   class="btn btn-outline-primary w-100 mb-2 rounded-pill">
                    Pesanan Saya
                </a>

            <hr class="sidebar-divider">

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="sidebar-nav-btn danger">
                    <span class="nav-icon">🚪</span>
                    Logout
                </button>
            </form>

        </div>
    </div>

    {{-- CONTENT --}}
    <div class="col-lg-8">
        <div class="content-card">

            <div class="content-tabs">
                <button class="tab-btn active" id="tab-info" onclick="switchTab('info', null)">Profil Saya</button>
                <button class="tab-btn" id="tab-riwayat" onclick="switchTab('riwayat', null)">Riwayat Pesanan</button>
            </div>

            {{-- TAB INFO --}}
            <div class="tab-pane active" id="pane-info">

                @if(session('success'))
                <div class="alert-success-custom">
                    <span>✓</span> {{ session('success') }}
                </div>
                @endif

                <div class="form-section-label">Informasi Akun</div>

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control"
                                   value="{{ auth()->user()->name }}"
                                   placeholder="Nama lengkap">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control"
                                   value="{{ auth()->user()->email }}" disabled>
                        </div>

                        <div class="col-12">
                            <label class="form-label">No HP / WhatsApp</label>
                            <input type="text" name="phone" class="form-control"
                                   value="{{ auth()->user()->phone }}"
                                   placeholder="08xxxxxxxxxx">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea name="address" class="form-control" rows="3"
                                      placeholder="Jl. Contoh No. 1, Kecamatan, Kota">{{ auth()->user()->address }}</textarea>
                        </div>

                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn-save">Simpan Perubahan</button>
                        </div>

                    </div>
                </form>

            </div>

            {{-- TAB RIWAYAT --}}
            <div class="tab-pane" id="pane-riwayat">

                <div class="form-section-label">Riwayat Pesanan</div>

                @if(isset($orders) && $orders->count())

                    @foreach($orders as $order)
                    <div class="order-item-card">
                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                            <div>
                                <div class="order-id">#{{ $order->order_number ?? $order->id }}</div>
                                <div class="order-name">
                                    {{ $order->items->first()->menu->name ?? 'Pesanan' }}
                                    @if($order->items->count() > 1)
                                        <span style="color:#aaa; font-weight:400;"> +{{ $order->items->count() - 1 }} lainnya</span>
                                    @endif
                                </div>
                                <div class="order-date mt-1">
                                    📅 {{ \Carbon\Carbon::parse($order->schedule_date)->translatedFormat('d F Y') }}
                                </div>
                            </div>
                            <div class="text-end">
                                <div class="order-total mb-1">Rp {{ number_format($order->total_price) }}</div>
                                <span class="status-badge
                                    @if($order->status == 'pending') status-pending
                                    @elseif(in_array($order->status, ['confirmed','processing'])) status-proses
                                    @elseif($order->status == 'completed') status-selesai
                                    @else status-batal
                                    @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    {{ $orders->links() }}

                @else
                <div class="empty-tab">
                    <div class="empty-icon">📦</div>
                    <p>Belum ada riwayat pesanan</p>
                </div>
                @endif

            </div>

        </div>
    </div>

</div>
</div>
</div>

<div class="toast-notif" id="toastNotif"></div>

<script>
function switchTab(name, sidebarBtn) {
    document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('.sidebar-nav-btn').forEach(b => b.classList.remove('active'));

    document.getElementById('pane-' + name).classList.add('active');
    document.getElementById('tab-' + name).classList.add('active');

    if (sidebarBtn) sidebarBtn.classList.add('active');
    else {
        document.querySelectorAll('.sidebar-nav-btn').forEach(b => {
            if (b.getAttribute('onclick')?.includes("'" + name + "'")) b.classList.add('active');
        });
    }
}

@if(session('success'))
const t = document.getElementById('toastNotif');
t.textContent = '{{ session('success') }}';
t.className = 'toast-notif success show';
setTimeout(() => t.classList.remove('show'), 3000);
@endif
</script>

@endsection
