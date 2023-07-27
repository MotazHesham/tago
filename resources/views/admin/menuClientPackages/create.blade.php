<div class="card">
    <div class="card-header">
        <h5 class="text-center ">{{ trans('global.add') }} {{ trans('cruds.menuClientPackage.title_singular') }}
        </h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.menu-client-packages.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="menu_client_id" value="{{ $menuClient->id }}" id="">
            <div class="row">
                <div class="form-group col-md-3">
                    <label class="required"
                        for="menu_package_id">{{ trans('cruds.menuClientPackage.fields.menu_package') }}</label>
                    <select class="form-control select2 {{ $errors->has('menu_package') ? 'is-invalid' : '' }}"
                        name="menu_package_id" id="menu_package_id" required>
                        @foreach ($menu_packages as $id => $entry)
                            <option value="{{ $id }}" {{ old('menu_package_id') == $id ? 'selected' : '' }}>
                                {{ $entry }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('menu_package'))
                        <div class="invalid-feedback">
                            {{ $errors->first('menu_package') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.menuClientPackage.fields.menu_package_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required"
                        for="start_at">{{ trans('cruds.menuClientPackage.fields.start_at') }}</label>
                    <input class="form-control date {{ $errors->has('start_at') ? 'is-invalid' : '' }}" type="text"
                        name="start_at" id="start_at" value="{{ old('start_at') }}" required>
                    @if ($errors->has('start_at'))
                        <div class="invalid-feedback">
                            {{ $errors->first('start_at') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.menuClientPackage.fields.start_at_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required" for="end_at">{{ trans('cruds.menuClientPackage.fields.end_at') }}</label>
                    <input class="form-control date {{ $errors->has('end_at') ? 'is-invalid' : '' }}" type="text"
                        name="end_at" id="end_at" value="{{ old('end_at') }}" required>
                    @if ($errors->has('end_at'))
                        <div class="invalid-feedback">
                            {{ $errors->first('end_at') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.menuClientPackage.fields.end_at_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <div class="form-group" style="paddin:10px"> 
                        <button class="btn btn-info btn-block" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
