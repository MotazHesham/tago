<?php

namespace App\Http\Requests;

use App\Models\Connection;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreConnectionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('connection_create');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
            ],
            'title' => [
                'string',
                'required',
            ],
            'phone_number' => [
                'string',
                'required',
            ],
            'link' => [
                'string',
                'nullable',
            ],
        ];
    }
}
