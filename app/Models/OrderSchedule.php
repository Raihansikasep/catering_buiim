<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSchedule extends Model {
    use HasFactory;

    protected $table = 'order_schedules';
    protected $fillable = ['order_id','schedule_date','status'];

    public function order() {
        return $this->belongsTo(Order::class);
    }
}

