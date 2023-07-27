@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.setting.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.settings.update", [$setting->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="form-group col-md-4">
                    <label class="required" for="website_name">{{ trans('cruds.setting.fields.website_name') }}</label>
                    <input class="form-control {{ $errors->has('website_name') ? 'is-invalid' : '' }}" type="text" name="website_name" id="website_name" value="{{ old('website_name', $setting->website_name) }}" required>
                    @if($errors->has('website_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('website_name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.setting.fields.website_name_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="description">{{ trans('cruds.setting.fields.description') }}</label>
                    <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" required>{{ old('description', $setting->description) }}</textarea>
                    @if($errors->has('description'))
                        <div class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.setting.fields.description_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="why_us">{{ trans('cruds.setting.fields.why_us') }}</label>
                    <textarea class="form-control {{ $errors->has('why_us') ? 'is-invalid' : '' }}" name="why_us" id="why_us" required>{{ old('why_us',$setting->why_us) }}</textarea>
                    @if($errors->has('why_us'))
                        <div class="invalid-feedback">
                            {{ $errors->first('why_us') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.setting.fields.why_us_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="our_mission">{{ trans('cruds.setting.fields.our_mission') }}</label>
                    <textarea class="form-control {{ $errors->has('our_mission') ? 'is-invalid' : '' }}" name="our_mission" id="our_mission" required>{{ old('our_mission',$setting->our_mission) }}</textarea>
                    @if($errors->has('our_mission'))
                        <div class="invalid-feedback">
                            {{ $errors->first('our_mission') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.setting.fields.our_mission_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="how_it_work_description">{{ trans('cruds.setting.fields.how_it_work_description') }}</label>
                    <textarea class="form-control {{ $errors->has('how_it_work_description') ? 'is-invalid' : '' }}" name="how_it_work_description" id="how_it_work_description" required>{{ old('how_it_work_description', $setting->how_it_work_description) }}</textarea>
                    @if($errors->has('how_it_work_description'))
                        <div class="invalid-feedback">
                            {{ $errors->first('how_it_work_description') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.setting.fields.how_it_work_description_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="how_it_work">{{ trans('cruds.setting.fields.how_it_work') }}</label>
                    <textarea class="form-control {{ $errors->has('how_it_work') ? 'is-invalid' : '' }}" name="how_it_work" id="how_it_work" required>{{ old('how_it_work', $setting->how_it_work) }}</textarea>
                    @if($errors->has('how_it_work'))
                        <div class="invalid-feedback">
                            {{ $errors->first('how_it_work') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.setting.fields.how_it_work_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="contact_description">{{ trans('cruds.setting.fields.contact_description') }}</label>
                    <textarea class="form-control {{ $errors->has('contact_description') ? 'is-invalid' : '' }}" name="contact_description" id="contact_description" required>{{ old('contact_description', $setting->contact_description) }}</textarea>
                    @if($errors->has('contact_description'))
                        <div class="invalid-feedback">
                            {{ $errors->first('contact_description') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.setting.fields.contact_description_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="email">{{ trans('cruds.setting.fields.email') }}</label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $setting->email) }}" required>
                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.setting.fields.email_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="phone_number">{{ trans('cruds.setting.fields.phone_number') }}</label>
                    <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $setting->phone_number) }}" required>
                    @if($errors->has('phone_number'))
                        <div class="invalid-feedback">
                            {{ $errors->first('phone_number') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.setting.fields.phone_number_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="address">{{ trans('cruds.setting.fields.address') }}</label>
                    <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" id="address" required>{{ old('address', $setting->address) }}</textarea>
                    @if($errors->has('address'))
                        <div class="invalid-feedback">
                            {{ $errors->first('address') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.setting.fields.address_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="facebook">{{ trans('cruds.setting.fields.facebook') }}</label>
                    <input class="form-control {{ $errors->has('facebook') ? 'is-invalid' : '' }}" type="text" name="facebook" id="facebook" value="{{ old('facebook', $setting->facebook) }}" required>
                    @if($errors->has('facebook'))
                        <div class="invalid-feedback">
                            {{ $errors->first('facebook') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.setting.fields.facebook_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="instagram">{{ trans('cruds.setting.fields.instagram') }}</label>
                    <input class="form-control {{ $errors->has('instagram') ? 'is-invalid' : '' }}" type="text" name="instagram" id="instagram" value="{{ old('instagram', $setting->instagram) }}" required>
                    @if($errors->has('instagram'))
                        <div class="invalid-feedback">
                            {{ $errors->first('instagram') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.setting.fields.instagram_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="tiktok">{{ trans('cruds.setting.fields.tiktok') }}</label>
                    <input class="form-control {{ $errors->has('tiktok') ? 'is-invalid' : '' }}" type="text" name="tiktok" id="tiktok" value="{{ old('tiktok', $setting->tiktok) }}" required>
                    @if($errors->has('tiktok'))
                        <div class="invalid-feedback">
                            {{ $errors->first('tiktok') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.setting.fields.tiktok_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="youtube">{{ trans('cruds.setting.fields.youtube') }}</label>
                    <input class="form-control {{ $errors->has('youtube') ? 'is-invalid' : '' }}" type="text" name="youtube" id="youtube" value="{{ old('youtube', $setting->youtube) }}" required>
                    @if($errors->has('youtube'))
                        <div class="invalid-feedback">
                            {{ $errors->first('youtube') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.setting.fields.youtube_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="supporters">{{ trans('cruds.setting.fields.supporters') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('supporters') ? 'is-invalid' : '' }}" id="supporters-dropzone">
                    </div>
                    @if($errors->has('supporters'))
                        <div class="invalid-feedback">
                            {{ $errors->first('supporters') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.setting.fields.supporters_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="logo">{{ trans('cruds.setting.fields.logo') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('logo') ? 'is-invalid' : '' }}" id="logo-dropzone">
                    </div>
                    @if($errors->has('logo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('logo') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.setting.fields.logo_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="keywords_seo">{{ trans('cruds.setting.fields.keywords_seo') }}</label>
                    <input class="form-control {{ $errors->has('keywords_seo') ? 'is-invalid' : '' }}" type="text" name="keywords_seo[]" id="keywords_seo" value="{{ $setting->keywords_seo }}"  placeholder="add tags ..." data-role="tagsinput" required>
                    @if($errors->has('keywords_seo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('keywords_seo') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.setting.fields.keywords_seo_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="author_seo">{{ trans('cruds.setting.fields.author_seo') }}</label>
                    <input class="form-control {{ $errors->has('author_seo') ? 'is-invalid' : '' }}" type="text" name="author_seo" id="author_seo" value="{{ old('author_seo', $setting->author_seo) }}" required>
                    @if($errors->has('author_seo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('author_seo') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.setting.fields.author_seo_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="sitemap_link_seo">{{ trans('cruds.setting.fields.sitemap_link_seo') }}</label>
                    <input class="form-control {{ $errors->has('sitemap_link_seo') ? 'is-invalid' : '' }}" type="text" name="sitemap_link_seo" id="sitemap_link_seo" value="{{ old('sitemap_link_seo', $setting->sitemap_link_seo) }}" required>
                    @if($errors->has('sitemap_link_seo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('sitemap_link_seo') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.setting.fields.sitemap_link_seo_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="description_seo">{{ trans('cruds.setting.fields.description_seo') }}</label>
                    <textarea class="form-control {{ $errors->has('description_seo') ? 'is-invalid' : '' }}" name="description_seo" id="description_seo" required>{{ old('description_seo', $setting->description_seo) }}</textarea>
                    @if($errors->has('description_seo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('description_seo') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.setting.fields.description_seo_helper') }}</span>
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
    var uploadedSupportersMap = {}
Dropzone.options.supportersDropzone = {
    url: '{{ route('admin.settings.storeMedia') }}',
    maxFilesize: 4, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif,.svg',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 4,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="supporters[]" value="' + response.name + '">')
      uploadedSupportersMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedSupportersMap[file.name]
      }
      $('form').find('input[name="supporters[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($setting) && $setting->supporters)
      var files = {!! json_encode($setting->supporters) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="supporters[]" value="' + file.file_name + '">')
        }
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
<script>
    Dropzone.options.logoDropzone = {
    url: '{{ route('admin.settings.storeMedia') }}',
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
      $('form').find('input[name="logo"]').remove()
      $('form').append('<input type="hidden" name="logo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="logo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($setting) && $setting->logo)
      var file = {!! json_encode($setting->logo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="logo" value="' + file.file_name + '">')
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