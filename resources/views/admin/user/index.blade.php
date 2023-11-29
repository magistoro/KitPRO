@extends('layouts.admin')

@section('content')
 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Пользователи</h1>
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
    <div class="row">
    <div class="col-12">
    <div class="card">
      <div class="card-header">
        <a href="{{route('admin.user.create')}}" class="btn btn-primary">Добавить</a>
    </div>
    <div class="card-body">
    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
      <div class="row">
        <div class="col-sm-12"><table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
    <thead>
    <tr>
      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 7%;">ID</th>
      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Имя</th>
      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Email</th>
      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Роль</th>
    </thead>
    <tbody>
      @foreach($users as $user) 
      <tr class="odd" onclick="window.location='{{ route('admin.user.show', $user->id) }}';" style="cursor: pointer">
        <td class="dtr-control sorting_1" tabindex="0">{{$user->id}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->role->name}}</td>
        </tr>
      @endforeach
    </tbody>
    <tfoot>
    <tr>
      <th rowspan="1" colspan="1">ID</th>
      <th rowspan="1" colspan="1">Имя</th>
      <th rowspan="1" colspan="1">Email</th>
      <th rowspan="1" colspan="1">Роль</th>
    </tr>
    </tfoot>
    </table></div></div></div></div></div></div></div></div>
    </section>
  <!-- /.content -->
@endsection