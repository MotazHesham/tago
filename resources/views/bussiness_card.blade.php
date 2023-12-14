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
        
        #active_helper_buttons i{
            color: black
        }

    </style>
</head>

<body>
    <div style="display: flex">
        <div class="bg-light sticky-top" style="background: #383e47 !important;border: 1px solid grey;">
            <div class="d-flex flex-sm-column flex-row flex-nowrap bg-light align-items-center sticky-top"
                style="background: #383e47 !important">
                <a href="/" class="d-block p-3 link-dark text-decoration-none" title=""
                    data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Icon-only">
                    <i class="bi-bootstrap fs-1"></i>
                </a>
                <ul
                    class="nav nav-pills nav-flush flex-sm-column flex-row flex-nowrap mb-auto mx-auto text-center align-items-center">
                    <li class="nav-item">
                        <a href="#" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip"
                            data-bs-placement="right" data-bs-original-title="Home">
                            <i class="fa-solid fa-object-group"></i>
                            <br>
                            <small>Templates</small>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip"
                            data-bs-placement="right" data-bs-original-title="Dashboard">
                            <i class="fa-solid fa-square-pen"></i>
                            <br>
                            <span>Text</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip"
                            data-bs-placement="right" data-bs-original-title="Orders">
                            <i class="fa-solid fa-image"></i>
                            <br>
                            <span>Images</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip"
                            data-bs-placement="right" data-bs-original-title="Products">
                            <i class="fa-solid fa-shapes"></i>
                            <br>
                            <span>Shapes</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip"
                            data-bs-placement="right" data-bs-original-title="Customers">
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                            <br>
                            <span>Upload</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip"
                            data-bs-placement="right" data-bs-original-title="Customers">
                            <i class="fa-solid fa-layer-group"></i>
                            <br>
                            <span>Layers</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip"
                            data-bs-placement="right" data-bs-original-title="Customers">
                            <i class="fa-solid fa-minimize"></i>
                            <br>
                            <span>Resize</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="min-vh-100" style="background:#383e47;border: 1px solid grey">
            <div class="row">
                <div class="col-md-3">
                    <div class="min-vh-100">
                        <div class="container-scrollable">
                            <div style="display: flex;flex-wrap:wrap;justify-content: space-between;">
                                {{-- <div>
                                    <img src="{{ asset('tmp_images/1.jpeg') }}" data-src="{{ asset('tmp_images/1.jpeg') }}" alt="">
                                </div> --}}
                                @foreach (json_decode($photos) as $photos)
                                    <div>
                                        <img src="{{ $photos->urls->thumb }}" alt="" data-src="{{ $photos->urls->regular }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9" style="background: #e7e7e7;padding:0">

                    <div style="display:flex;justify-content:space-between;background: #383e47 !important;border: 1px solid grey;color:white;padding:10px">
                        <div style="display: flex">
                            <div>
                                <button id="redo" disabled>redo</button>
                                <button id="undo">undo</button>
                            </div>
                            <div>
                                <span onclick="add_text()">add text</span>
                                <div id="text_attributes" style="display: none">
                                    <input style="display: inline;width:50px" type="number" min="1"  onkeyup="text_size(this)">
                                    <input style="display: inline;" type="color" oninput="text_color(this)">
                                    <span onclick="toggleBold()"><i class="fa-solid fa-bold"></i></span>
                                    <span onclick="toggleItalic()"><i class="fa-solid fa-italic"></i></span>
                                    <span onclick="toggleUnderline()"><i class="fa-sharp fa-regular fa-underline"></i></span> 
                                    <input style="display: inline;width:50px" type="number" title="setLineHeight" onkeyup="setLineHeight(this)" onchange="setLineHeight(this)">
                                    <input style="display: inline;width:50px" type="number" title="setLetterSpacing" onkeyup="setLetterSpacing(this)" onchange="setLetterSpacing(this)">
                                    <input style="display: inline;width:50px" type="number" title="setStroke" onkeyup="setStroke(this)" onchange="setStroke(this)">
                                    <input style="display: inline;width:80px" type="color" oninput="setBackground(this)"> 
                                    <select name="" id="" style="display: inline;" onchange="setFontFamily(this)">
                                        <option value="Arial">Arial</option>
                                        <option value="Helvetica">Helvetica</option>
                                        <option value="Times New Roman">Times New Roman</option>
                                        <option value="Courier New">Courier New</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Verdana">Verdana</option>
                                        <option value="Impact">Impact</option>
                                        <option value="Comic Sans MS">Comic Sans MS</option>
                                        <option value="Trebuchet MS">Trebuchet MS</option> 
                                    </select>
                                    <select name="" id="" style="display: inline:80px" onchange="setAlignText(this)">
                                        <option value="left">left</option> 
                                        <option value="right">right</option> 
                                        <option value="center">center</option>  
                                    </select>
                                </div>
                                <div id="image_attributes"> 
                                    <span onclick="cropActiveObject()" title="cropActiveObject"><i
                                            class="fa-solid fa-crop"></i></span>
                                    <span onclick="flipHorizontal()" title="flipHorizontal"><i
                                            class="fa-solid fa-arrows-up-down"></i></span>
                                    <span onclick="flipVertical()" title="flipVertical"><i
                                            class="fa-solid fa-arrows-left-right"></i></span>
                                    <span onclick="fit_page_element()" title="fit_page"><i
                                            class="fa-solid fa-expand"></i></span> 
                                    <span onclick="border_element()" title="border"><i
                                            class="fa-solid fa-border-top-left"></i></span>
                                    <span onclick="set_shadow_element()" title="shadow"><i
                                            class="fa-solid fa-ghost"></i></span>
                                    <span onclick="remove_grey_scale_element()" title="remove grey scale"><i
                                            class="fa-solid fa-brain"></i></span>
                                    <span onclick="grey_scale_element()" title="grey scale"><i
                                            class="fa-solid fa-spray-can-sparkles"></i></span>
                                </div>
                            </div>
                        </div>
                        <div style="display: flex">
                            <div> {{-- icons  --}}
                                <div class="dropdown" style="display: inline">
                                    <button type="button" class="btn btn-secondary btn-sm " data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                                        <i class="fa-duotone fa-droplet"></i>
                                    </button>
                                    <form class="dropdown-menu p-2">
                                        <input type="range" class="form-range" id="customRange" min="0.01" step="0.01" max="1.00" oninput="transperancy_element(this)">
                                    </form>
                                </div>
    
                                <span onclick="lock_element()" title="Duplicate"><i class="fa-solid fa-lock"></i></span>
                                <span onclick="duplicate_element()" title="Duplicate"><i
                                        class="fa-regular fa-copy"></i></span>
                                <span onclick="delete_element()" title="Delete"><i class="fa-solid fa-trash"></i></span> 
                                <div class="dropdown" style="display: inline">
                                    <button type="button" class="btn btn-secondary btn-sm " data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                                        Positions <i class="fa-solid fa-square"></i>
                                    </button>
                                    <form class="dropdown-menu p-2">
                                        <span onclick="alignCenter()" title="alignCenter"><i
                                                class="fa-solid fa-objects-align-center-vertical"></i></span>
                                        <span onclick="alignMiddle()" title="alignMiddle"><i
                                                class="fa-solid fa-distribute-spacing-vertical"></i></span>
                                        <span onclick="alignBottom()" title="alignBottom"><i
                                                class="fa-solid fa-objects-align-bottom"></i></span>
                                        <span onclick="alignLeft()" title="alignLeft"><i
                                                class="fa-solid fa-objects-align-left"></i></span>
                                        <span onclick="alignRight()" title="alignRight"><i
                                                class="fa-solid fa-objects-align-right"></i></span>
                                        <span onclick="alignTop()" title="alignTop"><i
                                                class="fa-solid fa-objects-align-top"></i></span>
                                        <span onclick="sendBackward()" title="sendBackward"><i
                                                class="fa-solid fa-backward"></i></span>
                                        <span onclick="sendToBack()" title="sendToBack"><i
                                                class="fa-solid fa-backward-fast"></i></span>
                                        <span onclick="bringForward()" title="bringForward"><i
                                                class="fa-solid fa-forward"></i></span>
                                        <span onclick="bringToFront()" title="bringToFront"><i
                                                class="fa-solid fa-forward-fast"></i></span>
                                    </form>
                                </div>
                            </div>
                            <div> {{-- download and others  --}}

                            </div>
                            <div class="dropdown" style="display: inline">
                                <button type="button" class="btn btn-secondary btn-sm " data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                                    <i class="fa-solid fa-square"></i>
                                </button>
                                <form class="dropdown-menu p-2">
                                    <input type="range" class="form-range" id="customRange" min="1" step="1" max="300" oninput="border_radius_element(this)">
                                </form>
                            </div>
                            <div class="dropdown" style="display: inline">
                                <button type="button" class="btn btn-secondary btn-sm " data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                                    <i class="fa-solid fa-fire-flame-curved"></i>
                                </button>
                                <form class="dropdown-menu p-2">
                                    <input type="range" class="form-range" id="customRange" min="-1.00" step="0.01" max="1.00" oninput="blur_element(this)">
                                </form>
                            </div>
                        </div>
                    </div> 
                    <div style="background:white;width: fit-content;margin:auto;position: relative;" class="mt-5">
                        <canvas id="canvas" width="1200px" height="628px" >
                        </canvas>
                        <div id="active_helper_buttons" class="btn-group btn-group-sm" role="group" aria-label="Basic mixed styles example" style="position: absolute;display:none;border: 1px solid #c9b8b8;
                        background: #e9e9e9;">
                            <button type="button" class="btn btn-light  btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Duplicate" onclick="duplicate_element()"><i class="fa-regular fa-copy"></i></button>
                            <button type="button" class="btn btn-light  btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Remove" onclick="delete_element()"><i class="fa-regular fa-trash"></i></button> 
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-light btn-sm" data-bs-toggle="dropdown"  aria-expanded="false">
                                    <i class="fa-regular fa-ellipsis" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="More"></i>
                                </button>
                                <ul class="dropdown-menu" style="padding: 6px;width:215px"> 
                                    <li><a class="dropdown-item" href="#" onclick="duplicate_element()"><div><i class="fa-regular fa-copy"></i> <b>Duplicate</b></div> <span class="badge text-bg-light">Ctrl+D</span></a></li> 
                                    <li><a class="dropdown-item" href="#" onclick="delete_element()"><div><i class="fa-regular fa-trash"></i> <b>Delete</b></div> <span class="badge text-bg-light">DELETE</span></a></li> 
                                    <li><a class="dropdown-item" href="#" onclick="lock_element()"><div><i class="fa-regular fa-lock-open"></i> <b>Lock</b></div> <span></span></a></li> 
                                    <div class="dropdown-divider"></div>
                                    <li class="dropdown-submenu">
                                        <a class="test" tabindex="-1" href="#"><div><i class="fa-regular fa-objects-align-left"></i> <b>Align</b></div> <i class="fa-regular fa-chevron-right"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><a tabindex="-1" href="#" onclick="alignLeft()"><i class="fa-regular fa-objects-align-left"></i> <b>Left</b></a></li>
                                            <li><a tabindex="-1" href="#" onclick="alignCenter()"><i class="fa-regular fa-objects-align-center-horizontal"></i> <b>Center</b></a></li> 
                                            <li><a tabindex="-1" href="#" onclick="alignRight()"><i class="fa-regular fa-objects-align-right"></i> <b>Right</b></a></li> 
                                            <li><a tabindex="-1" href="#" onclick="alignTop()"><i class="fa-regular fa-objects-align-top"></i> <b>Top</b></a></li> 
                                            <li><a tabindex="-1" href="#" onclick="alignMiddle()"><i class="fa-regular fa-distribute-spacing-vertical"></i> <b>Middle</b></a></li> 
                                            <li><a tabindex="-1" href="#" onclick="alignBottom()" ><i class="fa-regular fa-objects-align-bottom"></i> <b>Bottom</b></a></li> 
                                        </ul>
                                    </li> 
                                    <li class="dropdown-submenu">
                                        <a class="test" tabindex="-1" href="#"><div><i class="fa-regular fa-layer-group"></i> <b>Layer</b></div> <i class="fa-regular fa-chevron-right"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><a tabindex="-1" href="#" onclick="bringForward()"><i class="fa-regular fa-bring-forward"></i> <b>Bring forward</b></a></li>
                                            <li><a tabindex="-1" href="#" onclick="bringToFront()"><i class="fa-regular fa-bring-front"></i> <b>Bring to front</b></a></li> 
                                            <li><a tabindex="-1" href="#" onclick="sendBackward()"><i class="fa-regular fa-send-back"></i> <b>Send backward</b></a></li> 
                                            <li><a tabindex="-1" href="#" onclick="sendToBack()" ><i class="fa-regular fa-send-backward"></i> <b>Send to back</b></a></li> 
                                        </ul>
                                    </li> 
                                    <li class="dropdown-submenu">
                                        <a class="test" tabindex="-1" href="#"><div><i class="fa-regular fa-regular fa-reflect-horizontal"></i> <b>Flip</b></div> <i class="fa-regular fa-chevron-right"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><a tabindex="-1" href="#" onclick="flipHorizontal()"><i class="fa-regular fa-left-right"></i> <b>Flip Horizontal</b></a></li>
                                            <li><a tabindex="-1" href="#" onclick="flipVertical()"><i class="fa-regular fa-up-down"></i> <b>Flip Vertical</b></a></li>  
                                        </ul>
                                    </li> 
                                </ul>
                            </div>
                        </div> 
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
    <script src="{{ asset('fabric/context.js') }}"></script>
    <script src="{{ asset('fabric/initialize_context.js') }}"></script>
    <script src="{{ asset('fabric/fabric.min.js') }}"></script>
    <script>
        var fabricCanvasObj = new fabric.Canvas('canvas', {
            preserveObjectStacking: true,
            skipTargetFind: false,
        });
            
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
    </script>
    <script src="{{ asset('fabric/undo_redo.js') }}"></script>
    <script src="{{ asset('fabric/alignments.js') }}"></script>
    <script src="{{ asset('fabric/effects.js') }}"></script>
    <script src="{{ asset('fabric/custom_rotation.js') }}"></script>
    <script src="{{ asset('fabric/object_listners.js') }}"></script>
    <script src="{{ asset('fabric/crop_image.js') }}"></script>
    <script src="{{ asset('fabric/text_attributes.js') }}"></script>
    <script src="{{ asset('fabric/helpers.js') }}"></script>
    <script>
        
        $(document).ready(function() {
            $("body").tooltip({ selector: '[data-bs-toggle=tooltip]' });
        });   

        $('body').on('click', 'img', function(e) {
            var fabric_image = new fabric.Image.fromURL(e.target.getAttribute('data-src'), function(image) { 
                image.scaleToHeight(300);
                image.scaleToWidth(180);
                image.set(corner_options); 
                fabricCanvasObj.centerObject(image);
                fabricCanvasObj.add(image);
                save_state();
            }); 
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
