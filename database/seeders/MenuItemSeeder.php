<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuItem;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        MenuItem::insert([
            [
                'menu_id' => 1,
                'name' => 'Nasi Putih',
                'quantity' => 1,
            ],
            [
                'menu_id' => 1,
                'name' => 'Sayur Asem',
                'quantity' => 1,
            ],
            [
                'menu_id' => 1,
                'name' => 'Kerupuk',
                'quantity' => 1,
            ],
        ]);
    }
}
