<?php

namespace App\Http\Requests;

use App\Models\MenuPackage;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMenuPackageRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('menu_package_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'descrption' => [
                'required',
            ],
            'themes.*' => [
                'integer',
            ],
            'themes' => [
                'required',
                'array',
            ],
        ];
    }
}