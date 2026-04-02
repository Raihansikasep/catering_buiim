<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderSchedule;
use App\Models\MenuVariant;
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
            'customer_name'    => 'required',
            'customer_phone'   => 'required',
            'customer_address' => 'required',
            'schedule_date'    => 'required|date',
        ]);

        $cart = session()->get('cart', []);

        // 🔥 ambil item yang dipilih saja
        $selectedItems = array_filter($cart, function($item){
            return isset($item['selected']) && $item['selected'] == true;
        });

        if(empty($selectedItems)){
            return back()->with('error', 'Pilih minimal 1 produk dulu!');
        }

        // 🔥 validasi tanggal
        $today = Carbon::today();
        $scheduleDate = Carbon::parse($request->schedule_date);

        if ($scheduleDate->lessThan($today)) {
            return back()->with('error', 'Tanggal acara tidak boleh di masa lalu!');
        }

        if ($scheduleDate->lessThan($today->copy()->addDays(2))) {
            return back()->with('error', 'Minimal pemesanan H-2 sebelum acara!');
        }

        // 🔥 cek jadwal bentrok
        $existing = OrderSchedule::whereDate('schedule_date', $scheduleDate)->exists();

        if ($existing) {
            return back()->with('error', 'Tanggal tersebut sudah dipesan!');
        }

        // =========================
        // 🔥 CREATE ORDER
        // =========================
        foreach ($selectedItems as $key => $item) {

            // wajib pakai variant dari cart
            $variant = MenuVariant::find($item['variant_id']);

            if (!$variant) continue;

            Order::create([
                'menu_variant_id' => $variant->id,
                'customer_name'   => $request->customer_name,
                'customer_phone'  => $request->customer_phone,
                'customer_address'=> $request->customer_address,
                'quantity'        => $item['qty'],
                'order_date'      => now(),
                'status'          => 'menunggu',
                'total_price'     => $variant->price * $item['qty'],
                'notes'           => $request->notes,
            ]);
        }

        // =========================
        // 🔥 CLEAR CART
        // =========================
        foreach ($selectedItems as $key => $item) {
            unset($cart[$key]);
        }

        session()->put('cart', $cart);

        return redirect()->route('home')->with('success', 'Checkout berhasil!');
    }

    public function checkSchedule(Request $request)
    {
        $date = $request->date;

        $exists = OrderSchedule::whereDate('schedule_date', $date)->exists();

        return response()->json([
            'available' => !$exists
        ]);
    }
}
