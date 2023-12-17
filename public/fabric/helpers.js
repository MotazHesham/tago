


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
    var objects = fabricCanvasObj.getObjects();
    for (var i = 0; i < objects.length; i++) {
        if (objects[i].id === id) {
            return objects[i];
        }
    }
    return null; // Object with the specified ID not found
}

function check_object_type(selectedObject){
    if(selectedObject){
        console.log(selectedObject.type);
        if(selectedObject.type === 'i-text'){
            $('.text_attributes').css('display','block');  
            $('#text_attributes').css('display','flex');  
            $('.image_attributes').css('display','none'); 
            $('#effect_attributes').detach().appendTo('#text_attributes'); 
            $('#effect_attributes').css('display','inline');
        }else if(selectedObject.type === 'image' || selectedObject.extension === 'svg'){ 
            $('.text_attributes').css('display','none'); 
            $('.image_attributes').css('display','block');   
            $('#effect_attributes').detach().appendTo('#image_attributes'); 
            $('#effect_attributes').css('display','inline');
        }else{ 
            $('.image_attributes').css('display','none'); 
            $('.text_attributes').css('display','none');
            $('#effect_attributes').css('display','none');
        }
        nav_buttons(true)
    }else{ 
        $('.text_attributes').css('display','none');
        $('.image_attributes').css('display','none'); 
        $('#effect_attributes').css('display','none');
        nav_buttons(false)
    }
} 

function nav_buttons(status){
    if(status){
        $('#nav-positions').prop('disabled',false);  
        $('#nav-transparency').prop('disabled',false);  
        $('#nav-lock').prop('disabled',false);  
        $('#nav-duplicate').prop('disabled',false);  
        $('#nav-delete').prop('disabled',false);  
    }else{
        $('#nav-positions').prop('disabled',true);  
        $('#nav-transparency').prop('disabled',true);  
        $('#nav-lock').prop('disabled',true);  
        $('#nav-duplicate').prop('disabled',true);  
        $('#nav-delete').prop('disabled',true);  
    }
}

function selectCanvas(canvasObject, canvasId){ 
    if(fabricCanvasObj != canvasObject){ 
        if(fabricCanvasObj){
            fabricCanvasObj.discardActiveObject();
            fabricCanvasObj.requestRenderAll();
        }
        fabricCanvasObj = canvasObject ;  
        currentCanvasId = canvasId ;  
        $('canvas').removeClass('canvas-border');
        $(canvasId).addClass('canvas-border');  
        $("#active_helper_buttons").detach().insertAfter(canvasId); 
        $("#page_buttons").detach().insertAfter(canvasId); 
        $('#page_buttons').css('display','block');
        inactive_helper_buttons(); 
        refresh_layers()
    }
}

function refresh_layers(){ 
    var layers = fabricCanvasObj.getObjects(); 
    var html = '';
    for(var i = layers.length - 1 ; i >= 0 ; i--){  

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
        var delete_button = '<button class="btn btn-custom btn-sm" onclick="delete_element(\''+layers[i].id+'\')"><i class="fa-thin fa-trash-can-list" style="color:black"></i></button>';
        var lock_button = '<button class="btn btn-custom btn-sm" onclick="lock_element(\''+layers[i].id+'\')"><i class="fa-thin '+lockclass+'" id="layer-lock-'+layers[i].id+'" style="color:black"></i></button>';
        var duplicate_button = '<button class="btn btn-custom btn-sm" onclick="duplicate_element(\''+layers[i].id+'\')"><i class="fa-thin fa-copy" style="color:black"></i></button>'; 
        var visible_button = '<button class="btn btn-custom btn-sm" onclick="visible_element(\''+layers[i].id+'\')"><i class="fa-thin '+visibleclass+'" id="layer-eye-'+layers[i].id+'" style="color:black"></i></button>'; 
        
        html += '<li class="list-group-item list-group-item-dark"  id="layer-'+layers[i].id+'" data-id="'+layers[i].id+'">';
        html += '<i class="fa-solid fa-grip-dots-vertical handle" style="color:black"></i>&nbsp;&nbsp;';
        html += '<span>'+layers[i].naming+'</span>&nbsp;&nbsp;' + visible_button + duplicate_button + lock_button + delete_button +'</li>'; 
    } 
    $('#offcanvas-layers ul').html(html);
}


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


        


