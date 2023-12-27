@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.setting.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.settings.update', [$setting->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="shapes">Shapes</label>
                    <div class="needsclick dropzone {{ $errors->has('shapes') ? 'is-invalid' : '' }}"
                        id="shapes-dropzone">
                    </div>
                    @if ($errors->has('shapes'))
                        <div class="invalid-feedback">
                            {{ $errors->first('shapes') }}
                        </div>
                    @endif 
                    <span class="help-block">(.svg) only</span>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
            <hr>
            
            <div class="row"> 
                @foreach($setting->shapes as $key => $media)
                    <div class="col-md-2">
                        <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                            <img src="{{ $media->mime_type == 'image/svg+xml' ? $media->getUrl() : $media->getUrl('thumb') }}" width="50" height="50">
                        </a>
                        <a href="{{ route('admin.settings.shape_delete',$media->id) }}" onclick="confirm('are your sure ?')" class="btn btn-danger">delete</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var uploadedShapesMap = {}
        Dropzone.options.shapesDropzone = {
            url: '{{ route('admin.settings.storeMedia') }}',
            maxFilesize: 4, // MB
            acceptedFiles: '.svg',
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 4,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="shapes[]" value="' + response.name + '">')
                uploadedShapesMap[file.name] = response.name
            },
            removedfile: function(file) {
                console.log(file)
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedShapesMap[file.name]
                }
                $('form').find('input[name="shapes[]"][value="' + name + '"]').remove()
            }, 
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script> 
@endsection
