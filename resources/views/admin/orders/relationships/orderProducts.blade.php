<!-- Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <form action="{{ route('admin.orders.add_product') }}" method="POST">
            @csrf 
            <input type="hidden" name="order_id" value="{{ $order->id }}">
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="">Product</label>
                    <select name="product_id" id="product_id" class="form-control select2" required > 
                        @foreach(\App\Models\Product::get() as $product)
                            <option value="{{ $product->id }}" @if(old('product_id') == $product->id) selected @endif data-price="{{ $product->price }}">{{ $product->name }} - {{ frontend_currency($product->price)['as_text'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="quantity">Quantity</label>
                    <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" min="1" value="1" step="1" name="quantity" id="quantity" value="{{ old('quantity', '') }}" required>
                    @if($errors->has('quantity'))
                        <div class="invalid-feedback">
                            {{ $errors->first('quantity') }}
                        </div>
                    @endif 
                </div>
                <div class="form-group col-md-4">
                    <br>
                    <button type="submit" class="btn btn-success">Add</button>
                </div>

            </div>
        </form>
    </div>
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
                        <th>

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
                            <td>
                                {{ $orderProduct->price ?? '' }}
                            </td>
                            <td>
                                {{ $orderProduct->quantity ?? '' }}
                            </td>
                            <td>
                                {{ $orderProduct->total_cost ?? '' }}
                            </td>
                            <td>
                                {{ $orderProduct->token ?? '' }}
                            </td>
                            <td>
                                <button class="btn btn-info" onclick="show_qr_code('{{ $orderProduct->token }}')">
                                    Get QR
                                </button>
                                @if($order->delivery_status != 'delivered')
                                    <a href="{{ route('admin.orders.delete_product',$orderProduct->id) }}" onclick="return confirm('Are You Sure?')" class="btn btn-danger">Delete</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
