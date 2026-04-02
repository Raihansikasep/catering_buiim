<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\MenuVariant;
use App\Models\MenuAddon;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('pelanggan.cart', compact('cart'));
    }

    public function add(Request $request)
    {
        $menu    = Menu::findOrFail($request->menu_id);
        $variant = MenuVariant::findOrFail($request->variant_id);

        // Ambil addon yang dipilih (array of id, bisa kosong)
        $addonIds = $request->input('addon_ids', []);
        $addons   = MenuAddon::whereIn('id', $addonIds)->get();

        // Hitung total harga addon
        $addonPrice  = $addons->sum('price');

        // Label addon untuk ditampilkan di cart
        $addonLabels = $addons->map(fn($a) => [
            'id'    => $a->id,
            'name'  => $a->name,
            'price' => $a->price,
        ])->values()->toArray();

        // Key unik: menu + varian + kombinasi addon (sort supaya urutan tidak pengaruh)
        sort($addonIds);
        $key = $menu->id . '-' . $variant->id . '-' . implode('_', $addonIds);

        $cart = session()->get('cart', []);

        if (isset($cart[$key])) {
            $cart[$key]['qty'] += (int) $request->qty;
        } else {
            $cart[$key] = [
                'menu_id'     => $menu->id,
                'variant_id'  => $variant->id,
                'name'        => $menu->name . ' — ' . $variant->name_variant,
                'base_price'  => $menu->price,
                'addon_price' => $addonPrice,
                'price'       => $menu->price + $addonPrice, // harga per porsi (sudah include addon)
                'addons'      => $addonLabels,               // list addon terpilih
                'image'       => $menu->image,
                'qty'         => (int) $request->qty,
                'selected'    => true,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart')->with('success', 'Item dihapus dari keranjang.');
    }

    public function updateAjax(Request $request)
    {
        $cart = session()->get('cart', []);
        $id   = $request->id;
        $qty  = max(1, (int) $request->qty);

        if (isset($cart[$id])) {
            $cart[$id]['qty'] = $qty;
        }

        session()->put('cart', $cart);

        return response()->json(['success' => true]);
    }

    public function toggleSelect(Request $request)
    {
        $cart = session()->get('cart', []);
        $id   = $request->id;

        if (isset($cart[$id])) {
            $cart[$id]['selected'] = ! $cart[$id]['selected'];
        }

        session()->put('cart', $cart);

        return response()->json(['success' => true]);
    }
}
