@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.menuClientList.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.menu-client-lists.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required"
                        for="menu_client_package_id">{{ trans('cruds.menuClientList.fields.menu_client_package') }}</label>
                    <select class="form-control select2 {{ $errors->has('menu_client_package') ? 'is-invalid' : '' }}"
                        name="menu_client_package_id" id="menu_client_package_id" required>
                        @foreach ($menu_client_packages as $id => $entry)
                            <option value="{{ $id }}"
                                {{ old('menu_client_package_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('menu_client_package'))
                        <div class="invalid-feedback">
                            {{ $errors->first('menu_client_package') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.menuClientList.fields.menu_client_package_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="logo">{{ trans('cruds.menuClientList.fields.logo') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('logo') ? 'is-invalid' : '' }}" id="logo-dropzone">
                    </div>
                    @if ($errors->has('logo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('logo') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.menuClientList.fields.logo_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="about_us">{{ trans('cruds.menuClientList.fields.about_us') }}</label>
                    <textarea class="form-control ckeditor {{ $errors->has('about_us') ? 'is-invalid' : '' }}" name="about_us"
                        id="about_us">{!! old('about_us') !!}</textarea>
                    @if ($errors->has('about_us'))
                        <div class="invalid-feedback">
                            {{ $errors->first('about_us') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.menuClientList.fields.about_us_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="facebook">{{ trans('cruds.menuClientList.fields.facebook') }}</label>
                    <input class="form-control {{ $errors->has('facebook') ? 'is-invalid' : '' }}" type="text"
                        name="facebook" id="facebook" value="{{ old('facebook', '') }}">
                    @if ($errors->has('facebook'))
                        <div class="invalid-feedback">
                            {{ $errors->first('facebook') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.menuClientList.fields.facebook_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="twitter">{{ trans('cruds.menuClientList.fields.twitter') }}</label>
                    <input class="form-control {{ $errors->has('twitter') ? 'is-invalid' : '' }}" type="text"
                        name="twitter" id="twitter" value="{{ old('twitter', '') }}">
                    @if ($errors->has('twitter'))
                        <div class="invalid-feedback">
                            {{ $errors->first('twitter') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.menuClientList.fields.twitter_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="google">{{ trans('cruds.menuClientList.fields.google') }}</label>
                    <input class="form-control {{ $errors->has('google') ? 'is-invalid' : '' }}" type="text"
                        name="google" id="google" value="{{ old('google', '') }}">
                    @if ($errors->has('google'))
                        <div class="invalid-feedback">
                            {{ $errors->first('google') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.menuClientList.fields.google_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="linkedin">{{ trans('cruds.menuClientList.fields.linkedin') }}</label>
                    <input class="form-control {{ $errors->has('linkedin') ? 'is-invalid' : '' }}" type="text"
                        name="linkedin" id="linkedin" value="{{ old('linkedin', '') }}">
                    @if ($errors->has('linkedin'))
                        <div class="invalid-feedback">
                            {{ $errors->first('linkedin') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.menuClientList.fields.linkedin_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="tiktok">{{ trans('cruds.menuClientList.fields.tiktok') }}</label>
                    <input class="form-control {{ $errors->has('tiktok') ? 'is-invalid' : '' }}" type="text"
                        name="tiktok" id="tiktok" value="{{ old('tiktok', '') }}">
                    @if ($errors->has('tiktok'))
                        <div class="invalid-feedback">
                            {{ $errors->first('tiktok') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.menuClientList.fields.tiktok_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="youtube">{{ trans('cruds.menuClientList.fields.youtube') }}</label>
                    <input class="form-control {{ $errors->has('youtube') ? 'is-invalid' : '' }}" type="text"
                        name="youtube" id="youtube" value="{{ old('youtube', '') }}">
                    @if ($errors->has('youtube'))
                        <div class="invalid-feedback">
                            {{ $errors->first('youtube') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.menuClientList.fields.youtube_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="instagram">{{ trans('cruds.menuClientList.fields.instagram') }}</label>
                    <input class="form-control {{ $errors->has('instagram') ? 'is-invalid' : '' }}" type="text"
                        name="instagram" id="instagram" value="{{ old('instagram', '') }}">
                    @if ($errors->has('instagram'))
                        <div class="invalid-feedback">
                            {{ $errors->first('instagram') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.menuClientList.fields.instagram_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="whatsapp">{{ trans('cruds.menuClientList.fields.whatsapp') }}</label>
                    <input class="form-control {{ $errors->has('whatsapp') ? 'is-invalid' : '' }}" type="text"
                        name="whatsapp" id="whatsapp" value="{{ old('whatsapp', '') }}">
                    @if ($errors->has('whatsapp'))
                        <div class="invalid-feedback">
                            {{ $errors->first('whatsapp') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.menuClientList.fields.whatsapp_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required"
                        for="menu_client_id">{{ trans('cruds.menuClientList.fields.menu_client') }}</label>
                    <select class="form-control select2 {{ $errors->has('menu_client') ? 'is-invalid' : '' }}"
                        name="menu_client_id" id="menu_client_id" required>
                        @foreach ($menu_clients as $id => $entry)
                            <option value="{{ $id }}" {{ old('menu_client_id') == $id ? 'selected' : '' }}>
                                {{ $entry }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('menu_client'))
                        <div class="invalid-feedback">
                            {{ $errors->first('menu_client') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.menuClientList.fields.menu_client_helper') }}</span>
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
            url: '{{ route('admin.menu-client-lists.storeMedia') }}',
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
                @if (isset($menuClientList) && $menuClientList->logo)
                    var file = {!! json_encode($menuClientList->logo) !!}
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
                                            '{{ route('admin.menu-client-lists.storeCKEditorImages') }}',
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
                                        data.append('crud_id',
                                            '{{ $menuClientList->id ?? 0 }}');
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
