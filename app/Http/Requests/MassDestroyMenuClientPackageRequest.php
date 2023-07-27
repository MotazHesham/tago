<?php

namespace App\Http\Requests;

use App\Models\MenuClientPackage;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMenuClientPackageRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('menu_client_package_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:menu_client_packages,id',
        ];
    }
}
