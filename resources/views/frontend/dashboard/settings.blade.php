@extends('layouts.frontDashboard')

@section('content')
    <div class='container'>
        <div class='card'>
            <div class='card-header'>
                <h4>Settings</h4>
            </div>


            <div class="row">
                <div class="col-md-6">
                    <div class="single-input-inner style-border">
                        <input type="text" placeholder="Your Name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="single-input-inner style-border">
                        <input type="text" placeholder="password">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="single-input-inner style-border">
                        <input type="text" placeholder="email">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="single-input-inner style-border">
                        <input type="text" placeholder=" Phone number">
                    </div>
                </div>


                <div class="col-md-12">
                    <div class="row">
                        <div class="col-sm-12">
                            <a href="#0" class="cd-add-to-cart js-cd-add-to-cart">Save</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
