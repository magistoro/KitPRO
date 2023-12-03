<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
    // Проверяем наличие куки cart_id
    if ($request->hasCookie('cart_id')) {

        $cartId = $request->cookie('cart_id');
        
        // Находим запись в таблице Cart с указанным cart_id
        $cart = Cart::where('id', $cartId)->first();
        
        // Проверяем, есть ли запись с user_id = id текущего пользователя
        $existingCart = Cart::where('user_id', Auth::id())->first();
        
        // Если такая запись существует, удаляем запись с cart_id
        if ($existingCart) {
            $cart->delete();
            // Удаление куки cart_id
            return redirect()->intended($this->redirectPath())->withCookie(Cookie::forget('cart_id'));
        } else {
            // Устанавливаем user_id для найденной записи
             if ($cart) {
                $cart->user_id = Auth::id();
                $cart->save();
                // Удаление куки cart_id
                return redirect()->intended($this->redirectPath())->withCookie(Cookie::forget('cart_id'));
             }
        }
    }

    return redirect()->intended($this->redirectPath());
}
}
