<?php

namespace App\Http\Requests;

use App\Models\LinkCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreLinkCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('link_category_create');
    }

    public function rules()
    {
        return [
            'category' => [
                'string',
                'required',
            ],
        ];
    }
}
