
<div class="card"> 
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr> 
                        <th>
                            id
                        </th>
                        <th>
                            Name
                        </th> 
                        <th>
                            price
                        </th>
                        <th>
                            qty
                        </th>
                        <th>
                            total Price
                        </th>  
                        <th>
                            token
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderTemplates as $key => $orderTemplate)
                        <tr data-entry-id="{{ $orderTemplate->id }}"> 
                            <td>
                                {{ $orderTemplate->id ?? '' }}
                            </td>
                            <td>
                                {{ $orderTemplate->template->name ?? '' }}
                            </td> 
                            <td>
                                {{ $orderTemplate->price ?? '' }}
                            </td>
                            <td>
                                {{ $orderTemplate->quantity ?? '' }}
                            </td>
                            <td>
                                {{ $orderTemplate->total_cost ?? '' }}
                            </td>  
                            <td>
                                @if($orderTemplate->token)
                                    {{ $orderTemplate->token ?? '' }}
                                    <button class="btn btn-info" onclick="show_qr_code('{{$orderTemplate->token}}')">Get QR</button>
                                @endif
                                <a href="{{ route('frontend.magico',['order_template' => $orderTemplate->id]) }}" target="_blanc" class="btn btn-warning text-white">Show Design</a>
                            </td>  
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

