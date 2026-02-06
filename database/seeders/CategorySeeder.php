<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder {
    public function run(): void {
        $categories = [
            ['name'=>'Nasi Box','description'=>'Paket nasi box praktis untuk acara'],
            ['name'=>'Snack Box','description'=>'Kumpulan snack lezat untuk acara'],
            ['name'=>'Tumpeng','description'=>'Tumpeng lengkap untuk syukuran'],
        ];

        foreach($categories as $cat) {
            Category::create($cat);
        }
    }
}
