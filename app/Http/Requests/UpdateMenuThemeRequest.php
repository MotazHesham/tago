<?php

namespace App\Http\Requests;

use App\Models\MenuTheme;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMenuThemeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('menu_theme_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
