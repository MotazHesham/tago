@extends('layouts.frontend')

@section('styles')
    <style>
        .tableHead {
            display: table;
            width: 100%;
            font-family: "Montserrat", sans-serif;
            font-size: .75em;
        }

        .tableHead li {
            display: table-cell;
            padding: 1em 0;
            text-align: center;
        }

        .tableHead li.prodHeader {
            text-align: left;
        }

        .cart {
            padding: 1em 0;
        }

        .cart .items {
            display: block;
            width: 100%;
            vertical-align: middle;
            padding: 1.5em;
            border-bottom: 1px solid #fafafa;
        }

        .cart .items.even {
            background: #fafafa;
        }

        .cart .items .infoWrap {
            display: table;
            width: 100%;
        }

        .cart .items .cartSection {
            display: table-cell;
            vertical-align: middle;
        }

        .cart .items .cartSection .itemNumber {
            font-size: .75em;
            color: #777;
            margin-bottom: .5em;
        }

        .cart .items .cartSection h3 {
            font-size: 1em;
            font-family: "Montserrat", sans-serif;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: .025em;
        }

        .cart .items .cartSection p {
            display: inline-block;
            font-size: .85em;
            color: #777777;
            font-family: "Montserrat", sans-serif;
        }

        .cart .items .cartSection p .quantity {
            font-weight: bold;
            color: #333;
        }

        .cart .items .cartSection p.stockStatus {
            color: #61B3AE;
            font-weight: bold;
            padding: .5em 0 0 1em;
            text-transform: uppercase;
        }

        .cart .items .cartSection p.stockStatus.out {
            color: #ca5430;
        }

        .cart .items .cartSection .itemImg {
            width: 4em;
            float: left;
        }

        .cart .items .cartSection.qtyWrap,
        .cart .items .cartSection.prodTotal {
            text-align: center;
        }

        .cart .items .cartSection.qtyWrap p,
        .cart .items .cartSection.prodTotal p {
            font-weight: bold;
            font-size: 1.25em;
        }

        .cart .items .cartSection input.qty {
            width: 2em;
            text-align: center;
            font-size: 1em;
            padding: .25em;
            margin: 1em .5em 0 0;
        }

        .cart .items .cartSection .itemImg {
            width: 8em;
            display: inline;
            padding-right: 1em;
        }

        .special {
            display: block;
            font-family: "Montserrat", sans-serif;
        }

        .special .specialContent {
            padding: 1em 1em 0;
            display: block;
            margin-top: .5em;
            border-top: 1px solid #dadada;
        }

        .special .specialContent:before {
            content: "\21b3";
            font-size: 1.5em;
            margin-right: 1em;
            color: #6f6f6f;
            font-family: helvetica, arial, sans-serif;
        }

        a.remove {
            text-decoration: none;
            font-family: "Montserrat", sans-serif;
            color: #ffffff;
            font-weight: bold;
            background: #e0e0e0;
            padding: .5em;
            font-size: .75em;
            display: inline-block;
            border-radius: 100%;
            line-height: .85;
            -webkit-transition: all 0.25s linear;
            -moz-transition: all 0.25s linear;
            -ms-transition: all 0.25s linear;
            -o-transition: all 0.25s linear;
            transition: all 0.25s linear;
        }

        a.remove:hover {
            background: #f30;
        }

        .promoCode {
            border: 2px solid #efefef;
            float: left;
            width: 35%;
            padding: 2%;
        }

        .promoCode label {
            display: block;
            width: 100%;
            font-style: italic;
            font-size: 1.15em;
            margin-bottom: .5em;
            letter-spacing: -.025em;
        }

        .promoCode input {
            width: 85%;
            font-size: 1em;
            padding: .5em;
            float: left;
            border: 1px solid #dadada;
        }

        .promoCode input:active,
        .promoCode input:focus {
            outline: 0;
        }

        .promoCode a.btn {
            float: left;
            width: 15%;
            padding: .75em 0;
            border-radius: 0 1em 1em 0;
            text-align: center;
            border: 1px solid #61B3AE;
        }

        .promoCode a.btn:hover {
            border: 1px solid #f69679;
            background: #f69679;
        }

        .btn:link,
        .btn:visited {
            text-decoration: none;
            font-family: "Montserrat", sans-serif;
            letter-spacing: -.015em;
            font-size: 1em;
            padding: 1em 3em;
            color: #fff;
            background: #61B3AE;
            font-weight: bold;
            border-radius: 50px;
            float: right;
            text-align: right;
            -webkit-transition: all 0.25s linear;
            -moz-transition: all 0.25s linear;
            -ms-transition: all 0.25s linear;
            -o-transition: all 0.25s linear;
            transition: all 0.25s linear;
        }
        /* 
        .btn:after {
            content: "\276f";
            padding: .5em;
            position: relative;
            right: 0;
            -webkit-transition: all 0.15s linear;
            -moz-transition: all 0.15s linear;
            -ms-transition: all 0.15s linear;
            -o-transition: all 0.15s linear;
            transition: all 0.15s linear;
        } */

        .btn:hover,
        .btn:focus,
        .btn:active {
            background: #f69679;
            color: white
        }

        .btn:hover:after,
        .btn:focus:after,
        .btn:active:after {
            right: -10px;
        }

        .promoCode .btn {
            font-size: .85em;
            paddding: .5em 2em;
        }

        /* TOTAL AND CHECKOUT  */
        .subtotal {
            width: 100%;
            background-color: #edf1f1;
            margin-top: 80px;
            text-align: center;
            padding-top: 10px;
        }

        .subtotal .totalRow {
            padding: .5em;
            text-align: center;
        }

        .subtotal .totalRow.final {
            font-size: 1.25em;
            font-weight: bold;
        }

        .subtotal .totalRow span {
            display: inline-block;
            padding: 0 0 0 1em;
            text-align: right;
        }

        .subtotal .totalRow .label {
            font-family: "Montserrat", sans-serif;
            font-size: .85em;
            text-transform: uppercase;
            color: #777;
        }

        .subtotal .totalRow .value {
            letter-spacing: -.025em;
            width: 35%;
        }

        @media only screen and (max-width: 39.375em) {
            .wrap {
                width: 98%;
                padding: 2% 0;
            }

            .projTitle {
                font-size: 1.5em;
                padding: 10% 5%;
            }

            .heading {
                padding: 1em;
                font-size: 90%;
            }

            .cart .items .cartSection {
                width: 90%;
                display: block;
                float: left;
            }

            .cart .items .cartSection.qtyWrap {
                width: 10%;
                text-align: center;
                padding: .5em 0;
                float: right;
            }

            .cart .items .cartSection.qtyWrap:before {
                content: "QTY";
                display: block;
                font-family: "Montserrat", sans-serif;
                padding: .25em;
                font-size: .75em;
            }

            .cart .items .cartSection.prodTotal,
            .cart .items .cartSection.removeWrap {
                display: none;
            }

            .cart .items .cartSection .itemImg {
                width: 25%;
            }

            .promoCode,
            .subtotal {
                width: 100%;
            }

            a.btn.continue {
                width: 100%;
                text-align: center;
            }
        }
    </style>
