<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuAddon;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuAddonController extends Controller
{
    public function index()
    {
        $addons = MenuAddon::with('menu')->latest()->get();
        return view('admin.menu-addons.index', compact('addons'));
    }

    public function create()
    {
        $menus = Menu::all();
        return view('admin.menu-addons.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'name'    => 'required|string|max:255',
            'price'   => 'required|numeric',
        ]);

        MenuAddon::create($request->only('menu_id', 'name', 'price'));

        return redirect()->route('admin.menu-addons.index')
            ->with('success', 'Addon berhasil ditambahkan');
    }

    public function edit($id)
    {
        $addon = MenuAddon::findOrFail($id);
        $menus = Menu::all();
        return view('admin.menu-addons.edit', compact('addon', 'menus'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'name'    => 'required|string|max:255',
            'price'   => 'required|numeric',
        ]);

        MenuAddon::findOrFail($id)->update($request->only('menu_id', 'name', 'price'));

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
