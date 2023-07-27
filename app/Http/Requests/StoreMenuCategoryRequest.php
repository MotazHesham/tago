<?php

namespace App\Http\Requests;

use App\Models\MenuCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMenuCategoryRequest extends FormRequest
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
            'banner' => [
                'required',
            ],
            'menu_client_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
