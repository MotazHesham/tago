@extends('layouts.frontend')

@section('content')
    <!-- page title start -->
    <div class="breadcrumb-area bg-cover">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <h2 class="page-title">{{ trans('frontend.contact_us.contact') }}</h2>
                    </div>
                    <div class="col-lg-6 text-lg-end">
                        <ul class="page-list">
                            <li><a href="{{ route('home') }}">{{ trans('frontend.contact_us.home') }}</a></li>
                            <li>{{ trans('frontend.contact_us.contact') }} </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page title end -->

    <!-- service area start -->

    <div class="contact-page-list">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="media single-contact-list">
                        <div class="media-left">
                            <img src="{{ asset('frontend/img/icon/phone.png') }}" alt="img">
                        </div>
                        <div class="media-body">
                            <h5>{{ trans('frontend.contact_us.contact_us') }}</h5>
                            <h6>{{ $site_settings->phone_number }}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="media single-contact-list">
                        <div class="media-left">
                            <img src="{{ asset('frontend/img/icon/email.png') }}" alt="img">
                        </div>
                        <div class="media-body">
                            <h5>{{ trans('frontend.contact_us.email') }}</h5>
                            <h6>{{ $site_settings->email }}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="media single-contact-list">
                        <div class="media-left">
                            <img src="{{ asset('frontend/img/icon/address.png') }}" alt="img">
                        </div>
                        <div class="media-body">
                            <h5>{{ trans('frontend.contact_us.location') }}</h5>
                            <h6>{{ $site_settings->address }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="contact-area">
        <div class="container">
            <div class="contact-inner-1">

                <div class="row">
                    <div class="col-lg-8">
                        <img class="w-100" src="{{ asset('frontend/img/bg/14.png') }}" alt="img">
                    </div>
                    <div class="col-lg-4">
                        <div class="section-title mb-0">
                            <h6 class="sub-title">{{ trans('frontend.contact_us.get_in_touch') }}</h6>
                            <h2 class="title"><?php echo trans('frontend.contact_us.p'); ?></h2> 
                            <form class="mt-4" method="POST" action="{{ route('frontend.contact') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="single-input-inner style-border">
                                            <input type="text" placeholder="{{ trans('frontend.contact_us.fields.name') }}" name="name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="single-input-inner style-border">
                                            <input type="email" placeholder="{{ trans('frontend.contact_us.fields.email') }}" name="email" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="single-input-inner style-border">
                                            <input type="text" placeholder="{{ trans('frontend.contact_us.fields.phone') }}" name="phone_number" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="single-input-inner style-border">
                                            <input type="text" placeholder="{{ trans('frontend.contact_us.fields.subject') }}" name="subject" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single-input-inner style-border">
                                            <textarea placeholder="{{ trans('frontend.contact_us.fields.message') }}" name="message" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-black mt-0 w-100 border-radius-5" href="#"> 
                                            {{ trans('frontend.contact_us.submit') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- service area end -->
@endsection
