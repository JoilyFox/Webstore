@extends('layouts.main')

{{-- Title --}}
@section('title', $search)

{{-- CSS --}}
@section('css')
    <link rel="stylesheet" href="/css/category-page.css">
@endsection

{{-- Header --}}
@section('header')
    
    <div class="captionAndSorting">
        <a class="categoryName cursor-pointer">
            <h2>Search: {{$search}}</h2>
        </a>
    </div>

@endsection

{{-- Content --}}
@section('content')

    <div class="products">

        @if (count($products) !== 0)
            @foreach ($products as $product)

                @php
                    $image = '';
                    if (count($product->images) > 0) {
                        $image = $product->images[0]['img'];
                    } else {
                        $image = 'no_image.jpg';
                    }
                    
                @endphp
                
                <a href="{{route('getProduct', [$product->subcategory->category['slug'], $product->subcategory['slug'], $product['slug']])}}" class="productsItem">
                    <div class="image">
                        <img  loading="lazy" src="{{ asset('/storage/' . $image) }}" alt="{{$product->title}}">
                    </div>

                    <div class="info">
                        <span class="price">{{$product->price}}$</span>
                        <p class="title">{{$product->title}}</p>
                    </div>
                </a>
                
            @endforeach
        @else
            <div class="noProducts">
                <span>No products</span>
            </div>
        @endif

    </div>

@endsection