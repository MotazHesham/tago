@extends('layouts.company')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.userLink.title') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('company.user-links.update_all') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="form-group col-md-4">
                        <label class="required" for="main_link_id">{{ trans('cruds.userLink.fields.main_link') }}</label>
                        <select class="form-control select2 {{ $errors->has('main_link') ? 'is-invalid' : '' }}"
                            name="main_link_id" id="main_link_id" required>
                            @foreach ($main_links as $id => $entry)
                                <option value="{{ $id }}">
                                    {{ $entry }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('main_link'))
                            <div class="invalid-feedback">
                                {{ $errors->first('main_link') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.userLink.fields.main_link_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="name">{{ trans('cruds.userLink.fields.name') }}</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                            name="name" id="name" value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.userLink.fields.name_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="link">{{ trans('cruds.userLink.fields.link') }}</label>
                        <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text"
                            name="link" id="link" value="{{ old('link') }}">
                        @if ($errors->has('link'))
                            <div class="invalid-feedback">
                                {{ $errors->first('link') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.userLink.fields.link_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="priority">{{ trans('cruds.userLink.fields.priority') }}</label>
                        <input class="form-control {{ $errors->has('priority') ? 'is-invalid' : '' }}" type="text"
                            name="priority" id="priority" value="{{ old('priority') }}">
                        @if ($errors->has('priority'))
                            <div class="invalid-feedback">
                                {{ $errors->first('priority') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.userLink.fields.priority_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="photo">{{ trans('cruds.userLink.fields.photo') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}"
                            id="photo-dropzone">
                        </div>
                        @if ($errors->has('photo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('photo') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.userLink.fields.photo_helper') }}</span>
                    </div> 
                    <div class="form-group col-md-4">
                        <label>{{ trans('cruds.userLink.fields.active') }}</label>
                        <select class="form-control {{ $errors->has('active') ? 'is-invalid' : '' }}" name="active" id="active">
                            <option value="">{{ trans('global.pleaseSelect') }}</option>
                            @foreach(App\Models\User::ACTIVE_SELECT as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('active'))
                            <div class="invalid-feedback">
                                {{ $errors->first('active') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.userLink.fields.active_helper') }}</span>
                    </div>  
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        Dropzone.options.photoDropzone = {
            url: '{{ route('company.storeMedia') }}',
            maxFilesize: 2, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').find('input[name="photo"]').remove()
                $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="photo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
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
