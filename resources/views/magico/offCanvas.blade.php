<div id="image-spinner" class="spinner-border text-success" role="status" style="">
    <span class="visually-hidden">Loading...</span>
</div>

{{-- Templates --}}
<div class="offcanvas offcanvas-bottom" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1" id="offcanvasTemplates"
    aria-labelledby="offcanvasTemplatesLabel">
    <div class="offcanvas-header common-background">
        <h5 class="offcanvas-title" id="offcanvasTemplatesLabel" style="color:white">
            Templates 
        </h5>
        <div> 
            <button class="btn btn-outline-light filter-button" type="button" data-filter="all">
                All
            </button>
            @foreach(\App\Models\Template::TYPE_SELECT as $key => $value)
                <button class="btn btn-outline-light filter-button" type="button" data-filter="{{$key}}">
                    {{ $value }}
                </button> 
            @endforeach
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body container-scrollable-y common-background" id="offcanvas-templates" style="display:flex">
        @include('magico.templates')
    </div>
</div>


{{-- Pixbay --}}
<div class="offcanvas offcanvas-bottom" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1"
    id="offcanvasPixabay" aria-labelledby="offcanvasPixabayLabel">
    <div class="offcanvas-header common-background">
        <h5 class="offcanvas-title" id="offcanvasPixabayLabel" style="color:white">
            Pixabay
        </h5>
        <div style="display: inline">
            <input type="text" class="form-control" id="search-pixabay" placeholder="Search...">
            <button class="btn btn-dark" onclick="pixabay_loading_images()">Search</button>
        </div>
        <small>
            Photos By <a href="https://pixabay.com" style="color:black" target="_blanc">Pixabay</a>
        </small>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body container-scrollable-y common-background" id="offcanvas-pixabay" style="display:flex">
        @include('magico.pixabay_images')
    </div>
</div>

{{-- IconScout --}}
<div class="offcanvas offcanvas-bottom" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1"
    id="offcanvasiconscout" aria-labelledby="offcanvasiconscoutLabel">
    <div class="offcanvas-header common-background">
        <h5 class="offcanvas-title" id="offcanvasiconscoutLabel" style="color:white">
            IconScout
        </h5>
        <div style="display: inline">
            <input type="text" class="form-control" id="search-iconscout" placeholder="Search...">
            <button class="btn btn-dark" onclick="iconscout_loading_images()">Search</button>
        </div>
        <small>
            Icons By <a href="https://iconscout.com" style="color:black" target="_blanc">IconScout</a>
        </small>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body container-scrollable-y common-background" id="offcanvas-iconscout"
        style="display:flex">
        @include('magico.iconscout_images')
    </div>
</div>

{{--  Unsplash --}}
<div class="offcanvas offcanvas-bottom" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1"
    id="offcanvasUnsplash" aria-labelledby="offcanvasUnsplashLabel">
    <div class="offcanvas-header common-background">
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
    <div class="offcanvas-body container-scrollable-y common-background" id="offcanvas-unsplash"
        style="display:flex">
        @include('magico.unsplash_images')
    </div>
</div>

{{-- Text --}}
<div class="offcanvas offcanvas-bottom" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1"
    id="offcanvasText" aria-labelledby="offcanvasTextLabel">
    <div class="offcanvas-header common-background">
        <h5 class="offcanvas-title" id="offcanvasTextLabel" style="color:white">Text</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body container-scrollable-y common-background" id="offcanvas-text"
        style="display:flex;justify-content:space-between;color:white;gap:3%">
        <div style="min-width: fit-content">
            <h3 onclick="add_text('Create Header',28)" style="padding:5px;cursor: pointer;">Create Header</h3>
            <h4 onclick="add_text('Create Header',24)" style="padding:5px;cursor: pointer;">Create Header</h4>
            <h5 onclick="add_text('Create Header',20)" style="padding:5px;cursor: pointer;">Create Header</h5>
        </div>
        <div onclick="add_text_box('text-box-1')" id="text-box-1" class="textbox-div">
            “The Best Way To Get Started Is To
            Quit Talking And Begin Doing.”

            - Walt Disney
        </div>
        <div onclick="add_text_box('text-box-2')" id="text-box-2" class="textbox-div">
            “The Pessimist Sees Difficulty In Every Opportunity. The
            Optimist Sees OpportunityIn Every Difficulty.”

            - Winston Churchill
        </div>
        <div onclick="add_text_box('text-box-3')" id="text-box-3" class="textbox-div">
            Two roads diverged in a wood, and I,
            I took the one less travelled by,
            and that has made all the difference.

            - Robert Frost
        </div>
        <div onclick="add_text_box('text-box-4')" id="text-box-4" class="textbox-div">
            You can fool all of the people some of the time,
            and some of the people all of the time,
            but you can't fool all of the people all of the time.

            - Abraham Lincoln
        </div>
        <div onclick="add_text_box('text-box-5')" id="text-box-5" class="textbox-div">
            “if you can dream
            it, you can do it.”

            - Walt Disney
        </div>
    </div>
</div>

