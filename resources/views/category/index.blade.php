@extends('layouts.main')

@section('content')

@php
    $page_scss = 'resources/scss/pages/categories.scss';
@endphp

<section class="categories">
    <div class="_container">
        <div class="categories__body">
            <h1>{{ $category->name }}</h1>
            {{-- Breadcrumbs --}}
            <div class="breadcrumbs">
                @foreach($breadcrumbs as $i => $breadcrumb)
                    <a href="{{ route('categories.index', ['category'=> $breadcrumb['slug']]) }}" class="breadcrumb"> {{$breadcrumb['name']}}</a>
                @endforeach
            </div>

            <div class="categories__grid">
                @foreach ($children as $child)
                    <a href="{{ route('categories.index', ['category'=> $child['slug']]) }}" class="categories__item _ibg">
                        <img src="Content/Category/thumbnails/{{ $child['thumbnail'] }}" alt="{{$child['slug']}} thumbnail">
                        <p>{{ $child['name'] }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection