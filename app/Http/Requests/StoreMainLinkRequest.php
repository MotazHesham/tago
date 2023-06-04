<?php

namespace App\Http\Requests;

use App\Models\MainLink;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMainLinkRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('main_link_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'photo' => [
                'required',
            ],
            'category_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
