@extends('layouts.frontend')

@section('meta_title'){{ $meta_title }}@stop
@section('meta_description'){{ $meta_description }}@stop

@section('content')
    <!-- page title start -->
    <div class="breadcrumb-area bg-cover">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <h2 class="page-title">Products</h2>
                    </div>
                    <div class="col-lg-6 text-lg-end">
                        <ul class="page-list">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li>{{ $categoryName }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page title end -->

    <!-- team area start -->
    <div class="team-area bg-relative pd-top-120 pd-bottom-90">
        <div class="container">
            <div class="row">

                @foreach($products as $product)
                    @php
                        $image = isset($product->photo[0]) ? $product->photo[0]->getUrl('preview2') : '';
                    @endphp
                    <div class="col-lg-4 col-md-6">
                        <div class="single-team-inner text-center">
                            <div class="thumb">
                                <img src="{{ $image }}" alt="img">
                                <ul class="team-social-inner">
                                    <li><a href="{{ route('frontend.product',$product->id) }}"><i class="fa fa-eye"></i></a></li>
                                    <li> <a href="#0" class=" js-cd-add-to-cart" data-price="25.99"><i class="fa fa-cart-plus"></i></a></li>
                                </ul>
                            </div>
                            <div class="details">
                                <div class="product-price">
                                    <span class="offer-price">{{ $product->price }}</span>
                                </div>
                                <h5><a href="product-details.html">{{ $product->name }}</a></h5> 
                            </div>
                        </div>
                    </div> 
                @endforeach

            </div>
        </div>
    </div>
    <!-- team area end -->
@endsection
