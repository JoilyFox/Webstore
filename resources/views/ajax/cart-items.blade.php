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
        <a href="#" class="middleArea">
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
