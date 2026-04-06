@extends('layouts.backend')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
* { font-family: 'Plus Jakarta Sans', sans-serif; }

.show-page { padding: 28px 0 60px; }

.detail-card { background: #fff; border-radius: 18px; border: 1px solid #f1f5f9; padding: 22px 24px; margin-bottom: 16px; }
.card-section-title { font-size: 0.72rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.6px; margin-bottom: 14px; }

.detail-row { display: flex; justify-content: space-between; align-items: flex-start; padding: 9px 0; border-bottom: 1px solid #f8fafc; gap: 16px; }
.detail-row:last-child { border-bottom: none; }
.detail-label { font-size: 0.8rem; color: #94a3b8; font-weight: 500; flex-shrink: 0; }
.detail-value { font-size: 0.85rem; color: #0f172a; font-weight: 600; text-align: right; }

.proof-wrap { background: #f8fafc; border-radius: 12px; border: 1px solid #f1f5f9; overflow: hidden; }
.proof-img  { width: 100%; max-height: 380px; object-fit: contain; display: block; }
.proof-link { display: inline-block; margin-top: 10px; font-size: 0.78rem; color: #16a34a; font-weight: 600; text-decoration: none; }
.proof-link:hover { text-decoration: underline; }

.btn-back {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 8px 16px; border: 1.5px solid #e2e8f0; border-radius: 10px;
    background: #fff; font-size: 0.8rem; font-weight: 600; color: #475569;
    text-decoration: none; transition: all 0.15s;
}
.btn-back:hover { border-color: #16a34a; color: #16a34a; }

.status-pill { display: inline-flex; align-items: center; gap: 5px; padding: 5px 14px; border-radius: 20px; font-size: 0.78rem; font-weight: 700; }
.badge-pending   { background: #fffbeb; color: #b45309; border: 1px solid #fde68a; }
.badge-confirmed { background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; }
.badge-rejected  { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }

.btn-confirm-lg { padding: 12px 24px; background: #16a34a; color: #fff; border: none; border-radius: 12px; font-size: 0.88rem; font-weight: 700; cursor: pointer; transition: all 0.2s; }
.btn-confirm-lg:hover { background: #15803d; transform: translateY(-1px); }
.btn-reject-lg  { padding: 12px 24px; background: #fef2f2; color: #dc2626; border: 1.5px solid #fecaca; border-radius: 12px; font-size: 0.88rem; font-weight: 700; cursor: pointer; transition: all 0.2s; }
.btn-reject-lg:hover { background: #fee2e2; }

.reject-box { background: #fff; border-radius: 16px; border: 1.5px solid #fecaca; padding: 20px; margin-top: 16px; display: none; }
.reject-textarea { width: 100%; padding: 10px 14px; border: 1.5px solid #fecaca; border-radius: 10px; font-size: 0.85rem; outline: none; resize: none; font-family: inherit; margin-bottom: 12px; transition: border-color 0.15s; }
.reject-textarea:focus { border-color: #dc2626; }

.alert-ok  { background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 12px; padding: 12px 16px; font-size: 0.83rem; color: #166534; margin-bottom: 16px; display: flex; align-items: center; gap: 8px; }
.alert-err { background: #fef2f2; border: 1px solid #fecaca; border-radius: 12px; padding: 12px 16px; font-size: 0.83rem; color: #dc2626; margin-bottom: 16px; display: flex; align-items: center; gap: 8px; }

.addon-badge { display: inline-block; background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; border-radius: 20px; font-size: 0.72rem; padding: 2px 8px; margin: 2px 2px 0 0; }
</style>

<div class="container-fluid show-page">
<div class="row justify-content-center">
<div class="col-lg-8">

    {{-- Header --}}
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('admin.payments.index') }}" class="btn-back">← Kembali</a>
        <div class="flex-grow-1">
            <h5 style="font-weight:700;color:#0f172a;margin:0;">Detail Pembayaran</h5>
            <small style="color:#94a3b8;">#ORD-{{ str_pad($payment->order_id, 4, '0', STR_PAD_LEFT) }}</small>
        </div>
        @if($payment->isPending())
            <span class="status-pill badge-pending">Menunggu</span>
        @elseif($payment->isConfirmed())
            <span class="status-pill badge-confirmed">Dikonfirmasi</span>
        @else
            <span class="status-pill badge-rejected">Ditolak</span>
        @endif
    </div>

    {{-- Alerts --}}
    @if(session('success'))
    <div class="alert-ok"><span>✓</span> {{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="alert-err"><span>✕</span> {{ session('error') }}</div>
    @endif

    {{-- Info Pesanan --}}
    <div class="detail-card">
        <div class="card-section-title">Info Pesanan</div>
        <div class="detail-row">
            <span class="detail-label">Pelanggan</span>
            <span class="detail-value">{{ $payment->user->name }}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Email</span>
            <span class="detail-value">{{ $payment->user->email }}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Menu</span>
            <span class="detail-value">{{ $payment->order->variant->menu->name }}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Varian</span>
            <span class="detail-value">{{ $payment->order->variant->name_variant }} · {{ $payment->order->variant->name_item }}</span>
        </div>
        @if($payment->order->addons->count())
        <div class="detail-row">
            <span class="detail-label">Addon</span>
            <span class="detail-value">
                @foreach($payment->order->addons as $oa)
                    <span class="addon-badge">+ {{ $oa->addon->name }} (Rp {{ number_format($oa->price) }})</span>
                @endforeach
            </span>
        </div>
        @endif
        <div class="detail-row">
            <span class="detail-label">Jumlah</span>
            <span class="detail-value">{{ $payment->order->quantity }} porsi</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Total Order</span>
            <span class="detail-value" style="color:#16a34a;font-size:0.95rem;">
                Rp {{ number_format($payment->order->total_price, 0, ',', '.') }}
            </span>
        </div>
    </div>

    {{-- Info Transfer --}}
    <div class="detail-card">
        <div class="card-section-title">Info Transfer</div>
        <div class="detail-row">
            <span class="detail-label">Bank Pengirim</span>
            <span class="detail-value">{{ $payment->bank_name }}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Nama Rekening</span>
            <span class="detail-value">{{ $payment->account_name }}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">No. Rekening</span>
            <span class="detail-value" style="font-family:monospace;">{{ $payment->account_number }}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Nominal Transfer</span>
            <span class="detail-value" style="color:#16a34a;font-size:1rem;">
                Rp {{ number_format($payment->amount, 0, ',', '.') }}
            </span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Waktu Upload</span>
            <span class="detail-value">{{ $payment->created_at->translatedFormat('d M Y, H:i') }}</span>
        </div>
        @if($payment->isConfirmed())
        <div class="detail-row">
            <span class="detail-label">Dikonfirmasi Oleh</span>
            <span class="detail-value">
                {{ $payment->confirmedBy->name ?? '-' }}
                <span style="color:#94a3b8;font-weight:400;"> · {{ $payment->confirmed_at?->translatedFormat('d M Y, H:i') }}</span>
            </span>
        </div>
        @endif
        @if($payment->isRejected() && $payment->note)
        <div class="detail-row">
            <span class="detail-label">Alasan Tolak</span>
            <span class="detail-value" style="color:#dc2626;">{{ $payment->note }}</span>
        </div>
        @endif
    </div>

    {{-- Bukti Transfer --}}
    <div class="detail-card">
        <div class="card-section-title">Bukti Transfer</div>
        <div class="proof-wrap">
            <img src="{{ asset('storage/' . $payment->proof_image) }}" class="proof-img" alt="Bukti Transfer">
        </div>
        <a href="{{ asset('storage/' . $payment->proof_image) }}" target="_blank" class="proof-link">
            Buka gambar ukuran penuh
        </a>
    </div>

    {{-- Aksi --}}
    @if($payment->isPending())
    <div style="display:flex;gap:12px;flex-wrap:wrap;">
        <form action="{{ route('admin.payments.confirm', $payment->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn-confirm-lg"
                onclick="return confirm('Konfirmasi pembayaran ini? Status order akan berubah ke Sedang Diproses.')">
                Konfirmasi Pembayaran
            </button>
        </form>
        <button class="btn-reject-lg" onclick="document.getElementById('rejectBox').style.display='block'">
            Tolak Pembayaran
        </button>
    </div>

    <div id="rejectBox" class="reject-box">
        <p style="font-size:0.85rem;font-weight:700;color:#dc2626;margin-bottom:10px;">Alasan Penolakan</p>
        <form action="{{ route('admin.payments.reject', $payment->id) }}" method="POST">
            @csrf
            <textarea name="note" rows="3" required class="reject-textarea"
                placeholder="Contoh: Nominal tidak sesuai, bukti tidak jelas, gambar buram..."></textarea>
            <div style="display:flex;gap:10px;">
                <button type="button"
                    onclick="document.getElementById('rejectBox').style.display='none'"
                    style="flex:1;padding:10px;border:1.5px solid #e2e8f0;border-radius:10px;background:#fff;font-weight:600;font-size:0.85rem;cursor:pointer;color:#475569;">
                    Batal
                </button>
                <button type="submit"
                    style="flex:1;padding:10px;border:none;border-radius:10px;background:#dc2626;color:#fff;font-weight:700;font-size:0.85rem;cursor:pointer;">
                    Kirim Penolakan
                </button>
            </div>
        </form>
    </div>
    @endif

</div>
</div>
</div>
@endsection
