function alignTop() {
    if (selectedObject) {
        selectedObject.set({
            top: 0
        }); // Align to the top
        selectedObject.setCoords(); // Update object's coordinates
        fabricCanvasObj.renderAll();
        active_helper_buttons(selectedObject);
        save_state();
    }
}

function alignLeft() { 
    if (selectedObject) {
        selectedObject.set({
            left: 0
        }); // Align to the left
        selectedObject.setCoords(); // Update object's coordinates
        fabricCanvasObj.renderAll();
        active_helper_buttons(selectedObject);
        save_state();
    }
}

function alignRight() { 
    if (selectedObject) {
        var canvasWidth = fabricCanvasObj.width;
        var objectWidth = selectedObject.width * selectedObject.scaleX;
        selectedObject.set({
            left: canvasWidth - objectWidth
        }); // Align to the right
        selectedObject.setCoords(); // Update object's coordinates
        fabricCanvasObj.renderAll();
        active_helper_buttons(selectedObject);
        save_state();
    }
}

function alignBottom() { 
    if (selectedObject) {
        var canvasHeight = fabricCanvasObj.height;
        var objectHeight = selectedObject.height * selectedObject.scaleY;
        selectedObject.set({
            top: canvasHeight - objectHeight
        }); // Align to the bottom
        selectedObject.setCoords(); // Update object's coordinates
        fabricCanvasObj.renderAll();
        active_helper_buttons(selectedObject);
        save_state();
    }
}

function alignCenter() {
    if (selectedObject) {
        var canvasWidth = fabricCanvasObj.width;
        var objectWidth = selectedObject.width * selectedObject.scaleX;
        selectedObject.set({
            left: (canvasWidth - objectWidth) / 2
        }); // Center horizontally
        selectedObject.setCoords(); // Update object's coordinates
        fabricCanvasObj.renderAll();
        active_helper_buttons(selectedObject);
        save_state();
    }
}

function alignMiddle() {
    if (selectedObject) {
        var canvasHeight = fabricCanvasObj.height;
        var objectHeight = selectedObject.height * selectedObject.scaleY;
        selectedObject.set({
            top: (canvasHeight - objectHeight) / 2
        }); // Center vertically
        selectedObject.setCoords(); // Update object's coordinates
        fabricCanvasObj.renderAll();
        active_helper_buttons(selectedObject);
        save_state();
    }
}
function sendBackward() {
    if (selectedObject) {
        fabricCanvasObj.sendBackwards(selectedObject);
        fabricCanvasObj.renderAll();
        active_helper_buttons(selectedObject);
        save_state();
    }
}

function bringToFront() {
    if (selectedObject) {
        fabricCanvasObj.bringToFront(selectedObject);
        fabricCanvasObj.renderAll();
        active_helper_buttons(selectedObject);
        save_state();
    }
}

function sendToBack() {
    if (selectedObject) {
        fabricCanvasObj.sendToBack(selectedObject);
        fabricCanvasObj.renderAll();
        active_helper_buttons(selectedObject);
        save_state();
    }
}

function bringForward() {
    if (selectedObject) {
        fabricCanvasObj.bringForward(selectedObject);
        fabricCanvasObj.renderAll();
        active_helper_buttons(selectedObject);
        save_state();
    }
}