@extends('layouts.empty-layout')

{{-- Title --}}
@section('title', 'Checkout')

{{-- CSS --}}
@section('css')
    <link rel="stylesheet" href="/css/checkout-page.css">
@endsection

{{-- Content --}}
@section('content')

    @if (session()->has('error_message'))
    <style>
        body {
            overflow: hidden; 
            margin-right: 17px;
        }
        @media screen and (max-width: 500px) {
            body {
                margin-right: 0;
            }
        }
    </style>
    <div class="mainModal">
        <div class="modal">
            <h4 class="caption">Error!</h4>
            <span class="text">{{ session()->get('error_message') }}</span>
            <span class="cross closeMainModal"><img src="/assets/icons/cross.svg" alt="Close"></span>
        </div>
        <div class="overlay closeMainModal"></div>
    </div>
    @endif
        
    <header>
        <a href="/"><h2>WebStore</h2></a>
    </header>

    <div class="content">
        <div class="caption">
            <h1>Checkout</h1>
        </div>

        <form 
            action="{{ route('checkout.store') }}"
            method="post"
            id="payment-form"
        >
            @csrf  
            <div class="row">

                {{-- Form wrapper --}}
                <div class="form-wrapper">
                    <h4>My information</h4>

                    <div class="formInputs">
                        {{-- Item --}}
                        <div class="item">
                            <label for="name">Name *</label>
                            <input type="text" id="name" name="name" placeholder="Enter your name" maxlength="120" required>
                        </div> {{-- //Item --}}

                        {{-- Item --}}
                        <div class="item">
                            <label for="name">SURNAME(S) *</label>
                            <input type="text" id="name" name="surname" placeholder="Enter your surname" maxlength="120" required>
                        </div> {{-- //Item --}}

                        {{-- Item --}}
                        <div class="item">
                            <label for="name">EMAIL *</label>
                            <input type="email" id="name" name="email" placeholder="Enter your email" maxlength="120" required>
                        </div> {{-- //Item --}}

                        {{-- Item --}}
                        <div class="item last">
                            <label for="name">MOBILE TELEPHONE *</label>
                            <input type="tel" id="name" name="tel" placeholder="Enter your telephone number" required>
                        </div> {{-- //Item --}}

                        <span class="span">*These fields are mandatory</span>
                    </div>

                    <h4>Payment</h4>

                    <div class="formInputs">

                        <div class="form-group item">
                            <label for="card-element">
                              Credit or debit card
                            </label>
                            <div id="card-element">
                              <!-- a Stripe Element will be inserted here. -->
                            </div>
    
                            <!-- Used to display form errors -->
                            <div id="card-errors" role="alert"></div>
                        </div>

                    </div>
                </div> {{-- //Form wrapper --}}
                
                {{-- Summary wrapper --}}
                <div class="summary-wrapper">
                    <span class="caption">View summary</span>
    
                    {{-- Items --}}
                    <div class="items-wrapper">
                        <div class="items" id="cartItems">
    
                            @if (count(\Cart::session($_COOKIE['cart_id'])->getContent()) > 0)
        
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
                    </div> {{-- //Items --}}
    
                    <div class="totalPrice">
                        <div class="price">
                            <span>Total</span>
                            <span>{{ Cart::getSubTotal() }}$</span>
                        </div>
                        <span class="vatIncluded">* VAT included</span>
                    </div>

                    <div class="button">
                        <button type="submit" id="complete-order"><span>BUY</span></button>
                    </div>
                </div> {{-- //Summary wrapper --}}

            </div> {{-- //row --}}
        </form>
    </div>

@endsection

@section('script')

    <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
    <script src="/js/script.js"></script>

    <script>
        (function(){
            // Create a Stripe client
            var stripe = Stripe('{{ env('STRIPE_KEY') }}');
            // Create an instance of Elements
            var elements = stripe.elements();
            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)
            var style = {
              base: {
                color: '#32325d',
                lineHeight: '18px',
                fontFamily: '"Roboto", Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                  color: '#aab7c4'
                }
              },
              invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
              }
            };
            // Create an instance of the card Element
            var card = elements.create('card', {
                style: style,
                hidePostalCode: true
            });
            // Add an instance of the card Element into the `card-element` <div>
            card.mount('#card-element');
            // Handle real-time validation errors from the card Element.
            card.addEventListener('change', function(event) {
              var displayError = document.getElementById('card-errors');
              if (event.error) {
                displayError.textContent = event.error.message;
              } else {
                displayError.textContent = '';
              }
            });
            // Handle form submission
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
              event.preventDefault();
              // Disable the submit button to prevent repeated clicks
              document.getElementById('complete-order').disabled = true;
            
              stripe.createToken(card).then(function(result) {
                if (result.error) {
                  // Inform the user if there was an error
                  var errorElement = document.getElementById('card-errors');
                  errorElement.textContent = result.error.message;
                  // Enable the submit button
                  document.getElementById('complete-order').disabled = false;
                } else {
                  // Send the token to your server
                  stripeTokenHandler(result.token);
                }
              });
            });
            function stripeTokenHandler(token) {
              // Insert the token ID into the form so it gets submitted to the server
              var form = document.getElementById('payment-form');
              var hiddenInput = document.createElement('input');
              hiddenInput.setAttribute('type', 'hidden');
              hiddenInput.setAttribute('name', 'stripeToken');
              hiddenInput.setAttribute('value', token.id);
              form.appendChild(hiddenInput);
              // Submit the form
              form.submit();
            }
            
        })();
    </script>

@endsection
