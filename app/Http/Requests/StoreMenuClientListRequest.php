<?php

namespace App\Http\Requests;

use App\Models\MenuClientList;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMenuClientListRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'menu_theme_id' => [
                'required',
                'integer',
            ],
            'menu_client_id' => [
                'required',
                'integer',
            ],
            'logo' => [
                'required',
            ],
            'link' => [
                'required',
                'unique:menu_client_lists,link',
                'regex:/^[A-Za-z][A-Za-z0-9_-]{3,29}$/'
            ],
            'title' => [
                'nullable',
            ],
            'font_family' => [
                'required',
            ],
            'logo_size' => [
                'required',
                'integer',
            ],
            'about_us' => [
                'nullable',
            ],
            'facebook' => [
                'string',
                'nullable',
            ],
            'twitter' => [
                'string',
                'nullable',
            ],
            'google' => [
                'string',
                'nullable',
            ],
            'linkedin' => [
                'string',
                'nullable',
            ],
            'tiktok' => [
                'string',
                'nullable',
            ],
            'youtube' => [
                'string',
                'nullable',
            ],
            'instagram' => [
                'string',
                'nullable',
            ],
            'whatsapp' => [
                'string',
                'nullable',
            ],
        ];
    }
}
