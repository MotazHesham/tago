
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
    if(!$('#active_helper_buttons').css('display','none')){
        $('#active_helper_buttons').css('display','none');
    }
}

function check_object_type(selectedObject){
    if(selectedObject){
        if(selectedObject.type === 'i-text'){
            $('#text_attributes').css('display','inline'); 
        }else{ 
            $('#text_attributes').css('display','none');
        }
    }else{ 
        $('#text_attributes').css('display','none');
    }
} 