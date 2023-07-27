@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.menuProduct.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.menu-products.update", [$menuProduct->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.menuProduct.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $menuProduct->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.menuProduct.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="price">{{ trans('cruds.menuProduct.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', $menuProduct->price) }}" step="0.01" required>
                @if($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.menuProduct.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="menu_category_id">{{ trans('cruds.menuProduct.fields.menu_category') }}</label>
                <select class="form-control select2 {{ $errors->has('menu_category') ? 'is-invalid' : '' }}" name="menu_category_id" id="menu_category_id" required>
                    @foreach($menu_categories as $id => $entry)
                        <option value="{{ $id }}" {{ (old('menu_category_id') ? old('menu_category_id') : $menuProduct->menu_category->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('menu_category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('menu_category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.menuProduct.fields.menu_category_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="menu_client_id">{{ trans('cruds.menuProduct.fields.menu_client') }}</label>
                <select class="form-control select2 {{ $errors->has('menu_client') ? 'is-invalid' : '' }}" name="menu_client_id" id="menu_client_id" required>
                    @foreach($menu_clients as $id => $entry)
                        <option value="{{ $id }}" {{ (old('menu_client_id') ? old('menu_client_id') : $menuProduct->menu_client->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('menu_client'))
                    <div class="invalid-feedback">
                        {{ $errors->first('menu_client') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.menuProduct.fields.menu_client_helper') }}</span>
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