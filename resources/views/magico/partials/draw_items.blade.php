
<div class="common-background"  id="drawer-menu" >
    <div style="display: flex;align-items:center"> 
        <div><img src="{{ asset('fabric/shapes/pencil-1.svg') }}" id="drawer-item-pencil-1" onclick="active_draw_with_width('1','drawer-item-pencil-1')" alt="" style=""></div> 
        <div><img src="{{ asset('fabric/shapes/pencil-2.svg') }}" id="drawer-item-pencil-2" onclick="active_draw_with_width('4','drawer-item-pencil-2')" alt="" style=""></div>  
        <div><img src="{{ asset('fabric/shapes/pencil-3.svg') }}" id="drawer-item-pencil-3" onclick="active_draw_with_width('12','drawer-item-pencil-3')" alt="" style=""></div>  
        <div style="margin-bottom: 32px;padding:0 25px 0 0">
            <button class="btn btn-custom" id="drawing-mode" >
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="m3.515 3.515 7.07 16.97 2.51-7.39 7.39-2.51-16.97-7.07Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            </button>
        </div>   
        <div>
            <div style="margin-bottom: 32px" class=""><input type="color" name="drawing-color" id="drawing-color" style="height:33px;padding:0"> </div>
        </div>
        <div style="margin-bottom: 32px;padding:0 20px"> 
            <button type="button" class="btn btn-custom btn-sm" data-bs-toggle="dropdown" aria-expanded="false" >
                <i class="fa-solid fa-list-ul"></i>
            </button> 
            <div class="dropdown-menu" style="width: 200px !important;padding:20px 10px">
                <div style="display: flex;justify-content:space-between">
                    <label>Draw Line Width </label>
                    <small style="color:black"><b id="draw-line-width-span">1.00</b></small>
                </div>
                <div> 
                    <input type="range" name="drawing-line-width" id="drawing-line-width" value="1">
                </div>
            </div> 
        </div>
        <div style="margin-bottom: 32px;padding:0 20px">  
            <button type="button" class="btn-close" onclick="drawer_menu('hide')" aria-label="Close"></button> 
        </div>
    </div>
</div> 