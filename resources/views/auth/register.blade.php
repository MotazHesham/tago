@extends('layouts.frontend')
@section('styles')
    <style>
        form {
            background-color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 100px 50px;
            height: 100%;
            text-align: center;

        }


        .login {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
                0 10px 10px rgba(0, 0, 0, 0.22);
            position: relative;
            overflow: hidden;
            width: 100%;
            max-width: 100%;
        }

        .form-container {
            position: relative;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }

        .sign-in-container {
            width: 100%;
        }

        .container.right-panel-active .sign-in-container {
            transform: translateX(100%);
        }

        .sign-up-container {
            width: 100%;
            opacity: 0;
            z-index: 1;
        }

        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.6s ease-in-out;
            z-index: 100;
        }

        .container.right-panel-active .overlay-container {
            transform: translateX(-100%);
        }

        .overlay {
            background: #FF416C;
            background: -webkit-linear-gradient(to right, #61B3AE, #3a948e);
            background: linear-gradient(to right, #61B3AE, #3a948e);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 0 0;
            color: #FFFFFF;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .container.right-panel-active .overlay {
            transform: translateX(50%);
        }

        .overlay-panel {
            position: relative;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            top: 0;
            height: 100%;

            background-color: #3a948e;
        }


        .overlay-panel h4 {
            color: #fff;
        }

        .overlay-panel p {
            color: #fff;
        }

        .overlay-left {
            transform: translateX(-20%);
        }

        .container.right-panel-active .overlay-left {
            transform: translateX(0);
        }

        .overlay-right {
            right: 0;
            transform: translateX(0);
        }

        .container.right-panel-active .overlay-right {
            transform: translateX(20%);
        }

        .social-container {
            margin: 20px 0;
        }

        .social-container a {
            border: 1px solid #DDDDDD;
            border-radius: 50%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin: 0 5px;
            height: 40px;
            width: 40px;
        }

        .invalid-feedback{
            display: inline !important;
        }

        @media all and (max-width: 768px) {
            .overlay-panel {
                padding: 100px 0;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container" id="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="login">

                    <div class="row">



                        <div class="col-md-6">
                            <div class="overlay-panel overlay-right">
                                <h4>Hello, Friend!</h4>
                                <p>Enter your personal details and start journey with us</p>
                                <a class="ghost white-text btn " id="signUp" href="{{ route('login') }}">Sign In</a>
                            </div>
                        </div>


                        <div class="col-md-6">

                            <form action="{{ route('register') }}" method="POST">
                                @csrf
                                <h4>Create Account</h4>
                                <div class="social-container">
                                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                                <span>or use your email for registration</span>

                                <div class="single-input-inner style-border">
                                    <input type="text" placeholder="Name" name="name" required value="{{ old('name')}}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="single-input-inner style-border">
                                    <input type="email" placeholder="Email" name="email" required value="{{ old('email') }}"/>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div> 
                                <div class="single-input-inner style-border">
                                    <input type="password" name="password" placeholder="Password" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="single-input-inner style-border">
                                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                                </div>
                                <button type="submit" class="btn primary-btn">Sign Up</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>




        </div>
    </div>
@endsection
