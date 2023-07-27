<?php

namespace App\Http\Requests;

use App\Models\MenuClientPackage;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMenuClientPackageRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('menu_client_package_edit');
    }

    public function rules()
    {
        return [
            'menu_client_id' => [
                'required',
                'integer',
            ],
            'menu_package_id' => [
                'required',
                'integer',
            ],
            'start_at' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'end_at' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
