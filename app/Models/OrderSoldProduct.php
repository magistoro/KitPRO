<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderSoldProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'sold_order_id',
        'product_id',
        'quantity',
        'return_date',
    ];

    public function soldOrder()
    {
        return $this->belongsTo(SoldOrder::class, 'sold_order_id');
    }

    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    
}
