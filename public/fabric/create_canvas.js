function createCanvas(height = canvasHeight,width = canvasWidth) {

    var canvasPage = document.createElement('div');
    canvasPage.id = 'pageCanvas' + (new Date()).getTime(); 
    document.getElementById('canvas-pages').appendChild(canvasPage);
    $('#' + canvasPage.id).addClass('canvas-page mb-6'); 

    var canvasElement = document.createElement('canvas');
    canvasElement.id = 'dynamicCanvas' + (new Date()).getTime(); // Unique ID for each canvas
    canvasElement.width = width;
    canvasElement.height = height;

    document.getElementById(canvasPage.id).appendChild(canvasElement);

    var newCanvas = new fabric.Canvas(canvasElement.id, {
        preserveObjectStacking: true,
        skipTargetFind: false,
        stopContextMenu: true,
        // backgroundColor: 'white'
    });
    canvasPages['#' + canvasElement.id] = newCanvas;
    
    selectCanvas(newCanvas,'#' + canvasElement.id); 
    initAligningGuidelines(newCanvas); // alliging between objects
    initCenteringGuidelines(newCanvas); // Centering object to page

    newCanvas.on('mouse:down', function(options) { 
        selectCanvas(newCanvas,'#' + canvasElement.id); 
    }); 
    
    newCanvas.on('object:moving',function(e){ 
        inactive_helper_buttons();
    })
    newCanvas.on('object:modified', function (e) {
        selectedObject = newCanvas.findTarget(e); 
        active_helper_buttons(selectedObject);
        save_state();
    })
    newCanvas.on('selection:created', function(e) {
        if(newCanvas.findTarget(e)){ // if not found that mean update the selection from layers
            selectedObject = newCanvas.findTarget(e);    
        }
        active_helper_buttons(selectedObject);
        check_object_type(selectedObject); 
        active_layer_li('#layer-'+selectedObject.id); 
    });

    newCanvas.on('selection:updated', function(e) {
        cropImage();
        if(newCanvas.findTarget(e)){ // if not found that mean update the selection from layers
            selectedObject = newCanvas.findTarget(e);   
        }
        active_helper_buttons(selectedObject);
        check_object_type(selectedObject); 
        active_layer_li('#layer-'+selectedObject.id); 
    });

    newCanvas.on('selection:cleared', function(e) {
        cropImage(); 
        inactive_helper_buttons();
        check_object_type(false);
        active_layer_li(false);
    });  

    newCanvas.on('object:scaling', function(e) {            
        if(selectedObject && selectedObject.type === 'image' && !isCrop) {
            selectedObject.oldScaleX = selectedObject.scaleX;
            selectedObject.oldScaleY = selectedObject.scaleY;
            selectedObject.setCoords(); 
        }
        inactive_helper_buttons();
    }); 
    
    newCanvas.on('mouse:over', function(e) {
        var target = newCanvas.findTarget(e);  
        if(target){
            hoverdObject = target;
            target._renderControls(target.canvas.contextTop, {
                hasControls: false,
            })
        }
    })
    newCanvas.on('mouse:down', function(e) {
        var target = newCanvas.findTarget(e);  
        if(target){
            target.canvas.clearContext(target.canvas.contextTop);
        }
    })

    newCanvas.on('mouse:out', function(e) {  
        if(hoverdObject && newCanvas.getObjects().indexOf(hoverdObject) != -1){ 
            hoverdObject.canvas.clearContext(hoverdObject.canvas.contextTop);
        }  
    })

    fabric.util.addListener(newCanvas.upperCanvasEl, 'dblclick', function(e) {
        var target = newCanvas.findTarget(e);
        start_croping(target); 
    });


    // newCanvas.wrapperEl.addEventListener('contextmenu', function (e) {
    //     e.preventDefault();
    //     let clickedObject = newCanvas.findTarget(e,false);

    //     if (clickedObject) {
    //         let type = clickedObject.type;
    //         if (type === "group") {
    //             console.log('right click on group');
    //         } else {  
    //             newCanvas.setActiveObject(clickedObject);
    //             newCanvas.renderAll(); 
    //             active_helper_buttons(clickedObject);
    //         }
    //     } else { 
    //         console.log('right click on canvas');
    //     }  
    //     context.init({preventDoubleContext: false});
    //     context.attach('canvas', test_menu);
    // });  

}