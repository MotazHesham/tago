@extends('layouts.frontend')

@section('content')
    <!-- page title start -->
    <div class="breadcrumb-area ">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <h2 class="page-title">{{ trans('frontend.tutorials.tutorials') }}</h2>
                    </div>
                    <div class="col-lg-6 text-lg-end">
                        <ul class="page-list">
                            <li><a href="{{ route('home') }}">{{ trans('frontend.tutorials.home') }}</a></li>
                            <li>{{ trans('frontend.tutorials.tutorials') }} </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page title end -->

    <!-- service area start -->


    <div class="blog-area pt-4 pd-bottom-90">
        <div class="container">

            <div class="row">
                @foreach($tutorials as $tutorial)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-blog-list">
                            <div class="thumb">
                                <?php echo $tutorial->iframe ?>
                            </div>
                            <div class="details">

                                <h5 class="mb-3 text-center">{{ $tutorial->name }}</h5>

                            </div>
                        </div>
                    </div> 
                @endforeach
            </div>
        </div>
    </div>


    <!-- service area end -->
@endsection
