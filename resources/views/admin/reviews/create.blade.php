@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.review.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.reviews.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.review.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="review">{{ trans('cruds.review.fields.review') }}</label>
                <textarea class="form-control {{ $errors->has('review') ? 'is-invalid' : '' }}" name="review" id="review" required>{{ old('review') }}</textarea>
                @if($errors->has('review'))
                    <div class="invalid-feedback">
                        {{ $errors->first('review') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.review_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="rate">{{ trans('cruds.review.fields.rate') }}</label>
                <input class="form-control {{ $errors->has('rate') ? 'is-invalid' : '' }}" type="number" name="rate" id="rate" value="{{ old('rate', '') }}" step="0.1">
                @if($errors->has('rate'))
                    <div class="invalid-feedback">
                        {{ $errors->first('rate') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.rate_helper') }}</span>
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