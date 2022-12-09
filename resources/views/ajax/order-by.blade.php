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