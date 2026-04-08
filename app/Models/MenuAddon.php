<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuAddon extends Model
{
    use HasFactory;

    protected $fillable = ['menu_id', 'name', 'price'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
