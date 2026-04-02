<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // INI YANG BENAR
use App\Models\MenuAddon;
use Illuminate\Http\Request;
class MenuAddonController extends Controller
{
    public function index()
    {
        $addons = MenuAddon::latest()->get();
        return view('admin.menu-addons.index', compact('addons'));
    }

    public function create()
    {
        return view('admin.menu-addons.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        MenuAddon::create($request->all());

        return redirect()->route('admin.menu-addons.index')
            ->with('success', 'Addon berhasil ditambahkan');
    }

    public function edit($id)
    {
        $addon = MenuAddon::findOrFail($id);
        return view('admin.menu-addons.edit', compact('addon'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        $addon = MenuAddon::findOrFail($id);
        $addon->update($request->all());

        return redirect()->route('admin.menu-addons.index')
            ->with('success', 'Addon berhasil diupdate');
    }

    public function destroy($id)
    {
        MenuAddon::findOrFail($id)->delete();

        return redirect()->route('admin.menu-addons.index')
            ->with('success', 'Addon berhasil dihapus');
    }
}