{{-- Shapes --}}
<div class="offcanvas offcanvas-bottom" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1"
    id="offcanvasShapes" aria-labelledby="offcanvasShapesLabel">
    <div class="offcanvas-header common-background">
        <h5 class="offcanvas-title" id="offcanvasShapesLabel" style="color:white">Shapes</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body container-scrollable-y common-background" style="display:flex" id="offcanvas-shapes">
        <div>
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/1.svg') }}"
                data-src="{{ asset('fabric/shapes/1.svg') }}">
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/20.svg') }}"
                data-src="{{ asset('fabric/shapes/20.svg') }}">
        </div>
        <div>
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/3.svg') }}"
                data-src="{{ asset('fabric/shapes/3.svg') }}">
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/21.svg') }}"
                data-src="{{ asset('fabric/shapes/21.svg') }}">
        </div>
        <div>
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/4.svg') }}"
                data-src="{{ asset('fabric/shapes/4.svg') }}">
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/22.svg') }}"
                data-src="{{ asset('fabric/shapes/22.svg') }}">
        </div>
        <div>
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/5.svg') }}"
                data-src="{{ asset('fabric/shapes/5.svg') }}">
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/23.svg') }}"
                data-src="{{ asset('fabric/shapes/23.svg') }}">
        </div>
        <div>
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/6.svg') }}"
                data-src="{{ asset('fabric/shapes/6.svg') }}">
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/24.svg') }}"
                data-src="{{ asset('fabric/shapes/24.svg') }}">
        </div>
        <div>
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/7.svg') }}"
                data-src="{{ asset('fabric/shapes/7.svg') }}">
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/25.svg') }}"
                data-src="{{ asset('fabric/shapes/25.svg') }}">
        </div>
        <div>
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/8.svg') }}"
                data-src="{{ asset('fabric/shapes/8.svg') }}">
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/26.svg') }}"
                data-src="{{ asset('fabric/shapes/26.svg') }}">
        </div>
        <div>
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/9.svg') }}"
                data-src="{{ asset('fabric/shapes/9.svg') }}">
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/27.svg') }}"
                data-src="{{ asset('fabric/shapes/27.svg') }}">
        </div>
        <div>
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/10.svg') }}"
                data-src="{{ asset('fabric/shapes/10.svg') }}">
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/28.svg') }}"
                data-src="{{ asset('fabric/shapes/28.svg') }}">
        </div>
        <div>
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/11.svg') }}"
                data-src="{{ asset('fabric/shapes/11.svg') }}">
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/29.svg') }}"
                data-src="{{ asset('fabric/shapes/29.svg') }}">
        </div>
        <div>
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/12.svg') }}"
                data-src="{{ asset('fabric/shapes/12.svg') }}">
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/30.svg') }}"
                data-src="{{ asset('fabric/shapes/30.svg') }}">
        </div>
        <div>
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/13.svg') }}"
                data-src="{{ asset('fabric/shapes/13.svg') }}">
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/alien.svg') }}"
                data-src="{{ asset('fabric/shapes/alien.svg') }}">
        </div>
        <div>
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/14.svg') }}"
                data-src="{{ asset('fabric/shapes/14.svg') }}">
        </div>
        <div>
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/15.svg') }}"
                data-src="{{ asset('fabric/shapes/15.svg') }}">
        </div>
        <div>
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/2.svg') }}"
                data-src="{{ asset('fabric/shapes/2.svg') }}">
        </div>
        <div>
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/16.svg') }}"
                data-src="{{ asset('fabric/shapes/16.svg') }}">
        </div>
        <div>
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/17.svg') }}"
                data-src="{{ asset('fabric/shapes/17.svg') }}">
        </div>
        <div>
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/18.svg') }}"
                data-src="{{ asset('fabric/shapes/18.svg') }}">
        </div>
        <div>
            <img class="add-to-canvas" src="{{ asset('fabric/shapes/19.svg') }}"
                data-src="{{ asset('fabric/shapes/19.svg') }}">
        </div>
    </div>
</div>

{{-- Layers --}}
<div class="offcanvas offcanvas-bottom" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1"
    id="offcanvasLayers" aria-labelledby="offcanvasLayersLabel">
    <div class="offcanvas-header common-background">
        <h5 class="offcanvas-title" id="offcanvasLayersLabel" style="color:white">Layers </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body container-scrollable-y common-background" id="offcanvas-layers"
        style="overflow-y:scroll ">
        <ul class="list-group list-group-horizontal"
            style="display: flex;align-items: center;flex-wrap: wrap;align-content: flex-start;" id="demo1">
        </ul>
    </div>
</div>

{{-- Upload --}}
<div class="offcanvas offcanvas-bottom" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1"
    id="offcanvasUpload" aria-labelledby="offcanvasUploadLabel">
    <div class="offcanvas-header common-background">
        <h5 class="offcanvas-title" id="offcanvasUploadLabel" style="color:white">Upload </h5>
        <div style="display: inline">
            <form action="{{ route('frontend.upload_magico_images') }}" method="POST" enctype="multipart/form-data"
                id="form-upload-image">
                @csrf
                <input type="file" name="image" class="form-control" style="width:300px">
                @auth
                    <button class="btn btn-dark" type="submit">Upload</button>
                @else
                    <a class="btn btn-dark" href="{{ route('login') }}">Upload</a>
                @endauth
            </form>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body container-scrollable-y common-background" id="offcanvas-upload" style="display:flex">
        @auth
            @foreach (auth()->user()->magico_images as $image)
                @include('magico.uploaded_images')
            @endforeach
        @endauth
    </div>
</div>
