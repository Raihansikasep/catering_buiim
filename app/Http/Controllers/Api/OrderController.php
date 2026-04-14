<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderSchedule;
use App\Models\OrderAddon;
use App\Models\MenuVariant;
use App\Models\MenuAddon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * GET /api/orders
     * Ambil semua pesanan milik user yang sedang login
     */
    public function index(Request $request)
    {
        $orders = Order::with(['variant.menu', 'schedule', 'addons.addon'])
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data'    => $orders->map(fn($o) => $this->formatOrder($o)),
        ]);
    }

    /**
     * GET /api/orders/{id}
     * Detail satu pesanan (hanya milik user yang login)
     */
    public function show(Request $request, $id)
    {
        $order = Order::with(['variant.menu', 'schedule', 'addons.addon', 'payment'])
            ->where('user_id', $request->user()->id)
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data'    => $this->formatOrder($order),
        ]);
    }

    /**
     * POST /api/orders
     * Buat pesanan baru dari Flutter
     */
    public function store(Request $request)
    {
        $request->validate([
            'menu_variant_id'  => 'required|exists:menu_variants,id',
            'customer_name'    => 'required|string|max:255',
            'customer_phone'   => 'required|string|max:20',
            'customer_address' => 'required|string',
            'quantity'         => 'required|integer|min:1',
            'schedule_date'    => 'required|date|after:today',
            'notes'            => 'nullable|string',
            'addon_ids'        => 'nullable|array',
            'addon_ids.*'      => 'exists:menu_addons,id',
        ]);

        $variant = MenuVariant::with('menu')->findOrFail($request->menu_variant_id);

        // Hitung total harga
        $baseTotal  = $variant->menu->price * $request->quantity;
        $addonTotal = 0;
        $addons     = collect();

        if ($request->filled('addon_ids')) {
            $addons     = MenuAddon::whereIn('id', $request->addon_ids)->get();
            $addonTotal = $addons->sum('price') * $request->quantity;
        }

        // Buat order
        $order = Order::create([
            'user_id'          => $request->user()->id,
            'menu_variant_id'  => $request->menu_variant_id,
            'customer_name'    => $request->customer_name,
            'customer_phone'   => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'quantity'         => $request->quantity,
            'order_date'       => now()->toDateString(),
            'status'           => 'menunggu',
            'total_price'      => $baseTotal + $addonTotal,
            'notes'            => $request->notes,
        ]);

        // Simpan jadwal acara
        OrderSchedule::create([
            'order_id'      => $order->id,
            'schedule_date' => $request->schedule_date,
            'status'        => 'belum',
        ]);

        // Simpan addon-addon yang dipilih
        if ($addons->isNotEmpty()) {
            foreach ($addons as $addon) {
                OrderAddon::create([
                    'order_id' => $order->id,
                    'addon_id' => $addon->id,
                    'price'    => $addon->price,
                ]);
            }
        }

        $order->load(['variant.menu', 'schedule', 'addons.addon']);

        return response()->json([
            'success' => true,
            'message' => 'Pesanan berhasil dibuat',
            'data'    => $this->formatOrder($order),
        ], 201);
    }

    /**
     * Format data order untuk response JSON
     */
    private function formatOrder(Order $order): array
    {
        return [
            'id'               => $order->id,
            'status'           => $order->status,
            'order_date'       => $order->order_date,
            'schedule_date'    => $order->schedule?->schedule_date,
            'customer_name'    => $order->customer_name,
            'customer_phone'   => $order->customer_phone,
            'customer_address' => $order->customer_address,
            'quantity'         => $order->quantity,
            'total_price'      => (int) $order->total_price,
            'notes'            => $order->notes,
            'menu_name'        => $order->variant?->menu?->name,
            'menu_image' => $order->variant?->menu?->image
    ? asset('storage/' . $order->variant->menu->image)
    : null,
            'variant_name'     => $order->variant?->name_variant,
            'addons'           => $order->addons->map(fn($a) => [
                'id'    => $a->addon_id,
                'name'  => $a->addon?->name,
                'price' => (int) ($a->price ?? 0),
            ])->values()->toArray(),
        ];
    }
    public function checkSchedule(Request $request)
    {
        $date   = $request->date;
        $exists = OrderSchedule::whereDate('schedule_date', $date)->exists();

        return response()->json([
            'available' => !$exists,
        ]);
    }
}
