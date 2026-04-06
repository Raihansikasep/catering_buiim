<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // ─── Daftar pesanan milik user yang login ─────────────────
    public function index()
    {
        $orders = Order::with(['variant.menu', 'schedule', 'payment'])
            ->where('user_id', Auth::id())  // filter by user
            ->latest()
            ->get();

        return view('pelanggan.orders', compact('orders'));
    }

    // ─── Detail pesanan ───────────────────────────────────────
    public function show($id)
    {
        $order = Order::with(['variant.menu', 'schedule', 'addons.addon', 'payment'])
            ->where('id', $id)
            ->where('user_id', Auth::id())  // pastikan milik user ini
            ->firstOrFail();

        return view('pelanggan.order_detail', compact('order'));
    }
}
 