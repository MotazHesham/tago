


function active_helper_buttons(object){    
    if(object){ 
        var group_buttons_half_width = 65;
        // scalling used for object that has expanding --- so we need to get that new height and width like this (object.width * object.scaleX)   
        var left = object.left + ((object.width * object.scaleX) / 2) - group_buttons_half_width; 
        if(object.top <= 90 ){  
            var top = object.top  + (-object.top) + 10 ; 
        }else{
            var top = object.top  - 90 ; 
        } 
        $('#active_helper_buttons').css({'display':'block','top':top + 'px','left':left + 'px'}) 
    }
} 

function inactive_helper_buttons(){  
    $('#active_helper_buttons').css('display','none');  
}

function getObjectById(id) {
    var objects = canvasPages[currentCanvasId].getObjects();
    for (var i = 0; i < objects.length; i++) { 
        if (objects[i].id == id) {
            return objects[i];
        }
    }
    return null; // Object with the specified ID not found
}

function check_object_type(selectedObject){
    if(selectedObject){
        console.log(selectedObject.type); 

        $('.image_attributes').css('display','none');
        $('.polygon_attributes').css('display','none');
        $('.path_attributes').css('display','none');
        $('.circle_attributes').css('display','none');
        $('.text_attributes').css('display','none');
        $('.rect_attributes').css('display','none');
        $('.group_attributes').css('display','none');

        if(selectedObject.type == 'i-text' || selectedObject.type == 'textbox' || selectedObject.type == 'text'){
            $('.text_attributes').css('display','inline');
        }else if(selectedObject.type == 'image'){
            $('.image_attributes').css('display','inline');
        }else if(selectedObject.type == 'polygon'){
            $('.polygon_attributes').css('display','inline');
        }else if(selectedObject.type == 'path'){
            $('.path_attributes').css('display','inline');
        }else if(selectedObject.type == 'circle'){
            $('.circle_attributes').css('display','inline'); 
        }else if(selectedObject.type == 'rect'){
            $('.rect_attributes').css('display','inline'); 
        }else if(selectedObject.type == 'group' || selectedObject.type == 'activeSelection'){
            $('.group_attributes').css('display','inline'); 
        }   
        assign_nav_values();
    }else{ 
        $('.rect_attributes').css('display','none');
        $('.image_attributes').css('display','none');
        $('.polygon_attributes').css('display','none');
        $('.path_attributes').css('display','none');
        $('.circle_attributes').css('display','none');
        $('.text_attributes').css('display','none'); 
        $('.group_attributes').css('display','none'); 
    }
} 

