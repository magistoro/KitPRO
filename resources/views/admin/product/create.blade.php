@extends('layouts.admin')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Добавить продукт</h1>
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
      <form action="{{ route('admin.products.store')}}" method="post" enctype="multipart/form-data">
        @csrf 

        <div class="form-group">
          <input type="text" name="name" class="form-control" placeholder="Наименование">
        </div>

        <div class="form-group">
            <textarea id="description" name="description" class="form-control autosize" rows="3" maxlength="1024" placeholder="Описание" style="min-height: 200px; max-height: 1000px;"></textarea>
        </div>

        <div class="form-group">
            <input type="number" min="0" name="price" class="form-control" placeholder="Цена">
          </div>

        <div class="form-group">
            <input type="number" min="0" name="items_in_stock" class="form-control" placeholder="Количество на складе">
        </div>

        <div class="form-group">
          <div class="input-group">
            <div class="custom-file">
              <input name="thumbnail" type="file" class="custom-file-input" id="exampleInputFile">
              <label class="custom-file-label" for="exampleInputFile">Изображение продукта</label>
            </div>
          </div>
        </div>

        <div class="form-group">
        <select name="category_id" class="form-control category type  select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
          <option selected="selected" disabled data-select2-id="">Выберите категорию</option>
          @foreach($categories as $category)
          <option value="{{$category->id}}">{{$category->name}}</option>                
          @endforeach
          </select>
        </div>

        {{-- В случае добавления типов --}}
        <div class="form-group">
            <select name="type_id" class="form-control category  select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
              <option selected="selected" disabled data-select2-id="">Выберите тип</option>
              @foreach($types as $type)
              <option value="{{$type->id}}">{{$type->name}}</option>                
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



{{-- 
<div class="container">
    
    <h1>Create book</h1>
   

    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
  

    <form method="POST" action="{{ route('admin.books.store') }}"  enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label>Name:</label>
            <input 
                name="name" 
                value="{{ old('name') }}"
                type="text" 
                class="form-control" 
            >
        </div>

       
        <div class="form-group">
            <label>Description:</label>
            <textarea 
                name="description" 
                cols="30" 
                rows="10"
                class="form-control" 
            >{{ old('description') }}</textarea>
        </div>


        <div class="form-group">
        <label>Category:</label>
            
            <select 
                name="category_id" 
                class="form-control" 
            >
              @foreach ($categories as $category)
                  <option value="{{ $category->id }}" {{ ($category->id == old('category_id')?"selected":"") }}>{{ $category->name }}</option>
              @endforeach
            </select>
        </div>



        <div class="form-group">
            <label>Price:</label>
            <input 
                name="price"
                value="{{ old('price') }}"
                pattern="[0-9]+([\.,][0-9]+)?" 
                step="0.01"
                type="number" 
            >
        </div>

       
        <div class="form-group">
            <label>Items in stock:</label>
            <input 
                name="items_in_stock"
                value="{{ old('items_in_stock') }}"
                type="number" 
            >
        </div>


    
        <div class="form-group">
            <label>File:</label>
            <input 
                name="file"
                type="file" 
            >
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    @error('name')
       <span class="text-danger">{{ $message }}</span> <br>
    @enderror

</div> --}}
