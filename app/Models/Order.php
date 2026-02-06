<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    use HasFactory;

    protected $fillable = [
        'menu_variant_id','customer_name','customer_phone',
        'customer_address','quantity','order_date','status',
        'total_price','notes','payment_proof'
    ];

    public function variant() {
        return $this->belongsTo(MenuVariant::class, 'menu_variant_id');
    }

    public function schedule() {
    return $this->hasOne(OrderSchedule::class, 'order_id');
    }
}
