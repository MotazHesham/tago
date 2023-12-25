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
</head>

<body>   

    @include('magico.templates.saveTemplate')
    @include('magico.offCanvas')

    <div style="position: fixed;bottom:0;right:0;z-index:1;display:flex" id="zooming-buttons">
        <button class="btn btn-custom btn-sm" style="background: #9ca9ab" onclick="zoomIn()"><i class="fa-regular fa-magnifying-glass-plus"></i></button> 
        <input type="number" id="zoom-precent" class="form-control" style="width: 90px" onchange="change_zoom()">
        <button class="btn btn-custom btn-sm" style="background: #9ca9ab" onclick="zoomOut()"><i class="fa-light fa-magnifying-glass-minus"></i></button>
    </div>

    @include('magico.partials.draw_items')
    <div class="d-flex">
        {{-- <div class="bg-light common-background side-menu d-none d-md-block d-lg-block" style="z-index: 1;padding:0 10px">
            @include('magico.partials.sideMenu')
        </div> --}}
        <div class=" min-vh-100 nav-items" style="background: #e7e7e7;width:100%">  
            <div class="bg-light common-background " id="side_menu" style="position: fixed;bottom:0;left:0;z-index:1;overflow-y: scroll;height: -webkit-fill-available;margin-top: 70px;">
                @include('magico.partials.sideMenu')
            </div>
            @include('magico.partials.nav_items')
            <div class="container-scrollable-x" id="page-container" style="overflow-x:scroll">
                <div style="margin-top:6rem;display: flex;flex-direction: column;align-items:center" id="canvas-pages">
                    {{-- canvas pages --}}
                </div> 
                <div id="active_helper_buttons" class="btn-group btn-group-sm active_helper_buttons" role="group" >
                    @include('magico.buttons.object')
                </div>  
                @include('magico.buttons.page') 
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
    <script src="{{ asset('fabric/aligning_guidelines.js') }}"></script>
    <script src="{{ asset('fabric/helpers.js') }}"></script>
    <script src="{{ asset('fabric/zoom.js') }}"></script>
    <script>  

        function toggle_sidermenu(){ 
            var side_menu = $("#side_menu");
            var position = side_menu.position();
            if(position.left == 0){
                side_menu.animate({  left: "-100px", }, 750 );
            }else{
                side_menu.animate({  left: "0", }, 750 );
            }
        }

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
        
        var corner_options = {
            cornerSize: 12,
            cornerStyle: 'circle',
            cornerStrokeColor: '#5DADE2',
            borderColor: '#5DADE2', 
            borderScaleFactor: 3,
            cornerColor: 'white',
            transparentCorners: false,
        };  

        $(document).ready(function() {  
            $("body").tooltip({ selector: '[data-bs-toggle=tooltip]' });
            Sortable.create(demo1, {  animation: 150, ghostClass: 'blue-background-class','handle':'.handle'});
            $('.select2').select2(); 
            createCanvas(); // intialize first canvas page  
            calculateZoom();

            // TO Append my Custom properties that added to object like ['id','naming'.. etc] when sending to backend 
            fabric.Object.prototype.toObject = (function (toObject) {
                return function (propertiesToInclude) {
                    return toObject.call(this, ['id','naming'].concat(propertiesToInclude));
                };
            })(fabric.Object.prototype.toObject);

            
            // if there user choose specifc template from homePage => render it on canvas area
            var template_id = {{ Js::from($template_id) }} 
            if(template_id && $('#template-'+template_id).length){
                add_as_template(template_id);
            } 
        });   
        
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
            $('.canvas-page').css('transform','scale(' + ((zoomPercentage) / 100)  + ')');
            $('.canvas-page').css('transform-origin','top');
            $('#zoom-precent').val(Math.round(zoomPercentage * 100) / 100);
            // console.log(zoomPercentage);
        }

        function calculateZoom() {
            var bodyw = $('body').width(); 
            var bodyh = $('body').height(); 
            var containerWidth = $('#page-container').width(); 
            var containerContent = $('#canvas-pages').width(); 
            zoomPercentage = (((containerWidth) / (canvasHeight + canvasWidth) ) * 100) + 10; 
            // console.log('bodyw: '+ bodyw);
            // console.log('bodyh: '+ bodyh);
            // console.log('page-container: '+containerWidth);
            // console.log('canvas-pages: '+containerContent);
            updateZoom();
        }

        window.onresize = calculateZoom;
    </script>  
    <script src="{{ asset('fabric/draw.js') }}"></script>
    <script src="{{ asset('fabric/listners.js') }}"></script>
    <script src="{{ asset('fabric/undo_redo.js') }}"></script>
    <script src="{{ asset('fabric/alignments.js') }}"></script>
    <script src="{{ asset('fabric/effects.js') }}"></script>
    <script src="{{ asset('fabric/custom_rotation.js') }}"></script> 
    <script src="{{ asset('fabric/crop_image.js') }}"></script>
    <script src="{{ asset('fabric/text_attributes.js') }}"></script> 
    <script src="{{ asset('fabric/element_functions.js') }}"></script>  

    {{-- scripts ajax to backend --}}
    <script>
        
        // save user uploaded image
        $("#form-upload-image").on("submit", function(ev) {
            ev.preventDefault(); 
            var formData = new FormData(this);
            $.LoadingOverlay("show");  
            $.ajax({
                url: '{{ route("frontend.upload_magico_images")}}',
                type: 'POST', 
                data: formData, 
                success: function(response) {   
                    if(response){
                        $.LoadingOverlay("hide"); 
                        showAlert('success', 'Image Uploaded Succussfully', '');
                        $(response).appendTo('#offcanvas-upload'); 
                    }else{
                        $.LoadingOverlay("hide"); 
                        showAlert('error', 'Not Auth Login Again', ''); 
                    }
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

        // save template
        $("#template-form").on("submit", function(ev) {
            ev.preventDefault(); 
            var formData = new FormData(this);
            $.LoadingOverlay("show"); 

            var pages = {}; 
            for(var i in canvasPages)
            {  
                var page = {};
                page['objects'] = canvasPages[i].getObjects(); 
                page['height'] = canvasPages[i].height;
                page['width'] = canvasPages[i].width;
                pages[i] = page; 
            }   
            formData.append('canvas_pages',JSON.stringify(pages));
            console.log(JSON.stringify(pages));
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

        // delete user uploaded image
        function delete_uploaded_image(id){
            let status = confirm('{{ trans('global.areYouSure') }}');
            if(status){
                $.ajax({
                    url: '{{ route("frontend.delete_upload_magico_images")}}',
                    type: 'POST', 
                    data: {
                        id:id,
                        _token: '{{ csrf_token() }}'
                    }, 
                    success: function(response) {    
                        showAlert('success', 'Image Deleted Succussfully', ''); 
                        $('#off-canvas-upload-' + id).hide('slow', function(){ $('#off-canvas-upload-' + id).remove(); });
                    },
                    error: function(err) { 
                        showAlert('error', 'Something Went Wrong', '');
                        console.log('Error' + err);
                    }
                }); 
            }
        } 
    </script>

    {{-- script loading images from outsources --}}
    <script> 

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
