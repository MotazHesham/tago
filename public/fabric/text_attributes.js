
function text_size(element){
    if(selectedObject){
        selectedObject.set('fontSize',element.value);
        fabricCanvasObj.renderAll();
        active_helper_buttons(selectedObject);
        save_state();
    }
}

function setFontFamily(element){
    if(selectedObject){
        selectedObject.set('fontFamily',element.value);
        fabricCanvasObj.renderAll(); 
        active_helper_buttons(selectedObject);
        save_state();
    }
}
function setAlignText(element){
    if(selectedObject){
        selectedObject.set('textAlign',element.value);
        fabricCanvasObj.renderAll();  
        save_state();
    }
}
function text_color(element){
    if(selectedObject){
        selectedObject.set('fill',element.value);
        fabricCanvasObj.renderAll();
        save_state();
    }
}

// Implement Bold Text
function toggleBold() {
    if(selectedObject){
        var isBold = selectedObject.get('fontWeight') === 'bold';
        selectedObject.set('fontWeight', isBold ? 'normal' : 'bold');
        fabricCanvasObj.renderAll();
        save_state();
    }
}

// Implement Italic Text
function toggleItalic() {
    if(selectedObject){
        var isItalic = selectedObject.get('fontStyle') === 'italic';
        selectedObject.set('fontStyle', isItalic ? 'normal' : 'italic');
        fabricCanvasObj.renderAll();
        save_state();
    }
}

// Implement Underline Text
function toggleUnderline() {
    if(selectedObject){ 
        var isUnderline = selectedObject.get('underline') === 'underline';
        selectedObject.set('underline', isUnderline ? '' : 'underline'); 
        fabricCanvasObj.renderAll();
        save_state();
    }
}

// Implement Line Height
function setLineHeight(element) {
    if(selectedObject){
        $('#line-height-span').html(element.value);
        selectedObject.set('lineHeight', element.value);
        fabricCanvasObj.renderAll();
        save_state();
    }
}

// Implement Letter Spacing
function setLetterSpacing(element) { 
    if(selectedObject){
        $('#letter-spacing-span').html(element.value);
        selectedObject.set('charSpacing', element.value);
        fabricCanvasObj.renderAll();
        active_helper_buttons(selectedObject);
        save_state();
    }
}

// Implement Text Stroke
function setStroke(element) { 
    if(selectedObject){
        selectedObject.set('strokeWidth', parseInt($('#text-stroke-color-size').val()));
        selectedObject.set('stroke', $('#text-stroke-color').val());
        selectedObject.set('fill', selectedObject.fill);
        fabricCanvasObj.renderAll();
        active_helper_buttons(selectedObject);
        save_state();
    }
}

// Implement Background
function setBackground(element) {  
    if(selectedObject){
        selectedObject.set('backgroundColor', element.value);
        fabricCanvasObj.renderAll();
        save_state();
    }
}