<?php

namespace App\Http\Requests;

use App\Models\MenuClientList;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMenuClientListRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('menu_client_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:menu_client_lists,id',
        ];
    }
}
