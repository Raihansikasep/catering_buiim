<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuAddon;

class MenuAddonSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\MenuAddon::insert([
            ['name' => 'Tahu', 'price' => 1000, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tempe', 'price' => 2000, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
