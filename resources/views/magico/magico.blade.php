<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Magico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-thin.css">

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css">

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css">

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('fabric/context.standalone.css')}}"> 
    <link rel="stylesheet" href="{{ asset('fabric/magico.css')}}"> 
    @section('styles') 
    <style>
        .add-as-template{  
            transition: all .4s ease-in-out;
            cursor: pointer;
        }
        .add-as-template:hover{
            transform: scale(1.1);
            box-shadow: 2px 9px 20px 1px #6e6e6e;
        }
    </style>
</head>

<body>   

    @include('magico.save_template')
    @include('magico.offCanvas')

    <div style="position: fixed;bottom:0;right:0;z-index:1;display:flex">
        <button class="btn btn-custom btn-sm" style="background: #9ca9ab" onclick="zoomIn()"><i class="fa-regular fa-magnifying-glass-plus"></i></button> 
        <input type="number" id="zoom-precent" class="form-control" style="width: 90px" onchange="change_zoom()">
        <button class="btn btn-custom btn-sm" style="background: #9ca9ab" onclick="zoomOut()"><i class="fa-light fa-magnifying-glass-minus"></i></button>
    </div>

    @include('magico.draw_items')
    <div class="d-flex">
        <div class="bg-light common-background side-menu d-none d-md-block d-lg-block" style="z-index: 1;padding:0 10px">
            @include('magico.side_menu')
        </div>
        <div class=" min-vh-100 nav-items" style="background: #e7e7e7;width:100%">  
            @include('magico.nav_items')
            <div class="container-scrollable-x" id="page-container" style="overflow-x:scroll">
                <div style="margin-top: 6rem;display: flex;flex-direction: column;align-items: center;" id="canvas-pages">
                    {{-- canvas pages --}}
                </div> 
                <div id="active_helper_buttons" class="btn-group btn-group-sm active_helper_buttons" role="group" >
                    @include('magico.objectButtons')
                </div>  
                @include('magico.pageButtons') 
            </div> 
        </div>
    </div> 

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"> </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/RubaXa/Sortable/Sortable.min.js"></script>
    <script src="{{ asset('fabric/jquery-loading-overlay.min.js') }}"></script>  
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <script src="{{ asset('fabric/context.js') }}"></script>
    <script src="{{ asset('fabric/initialize_context.js') }}"></script>
    <script src="{{ asset('fabric/fabric.js') }}"></script>
    <script src="{{ asset('fabric/create_canvas.js') }}"></script>
    <script src="{{ asset('fabric/helpers.js') }}"></script>
    <script>  

        var canvasPages = [];   
        var selectedObject = null; 
        var hoverdObject = null; 
        var clickedObject = null; 
        var objectToCrop = null;
        var currentCanvasId = null;
        var draw_mode = false;
        var isCrop = false;   
        var canvasWidth = 1200;
        var canvasHeight = 630;
        var zoomPercentage = 100; // Initial zoom level
        function zoomIn() {
            zoomPercentage += 10;
            updateZoom();
        }

        function zoomOut() {
            zoomPercentage -= 10;
            updateZoom();
        }
        
        function change_zoom(){
            zoomPercentage = parseInt($('#zoom-precent').val());
            updateZoom();
        }

        function updateZoom() {
            document.getElementById('page-container').style.transform = 'scale(' + (zoomPercentage / 100) + ')';
            $('#zoom-precent').val(zoomPercentage);
            console.log(zoomPercentage);
        }
        var corner_options = {
            cornerSize: 10,
            cornerStyle: 'rect',
            cornerStrokeColor: '#5DADE2',
            borderColor: '#5DADE2',
            borderDashArray: [10, 5],
            borderScaleFactor: 1.5,
            cornerColor: 'white',
            transparentCorners: false,
        };  

        $(document).ready(function() {  
            $("body").tooltip({ selector: '[data-bs-toggle=tooltip]' });
            Sortable.create(demo1, {  animation: 150, ghostClass: 'blue-background-class','handle':'.handle'});
            $('.select2').select2()  
            $('.dropdown').on('show.bs.dropdown', function () {
                $('.nav-bar').css('overflow', 'visible'); 
            }); 
            $('.dropdown').on('hide.bs.dropdown', function () {
                $('.nav-bar').css('overflow-y', 'hidden'); 
                $('.nav-bar').css('overflow-x', 'scroll'); 
            });
            calculateZoom()
        });   
        
        // Recalculate on window resize
        window.onresize = calculateZoom;

        function calculateZoom() {
            var containerWidth = $('#page-container').width(); 
            var containerContent = $('#canvas-pages').width(); 
            tozoom = ($('body').width() / canvasWidth) * 66;
            zoomPercentage = Math.round(tozoom * 100) / 100
            console.log('page-container:' + containerWidth);
            console.log('canvas-width:' + canvasWidth);
            console.log('body width:' + $('body').width());
            updateZoom();
        }


        createCanvas(); 
        
        $("#template-form").on("submit", function(ev) {
            ev.preventDefault(); // Prevent browser default submit.
            var formData = new FormData(this);
            $.LoadingOverlay("show"); 

            var pages = {}; 
            for(var i in canvasPages)
            { 
                var dataset = canvasPages[i].toJSON();
                pages[i] = JSON.parse(JSON.stringify(dataset)).objects;
            }  
            formData.append('canvas_pages',JSON.stringify(pages));
            $.ajax({
                url: '{{ route("admin.templates.save")}}',
                type: 'POST', 
                data: formData, 
                success: function(response) {   
                    $.LoadingOverlay("hide"); 
                    showAlert('success', 'Success Save Template', '');
                    console.log(response);
                },
                error: function(err) {
                    $.LoadingOverlay("hide"); 
                    showAlert('error', 'Something Went Wrong', '');
                    console.log('Error' + err);
                },
                cache: false,
                contentType: false,
                processData: false
            }); 
        });
    </script>  
    <script src="{{ asset('fabric/draw.js') }}"></script>
    <script src="{{ asset('fabric/listners.js') }}"></script>
    <script src="{{ asset('fabric/undo_redo.js') }}"></script>
    <script src="{{ asset('fabric/alignments.js') }}"></script>
    <script src="{{ asset('fabric/effects.js') }}"></script>
    <script src="{{ asset('fabric/custom_rotation.js') }}"></script> 
    <script src="{{ asset('fabric/crop_image.js') }}"></script>
    <script src="{{ asset('fabric/text_attributes.js') }}"></script> 

    {{-- script loading images from outsources --}}
    <script>

    
        $('body').on('click', '.add-as-template', function(e) {   
            $.LoadingOverlay("show"); 
            let template_src = e.target.getAttribute("data-src"); 
            let pages  = JSON.parse(template_src);
            let page_1_objects = Object.values(pages)[0];
            var page_1 = {
                "objects" : page_1_objects
            } 
            canvasPages[currentCanvasId].loadFromJSON(JSON.stringify(page_1), function () {
                // Render canvas after loading JSON
                canvasPages[currentCanvasId].renderAll();
                $.LoadingOverlay("hide"); 
            });
        });
        var loading_images_unsplash = false;
        var images_page_unsplash = 2 ; 
        $('#offcanvas-unsplash').on('scroll', function (e) {
            if($(this).scrollLeft() + $(this).innerWidth() >= $(this)[0].scrollWidth) {
                if(!loading_images_unsplash){
                    var spinner = '<div style="min-width: fit-content;display:flex;align-items:center" id="loading_images_unsplash"> <div class="spinner-border" role="status"> <span class="visually-hidden">Loading...</span> </div></div>';
                    $(spinner).appendTo(this);
                    loading_images_unsplash = true;  
                    $.ajax({
                        url: $('#search-unsplash').val() ? '{{ route("frontend.unsplash_query_images") }}' :  '{{ route("frontend.unsplash_loading_more_images") }}',
                        type: 'POST',
                        data: {
                            page: images_page_unsplash++,
                            search: $('#search-unsplash').val(),
                            _token: '{{ csrf_token() }}',
                        }, 
                        success: function(response) {  
                            $(response).appendTo(e.target); 
                            loading_images_unsplash = false;  
                            $('#loading_images_unsplash').remove(); 
                        },
                        error: function(err) {
                            console.log('Error' + err);
                            loading_images_unsplash = false;  
                        },
                    });
                }
            } 
        }) 

        // load images fron unsplash based on user search
        function unsplash_query_images(){
            images_page_unsplash = 1;
            $.ajax({
                url: '{{ route("frontend.unsplash_query_images") }}',
                type: 'POST',
                data: {
                    page: images_page_unsplash++,
                    search: $('#search-unsplash').val(),
                    _token: '{{ csrf_token() }}',
                }, 
                success: function(response) {  
                    $('#offcanvas-unsplash').html(response);  
                },
                error: function(err) {
                    console.log('Error' + err);
                    $('#offcanvas-unsplash').html('No Results Found Related To ur Search');
                },
            });
        }


        var loading_images_pixabay = false;
        var images_page_pixabay = 2 ; 
        $('#offcanvas-pixabay').on('scroll', function (e) {
            if($(this).scrollLeft() + $(this).innerWidth() >= $(this)[0].scrollWidth) {
                if(!loading_images_pixabay){
                    var spinner = '<div style="min-width: fit-content;display:flex;align-items:center" id="loading_images_pixabay"> <div class="spinner-border" role="status"> <span class="visually-hidden">Loading...</span> </div></div>';
                    $(spinner).appendTo(this);
                    loading_images_pixabay = true;  
                    $.ajax({
                        url: '{{ route("frontend.pixabay_loading_images") }}',
                        type: 'POST',
                        data: {
                            page: images_page_pixabay++,
                            search: $('#search-pixabay').val(),
                            _token: '{{ csrf_token() }}',
                        }, 
                        success: function(response) {  
                            $(response).appendTo(e.target); 
                            loading_images_pixabay = false;  
                            $('#loading_images_pixabay').remove(); 
                        },
                        error: function(err) {
                            loading_images_pixabay = false;   
                            console.log('Error' + err);
                        },
                    });
                }
            } 
        }) 
        function pixabay_loading_images(){ 
            images_page_pixabay = 1;
            $.ajax({
                url: '{{ route("frontend.pixabay_loading_images") }}',
                type: 'POST',
                data: {
                    page: images_page_pixabay++,
                    search: $('#search-pixabay').val(),
                    _token: '{{ csrf_token() }}',
                }, 
                success: function(response) {  
                    $('#offcanvas-pixabay').html(response);  
                },
                error: function(err) {
                    $('#offcanvas-pixabay').html('No Results Found Related To ur Search');
                    console.log('Error' + err);
                },
            });
        }

        

        var loading_images_iconscout = false; 
        $('#offcanvas-iconscout').on('scroll', function (e) {
            if($(this).scrollLeft() + $(this).innerWidth() >= $(this)[0].scrollWidth) {
                if(!loading_images_iconscout){
                    var spinner = '<div style="min-width: fit-content;display:flex;align-items:center" id="loading_images_iconscout"> <div class="spinner-border" role="status"> <span class="visually-hidden">Loading...</span> </div></div>';
                    $(spinner).appendTo(this);
                    loading_images_iconscout = true;  
                    $.ajax({
                        url: '{{ route("frontend.iconscout_loading_images") }}',
                        type: 'POST',
                        data: {
                            page_url: $('.next-icon-scout:last').val(),
                            search: $('#search-iconscout').val(),
                            _token: '{{ csrf_token() }}',
                        }, 
                        success: function(response) {  
                            $(response).appendTo(e.target); 
                            loading_images_iconscout = false;  
                            $('#loading_images_iconscout').remove(); 
                        },
                        error: function(err) {
                            loading_images_iconscout = false;   
                            console.log('Error' + err);
                        },
                    });
                }
            } 
        }) 
        function iconscout_loading_images(){  
            $.ajax({
                url: '{{ route("frontend.iconscout_loading_images") }}',
                type: 'POST',
                data: {
                    page_url: '/v3/search?',
                    search: $('#search-iconscout').val(),
                    _token: '{{ csrf_token() }}',
                }, 
                success: function(response) {  
                    $('#offcanvas-iconscout').html(response);  
                },
                error: function(err) {
                    $('#offcanvas-iconscout').html('No Results Found Related To ur Search');
                    console.log('Error' + err);
                },
            });
        }

    </script>
</body> 
</html>
