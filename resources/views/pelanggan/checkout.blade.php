@extends('layouts.frontend')
@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

* { font-family: 'Plus Jakarta Sans', sans-serif; }

.checkout-page { background: #f7f8fa; min-height: 100vh; padding: 40px 0 80px; }

.section-title { font-size: 1.6rem; font-weight: 700; color: #111; margin-bottom: 4px; }
.section-sub { color: #888; font-size: 0.88rem; margin-bottom: 28px; }

/* STEP INDICATOR */
.steps {
    display: flex;
    align-items: center;
    gap: 0;
    margin-bottom: 32px;
    max-width: 400px;
}
.step {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.82rem;
    font-weight: 600;
    color: #bbb;
}
.step.active { color: #16a34a; }
.step.done { color: #888; }
.step-num {
    width: 26px; height: 26px;
    border-radius: 50%;
    background: #e5e7eb;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.75rem;
    font-weight: 700;
    color: #999;
    flex-shrink: 0;
}
.step.active .step-num { background: #16a34a; color: #fff; }
.step.done .step-num { background: #d1fae5; color: #16a34a; }
.step-line { flex: 1; height: 1px; background: #e5e7eb; margin: 0 8px; }

/* FORM CARD */
.form-card {
    background: #fff;
    border-radius: 20px;
    border: 1px solid #eee;
    padding: 28px;
    margin-bottom: 16px;
}
.form-card-title {
    font-size: 0.95rem;
    font-weight: 700;
    color: #111;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.form-card-title .icon {
    width: 32px; height: 32px;
    border-radius: 10px;
    background: #f0fdf4;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.9rem;
}

.form-label { font-size: 0.82rem; font-weight: 600; color: #555; margin-bottom: 6px; }
.form-control, .form-select {
    border-radius: 12px;
    border: 1.5px solid #e5e7eb;
    font-size: 0.88rem;
    padding: 10px 14px;
    color: #111;
    background: #fff;
    transition: border-color 0.15s, box-shadow 0.15s;
}
.form-control:focus, .form-select:focus {
    border-color: #16a34a;
    box-shadow: 0 0 0 3px rgba(22,163,74,0.1);
    outline: none;
}
.form-control.is-invalid { border-color: #dc2626; }
.invalid-feedback { font-size: 0.78rem; color: #dc2626; margin-top: 4px; }

.date-info {
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    border-radius: 10px;
    padding: 10px 14px;
    font-size: 0.82rem;
    color: #166534;
    margin-top: 8px;
    display: none;
}
.date-warning {
    background: #fef2f2;
    border: 1px solid #fecaca;
    border-radius: 10px;
    padding: 10px 14px;
    font-size: 0.82rem;
    color: #dc2626;
    margin-top: 8px;
    display: none;
}

/* ORDER SUMMARY */
.order-summary-card {
    background: #fff;
    border-radius: 20px;
    border: 1px solid #eee;
    overflow: hidden;
    position: sticky;
    top: 24px;
}
.order-summary-head {
    padding: 20px 24px 16px;
    border-bottom: 1px solid #f0f0f0;
}
.order-summary-head h5 { font-size: 0.95rem; font-weight: 700; color: #111; margin: 0; }

.order-item {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 14px 24px;
    border-bottom: 1px solid #f7f7f7;
}
.order-item:last-of-type { border-bottom: none; }
.order-item img { width: 54px; height: 54px; border-radius: 12px; object-fit: cover; flex-shrink: 0; }
.order-item-info { flex: 1; min-width: 0; }
.order-item-name { font-size: 0.85rem; font-weight: 600; color: #111; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.order-item-meta { font-size: 0.78rem; color: #888; margin-top: 2px; }
.order-item-price { font-size: 0.88rem; font-weight: 700; color: #111; white-space: nowrap; }

.order-summary-footer {
    padding: 16px 24px 20px;
    border-top: 1px solid #f0f0f0;
}
.total-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.85rem;
    color: #777;
    margin-bottom: 8px;
}
.total-row.grand {
    font-size: 1.05rem;
    font-weight: 700;
    color: #111;
    margin-top: 12px;
    padding-top: 12px;
    border-top: 1px dashed #e5e7eb;
}
.total-row.grand span:last-child { color: #16a34a; }

.btn-process {
    display: block;
    width: 100%;
    padding: 14px;
    background: #16a34a;
    color: #fff;
    border: none;
    border-radius: 14px;
    font-size: 0.95rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    text-align: center;
    margin-top: 16px;
}
.btn-process:hover { background: #15803d; transform: translateY(-1px); }
.btn-process:disabled { background: #9ca3af; cursor: not-allowed; transform: none; }

.btn-back-cart {
    display: block;
    text-align: center;
    padding: 10px;
    color: #888;
    font-size: 0.83rem;
    text-decoration: none;
    margin-top: 8px;
    border-radius: 10px;
    transition: background 0.15s;
}
.btn-back-cart:hover { background: #f9fafb; color: #333; }

/* Alert */
.alert-custom {
    border-radius: 14px;
    border: none;
    font-size: 0.85rem;
    padding: 14px 18px;
    margin-bottom: 20px;
    display: flex;
    align-items: flex-start;
    gap: 10px;
}
.alert-custom.danger { background: #fef2f2; color: #b91c1c; }
.alert-custom.success { background: #f0fdf4; color: #166534; }

/* Toast */
.toast-notif {
    position: fixed;
    bottom: 30px; right: 30px;
    background: #111;
    color: #fff;
    padding: 13px 22px;
    border-radius: 14px;
    font-size: 0.85rem;
    font-weight: 500;
    z-index: 9999;
    opacity: 0;
    transform: translateY(12px);
    transition: all 0.3s;
    pointer-events: none;
    max-width: 320px;
}
.toast-notif.show { opacity: 1; transform: translateY(0); }
.toast-notif.success { background: #16a34a; }
.toast-notif.danger { background: #dc2626; }
.toast-notif.info { background: #2563eb; }

@media (max-width: 991px) {
    .order-summary-card { position: static; margin-top: 0; }
}
@media (max-width: 576px) {
    .form-card { padding: 20px; }
    .section-title { font-size: 1.3rem; }
}
</style>

<div class="checkout-page">
<div class="container">

    {{-- ALERTS --}}
    @if(session('error'))
    <div class="alert-custom danger">
        <span>⚠</span>
        <span>{{ session('error') }}</span>
    </div>
    @endif

    @if(session('success'))
    <div class="alert-custom success" id="auto-alert">
        <span>✓</span>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    @if($errors->any())
    <div class="alert-custom danger">
        <span>⚠</span>
        <ul class="mb-0 ps-3">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="section-title">Checkout</div>
    <div class="section-sub">Lengkapi data pemesanan kamu</div>

    {{-- STEPS --}}
    <div class="steps">
        <div class="step done">
            <div class="step-num">✓</div>
            <span>Keranjang</span>
        </div>
        <div class="step-line"></div>
        <div class="step active">
            <div class="step-num">2</div>
            <span>Checkout</span>
        </div>
        <div class="step-line"></div>
        <div class="step">
            <div class="step-num">3</div>
            <span>Pesanan</span>
        </div>
    </div>

    @php
        $grandTotal = 0;
        $selectedItems = array_filter($cart ?? [], fn($i) => isset($i['selected']) && $i['selected']);
    @endphp

    @if(empty($selectedItems))
    <div class="form-card text-center py-5">
        <div style="font-size:2.5rem; margin-bottom:12px;">🛒</div>
        <h5 style="font-weight:700; color:#111;">Belum ada item dipilih</h5>
        <p style="color:#888; font-size:0.88rem;">Pilih item di keranjang terlebih dahulu</p>
        <a href="{{ route('cart') }}" class="btn btn-success mt-2 px-5 rounded-pill" style="font-size:0.88rem;">
            Kembali ke Keranjang
        </a>
    </div>

    @else

    <div class="row g-4">

        {{-- KIRI: FORM --}}
        <div class="col-lg-7">

            <form action="{{ route('checkout.process') }}" method="POST" id="checkoutForm">
                @csrf

                {{-- DATA PEMESAN --}}
                <div class="form-card">
                    <div class="form-card-title">
                        <div class="icon">👤</div>
                        Data Pemesan
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="customer_name"
                                   value="{{ old('customer_name', $user->name) }}"
                                   class="form-control @error('customer_name') is-invalid @enderror"
                                   placeholder="Nama lengkap"
                                   required>
                            @error('customer_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">No HP / WhatsApp</label>
                            <input type="text" name="customer_phone"
                                   value="{{ old('customer_phone', $user->phone) }}"
                                   class="form-control @error('customer_phone') is-invalid @enderror"
                                   placeholder="08xxxxxxxxxx"
                                   required>
                            @error('customer_phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea name="customer_address"
                                      class="form-control @error('customer_address') is-invalid @enderror"
                                      rows="3"
                                      placeholder="Jl. Contoh No. 1, Kelurahan, Kecamatan, Kota"
                                      required>{{ old('customer_address', $user->address) }}</textarea>
                            @error('customer_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                {{-- JADWAL --}}
                <div class="form-card">
                    <div class="form-card-title">
                        <div class="icon">📅</div>
                        Jadwal Acara
                    </div>

                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Tanggal Acara</label>
                            <input type="date"
                                   name="schedule_date"
                                   id="schedule_date"
                                   class="form-control @error('schedule_date') is-invalid @enderror"
                                   value="{{ old('schedule_date') }}"
                                   min="{{ \Carbon\Carbon::today()->addDays(2)->format('Y-m-d') }}"
                                   required>
                            @error('schedule_date')<div class="invalid-feedback">{{ $message }}</div>@enderror

                            <div class="date-info" id="dateInfo">
                                <strong>📅</strong> <span id="dateText"></span> — Tanggal tersedia
                            </div>
                            <div class="date-warning" id="dateWarning">
                                <strong>⚠</strong> Tanggal ini sudah dipesan, silakan pilih tanggal lain.
                            </div>
                            <small class="text-muted d-block mt-2" style="font-size:0.78rem;">
                                * Minimal pemesanan H-2 sebelum acara
                            </small>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Catatan (Opsional)</label>
                            <textarea name="notes"
                                      class="form-control"
                                      rows="2"
                                      placeholder="Contoh: tolong tidak pakai sambal, atau permintaan khusus lainnya...">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>

                <button class="btn-process" type="submit" id="btnCheckout">
                    Proses Pesanan →
                </button>
                <a href="{{ route('cart') }}" class="btn-back-cart">← Kembali ke Keranjang</a>

            </form>

        </div>

        {{-- KANAN: SUMMARY --}}
        <div class="col-lg-5">
            <div class="order-summary-card">

                <div class="order-summary-head">
                    <h5>Ringkasan Pesanan</h5>
                </div>

                @foreach($selectedItems as $item)
                @php
                    $total = $item['price'] * $item['qty'];
                    $grandTotal += $total;
                @endphp
                <div class="order-item">
                    <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}">
                    <div class="order-item-info">
                        <div class="order-item-name">{{ $item['name'] }}</div>
                        <div class="order-item-meta">
                            {{ $item['qty'] }} porsi × Rp {{ number_format($item['price']) }}
                            @if(!empty($item['addons']))
                                @foreach($item['addons'] as $addon)
                                <br><span style="color:#16a34a;">+ {{ $addon['name'] }}</span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="order-item-price">Rp {{ number_format($total) }}</div>
                </div>
                @endforeach

                <div class="order-summary-footer">
                    <div class="total-row">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($grandTotal) }}</span>
                    </div>
                    <div class="total-row">
                        <span>Ongkos kirim</span>
                        <span style="color:#16a34a; font-size:0.8rem;">Dihitung terpisah</span>
                    </div>
                    <div class="total-row grand">
                        <span>Total</span>
                        <span>Rp {{ number_format($grandTotal) }}</span>
                    </div>
                </div>

            </div>
        </div>

    </div>
    @endif

</div>
</div>

<div class="toast-notif" id="toastNotif"></div>

<script>
function showToast(msg, type = 'success', duration = 3000) {
    const t = document.getElementById('toastNotif');
    t.textContent = msg;
    t.className = 'toast-notif ' + type + ' show';
    setTimeout(() => t.classList.remove('show'), duration);
}

const dateInput = document.getElementById('schedule_date');
const dateInfo  = document.getElementById('dateInfo');
const dateWarn  = document.getElementById('dateWarning');
const btnCheckout = document.getElementById('btnCheckout');

if (dateInput) {
    dateInput.addEventListener('change', function () {
        const date = this.value;
        if (!date) return;

        const d = new Date(date + 'T00:00:00');
        const fmt = d.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
        document.getElementById('dateText').textContent = fmt;

        fetch("{{ route('checkout.check-schedule') }}?date=" + date)
            .then(r => r.json())
            .then(data => {
                if (!data.available) {
                    dateWarn.style.display = 'flex';
                    dateInfo.style.display = 'none';
                    btnCheckout.disabled = true;
                    showToast('Tanggal ini sudah dipesan, pilih tanggal lain.', 'danger');
                } else {
                    dateWarn.style.display = 'none';
                    dateInfo.style.display = 'flex';
                    btnCheckout.disabled = false;
                    showToast('Tanggal tersedia!', 'success');
                }
            });
    });
}

// Submit dengan toast
const form = document.getElementById('checkoutForm');
if (form) {
    form.addEventListener('submit', function () {
        if (btnCheckout) {
            btnCheckout.disabled = true;
            btnCheckout.textContent = 'Memproses...';
        }
        showToast('Pesanan sedang diproses...', 'info', 5000);
    });
}

// Redirect ke pesanan saya setelah submit (override action jika perlu)
// Pastikan route checkout.process redirect ke route('orders') bukan home

// Auto dismiss alert
const aa = document.getElementById('auto-alert');
if (aa) setTimeout(() => { aa.style.opacity = '0'; setTimeout(() => aa.remove(), 400); }, 3000);
</script>

@endsection
