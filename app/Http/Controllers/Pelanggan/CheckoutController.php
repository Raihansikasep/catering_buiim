<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderAddon;
use App\Models\OrderSchedule;
use App\Models\MenuVariant;
use App\Models\MenuAddon;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $user = auth()->user();

        return view('pelanggan.checkout', compact('cart', 'user'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'customer_name'    => 'required|string|max:255',
            'customer_phone'   => 'required|string|max:20',
            'customer_address' => 'required|string',
            'schedule_date'    => 'required|date',
            'notes'            => 'nullable|string',
        ]);

        $cart = session()->get('cart', []);

        $selectedItems = array_filter($cart, function ($item) {
            return isset($item['selected']) && $item['selected'] == true;
        });

        if (empty($selectedItems)) {
            return back()->withInput()
                ->with('error', 'Pilih minimal 1 produk dulu!');
        }

        $today        = Carbon::today();
        $scheduleDate = Carbon::parse($request->schedule_date)->startOfDay();

        if ($scheduleDate->lte($today)) {
            return back()->withInput()
                ->with('error', 'Tanggal acara tidak boleh di masa lalu!');
        }

        // H-2 = selisih minimal 2 hari, jadi tgl acara harus >= today + 2
        if ($scheduleDate->lt($today->copy()->addDays(2))) {
            return back()->withInput()
                ->with('error', 'Minimal pemesanan H-2 sebelum acara!');
        }

        $existing = OrderSchedule::whereDate('schedule_date', $scheduleDate)->exists();
        if ($existing) {
            return back()->withInput()
                ->with('error', 'Tanggal tersebut sudah dipesan, silakan pilih tanggal lain!');
        }

        foreach ($selectedItems as $key => $item) {
            $variant = MenuVariant::find($item['variant_id']);
            if (!$variant) continue;

            $order = Order::create([
                'user_id'          => auth()->id(),
                'menu_variant_id'  => $variant->id,
                'customer_name'    => $request->customer_name,
                'customer_phone'   => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'quantity'         => $item['qty'],
                'order_date'       => now(),
                'status'           => 'menunggu',
                'total_price'      => $item['price'] * $item['qty'],
                'notes'            => $request->notes,
            ]);

            // SIMPAN ADDON
            if (!empty($item['addons'])) {
                foreach ($item['addons'] as $addon) {
                    OrderAddon::create([
                        'order_id'      => $order->id,
                        'menu_addon_id' => $addon['id'],
                        'price'         => $addon['price'],
                    ]);
                }
            }

            OrderSchedule::create([
                'order_id'      => $order->id,
                'schedule_date' => $request->schedule_date,
                'status'        => 'belum',
            ]);
        }

        foreach ($selectedItems as $key => $item) {
            unset($cart[$key]);
        }
        session()->put('cart', $cart);

        return redirect()->route('my.orders')
            ->with('success', 'Checkout berhasil! Pesanan kamu sedang diproses.');
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
