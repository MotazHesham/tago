<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title"> <b>{{ $token }}</b> </h5> 
        <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">x</button>
    </div>
    <div class="modal-body text-center">
        @production
            <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(500)->generate($token)) !!} ">
        @else
            {!! QrCode::size(500)->generate($token) !!}
        @endproduction 
    </div>
</div>