
<!-- Modal -->
<div class="modal fade" id="orderTemplate" tabindex="-1" aria-labelledby="orderTemplateLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="orderTemplateLabel">Confirm Order</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" id="show-errors" style="display: none"></div>
                <form method="POST" action="{{ route("frontend.ordertemplate") }}" enctype="multipart/form-data" id="orderTemplate-form">
                    @csrf
                    <input type="hidden" name="template_id" value="{{$template_id}}" id="templateIdInput">
                    <div class="row mt-2">
                        <div class="col-md-8">
                            <div class="row"> 
                                <div class="form-group col-md-6">
                                    <label class="required">Type</label>
                                    <select class="form-control {{ $errors->has('card_type') ? 'is-invalid' : '' }}" name="card_type" id="card_type" required onchange="country_change()">
                                        <option value disabled {{ old('card_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                        @foreach(App\Models\Template::CARDTYPE_SELECT as $key => $label)
                                            <option value="{{ $key }}" {{ old('card_type', 'normal') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('card_type'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('card_type') }}
                                        </div>
                                    @endif 
                                </div> 
                                <div class="form-group col-md-6">
                                    <label class="required" for="quantity">Quantity</label>
                                    <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" min="1" step="1" value="1" max="50000" name="quantity" id="quantity" value="{{ old('quantity', '') }}" required onchange="country_change()" onkeyup="country_change()">
                                    @if($errors->has('quantity'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('quantity') }}
                                        </div>
                                    @endif 
                                </div> 
                                <div class="form-group col-md-6">
                                    <label for="">First Name</label>
                                    <input type="text" class="form-control" name="first_name" id="first_name" value="{{ old('first_name') }}" id="" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" id="last_name" value="{{ old('last_name') }}" id="" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Phone Number</label>
                                    <input type="text" class="form-control" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" id="" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Shipping Country</label>
                                    <select name="country_id" id="country_id" class="form-control" required onchange="country_change()"> 
                                        @foreach(\App\Models\Country::where('status',1)->get() as $country)
                                            <option value="{{ $country->id }}" @if(old('country_id') == $country->id) selected @endif data-price="{{ $country->cost }}">{{ $country->name }} - {{ frontend_currency($country->cost)['as_text'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="">Address</label>
                                    <textarea class="form-control" name="shipping_address" id="shipping_address" required>{{ old('shipping_address') }}</textarea>
                                </div>
                                @guest
                                    <div class="form-group col-md-12">
                                        <input type="checkbox" name="create_account" id="account-option" onchange="create_account_with_order(this)"> 
                                        <label for="account-option">   Create account</label>
                                    </div>
                                    <div class="form-group col-md-6" id="email" style="display: none">
                                        <label>   Email</label>
                                        <input type="email" name="email" id="input-email" class="form-control" value="{{old('email')}}">
                                    </div>
                                    <div class="form-group mb-3 col-md-6" id="password" style="display: none">
                                        <label class="field-label">   Password</label>
                                        <input type="password" id="input-password"  class="form-control" name="password">
                                    </div>
                                @endguest 
                            </div>
                        </div>
                        <div class="col-md-4"> 
                            <div style="height: 300px;position: absolute;border-left: 1px solid rgb(205 205 205);"></div>
                            <div style="padding:20px"> 
                                <input type="hidden" id="base_price_input" value="0"> 
                                <h4>Summary</h4>
                                <div style="display: flex;justify-content:space-between"> 
                                    <p>
                                        <b style="color: #61b3ae">1x</b> 
                                        <small id="cart-item-name" style="color: black"></small>  
                                    </p>
                                    <p id="cart-item-price"> 0.00EGP</p>
                                </div>
                                <div style="display: none;justify-content:space-between" id="nfc-addon"> 
                                    <small style="color: black">+ NFC TAG</small>
                                    <p> 100.00EGP</p>
                                </div>
                                <table class="table table-striped"> 
                                    <tbody>
                                        <tr> 
                                            <td>+SubTotal</td>
                                            <td id="sub_cost">0.00EGP</td> 
                                        </tr>
                                        <tr> 
                                            <td>+Shipping</td>
                                            <td id="shipping_cost">0.00EGP</td> 
                                        </tr> 
                                        <tr> 
                                            <td>Total</td>
                                            <td id="total_cost">0.00EGP </td> 
                                        </tr> 
                                    </tbody>
                                </table>
                                <div class="mt-4">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> 
                                    <input type="submit" class="btn btn-dark" value="Confirm Order" style="background:#61B3AE;border:none">
                                </div>
                            </div>
                        </div>
                    </div>  
                </form>
            </div> 
        </div>
    </div>
</div>

@section('scripts')
    @parent 
    <script>
        function create_account_with_order(el){ 
            if(el.checked){
                $('#password').css('display','block');
                $('#password input').prop('required',true);
                $('#email').css('display','block');
                $('#email input').prop('required',true);
            }else{
                $('#password').css('display','none');
                $('#password input').val(null);
                $('#password input').prop('required',false);
                $('#email').css('display','none');
                $('#email input').prop('required',false);
            }
        } 

        
        $(document).ready(function() {
            country_change();
        });  

        function country_change(){

            var selectedOption = $('#card_type option:selected').val(); 
            

            var quantity= $('#quantity').val();  
            var base_price= parseInt($('#base_price_input').val()); 
            if(selectedOption == 'nfc'){
                $('#nfc-addon').css('display','flex');
                base_price += 100;
            }else{
                $('#nfc-addon').css('display','none');
            }
            var subtotal = base_price * parseInt(quantity);

            // Get the selected option
            var selectedOption = $('#country_id option:selected');

            // Retrieve the value and data attribute
            var optionValue = selectedOption.val();
            var optionPrice = selectedOption.data('price');
            $('#sub_cost').html(subtotal + ' EGP'); 
            $('#shipping_cost').html(optionPrice + ' EGP'); 
            $('#total_cost').html((parseInt(optionPrice) + subtotal) + ' EGP');
        }
    </script>
@endsection