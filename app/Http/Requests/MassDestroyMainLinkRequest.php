<?php

namespace App\Http\Requests;

use App\Models\MainLink;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMainLinkRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('main_link_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:main_links,id',
        ];
    }
}
