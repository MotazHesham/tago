<?php

namespace App\Http\Requests;

use App\Models\CompanyPackage;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCompanyPackageRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('company_package_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:company_packages,id',
        ];
    }
}
