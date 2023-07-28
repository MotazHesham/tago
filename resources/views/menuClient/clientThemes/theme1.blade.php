<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">


    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $menuClient->user->name ?? '' }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
    <link href="https://fonts.googleapis.com/css?family=Cookie" rel="stylesheet">

    <link href="{{ asset('frontend/menus/theme1/model.css') }}" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <!----animate--->
    <link rel="stylesheet" href="{{ asset('frontend/menus/theme1/animate.css') }}" />
    <script src="{{ asset('frontend/menus/theme1/js/wow.min.js') }}"></script>
    <script>
        new WOW().init();
    </script>
    <!----animate--->

    <style>
        .multipleTabs {
            display: flex;
            flex-flow: row nowrap;
            position: relative;
            margin-bottom: 20px;
        }

        .multipleTabs .prev-control {
            display: none;
        }

        .multipleTabs .next-control {
            display: none;
        }

        .multipleTabs a {
            flex: 1 0 0;
            padding: 20px 10px;
            text-align: center;
            text-decoration: none;
            margin: 5px 10px;
            border-bottom: 2px solid var(--wesbos);
            border-radius: 0x;
            color: #292929;
            font-weight: bold;
            text-decoration: none;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .multipleTabs a.active {
            background: #333;
            color: #fff;
        }

        .tabcontent {
            display: none;
        }

        .tabcontent img {
            width: 100%;
        }

        @media screen and (max-width: 768px) {
            .multipleTabs a {
                display: none;
            }

            .multipleTabs a.active {
                display: block;
            }

            .multipleTabs .prev-control {
                display: inline-block;
                position: absolute;
                left: 20px;
                top: 25px;
                color: #fff;
                cursor: pointer;
            }

            .multipleTabs .next-control {
                display: inline-block;
                position: absolute;
                right: 20px;
                top: 25px;
                color: #fff;
                cursor: pointer;
            }
        }

        body {
            margin: 0;
            padding: 0;
            background-image: url("menu_bg.jpg");
        }

        :root {
            --wesbos: #ffc600;
        }

        .about-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            font: 25px cookie, cursive;
            color: #fff;
        }

        .menu_warp {
            background-position: right;
            background-size: cover;
            height: 100vh;
            background-attachment: fixed;
        }

        .menu {
            display: none;
        }

        .menu--is-visible {
            display: grid;
        }

        @media (min-width: 768px) {
            .menu {
                grid-template-columns: repeat(2, 1fr);
                grid-column-gap: 80px;
            }
        }

        .item__header {
            display: flex;
            align-items: baseline;
        }

        .item__title {
            font: 35px;
            color: #000;
            margin: 0;
        }

        .item__dots {
            flex: 1;
            border-bottom: 1px dashed #aaa;
            margin: 0 15px;
        }

        .item__price {
            font-size: 25px;
            font-weight: bold;
        }

        .item__description {
            margin-bottom: 40px;
        }

        .buttons-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 35px;
        }

        @media (min-width: 768px) {
            .buttons-container {
                margin-bottom: 60px;
            }
        }

        .button {
            margin: 5px 10px;
            padding: 5px 10px;
            border-bottom: 2px solid var(--wesbos);
            border-radius: 0x;
            color: #292929;
            font-weight: bold;
            text-decoration: none;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .highlight {
            position: absolute;
            top: 0;
            left: 0;
            display: block;
            background: var(--wesbos);
            border-radius: 0px;
            z-index: -1;
            transition: 0.24s;
        }

        .container {
            width: 90%;
            margin: 0 auto;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            align-items: center;
            background-color: #f6f6f6;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
                Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
        }

        .wrapper {
            width: 100%;
            margin: 0 auto;
        }

        h2 {
            margin-top: 30px;
            border-bottom: 4px solid var(--wesbos);
            margin-top: 0;
            font: 80px cookie, cursive;
            text-align: center;
            color: #fff;
            margin-bottom: 0;
        }

        .cover {
            background-color: #000;
            padding: 10px 0 0 0;
        }

        .row {
            display: flex;
            justify-content: center;
        }

        .adv {
            width: 330%;
            display: inline;
            border: 10px solid #fff;
            -webkit-box-shadow: -5px 1px 5px -3px rgba(0, 0, 0, 0.75);
            -moz-box-shadow: -5px 1px 5px -3px rgba(0, 0, 0, 0.75);
            box-shadow: -5px 1px 5px -3px rgba(0, 0, 0, 0.75);
        }

        .adv img {
            width: 100%;
        }

        /* Fixed/sticky icon bar (vertically aligned 50% from the top of the screen) */
        .icon-bar {
            position: relative;
            display: flex;
            flex: content;
            margin-top: ;
            justify-content: center;
        }

        /* Style the icon bar links */
        .icon-bar a {
            display: block;
            text-align: center;
            padding: 8px;
            transition: all 0.3s ease;
            color: white;
            font-size: 15px;
        }

        .icon-bar li {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 40px;
            width: 40px;
            border-radius: 50%;
            cursor: pointer;
        }

        .icon-bar li:before {}

        .icon-bar li a span {
            font-size: 27px;
            line-height: 70px;
            color: whitesmoke;
            transition: all 0.3s ease-out;
        }

        .icon-bar li:hover a span {
            transform: scale(1.1);
        }

        .main_categ_color {
            width: 100%;
        }

        .icon-bar a:hover {
            background-color: #000;
        }

        .facebook {
            background: #aeaeae;
            color: white;
        }

        .twitter {
            background: #aeaeae;
            color: white;
        }

        .google {
            background: #aeaeae;
            color: white;
        }

        .linkedin {
            background: #aeaeae;
            color: white;
        }

        .youtube {
            background: #aeaeae;
            color: white;
        }

        .instagram {
            background: #aeaeae;
            color: white;
        }

        .tiktok {
            background: #aeaeae;
            color: white;
        }
        .whatsapp {
            background: #aeaeae;
            color: white;
        }

        .bannerimage {
            width: 100%;
            background-image: url(banner_bg.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            height: 200px;
            background-position: center center;
            margin-bottom: 50px;
        }
    </style>

    <script>
        window.console = window.console || function(t) {};
    </script> 
</head>

<body translate="no" style="background-image: url('{{asset('frontend/menus/theme1/menu_bg.jpg')}}')">

    <div class="cover">
        <div class="container">
            <div class="logo"><img src="{{ $menuClientList->logo ? $menuClientList->logo->getUrl() : '' }}" width="100"> </div>
            <a class="btn about-btn" data-popup-open="popup-1" href="#">About us</a>

            <h2>Our Menu</h2>
        </div>
    </div>



    <div class="container">
        <nav class="multipleTabs">
            @foreach($menuClientList->categories as $category)
                <a href="javascript:void(0);" data-trigger="content-{{$category->id}}" @if($loop->first) class="active" @endif>{{ $category->name }}</a>
            @endforeach 
            <div class="prev-control">Prev</div>
            <div class="next-control">Next</div>
        </nav>
        @foreach($menuClientList->categories as $category)
            <div id="content-{{$category->id}}" class="tabcontent wow fadeIn" data-wow-duration="3s" data-wow-delay="1s ">

                <div class="bannerimage" style="background-image: url('{{ $category->banner ? $category->banner->getUrl() : '' }}');"></div>

                <div class="menu menu--is-visible" id="pizzaMenu"> 
                    @foreach($category->products as $product)
                        <div class="item">
                            <div class="item__header">
                                <h3 class="item__title">{{ $product->name ?? '' }}</h3>
                                <span class="item__dots"></span>
                                <span class="item__price">{{ $product->price ?? '' }} EGP</span>
                            </div>
                            <p class="item__description"><?php echo nl2br($product->description); ?> </p>
                        </div> 
                    @endforeach
                </div> <!-- End Pizza Menu --> 
            </div> 
        @endforeach 
    </div>


    <!-----------------------about---------->

    <script>
        $(function() {
            //----- OPEN
            $('[data-popup-open]').on('click', function(e) {
                var targeted_popup_class = jQuery(this).attr('data-popup-open');
                $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);

                e.preventDefault();
            });

            //----- CLOSE
            $('[data-popup-close]').on('click', function(e) {
                var targeted_popup_class = jQuery(this).attr('data-popup-close');
                $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);

                e.preventDefault();
            });
        });
    </script>

    <div class="popup" data-popup="popup-1">
        <div class="popup-inner sponsors_inner">

            <h3>About us</h3>
            <p> 
                <?php echo nl2br($menuClientList->about_us); ?>
            </p>
            <a class="popup-close " data-popup-close="popup-1" href="#">x</a>
        </div>


    </div>
    <!-- The social media icon bar -->
    <div class="icon-bar">
        @if($menuClientList->facebook) <a href="{{ $menuClientList->facebook }}" class="facebook"><i class="fa fa-facebook"></i></a>@endif
        @if($menuClientList->twitter) <a href="{{ $menuClientList->twitter }}" class="twitter"><i class="fa fa-twitter"></i></a>@endif
        @if($menuClientList->google) <a href="{{ $menuClientList->google }}" class="google"><i class="fa fa-google"></i></a>@endif
        @if($menuClientList->linkedin) <a href="{{ $menuClientList->linkedin }}" class="linkedin"><i class="fa fa-linkedin"></i></a>@endif
        @if($menuClientList->tiktok) <a href="{{ $menuClientList->tiktok }}" class="tiktok"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></svg></a> @endif
        @if($menuClientList->youtube) <a href="{{ $menuClientList->youtube }}" class="youtube"><i class="fa fa-youtube"></i></a>@endif
        @if($menuClientList->instagram) <a href="{{ $menuClientList->instagram }}" class="instagram"><i class="fa fa-instagram"></i></a>@endif
        @if($menuClientList->whatsapp) <a href="{{ $menuClientList->whatsapp }}" class="whatsapp"><i class="fa fa-whatsapp"></i></a>@endif
    </div>



    <script
        src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-2c7831bb44f98c1391d6a4ffda0e1fd302503391ca806e7fcc7b9b87197aec26.js">
    </script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script id="rendered-js">
        var activeTab = $(".multipleTabs").find('a.active').data('trigger');
        $('#' + activeTab).show();

        $('.multipleTabs>a').on('click', function() {
            var tabId = $(this).data('trigger');
            $('#' + tabId).show();
            $('.tabcontent:not(#' + tabId + ')').hide();
            $(this).addClass('active');
            $(this).siblings('a').removeClass('active');
        });

        $('.next-control').on('click', function() {
            var tabslen = $('.multipleTabs>a').length - 1;
            var activetablen = $('.multipleTabs>a.active').index();
            var activetabs = $('.multipleTabs>a.active');
            var activeTab = $('.multipleTabs>a.active').data('trigger');
            if (activetablen == tabslen) {
                return false;
            } else {
                $(activetabs).removeClass('active');
                $(activetabs).next().addClass('active');
                $('#' + activeTab).hide();
                $('#' + activeTab).next().show();
            }
        });

        $('.prev-control').on('click', function() {
            var tabslen = $('.multipleTabs>a').length - 1;
            var activetablen = $('.multipleTabs>a.active').index();
            var activetabs = $('.multipleTabs>a.active');
            var activeTab = $('.multipleTabs>a.active').data('trigger');
            if (activetablen == 0) {
                return false;
            } else {
                $(activetabs).removeClass('active');
                $(activetabs).prev().addClass('active');
                $('#' + activeTab).hide();
                $('#' + activeTab).prev().show();
            }
        });
        //# sourceURL=pen.js
    </script>


</body>

</html>
