@extends('layouts.frontend')

@section('content')
    
    <!-- page title start -->
    <div class="banner-area bg-relative banner-area-1 pd-bottom-100 ">
        <img class="animate-img-1 top_image_bounce" src="{{ asset('frontend/img/banner/2.png') }}" alt="img">
        <img class="animate-img-2 left_image_bounce" src="{{ asset('frontend/img/banner/5.svg') }}" alt="img">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    <div class="banner-inner pe-xl-5">
                        <h6 class="subtitle wow animated fadeInLeft" data-wow-duration="1.5s" data-wow-delay="0.3s">
                            card one touch away</h6>
                        <h2 class="title wow animated fadeInLeft" data-wow-duration="1.5s" data-wow-delay="0.4s">Your
                            digital <span>business Card</span> one touch away</h2>
                        <p class="content pe-xl-5 wow animated fadeInLeft" data-wow-duration="1.5s"
                            data-wow-delay="0.5s">Switch now to a digital business card. Cardble is designed to be the
                            ultimate tool for small businesses and large enterprises. The new Digital Business Card you
                            need to become a modern eco-friendly company.</p>
                        <a class="btn btn-border-base wow animated fadeInLeft" data-wow-duration="1.5s"
                            data-wow-delay="0.6s" href="{{ route('frontend.products',0) }}">Get yours <i class="fa fa-plus"></i></a>
                    </div>
                </div>


                <div class="col-lg-6 col-md-9 wow  fadeInRight animated" data-wow-duration="1.5s"
                    data-wow-delay="0.3s"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.3s; animation-name: fadeInRight;">
                    <div class="banner-thumb-2 mt-4 mt-lg-0">
                        <div class="main-img-wrap">
                            <img class="banner-animate-img banner-animate-img-1 left_image_bounce"
                                src="{{ asset('frontend/img/banner-2/4.png') }}" alt="img">
                            <img class="banner-animate-img banner-animate-img-2 left_image_bounce"
                                src="{{ asset('frontend/img/banner-2/5.png') }}" alt="img">
                            <img class="banner-animate-img banner-animate-img-3 top_image_bounce"
                                src="{{ asset('frontend/img/banner-2/2.png') }}" alt="img">
                            <img class="main-img" src="{{ asset('frontend/img/banner-2/1.png') }}" alt="img">
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
    </div>
    <!-- banner end -->


    <!-- counter area start -->
    <div class="counter-area bg-relative">
        <div class="container pd-bottom-90">
            <div class="row">
                <div class="col-lg-4 col-6 wow animated fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.1s">
                    <div class="single-counter-inner">

                        <h2 class=" mt-4 mb-2"><span class="counter">{{ $counted_customers }}</span>+</h2>
                        <p class="">Users</p>
                    </div>
                </div>
                <div class="col-lg-4 col-6 wow animated fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.4s">
                    <div class="single-counter-inner">

                        <h2 class=" mt-4 mb-2"><span class="counter">{{ $counted_products }}</span>+</h2>
                        <p class="">Product</p>
                    </div>
                </div>
                <div class="col-lg-4 col-6 wow animated fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.5s">
                    <div class="single-counter-inner">

                        <h2 class=" mt-4 mb-2"><span class="counter">{{ $rates->count() }}</span>+</h2>
                        <p class="">5 Stars Rating</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- counter area end -->



    <!-- download area start -->
    <div class="downlaodApp-area  pd-bottom-60  pd-top-60">
        <div class="container">
            <div class="row">

                <div class="col-md-7 col-12">
                    <h2>Download Our Free App Now</h2>
                </div>
                <div class="col-md-2  col-6"> <a href="#"> <img src="{{ asset('frontend/img/App-Store.png') }}"></a></div>
                <div class="col-md-2 col-6"> <a href="#"> <img src="{{ asset('frontend/img/Google-Play.png') }}"></a></div>

            </div>
        </div>
    </div>



    <!--------what we do-------------->

    <section class="how-app-work-section" id="how-it-works">
        <div class="container">

            <div class="row">
                <div class="col-md-5 how-app-work-slider-content">
                    <div class="how-app-work-slider-wrapper">
                        <div class="how-app-work-screen-mobile-image"></div>
                        <!--Slider-->
                        <img src="{{ asset('frontend/img/awesome-features1@2x.png') }}" class="img-fluid">
                    </div><!-- /.how-app-work-slider-wrapper -->

                </div><!-- /.col-md-6 -->
                <div class="col-md-6">
                    <div class="how-app-work-content-wrap">
                        <div class="title">
                            <h3>How does this App Work?</h3>
                        </div><!-- /.title -->
                        <div class="how-app-work-content" id="how-app-work-slider-pager">
                            @foreach($faq_questions as $faq_question)
                                <div class="single-how-app-work ">
                                    <div class="icon-box">
                                        <div class="inner">
                                            {{ $faq_question->question }}
                                        </div><!-- /.inner -->
                                    </div><!-- /.icon-box -->
                                    <div class="text-box">
                                        <p> {{ $faq_question->answer }} </p>
                                    </div><!-- /.text-box -->
                                </div><!-- /.single-how-app-work --> 
                            @endforeach
                        </div><!-- /.how-app-work-content -->

                    </div><!-- /.how-app-work-content-wrap -->
                </div><!-- /.col-md-6 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section>
    <!--------what we do-------------->


    <!-----------Our products--------------->
    <div class="home-product">
        <div class="container">

            <div class="section-title text-center">
                <h6 class="sub-title">Products</h6>
                <h2 class="title">Our <span>Products</span></h2>
            </div>

            <div class="swiper-container two">
                <div class="swiper-wrapper">
                    @foreach($products as $product)
                        @php
                            $image = isset($product->photo[0]) ? $product->photo[0]->getUrl('preview2') : '';
                        @endphp
                        <div class="swiper-slide">
                            <div class="slider-image">
                                <img src="{{ $image }}" alt="slide 1">
                                <div class="description">
                                    <h4><a href="{{ route('frontend.product',$product->id) }}"> {{ $product->name }} </a></h4>
                                    <p>{{ frontend_currency($product->price)['as_text'] }}</p>
                                    <a class="cd-add-to-cart js-cd-add-to-cart" data-price="{{$product->price}}" data-productId="{{$product->id}}" style="cursor: pointer">
                                        Add To Cart
                                    </a> 
                                </div>

                            </div>
                        </div> 
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
    <!-----------Our products--------------->

    <section class="video-box">
        <div class="container text-center">

            <a data-popup-open="popup-1" href="#" class="video-popup video-btn hvr-pulse"><i
                    class="fa fa-play"></i></a>

            <h3>HOW IT WORK</h3>
            <p>
                <?php echo nl2br($site_settings->how_it_work_description) ?>
            </p>
        </div><!-- /.container text-center -->
    </section><!-- /.video-box -->




    <!-- testimonial-area start -->
    <div class="testimonial-area pd-top-120 pd-bottom-90" style="background-image: url('./frontend/img/bg/11.png');">
        <div class="container">
            <div class="section-title">
                <h6 class="sub-title">TESTIMONIAL</h6>
                <h2 class="title">Our client's opinions</h2>
            </div>
            <div  class="testimonial-slider-1 owl-carousel slider-control-round slider-control-dots slider-control-right-top">
                @foreach($rates->take(15) as $rate)
                    <div class="item">
                        <div class="single-testimonial-inner style-1 text-center">
                            <h5>{{ $rate->name }}</h5> 
                            <div class="icon mb-2">
                                <img src="{{ asset('frontend/img/icon/25.png') }}" alt="img">
                            </div>
                            <p><?php echo $rate->review ?></p>
                            <div class="ratting-inner mt-4">
                                @include('frontend.partials.rating',['rate' => $rate->rate])
                            </div> 
                        </div>
                    </div> 
                @endforeach
            </div>
        </div>
    </div>
    <!-- testimonial-area start -->



    <!-- about area start -->
    <div class="about-area  pt-5 pb-5">
        <div class="container">
            <div class="client-slider owl-carousel">
                @foreach($site_settings->supporters as $media)
                <div class="thumb">
                    <img src="{{ $media->getUrl() }}" alt="img">
                </div> 
                @endforeach
            </div>
        </div>
    </div>
    <!-- about area end -->
@endsection