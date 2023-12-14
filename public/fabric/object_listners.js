

fabricCanvasObj.on('object:moving',function(e){ 
    inactive_helper_buttons();
})
fabricCanvasObj.on('object:modified', function (e) {
    selectedObject = fabricCanvasObj.findTarget(e); 
    active_helper_buttons(selectedObject);
    save_state();
})

fabricCanvasObj.on('selection:created', function(e) {
    selectedObject = fabricCanvasObj.findTarget(e); 
    active_helper_buttons(selectedObject);
    check_object_type(selectedObject);
});

fabricCanvasObj.on('selection:updated', function(e) {
    cropImage();
    selectedObject = fabricCanvasObj.findTarget(e);  
    active_helper_buttons(selectedObject);
    check_object_type(selectedObject);
});

fabricCanvasObj.on('selection:cleared', function(e) {
    cropImage(); 
    inactive_helper_buttons();
    check_object_type(false);
});  

fabricCanvasObj.on('object:scaling', function(e) {            
    if(selectedObject && selectedObject.type === 'image' && !isCrop) {
        selectedObject.oldScaleX = selectedObject.scaleX;
        selectedObject.oldScaleY = selectedObject.scaleY;
        selectedObject.setCoords(); 
    }
    inactive_helper_buttons();
});

fabric.util.addListener(fabricCanvasObj.upperCanvasEl, 'dblclick', function(e) {
    var target = fabricCanvasObj.findTarget(e);
    start_croping(target); 
});


fabricCanvasObj.wrapperEl.addEventListener('contextmenu', function (e) {
    e.preventDefault();
    let clickedObject = fabricCanvasObj.findTarget(e,false);

    if (clickedObject) {
        let type = clickedObject.type;
        if (type === "group") {
            console.log('right click on group');
        } else {  
            fabricCanvasObj.setActiveObject(clickedObject);
            fabricCanvasObj.renderAll(); 
            active_helper_buttons(clickedObject);
        }
    } else { 
        console.log('right click on canvas');
    }  
    // context.init({preventDoubleContext: false});
    // context.attach('canvas', test_menu);
});  

// When the user selects a picture that has been added and press the DEL key
// The object will be removed !
document.addEventListener("keydown", function(e) {
    var keyCode = e.keyCode; 
    if (keyCode == 46) { 
        delete_element()
    }
}, false);

$('#').on('click', function(e) {
    var canvasContainer = $('#canvas'); // Replace with your actual canvas container ID

    // Check if the clicked element is not within the canvas container
    if (!canvasContainer.is(e.target) && canvasContainer.has(e.target).length === 0) {
        // Clicked outside the canvas, do something
        console.log('Clicked outside the canvas');
    }
});