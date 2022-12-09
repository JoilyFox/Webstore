@extends('layouts.main')

{{-- Title --}}
@section('title', $product['title'])

{{-- CSS --}}
@section('css')
    <link rel="stylesheet" href="/css/product-page.css">
@endsection

{{-- Content --}}
@section('content')
        
    <div class="product" data-id="{{$product->id}}" data-price="{{$product->price}}">

        @php
            if (isset($product->images[0])) 
                $image_1 = $product->images[0]->img;
            else 
                $image_1 = 'no_image.jpg';
        @endphp

        <div class="row first"> {{--  row --}}
            <div class="img">
                <img src="{{ asset('/storage/' . $image_1 ) }}" alt="{{$product->title}}">
            </div>
            
            <div class="info"> {{-- info --}}
                <span class="bought"><span class="text">Sales</span> <span class="number">{{ $product->bought }}</span></span>
                <h1 class="title">{{$product->title}}</h1>
                @if ($product->in_stock == 1)
                    <span class="inStock">Available</span>
                @else
                    <span class="inStock">Not available</span>
                @endif
                <span class="price">{{$product->price}}$</span>
                
                <div class="column">
                    {{-- chose size --}}
                    <div class="choseSize">
                        <span class="title" id="selectSize">Select size</span>
                        <ul class="btns">
                            <li><label>
                                <input type="radio" name="size" value="XS">
                                <span class="text"><span>XS</span></span>
                            </label></li>
                            <li><label>
                                <input type="radio" name="size" value="S">
                                <span class="text"><span>S</span></span>
                            </label></li>
                            <li><label>
                                <input type="radio" name="size" value="M">
                                <span class="text"><span>M</span></span>
                            </label></li>
                            <li><label>
                                <input type="radio" name="size" value="L">
                                <span class="text"><span>L</span></span>
                            </label></li>
                            <li><label>
                                <input type="radio" name="size" value="XL">
                                <span class="text"><span>XL</span></span>
                            </label></li>
                            <li class="dontFit"><label>
                                <input type="radio" name="size" value="XXL">
                                <span class="text"><span>XXL</span></span>
                            </label></li>
                        </ul>
                    </div>
                    {{-- chose size // --}}

                    <span class="addToBasket" id="addToBasket">
                        <span class="text">Add to basket</span>
                    </span>
                </div>

                @if (count($product->images) <= 1)
                    <div class="description notInLastRow">
                        <div class="productInfo">
                            <span class="title">Description</span>
                            <div class="descriptionText">{{$product->description}}</div>
                        </div>
                        <div class="care">
                            <span class="title">Care</span>
                            <div class="icons">
                                @for ($i = 1; $i <= 7; $i++)
                                    <span class="icon">
                                        <img loading="lazy" src="/assets/icons/care_icons/{{$i}}.png" alt="">
                                    </span>
                                @endfor
                            </div>
                        </div>
                    </div> {{-- //description --}}
                @endif

            </div> {{--  //info --}}

        </div> {{--  //row --}}

        @if (count($product->images) > 1)
            @php
                $imgsLeft = count($product->images) - 1;
                $imgCount = 0;
                $rows = floor(count($product->images) / 2);
                $rowCount = 0;
            @endphp
            @for ($i = 0; $i < $rows; $i++)

                <div class="row">
                    @php
                        $imgsLeft == 1 ? $jCount = 1 : $jCount = 2;
                        $rowCount++;
                    @endphp

                    @if ($rows - $rowCount != 0)
                        
                        @for ($j = 1; $j <= $jCount; $j++)

                            @php
                                $imgsLeft--;
                                $imgCount++;
                            @endphp

                            <div class="img">
                                <img loading="lazy" src="{{ asset('/storage/' . $product->images[$imgCount]->img) }}" alt="{{$product->title}}">
                            </div>

                        @endfor

                    @elseif ($rows - $rowCount == 0)
                            
                        <div class="row last">
                            <div class="description">
                                <div class="productInfo">
                                    <span class="title">Description</span>
                                    <div class="descriptionText">{{$product->description}}</div>
                                </div>
                                <div class="care">
                                    <span class="title">Care</span>
                                    <div class="icons">
                                        @for ($i = 1; $i <= 7; $i++)
                                            <span class="icon">
                                                <img loading="lazy" src="/assets/icons/care_icons/{{$i}}.png" alt="">
                                            </span>
                                        @endfor
                                    </div>
                                </div>
                            </div> {{-- //description --}}
                            @for ($j = 1; $j <= $jCount; $j++)

                                @php
                                    $imgsLeft--;
                                    $imgCount++;
                                @endphp
                                <div class="img {{ $j == 1 ? 'first' : 'second' }}">
                                    <img loading="lazy" src="{{ asset('/storage/' . $product->images[$imgCount]->img) }}" alt="{{$product->title}}">
                                </div>
                            @endfor
                        </div>

                    @endif
                    
                </div> {{-- //row --}}

            @endfor {{-- //row for --}}
            
        @endif {{-- //img > 1 --}}

        


    </div>

@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#addToBasket').click(function() {
            let size = $('input[name="size"]:checked').val();
            if (size == null) {
                $('#selectSize').css('color', '#f14a5f');
                $('#addToBasket .text').text('Select size');
            } else {
                addToCart(size);
            }
        });

        $('input[name="size"]').click(function() {
            $('#selectSize').css('color', '#000');
            $('#addToBasket .text').text('ADD TO BASKET');
        });
    });

    function addToCart(size) {
        let id = $('.product').data('id');
        let price = $('.product').data('price');

        let totalQty = parseInt($('#generalQty').text());
        totalQty++;
        $('#generalQty').text(totalQty);
        $('#headerCartQty').text(totalQty);

        let totalPrice = Math.round(parseInt($('#totalPrice').text()));
        totalPrice += Math.round(price);
        $('#totalPrice').text(totalPrice);

        $.ajax({
            url: "{{route('addToCart')}}",
            type: "POST",
            data: {
                id: id,
                size: size
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (data) => {
                $('#cartItems').html(data)
            }
        });
    }
</script>
@endsection