function assign_nav_values(){
    if(selectedObject){

        // lock
        if(!selectedObject.lockMovementX){
            $('#navitem-lock').removeClass('fa-lock');
            $('#navitem-lock').addClass('fa-lock-open'); 
        }else{
            $('#navitem-lock').removeClass('fa-lock-open');
            $('#navitem-lock').addClass('fa-lock'); 
        }

        // transperancy
        $('#transparency-span').html(selectedObject.opacity);
        $('#transparency-input').val(selectedObject.opacity);

        // Retrieve existing filters
        var existingFilters = selectedObject.filters || []; 
    
        var blur= 0, brightness= 0, gray_scale = 0, sepia = 0 ;
        existingFilters.filter(function(filter) { 
            // blur
            if(filter instanceof fabric.Image.filters.Blur){ 
                blur = filter.blur;
            } 
            // brightness
            if(filter instanceof fabric.Image.filters.Brightness){ 
                brightness = filter.brightness; 
            } 

            // gray scale
            if(filter instanceof fabric.Image.filters.Grayscale){
                gray_scale = true;
            }

            // sepia
            if(filter instanceof fabric.Image.filters.Sepia){
                sepia = true;
            }
        });


        if(blur){
            $('#blur-check').prop('checked', true);
            $('#blur-span').html(blur);
            $('#blur-input').val(blur);
            $('#blur-div').css('display','block');
        }else{ 
            $('#blur-check').prop('checked', false);
            $('#blur-span').html('');
            $('#blur-input').val(0);
            $('#blur-div').css('display','none');
        }
        if(brightness){
            $('#brightness-check').prop('checked', true);
            $('#brightness-span').html(brightness);
            $('#brightness-input').val(brightness);
            $('#brightness-div').css('display','block');
        }else{ 
            $('#brightness-check').prop('checked', false);
            $('#brightness-span').html('');
            $('#brightness-input').val(0);
            $('#brightness-div').css('display','none');
        }
        if(gray_scale){
            $('#gray-scale-check').prop('checked', true);
        }else{
            $('#gray-scale-check').prop('checked', false);
        }
        if(sepia){
            $('#sepia-check').prop('checked', true);
        }else{
            $('#sepia-check').prop('checked', false);
        }

        // border
        if(selectedObject.strokeWidth > 0){ 
            $('#border-check').prop('checked', true); 
            $('#border-input-color').val(selectedObject.stroke);
            $('#border-input-size').val(selectedObject.strokeWidth);
            $('#border-div').css('display','block');
        }else{
            $('#border-check').prop('checked', false); 
            $('#border-input-color').val('#000000');
            $('#border-input-size').val(0);
            $('#border-div').css('display','none');
        }

        // border radius  
        if(selectedObject.border_radius){
            $('#radius-check').prop('checked', true);
            $('#radius-span').html(selectedObject.border_radius);
            $('#radius-input').val(selectedObject.border_radius);
            $('#radius-div').css('display','block');
        }else{ 
            $('#radius-check').prop('checked', false);
            $('#radius-span').html('');
            $('#radius-input').val(1);
            $('#radius-div').css('display','none');
        }

        // shadow 
        if(selectedObject.shadow && (selectedObject.shadow.blur > 0 || selectedObject.shadow.offsetX > 0 || selectedObject.shadow.offsetY > 0)){ 
            $('#shadow-check').prop('checked', true);
            $('#shadow-blur-span').html(selectedObject.shadow.blur);
            $('#shadow-input-blur').val(selectedObject.shadow.blur);
            $('#shadow-offsetx-span').html(selectedObject.shadow.offsetX);
            $('#shadow-input-offsetx').val(selectedObject.shadow.offsetX);
            $('#shadow-offsety-span').html(selectedObject.shadow.offsetY);
            $('#shadow-input-offsety').val(selectedObject.shadow.offsetY);

            var hexa = rgbaToHexa(selectedObject.shadow.color)
            $('#shadow-input-color').val(hexa[0]);
            $('#shadow-input-opacity').val(hexa[1]);
            $('#shadow-opacity-span').html(hexa[1]); 
            $('#shadow-div').css('display','block');
        }else{
            $('#shadow-check').prop('checked', false);
            $('#shadow-blur-span').html('');
            $('#shadow-input-blur').val(0);
            $('#shadow-offsetx-span').html('');
            $('#shadow-input-offsetx').val(0);
            $('#shadow-offsety-span').html('');
            $('#shadow-input-offsety').val(0);
            $('#shadow-input-color').val('#000000');
            $('#shadow-opacity-span').html(''); 
            $('#shadow-input-opacity').val(1);
            $('#shadow-div').css('display','none');
        }  
    }
} 

