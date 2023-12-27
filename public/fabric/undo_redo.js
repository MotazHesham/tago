
// this structure of each page state
var states = [{
    'id' : null,
    undo : [],
    redo : [],
    state : null,
}];

/**
 * Push the current state into the undo stack and then capture the current state
 */
function save_state() { 
    // clear the redo stack 
    $('#redo').prop('disabled', true);
    
    let currentState = states.find(raw => raw.id == currentCanvasId);
    if (currentState) {
        currentState.undo.push(currentState.state);
        $('#undo').prop('disabled', false);
        currentState.state = JSON.stringify(canvasPages[currentCanvasId]);
        currentState.redo = []; 
    }else{
        states.push({
            'id' : currentCanvasId,
            undo : [],
            redo : [],
            state : JSON.stringify(canvasPages[currentCanvasId]),
        }); 
    }  
}

function replay(buttonsOn, buttonsOff) {
    let currentState = states.find(raw => raw.id == currentCanvasId);
    if(currentState){ 
        if(buttonsOn == '#redo'){
            playStack = currentState.undo;
            saveStack = currentState.redo;
        }else if(buttonsOn == '#undo'){
            playStack = currentState.redo;
            saveStack = currentState.undo;
        }
        saveStack.push(currentState.state);
        currentState.state = playStack.pop();
        var on = $(buttonsOn);
        var off = $(buttonsOff);
        // turn both buttons off for the moment to prevent rapid clicking
        on.prop('disabled', true);
        off.prop('disabled', true);
        canvasPages[currentCanvasId].clear();
        canvasPages[currentCanvasId].loadFromJSON(currentState.state, function() {
            canvasPages[currentCanvasId].renderAll();
            // now turn the buttons back on if applicable
            on.prop('disabled', false);
            if (playStack.length) {
                off.prop('disabled', false);
            }
        });
    }
}

$('#undo').click(function() {
    replay('#redo', this);
});
$('#redo').click(function() {
    replay('#undo', this);
})