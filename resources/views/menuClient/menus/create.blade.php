<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add Menu </h5>  
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form method="POST" action="{{ route('menuClient.menus.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="menu_client_id" value="{{ $menuClient->id }}"> 
            <div class="row">
                <div class="form-group col-md-4">
                    <label class="required"
                        for="menu_theme_id">{{ trans('cruds.menuClientList.fields.menu_theme') }}</label> 
                    @foreach($menu_themes as $id => $entry)
                        <div class="form-check {{ $errors->has('menu_theme') ? 'is-invalid' : '' }}">
                            <input class="form-check-input" type="radio" id="menu_theme_{{ $id }}" name="menu_theme_id" value="{{ $id }}" {{ old('menu_theme') === (string) $id ? 'checked' : '' }} required>
                            <label class="form-check-label" for="menu_theme_{{ $id }}">
                                {{ $entry }}  
                                <a class="btn-link" href="{{ route('menuClient.theme',$id) }}" style="margin-left: 20px" target="_blanc">(view demo)</a>
                            </label>
                        </div>
                    @endforeach
                    @if ($errors->has('menu_theme'))
                        <div class="invalid-feedback">
                            {{ $errors->first('menu_theme') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.menuClientList.fields.menu_theme_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="facebook">{{ trans('cruds.menuClientList.fields.facebook') }}</label>
                    <input class="form-control {{ $errors->has('facebook') ? 'is-invalid' : '' }}" type="text"
                        name="facebook" id="facebook" value="{{ old('facebook', $menuClient->facebook) }}">
                    @if ($errors->has('facebook'))
                        <div class="invalid-feedback">
                            {{ $errors->first('facebook') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.menuClientList.fields.facebook_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="twitter">{{ trans('cruds.menuClientList.fields.twitter') }}</label>
                    <input class="form-control {{ $errors->has('twitter') ? 'is-invalid' : '' }}" type="text"
                        name="twitter" id="twitter" value="{{ old('twitter', $menuClient->twitter) }}">
                    @if ($errors->has('twitter'))
                        <div class="invalid-feedback">
                            {{ $errors->first('twitter') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.menuClientList.fields.twitter_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="google">{{ trans('cruds.menuClientList.fields.google') }}</label>
                    <input class="form-control {{ $errors->has('google') ? 'is-invalid' : '' }}" type="text"
                        name="google" id="google" value="{{ old('google', $menuClient->google) }}">
                    @if ($errors->has('google'))
                        <div class="invalid-feedback">
                            {{ $errors->first('google') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.menuClientList.fields.google_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="linkedin">{{ trans('cruds.menuClientList.fields.linkedin') }}</label>
                    <input class="form-control {{ $errors->has('linkedin') ? 'is-invalid' : '' }}" type="text"
                        name="linkedin" id="linkedin" value="{{ old('linkedin', $menuClient->linkedin) }}">
                    @if ($errors->has('linkedin'))
                        <div class="invalid-feedback">
                            {{ $errors->first('linkedin') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.menuClientList.fields.linkedin_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="tiktok">{{ trans('cruds.menuClientList.fields.tiktok') }}</label>
                    <input class="form-control {{ $errors->has('tiktok') ? 'is-invalid' : '' }}" type="text"
                        name="tiktok" id="tiktok" value="{{ old('tiktok', $menuClient->tiktok) }}">
                    @if ($errors->has('tiktok'))
                        <div class="invalid-feedback">
                            {{ $errors->first('tiktok') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.menuClientList.fields.tiktok_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="youtube">{{ trans('cruds.menuClientList.fields.youtube') }}</label>
                    <input class="form-control {{ $errors->has('youtube') ? 'is-invalid' : '' }}" type="text"
                        name="youtube" id="youtube" value="{{ old('youtube', $menuClient->youtube) }}">
                    @if ($errors->has('youtube'))
                        <div class="invalid-feedback">
                            {{ $errors->first('youtube') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.menuClientList.fields.youtube_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="instagram">{{ trans('cruds.menuClientList.fields.instagram') }}</label>
                    <input class="form-control {{ $errors->has('instagram') ? 'is-invalid' : '' }}" type="text"
                        name="instagram" id="instagram" value="{{ old('instagram', $menuClient->instagram) }}">
                    @if ($errors->has('instagram'))
                        <div class="invalid-feedback">
                            {{ $errors->first('instagram') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.menuClientList.fields.instagram_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="whatsapp">{{ trans('cruds.menuClientList.fields.whatsapp') }}</label>
                    <input class="form-control {{ $errors->has('whatsapp') ? 'is-invalid' : '' }}" type="text"
                        name="whatsapp" id="whatsapp" value="{{ old('whatsapp', $menuClient->whatsapp) }}">
                    @if ($errors->has('whatsapp'))
                        <div class="invalid-feedback">
                            {{ $errors->first('whatsapp') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.menuClientList.fields.whatsapp_helper') }}</span>
                </div> 
                <div class="form-group col-md-12">
                    <label class="required" for="categories">{{ trans('cruds.menuClientList.fields.categories') }}</label> 
                    <select class="form-control select2 {{ $errors->has('categories') ? 'is-invalid' : '' }}" name="categories[]" id="categories" multiple required>
                        @foreach($menu_categories as $id => $category)
                            <option value="{{ $id }}" {{ in_array($id, old('categories', [])) ? 'selected' : '' }}>{{ $category }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('categories'))
                        <div class="invalid-feedback">
                            {{ $errors->first('categories') }}
                        </div>
                    @endif 
                </div>
                <div class="form-group col-md-6">
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
                <div class="form-group col-md-6">
                    <label for="about_us">{{ trans('cruds.menuClientList.fields.about_us') }}</label>
                    <textarea class="form-control ckeditor {{ $errors->has('about_us') ? 'is-invalid' : '' }}" name="about_us"
                        id="about_us">{!! old('about_us',$menuClient->about_us) !!}</textarea>
                    @if ($errors->has('about_us'))
                        <div class="invalid-feedback">
                            {{ $errors->first('about_us') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.menuClientList.fields.about_us_helper') }}</span>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
                <button class="btn btn-light" type="button" data-bs-dismiss="modal" aria-label="Close">
                    {{ trans('global.close') }}
                </button>
            </div>
        </form>
    </div>
</div>  

<script> 
    $("#logo-dropzone").dropzone({
        url: '{{ route('menuClient.menus.storeMedia') }}',
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
    })
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
                                        '{{ route('menuClient.menus.storeCKEditorImages') }}',
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
                                        '{{ $menuClient->id ?? 0 }}');
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