<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bussiness Card</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-thin.css">

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css">

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css">

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('fabric/context.standalone.css')}}">
    <style>
        i {
            font-size: 25px;
            color: white
        }

        img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            overflow: hidden;
        }

        span,
        small {
            color: white
        }

        nav a {
            color: white !important
        }

        body{
            overflow: hidden;
        }

        .container-scrollable {
            height: 100vh;
            overflow-y: scroll;
            overflow-x: hidden;
        }

        .container-scrollable::-webkit-scrollbar {
            width: 5px;
        }

        .container-scrollable::-webkit-scrollbar-track {
            background: rgba(184, 34, 34, 0);
            border-radius: 10px;
        }

        .container-scrollable::-webkit-scrollbar-thumb {
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.8);
        }

        .container-scrollable::-webkit-scrollbar-thumb:hover {
            background: black;
        }
        .container-scrollable-y { 
            overflow-x: scroll;
            overflow-y: hidden;
        }

        .container-scrollable-y::-webkit-scrollbar {
            height: 4px;
        }

        .container-scrollable-y::-webkit-scrollbar-track {
            background: rgba(184, 34, 34, 0);
            border-radius: 10px;
        }

        .container-scrollable-y::-webkit-scrollbar-thumb {
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.8);
        }

        .container-scrollable-y::-webkit-scrollbar-thumb:hover {
            background: black;
        }
        
        .active_helper_buttons{    
            position: absolute;
            display: none;
            border: 1px solid #c9b8b8;
            background: #ffffff;
            z-index: 1;
            box-shadow: 1px 1px 3px 1px gray;
        }
        .active_helper_buttons i{
            color: black
        }
        #page_buttons{
            position: absolute;
            display:none;  
            z-index:1;
            right: 0;
            top: -40px
        }
        #page_buttons i{
            color: black
        }

        .canvas-border{
            border: #00bbff 2px solid;
        }
        .canvas-page{
            background:white;
            width: fit-content;
            margin:auto;
            position: relative;
        }  
        #image_attributes div{
            padding: 0 6px;
        } 
        #image_attributes div span{
            text-decoration: none;
        }

        .btn-custom:hover{
            background: #597b80 !important;
        }
        .btn-custom:hover i{ 
            color:white !important
        }
        .btn-custom:disabled{
            border:none;
        }
        #dropdown-effects div{
            padding:6px
        }

        .common-background{     
            background: linear-gradient(128deg, rgb(40 43 46) 0%, rgb(104 148 155 / 99%) 100%);
        } 
    </style>
    @section('styles')
</head>

