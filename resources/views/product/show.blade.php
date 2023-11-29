@extends('layouts.main')

@php
    $page_scss = 'resources/scss/pages/single-product.scss';
@endphp

@section('content')
<section class="product">
    <div class="_container">
        <div class="product__body">
            <h1>{{ $product->name }}</h1>
            {{-- Breadcrumbs --}}
            <div class="breadcrumbs">
                @foreach($breadcrumbs as $i => $breadcrumb)
                    <a href="{{ route('categories.index', ['category'=> $breadcrumb['slug']]) }}" class="breadcrumb"> {{$breadcrumb['name']}}</a>
                @endforeach
            </div>

            PRODUCT <br>    
            <img src="Content/Product/images/{{ $product->image }}" alt="{{$product->slug}} image">
            
        </div>
    </div>
</section>
@endsection