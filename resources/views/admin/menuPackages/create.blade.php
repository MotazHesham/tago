@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.menuPackage.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.menu-packages.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.menuPackage.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.menuPackage.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="descrption">{{ trans('cruds.menuPackage.fields.descrption') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('descrption') ? 'is-invalid' : '' }}" name="descrption" id="descrption">{!! old('descrption') !!}</textarea>
                @if($errors->has('descrption'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descrption') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.menuPackage.fields.descrption_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="price">{{ trans('cruds.menuPackage.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', '') }}" step="0.01">
                @if($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.menuPackage.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="menus">{{ trans('cruds.menuPackage.fields.menus') }}</label>
                <input class="form-control {{ $errors->has('menus') ? 'is-invalid' : '' }}" type="number" name="menus" id="menus" value="{{ old('menus', '') }}" step="0.01">
                @if($errors->has('menus'))
                    <div class="invalid-feedback">
                        {{ $errors->first('menus') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.menuPackage.fields.menus_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="themes">{{ trans('cruds.menuPackage.fields.themes') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('themes') ? 'is-invalid' : '' }}" name="themes[]" id="themes" multiple required>
                    @foreach($themes as $id => $theme)
                        <option value="{{ $id }}" {{ in_array($id, old('themes', [])) ? 'selected' : '' }}>{{ $theme }}</option>
                    @endforeach
                </select>
                @if($errors->has('themes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('themes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.menuPackage.fields.themes_helper') }}</span>
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
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.menu-packages.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $menuPackage->id ?? 0 }}');
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