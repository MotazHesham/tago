
@foreach ($templates as $key => $template)
    <div class="off-canvas-template off-canvas-images hover-image filter {{ $template->type }}" id="off-canvas-template-{{$template->id}}">
        <img class="add-as-template" onclick="add_as_template('{{ $template->id }}')"
            src="{{ $template->photo ? $template->photo->getUrl('preview2') : '' }}" data-price="{{$template->price}}" data-name="{{ $template->name }}"
            id="template-{{ $template->id }}" alt="" data-src="{{$template->canvas_pages}}" data-id="off-canvas-template-{{$template->id}}"> 
        
        @if(auth()->user() && auth()->user()->user_type == 'staff')
            <form action="{{ route('admin.templates.destroy', $template->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;position: absolute; right: 0px; top: 0px;opacity: 0;">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                <button class="btn btn-danger btn-sm template-delete-btn" ><i class="fa-thin fa-trash-can-list"></i></button>
            </form>
        @endif
        <div class="overlay-image"></div>
    </div>
@endforeach