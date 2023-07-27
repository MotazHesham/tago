@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.menuCategory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.menu-categories.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.menuCategory.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.menuCategory.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="banner">{{ trans('cruds.menuCategory.fields.banner') }}</label>
                <div class="needsclick dropzone {{ $errors->has('banner') ? 'is-invalid' : '' }}" id="banner-dropzone">
                </div>
                @if($errors->has('banner'))
                    <div class="invalid-feedback">
                        {{ $errors->first('banner') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.menuCategory.fields.banner_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="menu_client_id">{{ trans('cruds.menuCategory.fields.menu_client') }}</label>
                <select class="form-control select2 {{ $errors->has('menu_client') ? 'is-invalid' : '' }}" name="menu_client_id" id="menu_client_id" required>
                    @foreach($menu_clients as $id => $entry)
                        <option value="{{ $id }}" {{ old('menu_client_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('menu_client'))
                    <div class="invalid-feedback">
                        {{ $errors->first('menu_client') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.menuCategory.fields.menu_client_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="menu_client_lists">{{ trans('cruds.menuCategory.fields.menu_client_list') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('menu_client_lists') ? 'is-invalid' : '' }}" name="menu_client_lists[]" id="menu_client_lists" multiple required>
                    @foreach($menu_client_lists as $id => $menu_client_list)
                        <option value="{{ $id }}" {{ in_array($id, old('menu_client_lists', [])) ? 'selected' : '' }}>{{ $menu_client_list }}</option>
                    @endforeach
                </select>
                @if($errors->has('menu_client_lists'))
                    <div class="invalid-feedback">
                        {{ $errors->first('menu_client_lists') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.menuCategory.fields.menu_client_list_helper') }}</span>
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
    Dropzone.options.bannerDropzone = {
    url: '{{ route('admin.menu-categories.storeMedia') }}',
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
    success: function (file, response) {
      $('form').find('input[name="banner"]').remove()
      $('form').append('<input type="hidden" name="banner" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="banner"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($menuCategory) && $menuCategory->banner)
      var file = {!! json_encode($menuCategory->banner) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="banner" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
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