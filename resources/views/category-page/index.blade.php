@extends('layouts.main')

{{-- Title --}}
@section('title', $current_subcategory['title'])

{{-- CSS --}}
@section('css')
    <link rel="stylesheet" href="/css/category-page.css">
@endsection

{{-- Header --}}
@section('header')
    
    <div class="captionAndSorting">

        {{-- Subcategory Title --}}
        <a href="#" class="categoryName">
            <h2>{{$current_subcategory['title']}}</h2>
        </a>

        {{-- Sorting --}}
        @if (count($products) !== 0)
            <div class="sorting">
                <div class="popUp">
                    <div class="button" id="sortPriceBtn">
                        <span class="text">Price</span>
                        <img class="arrow" src="/assets/icons/arrow.svg" alt="V">
                    </div>
                    <ul class="menu" id="sortPriceMenu">
                        <li class="sortBtnByPrice" data-price="default"><span>Default</span></li>
                        <li class="sortBtnByPrice" data-price="10"><span>Up to 10$</span></li>
                        <li class="sortBtnByPrice" data-price="40"><span>Up to 40$</span></li>
                        <li class="sortBtnByPrice" data-price="70"><span>Up to 70$</span></li>
                        <li class="sortBtnByPrice" data-price="100"><span>Up to 100$</span></li>
                    </ul>
                </div>

                <div class="popUp">
                    <div class="button" id="sorTPopUpButton">
                        <span class="text">Sort by</span>
                        <img class="arrow" src="/assets/icons/arrow.svg" alt="V">
                    </div>
                    <ul class="menu" id="sortMenu">
                        <li class="sortBtn" data-order="default"><span>Default</span></li>
                        <li class="sortBtn" data-order="price-low-high"><span>Price: Low-High</span></li>
                        <li class="sortBtn" data-order="price-high-low"><span>Price: High-Low</span></li>
                        <li class="sortBtn" data-order="name-a-z"><span>Name: A-Z</span></li>
                        <li class="sortBtn" data-order="name-z-a"><span>Name: Z-A</span></li>
                    </ul>
                </div>
            </div>
        @endif

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

    <section class="seoContent">
        <h1>{{$current_subcategory['title']}}</h1>
        <p>Discover WebStore New Collection of {{$current_subcategory['title']}}. Striped, plaid or printed {{$current_subcategory['title']}} which will soon become your favorites.</p>
    </section>

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.sortBtn').click(function() {
                let orderBy = $(this).data('order');
                
                $.ajax({
                    url: "{{route('getProductsByCategory', [$current_subcategory->category->slug, $current_subcategory->slug] )}}",
                    type: "GET",
                    data: {
                        orderBy: orderBy
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: (data) => {
                        $('.products').html(data)
                    }
                });
            });

            $('.sortBtnByPrice').click(function() {
                let orderByPrice = $(this).data('price');
                
                $.ajax({
                    url: "{{route('getProductsByCategory', [$current_subcategory->category->slug, $current_subcategory->slug] )}}",
                    type: "GET",
                    data: {
                        orderByPrice: orderByPrice
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: (data) => {
                        $('.products').html(data)
                    }
                });
            });
        });

    </script>
@endsection