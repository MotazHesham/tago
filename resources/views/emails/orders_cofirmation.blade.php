
<div style="display: flex;justify-content:center">
    <div style="text-align: center;
                width: 100%;
                align-self: center;
                align-content: center;
                align-items: center;
                box-shadow: 1px 2px 9px grey;
                padding: 30px;
                background: #8080800a;
                border-radius: 8px;">

            <div  style="text-align: start; ">
                <h1 style="float: left;display:inline">
                    <img loading="lazy" src="{{ asset($site_settings->logo->getUrl()) }}" height="40"
                        style="display:inline-block;">
                </h1>
            </div>
                
            <div style="float: right;display:inline" >
                
                <small >
                    {{ $site_settings->address }} <br>
                    {{ $site_settings->email }} <br>
                    {{ $site_settings->phone_number }}
                </small>
            </div>
            <div style="clear: both"></div>
        <hr>

        <div> 
            <h1 class="h3">{{__('Thank You for Your Order!')}}</h1>
            <h2 class="h5">{{__('Order Code:')}} {{ $order->order_num }}</h2>  
        </div>
        <br> <br>
        <h3 style="float:left;margin-left:5%">{{__('Order Summary')}}</h3> 
        <div style="clear: both"></div>
        <hr style="float: left;margin-left:5%" width="150">
        <br><br>
        <div >
        

            <table style="width: 50%;text-align:center; ">
                <tr>
                    <th>{{__('Order date')}}</th>
                    <th>{{ $order->created_at }}</th>
                </tr> 
                
                <tr>
                    <th>{{__('Phone Number')}}</th>
                    <th>{{ $order->phone_number }}</th>
                </tr>
                <tr>
                    <th>{{__('Order status')}}</th>
                    <th>{{ $order->delivery_status ? \App\Models\Order::DELIVERY_STATUS_SELECT[$order->delivery_status] : '' }}</th>
                </tr>
                <tr>
                    <th>{{__('Shipping address')}}</th>
                    <th>{{ $order->country->name ?? '' }} , {{$order->shipping_address }}</th>
                </tr>
            </table> 

        </div>  
        <br><br><br>
        <div>
            <h3>{{__('Order Details')}}</h3>
            <hr width="50">
            <div>
                <table style="width: 100%;text-align:center"> 
                    <thead>
                        <tr>
                            <th style="padding: 20px">#</th>
                            <th>{{__('Product')}}</th> 
                            <th>{{__('Quantity')}}</th>
                            <th>{{__('Price')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->products as $key => $raw)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td> 
                                    <a href="{{ route('frontend.product',$raw->id) }}" target="_blank">
                                        {{ $raw->product->name ?? '' }}
                                    </a>
                                    <br>
                                    @foreach($raw->product->photo as $media)
                                        <img src="{{ $media->getUrl('thumb')}}" alt="">
                                    @endforeach
                                </td> 
                                <td>
                                    {{ $raw->quantity }}
                                </td>
                                <td>{{ $raw->total_cost }} </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> 
            <br><br><br>
            <div>
                <table style="width: 50%;text-align:end;float: right;">
                    <tbody>
                        <tr>
                            <td>
                                <span>{{ $order->total_price }}</span>
                            </td>
                            <th>{{__('Subtotal')}}</th>
                        </tr>
                        <tr>
                            <td>
                                <span class="text-italic">{{ $order->shipping_cost }}</span>
                            </td>
                            <th>{{__('Shipping')}}</th>
                        </tr>  
                        <tr>
                            <td>
                                = {{ $order->total_price + $order->shipping_cost }} 
                            </td>
                            <th><span>{{__('Total')}}</span></th>
                        </tr>
                    </tbody>
                </table>
            </div> 
        </div>
    </div>  
</div>
