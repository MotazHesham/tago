
@foreach ($unsplash_images as $key => $image)
    <div class="off-canvas-images off-canvas-unsplash" id="off-canvas-unsplash-{{$image->id}}">
        <img  src="{{ $image->urls->thumb }}" alt="" data-src="{{ $image->urls->small_s3 }}" data-id="off-canvas-unsplash-{{$image->id}}">
        <div class="photo-by">
            <span>Photo by 
                <a href="{{ $image->user->links->self}}?utm_source=tago&amp;utm_medium=referral" target="_blank">{{ $image->user->name }}</a> 
                on <a href="https://unsplash.com/?utm_source=tago&amp;utm_medium=referral" target="_blank">Unsplash</a>
            </span>
        </div>
        <div class="overlay-image"></div>
    </div>
@endforeach