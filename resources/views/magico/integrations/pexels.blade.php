@if($pexels_images && $pexels_images->photos)
    @foreach ($pexels_images->photos as $key => $image)
        <div class="off-canvas-images" id="off-canvas-pexels-{{$image->id}}">
            <img  class="add-to-canvas" src="{{ $image->src->medium }}" alt="" data-src="{{ $image->src->large2x }}"  data-id="off-canvas-pexels-{{$image->id}}"> 
            <div class="photo-by">
                <span>Photo by 
                    <a href="{{ $image->photographer_url }}" target="_blank">{{ $image->photographer }}</a> 
                    on <a href="https://www.pexels.com" target="_blank">Pexels</a>
                </span>
            </div>
            <div class="overlay-image"></div>
        </div>
    @endforeach
    <input type="hidden" class="next-pexels" value="{{ $pexels_images->next_page  ?? 'https://api.pexels.com/v1/curated?per_page=40'}}">
@endif