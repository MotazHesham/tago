<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>{{ $menuClient->user->name ?? '' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/menus/theme2/style.css') }}" media="all" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/menus/theme2/demo.css') }}" media="all" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <link href="{{ asset('frontend/menus/theme2/model.css') }}" rel="stylesheet" type="text/css" /> 

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script>
        window.console = window.console || function(t) {};
    </script>

    <!-----------------------about---------->

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
</head>

<body translate="no">
    <div class="container">
        <div class="row">
            <div class="logo"><img src="{{ $menuClientList->logo ? $menuClientList->logo->getUrl() : '' }}" width="150"> </div>
            <a class="btn about-btn" data-popup-open="popup-1" href="#">About us</a>
        </div>
        <!-- Tab Markup START -->
        <div class="cd-tabs" id="mytabdemo">
            <ul class="cd-nav"> 
                @foreach($menuClientList->categories as $category)
                    <li class="cd-tab">{{ $category->name }}</li> 
                @endforeach 
            </ul>

            <div class="cd-panes">
                @foreach($menuClientList->categories as $category)
                    <div class="pane">
                        <!-- start our menu here-->
                        <div class="our_menu">
                            <ul class="menu">
                                @foreach($category->products as $product)
                                    <li class="item">
                                        <strong class="new">{{ $product->price ?? '' }}</strong>
                                        <a href="#">
                                            <h3>{{ $product->name ?? '' }}</h3>
                                            <p><?php echo nl2br($product->description); ?></p>
                                            <img src="{{ $product->banner ? $product->banner->getUrl() : '' }}" height="164" width="283" />
                                        </a>
                                    </li> 
                                @endforeach 
                            </ul>
                        </div>
                        <!-- end our menu -->
                    </div> 
                @endforeach 
            </div>
        </div>

        <!-- Tab Markup END -->
    </div>

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

    <div class="popup" data-popup="popup-1" style="z-index: 2">
        <div class="popup-inner sponsors_inner">
            <h3>About us</h3>
            <p>
                <?php echo nl2br($menuClientList->about_us); ?>
            </p>
            <a class="popup-close" data-popup-close="popup-1" href="#">x</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

    <script type="text/javascript">
        /*
         * Create tabs
         * option default : 1 ( default value : 1)
         * Here the index is 1 based
         */
        $(document).ready(function() {
            $("#mytabdemo").cdtabs({
                defaultTabIndex: 2
            });
        });
    </script>
    <script
        src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-2c7831bb44f98c1391d6a4ffda0e1fd302503391ca806e7fcc7b9b87197aec26.js">
    </script>

    <script id="rendered-js">
        (function($) {
            /*
             * JS Class for Tabbed view
             */
            var CDTabs = function(elem, options) {
                this.elem = elem;
                this.options = options;
            };

            CDTabs.prototype = {
                /*
                 * Prepare the markup for tabed view
                 */
                initMarkup: function() {
                    /*
                     * Add mobile navigation reference
                     */

                    var $select = $("<select/>", {
                        class: "res-nav"
                    });

                    $(".cd-tab", this.elem).each(function(idx, el) {
                        $("<option/>", {
                            value: $(el).text(),
                            text: $(el).text()
                        }).appendTo($select);
                    });

                    $select.insertAfter(".cd-nav", this.elem);

                    // Select default Tab configured by options
                    if (this.options && this.options.defaultTabIndex) {
                        this.selectTab(this.options.defaultTabIndex - 1); // Convert to 0 based index
                    } else {
                        // Select first tab
                        this.selectTab(0);
                    }
                },

                /*
                 * Bind the events for navigation
                 */
                registerEvents: function() {
                    var thisCache = this;

                    $(this.elem).on("click", ".cd-tab", function(ev) {
                        var curIndex = $(this).index();

                        thisCache.selectTab(curIndex);
                    });

                    $(".res-nav", this.elem).on("change", function(ev) {
                        var curIndex = $("option:selected", this).index();

                        thisCache.selectTab(curIndex);
                    });
                },
                /*
                 * Select a tab by it's index (zero based index)
                 */
                selectTab: function(index) {
                    $(".cd-tab", this.elem).removeClass("selected");
                    $(".pane", this.elem).removeClass("selected");

                    $(".cd-tab", this.elem).eq(index).addClass("selected");
                    $(".pane", this.elem).eq(index).addClass("selected");

                    $(".res-nav option", this.elem).prop("selected", false);
                    $(".res-nav option", this.elem).eq(index).prop("selected", true);
                }
            };

            /*
             * jQuery Plugin
             * Convert the Class in jQuery plugin
             */
            $.fn.cdtabs = function(options) {
                var thistab = new CDTabs(this, options);

                thistab.initMarkup();
                thistab.registerEvents();

                $(this).data("cdtabs", thistab);
            };
        })(jQuery);
        //# sourceURL=pen.js
    </script>
</body>

</html>
