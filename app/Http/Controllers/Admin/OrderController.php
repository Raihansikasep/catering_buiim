<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderSchedule;
use App\Models\MenuVariant;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['variant.menu', 'schedule'])
            ->latest()
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        $variants = MenuVariant::with('menu')->get();
        return view('admin.orders.create', compact('variants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_variant_id' => 'required|exists:menu_variants,id',
            'customer_name'   => 'required|string|max:255',
            'customer_phone'  => 'required|string|max:20',
            'customer_address'=> 'required|string',
            'quantity'        => 'required|integer|min:1',
            'order_date'      => 'required|date',
            'status'          => 'required|in:menunggu,sudah_bayar,sedang_diproses,siap_dikirim,selesai',
            'schedule_date'   => 'required|date',
            'notes'           => 'nullable|string',
            'payment_proof'   => 'nullable|image|max:2048',
        ]);

        $variant = MenuVariant::with('menu')->findOrFail($request->menu_variant_id);

        $paymentPath = null;
        if ($request->hasFile('payment_proof')) {
            $paymentPath = $request->file('payment_proof')
                ->store('payment_proofs', 'public');
        }

        $order = Order::create([
            'menu_variant_id' => $request->menu_variant_id,
            'customer_name'   => $request->customer_name,
            'customer_phone'  => $request->customer_phone,
            'customer_address'=> $request->customer_address,
            'quantity'        => $request->quantity,
            'order_date'      => $request->order_date,
            'status'          => $request->status,
            // ✅ GANTI $variant->price → $variant->menu->price
            'total_price'     => $variant->menu->price * $request->quantity,
            'notes'           => $request->notes,
            'payment_proof'   => $paymentPath,
        ]);

        OrderSchedule::create([
            'order_id'      => $order->id,
            'schedule_date' => $request->schedule_date,
            'status'        => 'belum',
        ]);

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order berhasil ditambahkan');
    }

    public function show(Order $order)
    {
        $order->load(['variant.menu', 'schedule']);
        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $variants = MenuVariant::with('menu')->get();
        $order->load('schedule');
        return view('admin.orders.edit', compact('order', 'variants'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'menu_variant_id' => 'required|exists:menu_variants,id',
            'customer_name'   => 'required|string|max:255',
            'customer_phone'  => 'required|string|max:20',
            'customer_address'=> 'required|string',
            'quantity'        => 'required|integer|min:1',
            'order_date'      => 'required|date',
            'status'          => 'required|in:menunggu,sudah_bayar,sedang_diproses,siap_dikirim,selesai',
            'schedule_date'   => 'required|date',
            'notes'           => 'nullable|string',
            'payment_proof'   => 'nullable|image|max:2048',
        ]);

        $variant = MenuVariant::with('menu')->findOrFail($request->menu_variant_id);

        $data = $request->only([
            'menu_variant_id',
            'customer_name',
            'customer_phone',
            'customer_address',
            'quantity',
            'order_date',
            'status',
            'notes',
        ]);

        // ✅ GANTI $variant->price → $variant->menu->price
        $data['total_price'] = $variant->menu->price * $request->quantity;

        if ($request->hasFile('payment_proof')) {
            // hapus file lama
            if ($order->payment_proof) {
                \Storage::disk('public')->delete($order->payment_proof);
            }
            $data['payment_proof'] = $request->file('payment_proof')
                ->store('payment_proofs', 'public');
        }

        $order->update($data);

        // update atau buat schedule jika belum ada
        if ($order->schedule) {
            $order->schedule->update([
                'schedule_date' => $request->schedule_date,
            ]);
        } else {
            OrderSchedule::create([
                'order_id'      => $order->id,
                'schedule_date' => $request->schedule_date,
                'status'        => 'belum',
            ]);
        }

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order berhasil diupdate');
    }

    public function destroy(Order $order)
    {
        if ($order->payment_proof && \Storage::disk('public')->exists($order->payment_proof)) {
            \Storage::disk('public')->delete($order->payment_proof);
        }

        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order berhasil dihapus');
    }
}
