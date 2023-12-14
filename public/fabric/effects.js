

function flipHorizontal() {
    if (selectedObject) {
        selectedObject.flipX = !selectedObject.flipX;
        fabricCanvasObj.renderAll();
        save_state();
    }
}

// Function to flip the active object vertically
function flipVertical() {
    if (selectedObject) {
        selectedObject.flipY = !selectedObject.flipY;
        fabricCanvasObj.renderAll();
        save_state();
    }
}

function transperancy_element(element) {
    selectedObject.setOpacity(element.value);
    fabricCanvasObj.renderAll(); 
}

function grey_scale_element(element) {

    // Retrieve existing filters
    var existingFilters = selectedObject.filters || [];

    // Append the Grayscale filter
    existingFilters.push(new fabric.Image.filters.Grayscale());

    // Set the updated filters array to the object
    selectedObject.set('filters', existingFilters);
    selectedObject.applyFilters();

    fabricCanvasObj.renderAll();
    save_state();
}

function remove_grey_scale_element(element) {

    selectedObject.filters = selectedObject.filters.filter(function(filter) {
        return !(filter instanceof fabric.Image.filters.Grayscale);
    });

    selectedObject.applyFilters();

    fabricCanvasObj.renderAll();
    save_state();
}

function set_shadow_element(element) {
    selectedObject.set('shadow', {
        color: 'rgba(0, 0, 0, 0.5)',
        blur: 10,
        offsetX: 5,
        offsetY: 5
    });
    fabricCanvasObj.renderAll(); 
}

function cropActiveObject() {
    start_croping(selectedObject);  
}

function fit_page_element() {

    // Calculate the scaling factors for width and height
    var scaleX = fabricCanvasObj.width / selectedObject.width;
    var scaleY = fabricCanvasObj.height / selectedObject.height;

    // Set the scaling factors for the object
    selectedObject.scaleX = scaleX;
    selectedObject.scaleY = scaleY;

    // Center the object on the canvas
    selectedObject.set({
        left: fabricCanvasObj.width / 2,
        top: fabricCanvasObj.height / 2,
        originX: 'center',
        originY: 'center'
    });
    fabricCanvasObj.renderAll();
    save_state();
}

function border_radius_element(element) { 

    // Set the border radius values as per your requirement
    var borderRadiusX = element.value;
    var borderRadiusY = element.value;

    // Create a rounded rectangle as a clip path
    var clipPath = new fabric.Rect({
        width: selectedObject.width,
        height: selectedObject.height,
        rx: borderRadiusX,
        ry: borderRadiusY,
        originX: 'center',
        originY: 'center'
    });

    // Set the clipPath to the image
    selectedObject.set({
        clipPath: clipPath,
        scaleX: 1, // Reset scale to ensure clipPath is not affected by object scale
        scaleY: 1
    });
    fabricCanvasObj.renderAll(); 
}

function border_element() {
    selectedObject.set({
        stroke: 'green',
        strokeWidth: 10
    });
    fabricCanvasObj.renderAll();
    save_state();
}

function blur_element(element) { 
    selectedObject.filters = selectedObject.filters.filter(function(filter) {
        return !(filter instanceof fabric.Image.filters.Brightness);
    });

    // Apply the brightness filter to the object
    var brightnessFilter = new fabric.Image.filters.Brightness({
        brightness: element.value // You can adjust the brightness value as needed
    });
    selectedObject.filters = [brightnessFilter];
    selectedObject.applyFilters();
    fabricCanvasObj.renderAll(); 
}