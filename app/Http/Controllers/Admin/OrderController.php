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
            'status'          => 'required',
            'schedule_date'   => 'required|date',
            'notes'           => 'nullable|string',
            'payment_proof'   => 'nullable|image|max:2048',
        ]);

        $variant = MenuVariant::findOrFail($request->menu_variant_id);

        // upload bukti
        $paymentPath = null;
        if ($request->hasFile('payment_proof')) {
            $paymentPath = $request->file('payment_proof')
                ->store('payment_proofs','public');
        }

        // ORDER
        $order = Order::create([
            'menu_variant_id' => $request->menu_variant_id,
            'customer_name'   => $request->customer_name,
            'customer_phone'  => $request->customer_phone,
            'customer_address'=> $request->customer_address,
            'quantity'        => $request->quantity,
            'order_date'      => $request->order_date,
            'status'          => $request->status,
            'total_price'     => $variant->price * $request->quantity,
            'notes'           => $request->notes,
            'payment_proof'   => $paymentPath,
        ]);

        // ORDER SCHEDULE
        OrderSchedule::create([
            'order_id'      => $order->id,
            'schedule_date' => $request->schedule_date,
            'status'        => 'belum',
        ]);

        return redirect()->route('orders.index')
            ->with('success','Order berhasil ditambahkan');
    }

    public function show(Order $order)
    {
        // Load relasi variant, menu, dan schedule
        $order->load(['variant.menu', 'schedule']);

        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $variants = MenuVariant::with('menu')->get();

        // PASTIKAN RELASI DILOAD
        $order->load('schedule');

        return view('admin.orders.edit', compact('order','variants'));
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
            'status'          => 'required',
            'schedule_date'   => 'required|date',
            'notes'           => 'nullable|string',
            'payment_proof'   => 'nullable|image|max:2048',
        ]);

        $variant = MenuVariant::findOrFail($request->menu_variant_id);

        $data = $request->except('payment_proof');
        $data['total_price'] = $variant->price * $request->quantity;

        if ($request->hasFile('payment_proof')) {
            $data['payment_proof'] = $request->file('payment_proof')
                ->store('payment_proofs','public');
        }

        $order->update($data);

        $order->schedule->update([
            'schedule_date' => $request->schedule_date,
        ]);

        return redirect()->route('orders.index')
            ->with('success','Order berhasil diupdate');
    }

    public function destroy(Order $order)
    {
        // Hapus bukti pembayaran jika ada
        if ($order->payment_proof && \Storage::disk('public')->exists($order->payment_proof)) {
            \Storage::disk('public')->delete($order->payment_proof);
        }

        // Hapus order sekaligus schedule karena ada cascade di migration
        $order->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Order berhasil dihapus');
    }

}
