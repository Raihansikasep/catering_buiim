<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        Menu::create([
            'category_id' => 1,
            'name' => 'Nasi Box Standar',
            'description' => 'Nasi box lengkap',
            'price' => 20000,
            'min_order' => 1,
            'max_order' => 100,
        ]);
    }
}
