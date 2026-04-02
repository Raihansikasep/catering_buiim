<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'name_variant',  // Nama paket, misal: "Paket A", "Paket B"
        'name_item',     // Isi menu dalam satu teks, misal: "Nasi Uduk, Ayam Goreng, Tempe"
        'description',   // Keterangan tambahan (opsional)
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
