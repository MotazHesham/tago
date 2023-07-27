<?php

namespace App\Http\Requests;

use App\Models\Tutorial;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTutorialRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tutorial_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'iframe' => [
                'required',
            ],
        ];
    }
}
