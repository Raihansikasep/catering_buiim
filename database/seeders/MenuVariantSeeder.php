<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuVariant;

class MenuVariantSeeder extends Seeder
{
    public function run(): void
    {
        MenuVariant::insert([
            [
                'menu_id' => 1,
                'name_variant' => 'Paket 1',
                'name_item' => 'Ayam Goreng',
                'description' => 'Ayam goreng crispy',
            ],
            [
                'menu_id' => 1,
                'name_variant' => 'Paket 2',
                'name_item' => 'Ayam Goreng',
                'description' => 'Ayam bakar manis',
            ],
        ]);
    }
}
