
<div id="page_buttons" class="btn-group btn-group-sm"  role="group" >
    <button type="button" class="btn btn-custom btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom"
        data-bs-title="Remove" onclick="deleteCanvas()"><i class="fa-duotone fa-trash-can-list"></i></button> 
    <button type="button" class="btn btn-custom btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom"
        data-bs-title="Clear Area" onclick="clearCanvas()"><i class="fa-duotone fa-broom-wide"></i></button>
    <button type="button" class="btn btn-custom btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom"
        data-bs-title="Add Page" onclick="createCanvas()"><i class=" fa-duotone fa-square-plus"></i></button>
</div>

<div id="page_resize">
    <div class="form-group" style="display: flex;padding:0 20px">
        <label for="canvas_width" style="padding:5px">Width(px)</label>
        <input type="number" class="form-control" id="canvas_width" style="width: 100px" min="1" step="1" max="2000" onchange="canvas_resize()" onkeyup="canvas_resize()">
    </div>
    <div class="form-group" style="display: flex">
        <label for="canvas_height" style="padding:5px">Height(px)</label>
        <input type="number" class="form-control" id="canvas_height" style="width: 100px" min="1" step="1" max="2000" onchange="canvas_resize()" onkeyup="canvas_resize()">
    </div> 
</div>