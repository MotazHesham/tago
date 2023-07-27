@extends('layouts.frontend')

@section('content')
    <!-- page title start -->
    <div class="breadcrumb-area bg-cover">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <h2 class="page-title">Contact</h2>
                    </div>
                    <div class="col-lg-6 text-lg-end">
                        <ul class="page-list">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li>Contact </li>
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
                            <h5>Contacts us</h5>
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
                            <h5>Your Email</h5>
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
                            <h5>Location</h5>
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
                        <img class="w-100" src="{{ asset('frontend/img/bg/4.png') }}" alt="img">
                    </div>
                    <div class="col-lg-4">
                        <div class="section-title mb-0">
                            <h6 class="sub-title">GET IN TOUCH</h6>
                            <h2 class="title">Bringing Your <span>Vision</span> To Life</h2>
                            <p class="content">
                                <?php echo nl2br($site_settings->contact_description) ?>
                            </p>
                            <form class="mt-4" method="POST" action="{{ route('frontend.contact') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="single-input-inner style-border">
                                            <input type="text" placeholder="Your Name" name="name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="single-input-inner style-border">
                                            <input type="email" placeholder="Your Email" name="email" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="single-input-inner style-border">
                                            <input type="text" placeholder="Your Phone" name="phone_number" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="single-input-inner style-border">
                                            <input type="text" placeholder="Your Subject" name="subject" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single-input-inner style-border">
                                            <textarea placeholder="Message" name="message" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-black mt-0 w-100 border-radius-5" href="#">Submit
                                            now</button>
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
