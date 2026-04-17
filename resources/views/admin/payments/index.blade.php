@extends('layouts.backend')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    :root {
        --primary: #16a34a;
        --primary-dark: #15803d;
        --primary-light: #f0fdf4;
        --danger: #dc2626;
        --warning: #b45309;
        --slate-50: #f8fafc;
        --slate-100: #f1f5f9;
        --slate-200: #e2e8f0;
        --slate-400: #94a3b8;
        --slate-600: #475569;
        --slate-700: #334155;
        --slate-900: #0f172a;
    }

    * { font-family: 'Plus Jakarta Sans', sans-serif; }
    body { background-color: #fbfcfd; }

    .pay-page { padding: 32px 0 60px; }

    /* Header */
    .page-title { font-size: 1.5rem; font-weight: 800; color: var(--slate-900); letter-spacing: -0.02em; margin: 0; }
    .page-sub { font-size: 0.875rem; color: var(--slate-400); margin-top: 4px; }

    /* Stat Cards */
    .stat-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 32px; }
    .stat-card {
        background: #fff; border-radius: 20px; border: 1px solid var(--slate-100);
        padding: 24px; display: flex; align-items: center; gap: 16px;
        transition: all 0.3s ease;
    }
    .stat-card:hover { transform: translateY(-4px); box-shadow: 0 10px 25px rgba(0,0,0,0.04); }
    .stat-icon { 
        width: 52px; height: 52px; border-radius: 14px; 
        display: flex; align-items: center; justify-content: center; 
        font-size: 1.25rem; flex-shrink: 0; 
    }

    /* Filter Tabs */
    .filter-bar { 
        display: flex; gap: 6px; margin-bottom: 24px; padding: 6px; 
        background: #f1f5f9; border-radius: 14px; width: fit-content; 
    }
    .filter-tab {
        padding: 8px 20px; border-radius: 10px; font-size: 0.8rem; font-weight: 700; 
        color: var(--slate-600); text-decoration: none; transition: all 0.2s; border: none;
    }
    .filter-tab.active { background: #fff; color: var(--primary); box-shadow: 0 4px 10px rgba(0,0,0,0.05); }

    /* Table Styling */
    .table-wrap { 
        background: #fff; border-radius: 24px; border: 1px solid var(--slate-100); 
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); overflow: hidden; 
    }
    .pay-table { width: 100%; border-collapse: collapse; }
    .pay-table th {
        background: var(--slate-50); padding: 16px 20px; font-size: 0.7rem;
        color: var(--slate-400); text-transform: uppercase; font-weight: 800;
        letter-spacing: 0.05em; text-align: left;
    }
    .pay-table td { padding: 18px 20px; border-bottom: 1px solid var(--slate-50); vertical-align: middle; }
    .pay-table tr:hover td { background: #fafbfc; }

    /* Avatar */
    .avatar-circle {
        width: 38px; height: 38px; background: var(--slate-100); color: var(--slate-700);
        border-radius: 12px; display: flex; align-items: center; justify-content: center;
        font-size: 0.8rem; font-weight: 700; flex-shrink: 0;
    }

    /* Badges */
    .pay-badge { 
        display: inline-flex; align-items: center; padding: 6px 12px; 
        border-radius: 8px; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; 
    }
    .badge-pending { background: #fffbeb; color: var(--warning); border: 1px solid #fde68a; }
    .badge-confirmed { background: var(--primary-light); color: var(--primary); border: 1px solid #bbf7d0; }
    .badge-rejected { background: #fef2f2; color: var(--danger); border: 1px solid #fecaca; }

    /* Action Buttons */
    .btn-action-group { display: flex; gap: 8px; align-items: center; }
    .btn-view-alt {
        padding: 8px 16px; background: #fff; color: var(--slate-700); 
        border: 1px solid var(--slate-200); border-radius: 10px; 
        font-size: 0.75rem; font-weight: 700; text-decoration: none; transition: 0.2s;
    }
    .btn-view-alt:hover { border-color: var(--slate-400); background: var(--slate-50); }
    
    .btn-confirm-alt {
        padding: 8px 16px; background: var(--primary); color: #fff; 
        border: none; border-radius: 10px; font-size: 0.75rem; font-weight: 700; 
        cursor: pointer; transition: 0.2s;
    }
    .btn-confirm-alt:hover { background: var(--primary-dark); transform: translateY(-1px); }

    .btn-reject-icon {
        width: 34px; height: 34px; display: flex; align-items: center; justify-content: center;
        background: #fff; color: var(--danger); border: 1px solid #fee2e2;
        border-radius: 10px; cursor: pointer; transition: 0.2s;
    }
    .btn-reject-icon:hover { background: #fef2f2; }

    /* Alerts */
    .alert-custom {
        padding: 14px 20px; border-radius: 16px; font-size: 0.85rem; font-weight: 600;
        margin-bottom: 24px; display: flex; align-items: center; gap: 10px;
    }
    .alert-success { background: var(--primary-light); color: #166534; border: 1px solid #bbf7d0; }
    .alert-danger { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }

    /* Modal */
    .modal-overlay { 
        display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.6); 
        backdrop-filter: blur(4px); z-index: 9999; align-items: center; justify-content: center; 
    }
    .modal-box { 
        background: #fff; border-radius: 24px; padding: 32px; width: 100%; 
        max-width: 440px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);
    }
    .modal-textarea { 
        width: 100%; padding: 14px; border: 1.5px solid var(--slate-200); border-radius: 12px; 
        font-size: 0.875rem; outline: none; transition: 0.2s; margin: 16px 0;
    }
    .modal-textarea:focus { border-color: var(--danger); box-shadow: 0 0 0 4px rgba(220, 38, 38, 0.1); }

    @media (max-width: 768px) {
        .stat-grid { grid-template-columns: 1fr; }
        .filter-bar { width: 100%; overflow-x: auto; }
    }
</style>

<div class="container-fluid pay-page">

    {{-- Header --}}
    <div class="mb-4">
        <h4 class="page-title">Manajemen Pembayaran</h4>
        <p class="page-sub">Verifikasi bukti transfer dari pelanggan Dapur Bu Iim</p>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert-custom alert-success"><span>✓</span> {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert-custom alert-danger"><span>✕</span> {{ session('error') }}</div>
    @endif

    {{-- Stats Cards --}}
    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background:#fffbeb; color:#b45309">⏳</div>
            <div>
                <div class="stat-label" style="font-size: 0.75rem; color: var(--slate-400); font-weight: 600;">Menunggu</div>
                <div class="stat-num" style="font-size: 1.5rem; font-weight: 800; color: var(--slate-900);">{{ $counts['pending'] }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#f0fdf4; color:#16a34a">✓</div>
            <div>
                <div class="stat-label" style="font-size: 0.75rem; color: var(--slate-400); font-weight: 600;">Dikonfirmasi</div>
                <div class="stat-num" style="font-size: 1.5rem; font-weight: 800; color: var(--slate-900);">{{ $counts['confirmed'] }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#fef2f2; color:#dc2626">✕</div>
            <div>
                <div class="stat-label" style="font-size: 0.75rem; color: var(--slate-400); font-weight: 600;">Ditolak</div>
                <div class="stat-num" style="font-size: 1.5rem; font-weight: 800; color: var(--slate-900);">{{ $counts['rejected'] }}</div>
            </div>
        </div>
    </div>

    {{-- Filter Bar --}}
    <div class="filter-bar">
        <a href="?status=pending" class="filter-tab {{ $status === 'pending' ? 'active' : '' }}">Perlu Review ({{ $counts['pending'] }})</a>
        <a href="?status=confirmed" class="filter-tab {{ $status === 'confirmed' ? 'active' : '' }}">Berhasil</a>
        <a href="?status=rejected" class="filter-tab {{ $status === 'rejected' ? 'active' : '' }}">Gagal</a>
        <a href="?status=all" class="filter-tab {{ $status === 'all' ? 'active' : '' }}">Semua Data</a>
    </div>

    {{-- Main Table --}}
    <div class="table-wrap">
        <div style="overflow-x:auto">
            <table class="pay-table">
                <thead>
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Pelanggan</th>
                        <th>Informasi Bank</th>
                        <th>Nominal</th>
                        <th>Waktu Bayar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $pay)
                    <tr>
                        <td>
                            <div style="font-weight:800; color: var(--slate-900);">#ORD-{{ str_pad($pay->order_id, 4, '0', STR_PAD_LEFT) }}</div>
                            <div style="font-size:0.75rem; color: var(--slate-400);">{{ $pay->order->variant->menu->name ?? '-' }}</div>
                        </td>
                        <td>
                            <div style="display:flex; align-items:center; gap:12px;">
                                <div class="avatar-circle">{{ strtoupper(substr($pay->user->name, 0, 2)) }}</div>
                                <div>
                                    <div style="font-weight:700; font-size: 0.85rem; color: var(--slate-900);">{{ $pay->user->name }}</div>
                                    <div style="font-size:0.75rem; color: var(--slate-400);">A/N: {{ $pay->account_name }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="font-weight:700; color: var(--slate-700);">{{ $pay->bank_name }}</div>
                            <div style="font-size:0.75rem; color: var(--slate-400); font-family: monospace;">{{ $pay->account_number }}</div>
                        </td>
                        <td>
                            <div style="font-weight:800; color: var(--primary); font-size: 0.95rem;">
                                Rp {{ number_format($pay->amount, 0, ',', '.') }}
                            </div>
                        </td>
                        <td>
                            <div style="font-size:0.8rem; font-weight: 600; color: var(--slate-700);">{{ $pay->created_at->translatedFormat('d M Y') }}</div>
                            <div style="font-size:0.75rem; color: var(--slate-400);">{{ $pay->created_at->format('H:i') }} WIB</div>
                        </td>
                        <td>
                            @if($pay->isPending())
                                <span class="pay-badge badge-pending">Menunggu</span>
                            @elseif($pay->isConfirmed())
                                <span class="pay-badge badge-confirmed">Diterima</span>
                            @else
                                <span class="pay-badge badge-rejected">Ditolak</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-action-group">
                                <a href="{{ route('admin.payments.show', $pay->id) }}" class="btn-view-alt">Detail</a>
                                @if($pay->isPending())
                                    <form action="{{ route('admin.payments.confirm', $pay->id) }}" method="POST" style="display:inline">
                                        @csrf
                                        <button type="submit" class="btn-confirm-alt" onclick="return confirm('Konfirmasi pembayaran ini?')">Terima</button>
                                    </form>
                                    <button class="btn-reject-icon" onclick="openRejectModal({{ $pay->id }})" title="Tolak">
                                        ✕
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align:center; padding:60px; color: var(--slate-400);">
                            <div style="font-size: 2rem; margin-bottom: 10px;">📂</div>
                            <p style="font-weight: 600;">Belum ada data pembayaran untuk kategori ini</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($payments->hasPages())
        <div style="padding:20px; border-top:1px solid var(--slate-100);">
            {{ $payments->withQueryString()->links() }}
        </div>
        @endif
    </div>
</div>

{{-- Modal Reject --}}
<div id="rejectModal" class="modal-overlay">
    <div class="modal-box">
        <h3 style="font-size: 1.1rem; font-weight: 800; color: var(--slate-900); margin: 0 0 8px;">Tolak Pembayaran</h3>
        <p style="font-size: 0.85rem; color: var(--slate-400); margin: 0;">Berikan alasan kenapa pembayaran ini ditolak agar pelanggan bisa mengerti.</p>
        
        <form id="rejectForm" method="POST">
            @csrf
            <textarea name="note" rows="3" required class="modal-textarea" 
                placeholder="Misal: Bukti transfer tidak jelas atau nominal tidak sesuai..."></textarea>
            
            <div style="display:flex; gap:12px;">
                <button type="button" onclick="closeRejectModal()" 
                    style="flex:1; padding:12px; border-radius:12px; border:1px solid var(--slate-200); background:#fff; font-weight:700; color:var(--slate-600); cursor:pointer;">
                    Batal
                </button>
                <button type="submit" 
                    style="flex:1; padding:12px; border-radius:12px; border:none; background:var(--danger); font-weight:700; color:#fff; cursor:pointer;">
                    Tolak Sekarang
                </button>
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
    //
    window.onclick = function(event) {
        let modal = document.getElementById('rejectModal');
        if (event.target == modal) closeRejectModal();
    }
</script>
@endsection