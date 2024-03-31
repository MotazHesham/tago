@extends('layouts.frontend')

@section('meta_title'){{ $product->meta_title }}@stop

@section('meta_description'){{ $product->meta_description }}@stop 

@section('meta')

    @php
        $meta_image = isset($product->photo[0]) ? $product->photo[0]->getUrl('preview2') : '';
        $site_settings = get_site_setting();
    @endphp
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $product->meta_title }}">
    <meta itemprop="description" content="{{ $product->meta_description }}">
    <meta itemprop="image" content="{{ $meta_image }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $product->meta_title }}">
    <meta name="twitter:description" content="{{ $product->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ $meta_image }}">
    <meta name="twitter:data1" content="{{ $product->price }}">
    <meta name="twitter:label1" content="Price">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $product->meta_title }}" />
    <meta property="og:type" content="product" />
    <meta property="og:url" content="{{ route('frontend.product', $product->id) }}" />
    <meta property="og:image" content="{{ $meta_image }}" />
    <meta property="og:description" content="{{ $product->meta_description }}" />
    <meta property="og:site_name" content="{{ $site_settings->website_name  }}" />
    <meta property="og:price:amount" content="{{ $product->price }}" /> 
@endsection 

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
                            <li>{{ $product->category ? $product->category->name : '' }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page title end -->

    <div class="container">
        <div class="card-wrapper">
            <div class="card">
                <!-- card left -->
                <div class="product-imgs">
                    <div class="img-display">
                        <div class="img-showcase">
                            @foreach($product->photo as $media)
                                <img src="{{ $media->getUrl() }}" alt=" image">
                            @endforeach
                        </div>
                    </div>
                    <div class="img-select">
                        @foreach($product->photo as $key => $media)
                            <div class="img-item">
                                <a href="#" data-id="{{$key + 1}}">
                                    <img src="{{ $media->getUrl('preview') }}" alt=" image">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- card right -->
                <div class="product-content">
                    <h2 class="product-title"> {{ $product->name }} </h2>
                    {{-- <div class="product-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                        <span>4.7(21)</span>
                    </div> --}}

                    <div class="product-price">
                        <p class="new-price"> {{ frontend_currency($product->price)['as_text'] }} </p>
                    </div>

                    <div class="product-detail">
                        <h3>about this item: </h3>
                        <p>
                            <?php echo $product->description ?>
                        </p>
                        <ul> 
                            @if($product->current_stock  > 0)
                                <li>Available: <span>in stock</span></li>  
                            @endif
                            @if(json_decode($product->colors) != null)
                                <li>
                                    Color: 
                                </li>
                            @endif
                        </ul>
                        <div> 
                            @if(json_decode($product->colors) != null)
                                @foreach(json_decode($product->colors) as $color)
                                    <label style="display: inline-block;height: 30px;width:30px;border-radius:50%;background: {{ $color }}"></label>
                                @endforeach 
                            @endif
                        </div>
                    </div>

                    <div class="purchase-info">
                        <input type="number" id="quantity" min="1" step="1" value="1">
                        
                        @if($product->current_stock  > 0)
                            <a class="cd-add-to-cart js-cd-add-to-cart" data-price="{{$product->price}}" data-productId="{{$product->id}}" style="cursor: pointer">
                                {{ trans('frontend.home.add_to_cart') }}
                            </a> 
                        @else 
                            <a class="cd-add-to-cart" style="background:#bbbbbb">
                                {{ trans('frontend.home.out_stock') }}
                            </a> 
                        @endif 
                    </div>

                    <div class="social-links">
                        <p>Share At: </p>
                        <a href="#">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="#">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>




        <div class="product-more-details">
            <div class="details"> 
                <div class="accordion accordion-inner accordion-icon-left mt-3 mb-4" id="accordionExample">
                    @foreach($faq_questions as $faq_question)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{$faq_question->id}}">
                                <button class="accordion-button @if(!$loop->first) collapsed @endif" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $faq_question->id }}" aria-expanded="true" aria-controls="collapse{{ $faq_question->id }}">
                                    {{ $faq_question->question }}
                                </button>
                            </h2>
                            <div id="collapse{{ $faq_question->id }}" class="accordion-collapse collapse @if($loop->first) show @endif" aria-labelledby="heading{{$faq_question->id}}"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <?php echo $faq_question->answer ?>
                                </div>
                            </div>
                        </div>
                    @endforeach 
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




        <!-- work-process-area start -->
        <div class="work-process-area pd-top-120 pd-bottom-90">
            <div class="container">
                <div class="section-title text-center">
                    <h6 class="sub-title">How do I create and design My card</h6>
                    <h2 class="title"> <span>Best Step</span> Our It Process</h2>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="single-work-process-inner">
                            <div class="thumb mb-3">
                                <img src="{{ asset('frontend/img/step1.webp') }}" alt="img">
                            </div>
                            <div class="details">
                                <p class="process-count">Step 01</p>
                                <h5 class="mb-3">Purchase your
                                    Card</h5> 
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-work-process-inner">
                            <div class="thumb mb-3">
                                <img src="{{ asset('frontend/img/step2.webp') }}" alt="img">
                            </div>
                            <div class="details">
                                <p class="process-count">Step 02</p>
                                <h5 class="mb-3">Set up a
                                    Profile</h5> 
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-work-process-inner">
                            <div class="thumb mb-3">
                                <img src="{{ asset('frontend/img/step3.png') }}" alt="img">
                            </div>
                            <div class="details">
                                <p class="process-count">Step 03</p>
                                <h5 class="mb-3">Receive your card & start tapping
                                </h5> 
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- work-process-area end -->
    </div>
@endsection

@section('scripts')
    <script id="rendered-js">
        const imgs = document.querySelectorAll('.img-select a');
        const imgBtns = [...imgs];
        let imgId = 1;

        imgBtns.forEach(imgItem => {
            imgItem.addEventListener('click', event => {
                event.preventDefault();
                imgId = imgItem.dataset.id;
                slideImage();
            });
        });

        function slideImage() {
            const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;

            document.querySelector('.img-showcase').style.transform = `translateX(${-(imgId - 1) * displayWidth}px)`;
        }

        window.addEventListener('resize', slideImage);
        //# sourceURL=pen.js
    </script>
@endsection
