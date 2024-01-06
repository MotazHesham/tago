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
                                    نوع الطلب
                                </th>
                                <td>
                                    @if($order->order_type == 'template')
                                        <b>Design</b>
                                    @else 
                                        <b>Products</b>
                                    @endif
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
                
                @if($order->order_type == 'normal')
                    <li class="nav-item">
                        <a class="nav-link active" href="#orderProducts" role="tab" data-toggle="tab">
                            المنتجات
                        </a>
                    </li> 
                @else
                    <li class="nav-item">
                        <a class="nav-link active" href="#orderTemplates" role="tab" data-toggle="tab">
                            الديزاينات
                        </a>
                    </li> 
                @endif
            </ul>
            <div class="tab-content">
                @if($order->order_type == 'normal')
                    <div class="tab-pane active" role="tabpanel" id="orderProducts">
                        @includeIf('admin.orders.relationships.orderProducts', ['orderProducts' => $order->products])
                    </div> 
                @else
                    <div class="tab-pane active" role="tabpanel" id="orderTemplates">
                        @includeIf('admin.orders.relationships.orderTemplates', ['orderTemplates' => $order->templates])
                    </div> 
                @endif
            </div>
        </div>
    </div>
</div>



@endsection

@section('scripts')
    @parent 
    <script>
        function show_qr_code(token){
            $.post('{{ route('admin.show_qr_code') }}', {
                _token: '{{ csrf_token() }}',
                token: token, 
            }, function(data) {
                $('#AjaxModal .modal-dialog').html(null);
                $('#AjaxModal').modal('show');
                $('#AjaxModal .modal-dialog').html(data); 
            });
        }
        </script>
@endsection