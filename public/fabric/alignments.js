function alignTop() {
    if (selectedObject) {
        selectedObject.set({
            top: 0
        }); // Align to the top
        selectedObject.setCoords(); // Update object's coordinates
        canvasPages[currentCanvasId].renderAll();
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
        canvasPages[currentCanvasId].renderAll();
        active_helper_buttons(selectedObject);
        save_state();
    }
}

function alignRight() { 
    if (selectedObject) {
        var canvasWidth = canvasPages[currentCanvasId].width;
        var objectWidth = selectedObject.width * selectedObject.scaleX;
        selectedObject.set({
            left: canvasWidth - objectWidth
        }); // Align to the right
        selectedObject.setCoords(); // Update object's coordinates
        canvasPages[currentCanvasId].renderAll();
        active_helper_buttons(selectedObject);
        save_state();
    }
}

function alignBottom() { 
    if (selectedObject) {
        var canvasHeight = canvasPages[currentCanvasId].height;
        var objectHeight = selectedObject.height * selectedObject.scaleY;
        selectedObject.set({
            top: canvasHeight - objectHeight
        }); // Align to the bottom
        selectedObject.setCoords(); // Update object's coordinates
        canvasPages[currentCanvasId].renderAll();
        active_helper_buttons(selectedObject);
        save_state();
    }
}

function alignCenter() {
    if (selectedObject) {
        var canvasWidth = canvasPages[currentCanvasId].width;
        var objectWidth = selectedObject.width * selectedObject.scaleX;
        selectedObject.set({
            left: (canvasWidth - objectWidth) / 2
        }); // Center horizontally
        selectedObject.setCoords(); // Update object's coordinates
        canvasPages[currentCanvasId].renderAll();
        active_helper_buttons(selectedObject);
        save_state();
    }
}

function alignMiddle() {
    if (selectedObject) {
        var canvasHeight = canvasPages[currentCanvasId].height;
        var objectHeight = selectedObject.height * selectedObject.scaleY;
        selectedObject.set({
            top: (canvasHeight - objectHeight) / 2
        }); // Center vertically
        selectedObject.setCoords(); // Update object's coordinates
        canvasPages[currentCanvasId].renderAll();
        active_helper_buttons(selectedObject);
        save_state();
    }
}
function sendBackward() {
    if (selectedObject) {
        canvasPages[currentCanvasId].sendBackwards(selectedObject);
        canvasPages[currentCanvasId].renderAll();
        active_helper_buttons(selectedObject);
        save_state();
    }
}

function bringToFront() {
    if (selectedObject) {
        canvasPages[currentCanvasId].bringToFront(selectedObject);
        canvasPages[currentCanvasId].renderAll();
        active_helper_buttons(selectedObject);
        save_state();
    }
}

function sendToBack() {
    if (selectedObject) {
        canvasPages[currentCanvasId].sendToBack(selectedObject);
        canvasPages[currentCanvasId].renderAll();
        active_helper_buttons(selectedObject);
        save_state();
    }
}

function bringForward() {
    if (selectedObject) {
        canvasPages[currentCanvasId].bringForward(selectedObject);
        canvasPages[currentCanvasId].renderAll();
        active_helper_buttons(selectedObject);
        save_state();
    }
}