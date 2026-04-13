<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderSchedule;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderScheduleController extends Controller
{
    public function index()
    {
        $schedules = OrderSchedule::with('order.variant.menu')
            ->latest()
            ->get();
        return view('admin.order_schedules.index', compact('schedules'));
    }

    public function create()
    {
        $orders = Order::with('variant.menu')->get();
        return view('admin.order_schedules.create', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id'      => 'required|exists:orders,id',
            'schedule_date' => 'required|date',
            'status'        => 'required|in:belum,sedang_diproses,selesai',
        ]);

        OrderSchedule::create($request->all());

        return redirect()->route('admin.order-schedules.index')
            ->with('success', 'Order schedule berhasil ditambahkan');
    }

    public function show(OrderSchedule $orderSchedule)
    {
        $orderSchedule->load('order.variant.menu');
        return view('admin.order_schedules.show', compact('orderSchedule'));
    }

    public function edit(OrderSchedule $orderSchedule)
    {
        $orders = Order::with('variant.menu')->get();
        return view('admin.order_schedules.edit', compact('orderSchedule', 'orders'));
    }

    public function update(Request $request, OrderSchedule $orderSchedule)
    {
        $request->validate([
            'order_id'      => 'required|exists:orders,id',
            'schedule_date' => 'required|date',
            'status'        => 'required|in:belum,sedang_diproses,selesai',
        ]);

        $orderSchedule->update($request->all());

        return redirect()->route('admin.order-schedules.index')
            ->with('success', 'Order schedule berhasil diupdate');
    }

    public function destroy(OrderSchedule $orderSchedule)
    {
        $orderSchedule->delete();

        return redirect()->route('admin.order-schedules.index')
            ->with('success', 'Order schedule berhasil dihapus');
    }
}
