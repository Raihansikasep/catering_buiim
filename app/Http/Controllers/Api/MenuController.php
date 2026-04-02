<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuAddon;
use App\Models\Category;

class MenuController extends Controller
{
    /**
     * GET /api/v1/menus
     * GET /api/v1/menus?category_id=1
     */
    public function index()
    {
        $query = Menu::with(['category', 'variants']);

        if (request('category_id')) {
            $query->where('category_id', request('category_id'));
        }

        $menus = $query->get()->map(fn($menu) => [
            'id'          => $menu->id,
            'name'        => $menu->name,
            'description' => $menu->description,
            'image'       => $menu->image ? asset('storage/' . $menu->image) : null,
            'price'       => $menu->price,
            'min_order'   => $menu->min_order,
            'max_order'   => $menu->max_order,
            'category'    => [
                'id'   => $menu->category->id,
                'name' => $menu->category->name,
            ],
            'variants' => $menu->variants->map(fn($v) => [
                'id'           => $v->id,
                'name_variant' => $v->name_variant,
                'name_menu'    => $v->name_menu,
            ]),
        ]);

        return response()->json([
            'status' => true,
            'data'   => $menus,
        ]);
    }

    /**
     * GET /api/v1/menus/{id}
     */
    public function show($id)
    {
        $menu   = Menu::with(['category', 'variants', 'items'])->findOrFail($id);
        $addons = MenuAddon::all();

        return response()->json([
            'status' => true,
            'data'   => [
                'id'          => $menu->id,
                'name'        => $menu->name,
                'description' => $menu->description,
                'image'       => $menu->image ? asset('storage/' . $menu->image) : null,
                'price'       => $menu->price,
                'min_order'   => $menu->min_order,
                'max_order'   => $menu->max_order,
                'category'    => [
                    'id'   => $menu->category->id,
                    'name' => $menu->category->name,
                ],
                'variants' => $menu->variants->map(fn($v) => [
                    'id'           => $v->id,
                    'name_variant' => $v->name_variant,
                    'name_menu'    => $v->name_menu,
                    'description'  => $v->description,
                ]),
                'items' => $menu->items->map(fn($i) => [
                    'id'       => $i->id,
                    'name'     => $i->name,
                    'quantity' => $i->quantity,
                ]),
                'addons' => $addons->map(fn($a) => [
                    'id'    => $a->id,
                    'name'  => $a->name,
                    'price' => $a->price,
                ]),
            ],
        ]);
    }

    /**
     * GET /api/v1/categories
     */
    public function categories()
    {
        $categories = Category::all()->map(fn($c) => [
            'id'   => $c->id,
            'name' => $c->name,
        ]);

        return response()->json([
            'status' => true,
            'data'   => $categories,
        ]);
    }
}
