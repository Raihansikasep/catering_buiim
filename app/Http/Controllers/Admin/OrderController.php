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
        $orders = Order::with(['variant.menu', 'schedule', 'payment', 'addons.addon'])
            ->latest()
            ->get();

        $pendingPayments = $orders->filter(fn($o) => $o->payment && $o->payment->isPending())->count();

        return view('admin.orders.index', compact('orders', 'pendingPayments'));
    }

    public function create()
    {
        $variants = MenuVariant::with('menu')->get();
        return view('admin.orders.create', compact('variants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_variant_id'  => 'required|exists:menu_variants,id',
            'customer_name'    => 'required|string|max:255',
            'customer_phone'   => 'required|string|max:20',
            'customer_address' => 'required|string',
            'quantity'         => 'required|integer|min:1',
            'order_date'       => 'required|date',
            'status'           => 'required|in:menunggu,sudah_bayar,sedang_diproses,siap_dikirim,selesai',
            'schedule_date'    => 'required|date',
            'notes'            => 'nullable|string',
        ]);

        $variant = MenuVariant::with('menu')->findOrFail($request->menu_variant_id);

        $order = Order::create([
            'menu_variant_id'  => $request->menu_variant_id,
            'customer_name'    => $request->customer_name,
            'customer_phone'   => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'quantity'         => $request->quantity,
            'order_date'       => $request->order_date,
            'status'           => $request->status,
            'total_price'      => $variant->menu->price * $request->quantity,
            'notes'            => $request->notes,
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
        $order->load(['variant.menu', 'schedule', 'payment.user', 'addons.addon']);
        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $variants = MenuVariant::with('menu')->get();
        $order->load(['schedule', 'addons.addon']);
        return view('admin.orders.edit', compact('order', 'variants'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'menu_variant_id'  => 'required|exists:menu_variants,id',
            'customer_name'    => 'required|string|max:255',
            'customer_phone'   => 'required|string|max:20',
            'customer_address' => 'required|string',
            'quantity'         => 'required|integer|min:1',
            'order_date'       => 'required|date',
            'status'           => 'required|in:menunggu,sudah_bayar,sedang_diproses,siap_dikirim,selesai',
            'schedule_date'    => 'required|date',
            'notes'            => 'nullable|string',
        ]);

        $variant = MenuVariant::with('menu')->findOrFail($request->menu_variant_id);

        // Hitung total: base price + addon yang sudah ada
        $addonTotal = $order->addons->sum('price') * $request->quantity;
        $baseTotal  = $variant->menu->price * $request->quantity;

        $order->update([
            'menu_variant_id'  => $request->menu_variant_id,
            'customer_name'    => $request->customer_name,
            'customer_phone'   => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'quantity'         => $request->quantity,
            'order_date'       => $request->order_date,
            'status'           => $request->status,
            'total_price'      => $baseTotal + $addonTotal,
            'notes'            => $request->notes,
        ]);

        if ($order->schedule) {
            $order->schedule->update(['schedule_date' => $request->schedule_date]);
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
        if ($order->payment) {
            \Storage::disk('public')->delete($order->payment->proof_image);
            $order->payment->delete();
        }

        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order berhasil dihapus');
    }
}
