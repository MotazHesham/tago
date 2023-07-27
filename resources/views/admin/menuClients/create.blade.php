@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.menuClient.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.menu-clients.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="form-group col-md-4">
                        <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                            name="name" id="name" value="{{ old('name', '') }}" required>
                        @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                            name="email" id="email" value="{{ old('email') }}" required>
                        @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="phone_number">{{ trans('cruds.user.fields.phone_number') }}</label>
                        <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="text"
                            name="phone_number" id="phone_number" value="{{ old('phone_number', '') }}">
                        @if ($errors->has('phone_number'))
                            <div class="invalid-feedback">
                                {{ $errors->first('phone_number') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.phone_number_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                        <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                            name="password" id="password" required>
                        @if ($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="facebook">{{ trans('cruds.menuClient.fields.facebook') }}</label>
                        <input class="form-control {{ $errors->has('facebook') ? 'is-invalid' : '' }}" type="text"
                            name="facebook" id="facebook" value="{{ old('facebook', '') }}">
                        @if ($errors->has('facebook'))
                            <div class="invalid-feedback">
                                {{ $errors->first('facebook') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.menuClient.fields.facebook_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="twitter">{{ trans('cruds.menuClient.fields.twitter') }}</label>
                        <input class="form-control {{ $errors->has('twitter') ? 'is-invalid' : '' }}" type="text"
                            name="twitter" id="twitter" value="{{ old('twitter', '') }}">
                        @if ($errors->has('twitter'))
                            <div class="invalid-feedback">
                                {{ $errors->first('twitter') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.menuClient.fields.twitter_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="google">{{ trans('cruds.menuClient.fields.google') }}</label>
                        <input class="form-control {{ $errors->has('google') ? 'is-invalid' : '' }}" type="text"
                            name="google" id="google" value="{{ old('google', '') }}">
                        @if ($errors->has('google'))
                            <div class="invalid-feedback">
                                {{ $errors->first('google') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.menuClient.fields.google_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="linkedin">{{ trans('cruds.menuClient.fields.linkedin') }}</label>
                        <input class="form-control {{ $errors->has('linkedin') ? 'is-invalid' : '' }}" type="text"
                            name="linkedin" id="linkedin" value="{{ old('linkedin', '') }}">
                        @if ($errors->has('linkedin'))
                            <div class="invalid-feedback">
                                {{ $errors->first('linkedin') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.menuClient.fields.linkedin_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="tiktok">{{ trans('cruds.menuClient.fields.tiktok') }}</label>
                        <input class="form-control {{ $errors->has('tiktok') ? 'is-invalid' : '' }}" type="text"
                            name="tiktok" id="tiktok" value="{{ old('tiktok', '') }}">
                        @if ($errors->has('tiktok'))
                            <div class="invalid-feedback">
                                {{ $errors->first('tiktok') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.menuClient.fields.tiktok_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="youtube">{{ trans('cruds.menuClient.fields.youtube') }}</label>
                        <input class="form-control {{ $errors->has('youtube') ? 'is-invalid' : '' }}" type="text"
                            name="youtube" id="youtube" value="{{ old('youtube', '') }}">
                        @if ($errors->has('youtube'))
                            <div class="invalid-feedback">
                                {{ $errors->first('youtube') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.menuClient.fields.youtube_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="instagram">{{ trans('cruds.menuClient.fields.instagram') }}</label>
                        <input class="form-control {{ $errors->has('instagram') ? 'is-invalid' : '' }}" type="text"
                            name="instagram" id="instagram" value="{{ old('instagram', '') }}">
                        @if ($errors->has('instagram'))
                            <div class="invalid-feedback">
                                {{ $errors->first('instagram') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.menuClient.fields.instagram_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="whatsapp">{{ trans('cruds.menuClient.fields.whatsapp') }}</label>
                        <input class="form-control {{ $errors->has('whatsapp') ? 'is-invalid' : '' }}" type="text"
                            name="whatsapp" id="whatsapp" value="{{ old('whatsapp', '') }}">
                        @if ($errors->has('whatsapp'))
                            <div class="invalid-feedback">
                                {{ $errors->first('whatsapp') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.menuClient.fields.whatsapp_helper') }}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="logo">{{ trans('cruds.menuClient.fields.logo') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('logo') ? 'is-invalid' : '' }}" id="logo-dropzone">
                        </div>
                        @if ($errors->has('logo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('logo') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.menuClient.fields.logo_helper') }}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="about_us">{{ trans('cruds.menuClient.fields.about_us') }}</label>
                        <textarea class="form-control ckeditor {{ $errors->has('about_us') ? 'is-invalid' : '' }}" name="about_us"
                            id="about_us">{!! old('about_us') !!}</textarea>
                        @if ($errors->has('about_us'))
                            <div class="invalid-feedback">
                                {{ $errors->first('about_us') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.menuClient.fields.about_us_helper') }}</span>
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
        Dropzone.options.logoDropzone = {
            url: '{{ route('admin.menu-clients.storeMedia') }}',
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
                $('form').find('input[name="logo"]').remove()
                $('form').append('<input type="hidden" name="logo" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="logo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($menuClient) && $menuClient->logo)
                    var file = {!! json_encode($menuClient->logo) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="logo" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
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
        $(document).ready(function() {
            function SimpleUploadAdapter(editor) {
                editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
                    return {
                        upload: function() {
                            return loader.file
                                .then(function(file) {
                                    return new Promise(function(resolve, reject) {
                                        // Init request
                                        var xhr = new XMLHttpRequest();
                                        xhr.open('POST',
                                            '{{ route('admin.menu-clients.storeCKEditorImages') }}',
                                            true);
                                        xhr.setRequestHeader('x-csrf-token', window._token);
                                        xhr.setRequestHeader('Accept', 'application/json');
                                        xhr.responseType = 'json';

                                        // Init listeners
                                        var genericErrorText =
                                            `Couldn't upload file: ${ file.name }.`;
                                        xhr.addEventListener('error', function() {
                                            reject(genericErrorText)
                                        });
                                        xhr.addEventListener('abort', function() {
                                            reject()
                                        });
                                        xhr.addEventListener('load', function() {
                                            var response = xhr.response;

                                            if (!response || xhr.status !== 201) {
                                                return reject(response && response
                                                    .message ?
                                                    `${genericErrorText}\n${xhr.status} ${response.message}` :
                                                    `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`
                                                );
                                            }

                                            $('form').append(
                                                '<input type="hidden" name="ck-media[]" value="' +
                                                response.id + '">');

                                            resolve({
                                                default: response.url
                                            });
                                        });

                                        if (xhr.upload) {
                                            xhr.upload.addEventListener('progress', function(
                                                e) {
                                                if (e.lengthComputable) {
                                                    loader.uploadTotal = e.total;
                                                    loader.uploaded = e.loaded;
                                                }
                                            });
                                        }

                                        // Send request
                                        var data = new FormData();
                                        data.append('upload', file);
                                        data.append('crud_id', '{{ $menuClient->id ?? 0 }}');
                                        xhr.send(data);
                                    });
                                })
                        }
                    };
                }
            }

            var allEditors = document.querySelectorAll('.ckeditor');
            for (var i = 0; i < allEditors.length; ++i) {
                ClassicEditor.create(
                    allEditors[i], {
                        extraPlugins: [SimpleUploadAdapter]
                    }
                );
            }
        });
    </script>
@endsection
