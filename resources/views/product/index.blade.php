@extends('layouts.main')

@php
    $page_scss = 'resources/scss/pages/products.scss';
@endphp

@section('content')
<section class="products">
    <div class="_container">
        <div class="products__body">
            <h1>{{ $category->name }}</h1>
            {{-- Breadcrumbs --}}
            <div class="breadcrumbs">
                @foreach($breadcrumbs as $i => $breadcrumb)
                    <a href="{{ route('categories.index', ['category'=> $breadcrumb['slug']]) }}" class="breadcrumb"> {{$breadcrumb['name']}}</a>
                @endforeach
            </div>

            <div class="products__cards">
                @foreach ($products as $product)
                    <a href="{{ route('products.show', ['category'=> $category->slug, 'product'=> $product->slug]) }}" class="products__card card">
                        <div class="content-wrap">
                            <img src="Content/Product/thumbnails/{{ $product->thumbnail }}" alt="{{$product->slug}} thumbnail">
    
                            <p class="card__name">{{ $product->name }}</p>
    
                            <div class="rat-art-price-wrap">
                                <img src="img/rating-stars.svg" alt="рейтинг">
                                
                                <p class="articul">Артикул: BCJ-XJ-TRC</p>
        
                                <p class="price">{{$product->price}} {{$product->type->name == 'prodazha' ? '₽/шт' : '₽/смен'}}</p>
                            </div>
                        </div>
                        
                        <span class="btn btn-normal btn-primary add-to-cart-btn">В корзину</span>
                    </a>
                @endforeach
            </div>

            
        </div>
    </div>
</section>
@endsection