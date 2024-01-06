
@php
$image = isset($product->photo[0]) ? $product->photo[0]->getUrl('thumb') : '';
@endphp
<li class="cd-cart__product" data-productId="{{ $product->id }}" data-price="{{ $product->price }}">
    <div class="cd-cart__image">
        <a href="#0">
            <img src="{{ $image }}" alt="placeholder">
        </a>
    </div>
    <div class="cd-cart__details">
        <h3 class="truncate">
            <a href="#0">{{ $product->name }}</a>
        </h3>
        <span class="cd-cart__price" data-price="{{ $product->price }}">{{ frontend_currency($product->price)['as_text'] }}</span>
        <div class="cd-cart__actions">
            <a href="#" class="cd-cart__delete-item" data-productId="{{ $product->id }}">Delete</a>
            <div class="cd-cart__quantity">
                <label for="cd-product-{{$product->id}}">Qty</label>
                <span class="cd-cart__select"> 
                    <input style="width: 50px;border: white;padding: 0 5px;" value="{{ $quantity ?? 1 }}" type="number" min="1" step="1" id="cd-product-{{$product->id}}" data-productId="{{ $product->id }}" name="quantity">
                
                </span>
            </div>
        </div>
    </div>
</li>
