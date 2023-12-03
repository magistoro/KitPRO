<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class CartController extends Controller
{

    public function index(){
        return view('API.cart');
    }

    public function addToCart(Request $request){

        // Начало старого кода
    //    $cart_id = $request->cookie('cart_id'); // Получаем cart_id из кук
    //     // Проверяем наличие куки корзины у пользователя
       
    //     if (!$request->hasCookie('cart_id')) {
       
    //         $cart = new Cart();
    //         $cart_id =$cart->id = Uuid::uuid4()->toString(); 

    //         $cart->save();


    //         $product = Product::where('id', $request->id)->first();
    //         $cartItem = CartItem::where('cart_id', $cart_id)->where('product_id', $product->id)->first();
    
    //             CartItem::create([
    //             'cart_id' => $cart_id,
    //             'product_id' => $product->id,
    //             'quantity' => 1
    //         ]);
            
    //         // Устанавливаем ID корзины в качестве куки
    //         return response()->json(['message' => 'Товар ' .$cart_id. ' добавлен в корзину'])->cookie('cart_id', $cart_id);      
    //     }


    //     // Создание записи в таблице cart_items
    //     $product = Product::where('id', $request->id)->first();
    //     $cartItem = CartItem::where('cart_id', $cart_id)->where('product_id', $product->id)->first();

    //     if($cartItem) {
    //      $cartItem->quantity += 1;
    //         $cartItem->save();
    //     } else {
    //         CartItem::create([
    //         'cart_id' => $cart_id,
    //         'product_id' => $product->id,
    //         'quantity' => 1
    //     ]);
    //     }


    //     $id = $request->input('id');
    //     $message = "Товар ". $cart_id." добавлен в корзину";
    //     return response()->json($message);
        // Конец старого кода

       
        // Проверяем, авторизован ли пользователь
       
       // Проверяем, авторизован ли пользователь
        if (Auth::check()) {
            // Если пользователь авторизован, получаем текущего пользователя
            $user = Auth::user();

            // Ищем корзину, связанную с пользователем по user_id
            $cart = Cart::where('user_id', $user->id)->first();

            // Если у пользователя нет корзины с user_id, создаем новую корзину
            if (!$cart) {
                $cart = new Cart();
                $cart->id = Uuid::uuid4()->toString(); 
                $cart->user_id = $user->id;
                $cart->save();
            }

            // Ищем запись о товаре в корзине (CartItem)
            $cartItem = CartItem::where('cart_id', $cart->id)->where('product_id', $request->id)->first();

            // Если товар уже есть в корзине, увеличиваем его количество
            if ($cartItem) {
                $cartItem->quantity += 1;
                $cartItem->save();
            } else {
                // Если товара еще нет в корзине, создаем новую запись CartItem
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $request->id,
                    'quantity' => 1
                ]);
            }

            return response()->json("Товар добавлен в корзину");
        } else {
            $cart_id = $request->cookie('cart_id');

            // Если у пользователя нет куки с cart_id, создаем новую корзину
            if (!$request->hasCookie('cart_id')) {
                $cart = new Cart();
                $cart_id = $cart->id = Uuid::uuid4()->toString();
                $cart->save();

                $product = Product::where('id', $request->id)->first();

                // Создаем новую запись CartItem
                CartItem::create([
                    'cart_id' => $cart_id,
                    'product_id' => $product->id,
                    'quantity' => 1
                ]);

                return response()->json(['message' => 'Товар ' .$cart_id. ' добавлен в корзину'])->cookie('cart_id', $cart_id);
            }

            // В противном случае, если кука cart_id уже существует у пользователя
            $product = Product::where('id', $request->id)->first();
            $cartItem = CartItem::where('cart_id', $cart_id)->where('product_id', $product->id)->first();

            // Если товар уже есть в корзине, увеличиваем его количество
            if ($cartItem) {
                $cartItem->quantity += 1;
                $cartItem->save();
            } else {
                // Если товара еще нет в корзине, создаем новую запись CartItem
                CartItem::create([
                    'cart_id' => $cart_id,
                    'product_id' => $product->id,
                    'quantity' => 1
                ]);
            }

            $message = "Товар ". $cart_id." добавлен в корзину";

            return response()->json($message);
        }






    }
}
