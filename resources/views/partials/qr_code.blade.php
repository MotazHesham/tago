<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Menu QrCode</h5> 
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body text-center">
        @production
            <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(500)->generate($id)) !!} ">
        @else
            {!! QrCode::size(500)->generate($id) !!}
        @endproduction
    </div>
</div>