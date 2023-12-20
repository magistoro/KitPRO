<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\OrderRentProduct;
use App\Models\OrderSoldProduct;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller 
{

    private function getBestSellingProducts() {
        $soldProducts = OrderSoldProduct::groupBy('product_id')
        ->select('product_id', DB::raw('SUM(quantity) as total_sales'))
        ->orderByDesc('total_sales') ->limit(5) ->get();

    $productIds = $soldProducts->pluck('product_id')->toArray();

    $bestSellingProducts = Product::whereIn('id', $productIds)
        ->select('id', 'name', 'thumbnail', 'price') ->get()
        ->map(function ($product) use ($soldProducts) {
            $product->total_sales = $soldProducts->where('product_id', $product->id)->first()->total_sales;
            return $product;
        });
    return $bestSellingProducts;
    }


    private function getBestRentingProducts() {
        $soldProducts = OrderRentProduct::groupBy('product_id')
        ->select('product_id') ->limit(5) ->get();

        $productIds = $soldProducts->pluck('product_id')->toArray();

        $bestRentingProducts = Product::whereIn('id', $productIds)
            ->select('id', 'name', 'thumbnail', 'price') ->get()
            ->map(function ($product) use ($soldProducts) {
        $product->total_sales = $soldProducts->where('product_id', $product->id)->first()->total_sales;

            return $product;
        });
    return $bestRentingProducts;
    }
        

    public function index() {
        $bestSellingProducts = $this->getBestSellingProducts();

        $bestRentingProducts = $this->getBestRentingProducts();
        // dd($bestSellingProducts);
        return view('admin.index', compact('bestSellingProducts', 'bestRentingProducts'));
    }

    
        
    
}
