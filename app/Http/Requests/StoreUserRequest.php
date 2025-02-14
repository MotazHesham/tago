<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserRequest extends FormRequest
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
            'email' => [
                'required',
                'unique:users',
            ],
            'phone_number' => [
                'string',
                'nullable',
            ],
            'password' => [
                'required',
            ], 
            'nickname' => [
                'string',
                'nullable',
            ],
            'bio' => [
                'string',
                'nullable',
            ],
        ];
    }
}
