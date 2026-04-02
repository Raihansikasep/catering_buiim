<?php

namespace App\Http\Controllers\Pelanggan;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ProfileController extends Controller
{
    public function index()
    {
        return view('pelanggan.profile');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'nullable',
            'address' => 'nullable',
        ]);

        $user = auth()->user();

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return back()->with('success', 'Profile berhasil diupdate');
    }
}
