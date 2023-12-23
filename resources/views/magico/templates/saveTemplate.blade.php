
<!-- Modal -->
<div class="modal fade" id="saveTemplate" tabindex="-1" aria-labelledby="saveTemplateLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="saveTemplateLabel">Save Template</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route("admin.templates.store") }}" enctype="multipart/form-data" id="template-form">
                    @csrf
                    <div class="form-group">
                        <label class="required">Type</label>
                        <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" required>
                            <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                            @foreach(App\Models\Template::TYPE_SELECT as $key => $label)
                                <option value="{{ $key }}" {{ old('type', 'business_card') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('type'))
                            <div class="invalid-feedback">
                                {{ $errors->first('type') }}
                            </div>
                        @endif 
                    </div>
                    <div class="form-group">
                        <label class="required" for="name">{{ trans('cruds.template.fields.name') }}</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                        @if($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.template.fields.name_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="price">{{ trans('cruds.template.fields.price') }}</label>
                        <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', '') }}" required>
                        @if($errors->has('price'))
                            <div class="invalid-feedback">
                                {{ $errors->first('price') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.template.fields.price_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="photo">{{ trans('cruds.template.fields.photo') }}</label>
                        <input type="file" name="photo" id="photo" class="form-control" required>
                        @if($errors->has('photo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('photo') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.template.fields.photo_helper') }}</span>
                    </div> 
                    <hr>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" >Save</button>
                </form>
            </div> 
        </div>
    </div>
</div>