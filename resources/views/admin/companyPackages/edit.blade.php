@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.companyPackage.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.company-packages.update", [$companyPackage->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="company_id">{{ trans('cruds.companyPackage.fields.company') }}</label>
                <select class="form-control select2 {{ $errors->has('company') ? 'is-invalid' : '' }}" name="company_id" id="company_id" required>
                    @foreach($companies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('company_id') ? old('company_id') : $companyPackage->company->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('company'))
                    <div class="invalid-feedback">
                        {{ $errors->first('company') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.companyPackage.fields.company_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="price">{{ trans('cruds.companyPackage.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', $companyPackage->price) }}" step="0.01" required>
                @if($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.companyPackage.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="start_at">{{ trans('cruds.companyPackage.fields.start_at') }}</label>
                <input class="form-control date {{ $errors->has('start_at') ? 'is-invalid' : '' }}" type="text" name="start_at" id="start_at" value="{{ old('start_at', $companyPackage->start_at) }}" required>
                @if($errors->has('start_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.companyPackage.fields.start_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="end_at">{{ trans('cruds.companyPackage.fields.end_at') }}</label>
                <input class="form-control date {{ $errors->has('end_at') ? 'is-invalid' : '' }}" type="text" name="end_at" id="end_at" value="{{ old('end_at', $companyPackage->end_at) }}" required>
                @if($errors->has('end_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('end_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.companyPackage.fields.end_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="num_of_users">{{ trans('cruds.companyPackage.fields.num_of_users') }}</label>
                <input class="form-control {{ $errors->has('num_of_users') ? 'is-invalid' : '' }}" type="number" name="num_of_users" id="num_of_users" value="{{ old('num_of_users', $companyPackage->num_of_users) }}" step="1" required>
                @if($errors->has('num_of_users'))
                    <div class="invalid-feedback">
                        {{ $errors->first('num_of_users') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.companyPackage.fields.num_of_users_helper') }}</span>
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