@extends('layouts.statusPopUp')
@extends('layouts.admin')

@section('content')
 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Заказ</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Главная</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

   <!-- Main content -->
   <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header d-flex p-3" >
              <div class="mr-3">
                <a href="{{route('admin.sale.edit',  $soldOrder->id)}}" class="btn btn-primary">Редактировать</a>
              </div>

            


              <div class="dropdown mr-3">
                <button class="btn btn-primary dropdown-toggle" type="button" id="statusDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Выберите статус
                </button>
                <div class="dropdown-menu" aria-labelledby="statusDropdown">
                    <form action="{{route('admin.sale.updateStatus', $soldOrder->id)}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" name="status" value="Собрано" class="dropdown-item bg-{{ ($soldOrder->status === 'Новый') ? 'success' : 'danger' }}">Собрать заказ</button>
                        <button type="submit" name="status" value="Отправлено" class="dropdown-item bg-{{ ($soldOrder->status === 'Собран') ? 'success' : 'danger' }}">Отправить заказ</button>
                        <button type="submit" name="status" value="Получено" class="dropdown-item bg-{{ ($soldOrder->status === 'Отправлено') ? 'success' : 'danger' }}">Получить заказ</button>

                        <button type="submit" name="status" value="Отменён" class="dropdown-item bg-warning">Отменить</button>
                    </form>
                </div>
            </div>
            

            
              <div class="mr-3">
                @if ($soldOrder->status === 'Получено')
                <a class="btn btn-success">Статус: {{ $soldOrder->status }}</a>
                @elseif ($soldOrder->status === 'Отменён')
                <a class="btn btn-dark ">Статус: {{ $soldOrder->status }}</a>
                @elseif ($soldOrder->status === 'Отправлено')
                <a class="btn btn-warning">Статус: {{ $soldOrder->status }}</a>
                @elseif ($soldOrder->status === 'Собран')
                <a class="btn btn-danger">Статус: {{ $soldOrder->status }}</a>
                @else
                <a class="btn btn-info">Статус: {{ $soldOrder->status }}</a>
                @endif
              </div>
                {{-- <form action="{{route('admin.order.sale.destroy', $soldOrder->id)}}" method="post">
                  @csrf
                  @method('delete')
                  <input type="submit" class="btn btn-danger" value="Удалить">
                </form> --}}
            </div>
            
            <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">

            <tbody>
            <tr>
                <td>ID</td>
                <td>{{$soldOrder->id}}</td>
            </tr>

            <tr>
                <td>Имя создателя аакаунта</td>
                <td><a href="{{ route('admin.user.show', $soldOrder->user->id) }}">{{$soldOrder->user->name}}</a></td>
            </tr>

            <tr>
              <td>Имя получателя заказа</td>
              <td>{{$soldOrder->customer_to}}</td>
            </tr>

            <tr>
              <td>Телефон</td>
              <td class="text-wrap">{{ $soldOrder->customer_phone }}</td>
            </tr>

            <tr>
              <td>Email</td>
              <td>{{$soldOrder->customer_email}}</td>
            </tr>

            <tr>
              <td>Адрес</td>
              <td>{{$soldOrder->address}}</td>
            </tr>

            <tr>
              <td>Коментарий</td>
              <td>{{$soldOrder->comment}}</td>
            </tr> 
           
            </tbody>
            </table>

          </div>
        </div>

          <div class="col-12">
            <div class="card">
              <table class="table pt-5">
                <thead>
                    <tr>
                        <th>Товары в заказе</th>
                        <th>Цена товара</th>
                        <th>Количество</th>
                        <th>Общая цена</th>
                        <th>Статус сборки</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orderSoldProducts as $orderSoldProduct)
                        <tr>
                            <td>{{ $orderSoldProduct->product->name }}</td>
                            <td>{{ $orderSoldProduct->product->price }}</td>
                            <td>{{ $orderSoldProduct->quantity }}</td>
                            <td>{{ $orderSoldProduct->product->price *  $orderSoldProduct->quantity }}</td>
                            <td>
                              <div class="checkbox icheck">
                                  <label>
                                      <input type="checkbox" disabled @if($orderSoldProduct->assembled_at) checked @endif>
                                      <span></span>
                                  </label>
                              </div>
                          </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->

  <style>

.checkbox.icheck label input[type="checkbox"] {
    display: none;
}

.checkbox.icheck label input[type="checkbox"] + span {
    display: inline-block;
    width: 20px;
    height: 20px;
    position: relative;
    border: 1px solid #ccc;
    background-color: #fa5050;
}

.checkbox.icheck label input[type="checkbox"] + span::before {
    content: "\2713";
    display: none;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
}

.checkbox.icheck label input[type="checkbox"]:checked + span {
    background-color: #51cd51;
}

.checkbox.icheck label input[type="checkbox"]:checked + span::before {
    display: block;
}
  </style>

 
@endsection
