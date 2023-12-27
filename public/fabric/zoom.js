function zoomIn() {
    zoomPercentage += 10;
    updateZoom();
}

function zoomOut() {
    zoomPercentage -= 10;
    updateZoom();
}

function change_zoom() {
    zoomPercentage = parseInt($("#zoom-precent").val());
    updateZoom();
}

function updateZoom() {
    $(".canvas-page").css("transform", "scale(" + zoomPercentage / 100 + ")");
    $(".canvas-page").css("transform-origin", "top");
    $("#zoom-precent").val(Math.round(zoomPercentage * 100) / 100);
    // console.log(zoomPercentage);
}

function calculateZoom() {
    var bodyw = $("body").width();
    var bodyh = $("body").height();
    var containerWidth = $("#page-container").width();
    var containerContent = $("#canvas-pages").width();
    zoomPercentage = (containerWidth / (canvasHeight + canvasWidth)) * 100 + 10;
    // console.log('bodyw: '+ bodyw);
    // console.log('bodyh: '+ bodyh);
    // console.log('page-container: '+containerWidth);
    // console.log('canvas-pages: '+containerContent);
    updateZoom();
}

window.onresize = calculateZoom;