function rgbaToHexa(rgbaColor) {
    // Parse RGBA values
    var rgbaValues = rgbaColor.match(/(\d+(\.\d+)?)/g) || [];
    var [r, g, b, a] = rgbaValues.map(parseFloat);

    // Convert RGB to HEX
    var hexColor = ((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1); 

    return ['#'+hexColor,a];
}

function selectCanvas(canvasObject, canvasId){ 
    if(canvasPages[currentCanvasId] != canvasObject){ 
        if(canvasPages[currentCanvasId]){
            canvasPages[currentCanvasId].discardActiveObject();
            canvasPages[currentCanvasId].requestRenderAll();
        } 
        currentCanvasId = canvasId ;  
        // console.log('page:');
        // console.log(canvasPages[currentCanvasId]);
        console.log('json:');
        console.log(canvasPages[currentCanvasId].getObjects());
        $('canvas').removeClass('canvas-border');
        $(canvasId).addClass('canvas-border');  
        $("#active_helper_buttons").detach().insertAfter(canvasId); 
        $("#page_buttons").detach().insertAfter(canvasId); 
        $('#page_buttons').css('display','block');
        $("#page_resize").detach().insertAfter(canvasId);
        $('#canvas_width').val(canvasPages[currentCanvasId].width);
        $('#canvas_height').val(canvasPages[currentCanvasId].height);
        inactive_helper_buttons(); 
        refresh_layers()
    }
}

function refresh_layers(){  
    var layers = canvasPages[currentCanvasId].getObjects(); 
    var html = '';
    for(var i = layers.length - 1 ; i >= 0 ; i--){  
        let id = layers[i].id ??  i + '' + (new Date()).getTime();
        let naming = layers[i].naming ??  i + '' + (new Date()).getTime();

        if(!layers[i].id){ 
            ((canvasPages[currentCanvasId]).item(i)).id = id;  
        }
        if(!layers[i].naming){ 
            ((canvasPages[currentCanvasId]).item(i)).naming = naming;  
        }

        if(layers[i].lockMovementX){
            var lockclass = 'fa-lock';
        }else{
            var lockclass = 'fa-lock-open';
        } 
        
        if(layers[i].visible){
            var visibleclass = 'fa-eye';
        }else{
            var visibleclass = 'fa-eye-slash';
        }
        var delete_button = '<button class="btn btn-custom btn-sm" onclick="delete_element(\''+id+'\')"><i class="fa-thin fa-trash-can-list" style="color:black"></i></button>';
        var lock_button = '<button class="btn btn-custom btn-sm" onclick="lock_element(\''+id+'\')"><i class="fa-thin '+lockclass+'" id="layer-lock-'+id+'" style="color:black"></i></button>';
        var duplicate_button = '<button class="btn btn-custom btn-sm" onclick="duplicate_element(\''+id+'\')"><i class="fa-thin fa-copy" style="color:black"></i></button>'; 
        var visible_button = '<button class="btn btn-custom btn-sm" onclick="visible_element(\''+id+'\')"><i class="fa-thin '+visibleclass+'" id="layer-eye-'+id+'" style="color:black"></i></button>'; 
        
        html += '<li class="list-group-item list-group-item-dark"  id="layer-'+id+'" data-id="'+id+'">';
        html += '<i class="fa-solid fa-grip-dots-vertical handle" style="color:black"></i>&nbsp;&nbsp;';
        html += '<span>'+naming+'</span>&nbsp;&nbsp;' + visible_button + duplicate_button + lock_button + delete_button +'</li>';  
    }  
    $('#offcanvas-layers ul').html(html);
}


function showAlert(type, title, message) {
    swal({
        title: title,
        text: message,
        type: type,
        showConfirmButton: 'Okay',
        timer: 3000
    });
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
        }else if(type == 'blur'){
            blur_element(false);
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

function active_layer_li(id){
    document.querySelectorAll('.list-group-item').forEach((list) => { 
        $(list).removeClass('list-group-item-success');
        $(list).addClass('list-group-item-dark');
    }); 
    if(id){
        $(id).removeClass('list-group-item-dark');
        $(id).addClass('list-group-item-success');
    }
} 

function canvas_resize(){
    canvasWidth = parseInt($('#canvas_width').val());
    canvasHeight  = parseInt($('#canvas_height').val());
    canvasPages[currentCanvasId].setWidth(canvasWidth);
    canvasPages[currentCanvasId].setHeight(canvasHeight);
}

function show_resize_buttons(){ 
    if ($("#page_resize").is(":hidden")) {
        $('#page_resize').css('display','flex'); 
    } else { 
        $('#page_resize').css('display','none');
    }
}

function add_text(text,font_size) {
    // Create a text object
    var text = new fabric.IText(text, {
        left: 50,
        top: 50,
        fontFamily: 'Arial',
        fontSize: font_size,
        fill: 'black',  
    }); 
    text.setControlVisible('tl',false);
    text.setControlVisible('bl',false);
    text.setControlVisible('tr',false);
    text.setControlVisible('br',false);
    text.setControlVisible('ml',false);
    text.setControlVisible('mb',false);
    text.setControlVisible('mr',false);
    text.setControlVisible('mt',false);
    text.id = 'text' + (new Date()).getTime();
    text.naming = 'text' + (new Date()).getTime();
    text.set(corner_options); 
    canvasPages[currentCanvasId].add(text); 
    canvasPages[currentCanvasId].renderAll(); 
    save_state();
    refresh_layers();
}

function add_text_box(id){
    var text_box = $('#' + id).html(); 
    // Create a Fabric.js Textbox
    var textbox = new fabric.Textbox(text_box, {
        left: 50,
        top: 50,
        width: 400, 
        fontSize:18,
        splitByGrapheme: true, 
    });
    textbox.set(corner_options); 
    textbox.setControlVisible('tl',false);
    textbox.setControlVisible('bl',false);
    textbox.setControlVisible('tr',false);
    textbox.setControlVisible('br',false);
    textbox.setControlVisible('mb',false);
    textbox.setControlVisible('mt',false);

    // Add the Textbox to the canvas
    canvasPages[currentCanvasId].add(textbox);
}

function add_as_template(id){ 
    // detach helpers fron canvas so when deleting the canvas helpers not deleteing
    $("#active_helper_buttons").detach().insertAfter('body'); 
    $('#active_helper_buttons').css('display','none');
    $("#page_buttons").detach().insertAfter('body'); 
    $('#page_buttons').css('display','none');
    $("#page_resize").detach().insertAfter('body');
    $('#page_resize').css('display','none');
    canvasPages = [];
    $('.canvas-page').remove();
    $.LoadingOverlay("show");  
    let pages = $('#template-'+id).data("src");   
    for (let index in pages) { 
        createCanvas(pages[index]['height'],pages[index]['width']);  
        var page = {
            "objects" : pages[index]['objects']
        }  
        canvasPages[currentCanvasId].loadFromJSON(JSON.stringify(page), function () {
            // Render canvas after loading JSON
            canvasPages[currentCanvasId].renderAll();
            $.LoadingOverlay("hide"); 
            refresh_layers();
        });
    }
    calculateZoom();
}

function clearCanvas(){ 
    canvasPages[currentCanvasId].clear();
    hoverdObject = null;
    selectedObject = null;
    clickedObject = null; 
}

function deleteCanvas(){
    if(Object.keys(canvasPages).length > 1){
        // detach helpers fron canvas so when deleting the canvas helpers not deleteing
        $("#active_helper_buttons").detach().insertAfter('body'); 
        $('#active_helper_buttons').css('display','none');
        $("#page_buttons").detach().insertAfter('body'); 
        $('#page_buttons').css('display','none');
        $("#page_resize").detach().insertAfter('body');
        $('#page_resize').css('display','none');

        delete canvasPages[currentCanvasId];
        $(currentCanvasId).closest(".canvas-page").remove();  
    }
}

function download_page(type){   
    if(type == 'png'){
        var dataURL    = canvasPages[currentCanvasId].toDataURL("image/png");
        const downloadLink = document.createElement('a');
        downloadLink.href = dataURL;
        downloadLink.download = 'canvas_image.png'; 
        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink); 
    }else if(type == 'jpg'){
        canvasPages[currentCanvasId].backgroundColor = '#fff';
        var dataURL    = canvasPages[currentCanvasId].toDataURL("image/jpg");
        const downloadLink = document.createElement('a');
        downloadLink.href = dataURL;
        downloadLink.download = 'canvas_image.jpg'; 
        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);
        canvasPages[currentCanvasId].backgroundColor = '#fff0';
    }else{
        return ;
    }
}