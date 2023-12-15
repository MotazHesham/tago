
<div class="dropdown" style="display: inline">
    <button type="button" class="btn btn-custom" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
        <span><i class="fa-thin fa-spray-can"></i> Effects</span>
    </button>
    <div class="dropdown-menu p-2" style="width:250px" id="dropdown-effects">
        <div class="image_attributes">
            <div style="display: flex;justify-content:space-between">
                <label for="brightness-check">Brightness <small style="color:black"><b id="brightness-span"></b></small> </label>
                <span><input class="form-check-input" type="checkbox" id="brightness-check" onchange="checkbox_activation(this,'brightness-div','brightness')"></span>
            </div>
            <div id="brightness-div" style="display: none"> 
                <input type="range" class="form-range" id="brightness-input" min="-1.00" step="0.01" max="1.00" oninput="brightness_element(this)">  
            </div>
        </div >
        <div class="image_attributes">
            <div style="display: flex;justify-content:space-between">
                <label for="border-check">Border <small style="color:black"><b id="border-span"></b></small> </label>
                <span><input type="checkbox" class="form-check-input" id="border-check" onchange="checkbox_activation(this,'border-div','border')"></span>
            </div>
            <div id="border-div" style="display: none"> 
                <div style="display: flex;justify-content:space-between">
                    <input type="color"  id="border-input-color"  oninput="border_element(this)">  
                    <input type="number" style="width: 80px !important"  id="border-input-size" min="1" step="1" max="20" value="0" onchange="border_element(this)">  
                </div>
            </div>
        </div> 
        <div class="text_attributes">
            <div style="display: flex;justify-content:space-between">
                <label for="text-stroke-check">Text Stroke  </label>
                <span><input type="checkbox" class="form-check-input" id="text-stroke-check" onchange="checkbox_activation(this,'text-stroke-div','text-stroke')"></span>
            </div>
            <div id="text-stroke-div" style="display: none"> 
                <div style="display: flex;justify-content:space-between"> 
                    <input style="width:80px" type="number" id="text-stroke-color-size" title="setStroke" value="1" step="1" max="50" min="1"  onkeyup="setStroke()" onchange="setStroke()">
                    <input style="width:80px !important" id="text-stroke-color" type="color" oninput="setStroke()"> 
                </div>
            </div>
        </div> 
        <div>
            <div style="display: flex;justify-content:space-between">
                <label for="radius-check">Radius <small style="color:black"><b id="radius-span"></b></small> </label>
                <span><input type="checkbox" class="form-check-input" id="radius-check" onchange="checkbox_activation(this,'radius-div','radius')"></span>
            </div>
            <div id="radius-div" style="display: none"> 
                <input type="range" class="form-range" id="radius-input" min="1" step="1" max="200" value="1" oninput="radius_element(this)">  
            </div>
        </div> 
        <div class="image_attributes">
            <div style="display: flex;justify-content:space-between">
                <label for="gray-scale-check">GrayScale <small style="color:black"><b id="gray-scale-span"></b></small> </label>
                <span><input type="checkbox" class="form-check-input" id="gray-scale-check" onclick="checkbox_activation(this,'gray-scale-div','gray-scale')"></span>
            </div> 
        </div>
        <div class="image_attributes">
            <div style="display: flex;justify-content:space-between">
                <label for="sepia-check">Sepia <small style="color:black"><b id="sepia-span"></b></small> </label>
                <span><input type="checkbox" class="form-check-input" id="sepia-check" onclick="checkbox_activation(this,'sepia-div','sepia')"></span>
            </div> 
        </div>
        <div >
            <div style="display: flex;justify-content:space-between">
                <label for="shadow-check">Shadow <small style="color:black"><b id="shadow-span"></b></small> </label>
                <span><input type="checkbox" class="form-check-input" id="shadow-check" onchange="checkbox_activation(this,'shadow-div','shadow')"></span>
            </div>
            <div id="shadow-div" style="display: none">   
                <div>
                    <label style="display: flex;justify-content:space-between"> <b>Blur</b> <small style="color:black"><b id="shadow-blur-span">0</b></small> </label>  
                    <input type="range" class="form-range"  id="shadow-input-blur" min="0" step="1" max="50" value="0" oninput="shadow_element(true)">   
                </div>
                <div>
                    <label style="display: flex;justify-content:space-between"> <b>Offset X</b> <small style="color:black"><b id="shadow-offsetx-span">0</b></small> </label>  
                    <input type="range" class="form-range"  id="shadow-input-offsetx" min="0" step="1" max="50" value="0" oninput="shadow_element(true)">   
                </div>
                <div>
                    <label style="display: flex;justify-content:space-between"> <b>Offset Y</b> <small style="color:black"><b id="shadow-offsety-span">0</b></small> </label>  
                    <input type="range" class="form-range"  id="shadow-input-offsety" min="0" step="1" max="50" value="0" oninput="shadow_element(true)">   
                </div>
                <div>
                    <label style="display: flex;justify-content:space-between"> <b>Opacity</b> <small style="color:black"><b id="shadow-opacity-span">1</b></small> </label>  
                    <input type="range" class="form-range"  id="shadow-input-opacity" min="0" step="0.01" max="1.00" value="1.00" oninput="shadow_element(true)">   
                </div>
                <div style="display: flex;justify-content:space-between">
                    <label>Color <small style="color:black"><b id="shadow-color-span"></b></small> </label>  
                    <input type="color"  id="shadow-input-color"  oninput="shadow_element(true)">  
                </div>
            </div>
        </div> 
    </div>
</div>