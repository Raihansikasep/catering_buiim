<?php
namespace App\Http\Controllers\Owner;

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

        return view('owner.orders.index', compact('orders'));
    }

    public function create()
    {
        $variants = MenuVariant::with('menu')->get();
        return view('owner.orders.create', compact('variants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_variant_id' => 'required|exists:menu_variants,id',
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'customer_address' => 'required',
            'quantity' => 'required|integer|min:1',
            'order_date' => 'required|date',
            'status' => 'required',
            'schedule_date' => 'required|date',
        ]);

        $variant = MenuVariant::findOrFail($request->menu_variant_id);

        $order = Order::create([
            'menu_variant_id' => $request->menu_variant_id,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'quantity' => $request->quantity,
            'order_date' => $request->order_date,
            'status' => $request->status,
            'total_price' => $variant->price * $request->quantity,
            'notes' => $request->notes,
        ]);

        OrderSchedule::create([
            'order_id' => $order->id,
            'schedule_date' => $request->schedule_date,
            'status' => 'belum',
        ]);

        return redirect()->route('owner.orders.index')
            ->with('success', 'Order berhasil ditambahkan');
    }

    public function show(Order $order)
    {
        $order->load(['variant.menu', 'schedule']);
        return view('owner.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $variants = MenuVariant::with('menu')->get();
        $order->load('schedule');

        return view('owner.orders.edit', compact('order', 'variants'));
    }

    public function update(Request $request, Order $order)
    {
        $variant = MenuVariant::findOrFail($request->menu_variant_id);

        $order->update([
            'menu_variant_id' => $request->menu_variant_id,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'quantity' => $request->quantity,
            'order_date' => $request->order_date,
            'status' => $request->status,
            'total_price' => $variant->price * $request->quantity,
            'notes' => $request->notes,
        ]);

        $order->schedule->update([
            'schedule_date' => $request->schedule_date
        ]);

        return redirect()->route('owner.orders.index')
            ->with('success', 'Order berhasil diupdate');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('owner.orders.index')
            ->with('success', 'Order berhasil dihapus');
    }
}