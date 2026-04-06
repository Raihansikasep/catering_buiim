<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderAddon extends Model
{
    protected $fillable = ['order_id', 'menu_addon_id', 'price'];

    public function addon()
    {
        return $this->belongsTo(MenuAddon::class, 'menu_addon_id');
    }
}
