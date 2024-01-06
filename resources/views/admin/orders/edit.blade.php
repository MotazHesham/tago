@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.order.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.orders.update", [$order->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row"> 
                <div class="form-group col-md-4">
                    <label class="required" for="first_name">{{ trans('cruds.order.fields.first_name') }}</label>
                    <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', $order->first_name) }}" required>
                    @if($errors->has('first_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('first_name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.order.fields.first_name_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="last_name">{{ trans('cruds.order.fields.last_name') }}</label>
                    <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', $order->last_name) }}" required>
                    @if($errors->has('last_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('last_name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.order.fields.last_name_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="phone_number">{{ trans('cruds.order.fields.phone_number') }}</label>
                    <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $order->phone_number) }}" required>
                    @if($errors->has('phone_number'))
                        <div class="invalid-feedback">
                            {{ $errors->first('phone_number') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.order.fields.phone_number_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="">Shipping Country</label>
                    <select name="country_id" id="country_id" class="form-control" required onchange="country_change()"> 
                        @foreach(\App\Models\Country::where('status',1)->get() as $country)
                            <option value="{{ $country->id }}" @if(old('country_id') == $country->id) selected @endif data-price="{{ $country->cost }}">{{ $country->name }} - {{ frontend_currency($country->cost)['as_text'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label class="required">{{ trans('cruds.order.fields.delivery_status') }}</label>
                    <select class="form-control {{ $errors->has('delivery_status') ? 'is-invalid' : '' }}" name="delivery_status" id="delivery_status" required>
                        <option value disabled {{ old('delivery_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Order::DELIVERY_STATUS_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('delivery_status', $order->delivery_status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('delivery_status'))
                        <div class="invalid-feedback">
                            {{ $errors->first('delivery_status') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.order.fields.delivery_status_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="user_id">{{ trans('cruds.order.fields.user') }}</label>
                    <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                        @foreach($users as $id => $entry)
                            <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $order->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('user'))
                        <div class="invalid-feedback">
                            {{ $errors->first('user') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.order.fields.user_helper') }}</span>
                </div> 
                <div class="form-group col-md-4">
                    <label class="required" for="shipping_address">{{ trans('cruds.order.fields.shipping_address') }}</label>
                    <textarea class="form-control {{ $errors->has('shipping_address') ? 'is-invalid' : '' }}" name="shipping_address" id="shipping_address" required>{{ old('shipping_address', $order->shipping_address) }}</textarea>
                    @if($errors->has('shipping_address'))
                        <div class="invalid-feedback">
                            {{ $errors->first('shipping_address') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.order.fields.shipping_address_helper') }}</span>
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