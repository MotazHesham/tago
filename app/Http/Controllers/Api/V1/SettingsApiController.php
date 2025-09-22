<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\api_return;
use App\Models\Setting;

class SettingsApiController extends Controller
{
    use api_return;

    public function settings(){
        $setting = Setting::first();
        return $this->returnData([
            'website_name' => $setting->website_name,
            'description' => $setting->description,
            'how_it_work_description' => $setting->how_it_work_description,
            'how_it_work' => $setting->how_it_work,
            'contact_description' => $setting->contact_description,
            'email' => $setting->email,
            'phone_number' => $setting->phone_number,
            'address' => $setting->address,
            'facebook' => $setting->facebook,
            'instagram' => $setting->instagram,
            'tiktok' => $setting->tiktok,
            'youtube' => $setting->youtube,
            'keywords_seo' => $setting->keywords_seo,
            'author_seo' => $setting->author_seo,
            'sitemap_link_seo' => $setting->sitemap_link_seo,
            'description_seo' => $setting->description_seo,
            'why_us_en' => $setting->why_us_en,
            'why_us_ar' => $setting->why_us_ar,
            'our_mission_en' => $setting->our_mission_en,
            'our_mission_ar' => $setting->our_mission_ar,
            'privacy_policy_en' => $setting->privacy_policy_en,
            'privacy_policy_ar' => $setting->privacy_policy_ar,
            'logo' => $setting->logo ? $setting->logo->getUrl() : null, 
        ],"success");
    }
}
