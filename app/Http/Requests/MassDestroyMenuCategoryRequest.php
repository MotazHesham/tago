<?php

namespace App\Http\Requests;

use App\Models\MenuCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMenuCategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('menu_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:menu_categories,id',
        ];
    }
}
