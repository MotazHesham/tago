

<div class="offcanvas offcanvas-bottom" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1" id="offcanvasImages" aria-labelledby="offcanvasImagesLabel">
    <div class="offcanvas-header" style="background:#383e47a3">
        <h5 class="offcanvas-title" id="offcanvasImagesLabel" style="color:white">Images</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body container-scrollable-y" id="offcanvas-body" style="background: #383e47;display:flex">  
        <div style="min-width: fit-content;position:relative">
            <img style="border-radius: 12px;padding:4px" src="{{ asset('tmp_images/1.jpeg') }}" alt="" data-src="{{ asset('tmp_images/1.jpeg') }}"> 
        </div>
        <div style="min-width: fit-content">
            <img style="border-radius: 12px;padding:4px" src="{{ asset('tmp_images/2.jpeg') }}" alt="" data-src="{{ asset('tmp_images/2.jpeg') }}">
        </div>
        <div style="min-width: fit-content">
            <img style="border-radius: 12px;padding:4px" src="{{ asset('tmp_images/3.jpeg') }}" alt="" data-src="{{ asset('tmp_images/3.jpeg') }}">
        </div>
        <div style="min-width: fit-content">
            <img style="border-radius: 12px;padding:4px" src="{{ asset('tmp_images/5.jpeg') }}" alt="" data-src="{{ asset('tmp_images/5.jpeg') }}">
        </div>
        @foreach ($photos as $key => $photo)
            <div style="min-width: fit-content;position: relative;" id="off-canvas-images-{{$key}}">
                <img style="border-radius: 12px;padding:4px" src="{{ $photo->urls->thumb }}" alt="" data-src="{{ $photo->urls->small_s3 }}" data-id="off-canvas-images-{{$key}}">
                <div style=" position: absolute;
                top: 0;
                margin: 4px;
                border-radius: 6px;
                height: -webkit-fill-available;
                width: -webkit-fill-available;
                background: #0000009e;display:none"></div>
            </div>
        @endforeach  
        @foreach ($photos as $key => $photo)
            <div style="min-width: fit-content;position: relative;" id="off-canvas-images2-{{$key}}">
                <img style="border-radius: 12px;padding:4px" src="{{ $photo->urls->thumb }}" alt="" data-src="{{ $photo->urls->small_s3 }}" data-id="off-canvas-images2-{{$key}}">
                <div style=" position: absolute;
                top: 0;
                margin: 4px;
                border-radius: 6px;
                height: -webkit-fill-available;
                width: -webkit-fill-available;
                background: #0000009e;display:none"></div>
            </div>
        @endforeach  
        <div id="image-spinner" class="spinner-border text-success" role="status" style="position: absolute; top: 45%; left: 45%;display:none">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>
<div class="offcanvas offcanvas-bottom" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1" id="offcanvasText" aria-labelledby="offcanvasTextLabel">
    <div class="offcanvas-header" style="background:#383e47a3">
        <h5 class="offcanvas-title" id="offcanvasTextLabel" style="color:white">Text</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body container-scrollable-y" id="offcanvas-body" style="background: #383e47;display:flex">   
        <span onclick="add_text()">add text</span>
    </div>
</div>
