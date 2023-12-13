<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderRentProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'rent_order_id',
        'product_id',
        'return_date',
    ];

    public function rentOrder()
    {
        return $this->belongsTo(RentOrder::class, 'rent_order_id');
    }

}
