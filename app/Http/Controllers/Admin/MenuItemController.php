<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    public function index()
    {
        $items = MenuItem::with('menu')->get();
        return view('admin.menu_items.index', compact('items'));
    }

    public function create()
    {
        $menus = Menu::all();
        return view('admin.menu_items.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
        ]);

        MenuItem::create($request->all());

        return redirect()->route('admin.menu-items.index')
            ->with('success','Menu Item berhasil ditambahkan');
    }

   // ubah edit supaya nama param sama dengan route
    public function edit(MenuItem $menu_item)
    {
        $menus = Menu::all();
        return view('admin.menu_items.edit', compact('menu_item', 'menus'));
    }
    // update sudah benar: MenuItem $menu_item



    public function update(Request $request, MenuItem $menu_item)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
        ]);

        $menu_item->update($request->all());

        return redirect()->route('admin.menu-items.index')
            ->with('success','Menu Item berhasil diupdate');
    }

    public function destroy(MenuItem $menu_item)
    {
        $menu_item->delete();

        return redirect()->route('admin.menu-items.index')
            ->with('success','Menu Item berhasil dihapus');
    }
}
