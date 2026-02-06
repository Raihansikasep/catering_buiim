<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\MenuVariant;
use Carbon\Carbon;

class OrderSeeder extends Seeder {
    public function run(): void {
        $variant = MenuVariant::first();

        Order::create([
            'menu_variant_id'=>$variant->id,
            'customer_name'=>'Raihan',
            'customer_phone'=>'081234567890',
            'customer_address'=>'Jl. Contoh No.1 Bandung',
            'quantity'=>2,
            'order_date'=>Carbon::now()->addDays(3),
            'status'=>'menunggu',
            'total_price'=>$variant->price*2,
            'notes'=>'Jangan pedas',
        ]);
    }
}
