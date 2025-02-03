@extends('layouts.company')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.user.title') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('company.customers.update_all') }}" enctype="multipart/form-data"> 
                @csrf
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="phone_number">{{ trans('cruds.user.fields.phone_number') }}</label>
                        <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="text"
                            name="phone_number" id="phone_number" value="{{ old('phone_number') }}">
                        @if ($errors->has('phone_number'))
                            <div class="invalid-feedback">
                                {{ $errors->first('phone_number') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.phone_number_helper') }}</span>
                    </div> 
                    <div class="form-group col-md-4">
                        <label for="bio">{{ trans('cruds.user.fields.bio') }}</label>
                        <input class="form-control {{ $errors->has('bio') ? 'is-invalid' : '' }}" type="text" name="bio"
                            id="bio" value="{{ old('bio') }}">
                        @if ($errors->has('bio'))
                            <div class="invalid-feedback">
                                {{ $errors->first('bio') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.bio_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="password">{{ trans('cruds.user.fields.password') }}</label>
                        <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                            name="password" id="password">
                        @if ($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                    </div> 
                    
                    <div class="form-group col-md-4">
                        <label>{{ trans('cruds.user.fields.email_active') }}</label>
                        <select class="form-control {{ $errors->has('email_active') ? 'is-invalid' : '' }}" name="email_active" id="email_active">
                            <option value="">{{ trans('global.pleaseSelect') }}</option>
                            @foreach(App\Models\User::ACTIVE_SELECT as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('email_active'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email_active') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.email_active_helper') }}</span>
                    </div> 
                    <div class="form-group col-md-4">
                        <label>{{ trans('cruds.user.fields.nickname_active') }}</label>
                        <select class="form-control {{ $errors->has('nickname_active') ? 'is-invalid' : '' }}" name="nickname_active" id="nickname_active">
                            <option value="">{{ trans('global.pleaseSelect') }}</option>
                            @foreach(App\Models\User::ACTIVE_SELECT as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('nickname_active'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nickname_active') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.nickname_active_helper') }}</span>
                    </div>  
                    <div class="form-group col-md-4">
                        <label>{{ trans('cruds.user.fields.bio_active') }}</label>
                        <select class="form-control {{ $errors->has('bio_active') ? 'is-invalid' : '' }}" name="bio_active" id="bio_active">
                            <option value="">{{ trans('global.pleaseSelect') }}</option>
                            @foreach(App\Models\User::ACTIVE_SELECT as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('bio_active'))
                            <div class="invalid-feedback">
                                {{ $errors->first('bio_active') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.bio_active_helper') }}</span>
                    </div>   
                    <div class="form-group col-md-6">
                        <label for="photo">{{ trans('cruds.user.fields.photo') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                        </div>
                        @if ($errors->has('photo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('photo') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.photo_helper') }}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="cover">{{ trans('cruds.user.fields.cover') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('cover') ? 'is-invalid' : '' }}" id="cover-dropzone">
                        </div>
                        @if ($errors->has('cover'))
                            <div class="invalid-feedback">
                                {{ $errors->first('cover') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.cover_helper') }}</span>
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
    <script>
        Dropzone.options.coverDropzone = {
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
                $('form').find('input[name="cover"]').remove()
                $('form').append('<input type="hidden" name="cover" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="cover"]').remove()
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
