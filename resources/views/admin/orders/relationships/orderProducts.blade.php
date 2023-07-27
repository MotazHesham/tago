
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
                            Product Name
                        </th>
                        {{-- <th>
                            variant
                        </th> --}}
                        <th>
                            price
                        </th>
                        <th>
                            qty
                        </th>
                        <th>
                            total Price
                        </th>  
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderProducts as $key => $orderProduct)
                        <tr data-entry-id="{{ $orderProduct->id }}"> 
                            <td>
                                {{ $orderProduct->id ?? '' }}
                            </td>
                            <td>
                                {{ $orderProduct->product->name ?? '' }}
                            </td>
                            {{-- <td>
                                {{ $orderProduct->variant ?? '' }}
                            </td> --}}
                            <td>
                                {{ $orderProduct->price ?? '' }}
                            </td>
                            <td>
                                {{ $orderProduct->quantity ?? '' }}
                            </td>
                            <td>
                                {{ $orderProduct->total_cost ?? '' }}
                            </td>  
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

