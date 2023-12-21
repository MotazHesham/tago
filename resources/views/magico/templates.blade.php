
@foreach ($templates as $key => $template)
    <div class="off-canvas-template off-canvas-images" id="off-canvas-template-{{$template->id}}">
        <img class="add-as-template"  src="{{ $template->photo ? $template->photo->getUrl('preview2') : '' }}" alt="" data-src="{{$template->canvas_pages}}" data-id="off-canvas-template-{{$template->id}}"> 
        <div class="overlay-image"></div>
    </div>
@endforeach