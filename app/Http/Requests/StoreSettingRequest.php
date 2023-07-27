<?php

namespace App\Http\Requests;

use App\Models\Setting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSettingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('setting_create');
    }

    public function rules()
    {
        return [
            'website_name' => [
                'string',
                'required',
            ],
            'description' => [
                'required',
            ],
            'how_it_work_description' => [
                'required',
            ],
            'how_it_work' => [
                'required',
            ],
            'contact_description' => [
                'required',
            ],
            'email' => [
                'required',
            ],
            'phone_number' => [
                'string',
                'required',
            ],
            'address' => [
                'required',
            ],
            'facebook' => [
                'string',
                'required',
            ],
            'instagram' => [
                'string',
                'required',
            ],
            'tiktok' => [
                'string',
                'required',
            ],
            'youtube' => [
                'string',
                'required',
            ],
            'supporters' => [
                'array',
                'required',
            ],
            'supporters.*' => [
                'required',
            ],
            'logo' => [
                'required',
            ],
        ];
    }
}
