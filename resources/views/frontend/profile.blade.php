<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Tago</title>
    <link rel="icon" href="assets/img/favicon.png" sizes="20x20" type="image/png" />
    <!--------------------CART--------------->
    <script>
        document.getElementsByTagName("html")[0].className += " js";
    </script>
    <link rel="stylesheet" href="{{ asset('frontend/css/cart.css') }}" />
    <!--------------------CART--------------->
    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/fontawesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('frontend/css/owl.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}" />

    <!--------video---------------->

    <link href="{{ asset('frontend/css/model.css') }}" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!--------video---------------->
</head>

<body> 

    <!-- search popup end-->
    <div class="body-overlay" id="body-overlay"></div>

    <!-- navbar end -->

    <div class="container" id="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="wrapper">
                    <div class="profile-card">
                        <div class="profile-header" @if($user->cover) style="background-image:url('{{ $user->cover->getUrl() }}');background-size: cover;" @endif>
                            @if(!$user->cover) 
                                <img src="{{ asset('frontend/img/profile-bg.png') }}" alt="" />
                            @endif
                        </div>
                        <div class="profile-body">
                            <div class="author-img">
                                @if($user->photo)
                                    <img src="{{ $user->photo->getUrl() }}" alt="" @if($user->cover) style="margin-top: -88px;"  @endif/>
                                @else 
                                    <img src="{{ asset('user.png') }}" alt="" @if($user->cover) style="margin-top: -88px;" @endif/>
                                @endif
                            </div>
                            <div class="name">{{ $user->name ?? '' }}</div>
                            <p>{{ $user->nickname ?? '' }}</p>

                            <div class="contact-icon">
                                <ul>
                                    <li>
                                        <a href="mailto:{{ $user->email }}">
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="tel:{{ $user->phone_number }}">
                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                        </a>
                                    </li> 
                                    <li>
                                        <form action="{{ route('frontend.save_contact',$user->id) }}">
                                            <button class="primary-btn" type="submit"  style="background-color: #274645; padding: 2px 12px; border: solid thin #030304;">
                                                SaveContact
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            
                            </div>
                            <div class="intro">
                                <p>
                                    <?php echo $user->bio; ?>
                                </p>
                            </div> 
                            <button class="primary-btn" data-bs-toggle="modal" data-bs-target="#exchange">Contact with me</button>
                            <div class="social-icon">
                                <ul>
                                    @foreach($user->userUserLinks as $userLink)
                                        @php 
                                            $base_url = $userLink->main_link->base_url ?? null;
                                        @endphp 
                                        <li>
                                            <a onclick="tap_link('{{$userLink->id}}')" href="{{ $base_url ? $base_url . $userLink->link : $userLink->link }}" target="_blanc">
                                                @if($userLink->photo)
                                                    <img src="{{$userLink->photo->getUrl('thumb')}}" alt="" style="border-radius: 50%">
                                                @else 
                                                    <img src="{{$userLink->main_link->photo ? $userLink->main_link->photo->getUrl('thumb') : ''}}" alt="" style="border-radius: 50%">
                                                @endif
                                            </a>
                                            <p>{{ $userLink->name }}</p>
                                        </li> 
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="cd-cart cd-cart--empty js-cd-cart">
        <a href="#0" class="cd-cart__trigger text-replace">
            Cart
            <ul class="cd-cart__count">
                <!-- cart items count -->
                <li>0</li>
                <li>0</li>
            </ul>
            <!-- .cd-cart__count -->
        </a>

        <div class="cd-cart__content">
            <div class="cd-cart__layout">
                <header class="cd-cart__header">
                    <h2>Cart</h2>
                    <span class="cd-cart__undo">Item removed. <a href="#0">Undo</a></span>
                </header>

                <div class="cd-cart__body">
                    <ul>
                        <!-- products added to the cart will be inserted here using JavaScript -->
                    </ul>
                </div>

                <footer class="cd-cart__footer">
                    <a href="#0" class="cd-cart__checkout">
                        <em>Checkout - $<span>0</span>
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
        </div>
        <!-- .cd-cart__content -->
    </div>
    <!-- cd-cart -->

    <!-- back to top area start -->
    <div class="back-to-top">
        <span class="back-top"><i class="fa fa-angle-up"></i></span>
    </div>
    <!-- back to top area end -->

    <script>
        $(function() {
            //----- OPEN
            $("[data-popup-open]").on("click", function(e) {
                var targeted_popup_class = jQuery(this).attr("data-popup-open");
                $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);

                e.preventDefault();
            });

            //----- CLOSE
            $("[data-popup-close]").on("click", function(e) {
                var targeted_popup_class = jQuery(this).attr("data-popup-close");
                $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);

                e.preventDefault();
            });
        });
    </script>

    
    <div class="modal fade bd-example-modal-lg theme-modal" id="exchange" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content exchange-modal">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div>
                        <form action="{{ route('frontend.exchange_contacts') }}" method="POST">
                            @csrf 
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                            <h5 class="text-center">Exhange You Info With <b>{{ $user->name }}</b> !</h5>
                            <div class="container">
                                <div class="row"> 
                                    <div class="form-group col-md-6">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="title">NickName</label>
                                        <input type="text" name="title" id="title" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="phone_number">Phone</label>
                                        <input type="text" name="phone_number" id="phone_number" class="form-control">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="link">Social link</label>
                                        <input type="text" name="link" id="link" class="form-control">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="message">Message</label>
                                        <textarea name="message" id="message" class="form-control" cols="30" rows="4" placeholder="Type your message..."></textarea>
                                    </div>
                                    <div class="form-group col-md-12 mt-4 text-center">
                                        <button class="btn btn-info" type="submit">Exchange</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

    <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>

    <script src="{{ asset('frontend/js/custom.js') }}"></script>

    <!------------cart----------->
    <script src="{{ asset('frontend/js/util.js') }}"></script>
    <!-- util functions included in the CodyHouse framework -->
    <script src="{{ asset('frontend/js/cart.js') }}"></script>

    <!-----------------LOIGIN----------->

    <script>
        function tap_link(id){
            
            $.post('{{ route('frontend.tap_link') }}', {
                _token: '{{ csrf_token() }}',
                id: id
            }, function(data) { 
                // 
            });
        }
    </script>
</body>

</html>
