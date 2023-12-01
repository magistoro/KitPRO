<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'price',
        'items_in_stock',
        'thumbnail',
        'category_id',
        'type_id',
    ];

    protected $with = ['category', 'type'];

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function type():BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function cartItems():HasMany
    {
        return $this->hasMany(CartItem::class);
    }

}
