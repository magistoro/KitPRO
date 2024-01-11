<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoldOrder extends Model
{
    use HasFactory;

    protected $table = 'sold_orders';


    protected $fillable = [
        'customer_to',
        'customer_phone',
        'customer_email',
        'address',
        'comment',
        'user_id',
        'assembled_at',
        'dispatched_at',
        'delivered_at',
        'cancelled_at',
    ];

    public function orderSoldProducts()
    {
        return $this->hasMany(OrderSoldProduct::class, 'sold_order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
