<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPaymentController extends Controller
{
    // ─── Daftar semua pembayaran ──────────────────────────────
    public function index(Request $request)
    {
        $status = $request->get('status', 'pending');

        $payments = Payment::with(['order.variant.menu', 'user'])
            ->when($status !== 'all', fn($q) => $q->where('status', $status))
            ->latest()
            ->paginate(15);

        $counts = [
            'pending'   => Payment::where('status', 'pending')->count(),
            'confirmed' => Payment::where('status', 'confirmed')->count(),
            'rejected'  => Payment::where('status', 'rejected')->count(),
        ];

        return view('admin.payments.index', compact('payments', 'status', 'counts'));
    }

    // ─── Detail pembayaran ────────────────────────────────────
    public function show($id)
    {
        $payment = Payment::with([
            'order.variant.menu',
            'order.addons.addon',
            'order.schedule',
            'user',
            'confirmedBy',
        ])->findOrFail($id);

        return view('admin.payments.show', compact('payment'));
    }

    // ─── Konfirmasi pembayaran ────────────────────────────────
    public function confirm($id)
    {
        $payment = Payment::with('order')->findOrFail($id);

        if (!$payment->isPending()) {
            return back()->with('error', 'Pembayaran ini sudah diproses sebelumnya.');
        }

        $payment->update([
            'status'       => 'confirmed',
            'confirmed_at' => now(),
            'confirmed_by' => Auth::id(),
            'note'         => null,
        ]);

        // Update status order ke sedang_diproses
        $payment->order->update(['status' => 'sedang_diproses']);

        return back()->with('success', 'Pembayaran dikonfirmasi. Order sekarang sedang diproses.');
    }

    // ─── Tolak pembayaran ─────────────────────────────────────
    public function reject(Request $request, $id)
    {
        $request->validate([
            'note' => 'required|string|max:500',
        ], [
            'note.required' => 'Alasan penolakan wajib diisi.',
        ]);

        $payment = Payment::with('order')->findOrFail($id);

        if (!$payment->isPending()) {
            return back()->with('error', 'Pembayaran ini sudah diproses sebelumnya.');
        }

        $payment->update([
            'status' => 'rejected',
            'note'   => $request->note,
        ]);

        // Kembalikan status order ke menunggu agar pelanggan bisa upload ulang
        $payment->order->update(['status' => 'menunggu']);

        return back()->with('success', 'Pembayaran ditolak. Pelanggan dapat mengupload ulang bukti transfer.');
    }
}
