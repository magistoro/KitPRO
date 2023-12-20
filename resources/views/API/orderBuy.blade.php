@extends('layouts.main')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('adminlte/css.css')}}">
@php
    $page_scss = 'resources/scss/pages/cart.scss';
@endphp

<section class="home">
    <div class="_container">
        <div class="home__body">
          <h1>Оформление заказа</h1>
          
          <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 card">
                    <h3 class="cart-header">Данные по доставке</h3>
                    <form id="orderForm"  action="{{ route('orderBuyCheckout') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Имя</label>
                            <input type="text" class="form-control bg-light" id="name" name="name" {{ isset($user) ? 'readonly' : '' }}  value="{{ isset($user->name) ? $user->name : '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Телефон</label>
                            <input type="tel" class="form-control" id="phone" name="phone" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"   {{ isset($user) ? 'readonly' : '' }}  value="{{ isset($user->email) ? $user->email : '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Адрес</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="comment">Комментарий</label>
                            <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="col-md-8 mt-3">
                    <div class="card">
                        <div class="card-body">
                            @if ($purchaseItems->count() > 0)
                                <h3 class="cart-header">Товары в корзине</h3>
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
                                        @php $totalCost = 0; @endphp
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
                                                   <!-- Код действия удаления для "Купить" -->
                                                </td>
                                            </tr>
                                            @php $totalCost += $item->product->price * $item->quantity;   @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="form-group">
                                    <p>Общая стоимость:  {{ $totalCost }} &#8381;</p>
                                </div>
                                <button type="button" id="submitBtn" class="btn btn-success btn-lg mb-3">Оформить</button>
                                <div id="errorMessages" class="alert alert-danger d-none"></div>
                            @endif   
                        </div>
                    </div>
                </div>
            </div>
          </div> 
        </div>
    </div>
</div>
</section>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>   
<script>
$(document).ready(function() {

    $('#submitBtn').click(function() {
        var name = $('#name').val();
        var phone = $('#phone').val();
        var email = $('#email').val();
        var address = $('#address').val();

        if (name === '' || phone === '' || email === '' || address === '') {
            var errorMessages = [];
            if (name === '') {
                errorMessages.push('Пожалуйста, введите имя');
            }
            if (phone === '') {
                errorMessages.push('Пожалуйста, введите телефон');
            }
            if (email === '') {
                errorMessages.push('Пожалуйста, введите email');
            }
            if (address === '') {
                errorMessages.push('Пожалуйста, введите адрес');
            }
  displayErrorMessages(errorMessages);
                    return;
                }

                if (!isValidEmail(email)) {
                    displayErrorMessages(['Пожалуйста, введите корректный email']);
                    return;
                }

                // Если все проверки пройдены, отправляем форму
                $('#orderForm').submit();
            });

            function isValidEmail(email) {
                var re = /\S+@\S+\.\S+/;
                return re.test(email);
            }

            function displayErrorMessages(messages) {
                var errorMessagesDiv = $('#errorMessages');
                errorMessagesDiv.empty();
                errorMessagesDiv.removeClass('d-none');

                var messagesHtml = '';
                messages.forEach(function(message) {
                    messagesHtml += '<p>' + message + '</p>';
                });

                errorMessagesDiv.html(messagesHtml);
            }
        });
</script>
@endsection
    