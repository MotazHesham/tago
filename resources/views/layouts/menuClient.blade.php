<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tago</title>
    <link rel=icon href="{{ asset('frontend/img/favicon.png') }}" sizes="20x20" type="image/png">
    <!--------------------CART--------------->
    <script>
        document.getElementsByTagName("html")[0].className += " js";
    </script>
    <link rel="stylesheet" href="{{ asset('frontend/css/cart.css') }}">
    <!--------------------CART--------------->
    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.min.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/owl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/dashboard.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />


    <!--------video---------------->

    <link href="{{ asset('frontend/css/model.css') }}" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!--------video---------------->



    <script>
        window.console = window.console || function(t) {};
    </script>


    <style>
        .dashboard .header {
            background-color: #327a81;
            color: white;
            font-size: 1.5em;
            padding: 1rem;
            text-align: center;
            text-transform: uppercase;
            margin-top: 100px;
        }
        .ck-editor__editable,
        textarea {
            min-height: 180px;
        }

        .help-block{
            color: #af7b89;
            font-size: 13px;
        }
    </style>
    
    @foreach(\App\Models\MenuClientList::FONT_FAMILY_SELECT as $key => $entry) 
        <link href="https://fonts.googleapis.com/css?family={{$key}}" rel="stylesheet">
    @endforeach
    @yield('styles')
</head>

<body>

    <!-- preloader area start -->
    <!-- <div class="preloader" id="preloader">
        <div class="preloader-inner">
            <div class="spinner">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
        </div>
    </div> -->
    <!-- preloader area end -->


    <!-- search popup end-->
    <div class="body-overlay" id="body-overlay"></div>

    <div class='dashboard'>
        <div class="dashboard-nav">
            <header>
                <a href="#" class="menu-toggle">
                    <i class="fas fa-bars"></i>
                </a>
                <a href="{{ route('home') }}" class="brand-logo">
                    <img src="{{ asset('frontend/img/tago_white.png') }}" width="100">
                </a>
            </header>
            <nav class="dashboard-nav-list">
                <a href="{{ route('home') }}" class="dashboard-nav-item">
                    <i class="fas fa-home"></i> Home
                </a>
                <a href="{{ route('menuClient.home') }}" class="dashboard-nav-item {{ request()->is("menu-client/dashboard") ? "active" : "" }}"><i
                        class="fas fa-tachometer-alt"></i> dashboard
                </a>
                <a href="{{ route('menuClient.menus.index') }}" class="dashboard-nav-item {{ request()->is("menu-client/menus") ? "active" : "" }}">
                    <i class="fa fa-clipboard-list"></i> Menus
                </a>
                
                <a href="{{ route('menuClient.menu-categories.index') }}" class="dashboard-nav-item {{ request()->is("menu-client/menu-categories") ? "active" : "" }}">
                    <i class="fas fa-briefcase"></i> Categories
                </a>

                <a href="{{ route('menuClient.menu-products.index') }}" class="dashboard-nav-item {{ request()->is("menu-client/menu-products") ? "active" : "" }}">
                    <i class="fab fa-product-hunt"></i> Products
                </a>

                <a href="{{ route('menuClient.settings') }}" class="dashboard-nav-item {{ request()->is("menu-client/settings") ? "active" : "" }}">
                    <i class="fas fa-cogs"></i> Settings 
                </a>
                <div class="nav-item-divider"></div>
                <a href="#" class="dashboard-nav-item" onclick="event.preventDefault(); document.getElementById('logoutform').submit();"><i class="fas fa-sign-out-alt"></i> Logout </a>
                <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </nav>
        </div>
        <div class='dashboard-app'>
            <header class='dashboard-toolbar'><a href="#" class="menu-toggle"><i class="fas fa-bars"></i></a>
            </header>
            <div class='dashboard-content'>
                @if ($errors->count() > 0)
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @yield('content')
            </div>
        </div>




    </div>

    <script id="rendered-js">
        const mobileScreen = window.matchMedia("(max-width: 990px )");
        $(document).ready(function() {
            $(".dashboard-nav-dropdown-toggle").click(function() {
                $(this).closest(".dashboard-nav-dropdown").
                toggleClass("show").
                find(".dashboard-nav-dropdown").
                removeClass("show");
                $(this).parent().
                siblings().
                removeClass("show");
            });
            $(".menu-toggle").click(function() {
                if (mobileScreen.matches) {
                    $(".dashboard-nav").toggleClass("mobile-show");
                } else {
                    $(".dashboard").toggleClass("dashboard-compact");
                }
            });
        });
        //# sourceURL=pen.js
    </script>

    <!-- back to top area start -->
    <div class="back-to-top">
        <span class="back-top"><i class="fa fa-angle-up"></i></span>
    </div>
    <!-- back to top area end --> 
    
    <!-- Modal -->
    <div class="modal fade" id="AjaxModal" tabindex="-1" data-keyboard="false" aria-labelledby="AjaxModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            {{-- ajax call --}}
        </div>
    </div>
    
    @include('sweetalert::alert')

    <!-- all plugins here -->
    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/fontawesome.min.js') }}"></script>
    <script src="{{ asset('frontend/js/magnific.min.js') }}"></script>
    <script src="{{ asset('frontend/js/nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.min.js') }}"></script>
    <script src="{{ asset('frontend/js/counter-up.min.js') }}"></script>
    <script src="{{ asset('frontend/js/waypoint.min.js') }}"></script>
    <script src="{{ asset('frontend/js/wow.min.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>

    <!-- main js  -->
    <script src="{{ asset('frontend/js/main.js') }}"></script>

    
    <script>
        function show_qr_code(text){
            $.post('{{ route('menuClient.show_qr_code') }}', {
                _token: '{{ csrf_token() }}',
                text: text
            }, function(data) {
                $('#AjaxModal .modal-dialog').html(null);
                $('#AjaxModal').modal('show');
                $('#AjaxModal .modal-dialog').html(data); 
            });
        }
    </script>
    <script>
        //perevent submittig multiple times
        $("body").on("submit", "form", function() {
            $(this).submit(function() {
                return false;
            });
            return true;
        });
    </script>
    @yield('scripts')
</body>

</html>
