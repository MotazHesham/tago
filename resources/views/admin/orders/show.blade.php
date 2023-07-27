@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                {{ trans('global.show') }} {{ trans('cruds.order.title') }}
            </div>
        
            <div class="card-body">
                <div class="form-group">
                    <div class="form-group">
                        <a class="btn btn-default" href="{{ route('admin.orders.index') }}">
                            {{ trans('global.back_to_list') }}
                        </a>
                    </div>
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.id') }}
                                </th>
                                <td>
                                    {{ $order->id }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.first_name') }}
                                </th>
                                <td>
                                    {{ $order->first_name }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.last_name') }}
                                </th>
                                <td>
                                    {{ $order->last_name }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.phone_number') }}
                                </th>
                                <td>
                                    {{ $order->phone_number }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.shipping_address') }}
                                </th>
                                <td>
                                    {{ $order->shipping_address }}
                                </td>
                            </tr> 
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.total_price') }}
                                </th>
                                <td>
                                    +{{ $order->shipping_cost }}
                                    <br>
                                    +{{ $order->total_price }}
                                    <br>
                                    <span class="badge badge-success">={{ ($order->shipping_cost+$order->total_price) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.delivery_status') }}
                                </th>
                                <td>
                                    {{ App\Models\Order::DELIVERY_STATUS_SELECT[$order->delivery_status] ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.user') }}
                                </th>
                                <td>
                                    {{ $order->user->name ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.products') }}
                                </th>
                                <td>
                                    @foreach($order->products as $key => $products)
                                        <span class="label label-info">{{ $products->name }}</span>
                                    @endforeach
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group">
                        <a class="btn btn-default" href="{{ route('admin.orders.index') }}">
                            {{ trans('global.back_to_list') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        
        <div class="card">
            <div class="card-header">
                {{ trans('global.relatedData') }}
            </div>
            <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#orderProducts" role="tab" data-toggle="tab">
                        المنتجات
                    </a>
                </li> 
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" role="tabpanel" id="orderProducts">
                    @includeIf('admin.orders.relationships.orderProducts', ['orderProducts' => $order->products])
                </div> 
            </div>
        </div>
    </div>
</div>



@endsection