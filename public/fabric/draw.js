function drawer_menu(stauts = null){
    if(stauts){
        draw_mode = false;
    }else{
        draw_mode = !draw_mode;
    }
    if(draw_mode){ 
        change_draw_mode(true);
        $('#drawer-menu').css('display','block');
        $('#drawer-menu').animate({'bottom':'10px'});
        active_drawer_item('#drawer-item-pencil-1');
    }else{ 
        change_draw_mode(false);
        $('#drawer-menu').css('display','none');
        $('#drawer-menu').animate({'bottom':'-70px'});
    }
}

function change_draw_mode(status){ 
    canvasPages[currentCanvasId].set({isDrawingMode: status});
    fabric.Object.prototype.transparentCorners = false;
}

function active_draw_with_width(width,id){ 
    canvasPages[currentCanvasId].set({isDrawingMode: true});
    fabric.Object.prototype.transparentCorners = false;
    canvasPages[currentCanvasId].freeDrawingBrush.width = parseInt(width, 10) || 1;  
    active_drawer_item('#' + id);
}

function active_drawer_item(id){ 
    $('#drawer-item-pencil-1').removeClass('selected_drawer_item'); 
    $('#drawer-item-pencil-2').removeClass('selected_drawer_item'); 
    $('#drawer-item-pencil-3').removeClass('selected_drawer_item'); 
    if(id){
        $(id).addClass('selected_drawer_item');  
    }
}

$('#drawing-mode').on('click',function(){
    change_draw_mode(false);
    active_drawer_item(false)
})

$('#drawing-color').on('change',function(){
    var brush = canvasPages[currentCanvasId].freeDrawingBrush;
    brush.color = this.value;  
})
$('#drawing-line-width').on('change',function(){
    canvasPages[currentCanvasId].freeDrawingBrush.width = parseInt(this.value, 10) || 1;
    this.previousSibling.innerHTML = this.value; 
    $('#draw-line-width-span').html(this.value);
}) 