@if($iconscout_images && $iconscout_images->data)
    @foreach ($iconscout_images->data as $key => $image)
        <div class="off-canvas-images off-canvas-iconscout" id="off-canvas-iconscout-{{$image->id}}">
            <img  class="add-to-canvas" src="{{ $image->urls->png_256 }}" alt="" data-src="{{ $image->urls->png_64 }}" data-type="icons" data-id="off-canvas-iconscout-{{$image->id}}"> 
            <div class="overlay-image"></div>
        </div>
    @endforeach
    <input type="hidden" class="next-icon-scout" value="{{ $iconscout_images->next_page_url  ?? '/v3/search'}}">
@endif