<?php

namespace App\Http\Controllers\Pelanggan;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->where('status', 'selesai')
            ->with('variant.menu')
            ->latest()
            ->paginate(5);

        return view('pelanggan.profile', compact('orders'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'    => 'required',
            'phone'   => 'nullable',
            'address' => 'nullable',
        ]);

        auth()->user()->update([
            'name'    => $request->name,
            'phone'   => $request->phone,
            'address' => $request->address,
        ]);

        return back()->with('success', 'Profil berhasil diupdate');
    }
}
