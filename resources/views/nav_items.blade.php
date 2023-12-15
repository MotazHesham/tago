

<div class="common-background" style="display:flex;justify-content:space-between ;color:white;padding:15px">
    <div style="display: flex; align-items: center; ">
        <div>
            <button class="btn btn-custom btn-sm" id="undo" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="UnDo"><i class="fa-solid fa-rotate-left"></i></button>
            <button class="btn btn-custom btn-sm" id="redo" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Redo" disabled><i class="fa-solid fa-rotate-right"></i></button> 
        </div>
        <div>
            <div id="text_attributes" class="text_attributes" style="display: none;align-items: center"> 
                <input  style="display: inline;height:33px;padding:0" type="color" oninput="text_color(this)">
                <select class="form-control" name="" id="" style="display: inline;width:150px !important;padding: 4px 6px;margin:0 10px" onchange="setFontFamily(this)">
                    <option value="Arial" style="font-family: 'Arial'">Arial</option>
                    <option value="Helvetica" style="font-family: 'Helvetica'">Helvetica</option>
                    <option value="Times New Roman" style="font-family: 'Times New Roman'">Times New Roman</option>
                    <option value="Courier New" style="font-family: 'Courier New'">Courier New</option>
                    <option value="Georgia" style="font-family: 'Georgia'">Georgia</option>
                    <option value="Verdana" style="font-family: 'Verdana'">Verdana</option>
                    <option value="Impact" style="font-family: 'Impact'">Impact</option>
                    <option value="Comic Sans MS" style="font-family: 'Comic Sans MS'">Comic Sans MS</option>
                    <option value="Trebuchet MS" style="font-family: 'Trebuchet MS'">Trebuchet MS</option> 
                </select>
                <input class="form-control"  style="display: inline;width:60px;padding: 4px 6px;margin:0 10px" type="number" min="1" value="20" max="500"  onchange="text_size(this)" onkeyup="text_size(this)">
                <button class="btn btn-custom" onclick="toggleBold()"><i class="fa-thin fa-bold"></i></button>
                <button class="btn btn-custom" onclick="toggleItalic()"><i class="fa-thin fa-italic"></i></button>
                <button class="btn btn-custom" onclick="toggleUnderline()"><i class="fa-thin fa-underline"></i></button>  
                <div class="dropdown" style="display: inline">
                    <button type="button" class="btn btn-custom btn-sm " data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                        <i class="fa-thin fa-line-height" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Text Spacing"></i>
                    </button> 
                    <div class="dropdown-menu" style="width: 200px !important;padding:20px 10px">
                        <div style="display: flex;justify-content:space-between">
                            <label for="line-height-check">Line Height  </label>
                            <small style="color:black"><b id="line-height-span">0</b></small>
                        </div>
                        <div id="line-height-div"> 
                            <input type="range" class="form-range" id="line-height-input" min="0" step="0.1" max="10" value="0" oninput="setLineHeight(this)">  
                        </div>
                        <div style="display: flex;justify-content:space-between">
                            <label for="letter-spacing-check">Letter Spacing</label>
                            <small style="color:black"><b id="letter-spacing-span">0</b></small>
                        </div>
                        <div id="letter-spacing-div"> 
                            <input type="range" class="form-range" id="letter-spacing-input" min="-100" step="1" max="500" value="0" oninput="setLetterSpacing(this)">  
                        </div>
                    </div> 
                </div>    
            </div>
            <div id="image_attributes" class="image_attributes" style="display:none"> 
                <div class="dropdown" style="display: inline"> 
                    <button type="button" class="btn btn-custom " data-bs-toggle="dropdown" aria-expanded="false">
                        <span>Flip</span>
                    </button> 
                    <ul class="dropdown-menu" style="padding: 6px;width:215px">
                        <li>
                            <a class="dropdown-item" href="#" onclick="flipHorizontal()">
                                <div><i class="fa-solid fa-arrows-left-right"></i> <b>flipHorizontal</b></div> 
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#" onclick="flipVertical()">
                                <div><i class="fa-solid fa-arrows-up-down"></i> <b>flipVertical</b></div> 
                            </a>
                        </li> 
                    </ul>  
                </div>
                <div style="display: inline">
                    <button type="button" class="btn btn-custom" onclick="fit_page_element()">
                        <i class="fa-thin fa-expand"></i> <span>Fit to page</span>
                    </button> 
                </div>
                <div style="display: inline">
                    <button type="button" class="btn btn-custom" onclick="cropActiveObject()" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Move object after click">
                        <i class="fa-thin fa-crop-simple"></i> <span>Crop</span>
                    </button> 
                </div>  
            </div>
            <div id="effect_attributes" style="display: none">
                @include('effects')
            </div>
        </div>
    </div>
    <div style="display: flex;align-items:center">
        <div> {{-- icons  --}}
            <div class="dropdown" style="display: inline">
                <button type="button" class="btn btn-custom btn-sm" disabled data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" id="nav-positions">
                    <i class="fa-thin fa-layer-group"></i> <span style="font-size: 18px; letter-spacing: 2px;">Positions</span>
                </button>
                <div class="dropdown-menu p-4" style="width: 290px">
                    <div>
                        <p>Layering</p>  
                        <button class="btn btn-custom" onclick="sendBackward()">
                            <span title="sendBackward"><i class="fa-sharp fa-solid fa-chevron-down"></i></span> 
                            Down
                        </button>
                        <button class="btn btn-custom" onclick="bringForward()">
                            <span title="bringForward"><i class="fa-sharp fa-solid fa-chevron-up"></i></span>
                            Up
                        </button> 
                        
                        <button class="btn btn-custom" onclick="sendToBack()">
                            <span title="sendToBack"><i class="fa-sharp fa-solid fa-chevrons-down"></i></span> 
                            <small style="color:black">To Back</small>
                        </button>
                        <button class="btn btn-custom" onclick="bringToFront()">
                            <span title="bringToFront"><i class="fa-sharp fa-solid fa-chevrons-up"></i></span>
                            <small style="color:black">To Forward</small>
                        </button>   
                    </div>
                    <hr>
                    <div>
                        <p>Position</p>  
                        <button class="btn btn-custom" onclick="alignCenter()" title="alignCenter"><i class="fa-light fa-objects-align-center-vertical"></i> <b>Center</b></button>
                        <button class="btn btn-custom" onclick="alignMiddle()" title="alignMiddle"><i class="fa-light fa-distribute-spacing-vertical"></i> <b>Middle</b></button>
                        <button class="btn btn-custom" onclick="alignBottom()" title="alignBottom"><i class="fa-light fa-objects-align-bottom"></i> <b>Bottom</b></button>
                        <button class="btn btn-custom" onclick="alignLeft()" title="alignLeft"><i class="fa-light fa-objects-align-left"></i> <b>Left</b></button>
                        <button class="btn btn-custom" onclick="alignRight()" title="alignRight"><i class="fa-light fa-objects-align-right"></i> <b>Right</b></button>
                        <button class="btn btn-custom" onclick="alignTop()" title="alignTop"><i class="fa-light fa-objects-align-top"></i> <b>Top</b></button>
                    </div>
                </div>
            </div>
            <div class="dropdown" style="display: inline">
                <button type="button" class="btn btn-custom btn-sm" id="nav-transparency" disabled data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                    <i class="fa-thin fa-droplet" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Transparency"></i>
                </button> 
                <div class="dropdown-menu" style="width: 200px !important;padding:20px 10px">
                    <div style="display: flex;justify-content:space-between">
                        <label for="transparency-check">Transparency  </label>
                        <small style="color:black"><b id="transparency-span">1.00</b></small>
                    </div>
                    <div id="transparency-div"> 
                        <input type="range" class="form-range" id="transparency-input" min="0" step="0.01" max="1.00" value="1.00" oninput="transperancy_element(this)">  
                    </div>
                </div> 
            </div> 
            <button class="btn btn-custom btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" id="nav-lock" data-bs-title="Lock elemnt" onclick="lock_element()" disabled><i class="fa-thin fa-lock"></i></button>
            <button class="btn btn-custom btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" id="nav-duplicate" data-bs-title="Duplicate element" onclick="duplicate_element()" disabled><i class="fa-thin fa-copy"></i></button>
            <button class="btn btn-custom btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" id="nav-delete" data-bs-title="Remove element" onclick="delete_element()" disabled><i class="fa-thin fa-trash-can-list"></i></button>
        </div>
        <div style="border-left: 2px solid rgb(68, 67, 67); height: 40px;"></div>
        <div>
            <button class="btn btn-custom btn-small" onclick="download()"><small><i class="fa-thin fa-cloud-arrow-down"></i> Download</small></button>
        </div> 
    </div>
</div> 