@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.menuClientPackage.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.menu-client-packages.update", [$menuClientPackage->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="menu_client_id">{{ trans('cruds.menuClientPackage.fields.menu_client') }}</label>
                <select class="form-control select2 {{ $errors->has('menu_client') ? 'is-invalid' : '' }}" name="menu_client_id" id="menu_client_id" required>
                    @foreach($menu_clients as $id => $entry)
                        <option value="{{ $id }}" {{ (old('menu_client_id') ? old('menu_client_id') : $menuClientPackage->menu_client->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('menu_client'))
                    <div class="invalid-feedback">
                        {{ $errors->first('menu_client') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.menuClientPackage.fields.menu_client_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="menu_package_id">{{ trans('cruds.menuClientPackage.fields.menu_package') }}</label>
                <select class="form-control select2 {{ $errors->has('menu_package') ? 'is-invalid' : '' }}" name="menu_package_id" id="menu_package_id" required>
                    @foreach($menu_packages as $id => $entry)
                        <option value="{{ $id }}" {{ (old('menu_package_id') ? old('menu_package_id') : $menuClientPackage->menu_package->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('menu_package'))
                    <div class="invalid-feedback">
                        {{ $errors->first('menu_package') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.menuClientPackage.fields.menu_package_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="start_at">{{ trans('cruds.menuClientPackage.fields.start_at') }}</label>
                <input class="form-control date {{ $errors->has('start_at') ? 'is-invalid' : '' }}" type="text" name="start_at" id="start_at" value="{{ old('start_at', $menuClientPackage->start_at) }}" required>
                @if($errors->has('start_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.menuClientPackage.fields.start_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="end_at">{{ trans('cruds.menuClientPackage.fields.end_at') }}</label>
                <input class="form-control date {{ $errors->has('end_at') ? 'is-invalid' : '' }}" type="text" name="end_at" id="end_at" value="{{ old('end_at', $menuClientPackage->end_at) }}" required>
                @if($errors->has('end_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('end_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.menuClientPackage.fields.end_at_helper') }}</span>
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