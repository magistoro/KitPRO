@extends('layouts.main')

@section('content')

@php
    $page_scss = 'resources/scss/pages/cart.scss';
@endphp

<section class="home">
    <div class="_container">
        <div class="home__body">
          <h1>Корзина</h1>
          
          <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            @if ($purchaseItems->count() > 0)
                                <h3 class="cart-header">Купить</h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($purchaseItems as $item)
                                            <tr>
                                                <td>
                                                    <img src="Content/Product/thumbnails/{{ $item->product->thumbnail }}" alt="{{ $item->product->name }}" width="50px" height="50px">
                                                </td>
                                               <td> <a href="{{ route('products.show', ['category'=> $item->product->category->slug, 'product'=> $item->product->slug]) }}">{{ $item->product->name }}</a></td>
                                                <td>{{ $item->product->price }}</td>
                                                <td>
                                                    <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control" style="width: 60px; margin-left:10px">
                                                        <button type="submit" class="btn btn-sm btn-primary ml-2">Update</button>
                                                    </form>
                                                </td>
                                                <td>{{ $item->product->price * $item->quantity }}</td>
                                                <td>
                                                    <form action="{{ route('cart.destroy', $item->id) }}" method="POST" class="d-flex">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-sm btn-primary ml-2">Удалить</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <a class="cart-order" href="{{ route('orderBuy') }}">Оформить</a>
                            @endif
        
                            @if ($rentItems->count() > 0)
                                <h3 class="cart-header">Арендовать</h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rentItems as $item)
                                            <tr>
                                                <td>
                                                    <img src="Content/Product/thumbnails/{{ $item->product->thumbnail }}" alt="{{ $item->product->name }}" width="50px" height="50px">
                                                </td>
                                                <td> <a href="{{ route('products.show', ['category'=> $item->product->category->slug, 'product'=> $item->product->slug]) }}">{{ $item->product->name }}</a></td>
                                                <td>{{ $item->product->price }}</td>
                                                <td>
                                                    <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control" style="width: 60px; margin-left:10px">
                                                        <button type="submit" class="btn btn-sm btn-primary ml-2">Update</button>
                                                    </form>
                                                </td>
                                                <td>{{ $item->product->price * $item->quantity }}</td>
                                                <td>
                                                    <form action="{{ route('cart.destroy', $item->id) }}" method="POST" class="d-flex">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-sm btn-primary ml-2">Удалить</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <a class="cart-order" href="{{ route('orderRent') }}">Арендовать</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
 

        </div>
    </div>
</section>
@endsection