function add_text() {
    // Create a text object
    var text = new fabric.IText('Hello, Fabric.js!', {
        left: 50,
        top: 50,
        fontFamily: 'Arial',
        fontSize: 50,
        fill: 'black',
    }); 
    text.id = 'text' + (new Date()).getTime();
    text.naming = 'text' + (new Date()).getTime();
    text.set(corner_options); 
    fabricCanvasObj.add(text); 
    fabricCanvasObj.renderAll(); 
    save_state();
    refresh_layers();
}

function lock_element(id = false) {
    if(id){
        var objectTolock = getObjectById(id);
    }else{
        var objectTolock = fabricCanvasObj.getActiveObject();
    }
    if (objectTolock) {
        if(objectTolock.lockMovementX){
            $('#layer-lock-'+objectTolock.id).removeClass('fa-lock');
            $('#layer-lock-'+objectTolock.id).addClass('fa-lock-open');
            if(!id){
                $('#navitem-lock').removeClass('fa-lock');
                $('#navitem-lock').addClass('fa-lock-open'); 
            }
        }else{
            $('#layer-lock-'+objectTolock.id).removeClass('fa-lock-open');
            $('#layer-lock-'+objectTolock.id).addClass('fa-lock');
            if(!id){
                $('#navitem-lock').removeClass('fa-lock-open');
                $('#navitem-lock').addClass('fa-lock'); 
            }
        }
        objectTolock.lockMovementX = !objectTolock.lockMovementX;
        objectTolock.lockMovementY = !objectTolock.lockMovementY;
        fabricCanvasObj.renderAll(); 
        save_state();
    }  
}

function duplicate_element(id = false) {
    if(id){
        var objectToDuplicate = getObjectById(id);
    }else{
        var objectToDuplicate = fabricCanvasObj.getActiveObject();
    }

    var clone = fabric.util.object.clone(objectToDuplicate);

    // Offset the clone to prevent overlapping with the original object
    clone.set({
        left: objectToDuplicate.left + 15,
        top: objectToDuplicate.top + 15,
        id: objectToDuplicate.type + '-dup-' +  (new Date()).getTime(),
        naming: objectToDuplicate.type + '-dup-' +  (new Date()).getTime()
    }); 
    fabricCanvasObj.add(clone);
    fabricCanvasObj.setActiveObject(clone);
    fabricCanvasObj.renderAll();
    save_state(); 
    refresh_layers();
} 

function delete_element(id = false) {
    if(id){
        var objectToDelete = getObjectById(id); 
    }else{
        var objectToDelete = fabricCanvasObj.getActiveObject();   
    }
    if (objectToDelete) {
        $('#layer-'+objectToDelete.id).remove();
        fabricCanvasObj.remove(objectToDelete);
        save_state();
        check_object_type(false);
    }  
} 
function visible_element(id = false) {
    if(id){ 
        var objectTovisible = getObjectById(id);    
    }else{
        var objectTovisible = fabricCanvasObj.getActiveObject();
    }
    if (objectTovisible) {   
        if(objectTovisible.visible){
            $('#layer-eye-'+objectTovisible.id).removeClass('fa-eye');
            $('#layer-eye-'+objectTovisible.id).addClass('fa-eye-slash');
        }else{
            $('#layer-eye-'+objectTovisible.id).removeClass('fa-eye-slash');
            $('#layer-eye-'+objectTovisible.id).addClass('fa-eye');
        }
        objectTovisible.set({
            visible: !objectTovisible.visible
        });
        save_state();
        check_object_type(false);
    }  
} 