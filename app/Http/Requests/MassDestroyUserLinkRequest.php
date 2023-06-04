<?php

namespace App\Http\Requests;

use App\Models\UserLink;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyUserLinkRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('user_link_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:user_links,id',
        ];
    }
}
