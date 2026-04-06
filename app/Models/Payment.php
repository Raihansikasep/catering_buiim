<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'method',
        'bank_name',
        'account_name',
        'account_number',
        'amount',
        'proof_image',
        'status',
        'note',
        'confirmed_at',
        'confirmed_by',
    ];

    protected $casts = [
        'confirmed_at' => 'datetime',
        'amount'       => 'decimal:2',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function confirmedBy()
    {
        return $this->belongsTo(User::class, 'confirmed_by');
    }

    public function isPending()   { return $this->status === 'pending'; }
    public function isConfirmed() { return $this->status === 'confirmed'; }
    public function isRejected()  { return $this->status === 'rejected'; }
}
 