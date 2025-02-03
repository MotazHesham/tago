@extends('layouts.admin')
@section('content')
    <form method="POST" action="{{ route('admin.companies.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-6">

                <div class="card">
                    <div class="card-header">
                        بيانات المسؤول
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                                name="name" id="name" value="{{ old('name', '') }}" required>
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                                name="email" id="email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="phone_number">{{ trans('cruds.user.fields.phone_number') }}</label>
                            <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}"
                                type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', '') }}">
                            @if ($errors->has('phone_number'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('phone_number') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.phone_number_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                            <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                                name="password" id="password" required>
                            @if ($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        بيانات الشركة
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="company_name">{{ trans('cruds.company.fields.company_name') }}</label>
                                <input class="form-control {{ $errors->has('company_name') ? 'is-invalid' : '' }}"
                                    type="text" name="company_name" id="company_name"
                                    value="{{ old('company_name', '') }}">
                                @if ($errors->has('company_name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('company_name') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.company.fields.company_name_helper') }}</span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="phone">{{ trans('cruds.company.fields.phone') }}</label>
                                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text"
                                    name="phone" id="phone" value="{{ old('phone', '') }}">
                                @if ($errors->has('phone'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('phone') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.company.fields.phone_helper') }}</span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="email">{{ trans('cruds.company.fields.email') }}</label>
                                <input class="form-control {{ $errors->has('company_email') ? 'is-invalid' : '' }}" type="email"
                                    name="company_email" id="email" value="{{ old('company_email') }}">
                                @if ($errors->has('company_email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('company_email') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.company.fields.email_helper') }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="address">{{ trans('cruds.company.fields.address') }}</label>
                                <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" id="address">{{ old('address') }}</textarea>
                                @if ($errors->has('address'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('address') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.company.fields.address_helper') }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="additional_info">{{ trans('cruds.company.fields.additional_info') }}</label>
                                <textarea class="form-control {{ $errors->has('additional_info') ? 'is-invalid' : '' }}" name="additional_info"
                                    id="additional_info">{{ old('additional_info') }}</textarea>
                                @if ($errors->has('additional_info'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('additional_info') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.company.fields.additional_info_helper') }}</span>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="form-check {{ $errors->has('active') ? 'is-invalid' : '' }}">
                                    <input type="hidden" name="active" value="0">
                                    <input class="form-check-input" type="checkbox" name="active" id="active"
                                        value="1" {{ old('active', 0) == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="active">{{ trans('cruds.company.fields.active') }}</label>
                                </div>
                                @if ($errors->has('active'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('active') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.company.fields.active_helper') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button class="btn btn-danger btn-block" type="submit">
                {{ trans('global.save') }}
            </button>
        </div>
    </form>
@endsection
