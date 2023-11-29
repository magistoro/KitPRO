@extends('layouts.admin')

@section('content')
 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Категория</h1>
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
                <a href="{{route('admin.category.edit', $category->id)}}" class="btn btn-primary">Редактировать</a>
              </div>
                <form action="{{route('admin.category.destroy', $category->id)}}" method="post">
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
                <td>{{$category->id}}</td>
            </tr>
            <tr>
              <td>Наименование</td>
              <td>{{$category->name}}</td>
            </tr>

            <tr>
              <td>Транскрипция</td>
              <td>{{$category->slug}}</td>
            </tr>

            <tr>
              <td>Дочерние категории</td>
            <td>
                @if ($category->children->count() > 0)
                    <ul>
                        @foreach ($category->children as $child)
                            <li><a href="{{ route('admin.category.show', $child->id) }}" style="color:black">{{$child->name}}</a></li>
                        @endforeach
                    </ul>
                @else
                    Нет дочерних категорий
                @endif
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
@endsection