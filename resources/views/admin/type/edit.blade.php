@extends('layouts.admin')

@section('content')

  <!-- Main content -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Редактировать категорию</h1>
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
        <form action="{{ route('admin.category.update', $category->id)}}" method="post">
          @csrf 
          @method('patch')
          <div class="form-group">
            <input type="text" name="name" class="form-control" value="{{$category->name ?? old('name')}}" placeholder="Наименование">
          </div>

          <div class="form-group">
            <div class="input-group">
              <div class="custom-file">
                <input name="thumbnail" type="file" class="custom-file-input" id="exampleInputFile">
                <label class="custom-file-label" for="exampleInputFile">Изображение категории</label>
              </div>
            </div>
          </div>

          <div class="form-group">
            <select name="parent_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
              <option selected="selected" disabled data-select2-id="">Выберите категорию</option>
              @foreach($categories as $categoryy)
              <option value="{{$categoryy->id}}" {{$category->parent_id == $categoryy->id ? 'selected' : ''}}>{{$categoryy->name}}</option>                
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Редактировать">
          </div>
        </form>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection