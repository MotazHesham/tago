


<div id="image-spinner" class="spinner-border text-success" role="status" style="">
    <span class="visually-hidden">Loading...</span>
</div>

{{-- Pixbay --}}
<div class="offcanvas offcanvas-bottom" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1" id="offcanvasPixabay" aria-labelledby="offcanvasPixabayLabel">
    <div class="offcanvas-header common-background">
        <h5 class="offcanvas-title" id="offcanvasPixabayLabel" style="color:white"> 
            Pixabay
        </h5> 
        <div style="display: inline">
            <input type="text" class="form-control" id="search-pixabay" placeholder="Search...">
            <button class="btn btn-dark" onclick="pixabay_loading_images()">Search</button> 
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body container-scrollable-y common-background" id="offcanvas-pixabay" style="display:flex">   
        @include('magico.pixabay_images') 
    </div>
</div>

{{--  Unsplash --}}
<div class="offcanvas offcanvas-bottom" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1" id="offcanvasUnsplash" aria-labelledby="offcanvasUnsplashLabel">
    <div class="offcanvas-header common-background" >
        <h5 class="offcanvas-title" id="offcanvasUnsplashLabel" style="color:white"> 
            UnSplash
        </h5>
        <div style="display: inline">
            <input type="text" class="form-control" id="search-unsplash" placeholder="Search...">
            <button class="btn btn-dark" onclick="unsplash_query_images()">Search</button> 
        </div>
        <small>
            Photos By <a href="https://unsplash.com" style="color:black" target="_blanc">Unsplash</a>
        </small>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body container-scrollable-y common-background" id="offcanvas-unsplash" style="display:flex">   
        @include('magico.unsplash_images')  
    </div>
</div>

<div class="offcanvas offcanvas-bottom" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1" id="offcanvasText" aria-labelledby="offcanvasTextLabel">
    <div class="offcanvas-header common-background"  >
        <h5 class="offcanvas-title" id="offcanvasTextLabel" style="color:white">Text</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body container-scrollable-y common-background" id="offcanvas-text" style="display:flex">   
        <span onclick="add_text()">add text</span>
    </div>
</div>

{{-- Shapes --}}
<div class="offcanvas offcanvas-bottom" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1" id="offcanvasShapes" aria-labelledby="offcanvasShapesLabel">
    <div class="offcanvas-header common-background" >
        <h5 class="offcanvas-title" id="offcanvasShapesLabel" style="color:white">Shapes</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body container-scrollable-y common-background" style="display:flex" id="offcanvas-shapes">    
        <div>  
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/1.svg') }}" data-src="{{ asset('fabric/shapes/1.svg') }}">
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/20.svg') }}" data-src="{{ asset('fabric/shapes/20.svg') }}">
        </div>  
        <div>  
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/3.svg') }}" data-src="{{ asset('fabric/shapes/3.svg') }}">
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/21.svg') }}" data-src="{{ asset('fabric/shapes/21.svg') }}">
        </div>  
        <div>  
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/4.svg') }}" data-src="{{ asset('fabric/shapes/4.svg') }}">
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/22.svg') }}" data-src="{{ asset('fabric/shapes/22.svg') }}">
        </div>  
        <div>  
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/5.svg') }}" data-src="{{ asset('fabric/shapes/5.svg') }}">
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/23.svg') }}" data-src="{{ asset('fabric/shapes/23.svg') }}">
        </div>  
        <div>  
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/6.svg') }}" data-src="{{ asset('fabric/shapes/6.svg') }}">
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/24.svg') }}" data-src="{{ asset('fabric/shapes/24.svg') }}">
        </div>  
        <div>  
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/7.svg') }}" data-src="{{ asset('fabric/shapes/7.svg') }}">
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/25.svg') }}" data-src="{{ asset('fabric/shapes/25.svg') }}">
        </div>  
        <div>  
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/8.svg') }}" data-src="{{ asset('fabric/shapes/8.svg') }}">
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/26.svg') }}" data-src="{{ asset('fabric/shapes/26.svg') }}">
        </div>  
        <div>  
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/9.svg') }}" data-src="{{ asset('fabric/shapes/9.svg') }}">
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/27.svg') }}" data-src="{{ asset('fabric/shapes/27.svg') }}">
        </div>  
        <div>  
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/10.svg') }}" data-src="{{ asset('fabric/shapes/10.svg') }}">
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/28.svg') }}" data-src="{{ asset('fabric/shapes/28.svg') }}">
        </div>  
        <div>  
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/11.svg') }}" data-src="{{ asset('fabric/shapes/11.svg') }}">
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/29.svg') }}" data-src="{{ asset('fabric/shapes/29.svg') }}">
        </div>  
        <div>  
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/12.svg') }}" data-src="{{ asset('fabric/shapes/12.svg') }}">
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/30.svg') }}" data-src="{{ asset('fabric/shapes/30.svg') }}">
        </div>  
        <div>  
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/13.svg') }}" data-src="{{ asset('fabric/shapes/13.svg') }}">
        </div>  
        <div>  
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/14.svg') }}" data-src="{{ asset('fabric/shapes/14.svg') }}">
        </div>  
        <div>  
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/15.svg') }}" data-src="{{ asset('fabric/shapes/15.svg') }}">
        </div>  
        <div>  
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/2.svg') }}" data-src="{{ asset('fabric/shapes/2.svg') }}">
        </div>  
        <div>  
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/16.svg') }}" data-src="{{ asset('fabric/shapes/16.svg') }}">
        </div>  
        <div>  
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/17.svg') }}" data-src="{{ asset('fabric/shapes/17.svg') }}">
        </div>  
        <div>  
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/18.svg') }}" data-src="{{ asset('fabric/shapes/18.svg') }}">
        </div>  
        <div>  
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/19.svg') }}" data-src="{{ asset('fabric/shapes/19.svg') }}">
        </div>  
    </div>
</div>

{{-- Layers --}}
<div class="offcanvas offcanvas-bottom" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1" id="offcanvasLayers" aria-labelledby="offcanvasLayersLabel">
    <div class="offcanvas-header common-background" >
        <h5 class="offcanvas-title" id="offcanvasLayersLabel" style="color:white">Layers </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body container-scrollable-y common-background" id="offcanvas-layers" style="overflow-y:scroll ">   
        <ul class="list-group list-group-horizontal"  style="display: flex;align-items: center;flex-wrap: wrap;align-content: flex-start;" id="demo1"> 
        </ul> 
    </div>
</div>

{{-- Draw --}}
{{-- <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasDraw" aria-labelledby="offcanvasDrawLabel" style="width:200px">
    <div class="offcanvas-header common-background"  >
        <h5 class="offcanvas-title" id="offcanvasDrawLabel" style="color:white">Draw</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body container-scrollable-y common-background" id="offcanvas-draw" style="display:flex">   

    </div>
</div> --}}