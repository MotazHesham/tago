
// past states
var undo = [];
// reverted states
var redo = [];

// current unsaved state
var state;

/**
 * Push the current state into the undo stack and then capture the current state
 */
function save_state() {
    // clear the redo stack
    redo = [];
    $('#redo').prop('disabled', true);
    // initial call won't have a state
    if (state) {
        undo.push(state);
        $('#undo').prop('disabled', false);
    }
    state = JSON.stringify(canvasPages[currentCanvasId]); 
}

function replay(playStack, saveStack, buttonsOn, buttonsOff) {
    saveStack.push(state);
    state = playStack.pop();
    var on = $(buttonsOn);
    var off = $(buttonsOff);
    // turn both buttons off for the moment to prevent rapid clicking
    on.prop('disabled', true);
    off.prop('disabled', true);
    canvasPages[currentCanvasId].clear();
    canvasPages[currentCanvasId].loadFromJSON(state, function() {
        canvasPages[currentCanvasId].renderAll();
        // now turn the buttons back on if applicable
        on.prop('disabled', false);
        if (playStack.length) {
            off.prop('disabled', false);
        }
    });
}

$('#undo').click(function() {
    replay(undo, redo, '#redo', this);
});
$('#redo').click(function() {
    replay(redo, undo, '#undo', this);
})