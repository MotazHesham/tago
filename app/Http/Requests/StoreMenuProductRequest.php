<?php

namespace App\Http\Requests;

use App\Models\MenuProduct;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMenuProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'price' => [
                'required',
            ],
            'menu_category_id' => [
                'required',
                'integer',
            ],
            'menu_client_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
