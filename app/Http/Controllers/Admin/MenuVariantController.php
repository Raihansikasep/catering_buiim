<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuVariant;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuVariantController extends Controller
{
    public function index()
    {
        $variants = MenuVariant::with('menu')->get();
        return view('admin.menu_variants.index', compact('variants'));
    }

    public function create()
    {
        $menus = Menu::all();
        return view('admin.menu_variants.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'portion' => 'required|string|max:50',
        ]);

        MenuVariant::create($request->all());

        return redirect()->route('menu-variants.index')
            ->with('success', 'Menu Variant berhasil ditambahkan');
    }

    public function edit(MenuVariant $menu_variant)
    {
        $menus = Menu::all();
        return view('admin.menu_variants.edit', compact('menu_variant', 'menus'));
    }

    public function update(Request $request, MenuVariant $menu_variant)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'portion' => 'required|string|max:50',
        ]);

        $menu_variant->update($request->all());

        return redirect()->route('menu-variants.index')
            ->with('success', 'Menu Variant berhasil diupdate');
    }

    public function destroy(MenuVariant $menu_variant)
    {
        $menu_variant->delete();

        return redirect()->route('menu-variants.index')
            ->with('success', 'Menu Variant berhasil dihapus');
    }
}
