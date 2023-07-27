@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.tutorial.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tutorials.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.tutorial.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tutorial.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="iframe">{{ trans('cruds.tutorial.fields.iframe') }}</label>
                <textarea class="form-control {{ $errors->has('iframe') ? 'is-invalid' : '' }}" name="iframe" id="iframe" required>{{ old('iframe') }}</textarea>
                @if($errors->has('iframe'))
                    <div class="invalid-feedback">
                        {{ $errors->first('iframe') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tutorial.fields.iframe_helper') }}</span>
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