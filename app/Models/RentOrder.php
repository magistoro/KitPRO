<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_to',
        'customer_phone',
        'customer_email',
        'address',
        'comment',
        'rent_start',
        'rent_end',
        'delivered_at',
    ];

    public function orderRentProducts()
    {
        return $this->hasMany(OrderRentProduct::class, 'rent_order_id');
    }

}
