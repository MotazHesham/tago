@extends('layouts.frontend')

@section('content')
    <!-- page title start -->
    <div class="breadcrumb-area bg-cover">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <h2 class="page-title">{{ trans('frontend.about.about') }}</h2>
                    </div>
                    <div class="col-lg-6 text-lg-end">
                        <ul class="page-list">
                            <li><a href="{{ route('home') }}">{{ trans('frontend.about.home') }}</a></li>
                            <li>{{ trans('frontend.about.about') }} </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page title end -->


    <!-- about area start -->
    <div class="about-area pd-top-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-thumb-inner pe-xl-5 me-xl-5">
                        <img class="animate-img-1 top_image_bounce" src="{{ asset('frontend/img/about/2.png') }}" alt="img">
                        <img class="animate-img-2 left_image_bounce" src="{{ asset('frontend/img/about/3.png') }}" alt="img">
                        <img class="animate-img-3 top_image_bounce" src="{{ asset('frontend/img/banner/5.svg') }}" alt="img">
                        <img class="main-img" src="{{ asset('frontend/img/about/1.png') }}" alt="img">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="section-title">
                        <h6 class="sub-title">{{ trans('frontend.about.about') }}</h6>
                        <h2 class="title"><?php echo trans('frontend.about.h2'); ?></h2>
                        <p class="content mb-4 mb-xl-5">
                            <?php echo nl2br($site_settings->description) ?>
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="single-about-inner">
                                    <div class="thumb mb-3">
                                        <img src="{{ asset('frontend/img/icon/2.png') }}" alt="img">
                                    </div>
                                    <div class="details">
                                        <h5>{{ trans('frontend.about.our_mission') }}</h5>
                                        <p>
                                            <?php echo nl2br($site_settings->our_mission) ?>
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="single-about-inner">
                                    <div class="thumb mb-3">
                                        <img src="{{ asset('frontend/img/icon/3.png') }}" alt="img">
                                    </div>
                                    <div class="details">
                                        <h5>{{ trans('frontend.about.why_us') }}</h5>
                                        <p>
                                            <?php echo nl2br($site_settings->why_us) ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about area end -->

    <!-- faq area start -->
    <div class="faq-area faq-area-margin-top bg-cover pd-top-120 pd-bottom-110"
        style="background-image: url('{{ asset('frontend/img/bg/3.png') }}');">
        <div class="container">
            <div class="row pd-top-120">
                <div class="col-lg-5 order-lg-last">
                    <div class="about-thumb-inner pt-lg-3">
                        <img class="main-img" src="{{ asset('frontend/img/about/4.png') }}" alt="img">
                        <img class="animate-img-bottom-right top_image_bounce" src="{{ asset('frontend/img/about/5.png') }}" alt="img">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="section-title mb-0 mt-4 mt-lg-0">
                        <h6 class="sub-title">{{ trans('frontend.about.some_faq') }}</h6>
                        <h2 class="title"><?php echo trans('frontend.about.faq_h2'); ?></h2> 
                    </div>
                    <div class="accordion accordion-inner style-2 accordion-icon-left mt-3" id="accordionExample">
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
        </div>
    </div>
    <!-- faq area end -->
@endsection
