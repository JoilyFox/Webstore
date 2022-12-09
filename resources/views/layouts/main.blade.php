<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- CSS --}}
    <link rel="stylesheet" href="/css/general.css">
    @yield('css')

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
</head>
<body>

    {{-- Header --}}

    <header>

        <div class="top">
            <div class="leftPart">
                <div class="logo" id="logo">
                    <span class="burgerBtn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                    <a href="/">WebStore</a>
                </div>
                {{-- <div class="genderBtns">
                    <a href="#">Women</a>
                    <a href="{{route('menWelcomePage')}}" class="active">Men</a>
                </div> --}}
            </div>

            <div class="rightPart">
                <div class="searchBth" id="searchBth">
                    <span class="searchIcon">
                        <img src="/assets/icons/search.svg" alt="search">
                    </span>
                    <span class="searchBarBtn">Search</span>
                </div>
                <div class="icons">
                    <span id="basketBtn" class="CartOpenBtn">
                        <img src="/assets/icons/basket_icon.svg" alt="Profile">
                        @if ( isset($_COOKIE['cart_id']) )
                            <b id="headerCartQty">{{\Cart::session($_COOKIE['cart_id'])->getTotalQuantity()}}</b>
                        @else
                            <b id="headerCartQty">0</b>
                        @endif
                    </span>
                </div>
            </div>
        </div>

        <div class="bottom">
            @yield('header')
        </div>

    </header>

    {{-- Nav --}}

    <nav class="headerNav">

        <div class="leftPart">
            <div class="logo">
                <span class="burgerBtn close closeNavMenu">
                    <span></span>
                    <span></span>
                </span>
                <a href="/">WebStore</a href="#">
            </div>
            {{-- <div class="genderBtns">
                <a href="#">Women</a>
                <a href="{{route('menWelcomePage')}}" class="active">Men</a>
            </div> --}}
        </div>

        <div class="nav">
            <div class="mainCategories">
                @foreach ($categories as $category)
                    <div class="categoryBlock">
                        <span class="link animate" onclick="onClickCategory('{{$category->slug}}')">{{$category->title}}</span>
                        <span class="line {{$category->slug}}_line"></span>
                    </div>
                @endforeach
            </div>
            <div class="subCategories">
                @foreach ($categories as $category)
                    <div class="subCategoriesBlock {{$category->slug}}">
                        @foreach ($category->subcategories as $subcategory)
                            <a class="animate" href="{{route('getProductsByCategory', [$category->slug, $subcategory->slug])}}">{{$subcategory->title}}</a>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
        <div class="closeArea closeNavMenu"></div>
    </nav>

    {{-- Cart popup --}}

    <div class="overlay closeCart closeSearchModal" id="overlay"></div>
    <div class="cart" id="cart">

        <span class="cross closeCart"><img src="/assets/icons/cross.svg" alt="Close"></span>
        <div class="cartContent">

            <div class="caption">
                <h1>My basket</h1>
                <span class="generalQty">(<span id="generalQty">
                    @if ( isset($_COOKIE['cart_id']) )
                        {{\Cart::session($_COOKIE['cart_id'])->getTotalQuantity()}}
                    @else
                        0
                    @endif
                </span>)</span>
            </div>

            <div class="scrollContent">


                <div class="items" id="cartItems">

                    @if (count(Cart::getContent()) > 0)

                        @foreach (Cart::getContent() as $item)

                        <div class="item">
                            <div class="image">
                                <div class="img">
                                    <img src="{{ asset('/storage/' . $item->attributes->img) }}" alt="image">
                                </div>
                            </div>
                            <div class="info">
                                <div class="topArea">
                                    <span class="price">{{$item->quantity * $item->price}}$</span>
                                    <div class="btns">
                                        <span class="btn removeItem" data-id="{{$item->id}}" data-price="{{$item->quantity * $item->price}}" data-qty="{{$item->quantity}}"><img src="/assets/icons/trash.svg" alt="Delete"></span>
                                    </div>
                                </div>
                                <a class="middleArea">
                                    <span class="productTitle">
                                        {{$item->name}}
                                    </span>
                                </a>
                                <div class="bottomArea">
                                    <div class="orderInfo">
                                        <span class="size">{{$item->attributes->size}}</span>
                                        @if ($item->quantity > 1)
                                            <div class="qtyAndPriceForOne">
                                                <span class="qty">{{$item->quantity}}x</span>
                                                <span class="priceForOne">{{$item->price}}$</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach

                    @endif

                </div>
            </div>

            <div class="btnAndInfo">
                <div class="totalPrice">
                    <span class="text">
                        Total
                        <span>(VAT included)</span>
                    </span>
                    <span class="price"><span id="totalPrice">{{Cart::getSubTotal()}}</span>$</span>
                </div>
                <a class="processOrder" href="{{ route('checkout.index') }}">Process order</a>
            </div>


        </div>
    </div>

    {{-- Search Popup --}}

    <div class="searchPopup" id="searchPopup">
        <div class="row">
            <div class="logo closeSearchModal">
                <a>WebStore</a>
            </div>
            <span class="cross closeSearchModal"><img src="/assets/icons/cross.svg" alt="Close"></span>
        </div>
        <div class="input">
            <form action="{{ route('search') }}">
                <input type="text" placeholder="What are you looking for?" name="search" class="searchInput">
                <button type="submit"><img src="/assets/icons/search.svg" alt="search"></button>
            </form>
        </div>
    </div>

    {{-- Content --}}

    <div class="content">

        @yield('content')

    </div>

    {{-- Footer --}}

    <footer>
        <div class="row footerContent">
            {{-- Col --}}
            <div class="column">
                <div class="title">Can we help you?</div>
                <div class="items">
                    <span>+38 (099) 654-43-06</span>
                    <span>+38 (096) 544-33-76</span>
                    <span class="small">From Mondays to Fridays from 10:00 to 19:00</span>
                </div>
            </div> {{-- //Col --}}

            {{-- Col --}}
            <div class="column">
                <div class="title">All categories</div>
                <div class="items">
                    @foreach ($categories as $category)
                        @if ($loop->index <= 9)
                            <span>{{$category->title}}</span>
                        @endif
                    @endforeach
                </div>
            </div> {{-- //Col --}}

            {{-- Col --}}
            <div class="column">
                <div class="title">All categories</div>
                <div class="items">
                    @foreach ($subcategories as $subcategory)
                        @if ($loop->index <= 9)
                            <span><a href="{{route('getProductsByCategory', [$subcategory->category->slug, $subcategory->slug])}}">{{$subcategory->title}}</a></span>
                        @endif
                    @endforeach
                </div>
            </div> {{-- //Col --}}

            {{-- Col --}}
            <div class="column">
                <div class="title">Tools</div>
                <div class="items">
                    <span><a class="CartOpenBtn">Cart</a></span>
                    <span><a class="searchBth">Search</a></span>
                    <span>
                      <a href="{{ route('login') }}">Login</a>
                      <span>/</span>
                      <a class="dropdown-item" href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                          {{ __('Logout') }}
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
                      </form>
                    </span>
                    <span><a href="{{ route('homeAdmin') }}">Admin Panel</a></span>
                </div>
            </div> {{-- //Col --}}

        </div>
    </footer>

    {{-- Scripts --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="/js/script.js"></script>
    @yield('script')


    <script>
        $(document).ready(function() {
            $('.removeItem').click(function() {
                let id = $(this).data('id');
                let price = $(this).data('price');
                let qty = $(this).data('qty');
                removeFromCart(id, price, qty);
            });
        });

        function removeFromCart(id, price, qty) {

            let totalPrice = parseInt($('#totalPrice').text());
            totalPrice -= price;
            $('#totalPrice').text(totalPrice);

            let generalQty = parseInt($('#generalQty').text());
            generalQty -= qty;
            $('#generalQty').text(generalQty);
            $('#headerCartQty').text(generalQty);

            $.ajax({
                url: "{{route('removeFromCart')}}",
                type: "POST",
                data: {
                    id: id,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (data) => {
                    $('#cartItems').html(data);
                }
            });
        }
    </script>



</body>
</html>
