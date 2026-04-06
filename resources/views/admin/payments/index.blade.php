@extends('layouts.backend')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
* { font-family: 'Plus Jakarta Sans', sans-serif; }

.pay-page { padding: 28px 0 60px; }

.page-title { font-size: 1.25rem; font-weight: 700; color: #0f172a; margin: 0 0 2px; }
.page-sub   { font-size: 0.82rem; color: #94a3b8; margin: 0; }

.stat-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; margin-bottom: 24px; }
.stat-card {
    background: #fff; border-radius: 16px; border: 1px solid #f1f5f9;
    padding: 18px 20px; display: flex; align-items: center; gap: 14px;
}
.stat-icon { width: 42px; height: 42px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; flex-shrink: 0; }
.stat-label { font-size: 0.75rem; color: #94a3b8; font-weight: 600; margin-bottom: 2px; }
.stat-num   { font-size: 1.4rem; font-weight: 700; line-height: 1; }

.filter-bar { display: flex; gap: 6px; margin-bottom: 20px; flex-wrap: wrap; }
.filter-tab {
    padding: 7px 18px; border-radius: 30px; border: 1.5px solid #e2e8f0;
    background: #fff; font-size: 0.78rem; font-weight: 600; color: #64748b;
    text-decoration: none; transition: all 0.15s;
}
.filter-tab:hover  { border-color: #16a34a; color: #16a34a; }
.filter-tab.active { background: #16a34a; border-color: #16a34a; color: #fff; }

.table-wrap { background: #fff; border-radius: 18px; border: 1px solid #f1f5f9; overflow: hidden; }
.pay-table  { width: 100%; border-collapse: collapse; }
.pay-table th {
    font-size: 0.72rem; font-weight: 700; color: #94a3b8; text-transform: uppercase;
    letter-spacing: 0.5px; padding: 13px 16px; background: #f8fafc;
    border-bottom: 1px solid #f1f5f9; text-align: left; white-space: nowrap;
}
.pay-table td { font-size: 0.84rem; padding: 14px 16px; border-bottom: 1px solid #f8fafc; color: #0f172a; vertical-align: middle; }
.pay-table tr:last-child td { border-bottom: none; }
.pay-table tr:hover td { background: #fafafa; }

.pay-badge { display: inline-flex; align-items: center; gap: 4px; padding: 4px 10px; border-radius: 20px; font-size: 0.72rem; font-weight: 700; }
.badge-pending   { background: #fffbeb; color: #b45309; border: 1px solid #fde68a; }
.badge-confirmed { background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; }
.badge-rejected  { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }

.btn-view    { padding: 5px 12px; background: #f8fafc; color: #475569; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 0.73rem; font-weight: 600; text-decoration: none; transition: all 0.15s; display: inline-block; }
.btn-view:hover { border-color: #16a34a; color: #16a34a; }
.btn-confirm { padding: 5px 12px; background: #16a34a; color: #fff; border: none; border-radius: 8px; font-size: 0.73rem; font-weight: 700; cursor: pointer; transition: all 0.15s; }
.btn-confirm:hover { background: #15803d; }
.btn-reject  { padding: 5px 12px; background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; border-radius: 8px; font-size: 0.73rem; font-weight: 700; cursor: pointer; transition: all 0.15s; }
.btn-reject:hover { background: #fee2e2; }

.alert-ok  { background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 12px; padding: 12px 16px; font-size: 0.83rem; color: #166534; margin-bottom: 20px; display: flex; align-items: center; gap: 8px; }
.alert-err { background: #fef2f2; border: 1px solid #fecaca; border-radius: 12px; padding: 12px 16px; font-size: 0.83rem; color: #dc2626; margin-bottom: 20px; display: flex; align-items: center; gap: 8px; }

/* Modal */
.modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.4); z-index: 9999; align-items: center; justify-content: center; }
.modal-box { background: #fff; border-radius: 20px; padding: 28px; width: 100%; max-width: 440px; margin: 20px; }
.modal-title { font-size: 1rem; font-weight: 700; color: #0f172a; margin-bottom: 6px; }
.modal-sub   { font-size: 0.82rem; color: #94a3b8; margin-bottom: 16px; }
.modal-textarea { width: 100%; padding: 10px 14px; border: 1.5px solid #e2e8f0; border-radius: 10px; font-size: 0.85rem; outline: none; resize: none; font-family: inherit; transition: border-color 0.15s; }
.modal-textarea:focus { border-color: #dc2626; }
.modal-actions { display: flex; gap: 10px; margin-top: 16px; }
.modal-cancel { flex: 1; padding: 11px; border: 1.5px solid #e2e8f0; border-radius: 10px; background: #fff; font-weight: 600; font-size: 0.85rem; cursor: pointer; color: #475569; transition: all 0.15s; }
.modal-cancel:hover { background: #f8fafc; }
.modal-reject-btn { flex: 1; padding: 11px; border: none; border-radius: 10px; background: #dc2626; color: #fff; font-weight: 700; font-size: 0.85rem; cursor: pointer; transition: all 0.15s; }
.modal-reject-btn:hover { background: #b91c1c; }

@media (max-width: 768px) {
    .stat-grid { grid-template-columns: 1fr; }
}
</style>

<div class="container-fluid pay-page">

    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
        <div>
            <h4 class="page-title">Manajemen Pembayaran</h4>
            <p class="page-sub">Review dan konfirmasi bukti transfer pelanggan</p>
        </div>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
    <div class="alert-ok"><span>✓</span> {{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="alert-err"><span>✕</span> {{ session('error') }}</div>
    @endif

    {{-- Stats --}}
    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background:#fffbeb;">⏳</div>
            <div>
                <div class="stat-label">Menunggu Konfirmasi</div>
                <div class="stat-num" style="color:#b45309">{{ $counts['pending'] }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#f0fdf4;">✓</div>
            <div>
                <div class="stat-label">Dikonfirmasi</div>
                <div class="stat-num" style="color:#16a34a">{{ $counts['confirmed'] }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#fef2f2;">✕</div>
            <div>
                <div class="stat-label">Ditolak</div>
                <div class="stat-num" style="color:#dc2626">{{ $counts['rejected'] }}</div>
            </div>
        </div>
    </div>

    {{-- Filter --}}
    <div class="filter-bar">
        <a href="?status=pending"   class="filter-tab {{ $status === 'pending'   ? 'active' : '' }}">Menunggu ({{ $counts['pending'] }})</a>
        <a href="?status=confirmed" class="filter-tab {{ $status === 'confirmed' ? 'active' : '' }}">Dikonfirmasi</a>
        <a href="?status=rejected"  class="filter-tab {{ $status === 'rejected'  ? 'active' : '' }}">Ditolak</a>
        <a href="?status=all"       class="filter-tab {{ $status === 'all'       ? 'active' : '' }}">Semua</a>
    </div>

    {{-- Table --}}
    <div class="table-wrap">
        <div style="overflow-x:auto">
            <table class="pay-table">
                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Pelanggan</th>
                        <th>Bank</th>
                        <th>Nominal</th>
                        <th>Waktu Upload</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $pay)
                    <tr>
                        <td>
                            <div style="font-weight:700;font-size:0.82rem;">#ORD-{{ str_pad($pay->order_id, 4, '0', STR_PAD_LEFT) }}</div>
                            <div style="font-size:0.73rem;color:#94a3b8;margin-top:2px;">{{ $pay->order->variant->menu->name ?? '-' }}</div>
                        </td>
                        <td>
                            <div style="font-weight:600;">{{ $pay->user->name }}</div>
                            <div style="font-size:0.73rem;color:#94a3b8;margin-top:2px;">{{ $pay->account_name }}</div>
                        </td>
                        <td>
                            <div style="font-weight:600;">{{ $pay->bank_name }}</div>
                            <div style="font-size:0.73rem;color:#94a3b8;font-family:monospace;margin-top:2px;">{{ $pay->account_number }}</div>
                        </td>
                        <td style="font-weight:700;color:#16a34a;">
                            Rp {{ number_format($pay->amount, 0, ',', '.') }}
                        </td>
                        <td style="font-size:0.78rem;color:#64748b;">
                            {{ $pay->created_at->translatedFormat('d M Y') }}<br>
                            <span style="color:#94a3b8;">{{ $pay->created_at->format('H:i') }}</span>
                        </td>
                        <td>
                            @if($pay->isPending())
                                <span class="pay-badge badge-pending">Menunggu</span>
                            @elseif($pay->isConfirmed())
                                <span class="pay-badge badge-confirmed">Dikonfirmasi</span>
                            @else
                                <span class="pay-badge badge-rejected">Ditolak</span>
                            @endif
                        </td>
                        <td>
                            <div style="display:flex;gap:5px;flex-wrap:wrap;align-items:center;">
                                <a href="{{ route('admin.payments.show', $pay->id) }}" class="btn-view">Lihat</a>
                                @if($pay->isPending())
                                <form action="{{ route('admin.payments.confirm', $pay->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    <button type="submit" class="btn-confirm"
                                        onclick="return confirm('Konfirmasi pembayaran ini?')">Konfirmasi</button>
                                </form>
                                <button class="btn-reject" onclick="openRejectModal({{ $pay->id }})">Tolak</button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align:center;padding:50px;color:#94a3b8;font-size:0.85rem;">
                            Tidak ada pembayaran dengan status ini
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($payments->hasPages())
        <div style="padding:16px 20px;border-top:1px solid #f1f5f9;">
            {{ $payments->withQueryString()->links() }}
        </div>
        @endif
    </div>

</div>

{{-- Modal Tolak --}}
<div id="rejectModal" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-title">Tolak Pembayaran</div>
        <div class="modal-sub">Berikan alasan penolakan agar pelanggan dapat memperbaikinya.</div>
        <form id="rejectForm" method="POST">
            @csrf
            <textarea name="note" rows="3" required class="modal-textarea"
                placeholder="Contoh: Nominal tidak sesuai, bukti tidak jelas..."></textarea>
            <div class="modal-actions">
                <button type="button" class="modal-cancel" onclick="closeRejectModal()">Batal</button>
                <button type="submit" class="modal-reject-btn">Tolak Pembayaran</button>
            </div>
        </form>
    </div>
</div>

<script>
function openRejectModal(id) {
    document.getElementById('rejectForm').action = `/admin/payments/${id}/reject`;
    document.getElementById('rejectModal').style.display = 'flex';
}
function closeRejectModal() {
    document.getElementById('rejectModal').style.display = 'none';
}
document.getElementById('rejectModal').addEventListener('click', function(e) {
    if (e.target === this) closeRejectModal();
});
</script>
@endsection