<body> 

    @include('offCanvas')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-auto bg-light sticky-top common-background" style=" ;border: 1px solid grey;">
                @include('side_menu')
            </div>
            <div class="col-sm min-vh-100 " style=" ;border: 1px solid grey;padding:0">  
                <div class="container-scrollable" style="background: #e7e7e7;padding:0;position:relative">
                    @include('nav_items')
                    <div id="page-container" style="margin: 6rem">
                        {{-- canvas pages --}}
                    </div> 
                    <div id="active_helper_buttons" class="btn-group btn-group-sm active_helper_buttons" role="group" >
                        @include('objectButtons')
                    </div>  
                    <div id="page_buttons" class="btn-group btn-group-sm"  role="group" >
                        @include('pageButtons')
                    </div>  
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script src="{{ asset('fabric/context.js') }}"></script>
    <script src="{{ asset('fabric/initialize_context.js') }}"></script>
    <script src="{{ asset('fabric/fabric.min.js') }}"></script>
    <script src="{{ asset('fabric/helpers.js') }}"></script>
    <script src="{{ asset('fabric/create_canvas.js') }}"></script>
    <script> 
        var item = document.getElementById("offcanvas-body");

        item.addEventListener("wheel", function (e) {
            if (e.deltaY > 0) item.scrollLeft += 100;
            else item.scrollLeft -= 100;
        });
        $(document).ready(function() { 
            $('.select2').select2()
            $("body").tooltip({ selector: '[data-bs-toggle=tooltip]' });
        });   

        var fabricCanvasObj = null;     
        var selectedObject = null;
        var isCrop = false;   
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

        createCanvas();
    </script>
    <script src="{{ asset('fabric/undo_redo.js') }}"></script>
    <script src="{{ asset('fabric/alignments.js') }}"></script>
    <script src="{{ asset('fabric/effects.js') }}"></script>
    <script src="{{ asset('fabric/custom_rotation.js') }}"></script>
    {{-- <script src="{{ asset('fabric/object_listners.js') }}"></script> --}}
    <script src="{{ asset('fabric/crop_image.js') }}"></script>
    <script src="{{ asset('fabric/text_attributes.js') }}"></script>
    <script>
        
        function download(){ 
            var dataURL    = fabricCanvasObj.toDataURL("image/png");
            const downloadLink = document.createElement('a');
            downloadLink.href = dataURL;
            downloadLink.download = 'canvas_image.png'; 
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
        }

        function checkbox_activation(e,targetId,type){
            if(e.checked){
                $('#' + targetId).css('display','block'); 
                if(type == 'gray-scale'){
                    gray_scale_element();
                }else if (type == 'sepia'){
                    sepia_element(true);
                }
            }else{
                $('#' + targetId).css('display','none'); 
                if(type == 'brightness'){
                    brightness_element(false);
                }else if(type == 'radius'){
                    radius_element(false);
                }else if(type == 'gray-scale'){
                    remove_gray_scale_element();
                }else if (type == 'border'){
                    border_element(false);
                }else if (type == 'sepia'){
                    sepia_element(false);
                }else if (type == 'shadow'){
                    shadow_element(false);
                }
            }
        }

        $('body').on('click', 'img', function(e) { 
            $('#image-spinner').detach().appendTo('#' + e.target.getAttribute('data-id'));
            $('#image-spinner').css('display','block');
            $('#' + e.target.getAttribute('data-id') +' div').css('display','block');
            var fabric_image = new fabric.Image.fromURL(e.target.getAttribute('data-src'), function(image) { 
                image.scaleToHeight(400);
                image.scaleToWidth(280);
                image.set(corner_options); 
                fabricCanvasObj.centerObject(image);
                fabricCanvasObj.add(image);
                save_state();
                $('#image-spinner').css('display','none');
                $('#' + e.target.getAttribute('data-id') +' div').css('display','none');
            }, {crossOrigin: 'anonymous'}); 
        }); 

        function add_text() {
            // Create a text object
            var text = new fabric.IText('Hello, Fabric.js!', {
                left: 50,
                top: 50,
                fontFamily: 'Arial',
                fontSize: 50,
                fill: 'black',
            }); 
            text.set(corner_options); 
            fabricCanvasObj.add(text); 
            fabricCanvasObj.renderAll(); 
            save_state();
        }

        function lock_element() {
            var activeObject = fabricCanvasObj.getActiveObject();
            if (activeObject) {
                activeObject.lockMovementX = !activeObject.lockMovementX;
                activeObject.lockMovementY = !activeObject.lockMovementY;
                fabricCanvasObj.renderAll(); 
                save_state();
            } 
        }

        function duplicate_element() {
            var activeObject = fabricCanvasObj.getActiveObject();
            if (activeObject) {
                var clone = fabric.util.object.clone(activeObject);

                // Offset the clone to prevent overlapping with the original object
                clone.set({
                    left: activeObject.left + 15,
                    top: activeObject.top + 15
                });

                fabricCanvasObj.add(clone);
                fabricCanvasObj.setActiveObject(clone);
                fabricCanvasObj.renderAll();
                save_state();
            } 
        }

        function delete_element() {
            var activeObject = fabricCanvasObj.getActiveObject();
            if (activeObject) {
                fabricCanvasObj.remove(activeObject);
                save_state();
                check_object_type(false);
            } 
        }

    </script>
</body>

</html>
