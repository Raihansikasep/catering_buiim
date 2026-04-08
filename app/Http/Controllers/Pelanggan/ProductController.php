<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use App\Models\MenuAddon;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $menus = Menu::with('category','variants')->get();

        return view('pelanggan.product', compact('categories','menus'));
    }

    public function show($id)
    {
        $menu = Menu::with(['category', 'variants', 'items', 'addons'])->findOrFail($id);
        $addons = $menu->addons; // otomatis cuma addon milik menu ini

        return view('pelanggan.product_detail', compact('menu', 'addons'));
    }
}
