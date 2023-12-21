

function flipHorizontal() {
    if (selectedObject) {
        selectedObject.flipX = !selectedObject.flipX;
        canvasPages[currentCanvasId].renderAll();
        save_state();
    }
}

// Function to flip the active object vertically
function flipVertical() {
    if (selectedObject) {
        selectedObject.flipY = !selectedObject.flipY;
        canvasPages[currentCanvasId].renderAll();
        save_state();
    }
}

function transperancy_element(element) { 
    $('#transparency-span').html(element.value);
    if(selectedObject){
        selectedObject.setOpacity(element.value);
        canvasPages[currentCanvasId].renderAll(); 
    }
}

function gray_scale_element() {

    // Retrieve existing filters
    var existingFilters = selectedObject.filters || [];

    // Append the Grayscale filter
    existingFilters.push(new fabric.Image.filters.Grayscale());

    // Set the updated filters array to the object
    selectedObject.set('filters', existingFilters);
    selectedObject.applyFilters();

    canvasPages[currentCanvasId].renderAll();
    save_state();
}

function remove_gray_scale_element() {

    selectedObject.filters = selectedObject.filters.filter(function(filter) {
        return !(filter instanceof fabric.Image.filters.Grayscale);
    });

    selectedObject.applyFilters();

    canvasPages[currentCanvasId].renderAll();
    save_state();
}

function hexToRgb(hex) {
    // Remove the hash if it exists
    hex = hex.replace(/^#/, '');

    // Parse the hexadecimal string into individual color components
    var bigint = parseInt(hex, 16);
    var r = (bigint >> 16) & 255;
    var g = (bigint >> 8) & 255;
    var b = bigint & 255;

    return r+','+g+','+b;
}

function shadow_element(status) { 
    // assign values
    if(status){
        $('#shadow-offsetx-span').html($('#shadow-input-offsetx').val());
        $('#shadow-offsety-span').html($('#shadow-input-offsety').val());
        $('#shadow-opacity-span').html($('#shadow-input-opacity').val());
        $('#shadow-blur-span').html($('#shadow-input-blur').val());
    
        var rgb = hexToRgb($('#shadow-input-color').val());
        color_with_opacity = 'rgb('+rgb+','+parseFloat($('#shadow-input-opacity').val())+')'; 
        selectedObject.set('shadow', {
            color: color_with_opacity, 
            blur: parseInt($('#shadow-input-blur').val()), 
            offsetX: parseInt($('#shadow-input-offsetx').val()),
            offsetY: parseInt($('#shadow-input-offsety').val())
        });
    }else{
        selectedObject.set('shadow', {
            color: '#fff', 
            blur: 0, 
            offsetX: 0,
            offsetY: 0
        });
    }
    canvasPages[currentCanvasId].renderAll();
    save_state();

}

function cropActiveObject() {
    start_croping(selectedObject);    
}

function fit_page_element() { 
    // Center the object on the canvas
    selectedObject.scaleToHeight(canvasPages[currentCanvasId].height);
    selectedObject.scaleToWidth(canvasPages[currentCanvasId].width);
    selectedObject.set({ 
        top: 0,
        left: 0
    });
    canvasPages[currentCanvasId].renderAll();
    save_state();
}

function radius_element(element) { 

    var value = 0;
    if(!element){
        $('#radius-span').html('');
    }else{
        value = element.value;
        $('#radius-span').html('(' + value + ')');
    }

    // Set the border radius values as per your requirement
    var borderRadiusX = value;
    var borderRadiusY = value; 
    // Create a rounded rectangle as a clip path
    var clipPath = new fabric.Rect({
        width: selectedObject.width ,
        height: selectedObject.height , 
        rx: borderRadiusX / selectedObject.scaleX,
        ry: borderRadiusY / selectedObject.scaleY,
        originX: 'center',
        originY: 'center'
    });

    // Set the clipPath to the image
    selectedObject.border_radius = value;
    selectedObject.set({
        clipPath: clipPath 
    });
    canvasPages[currentCanvasId].renderAll(); 
} 
function sepia_element(status){
    // Retrieve existing filters
    var existingFilters = selectedObject.filters || []; 

    // Set the updated filters array to the object 
    existingFilters = existingFilters.filter(function(filter) {
        return !(filter instanceof fabric.Image.filters.Sepia);
    });
    if(status){
        var sepiaFilter = new fabric.Image.filters.Sepia();
        existingFilters.push(sepiaFilter);
    }


    // Render the canvas
    selectedObject.filters = existingFilters;
    selectedObject.applyFilters();
    canvasPages[currentCanvasId].renderAll();
}

function border_element(element){ 
    if(!element){
        selectedObject.set({
            strokeWidth: 0
        });
        canvasPages[currentCanvasId].renderAll();
        save_state();
        return ;
    }
    selectedObject.set({
        stroke: $('#border-input-color').val(),
        strokeWidth: parseInt($('#border-input-size').val()),
        rx: 50 / selectedObject.scaleX,
        ry: 50 / selectedObject.scaleY,
    });
    canvasPages[currentCanvasId].renderAll();
    save_state();
}


function brightness_element(element) { 
    var value = 0;
    if(!element){
        $('#brightness-span').html('');
    }else{
        value = element.value;
        $('#brightness-span').html('(' + value + ')');
    }

    // Retrieve existing filters
    var existingFilters = selectedObject.filters || []; 

    // Set the updated filters array to the object 
    existingFilters = existingFilters.filter(function(filter) {
        return !(filter instanceof fabric.Image.filters.Brightness);
    });

    // Apply the brightness filter to the object
    var brightnessFilter = new fabric.Image.filters.Brightness({
        brightness: value // You can adjust the brightness value as needed
    });
    existingFilters.push(brightnessFilter);
    selectedObject.filters = existingFilters;
    selectedObject.applyFilters();
    canvasPages[currentCanvasId].renderAll(); 
}

function blur_element(element) { 
    var value = 0;
    if(!element){
        $('#blur-span').html('');
    }else{
        value = element.value;
        $('#blur-span').html('(' + value + ')');
    }

    // Retrieve existing filters
    var existingFilters = selectedObject.filters || []; 

    // Set the updated filters array to the object 
    existingFilters = existingFilters.filter(function(filter) {
        return !(filter instanceof fabric.Image.filters.Blur);
    });

    // Apply the Blur filter to the object
    var blurFilter = new fabric.Image.filters.Blur({
        blur: value // You can adjust the blur value as needed
    });
    existingFilters.push(blurFilter);
    selectedObject.filters = existingFilters;
    selectedObject.applyFilters();
    canvasPages[currentCanvasId].renderAll(); 
}