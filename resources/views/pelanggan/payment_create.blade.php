@extends('layouts.frontend')
@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
* { font-family: 'Plus Jakarta Sans', sans-serif; }

.payment-page { background: #f4f6f9; min-height: 100vh; padding: 40px 0 80px; }
.section-title { font-size: 1.4rem; font-weight: 700; color: #0f172a; margin-bottom: 4px; }
.section-sub   { font-size: 0.83rem; color: #94a3b8; }

.summary-card  { background:#fff; border-radius:16px; border:1px solid #f1f5f9; padding:20px; margin-bottom:20px; }
.menu-name     { font-size:1rem; font-weight:700; color:#0f172a; }
.variant-text  { font-size:0.8rem; color:#94a3b8; margin-bottom:8px; }
.summary-total { display:flex; justify-content:space-between; align-items:center; padding-top:12px; border-top:1px solid #f1f5f9; margin-top:12px; }
.summary-total .lbl { font-size:0.83rem; color:#64748b; }
.summary-total .amt { font-size:1.15rem; font-weight:700; color:#16a34a; }

.bank-info-title { font-size:0.8rem; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:10px; }
.bank-item { background:#fff; border:1px solid #f1f5f9; border-radius:12px; padding:14px 16px; margin-bottom:8px; display:flex; align-items:center; justify-content:space-between; gap:10px; flex-wrap:wrap; }
.bank-nm   { font-weight:700; color:#0f172a; font-size:0.9rem; }
.bank-no   { font-size:0.88rem; color:#16a34a; font-weight:600; font-family:monospace; letter-spacing:1px; }
.bank-ac   { font-size:0.74rem; color:#94a3b8; }
.copy-btn  { padding:4px 12px; border:1px solid #e2e8f0; border-radius:8px; background:#f8fafc; font-size:0.72rem; font-weight:600; color:#475569; cursor:pointer; transition:all 0.15s; white-space:nowrap; }
.copy-btn:hover  { border-color:#16a34a; color:#16a34a; }
.copy-btn.copied { background:#f0fdf4; border-color:#86efac; color:#16a34a; }

.form-card   { background:#fff; border-radius:16px; border:1px solid #f1f5f9; padding:24px; }
.lbl-custom  { font-size:0.82rem; font-weight:600; color:#374151; margin-bottom:6px; display:block; }
.inp         { width:100%; padding:10px 14px; border:1.5px solid #e2e8f0; border-radius:10px; font-size:0.88rem; color:#0f172a; outline:none; transition:border-color 0.15s; background:#fff; }
.inp:focus   { border-color:#16a34a; box-shadow:0 0 0 3px rgba(22,163,74,0.08); }
.inp.err     { border-color:#ef4444; }
.err-msg     { color:#ef4444; font-size:0.74rem; margin-top:4px; display:block; }

.upload-area { border:2px dashed #e2e8f0; border-radius:12px; padding:28px 20px; text-align:center; cursor:pointer; transition:all 0.2s; background:#fafafa; position:relative; }
.upload-area:hover    { border-color:#16a34a; background:#f0fdf4; }
.upload-area.has-file { border-color:#86efac; background:#f0fdf4; }
.upload-area input[type="file"] { position:absolute; inset:0; opacity:0; cursor:pointer; width:100%; height:100%; }
.upload-ico  { font-size:2rem; margin-bottom:8px; }
.upload-txt  { font-size:0.83rem; color:#64748b; }
.upload-txt strong { color:#16a34a; }
#uploadPreview { max-width:220px; max-height:220px; object-fit:cover; border-radius:10px; margin-top:12px; display:none; }

.btn-submit { width:100%; padding:13px; background:#16a34a; color:#fff; border:none; border-radius:12px; font-size:0.92rem; font-weight:700; cursor:pointer; transition:all 0.2s; margin-top:20px; }
.btn-submit:hover { background:#15803d; transform:translateY(-1px); box-shadow:0 4px 14px rgba(22,163,74,0.3); }

.warn-box { background:#fffbeb; border:1px solid #fde68a; border-radius:12px; padding:12px 16px; font-size:0.82rem; color:#92400e; margin-bottom:20px; display:flex; gap:8px; align-items:flex-start; }
</style>

<div class="payment-page">
<div class="container">
<div class="row justify-content-center">
<div class="col-lg-7 col-xl-6">

    <div class="mb-4">
        <h2 class="section-title">Konfirmasi Pembayaran</h2>
        <p class="section-sub">Pesanan #ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</p>
    </div>

    {{-- Ringkasan Order --}}
    <div class="summary-card">
        <div class="menu-name">{{ $order->variant->menu->name }}</div>
        <div class="variant-text">
            {{ $order->variant->name_variant ?? $order->variant->name ?? '' }}
            &middot; {{ $order->quantity }} porsi
        </div>
        <div class="summary-total">
            <span class="lbl">Total yang harus dibayar</span>
            <span class="amt">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
        </div>
    </div>

    {{-- Info Rekening --}}
    <div class="mb-4">
        <div class="bank-info-title">Transfer ke salah satu rekening berikut</div>
        @foreach($bankInfo as $bank)
        <div class="bank-item">
            <div>
                <div class="bank-nm">{{ $bank['bank'] }}</div>
                <div class="bank-no">{{ $bank['number'] }}</div>
                <div class="bank-ac">a.n {{ $bank['name'] }}</div>
            </div>
            <button type="button" class="copy-btn" onclick="copyNum(this, '{{ $bank['number'] }}')">Salin</button>
        </div>
        @endforeach
    </div>

    <div class="warn-box">
        ⚠️ Pastikan nominal transfer sesuai dengan total pesanan. Upload bukti transfer setelah melakukan pembayaran.
    </div>

    {{-- Form --}}
    <div class="form-card">
        <form action="{{ route('payment.store', $order->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="lbl-custom">Bank Pengirim <span class="text-danger">*</span></label>
                <input type="text" name="bank_name"
                       class="inp @error('bank_name') err @enderror"
                       placeholder="Contoh: BCA, Mandiri, BRI..."
                       value="{{ old('bank_name') }}">
                @error('bank_name')<span class="err-msg">{{ $message }}</span>@enderror
            </div>

            <div class="mb-3">
                <label class="lbl-custom">Nama Pemilik Rekening <span class="text-danger">*</span></label>
                <input type="text" name="account_name"
                       class="inp @error('account_name') err @enderror"
                       placeholder="Nama sesuai rekening pengirim"
                       value="{{ old('account_name') }}">
                @error('account_name')<span class="err-msg">{{ $message }}</span>@enderror
            </div>

            <div class="mb-3">
                <label class="lbl-custom">Nomor Rekening Pengirim <span class="text-danger">*</span></label>
                <input type="text" name="account_number"
                       class="inp @error('account_number') err @enderror"
                       placeholder="Nomor rekening yang digunakan transfer"
                       value="{{ old('account_number') }}">
                @error('account_number')<span class="err-msg">{{ $message }}</span>@enderror
            </div>

            <div class="mb-3">
                <label class="lbl-custom">Nominal Transfer <span class="text-danger">*</span></label>
                <input type="number" name="amount"
                       class="inp @error('amount') err @enderror"
                       placeholder="Masukkan nominal yang ditransfer"
                       value="{{ old('amount', (int)$order->total_price) }}">
                @error('amount')<span class="err-msg">{{ $message }}</span>@enderror
            </div>

            <div class="mb-2">
                <label class="lbl-custom">Bukti Transfer <span class="text-danger">*</span></label>
                <div class="upload-area" id="uploadArea">
                    <input type="file" name="proof_image" id="proofInput"
                           accept="image/jpg,image/jpeg,image/png,image/webp"
                           onchange="previewImg(this)">
                    <div id="uploadPlaceholder">
                        <div class="upload-ico">📎</div>
                        <div class="upload-txt">
                            <strong>Klik untuk upload</strong> atau seret file ke sini<br>
                            <span style="font-size:0.72rem;color:#94a3b8">JPG, PNG, WEBP — Maks. 2MB</span>
                        </div>
                    </div>
                    <img id="uploadPreview" src="" alt="Preview">
                </div>
                @error('proof_image')<span class="err-msg">{{ $message }}</span>@enderror
            </div>

            <button type="submit" class="btn-submit">
                Kirim Bukti Pembayaran →
            </button>

        </form>
    </div>

</div>
</div>
</div>
</div>

<script>
function previewImg(input) {
    const preview     = document.getElementById('uploadPreview');
    const placeholder = document.getElementById('uploadPlaceholder');
    const area        = document.getElementById('uploadArea');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.style.display = 'block';
            placeholder.style.display = 'none';
            area.classList.add('has-file');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
function copyNum(btn, number) {
    navigator.clipboard.writeText(number).then(() => {
        btn.textContent = '✓ Tersalin';
        btn.classList.add('copied');
        setTimeout(() => { btn.textContent = 'Salin'; btn.classList.remove('copied'); }, 2000);
    });
}
</script>

@endsection
