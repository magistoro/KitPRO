<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\OrderRentProduct;
use App\Models\OrderSoldProduct;
use App\Models\Product;
use App\Models\RentOrder;
use App\Models\SoldOrder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Ramsey\Uuid\Uuid;

class CartController extends Controller
{

    public function index(){

        $cartItems = $this->getCartItems();
        $purchaseItems = $this->filterItemsByCategory($cartItems, 1);

        $cartItems = $this->getCartItems();
        $rentItems = $this->filterItemsByCategory($cartItems, 2);
        
        return view('API.cart', compact('purchaseItems', 'rentItems'));
    }



    public function destroy($id){
    $cartItem = CartItem::findOrFail($id);
    $cartItem->delete();

    return redirect()->back();
    }

    public function update(Request $request, $id){
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


    public function orderBuy(){

    if (auth()->check())   // Получаем данные о вошедшем пользователе
        $user = auth()->user();

        $cartItems = $this->getCartItems();

        $purchaseItems = $this->filterItemsByCategory($cartItems, 1);
        
        if ($purchaseItems->isEmpty()) 
            return redirect()->route('cartIndex');
        
        if (isset($user))
            return view('API.orderBuy', compact('purchaseItems', 'user'));
        else
            return view('API.orderBuy', compact('purchaseItems'));
    }
    
    public function orderRent(){
        $user = auth()->user();

        $cartItems = $this->getCartItems();
    
        $rentItems = $this->filterItemsByCategory($cartItems, 2);
    
        if ($rentItems->isEmpty()) 
            return redirect()->route('cartIndex');
        

        if (isset($user))
            return view('API.orderRent', compact('rentItems', 'user'));
        else
            return view('API.orderRent', compact('rentItems'));
    }
    
    private function getCartItems(){
        $cartItems = collect();
    
        // Проверяем, вошел ли пользователь в аккаунт
        if (Auth::check()) {
            // Ищем корзину для зарегистрированного пользователя
            $cart = Cart::where('user_id', Auth::user()->id)->first();
        
            if ($cart) {
                // Получаем все элементы корзины
                $cartItems = CartItem::where('cart_id', $cart->id)->with('product')->get();
            }
        } else {
            // Проверяем наличие куки cart_id
            if (request()->hasCookie('cart_id')) {
                $cartId = request()->cookie('cart_id');
            
                // Поиск записи в таблице Cart по cart_id
                $cart = Cart::where('id', $cartId)->first();
            
                if ($cart) {
                    // Получаем все элементы корзины
                    $cartItems = CartItem::where('cart_id', $cart->id)->with('product')->get();
                }
            }
        }
    
        return $cartItems;
    }
    
    private function filterItemsByCategory($cartItems, $rootCategoryId){
        $rootCategory = Category::find($rootCategoryId);

        $descendantIds = $rootCategory->descendants()->pluck('id')->toArray();
        $descendantIds[] = $rootCategoryId;
    
        $filteredItems = $cartItems->whereIn('product.category_id', $descendantIds);
    
        return $filteredItems;
    }


    //CHECKOUT

    public function orderBuyCheckout(Request $request)
    {    
         // Инициализация переменных
    $userId = null;
    $cartId = null;

         // Проверяем, зарегистрирован ли пользователь
    if (Auth::check()) {
        $user = Auth::user();
        $userId = $user->id;
        // dd($userId);
    } else {
        // Если пользователь не зарегистрирован, проверяем куки на наличие cart_id
        $cartId = $request->cookie('cart_id');

        // Если куки cart_id существует, то создаем пользователя с email из запроса и генерируем пароль
        if ($cartId) {
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make(Str::random(8)),
                'role_id' => '1'
            ]);
            $userId = $user->id;
        } else {
            // Если cart_id не существует в куках, возможно выполнить другую логику или вернуть ошибку
            return response()->json(['error' => 'Не удалось найти пользователя или cart_id'], 400);
        }
    }

    // Поиск корзины для пользователя
    $cart = Cart::where('user_id', $userId)->orWhere('id', $cartId)->first();

    // Если корзины не существует, возможно выполнить другую логику или вернуть ошибку
    if (!$cart) {
        return response()->json(['error' => 'Корзина не найдена'], 404);
    }

    // Оформление заказа

    $soldOrder = SoldOrder::create([
        'customer_to' => $request->input('name'),
        'customer_phone' => $request->input('phone'),
        'customer_email' => $request->input('email'),
        'address' => $request->input('address'),
        'comment' => $request->input('comment'),
        'user_id' => $userId,
    ]);

    // Обработка продуктов в корзине и их добавление в таблицу order_sold_products
    $cartItems = CartItem::where('cart_id', $cart->id)->get();

    foreach ($cartItems as $item) {
        OrderSoldProduct::create([
            'sold_order_id' => $soldOrder->id,
            'product_id' => $item->product_id,
            'quantity' => $item->quantity,
        ]);
    }

    // Удаление всех позиций корзины пользователя
    CartItem::where('cart_id', $cart->id)->delete();

    return response()->json(['success' => 'Заказ успешно оформлен']);
}



    public function orderRentCheckout(Request $request){
     // Инициализация переменных
    $userId = null;
    $cartId = null;

    // Проверяем, зарегистрирован ли пользователь
    if (Auth::check()) {
        $user = Auth::user();
        $userId = $user->id;
        // dd($userId);
    } else {
        // Если пользователь не зарегистрирован, проверяем куки на наличие cart_id
        $cartId = $request->cookie('cart_id');

        // Если куки cart_id существует, то создаем пользователя с email из запроса и генерируем пароль
        if ($cartId) {
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make(Str::random(8)),
                'role_id' => '1'
            ]);
            $userId = $user->id;
        } else {
            // Если cart_id не существует в куках, возможно выполнить другую логику или вернуть ошибку
            return response()->json(['error' => 'Не удалось найти пользователя или cart_id'], 400);
        }
    }

    // Поиск корзины для пользователя
    $cart = Cart::where(function ($query) use ($userId, $cartId) {
        $query->where('user_id', $userId)
            ->orWhere('id', $cartId);
    })->first();

    // Если корзины не существует, возможно выполнить другую логику или вернуть ошибку
    if (!$cart) {
        return response()->json(['error' => 'Корзина не найдена'], 404);
    }

    // Оформление аренды

    $rentOrder = RentOrder::create([
        'customer_to' => $request->input('name'),
        'customer_phone' => $request->input('phone'),
        'customer_email' => $request->input('email'),
        'address' => $request->input('address'),
        'comment' => $request->input('comment'),
        'user_id' => $user->id,
        'rent_start' => \Carbon\Carbon::createFromFormat('d.m.Y', $request->input('start_date'))->format('Y-m-d'),
        'rent_end' => \Carbon\Carbon::createFromFormat('d.m.Y', $request->input('end_date'))->format('Y-m-d'),
    ]);

    // Обработка продуктов в корзине и их добавление в таблицу order_rent_products
    $cartItems = CartItem::where('cart_id', $cart->id)->get();

    foreach ($cartItems as $item) {
        OrderRentProduct::create([
            'rent_order_id' => $rentOrder->id,
            'product_id' => $item->product_id,
            'return_date' => null,
        ]);
    }

    // Удаление всех позиций корзины пользователя
    CartItem::where('cart_id', $cart->id)->delete();


    return response()->json(['success' => 'Заказ аренды успешно оформлен']);
}
}