@endsection

@section('content')
    <!-- page title start -->
    <div class="breadcrumb-area bg-cover">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <h2 class="page-title">Cart</h2>
                    </div>
                    <div class="col-lg-6 text-lg-end">
                        <ul class="page-list">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li>shopping cart </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page title end -->

    <!-- service area start -->
    
    <form action="{{ route('frontend.checkout') }}" method="POST">
        @csrf
        <div class="container">
            <div class="wrap cf">

                @if ($errors->count() > 0)
                    <div class="alert alert-danger" style="background-color: #f8d7da;">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <h5>Shippinf Info</h5>
                    <div class="row mt-4">
                        <div class="form-group col-md-6">
                            <label for="">First Name</label>
                            <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" id="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Last Name</label>
                            <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" id="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Phone Number</label>
                            <input type="text" class="form-control" name="phone_number" value="{{ old('phone_number') }}" id="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Shipping Country</label>
                            <select name="country_id" id="country_id" class="form-control" required onchange="country_change()"> 
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}" @if(old('country_id') == $country->id) selected @endif data-price="{{ $country->cost }}">{{ $country->name }} - {{ frontend_currency($country->cost)['as_text'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">Address</label>
                            <textarea class="form-control" name="shipping_address" id="" required>{{ old('shipping_address') }}</textarea>
                        </div>
                        @guest
                            <div class="form-group col-md-12">
                                <input type="checkbox" name="create_account" id="account-option" onchange="create_account_with_order(this)"> 
                                <label for="account-option">   Create account</label>
                            </div>
                            <div class="form-group col-md-6" id="email" style="display: none">
                                <label>   Email</label>
                                <input type="email" name="email" class="form-control" value="{{old('email')}}">
                            </div>
                            <div class="form-group mb-3 col-md-6" id="password" style="display: none">
                                <label class="field-label">   Password</label>
                                <input type="password"  class="form-control" name="password">
                            </div>
                        @endguest 
                    </div> 

                <div class="row">
                    <div class="col-md-8">

                        <div class="cart">  
                            <ul class="cartWrap">
                                @php
                                    $total = 0;
                                @endphp
                                @foreach(session('cart') as $cartItem)
                                    @php
                                        $product = \App\Models\Product::find($cartItem['product_id']);
                                        if($product){
                                            $total += $product->price;
                                        }
                                    @endphp
                                    @if($product)
                                        <li class="items odd">

                                            <div class="infoWrap">
                                                <div class="cartSection">
                                                    <img src="http://lorempixel.com/output/technics-q-c-300-300-4.jpg" alt=""
                                                        class="itemImg" /> 
                                                    <h3>{{ $product->name }}</h3>

                                                    <p> <input type="text" class="qty" value="{{ $cartItem['quantity'] }}" onkeyup="update_quantity('{{$product->id}}',this)" disabled/> x {{ frontend_currency($product->price)['as_text'] }}</p>

                                                    @if($product->current_stock > 0)
                                                        <p class="stockStatus"> In Stock</p>
                                                    @else  
                                                        <p class="stockStatus out"> Out of Stock</p>
                                                    @endif
                                                </div>


                                                <div class="prodTotal cartSection">
                                                    <p>{{frontend_currency($product->price * $cartItem['quantity'])['as_text']}}</p>
                                                </div>
                                                {{-- <div class="cartSection removeWrap">
                                                    <a href="#" class="remove">x</a>
                                                </div> --}}
                                            </div>
                                        </li> 
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-4">

                        <div class="subtotal cf">

                            <h4>Summary</h4>
                            <ul>
                                <li class="totalRow"><span class="label">Subtotal</span><span class="value" id="sub_total"  data-sub_total="{{$total}}">{{ frontend_currency($total)['as_text'] }}</span></li>

                                <li class="totalRow"><span class="label">Shipping</span><span class="value" id="shipping_cost">0 EGP</span></li>

                                <li class="totalRow final"><span class="label">Total</span><span class="value" id="total_cost">{{frontend_currency($total)['as_text']}}</span></li>
                            </ul>
                            
                            <div class="form-group mt-3">
                                <button type="submit" class="btn primary-btn" style="padding: 0 30px">Order Now</button>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </form>
    <!-- service area end -->
@endsection

@section('scripts')
    <script>
        
        function create_account_with_order(el){ 
            if(el.checked){
                $('#password').css('display','block');
                $('#email').css('display','block');
            }else{
                $('#password').css('display','none');
                $('#email').css('display','none');
            }
        }

        // Remove Items From Cart
        $('a.remove').click(function() {
            event.preventDefault();
            $(this).parent().parent().parent().hide(400);

        })

        // Just for testing, show all items
        $('a.btn.continue').click(function() {
            $('li.items').show(400);
        })

        
        $(document).ready(function() {
            country_change();
        });

        function country_change(){
            // Get the selected option
            var selectedOption = $('#country_id option:selected');

            // Retrieve the value and data attribute
            var optionValue = selectedOption.val();
            var optionPrice = selectedOption.data('price');
            $('#shipping_cost').html(optionPrice + ' EGP');
            var sub_total = $('#sub_total').data('sub_total'); 
            $('#total_cost').html((parseInt(optionPrice) + parseInt(sub_total)) + ' EGP');
        }
    </script>
@endsection
