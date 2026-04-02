<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'image',
        'price',       // Harga utama menu
        'min_order',
        'max_order',
    ];


    public function addons()
    {
        return $this->belongsToMany(MenuAddon::class, 'menu_menu_addon');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Varian pilihan menu (misal: Paket 1, Paket 2)
    public function variants()
    {
        return $this->hasMany(MenuVariant::class);
    }

    // Isi paket menu (misal: Nasi Uduk, Tempe, Ayam)
    public function items()
    {
        return $this->hasMany(MenuItem::class);
    }

    
}
