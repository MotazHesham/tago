@extends('layouts.frontend')

@section('content')
    <!-- page title start -->
    <div class="breadcrumb-area bg-cover">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <h2 class="page-title">{{ trans('global.privacy') }}</h2>
                    </div>
                    <div class="col-lg-6 text-lg-end">
                        <ul class="page-list">
                            <li><a href="{{ route('home') }}">{{ trans('frontend.contact_us.home') }}</a></li>
                            <li> {{ trans('global.privacy') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page title end -->

    <div class="about-area pd-top-120">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    {!! trans('panel.privacy') !!}
                </div>
            </div>
        </div>
    </div>
@endsection
