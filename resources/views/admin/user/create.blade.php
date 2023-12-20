@extends('layouts.admin')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Добавить пользователя</h1>
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
      <form action="{{ route('admin.user.store')}}" method="post" enctype="multipart/form-data">
        @csrf 

        <div class="form-group">
          <input type="text" name="name" class="form-control" placeholder="Имя">
        </div>

        <div class="form-group">
          <input type="text" name="name" class="form-control" placeholder="Email">
        </div>


        <div class="form-group">
          <input type="text" name="name" class="form-control" placeholder="Имя">
        </div>

        <div class="form-group">
          <select name="parent_id" class="form-control category type  select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
            <option selected="selected" disabled data-select2-id="">Выберите роль</option>
            @foreach($roles as $role)
            <option value="{{$role->id}}">{{$role->name}}</option>                
            @endforeach
            </select>
          </div>

        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Добавить">
        </div>
      </form>
    </div>
  </div><!-- /.container-fluid -->
</section>
  <!-- /.content -->
@endsection