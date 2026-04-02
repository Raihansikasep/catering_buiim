<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        // sementara ambil semua (nanti bisa filter by user)
        $orders = Order::with(['variant.menu','schedule'])
                    ->latest()
                    ->get();

        return view('pelanggan.orders', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['variant.menu','schedule'])
                    ->findOrFail($id);

        return view('pelanggan.order_detail', compact('order'));
    }
}