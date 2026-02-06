<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuVariant extends Model {
    use HasFactory;

    protected $fillable = ['menu_id','name','price','portion'];

    public function menu() {
        return $this->belongsTo(Menu::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }
}
