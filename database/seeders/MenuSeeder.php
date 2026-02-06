<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Category;

class MenuSeeder extends Seeder {
    public function run(): void {
        $nasiBox = Category::where('name','Nasi Box')->first();
        $snackBox = Category::where('name','Snack Box')->first();
        $tumpeng = Category::where('name','Tumpeng')->first();

        Menu::create([
            'category_id'=>$nasiBox->id,
            'name'=>'Nasi Box Standard',
            'description'=>'Isi: Nasi, Ayam Goreng, Perkedel, Lalapan',
            'image'=>'nasi_box_standard.jpg'
        ]);

        Menu::create([
            'category_id'=>$snackBox->id,
            'name'=>'Snack Box Premium',
            'description'=>'Isi: Risoles, Pastel, Kue Lapis',
            'image'=>'no image'
        ]);

        Menu::create([
            'category_id'=>$tumpeng->id,
            'name'=>'Tumpeng Mini',
            'description'=>'Isi: Nasi Kuning, Ayam, Telur, Lalapan',
            'image'=>'tumpeng_mini.jpg'
        ]);
    }
}
