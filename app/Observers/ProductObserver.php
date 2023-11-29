<?php

namespace App\Observers;

use App\Models\Product;

class ProductObserver
{
    public function saving(Product $product)
    {
        $product->slug = str($product->name)->slug('-','ru');
    }
}
