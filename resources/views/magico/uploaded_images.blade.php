@auth 
    @foreach (auth()->user()->magico_images as $image) 
        <div class="off-canvas-upload off-canvas-images" id="off-canvas-upload-{{$image->id}}">
            <img class="add-to-canvas"  src="{{ $image->getUrl('preview2')}}" alt="" data-src="{{ $image->getUrl() }}" data-id="off-canvas-upload-{{$image->id}}"> 
            <div class="overlay-image"></div>
        </div> 
    @endforeach
@endauth