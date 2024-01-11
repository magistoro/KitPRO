@extends('layouts.main')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
      <!-- Theme style -->

      <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
      <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('adminlte/plugins/daterangepicker/daterangepicker.css')}}">
 
@php
    $page_scss = 'resources/scss/pages/cart.scss';
@endphp

<section class="home">
    <div class="_container">
        <div class="home__body">
          <h1>Арендовать</h1>
          
          <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 card">
                    <h3 class="cart-header">Данные по доставке</h3>
                    <form id="orderForm"  action="{{ route('orderRentCheckout') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Имя</label>
                            <input type="text" class="form-control bg-light" id="name" name="name" {{ isset($user) ? 'readonly' : '' }}  value="{{ isset($user->name) ? $user->name : '' }}" required>
                        </div>

                        <div class="form-group align-items-center">
                            <label>Телефон</label>
                            <div class="input-group">
                            <div class="input-group-prepend" >
                                <span class="input-group-text h-100" style="border-radius: 5px 0 0 5px"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="text" class="form-control h-100" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask="" inputmode="text" id="phone" name="phone">
                            </div>
                            
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"   {{ isset($user) ? 'readonly' : '' }}  value="{{ isset($user->email) ? $user->email : '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Адрес</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="form-group">
                            <label for="comment">Комментарий</label>
                            <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                        </div>

                        <div class="form-group mb-3">

                            <label>Диапазон дат:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text  h-100"   style="border-radius: 5px 0 0 5px"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control float-right" id="reservation">
                            </div>
                            
                        </div>
                        <input type="hidden" id="start_date" name="start_date">
                        <input type="hidden" id="end_date" name="end_date">
                    </form>
                </div>
                <div class="col-md-8  mt-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            @if ($rentItems->count() > 0)
                                <h3 class="cart-header">Товары для аренды</h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Наименование</th>
                                            <th>Цена</th>
                                            <th>Количество</th>
                                            <th>Всего</th>
                                            <th>Действие</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rentItems as $item)
                                            <tr>
                                                <td>
                                                    <img src="Content/Product/thumbnails/{{ $item->product->thumbnail }}" alt="{{ $item->product->name }}" width="50px" height="50px">
                                                </td>
                                               <td class="pt-4"> <a href="{{ route('products.show', ['category'=> $item->product->category->slug, 'product'=> $item->product->slug]) }}">{{ \Illuminate\Support\Str::limit($item->product->name, 30) }}</a></td>
                                                <td class="pt-4">{{ $item->product->price }}</td>
                                                <td class="pt-3">
                                                    <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control" style="width: 60px; margin-left:10px">
                                                        <button type="submit" class="btn btn-sm btn-primary ml-2">Update</button>
                                                    </form>
                                                </td>
                                                <td  class="pt-4">{{ $item->product->price * $item->quantity }}</td>
                                                <td class="pt-3">
                                                    <form action="{{ route('cart.destroy', $item->id) }}" method="POST" class="d-flex">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-sm btn-primary "><i class="fas fa-trash  p-2"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <p class="pl-3 mt-1">Итоговая цена: <span class="total-price"></span></p>
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

<script src="{{asset('adminlte/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('adminlte/plugins/inputmask/jquery.inputmask.min.js')}}"></script>

<script>
     
   $('#reservation').daterangepicker({
    locale: {
      format: 'DD.MM.YYYY',
      separator: ' - ',
      applyLabel: 'Применить',
      cancelLabel: 'Отмена',
      fromLabel: 'От',
      toLabel: 'До',
      customRangeLabel: 'Выбрать интервал',
      weekLabel: 'Н',
      daysOfWeek: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
      monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
      firstDay: 1
    },
        startDate: moment().startOf(1, 'day').add('day'),
        minDate: moment().startOf('day') // Установите минимальную дату на текущую дату, начиная с полуночи
    });

    $('input[data-mask]').inputmask();
    
    $('#reservation').on('apply.daterangepicker', function(ev, picker) {
        calculateTotalPrice();
    });

    function calculateTotalPrice() {
        var totalPrice = 0;

        // Получите значение выбранного диапазона дат
        var startDate = $('#reservation').data('daterangepicker').startDate;
        var endDate = $('#reservation').data('daterangepicker').endDate;

        // Получите количество дней между датами
        var duration = moment.duration(endDate.diff(startDate)).asDays();

        // Пройдитесь по каждому товару и добавьте его стоимость за день умноженную на количество дней
        @foreach ($rentItems as $item)
          var pricePerDay = {{ $item->product->price }};
          var quantity = {{ $item->quantity }};
          var itemTotalPrice = Math.round(pricePerDay * quantity * duration / 10) * 10;
          totalPrice += itemTotalPrice;
        @endforeach

        // Отобразите общую стоимость и скидку
        $('.total-price').text(totalPrice.toFixed(2));
        $('.discount').text((totalPrice - Math.floor(totalPrice)).toFixed(2));

        // Получить значения дат начала и конца аренды
        var startDate = $('#reservation').data('daterangepicker').startDate.format('DD.MM.YYYY');
        var endDate = $('#reservation').data('daterangepicker').endDate.format('DD.MM.YYYY');

        // Установить значения в скрытые input поля
        $('#start_date').val(startDate);
        $('#end_date').val(endDate);
    }
    document.addEventListener("DOMContentLoaded", function() {
    calculateTotalPrice();
})



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
            if (!phone) {
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
 
</script>
@endsection