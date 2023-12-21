
<div class="off-canvas-upload off-canvas-images hover-image" id="off-canvas-upload-{{$image->id}}">
    <img class="add-to-canvas"  src="{{ $image->getUrl('preview2')}}" alt="" data-src="{{ $image->getUrl() }}" data-id="off-canvas-upload-{{$image->id}}"> 
    <button class="btn btn-danger btn-sm upload-image-delete-btn" onclick="delete_uploaded_image('{{$image->id}}')" style="position: absolute; right: 0px; top: 0px;opacity: 0;"><i class="fa-thin fa-trash-can-list"></i></button>
    <div class="overlay-image"></div>
</div> 