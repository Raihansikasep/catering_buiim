<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\MenuVariant;

class MenuVariantSeeder extends Seeder {
    public function run(): void {
        $nasiBox = Menu::where('name','Nasi Box Standard')->first();
        $snackBox = Menu::where('name','Snack Box Premium')->first();
        $tumpeng = Menu::where('name','Tumpeng Mini')->first();

        MenuVariant::create(['menu_id'=>$nasiBox->id,'name'=>'Paket 1','price'=>25000,'portion'=>1]);
        MenuVariant::create(['menu_id'=>$nasiBox->id,'name'=>'Paket 2','price'=>45000,'portion'=>2]);

        MenuVariant::create(['menu_id'=>$snackBox->id,'name'=>'Paket 1','price'=>15000,'portion'=>1]);
        MenuVariant::create(['menu_id'=>$snackBox->id,'name'=>'Paket 2','price'=>28000,'portion'=>2]);

        MenuVariant::create(['menu_id'=>$tumpeng->id,'name'=>'Paket Mini','price'=>200000,'portion'=>1]);
    }
}
