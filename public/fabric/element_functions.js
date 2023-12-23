
function copy_element() { 
    canvasPages[currentCanvasId].getActiveObject().clone(function(cloned) {
        _clipboard = cloned;
    });
}

function paste_element() {
    // clone again, so you can do multiple copies.
    _clipboard.clone(function(clonedObj) {
        canvasPages[currentCanvasId].discardActiveObject();
        clonedObj.set({
            left: clonedObj.left + 10,
            top: clonedObj.top + 10,
            evented: true, 
            id : 'clone' + (new Date()).getTime(),
            naming : 'clone' + (new Date()).getTime(),
        }); 
        clonedObj.set(corner_options); 
        if (clonedObj.type === 'activeSelection') {
            // active selection needs a reference to the canvas.
            clonedObj.canvas = canvasPages[currentCanvasId];
            clonedObj.forEachObject(function(obj) {
                canvasPages[currentCanvasId].add(obj);
            });
            // this should solve the unselectability
            clonedObj.setCoords();
        } else {
            canvasPages[currentCanvasId].add(clonedObj);
        }
        _clipboard.top += 10;
        _clipboard.left += 10;
        canvasPages[currentCanvasId].setActiveObject(clonedObj);
        canvasPages[currentCanvasId].requestRenderAll();
    });
    refresh_layers();
    save_state();
}

function lock_element(id = false) {
    if(id){
        var objectTolock = getObjectById(id);
    }else{
        var objectTolock = canvasPages[currentCanvasId].getActiveObject();
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
        canvasPages[currentCanvasId].renderAll(); 
        save_state();
    }  
}

function duplicate_element(id = false) {
    if(id){
        var objectToDuplicate = getObjectById(id);
    }else{
        var objectToDuplicate = canvasPages[currentCanvasId].getActiveObject();
    }

    if(objectToDuplicate){
        var clone = fabric.util.object.clone(objectToDuplicate);
    
        // Offset the clone to prevent overlapping with the original object
        clone.set({
            left: objectToDuplicate.left + 15,
            top: objectToDuplicate.top + 15,
            id: objectToDuplicate.type + '-dup-' +  (new Date()).getTime(),
            naming: objectToDuplicate.type + '-dup-' +  (new Date()).getTime()
        }); 
        canvasPages[currentCanvasId].add(clone);
        canvasPages[currentCanvasId].setActiveObject(clone);
        canvasPages[currentCanvasId].renderAll();
        save_state(); 
        refresh_layers();
    }
} 

function delete_element(id = false) {
    if(id){
        var objectToDelete = getObjectById(id); 
    }else{
        var objectToDelete = canvasPages[currentCanvasId].getActiveObject();   
    }
    if (objectToDelete) { 
        if(objectToDelete.type == 'activeSelection'){
            var groupItems = objectToDelete.getObjects();
            groupItems.forEach(function(item) {
                canvasPages[currentCanvasId].remove(item);
            }); 
        }
        $('#layer-'+objectToDelete.id).remove();
        canvasPages[currentCanvasId].remove(objectToDelete);
        canvasPages[currentCanvasId].discardActiveObject();
        save_state();
        refresh_layers();
        check_object_type(false);
    }  
} 

function visible_element(id = false) {
    if(id){ 
        var objectTovisible = getObjectById(id);    
    }else{
        var objectTovisible = canvasPages[currentCanvasId].getActiveObject();
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

function ungroup_elements() {
    if (!canvasPages[currentCanvasId].getActiveObject()) {
        return;
    }
    if (canvasPages[currentCanvasId].getActiveObject().type !== 'group') {
        return;
    }
    canvasPages[currentCanvasId].getActiveObject().toActiveSelection();
    canvasPages[currentCanvasId].requestRenderAll();
    save_state();
    check_object_type(false); 
    refresh_layers();
} 
function group_elements() {
    if (!canvasPages[currentCanvasId].getActiveObject()) {
        return;
    }
    if (canvasPages[currentCanvasId].getActiveObject().type !== 'activeSelection') {
        return;
    }
    canvasPages[currentCanvasId].getActiveObject().toGroup();
    canvasPages[currentCanvasId].requestRenderAll();
    save_state();
    check_object_type(false); 
    refresh_layers();
} 