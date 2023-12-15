
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

function check_object_type(selectedObject){
    if(selectedObject){
        if(selectedObject.type === 'i-text'){
            $('.text_attributes').css('display','block');  
            $('#text_attributes').css('display','flex');  
            $('.image_attributes').css('display','none'); 
            $('#effect_attributes').detach().appendTo('#text_attributes'); 
            $('#effect_attributes').css('display','inline');
        }else if(selectedObject.type === 'image'){
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
        $('canvas').removeClass('canvas-border');
        $(canvasId).addClass('canvas-border');  
        $("#active_helper_buttons").detach().insertAfter(canvasId); 
        $("#page_buttons").detach().insertAfter(canvasId); 
        $('#page_buttons').css('display','block');
        inactive_helper_buttons();
    }
}