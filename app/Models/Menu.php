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


     public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function variants()
    {
        return $this->hasMany(MenuVariant::class);
    }

    public function items()
    {
        return $this->hasMany(MenuItem::class);
    }

    public function addons()
    {
        return $this->hasMany(MenuAddon::class); // langsung hasMany
    }


}
