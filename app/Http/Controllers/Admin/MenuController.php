<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    // tampilkan semua menu
    public function index()
    {
        $menus = Menu::with('category')->get();
        return view('admin.menus.index', compact('menus'));
    }

    // tampilkan form create
    public function create()
    {
        $categories = Category::all();
        return view('admin.menus.create', compact('categories'));
    }

    // simpan menu baru
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'min_order' => 'required|integer|min:1',
            'max_order' => 'required|integer|gte:min_order',
        ]);

        $data = $request->only([
            'category_id',
            'name',
            'description',
            'min_order',
            'max_order'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('menus', 'public');
        }

        Menu::create($data);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil ditambahkan!');
    }

    // tampilkan menu tertentu
    public function show(Menu $menu)
    {
        return view('admin.menus.show', compact('menu'));
    }

    // form edit menu
    public function edit(Menu $menu)
    {
        $categories = Category::all();
        return view('admin.menus.edit', compact('menu', 'categories'));
    }

    // update menu
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'min_order' => 'required|integer|min:1',
            'max_order' => 'required|integer|gte:min_order',
        ]);

        $data = $request->only([
            'category_id',
            'name',
            'description',
            'min_order',
            'max_order'
        ]);

        if ($request->hasFile('image')) {
            // hapus gambar lama jika ada
            if ($menu->image) {
                Storage::disk('public')->delete($menu->image);
            }
            $data['image'] = $request->file('image')->store('menus', 'public');
        }

        $menu->update($data);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil diupdate!');
    }

    // hapus menu
    public function destroy(Menu $menu)
    {
        if ($menu->image) {
            Storage::disk('public')->delete($menu->image);
        }

        $menu->delete();

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil dihapus!');
    }
}
