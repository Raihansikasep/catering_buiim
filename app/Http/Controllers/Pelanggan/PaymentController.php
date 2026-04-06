<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    // ─── Form upload bukti bayar ──────────────────────────────
    public function create($orderId)
    {
        $order = Order::with(['variant.menu', 'addons.addon', 'payment'])
            ->where('id', $orderId)
            ->where('user_id', Auth::id())  // pastikan order milik user ini
            ->firstOrFail();

        // Cegah jika sudah ada payment pending atau confirmed
        if ($order->payment && in_array($order->payment->status, ['pending', 'confirmed'])) {
            return redirect()->route('my.orders.detail', $order->id)
                ->with('info', 'Kamu sudah mengupload bukti pembayaran sebelumnya.');
        }

        // Cegah jika status bukan menunggu
        if ($order->status !== 'menunggu') {
            return redirect()->route('my.orders.detail', $order->id)
                ->with('info', 'Status pesanan tidak memerlukan pembayaran.');
        }

        // Info rekening tujuan — sesuaikan dengan rekening usaha kamu
        $bankInfo = [
            ['bank' => 'BCA',     'number' => '1234567890', 'name' => 'Dapur Bu Iim'],
            ['bank' => 'Mandiri', 'number' => '0987654321', 'name' => 'Dapur Bu Iim'],
            ['bank' => 'BRI',     'number' => '1122334455', 'name' => 'Dapur Bu Iim'],
        ];

        return view('pelanggan.payment_create', compact('order', 'bankInfo'));
    }

    // ─── Simpan bukti pembayaran ──────────────────────────────
    public function store(Request $request, $orderId)
    {
        $order = Order::where('id', $orderId)
            ->where('user_id', Auth::id())
            ->where('status', 'menunggu')
            ->firstOrFail();

        $request->validate([
            'bank_name'      => 'required|string|max:100',
            'account_name'   => 'required|string|max:100',
            'account_number' => 'required|string|max:30',
            'amount'         => 'required|numeric|min:1',
            'proof_image'    => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'bank_name.required'      => 'Nama bank wajib diisi.',
            'account_name.required'   => 'Nama rekening wajib diisi.',
            'account_number.required' => 'Nomor rekening wajib diisi.',
            'amount.required'         => 'Nominal transfer wajib diisi.',
            'proof_image.required'    => 'Bukti transfer wajib diupload.',
            'proof_image.image'       => 'File harus berupa gambar.',
            'proof_image.max'         => 'Ukuran gambar maksimal 2MB.',
        ]);

        // Simpan gambar bukti transfer
        $path = $request->file('proof_image')->store('payments', 'public');

        // Hapus payment lama jika ada (kasus upload ulang setelah ditolak)
        if ($order->payment) {
            \Storage::disk('public')->delete($order->payment->proof_image);
            $order->payment->delete();
        }

        // Buat record payment baru
        Payment::create([
            'order_id'       => $order->id,
            'user_id'        => Auth::id(),
            'method'         => 'transfer_bank',
            'bank_name'      => $request->bank_name,
            'account_name'   => $request->account_name,
            'account_number' => $request->account_number,
            'amount'         => $request->amount,
            'proof_image'    => $path,
            'status'         => 'pending',
        ]);

        // Update status order
        $order->update(['status' => 'sudah_bayar']);

        return redirect()->route('my.orders.detail', $order->id)
            ->with('success', 'Bukti pembayaran berhasil dikirim! Menunggu konfirmasi admin.');
    }
}
