
@foreach ($pixabay_images as $key => $image)
    <div class="off-canvas-pixabay off-canvas-images" id="off-canvas-pixabay-{{$image->id}}">
        <img class="add-to-canvas"  src="{{ $image->webformatURL}}" alt="" data-src="{{ $image->largeImageURL }}" data-id="off-canvas-pixabay-{{$image->id}}">
        <div class="photo-by">
            <span>Photo by 
                <a href="{{ $image->pageURL }}" target="_blank">{{ $image->user }}</a> 
                on <a href="https://pixabay.com" target="_blank">Pixaby</a>
            </span>
        </div>
        <div class="overlay-image"></div>
    </div>
@endforeach