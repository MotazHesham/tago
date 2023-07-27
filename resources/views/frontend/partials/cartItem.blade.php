
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
            <a href="#0" class="cd-cart__delete-item" data-productId="{{ $product->id }}">Delete</a>
            <div class="cd-cart__quantity">
                <label for="cd-product-{{$product->id}}">Qty</label>
                <span class="cd-cart__select">
                    <select class="reset" id="cd-product-{{$product->id}}" name="quantity" data-productId="{{ $product->id }}">
                        <option value="1" @if($quantity == '1') selected @endif>1</option>
                        <option value="2" @if($quantity == '2') selected @endif>2</option>
                        <option value="3" @if($quantity == '3') selected @endif>3</option>
                        <option value="4" @if($quantity == '4') selected @endif>4</option>
                        <option value="5" @if($quantity == '5') selected @endif>5</option>
                        <option value="6" @if($quantity == '6') selected @endif>6</option>
                        <option value="7" @if($quantity == '7') selected @endif>7</option>
                        <option value="8" @if($quantity == '8') selected @endif>8</option>
                        <option value="9" @if($quantity == '9') selected @endif>9</option>
                    </select>
                    <svg class="icon" viewBox="0 0 12 12">
                        <polyline fill="none" stroke="currentColor" points="2,4 6,8 10,4 " />
                    </svg>
                </span>
            </div>
        </div>
    </div>
</li>
