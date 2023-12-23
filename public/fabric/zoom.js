
function zoomIn() {
    zoomPercentage += 10;
    updateZoom();
}

function zoomOut() {
    zoomPercentage -= 10;
    updateZoom();
}

function change_zoom(){
    zoomPercentage = parseInt($('#zoom-precent').val());
    updateZoom();
}

function updateZoom() {
    document.getElementById('page-container').style.transform = 'scale(' + (zoomPercentage / 100) + ')';
    $('#zoom-precent').val(zoomPercentage);
    console.log(zoomPercentage);
}

function calculateZoom() {
    var containerWidth = $('#page-container').width(); 
    var containerContent = $('#canvas-pages').width(); 
    tozoom = ($('body').width() / canvasWidth) * 66;
    zoomPercentage = Math.round(tozoom * 100) / 100
    console.log('page-container:' + containerWidth);
    console.log('canvas-width:' + canvasWidth);
    console.log('body width:' + $('body').width());
    updateZoom();
}

// Recalculate on window resize
window.onresize = calculateZoom;