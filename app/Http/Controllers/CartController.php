<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class CartController extends Controller
{

    public function index(){
        return view('API.cart');
    }

    public function addToCart(Request $request){


       $cart_id = $request->cookie('cart_id'); // Получаем cart_id из кук
        // Проверяем наличие куки корзины у пользователя
       
        if (!$request->hasCookie('cart_id')) {
       
            $cart = new Cart();
            $cart_id =$cart->id = Uuid::uuid4()->toString(); 

            $cart->save();


            $product = Product::where('id', $request->id)->first();
            $cartItem = CartItem::where('cart_id', $cart_id)->where('product_id', $product->id)->first();
    
                CartItem::create([
                'cart_id' => $cart_id,
                'product_id' => $product->id,
                'quantity' => 1
            ]);
            
            // Устанавливаем ID корзины в качестве куки
            return response()->json(['message' => 'Товар ' .$cart_id. ' добавлен в корзину'])->cookie('cart_id', $cart_id);      
        }


        // Создание записи в таблице cart_items
        $product = Product::where('id', $request->id)->first();
        $cartItem = CartItem::where('cart_id', $cart_id)->where('product_id', $product->id)->first();

        if($cartItem) {
         $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            CartItem::create([
            'cart_id' => $cart_id,
            'product_id' => $product->id,
            'quantity' => 1
        ]);
        }


        $id = $request->input('id');
        $message = "Товар ". $cart_id." добавлен в корзину";
        return response()->json($message);
    }
}
