<?php

namespace App\Http\Requests;

use App\Models\UserLink;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserLinkRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_link_create');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'main_link_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'string',
                'required',
            ],
            'link' => [
                'string',
                'required',
            ],
            'active' => [
                'required',
            ],
        ];
    }
}
