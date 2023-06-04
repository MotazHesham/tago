<?php

namespace App\Http\Requests;

use App\Models\Order;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOrderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('order_create');
    }

    public function rules()
    {
        return [
            'first_name' => [
                'string',
                'required',
            ],
            'last_name' => [
                'string',
                'required',
            ],
            'phone_number' => [
                'string',
                'required',
            ],
            'shipping_address' => [
                'required',
            ],
            'delivery_status' => [
                'required',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'products.*' => [
                'integer',
            ],
            'products' => [
                'array',
            ],
        ];
    }
}
