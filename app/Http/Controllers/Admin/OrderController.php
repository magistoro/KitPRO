<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sale\UpdateRequest;
use App\Models\Category;
use App\Models\OrderSoldProduct;
use App\Models\Product;
use App\Models\RentOrder;
use App\Models\SoldOrder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
    $sold_orders = SoldOrder::with('orderSoldProducts.product')->get();
       return view('admin.sale.index', compact('sold_orders'));
    }

    public function show(SoldOrder $soldOrder)
    {
        // dd($soldOrder);
        $orderSoldProducts = $soldOrder->orderSoldProducts()->with('product')->get();
        if ($soldOrder->cancelled_at) {
            $soldOrder->status = 'Отменён';
        } else if ($soldOrder->delivered_at) {
            $soldOrder->status = 'Получено';
        } elseif ($soldOrder->dispatched_at) {
            $soldOrder->status = 'Отправлено';
        } elseif ($soldOrder->assembled_at) {
            $soldOrder->status = 'Собран';
        } else {
            $soldOrder->status = 'Новый';
        }
        return view('admin.sale.show', compact('soldOrder', 'orderSoldProducts'));
    }

    public function edit(SoldOrder $soldOrder)
    {
        $users = User::all();
        $products = Product::all();
        $orderSoldProducts = $soldOrder->orderSoldProducts()->with('product')->get();
        return view('admin.sale.edit', compact('soldOrder', 'orderSoldProducts', 'users', 'products'));
    }

    public function update(SoldOrder $soldOrder, UpdateRequest $request)
    {
        $data = $request->validated(); 

        $productData = $request->input('product_data');
        $products = json_decode($productData, true);

         // Если в заказе нет товаров, просто вернуться без внесения изменений
        if (empty($products)) {
        return redirect()->route('admin.sale.edit', $soldOrder)->with('info', 'Заказ не содержит товаров. Продолжить невозможно.');
        }
    
          // Удаление старых продуктов через отношение
        $soldOrder->orderSoldProducts()->delete();

        foreach ($products as $product) {
            $orderSoldProduct = new OrderSoldProduct();
            $orderSoldProduct->sold_order_id = $soldOrder->id;
            $orderSoldProduct->product_id = $product['id'];
            $orderSoldProduct->quantity = $product['quantity'];
    
            // Обновление значения поля assembled_at
            if ($product['assembled']) {
                $orderSoldProduct->assembled_at = now();
            }

            // $data = $request->validated();
            $soldOrder->update($data);
            $soldOrder->save();
            $orderSoldProduct->save();
        }

    return redirect()->route('admin.sale.show', $soldOrder)->with('success', 'Заказ успешно обновлён!');
    }


    public function updateStatus(Request $request, SoldOrder $soldOrder)
    {
        // Проверяем, что кнопка нажата
        if ($request->has('status')) {
            // Получаем новый статус из кнопки
            $newStatus = $request->status;

            // Обновляем соответствующую колонку в БД в зависимости от нового статуса
            switch ($newStatus) {
                case 'Собрано':
                    $soldOrder->assembled_at = now();
                    $soldOrder->dispatched_at = null;
                    $soldOrder->delivered_at = null;
                    $soldOrder->cancelled_at = null;
                    break;
                case 'Отправлено':
                    // $soldOrder->assembled_at = now();
                    $soldOrder->dispatched_at = now();
                    $soldOrder->delivered_at = null;
                    $soldOrder->cancelled_at = null;
                    break;
                case 'Получено':
                    // $soldOrder->assembled_at = now();
                    // $soldOrder->dispatched_at = now();
                    $soldOrder->delivered_at = now();
                    $soldOrder->cancelled_at = null;
                    break;
                case 'Отменён':
                    // $soldOrder->assembled_at = null;
                    // $soldOrder->dispatched_at = null;
                    // $soldOrder->delivered_at = null;
                    $soldOrder->cancelled_at = now();
                    break;

                default:
                    // Если был передан неправильный статус, ничего не изменяем
                    return redirect()->back();
            }

            // Сохраняем изменения в БД
            $soldOrder->save();
        }

        // Перенаправляем на страницу с деталями заказа
        return redirect()->route('admin.sale.show', $soldOrder)->with('success', 'Статус успешно сменен на '.$newStatus.'!');
    }




    public function getNotifications(Request $request) // Для отправки уведомлений
    {
        $notifications = SoldOrder::where('created_at', '>=', Carbon::now()->subSeconds(5))
        ->orderBy('created_at', 'desc')
        ->get();

    $html = view('layouts.notifications', compact('notifications'))->render();

    // return response()->json(['html' => $html]);


    // Проверяем, есть ли новые заказы
    $hasNewNotifications = SoldOrder::where('created_at', '>=', Carbon::now()->subSeconds(5))
        ->exists();

    // Получаем HTML-код для уведомлений
    // $html = view('layouts.notifications')->render();

    return response()->json(['html' => $html, 'hasNewNotifications' => $hasNewNotifications]);
}

}
