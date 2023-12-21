
$(document).ready(function() { 
    // ------------- Scrolling wheels horizontally ------------
    var iconscoutOffCanvas = document.getElementById("offcanvas-iconscout"); 
    iconscoutOffCanvas.addEventListener("wheel", function (e) {
        if (e.deltaY > 0) iconscoutOffCanvas.scrollLeft += 100;
        else iconscoutOffCanvas.scrollLeft -= 100; 
    });

    var templatesOffCanvas = document.getElementById("offcanvas-templates"); 
    templatesOffCanvas.addEventListener("wheel", function (e) {
        if (e.deltaY > 0) templatesOffCanvas.scrollLeft += 100;
        else templatesOffCanvas.scrollLeft -= 100; 
    });

    var uploadOffCanvas = document.getElementById("offcanvas-upload"); 
    uploadOffCanvas.addEventListener("wheel", function (e) {
        if (e.deltaY > 0) uploadOffCanvas.scrollLeft += 100;
        else uploadOffCanvas.scrollLeft -= 100; 
    });

    var pixabayOffCanvas = document.getElementById("offcanvas-pixabay"); 
    pixabayOffCanvas.addEventListener("wheel", function (e) {
        if (e.deltaY > 0) pixabayOffCanvas.scrollLeft += 100;
        else pixabayOffCanvas.scrollLeft -= 100; 
    });

    var unsplashOffCanvas = document.getElementById("offcanvas-unsplash"); 
    unsplashOffCanvas.addEventListener("wheel", function (e) {
        if (e.deltaY > 0) unsplashOffCanvas.scrollLeft += 100;
        else unsplashOffCanvas.scrollLeft -= 100; 
    });

    var textOffCanvas = document.getElementById("offcanvas-text"); 
    textOffCanvas.addEventListener("wheel", function (e) {
        if (e.deltaY > 0) textOffCanvas.scrollLeft += 100;
        else textOffCanvas.scrollLeft -= 100;
    });

    var shapesOffCanvas = document.getElementById("offcanvas-shapes"); 
    shapesOffCanvas.addEventListener("wheel", function (e) {
        if (e.deltaY > 0) shapesOffCanvas.scrollLeft += 100;
        else shapesOffCanvas.scrollLeft -= 100;
    });
    // ------------------------------------------------------------

    // Trigger clicks on templates 
    // Trigger images objects
    $('body').on('click', '.add-to-canvas', function(e) { 
        let img_url = e.target.getAttribute("data-src"); 
        let img_type = e.target.getAttribute("data-type"); 
        if(img_url.search('.svg') < 0){ 
            $('#image-spinner').detach().appendTo('#' + e.target.getAttribute('data-id'));
            $('#image-spinner').css('display','block');
            $('#' + e.target.getAttribute('data-id') +' div').css('display','block');
            fabric.Image.fromURL(img_url, function(image) {  
                image.set(corner_options); 
                if(img_type == 'icons'){
                    image.scaleToHeight(50);
                    image.scaleToWidth(50);
                    image.set({
                        transparentCorners: true,
                        cornerSize: 6,
                    }); 
                }else{
                    image.scaleToHeight(400);
                    image.scaleToWidth(280);
                }
                image.extension = 'image';
                image.id = 'image' + (new Date()).getTime();
                image.naming = 'image' + (new Date()).getTime();
                canvasPages[currentCanvasId].centerObject(image);
                canvasPages[currentCanvasId].add(image);
                refresh_layers();
                save_state();
                $('#image-spinner').css('display','none');
                $('#' + e.target.getAttribute('data-id') +' div').css('display','none');
            }, {crossOrigin: 'anonymous'}); 
        }else{
            fabric.loadSVGFromURL(img_url, function(objects, options) { 
                var svgObject = fabric.util.groupSVGElements(objects, options);
                // Add the SVG object to the canvas
                svgObject.set(corner_options); 
                svgObject.scaleToHeight(400);
                svgObject.scaleToWidth(280);
                svgObject.extension = 'svg';
                svgObject.id = 'svg' + (new Date()).getTime();
                svgObject.naming = 'svg' + (new Date()).getTime();
                canvasPages[currentCanvasId].centerObject(svgObject);
                canvasPages[currentCanvasId].add(svgObject);

                // Render the canvas
                canvasPages[currentCanvasId].renderAll();
                refresh_layers();
                save_state();  
            }, null, { crossOrigin: 'anonymous'}); 
        }
    });  

    // Trigger clicking outside canvas to discardActiveObject
    $('#page-container').on('click', function(e) { 
        // Iterate through each canvas container 
        var canvasContainers = $('.canvas-container'); 
        // Check if the clicked element is not within the canvas container
        if (!canvasContainers.is(e.target) && canvasContainers.has(e.target).length === 0) {
            // Deselect all objects
            if(canvasPages[currentCanvasId]){
                canvasPages[currentCanvasId].discardActiveObject();
                canvasPages[currentCanvasId].requestRenderAll();
                active_layer_li(false);
            }
        }
    });

    // 
    // ------- View photo_by data ---------- 
    $(document).on('mouseenter','.off-canvas-images',function(){ 
        var secondElement = $(this).children(":eq(1)");
        secondElement.css('opacity',1); 
    });
    $(document).on('mouseleave','.off-canvas-images',function(){ 
        var secondElement = $(this).children(":eq(1)");
        secondElement.css('opacity',0); 
    }); 
    // --------------------------------------- 

    
    // ------- Edit layer naming ---------- 
        $(document).on('click','.list-group-item span',function(){ 

            // Get the text content of the clicked <span>
            var spanText = $(this).text();

            // Replace the <span> with an input field
            var inputField = $('<input type="text" class="editInput form-control" style="display:inline;width: 200px;">').val(spanText);
            $(this).replaceWith(inputField);
            
            // Focus on the input field
            inputField.focus();
        });

        // Blur event on the input field
        $(document).on('blur', '.editInput', function() {
            // Get the input value
            var inputValue = $(this).val();

            // Get object id to change actual name  
            var objectId = $(this).parent().data('id');
            var object = getObjectById(objectId);    
            object.naming = inputValue;

            // Replace the input field with a new <span> containing the input value
            var newSpan = $('<span>').text(inputValue);
            $(this).replaceWith(newSpan);
        });

        // Keydown event on the input field
        $(document).on('keydown', '.editInput', function(e) {
            // Check if the Enter key is pressed
            if (e.which === 13) {
            // Trigger the blur event to handle the replacement
                $(this).blur();
            }
        });
    // -------------------------------------

    
    // ------------ Change layer positions -----------------
    $(document).on('dragleave','.list-group-item',function(){  
        var i = 0;
        document.querySelectorAll('.list-group-item').forEach((list) => { 
            var id = list.getAttribute('data-id'); 
            var object = getObjectById(id);    
            if(i == 0){
                canvasPages[currentCanvasId].bringToFront(object);
                canvasPages[currentCanvasId].renderAll();
            }else{
                canvasPages[currentCanvasId].sendBackwards(object);
                canvasPages[currentCanvasId].renderAll();
            } 
            i++;
        }); 
    })
    $(document).on('click','.list-group-item',function(e){     
        active_layer_li('#' + $(this).attr('id'));  
        var id = $(this).attr('data-id'); 
        var objectToActivate = getObjectById(id);    
        if(objectToActivate){
            selectedObject = objectToActivate; 
            canvasPages[currentCanvasId].setActiveObject(objectToActivate);
            canvasPages[currentCanvasId].renderAll();  
        }
    })
    // -----------------------------------------------------------
});