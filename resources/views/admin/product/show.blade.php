@extends('layouts.admin')

@section('content')
 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Продукт</h1>
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
                <a href="{{route('admin.products.edit', $product->id)}}" class="btn btn-primary">Редактировать</a>
              </div>
                <form action="{{route('admin.products.destroy', $product->id)}}" method="post">
                  @csrf
                  @method('delete')
                  <input type="submit" class="btn btn-danger" value="Удалить">
                </form>
            </div>
            
            <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">

            <tbody>
            <tr>
                <td>ID</td>
                <td>{{$product->id}}</td>
            </tr>
            <tr>
              <td>Наименование</td>
              <td>{{$product->name}}</td>
            </tr>

            <tr>
              <td>Описание</td>
              <td class="text-wrap">{{ $product->description }}</td>
            </tr>

            <tr>
              <td>Цена</td>
              <td>{{$product->price}}</td>
            </tr>

            <tr>
              <td>Остаток на складе</td>
              <td>{{$product->items_in_stock}}</td>
            </tr>

            <tr>
              <td>Категория</td>
              <td>{{$product->category->name}}</td>
            </tr>

            <tr>
              <td>Тип</td>
              <td>{{$product->type->name}}</td>
            </tr>

            <tr>
              <td>Транскрипция</td>
              <td>{{$product->slug}}</td>
            </tr>

            <tr>
              <td>Фото</td>
              <td>
                {{-- <img src="/Content/product/thumbnails/{{$product->thumbnail}}" alt="{{$product->thumbnail}}" style="max-width: 30%"> --}}
                <img src="/Content/product/thumbnails/{{$product->thumbnail}}" alt="{{$product->thumbnail}}" style="max-width: 30%">
              </td>
            </tr>

           
            </tbody>
            </table>
            </div>
            
            </div>
            
            </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->

  @extends('layouts.statusPopUp')
@endsection