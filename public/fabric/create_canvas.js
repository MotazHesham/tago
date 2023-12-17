function createCanvas() {

    var canvasPage = document.createElement('div');
    canvasPage.id = 'pageCanvas' + (new Date()).getTime(); 
    document.getElementById('page-container').appendChild(canvasPage);
    $('#' + canvasPage.id).addClass('canvas-page mb-5'); 

    var canvasElement = document.createElement('canvas');
    canvasElement.id = 'dynamicCanvas' + (new Date()).getTime(); // Unique ID for each canvas
    canvasElement.width = 1200;
    canvasElement.height = 630;

    document.getElementById(canvasPage.id).appendChild(canvasElement);

    var newCanvas = new fabric.Canvas(canvasElement.id, {
        preserveObjectStacking: true,
        skipTargetFind: false,
        backgroundColor: 'white'
    });
    
    selectCanvas(newCanvas,'#' + canvasElement.id); 

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
    //     // context.init({preventDoubleContext: false});
    //     // context.attach('canvas', test_menu);
    // });  

    // When the user selects a picture that has been added and press the DEL key
    // The object will be removed !
    document.addEventListener("keydown", function(e) {
        var keyCode = e.keyCode; 
        if (keyCode == 46) { 
            delete_element()
        }
    }, false); 
}