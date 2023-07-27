<!DOCTYPE html>
<html lang="zxx">

<head>
    @php
        $site_settings = get_site_setting();
    @endphp 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" /> 
    <title>@yield('meta_title', $site_settings->website_name )</title>
    <meta name="description" content="@yield('meta_description', $site_settings->description_seo)" />
    <meta name="keywords" content="@yield('meta_keywords', $site_settings->keywords_seo)">
    <meta name="author" content="{{ $site_settings->author_seo }}">
    <meta name="sitemap_link" content="{{ $site_settings->sitemap_link_seo }}"> 
    <link rel="icon" href="{{ $site_settings->logo ? $site_settings->logo->getUrl() : '' }}" type="image/x-icon">
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
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">


    <!--------video---------------->

    <link href="{{ asset('frontend/css/model.css') }}" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!--------video---------------->


    @yield('styles')

    <script>
        window.console = window.console || function(t) {};
    </script>

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

    <!-- navbar start -->
    <nav class="navbar navbar-area navbar-expand-lg">
        <div class="container nav-container navbar-bg">
            <div class="responsive-mobile-menu">
                <button class="menu toggle-btn d-block d-lg-none" data-target="#itech_main_menu" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="icon-left"></span>
                    <span class="icon-right"></span>
                </button>
            </div>
            <div class="logo">
                <a href="{{ route('home') }}"><img src="{{ asset('frontend/img/tago.png') }}" alt="img"></a>
            </div>

            <div class="collapse navbar-collapse" id="itech_main_menu">
                <ul class="navbar-nav menu-open text-lg-end">
                    <li>
                        <a href="{{ route('home') }}">Home</a>

                    </li>
                    <li> <a href="{{ route('frontend.about') }}">about</a> </li>

                    <li class="menu-item-has-children">
                        <a href="#">Products</a>
                        <ul class="sub-menu">
                            @foreach (\App\Models\ProductCategory::all() as $category)
                                <li>
                                    <a href="{{ route('frontend.products', $category->id) }}">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                            <li><a href="{{ route('frontend.products',0) }}">All Products</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('frontend.tutorials') }}">Tutorials </a></li>




                    <li><a href="{{ route('frontend.contact') }}">Contact Us</a></li>
                </ul>
            </div>
            <div class="nav-right-part nav-right-part-desktop align-self-center">
                <a class="navbar-phone" href="{{ route('login') }}">
                    <h5>@auth Dashboard @else Login @endauth</h5>
                </a>
            </div>

            <div class="">
                <div class="lang"><a href="tago-arabic.html"><i class="fa fa-globe" aria-hidden="true"></i> Ar </a>
                </div>

            </div>


        </div>

    </nav>
    <!-- navbar end -->

    @yield('content')

    <!-- footer area start -->
    <footer class="footer-area ">
        @isset($not_include_subscribe)
            {{-- nothing to show --}}
        @else
            <div class="footer-subscribe">
                <div class="container">
                    <div class="footer-subscribe-inner bg-cover">
                        <div class="row">

                            <div class="col-lg-12 align-self-center text-lg-end">
                                <form action="{{ route('frontend.subscribe') }}" method="POST">
                                    @csrf 
                                    <input type="text" placeholder="Your e-mail address" name="email">
                                    <button type="submit" class="btn  border-radius-10" href="#">Submit now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="widget widget_about">
                        <div class="thumb">
                            <img src="{{ asset('frontend/img/logo2.png') }}" alt="img">
                        </div>
                        <div class="details">
                            <p><?php echo nl2br($site_settings->description); ?></p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="widget widget_nav_menu">
                        <h4 class="widget-title">Quick links</h4>
                        <ul>
                            <li><a href="{{ route('home') }}"><i class="fas fa-arrow-right"></i> Home</a></li>
                            <li><a href="{{ route('frontend.products',0) }}"><i class="fas fa-arrow-right"></i> Products</a></li>
                            <li><a href="{{ route('frontend.about') }}"><i class="fas fa-arrow-right"></i> About Us </a></li>
                            <li><a href="{{ route('frontend.tutorials') }}"><i class="fas fa-arrow-right"></i> Tutorials</a></li>
                            <li><a href="{{ route('frontend.contact') }}"><i class="fas fa-arrow-right"></i> Contact Us</a></li> 
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <div class="widget widget_nav_menu">
                        <h4 class="widget-title">Products</h4>
                        <ul> 
                            @foreach (\App\Models\ProductCategory::orderBy('created_at','desc')->take(6)->get() as $category)
                                <li>
                                    <i class="fas fa-arrow-right"></i>
                                    <a href="{{ route('frontend.products', $category->id) }}">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-12 ">
                    <div class="widget widget-recent-post">
                        <h4 class="widget-title">KEEP IN TOUCH </h4>
                        <ul class="social-media">
                            <li>
                                <a href="{{ $site_settings->facebook }}">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ $site_settings->tiktok }}">
                                    <i class="fab fa-tiktok"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ $site_settings->instagram }}">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ $site_settings->youtube }}">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            </li>
                        </ul>

                        <p class="mt-3"><i class="fa fa-phone-alt"></i> {{ $site_settings->phone_number }}</p>
                        <p class="mt-2"><i class="fas fa-envelope"></i> {{ $site_settings->email }}</p>


                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 align-self-center">
                        <p>© Tago 2023 | All Rights Reserved</p>
                    </div>

                </div>
            </div>
        </div>
    </footer>
    <!-- footer area end -->

    @isset($not_include_cart_popup)
        {{-- nothing to show --}}
    @else 
    <div class="cd-cart js-cd-cart">
        <a href="#0" class="cd-cart__trigger text-replace">
            Cart
            <ul class="cd-cart__count">
                <!-- cart items count -->
                <li>{{ session('cart') ? count(session('cart')) : 0 }}</li> 
                <li>{{ session('cart') ? count(session('cart')) : 0 }}</li> 
            </ul> <!-- .cd-cart__count -->
        </a>

        <div class="cd-cart__content">
            <div class="cd-cart__layout">
                <header class="cd-cart__header">
                    <h2>Cart</h2>
                    <span class="cd-cart__undo">Item removed. <a href="#0">Undo</a></span>
                </header>

                <div class="cd-cart__body">
                    <ul>
                        @php 
                            $total = 0
                        @endphp
                        @if(session('cart'))
                            @foreach(session('cart') as $cart)
                                @php
                                    $product = \App\Models\Product::find($cart['product_id']);
                                    $total += ($product->price * $cart['quantity']);
                                @endphp
                                @if($product)
                                    @include('frontend.partials.cartItem',['product' => $product, 'quantity' => $cart['quantity']])
                                @endif 
                            @endforeach
                        @endif
                    </ul>
                </div>

                <footer class="cd-cart__footer">
                    <a href="{{ route('frontend.cart') }}" class="cd-cart__checkout">
                        <em>Checkout - <span>{{ frontend_currency($total)['price'] }}</span> {{frontend_currency($total)['symbol']}}
                            <svg class="icon icon--sm" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor">
                                    <line stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        x1="3" y1="12" x2="21" y2="12" />
                                    <polyline stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        points="15,6 21,12 15,18 " />
                                </g>
                            </svg>
                        </em>
                    </a>
                </footer>
            </div>
        </div> <!-- .cd-cart__content -->
    </div> <!-- cd-cart -->

    @endisset

    <!-- back to top area start -->
    <div class="back-to-top">
        <span class="back-top"><i class="fa fa-angle-up"></i></span>
    </div>
    <!-- back to top area end -->

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

            <iframe class="youtube-video" src="https://www.youtube.com/embed/5kW0RtcJZC8"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>

            <a class="popup-close " data-popup-close="popup-1" href="#">x</a>
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

    <!-- main js  -->
    <script src="{{ asset('frontend/js/main.js') }}"></script>


    <script src='https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.1/js/swiper.min.js'></script>
    <script id="rendered-js">
        var swiper = new Swiper('.swiper-container.two', {
            pagination: '.swiper-pagination',
            paginationClickable: true,
            effect: 'coverflow',
            loop: true,
            centeredSlides: true,
            slidesPerView: 'auto',
            coverflow: {
                rotate: 0,
                stretch: 100,
                depth: 150,
                modifier: 1.5,
                slideShadows: false
            }
        });
        //# sourceURL=pen.js
    </script>


    <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>

    <script src="{{ asset('frontend/js/custom.js') }}"></script>


    <!------------cart----------->
    <script src="{{ asset('frontend/js/util.js') }}"></script> <!-- util functions included in the CodyHouse framework -->
    <script>
        (function() {
            // Add to Cart Interaction - by CodyHouse.co
            var cart = document.getElementsByClassName('js-cd-cart');
            if (cart.length > 0) {
                var cartAddBtns = document.getElementsByClassName('js-cd-add-to-cart'),
                    cartBody = cart[0].getElementsByClassName('cd-cart__body')[0],
                    cartList = cartBody.getElementsByTagName('ul')[0],
                    cartListItems = cartList.getElementsByClassName('cd-cart__product'),
                    cartTotal = cart[0].getElementsByClassName('cd-cart__checkout')[0].getElementsByTagName('span')[0],
                    cartCount = cart[0].getElementsByClassName('cd-cart__count')[0],
                    cartCountItems = cartCount.getElementsByTagName('li'),
                    cartUndo = cart[0].getElementsByClassName('cd-cart__undo')[0], 
                    cartTimeoutId = false,
                    animatingQuantity = false;
                initCartEvents();


                function initCartEvents() {
                    // add products to cart
                    for (var i = 0; i < cartAddBtns.length; i++) {
                        (function(i) {
                            cartAddBtns[i].addEventListener('click', addToCart);
                        })(i);
                    }

                    // open/close cart
                    cart[0].getElementsByClassName('cd-cart__trigger')[0].addEventListener('click', function(event) {
                        event.preventDefault();
                        toggleCart();
                    });

                    cart[0].addEventListener('click', function(event) {
                        if (event.target == cart[0]) { // close cart when clicking on bg layer
                            toggleCart(true);
                        } else if (event.target.closest('.cd-cart__delete-item')) { // remove product from cart
                            event.preventDefault();
                            removeProduct(event.target.closest('.cd-cart__product'));
                        }
                    });

                    // update product quantity inside cart
                    cart[0].addEventListener('change', function(event) {
                        if (event.target.tagName.toLowerCase() == 'select') quickUpdateCart();
                        $.post('{{ route('frontend.cart.update') }}', {
                            _token: '{{ csrf_token() }}',
                            id: (event.target).getAttribute('data-productId'),
                            quantity: event.target.value
                        }, function() {  

                        }); 
                    });

                    //reinsert product deleted from the cart
                    cartUndo.addEventListener('click', function(event) {
                        if (event.target.tagName.toLowerCase() == 'a') {
                            event.preventDefault();
                            if (cartTimeoutId) clearInterval(cartTimeoutId);
                            // reinsert deleted product
                            var deletedProduct = cartList.getElementsByClassName('cd-cart__product--deleted')[0];

                            $.post('{{ route('frontend.cart.store') }}', {
                                _token: '{{ csrf_token() }}',
                                id: deletedProduct.getAttribute('data-productId')
                            }, function(productAdded) {  
                                Util.addClass(deletedProduct, 'cd-cart__product--undo');
                                deletedProduct.addEventListener('animationend', function cb() {
                                    deletedProduct.removeEventListener('animationend', cb);
                                    Util.removeClass(deletedProduct,'cd-cart__product--deleted cd-cart__product--undo');
                                    deletedProduct.removeAttribute('style');
                                    quickUpdateCart();
                                });
                                Util.removeClass(cartUndo, 'cd-cart__undo--visible');
                            });
                        }
                    });
                };

                function addToCart(event) {
                    event.preventDefault();
                    if (animatingQuantity) return;
                    var cartIsEmpty = Util.hasClass(cart[0], 'cd-cart--empty');
                    var productId = this.getAttribute('data-productId');
                    var productPrice = this.getAttribute('data-price');
                    $.post('{{ route('frontend.cart.store') }}', {_token: '{{ csrf_token() }}',id:productId }, function(productAdded) {   
                        if(productAdded){
                            cartList.insertAdjacentHTML('beforeend', productAdded);
                            //update number of items 
                            updateCartCount(cartIsEmpty);
                            //update total price
                            updateCartTotal(productPrice, true);
                            //show cart
                            Util.removeClass(cart[0], 'cd-cart--empty'); 
                        }
                    });
                };

                function toggleCart(bool) { // toggle cart visibility
                    var cartIsOpen = (typeof bool === 'undefined') ? Util.hasClass(cart[0], 'cd-cart--open') : bool;

                    if (cartIsOpen) {
                        Util.removeClass(cart[0], 'cd-cart--open');
                        //reset undo
                        if (cartTimeoutId) clearInterval(cartTimeoutId);
                        Util.removeClass(cartUndo, 'cd-cart__undo--visible');
                        removePreviousProduct(); // if a product was deleted, remove it definitively from the cart

                        setTimeout(function() {
                            cartBody.scrollTop = 0;
                        }, 500);
                    } else {
                        Util.addClass(cart[0], 'cd-cart--open');
                    }
                }; 

                function removeProduct(product) {
                    if (cartTimeoutId) clearInterval(cartTimeoutId);  
                    removePreviousProduct(); // prduct previously deleted -> definitively remove it from the cart

                    var topPosition = product.offsetTop,
                        productQuantity = Number(product.getElementsByTagName('select')[0].value),
                        productTotPrice =  product.getAttribute('data-price') * productQuantity; 

                    product.style.top = topPosition + 'px';
                    Util.addClass(product, 'cd-cart__product--deleted');

                    //update items count + total price
                    updateCartTotal(productTotPrice, false);
                    updateCartCount(true, -1);
                    Util.addClass(cartUndo, 'cd-cart__undo--visible');

                    $.post('{{ route('frontend.cart.delete') }}', {
                        _token: '{{ csrf_token() }}',
                        id: product.getAttribute('data-productId')
                    }, function(data) { 
                        // 
                    });

                    //wait 8sec before completely remove the item
                    cartTimeoutId = setTimeout(function() {
                        Util.removeClass(cartUndo, 'cd-cart__undo--visible');
                        removePreviousProduct();
                    }, 8000);
                };

                function removePreviousProduct() { // definitively removed a product from the cart (undo not possible anymore)
                    var deletedProduct = cartList.getElementsByClassName('cd-cart__product--deleted');
                    if (deletedProduct.length > 0) deletedProduct[0].remove();
                };

                function updateCartCount(emptyCart, quantity) {
                    if (typeof quantity === 'undefined') {
                        var actual = Number(cartCountItems[0].innerText) + 1;
                        var next = actual + 1;

                        if (emptyCart) {
                            cartCountItems[0].innerText = actual;
                            cartCountItems[1].innerText = next;
                            animatingQuantity = false;
                        } else {
                            Util.addClass(cartCount, 'cd-cart__count--update');

                            setTimeout(function() {
                                cartCountItems[0].innerText = actual;
                            }, 150);

                            setTimeout(function() {
                                Util.removeClass(cartCount, 'cd-cart__count--update');
                            }, 200);

                            setTimeout(function() {
                                cartCountItems[1].innerText = next;
                                animatingQuantity = false;
                            }, 230);
                        }
                    } else {
                        var actual = Number(cartCountItems[0].innerText) + quantity;
                        var next = actual + 1;

                        cartCountItems[0].innerText = actual;
                        cartCountItems[1].innerText = next;
                        animatingQuantity = false;
                    }
                };

                function updateCartTotal(price, bool) {
                    cartTotal.innerText = bool ? (Number(cartTotal.innerText) + Number(price)).toFixed(2) : (Number(
                        cartTotal.innerText) - Number(price)).toFixed(2);
                };

                function quickUpdateCart() {
                    var price = 0;

                    for (var i = 0; i < cartListItems.length; i++) {
                        if (!Util.hasClass(cartListItems[i], 'cd-cart__product--deleted')) {
                            var singleQuantity = Number(cartListItems[i].getElementsByTagName('select')[0].value);
                            var singlePrice = Number((cartListItems[i].getElementsByClassName('cd-cart__price')[0]).getAttribute('data-price'));
                            price += singleQuantity * singlePrice;
                        }
                    }

                    cartTotal.innerText = price.toFixed(2);
                };
            }
        })();
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
