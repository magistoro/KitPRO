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
        $cartItems = collect();

        // Проверяем, вошел ли пользователь в аккаунт
        if (Auth::check()) {
            // Ищем корзину для зарегистрированного пользователя
            $cart = Cart::where('user_id', Auth::user()->id)->first();
    
            if ($cart) {
                // Получаем все элементы корзины
                $cartItems = CartItem::where('cart_id', $cart->id)->with('product')
                ->get();
        }
    } else {
        // Проверяем наличие куки cart_id
        if (request()->hasCookie('cart_id')) {
            $cartId = request()->cookie('cart_id');

            // Поиск записи в таблице Cart по cart_id
            $cart = Cart::where('id', $cartId)->first();

            if ($cart) {
                // Получаем все элементы корзины
                $cartItems = CartItem::where('cart_id', $cart->id)
                    ->with('product')
                    ->get();
            }
        }
    }

        return view('API.cart', compact('cartItems'));
    }


    public function update(Request $request, $id)
{
    $cartItem = CartItem::findOrFail($id);

    // Валидация введенного значения quantity
    $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);

    // Обновление значения quantity
    $cartItem->quantity = $request->quantity;
    $cartItem->save();

    return redirect()->back();
}

public function destroy($id)
{
    $cartItem = CartItem::findOrFail($id);
    $cartItem->delete();

    return redirect()->back();
}


    public function addToCart(Request $request){
       
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
