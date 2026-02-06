<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\MenuItem;

class MenuItemSeeder extends Seeder {
    public function run(): void {
        $nasiBox = Menu::where('name','Nasi Box Standard')->first();
        $snackBox = Menu::where('name','Snack Box Premium')->first();
        $tumpeng = Menu::where('name','Tumpeng Mini')->first();

        MenuItem::create(['menu_id'=>$nasiBox->id,'name'=>'Nasi Putih','quantity'=>'1 porsi']);
        MenuItem::create(['menu_id'=>$nasiBox->id,'name'=>'Ayam Goreng','quantity'=>'1 potong']);
        MenuItem::create(['menu_id'=>$nasiBox->id,'name'=>'Perkedel','quantity'=>'1 buah']);
        MenuItem::create(['menu_id'=>$nasiBox->id,'name'=>'Lalapan','quantity'=>'secukupnya']);

        MenuItem::create(['menu_id'=>$snackBox->id,'name'=>'Risoles','quantity'=>'2 pcs']); 
        MenuItem::create(['menu_id'=>$snackBox->id,'name'=>'Pastel','quantity'=>'2 pcs']);
        MenuItem::create(['menu_id'=>$snackBox->id,'name'=>'Kue Lapis','quantity'=>'1 pcs']);

        MenuItem::create(['menu_id'=>$tumpeng->id,'name'=>'Nasi Kuning','quantity'=>'1 tumpeng mini']);
        MenuItem::create(['menu_id'=>$tumpeng->id,'name'=>'Ayam','quantity'=>'1 ekor kecil']);
        MenuItem::create(['menu_id'=>$tumpeng->id,'name'=>'Telur','quantity'=>'4 pcs']);
        MenuItem::create(['menu_id'=>$tumpeng->id,'name'=>'Lalapan','quantity'=>'secukupnya']);
    }
}
