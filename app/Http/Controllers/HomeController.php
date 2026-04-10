<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Blog; // 🔥 TAMBAH INI
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        // ambil cuma 4 produk
        $menus = Menu::with(['category','variants'])
                    ->latest()
                    ->take(4)
                    ->get();

        // 🔥 TAMBAH BLOG
        $blogs = Blog::latest()->take(3)->get();

        return view('pelanggan.index', compact('categories','menus','blogs'));
    }
}
